@extends('be.master')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Paket Wisata</h1>
    <form action="{{ route('paket-wisata.update', $paket->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_paket">Nama Paket</label>
            <input type="text" name="nama_paket" class="form-control" value="{{ $paket->nama_paket }}" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required>{{ $paket->deskripsi }}</textarea>
        </div>
        <div class="form-group">
            <label for="fasilitas">Fasilitas</label>
            <textarea name="fasilitas" class="form-control" required>{{ $paket->fasilitas }}</textarea>
        </div>
        <div class="form-group">
            <label for="harga_per_pack">Harga per Pack</label>
            <input type="number" name="harga_per_pack" class="form-control" value="{{ $paket->harga_per_pack }}" required>
        </div>
        <div class="form-group">
            <label for="foto1">Foto</label>
            <input type="file" name="foto1" class="form-control">
            <img src="{{ asset('storage/' . $paket->foto1) }}" alt="Foto 1" width="100">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection