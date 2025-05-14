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
    <div class="container-fluid"></div>
    <div class="container">
        <h1 class="mb-4">Manajemen Reservasi</h1>

        @if(auth()->user()->level !== 'owner')
        <a href="{{ route('reservasi.create') }}" class="btn btn-primary mb-3">Tambah Reservasi</a>
        @endif

        <!-- SweetAlert Success Message -->
        @if(session('success'))
        <div class="alert alert-success d-none" id="success-alert">
            {{ session('success') }}
        </div>
        @endif

        <!-- SweetAlert Error Message -->
        @if(session('error'))
        <div class="alert alert-danger d-none" id="error-alert">
            {{ session('error') }}
        </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pelanggan</th>
                    <th>Paket Wisata</th>
                    <th>Tanggal Reservasi</th>
                    <th>Jumlah Peserta</th>
                    <th>Total Bayar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservasis as $index => $reservasi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $reservasi->pelanggan->nama_lengkap ?? 'N/A' }}</td>
                    <td>{{ $reservasi->paket->nama_paket ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservasi->tgl_reservasi)->format('d M Y') }}</td>
                    <td>{{ $reservasi->jumlah_peserta }} orang</td>
                    <td>Rp {{ number_format($reservasi->total_bayar, 0, ',', '.') }}</td>
                    <td>
                        @php
                        $status = $reservasi->status_reservasi ?? 'default';
                        $badgeClass = [
                        'pesan' => 'warning',
                        'dibayar' => 'success',
                        'selesai' => 'primary'
                        ][$status] ?? 'secondary';
                        @endphp

                        <span class="badge badge-{{ $badgeClass }}">
                            {{ ucfirst($status) }}
                        </span>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('reservasi.edit', $reservasi->id) }}" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('reservasi.destroy', $reservasi->id) }}" method="POST" style="display: inline-block;" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($reservasis->isEmpty())
        <div class="alert alert-info text-center mt-3">
            Tidak ada data reservasi tersedia
        </div>
        @endif
    </div>
</div>

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Success message
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: successAlert.textContent,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        }

        // Error message
        const errorAlert = document.getElementById('error-alert');
        if (errorAlert) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: errorAlert.textContent,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        }

        // Delete confirmation
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection