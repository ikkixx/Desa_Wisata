@extends('be.master') <!-- Ensure this file exists in resources\views\be\master.blade.php -->
@section('sidebar')
@include('be.sidebar') <!-- Ensure this file exists in resources\views\be\sidebar.blade.php -->
@endsection
@section('header')
@include('be.header') <!-- Ensure this file exists in resources\views\be\header.blade.php -->
@endsection
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid"></div>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Kategori Wisata</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('kategori_wisata.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="kategori_wisata">Nama Kategori</label>
                        <input type="text" class="form-control @error('kategori_wisata') is-invalid @enderror"
                            id="kategori_wisata" name="kategori_wisata"
                            value="{{ old('kategori_wisata') }}"
                            placeholder="Contoh: Wisata Alam" required>
                        @error('kategori_wisata')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('kategori_wisata.manage') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </form>
            </div>
        </div>
    </div>
    @endsection