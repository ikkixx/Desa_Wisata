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
        <h1 class="mb-4">Tambah Reservasi</h1>

        <div class="card mb-4">
            <div class="card-header">Form Tambah Reservasi</div>
            <div class="card-body">
                <form action="{{ route('reservasi.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="id_pelanggan">Pelanggan</label>
                        <select name="id_pelanggan" id="id_pelanggan" class="form-control" required>
                            <option value="" disabled selected>Pilih Pelanggan</option>
                            @foreach($pelanggan as $p)
                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_paket">Paket Wisata</label>
                        <select name="id_paket" id="id_paket" class="form-control" required>
                            <option value="" disabled selected>Pilih Paket Wisata</option>
                            @foreach($paket as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_paket }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tgl_reservasi_wisata">Tanggal Reservasi</label>
                        <input type="date" name="tgl_reservasi_wisata" id="tgl_reservasi_wisata" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_peserta">Jumlah Peserta</label>
                        <input type="number" name="jumlah_peserta" id="jumlah_peserta" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="diskon">Diskon (%)</label>
                        <input type="number" name="diskon" id="diskon" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="total_bayar">Total Bayar</label>
                        <input type="number" name="total_bayar" id="total_bayar" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection