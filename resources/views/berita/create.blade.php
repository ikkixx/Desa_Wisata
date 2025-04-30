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
                        <h4 class="card-title">Tambah Berita</h4>
                        <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" name="judul" id="judul" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="berita">Isi Berita</label>
                                <textarea name="berita" id="berita" class="form-control" rows="5" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="fgl_post">Flag Post</label>
                                <input type="text" name="fgl_post" id="fgl_post" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="id_kategori_berita">Kategori Berita</label>
                                <select name="id_kategori_berita" id="id_kategori_berita" class="form-control" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategori_berita as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" name="foto" id="foto" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('berita.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--End Row-->

    </div>
</div>

@endsection