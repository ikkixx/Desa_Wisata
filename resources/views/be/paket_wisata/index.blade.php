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
        <h1 class="mb-4">Daftar Paket Wisata</h1>

        @if(auth()->check() && auth()->user()->level !== 'owner')
        <a href="{{ route('paket_wisata.create') }}" class="btn btn-primary mb-3">Tambah Paket Wisata</a>
        @endif

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

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Paket</th>
                    <th>Deskripsi</th>
                    <th>Fasilitas</th>
                    <th>Harga per Pack</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paketWisata as $paket)
                <tr>
                    <td>{{ $paket->id }}</td>
                    <td>{{ $paket->nama_paket }}</td>
                    <td>{{ Str::limit($paket->deskripsi, 50) }}</td>
                    <td>{{ Str::limit($paket->fasilitas, 50) }}</td>
                    <td>Rp {{ number_format($paket->harga_per_pack, 0, ',', '.') }}</td>
                    <td>
                        @if($paket->foto1)
                        <img src="{{ asset('storage/' . $paket->foto1) }}"
                            alt="Paket Image"
                            class="img-thumbnail" width="100
                            style=" object-fit: cover; cursor: pointer;"
                            onclick="showImgPreview('{{ asset('storage/' . $paket->foto1) }}')">
                        @else
                        <span class="text-muted">No Image</span>
                        @endif
                        @if($paket->foto2)
                        <img src="{{ asset('storage/' . $paket->foto2) }}"
                            alt="Paket Image"
                            class="rounded"
                            width="60"
                            height="40"
                            style="object-fit: cover; cursor: pointer;"
                            onclick="showImgPreview('{{ asset('storage/' . $paket->foto2) }}')">
                        @else

                        @endif
                        @if($paket->foto3)
                        <img src="{{ asset('storage/' . $paket->foto3) }}"
                            alt="Paket Image"
                            class="rounded"
                            width="60"
                            height="40"
                            style="object-fit: cover; cursor: pointer;"
                            onclick="showImgPreview('{{ asset('storage/' . $paket->foto3) }}')">
                        @else

                        @endif
                        @if($paket->foto4)
                        <img src="{{ asset('storage/' . $paket->foto4) }}"
                            alt="Paket Image"
                            class="rounded"
                            width="60"
                            height="40"
                            style="object-fit: cover; cursor: pointer;"
                            onclick="showImgPreview('{{ asset('storage/' . $paket->foto4) }}')">
                        @else

                        @endif
                        @if($paket->foto5)
                        <img src="{{ asset('storage/' . $paket->foto5) }}"
                            alt="Paket Image"
                            class="rounded"
                            width="60"
                            height="40"
                            style="object-fit: cover; cursor: pointer;"
                            onclick="showImgPreview('{{ asset('storage/' . $paket->foto5) }}')">
                        @else

                        @endif
                    </td>
                    <td>
                        @if(auth()->check() && auth()->user()->level !== 'owner')
                        <a href="{{ route('paket_wisata.edit', $paket->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('paket_wisata.destroy', $paket->id) }}" method="POST" style="display:inline;" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
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