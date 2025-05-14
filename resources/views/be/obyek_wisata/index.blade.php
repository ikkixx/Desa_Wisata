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
        <!-- Header dengan tombol di kiri -->
        <div class="mb-4">
            <h1 class="mb-3">Manajemen Objek Wisata</h1>
            <a href="{{ route('obyek_wisata.create') }}" class="btn btn-primary">
                Tambah Objek Wisata
            </a>
        </div>

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

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>No</th>
                    <th>Nama Wisata</th>
                    <th>Kategori</th>
                    <th>Foto 1</th>
                    <th>Foto 2</th>
                    <th>Foto 3</th>
                    <th>Foto 4</th>
                    <th>Foto 5</th>
                    <th>Deskripsi</th>
                    <th>Fasilitas</th>
                    <th>Aksi</th>
                </tr>
                <tbody>
                    @foreach($objekWisatas as $index => $wisata)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ Str::limit($wisata->nama_wisata, 20) }}</td>
                        <td>{{ $wisata->kategoriWisata->kategori_wisata ?? '-' }}</td>
                        @for($i = 1; $i <= 5; $i++)
                            @php $foto='foto' .$i; @endphp
                            <td>
                            @if ($wisata->$foto)
                            <img src="{{ asset('storage/' . $wisata->$foto) }}" alt="Foto {{$i}}" class="img-thumbnail" width="100" style="cursor: pointer" onclick="showImageModal('{{ asset('storage/' . $wisata->$foto) }}')">
                            @else
                            <img src="{{ asset('images/default-wisata.png') }}" alt="Default {{$i}}" class="img-thumbnail" width="100" style="cursor: pointer" onclick="showImageModal('{{ asset('images/default-wisata.png') }}')">
                            @endif
                            </td>
                            @endfor
                            <td>{{ Str::limit($wisata->deskripsi_wisata, 30) }}</td>
                            <td>{{ Str::limit($wisata->fasilitas, 30) }}</td>
                            <td>
                                <a href="{{ route('obyek_wisata.edit', $wisata->id) }}"
                                    class="btn btn-sm btn-warning">
                                    <i class="fa fa-pencil-square-o"></i> Edit
                                </a>
                                <form action="{{ route('obyek_wisata.destroy', $wisata->id) }}"
                                    method="POST" class="d-inline" id="deleteForm-{{ $wisata->id }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger delete-btn"
                                        data-id="{{ $wisata->id }}">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $objekWisatas->links() }}
        </div>

        @if($objekWisatas->isEmpty())
        <div class="alert alert-info text-center mt-3">
            Tidak ada data Objek wisata tersedia
        </div>
        @endif
    </div>
</div>

<!-- Modal for Image Preview -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="Preview">
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
    // Fungsi untuk menampilkan modal preview gambar
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
    });

    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm' + id).submit();
            }
        });
    }
</script>
@endsection