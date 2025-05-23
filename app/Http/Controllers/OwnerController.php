<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi; // Tambahkan ini
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PDF;


class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalPendapatan = \App\Models\Reservasi::whereIn('status_reservasi', ['dibayar', 'selesai'])->sum('total_bayar');
        $totalPeserta = \App\Models\Reservasi::whereIn('status_reservasi', ['dibayar', 'selesai'])->sum('jumlah_peserta');
        $totalReservasi = \App\Models\Reservasi::whereIn('status_reservasi', ['dibayar', 'selesai'])->count();
        $reservasis = \App\Models\Reservasi::with(['pelanggan', 'paket'])
            ->whereIn('status_reservasi', ['dibayar', 'selesai'])
            ->orderByDesc('created_at')
            ->get();

        return view('be.users.owner.index', [
            'title' => 'Dashboard Owner',
            'totalPendapatan' => $totalPendapatan,
            'totalPeserta' => $totalPeserta,
            'totalReservasi' => $totalReservasi,
            'reservasis' => $reservasis
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Export PDF Laporan Keuangan
     */
    public function exportPdf()
    {
        // Get data with correct column names from your schema
        $data = [
            'totalPendapatan' => Reservasi::whereIn('status_reservasi', ['dibayar', 'selesai'])->sum('total_bayar'),
            'paketLaris' => Reservasi::selectRaw('id_paket, COUNT(*) as jumlah')
                ->whereIn('status_reservasi', ['dibayar', 'selesai'])
                ->groupBy('id_paket')
                ->orderByDesc('jumlah')
                ->with('paket')
                ->first(),
            'statistikPeserta' => Reservasi::selectRaw('id_paket, SUM(jumlah_peserta) as total_peserta')
                ->whereIn('status_reservasi', ['dibayar', 'selesai'])
                ->groupBy('id_paket')
                ->with('paket')
                ->get(),
            'grafikPendapatan' => Reservasi::selectRaw('DATE_FORMAT(tgl_reservasi, "%Y-%m") as bulan, SUM(total_bayar) as total')
                ->whereIn('status_reservasi', ['dibayar', 'selesai'])
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get(),
            'reservasi' => Reservasi::with(['pelanggan', 'paket'])
                ->whereIn('status_reservasi', ['dibayar', 'selesai'])
                ->orderByDesc('created_at')
                ->get(),
            'tanggalLaporan' => Carbon::now()->translatedFormat('d F Y'),
            'waktuCetak' => Carbon::now()->translatedFormat('d F Y H:i'),
            'user' => auth()->user()
        ];

        // Configure PDF options
        $pdf = Pdf::loadView('be.users.owner.pdf', $data)
            ->setPaper('A4', 'portrait')
            ->setOption([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'helvetica'
            ]);
            
        return $pdf->download('laporan-keuangan-' . Carbon::now()->format('Ymd-His') . '.pdf');
    }

    public function exportExcel()
    {
        $reservasi = Reservasi::with(['pelanggan', 'paket'])
            ->whereIn('status_reservasi', ['dibayar', 'selesai'])
            ->orderByDesc('created_at')
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Pelanggan');
        $sheet->setCellValue('C1', 'Paket Wisata');
        $sheet->setCellValue('D1', 'Tgl Reservasi');
        $sheet->setCellValue('E1', 'Harga');
        $sheet->setCellValue('F1', 'Jumlah Peserta');
        $sheet->setCellValue('G1', 'Diskon');
        $sheet->setCellValue('H1', 'Total Bayar');
        $sheet->setCellValue('I1', 'Status');
        $sheet->setCellValue('J1', 'Dibuat');

        $row = 2;
        foreach ($reservasi as $i => $r) {
            $sheet->setCellValue('A' . $row, $i + 1);
            $sheet->setCellValue('B' . $row, $r->pelanggan->nama_lengkap ?? '-');
            $sheet->setCellValue('C' . $row, $r->paket->nama_paket ?? '-');
            $sheet->setCellValue('D' . $row, $r->tgl_reservasi);
            $sheet->setCellValue('E' . $row, $r->harga);
            $sheet->setCellValue('F' . $row, $r->jumlah_peserta);
            if ($r->diskon) {
                $sheet->setCellValue('G' . $row, $r->diskon . '% (Rp' . number_format($r->nilai_diskon, 0, ',', '.') . ')');
            } else {
                $sheet->setCellValue('G' . $row, '-');
            }
            $sheet->setCellValue('H' . $row, $r->total_bayar);
            $status = '-';
            if ($r->status_reservasi == 'pesan') $status = 'Pesan';
            elseif ($r->status_reservasi == 'dibayar') $status = 'Dibayar';
            elseif ($r->status_reservasi == 'selesai') $status = 'Selesai';
            $sheet->setCellValue('I' . $row, $status);
            $sheet->setCellValue('J' . $row, \Carbon\Carbon::parse($r->created_at)->format('d-m-Y'));
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan-keuangan.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }
}
