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
        <h1 class="mb-3">Manajemen Berita</h1>

        <!-- Tombol Tambah di kiri bawah judul -->
        @if(auth()->check() && auth()->user()->level !== 'owner')
        <div class="mb-4">
            <a href="{{ route('berita.create') }}" class="btn btn-primary">
                Tambah Berita
            </a>
        </div>
        @endif

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
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal Post</th>
                        <th>Konten</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($news as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}"
                                alt="Gambar Berita"
                                class="img-thumbnail"
                                width="80"
                                height="60"
                                style="cursor: pointer; object-fit: cover;"
                                onclick="showImageModal('{{ asset('storage/' . $item->foto) }}')">
                            @else
                            <span class="text-muted">Tidak Ada Gambar</span>
                            @endif
                        </td>
                        <td>{{ Str::limit($item->judul, 50) }}</td>
                        <td>
                            @if($item->kategoriBerita)
                            {{ $item->kategoriBerita->kategori_berita }}
                            @else
                            <span class="text-danger">Kategori Dihapus</span>
                            @endif
                        </td>
                        <td>
                            @if($item->tgl_post)
                            {{ \Carbon\Carbon::parse($item->tgl_post)->format('d M Y') }}
                            @else
                            <span class="text-muted">Tidak Ada Tanggal</span>
                            @endif
                        </td>
                        <td>{{ Str::limit(strip_tags($item->berita), 50) }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('kategori_berita.edit', $item->id) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fa fa-pencil-square-o"></i> Edit
                                </a>
                                <form action="{{ route('obyek_wisata.destroy', $item->id) }}"
                                    method="POST" class="d-inline" id="deleteForm-{{ $item->id }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger delete-btn"
                                        data-id="{{ $item->id }}">
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

        @if($news->isEmpty())
        <div class="alert alert-info text-center mt-3">
            Tidak ada berita tersedia
        </div>
        @endif
    </div>
</div>

<!-- Image Preview Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pratinjau Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Preview" class="img-fluid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Function to show image preview
    function showImageModal(src) {
        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
        document.getElementById('modalImage').src = src;
        modal.show();
    }

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