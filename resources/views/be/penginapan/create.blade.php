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
        <h1>Tambah Penginapan Baru</h1>
        <form action="{{ route('penginapan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama_penginapan">Nama Penginapan</label>
                <input type="text" class="form-control" id="nama_penginapan"
                    name="nama_penginapan" placeholder="Masukkan nama penginapan" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi"
                    rows="4" placeholder="Deskripsi lengkap penginapan" required></textarea>
            </div>

            <div class="form-group">
                <label for="fasilitas">Fasilitas</label>
                <textarea class="form-control" id="fasilitas" name="fasilitas"
                    rows="3" placeholder="Daftar fasilitas penginapan" required></textarea>
            </div>

            <div class="form-group">
                <label>Upload Foto</label>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="foto1">Foto Utama (Wajib)</label>
                        <input type="file" class="form-control-file"
                            id="foto1" name="foto1" required>
                    </div>
                    @for($i = 2; $i <= 5; $i++)
                        <div class="col-md-4 mb-3">
                        <label for="foto{{$i}}">Foto {{$i}} (Opsional)</label>
                        <input type="file" class="form-control-file"
                            id="foto{{$i}}" name="foto{{$i}}">
                </div>
                @endfor
            </div>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('penginapan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
</div>
@endsection