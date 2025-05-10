@extends('be.master')
@section('sidebar')
@include('be.sidebar')
@endsection
@section('header')
@include('be.header')
@endsection

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h2  class="mb-4">Daftar Kategori Wisata</h2>
            </div>

            <!-- SweetAlert Messages -->
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

            <div class="card-body">
                <!-- Tombol Tambah dipindahkan ke sini (atas tabel) -->
                <div class="mb-3">
                    <a href="{{ route('kategori_berita.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Tambah Kategori
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kategoris as $kategori)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kategori->kategori_berita }}</td>
                                <td>{{ $kategori->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('kategori_berita.edit', $kategori->id) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fa fa-pencil-square-o"></i> Edit
                                    </a>
                                    <form action="{{ route('kategori_berita.destroy', $kategori->id) }}"
                                        method="POST" class="d-inline" id="deleteForm-{{ $kategori->id }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete-btn"
                                            data-id="{{ $kategori->id }}">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // SweetAlert notifications
        const showAlert = (type, title, text) => {
            Swal.fire({
                icon: type,
                title: title,
                text: text,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        };

        // Success message
        const successAlert = document.getElementById('success-alert');
        if (successAlert) showAlert('success', 'Sukses!', successAlert.textContent);

        // Error message
        const errorAlert = document.getElementById('error-alert');
        if (errorAlert) showAlert('error', 'Gagal!', errorAlert.textContent);

        // Delete confirmation
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const formId = this.getAttribute('data-id');

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
                        document.getElementById(`deleteForm-${formId}`).submit();
                    }
                });
            });
        });
    });
</script>
@endsection