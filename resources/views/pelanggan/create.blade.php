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
        <h1 class="mb-4">Tambah Pelanggan</h1>
        <form action="{{ route('pelanggan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="no_hp">No HP</label>
                <input type="text" name="no_hp" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Batal</a> <!-- Add Batal button -->
        </form>
    </div>
</div>
@endsection