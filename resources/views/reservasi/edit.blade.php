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
        <h1 class="mb-4">Edit Reservasi</h1>

        <div class="card mb-4">
            <div class="card-header">Form Edit Reservasi</div>
            <div class="card-body">
                <form action="{{ route('reservasi.update', $reservasi->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="id_pelanggan">Pelanggan</label>
                        <select name="id_pelanggan" id="id_pelanggan" class="form-control" required>
                            @foreach($pelanggan as $p)
                            <option value="{{ $p->id }}" {{ $reservasi->id_pelanggan == $p->id ? 'selected' : '' }}>
                                {{ $p->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_paket">Paket Wisata</label>
                        <select name="id_paket" id="id_paket" class="form-control" required>
                            @foreach($paket as $p)
                            <option value="{{ $p->id }}" {{ $reservasi->id_paket == $p->id ? 'selected' : '' }}>
                                {{ $p->nama_paket }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tgl_reservasi_wisata">Tanggal Reservasi</label>
                        <input type="date" name="tgl_reservasi_wisata" id="tgl_reservasi_wisata" class="form-control" value="{{ $reservasi->tgl_reservasi_wisata }}" required>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_peserta">Jumlah Peserta</label>
                        <input type="number" name="jumlah_peserta" id="jumlah_peserta" class="form-control" value="{{ $reservasi->jumlah_peserta }}" required>
                    </div>
                    <div class="form-group">
                        <label for="diskon">Diskon (%)</label>
                        <input type="number" name="diskon" id="diskon" class="form-control" value="{{ $reservasi->diskon }}">
                    </div>
                    <div class="form-group">
                        <label for="total_bayar">Total Bayar</label>
                        <input type="number" name="total_bayar" id="total_bayar" class="form-control" value="{{ $reservasi->total_bayar }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection