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
                        <h4 class="card-title">Tambah Obyek Wisata</h4>
                        <form action="{{ route('obyek_wisata.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nama_wisata">Nama Wisata</label>
                                <input type="text" name="nama_wisata" id="nama_wisata" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_wisata">Deskripsi Wisata</label>
                                <textarea name="deskripsi_wisata" id="deskripsi_wisata" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="kategori_wisata">Kategori Wisata</label>
                                <select name="kategori_wisata" id="kategori_wisata" class="form-control" required>
                                    <option value="">Pilih Kategori</option>
                                    {{-- Loop kategori wisata --}}
                                    @foreach($kategori_wisata as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->kategori_wisata }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fasilitas">Fasilitas</label>
                                <textarea name="fasilitas" id="fasilitas" class="form-control" rows="3" required></textarea>
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
                            <a href="{{ route('obyek_wisata.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--End Row-->

    </div>
</div>

@endsection