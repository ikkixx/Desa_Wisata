<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 25px;
            background-color: #f9f9f9;
        }

        .container {
            background-color: white;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #4a89dc;
        }

        .logo {
            width: 80px;
            height: auto;
        }

        .header-content {
            text-align: right;
        }

        .title {
            color: #3b7ddd;
            font-size: 22px;
            font-weight: 600;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .subtitle {
            color: #666;
            font-size: 13px;
            margin: 5px 0 0;
        }

        .summary-card {
            background: linear-gradient(135deg, #f6f9ff 0%, #e7f0fd 100%);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
            border-left: 4px solid #4a89dc;
        }

        .summary-title {
            color: #3b7ddd;
            font-size: 15px;
            font-weight: 600;
            margin: 0 0 10px;
        }

        .summary-content {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .summary-item {
            flex: 1;
            min-width: 200px;
        }

        .summary-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 3px;
        }

        .summary-value {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .highlight-value {
            color: #3b7ddd;
            font-size: 16px;
        }

        .section {
            margin-bottom: 25px;
        }

        .section-title {
            color: #3b7ddd;
            font-size: 15px;
            font-weight: 600;
            margin: 0 0 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #e0e6ed;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 10px;
            background: white;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 0 0 1px #e0e6ed;
        }

        th {
            background-color: #4a89dc;
            color: white;
            font-weight: 500;
            padding: 10px 12px;
            text-align: left;
        }

        td {
            padding: 8px 12px;
            border-bottom: 1px solid #e0e6ed;
            vertical-align: middle;
        }

        tr:nth-child(even) {
            background-color: #f8fafc;
        }

        tr:hover {
            background-color: #f1f5fb;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
        }

        .badge-pesan {
            background-color: #f8e5b9;
            color: #8a6d3b;
        }

        .badge-dibayar {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-selesai {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .signature-area {
            margin-top: 40px;
            display: flex;
            justify-content: flex-end;
        }

        .signature-box {
            text-align: center;
            width: 250px;
        }

        .signature-placeholder {
            height: 60px;
            margin: 15px 0;
            border-bottom: 1px solid #ddd;
        }

        .signature-text {
            font-size: 12px;
            color: #666;
        }

        .signature-name {
            font-weight: 600;
            margin-top: 5px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 11px;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div>
                <img class="logo" src="{{ public_path('images/logo.png') }}" alt="Logo">
                <h1 class="title">KiyTrip</h1>
            </div>
            <div class="header-content">
                <h2 class="title">Laporan Keuangan</h2>
                <p class="subtitle">Periode: {{ now()->translatedFormat('F Y') }}</p>
                <p class="subtitle">Dibuat: {{ now()->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <div class="summary-card">
            <h3 class="summary-title">Ringkasan Performa</h3>
            <div class="summary-content">
                <div class="summary-item">
                    <div class="summary-label">Total Pendapatan</div>
                    <div class="summary-value highlight-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Total Reservasi</div>
                    <div class="summary-value">{{ $reservasi->count() }} Transaksi</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Paket Terlaris</div>
                    <div class="summary-value">
                        {{ $paketLaris->paket->nama_paket ?? '-' }} 
                        <span>({{ $paketLaris->jumlah ?? 0 }}x)</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <h3 class="section-title">Statistik Peserta</h3>
            <table>
                <thead>
                    <tr>
                        <th>Paket Wisata</th>
                        <th class="text-center">Total Peserta</th>
                        <th class="text-center">% dari Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $totalPeserta = $statistikPeserta->sum('total_peserta') @endphp
                    @foreach($statistikPeserta as $row)
                    <tr>
                        <td>{{ $row->paket->nama_paket ?? '-' }}</td>
                        <td class="text-center">{{ $row->total_peserta }}</td>
                        <td class="text-center">{{ $totalPeserta > 0 ? round(($row->total_peserta/$totalPeserta)*100) : 0 }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="section">
            <h3 class="section-title">Tren Pendapatan Bulanan</h3>
            <table>
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th class="text-right">Pendapatan</th>
                        <th class="text-right">Pertumbuhan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($grafikPendapatan as $i => $row)
                    <tr>
                        <td>{{ $row->bulan }}</td>
                        <td class="text-right">Rp {{ number_format($row->total, 0, ',', '.') }}</td>
                        <td class="text-right">
                            @if($i > 0)
                                @php 
                                    $prev = $grafikPendapatan[$i-1]->total;
                                    $growth = $prev > 0 ? (($row->total - $prev)/$prev)*100 : 0;
                                @endphp
                                {{ round($growth) }}%
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="section">
            <h3 class="section-title">Detail Transaksi</h3>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pelanggan</th>
                        <th>Paket</th>
                        <th>Tanggal</th>
                        <th class="text-right">Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservasi as $i => $r)
                    <tr>
                        <td class="text-center">{{ $i+1 }}</td>
                        <td>{{ $r->pelanggan->nama_lengkap ?? '-' }}</td>
                        <td>{{ $r->paket->nama_paket ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($r->tgl_reservasi_wisata)->format('d/m/Y') }}</td>
                        <td class="text-right">Rp{{ number_format($r->total_bayar, 0, ',', '.') }}</td>
                        <td>
                            @switch($r->status_reservasi_wisata)
                                @case('pesan') <span class="badge badge-pesan">Pesan</span> @break
                                @case('dibayar') <span class="badge badge-dibayar">Dibayar</span> @break
                                @case('selesai') <span class="badge badge-selesai">Selesai</span> @break
                            @endswitch
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="signature-area">
            <div class="signature-box">
                <div class="signature-placeholder"></div>
                <p class="signature-text">Cibinong, {{ now()->format('d F Y') }}</p>
                <p class="signature-name">Admin WisataKu</p>
                <p class="signature-text">PT. WisataKu Indonesia</p>
            </div>
        </div>

        <div class="footer">
            Laporan ini dibuat secara otomatis oleh Sistem WisataKu • Hak Cipta © {{ date('Y') }}
        </div>
    </div>
</body>

</html>