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
                        <h4 class="card-title">Edit Penginapan</h4>
                        <form action="{{ route('penginapan.update', $penginapan->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama_penginapan">Nama Penginapan</label>
                                <input type="text" name="nama_penginapan" id="nama_penginapan" class="form-control" value="{{ $penginapan->nama_penginapan }}" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required>{{ $penginapan->deskripsi }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="fasilitas">Fasilitas</label>
                                <textarea name="fasilitas" id="fasilitas" class="form-control" rows="3" required>{{ $penginapan->fasilitas }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="foto1">Foto 1</label>
                                <input type="file" name="foto1" id="foto1" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="foto2">Foto 2</label>
                                <input type="file" name="foto2" id="foto2" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="foto3">Foto 3</label>
                                <input type="file" name="foto3" id="foto3" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="foto4">Foto 4</label>
                                <input type="file" name="foto4" id="foto4" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="foto5">Foto 5</label>
                                <input type="file" name="foto5" id="foto5" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('penginapan.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--End Row-->

    </div>
</div>

@endsection