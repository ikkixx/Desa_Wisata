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
        <h1 class="mb-4">Daftar Paket Wisata</h1>
        @if(auth()->user()->level !== 'owner')
        <a href="{{ route('paket_wisata.create') }}" class="btn btn-primary mb-3">Tambah Paket Wisata</a> <!-- Corrected route name -->
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Paket</th>
                    <th>Deskripsi</th>
                    <th>Fasilitas</th>
                    <th>Harga per Pack</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paketWisata as $paket)
                <tr>
                    <td>{{ $paket->id }}</td>
                    <td>{{ $paket->nama_paket }}</td>
                    <td>{{ $paket->deskripsi }}</td>
                    <td>{{ $paket->fasilitas }}</td>
                    <td>{{ number_format($paket->harga_per_pack, 0, ',', '.') }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $paket->foto1) }}" alt="Foto 1" width="50">
                    </td>
                    <td>
                        @if(auth()->user()->level !== 'owner')
                        <a href="{{ route('paket_wisata.edit', $paket->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('paket_wisata.destroy', $paket->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection