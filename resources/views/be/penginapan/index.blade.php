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
        <h1 class="mb-4">Manajemen Penginapan</h1>

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
        <a href="{{ route('penginapan.create') }}" class="btn btn-primary mb-3">
            Tambah Penginapan
        </a>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Penginapan</th>
                        <th>Fasilitas</th>
                        <th>Foto</th>
                        <th>Dibuat Pada</th>
                        <th>Diperbarui Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penginapans as $i => $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ Str::limit($p->nama_penginapan, 30) }}</td>
                        <td>{{ Str::limit($p->fasilitas, 50) }}</td>
                        <td>
                            @for($f = 1; $f <= 5; $f++)
                                @php $foto='foto' .$f; @endphp
                                @if($p->$foto)
                                <img src="{{ asset('storage/' . $p->$foto) }}"
                                    alt="Foto"
                                    class="img-thumbnail"
                                    width="80"
                                    onclick="showImgPreview('{{ asset('storage/' . $p->$foto) }}')"
                                    style="cursor:pointer; margin-right: 3px;">
                                @endif
                                @endfor
                        </td>
                        <td>{{ $p->created_at ? $p->created_at->format('d-m-Y H:i') : '-' }}</td>
                        <td>{{ $p->updated_at ? $p->updated_at->format('d-m-Y H:i') : '-' }}</td>
                        <td>
                            <a href="{{ route('penginapan.edit', $p->id) }}"
                                class="btn btn-sm btn-warning">
                                <i class="fa fa-pencil-square-o"></i> Edit
                            </a>
                            <form action="{{ route('penginapan.destroy', $p->id) }}"
                                method="POST" class="d-inline" id="deleteForm-{{ $p->id }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger delete-btn"
                                    data-id="{{ $p->id }}">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($penginapans->isEmpty())
        <div class="alert alert-info text-center mt-3">
            Tidak ada data penginapan tersedia
        </div>
        @endif
    </div>
</div>

<!-- Modal Preview Gambar -->
<div class="modal fade" id="imgPreviewModal" tabindex="-1" aria-labelledby="imgPreviewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img id="imgPreview" src="" alt="Preview" style="max-width:100%; max-height:70vh;">
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