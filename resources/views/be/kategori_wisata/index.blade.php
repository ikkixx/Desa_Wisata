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
        <h1 class="mb-4">Manajemen Kategori Wisata</h1>

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

        @if(auth()->user()->level !== 'owner')
        <a href="{{ route('kategori_wisata.create') }}" class="btn btn-primary mb-3">Tambah Kategori Wisata</a>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori</th>
                    <th>Foto</th>
                    <th>Deskripsi</th>
                    <th>Dibuat Pada</th>
                    <th>Diperbarui Pada</th>
                    <th>Aksi</th>
                </tr>
                <tbody>
                    @foreach($kategori as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kategori_wisata }}</td>
                        <td>
                            @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Kategori" class="img-thumbnail" width="100">
                            @else
                            <span class="text-muted">Tidak ada foto</span>
                            @endif
                        </td>
                        <td>{{ Str::limit($item->deskripsi, 100) }}</td>
                        <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                        <td>{{ $item->updated_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <a href="{{ route('berita.edit', $item->id) }}"
                                class="btn btn-sm btn-warning">
                                <i class="fa fa-pencil-square-o"></i> Edit
                            </a>
                            <form action="{{ route('berita.destroy', $item->id) }}"
                                method="POST" class="d-inline" id="deleteForm-{{ $item->id }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger delete-btn"
                                    data-id="{{ $item->id }}">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($kategori->isEmpty())
        <div class="alert alert-info text-center mt-3">
            Tidak ada data kategori wisata tersedia
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