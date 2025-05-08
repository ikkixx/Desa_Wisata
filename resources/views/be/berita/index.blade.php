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
                        <h4 class="card-title">Berita Manajemen</h4>
                        @if(auth()->check() && auth()->user()->level !== 'owner')
                        <a href="{{ route('berita.create') }}" class="btn btn-primary mb-3">Tambah Berita</a>
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
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Post Date</th>
                                        <th>Content</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($news as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}"
                                                alt="News Image"
                                                class="rounded"
                                                width="60"
                                                height="40"
                                                style="object-fit: cover;">
                                            @else
                                            <span class="text-muted">No Image</span>
                                            @endif
                                        </td>
                                        <td>{{ Str::limit($item->judul, 50) }}</td>
                                        <td>
                                            @if($item->kategoriBerita)
                                            {{ $item->kategoriBerita->kategori_berita }}
                                            @else
                                            <span class="text-danger">Category Deleted</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->tgl_post)
                                            {{ \Carbon\Carbon::parse($item->tgl_post)->format('d M Y') }}
                                            @else
                                            <span class="text-muted">No date</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->berita)
                                            {{ $item->berita }}
                                            @else
                                            <span class="text-muted">No content</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-warning btn-sm" onClick="window.location.href='{{ route('berita.edit', $item->id) }}'">
                                                    <i class="fa fa-pencil-square-o"></i> Edit
                                                </button>
                                                <form action="{{ route('berita.destroy', $item->id) }}" method="POST" style="display:inline;" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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
                            No news available
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
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