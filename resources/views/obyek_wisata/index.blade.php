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
    <div class="container-fluid">

        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Daftar Obyek Wisata</h4>
                        <a href="{{ route('obyek_wisata.create') }}" class="btn btn-primary mb-3">Tambah Obyek Wisata</a> <!-- Add button -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Wisata</th>
                                        <th>Deskripsi</th>
                                        <th>Kategori</th>
                                        <th>Fasilitas</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Loop data obyek wisata --}}
                                    @foreach($obyek_wisata as $wisata)
                                    <tr>
                                        <td>{{ $wisata->id }}</td>
                                        <td>{{ $wisata->nama_wisata }}</td>
                                        <td>{{ $wisata->deskripsi_wisata }}</td>
                                        <td>{{ $wisata->kategori_wisata }}</td>
                                        <td>{{ $wisata->fasilitas }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $wisata->foto1) }}" alt="Foto 1" width="50">
                                            <img src="{{ asset('storage/' . $wisata->foto2) }}" alt="Foto 2" width="50">
                                            <img src="{{ asset('storage/' . $wisata->foto3) }}" alt="Foto 3" width="50">
                                            <img src="{{ asset('storage/' . $wisata->foto4) }}" alt="Foto 4" width="50">
                                            <img src="{{ asset('storage/' . $wisata->foto5) }}" alt="Foto 5" width="50">
                                        </td>
                                        <td>
                                            <a href="{{ route('obyek_wisata.edit', $wisata->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('obyek_wisata.destroy', $wisata->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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
        </div><!--End Row-->

    </div>
</div>

@endsection