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
        <!-- Header Section -->
        <h1 class="mb-3">Manajemen Kategori Berita</h1>

        <!-- Tombol Tambah di kiri bawah judul -->
        <div class="mb-4">
            <a href="{{ route('kategori_berita.create') }}" class="btn btn-primary">
                Tambah Kategori
            </a>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="alert alert-success d-none" id="success-alert">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger d-none" id="error-alert">
            {{ session('error') }}
        </div>
        @endif

        <!-- Main Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Tanggal Dibuat</th>
                    <th>Tanggal Diupdate</th>
                    <th>Aksi</th>
                </tr>
                <tbody>
                    @foreach($kategoris as $kategori)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kategori->kategori_berita }}</td>
                        <td>{{ $kategori->created_at->format('d-m-Y H:i') }}</td>
                        <td>{{ $kategori->updated_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('kategori_berita.edit', $kategori->id) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fa fa-pencil-square-o"></i> Edit
                                </a>
                                <form action="{{ route('obyek_wisata.destroy', $kategori->id) }}"
                                    method="POST" class="d-inline" id="deleteForm-{{ $kategori->id }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger delete-btn"
                                        data-id="{{ $kategori->id }}">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($kategoris->isEmpty())
        <div class="alert alert-info text-center mt-3">
            Tidak ada data Kategori Berita tersedia
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
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');

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