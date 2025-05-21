@extends('be.master')
@section('sidebar')
@include('be.sidebar')
@endsection
@section('header')
@include('be.header')
@endsection

@section('content')
<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="container">
            <h1 class="mb-4">{{ $title }}</h1>

            <!-- Pastikan semua route() memiliki parameter -->
            <a href="{{ route('owner.exportPdf') }}" class="btn btn-danger mb-3" id="exportPdfBtn">
                <i class="bi bi-file-pdf-fill"></i> PDF
            </a>

            <a href="{{ route('owner.exportExcel') }}" class="btn btn-success mb-3" id="exportExcelBtn">
                <i class="bi bi-file-excel"></i> EXCEL
            </a>

            <!-- Contoh tabel data -->
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pelanggan</th>
                        <th>Paket</th>
                        <th>Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservasis as $reservasi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $reservasi->pelanggan->nama ?? 'N/A' }}</td>
                        <td>{{ $reservasi->paket->nama_paket ?? 'N/A' }}</td>
                        <td>Rp {{ number_format($reservasi->total_bayar, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Hapus tag PHP yang tidak perlu --}}
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Total Pendapatan</div>
                        <div class="card-body">
                            <h5 class="card-title">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-header">Total Peserta</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $totalPeserta }} Orang</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Total Reservasi</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $totalReservasi }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('exportPdfBtn').addEventListener('click', function(e) {
        e.preventDefault(); // Mencegah perilaku default link

        // Tampilkan SweetAlert loading
        const swalInstance = Swal.fire({
            title: 'Menyiapkan PDF',
            html: 'Sedang memproses, harap tunggu...',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();

                // Buat iframe tersembunyi untuk download
                const iframe = document.createElement('iframe');
                iframe.style.display = 'none';
                iframe.src = this.href; // Menggunakan URL dari href link
                document.body.appendChild(iframe);

                // Deteksi ketika iframe selesai loading
                iframe.onload = function() {
                    swalInstance.close();
                    document.body.removeChild(iframe);
                };

                // Fallback: Tutup setelah 1 detik jika onload tidak terpicu
                setTimeout(() => {
                    swalInstance.close();
                    document.body.removeChild(iframe);
                }, 1000);
            }
        });
    });

    document.getElementById('exportExcelBtn').addEventListener('click', function(e) {
        e.preventDefault(); // Mencegah perilaku default link

        // Tampilkan SweetAlert loading
        const swalInstance = Swal.fire({
            title: 'Menyiapkan Excel',
            html: 'Sedang memproses data, harap tunggu...',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();

                // Buat iframe tersembunyi untuk download
                const iframe = document.createElement('iframe');
                iframe.style.display = 'none';
                iframe.src = this.href; // Menggunakan URL dari href link
                document.body.appendChild(iframe);

                // Deteksi ketika iframe selesai loading
                iframe.onload = function() {
                    swalInstance.close();
                    document.body.removeChild(iframe);
                };

                // Fallback: Tutup setelah 1 detik jika onload tidak terpicu
                setTimeout(() => {
                    swalInstance.close();
                    document.body.removeChild(iframe);
                }, 1000);
            }
        });
    });
</script>
@endsection