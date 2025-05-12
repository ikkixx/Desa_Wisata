@extends('be.master')

@section('sidebar')
@include('be.sidebar')
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Manajemen Reservasi</h4>
                        @if(auth()->user()->level !== 'owner')
                        <a href="{{ route('reservasi.create') }}" class="btn btn-primary mb-3">Tambah Reservasi</a> <!-- Add button -->
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

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Pelanggan</th>
                                        <th scope="col">Paket Wisata</th>
                                        <th scope="col">Tanggal Reservasi</th>
                                        <th scope="col">Jumlah Peserta</th>
                                        <th scope="col">Total Bayar</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($reservasis as $index => $reservasi)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>

                                        <td>
                                            {{ $reservasi->pelanggan->nama_lengkap ?? 'N/A' }}
                                            <br>
                                            <small class="text-muted">{{ $reservasi->pelanggan->no_hp ?? '' }}</small>
                                        </td>

                                        <td>{{ $reservasi->paket->nama_paket ?? 'N/A' }}</td>

                                        <td>{{ \Carbon\Carbon::parse($reservasi->tgl_reservasi)->format('d M Y') }}</td>

                                        <td>{{ $reservasi->jumlah_peserta }} orang</td>

                                        <td>Rp {{ number_format($reservasi->total_bayar, 0, ',', '.') }}</td>

                                        <td>
                                            @php
                                            $status = $reservasi->status_reservasi_wisata ?? 'default'; // Default to 'default' if it's not set
                                            $badgeClass = [
                                            'pesan' => 'warning',
                                            'dibayar' => 'success',
                                            'selesai' => 'primary'
                                            ][$status] ?? 'secondary'; // Default to 'secondary' if the status is not in the array
                                            @endphp

                                            <span class="badge badge-{{ $badgeClass }}">
                                                {{ ucfirst($reservasi->status_reservasi_wisata) }}
                                            </span>
                                        </td>

                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('reservasi.edit', $reservasi->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="{{ route('reservasi.show', $reservasi->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <form action="{{ route('reservasi.destroy', $reservasi->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus reservasi ini?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if($reservasis->isEmpty())
                        <div class="alert alert-info text-center mt-3">
                            Tidak ada data reservasi tersedia
                        </div>
                        @endif

                    </div> <!-- card-body -->
                </div> <!-- card -->
            </div> <!-- col -->
        </div> <!-- row -->
    </div> <!-- content-wrapper -->
</div> <!-- main-panel -->


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