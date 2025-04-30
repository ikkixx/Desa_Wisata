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
                        <h4 class="card-title">Daftar Berita</h4>
                        <a href="{{ route('berita.create') }}" class="btn btn-primary mb-3">Tambah Berita</a> <!-- Add button -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Judul</th>
                                        <th>Berita</th>
                                        <th>Flag Post</th>
                                        <th>Kategori</th>
                                        <th>Foto</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Loop data berita --}}
                                    @foreach($berita as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ Str::limit($item->berita, 50) }}</td> <!-- Limit berita text -->
                                        <td>{{ $item->fgl_post }}</td>
                                        <td>{{ $item->kategori_berita->nama_kategori ?? '-' }}</td> <!-- Assuming relation -->
                                        <td>
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" width="50">
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('berita.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('berita.destroy', $item->id) }}" method="POST" style="display:inline;">
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