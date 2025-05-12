@extends('be.master') <!-- Ensure this file exists in resources\views\be\master.blade.php -->
@section('sidebar')
@include('be.sidebar') <!-- Ensure this file exists in resources\views\be\sidebar.blade.php -->
@endsection
@section('header')
@include('be.header') <!-- Ensure this file exists in resources\views\be\header.blade.php -->
@endsection
@section('content')
<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid"></div>
    <div class="container">
        <h1 class="mb-4">Manajemen Kategori Wisata</h1>

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

        @if(auth()->user()->level !== 'owner')
        <a href="{{ route('kategori_wisata.create') }}" class="btn btn-primary mb-3">Tambah Kategori Wisata</a> <!-- Add button -->
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori</th>
                    <th>Foto</th>
                    <th>Deskripsi</th>
                    <th>Dibuat Pada</th>
                    <th>Diperbarui Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategoriWisata as $kategori)
                <tr>
                    <td>{{ $kategori->id }}</td>
                    <td>{{ $kategori->kategori_wisata }}</td>
                    <td>
                        @if($kategori->foto)
                        <img src="{{ asset('storage/' . $kategori->foto) }}" alt="Foto Kategori" width="100">
                        @else
                        Tidak ada foto
                        @endif
                    </td>
                    <td>{{ $kategori->deskripsi }}</td>
                    <td>{{ $kategori->created_at->format('d-m-Y H:i') }}</td>
                    <td>{{ $kategori->updated_at->format('d-m-Y H:i') }}</td>
                    <td>
                        @if(auth()->check() && auth()->user()->level !== 'owner')
                        <a href="{{ route('kategori_wisata.edit', $kategori->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kategori_wisata.destroy', $kategori->id) }}" method="POST" style="display:inline;" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
                @if(session('alert'))
                <div class="alert alert-{{ session('alert')['type'] }} alert-dismissible fade show" role="alert">
                    {{ session('alert')['message'] }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </tbody>
        </table>
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