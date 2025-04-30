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
        <h1 class="mb-4">Manajemen Karyawan</h1>
        <a href="{{ route('karyawan.create') }}" class="btn btn-primary mb-3">Tambah Karyawan</a> <!-- Add button -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Karyawan</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Jabatan</th>
                    <th>Dibuat Pada</th>
                    <th>Diperbarui Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($karyawan as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama_karyawan }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->no_hp }}</td>
                    <td>{{ $item->jabatan }}</td>
                    <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                    <td>{{ $item->updated_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <a href="{{ route('karyawan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('karyawan.destroy', $item->id) }}" method="POST" style="display:inline;">
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
@endsection