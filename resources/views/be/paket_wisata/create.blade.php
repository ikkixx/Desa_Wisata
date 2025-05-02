@extends('be.master') <!-- Ensure this file exists in resources\views\be\master.blade.php -->
@section('sidebar')
@include('be.sidebar') <!-- Ensure this file exists in resources\views\be\sidebar.blade.php -->
@endsection
@section('header')
@include('be.header') <!-- Ensure this file exists in resources\views\be\header.blade.php -->
@endsection
@section('content')
<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid"></div>
<div class="container">
    <h1 class="mb-4">Tambah Paket Wisata</h1>
    <form action="{{ route('paket_wisata.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nama_paket">Nama Paket</label>
            <input type="text" name="nama_paket" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="fasilitas">Fasilitas</label>
            <textarea name="fasilitas" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="harga_per_pack">Harga per Pack</label>
            <input type="number" name="harga_per_pack" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="foto1">Foto</label>
            <input type="file" name="foto1" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection