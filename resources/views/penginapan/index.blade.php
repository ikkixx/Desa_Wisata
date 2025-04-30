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
                        <h4 class="card-title">Daftar Penginapan</h4>
                        <a href="{{ route('penginapan.create') }}" class="btn btn-primary mb-3">Tambah Penginapan</a> <!-- Add button -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Penginapan</th>
                                        <th>Deskripsi</th>
                                        <th>Fasilitas</th>
                                        <th>Foto</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Loop data penginapan --}}
                                    @foreach($penginapan as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nama_penginapan }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>{{ $item->fasilitas }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $item->foto1) }}" alt="Foto 1" width="50">
                                            <img src="{{ asset('storage/' . $item->foto2) }}" alt="Foto 2" width="50">
                                            <img src="{{ asset('storage/' . $item->foto3) }}" alt="Foto 3" width="50">
                                            <img src="{{ asset('storage/' . $item->foto4) }}" alt="Foto 4" width="50">
                                            <img src="{{ asset('storage/' . $item->foto5) }}" alt="Foto 5" width="50">
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('penginapan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('penginapan.destroy', $item->id) }}" method="POST" style="display:inline;">
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