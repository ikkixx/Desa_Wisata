@extends('be.master')
@section('sidebar')
@include('be.sidebar')
@endsection
@section('header')
@include('be.header')
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Menghapus elemen pembungkus tambahan dan menambahkan kelas 'w-100' pada tabel -->
    <div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Daftar Penginapan</h5>
                <div class="table-responsive">
                    <table class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Penginapan</th>
                                <th scope="col">Lokasi</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Contoh data -->
                            <tr>
                                <th scope="row">1</th>
                                <td>Hotel Mawar</td>
                                <td>Jakarta</td>
                                <td>Rp 500.000</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Detail</button>
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Villa Anggrek</td>
                                <td>Bali</td>
                                <td>Rp 1.200.000</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Detail</button>
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </td>
                            </tr>
                            <!-- Tambahkan data lainnya -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection