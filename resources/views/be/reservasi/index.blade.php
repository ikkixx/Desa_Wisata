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
        <h1 class="mb-4">Manajemen Reservasi</h1>

        <!-- Tambah Button -->
        @if(auth()->user()->level !== 'owner')
        <a href="{{ route('reservasi.create') }}" class="btn btn-primary mb-4">Tambah Reservasi</a>
        @endif

        <!-- Existing table for reservations -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Paket Wisata</th>
                    <th>Tanggal Reservasi</th>
                    <th>Jumlah Peserta</th>
                    <th>Harga</th>
                    <th>Diskon</th>
                    <th>Total Bayar</th>
                    <th>Status</th>
                    <th>Bukti Transfer</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservasi as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->pelanggan->nama }}</td>
                    <td>{{ $item->paket->nama_paket }}</td>
                    <td>{{ $item->tgl_reservasi_wisata }}</td>
                    <td>{{ $item->jumlah_peserta }}</td>
                    <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>{{ $item->nilai_diskon }}%</td>
                    <td>{{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($item->status_reservasi_wisata) }}</td>
                    <td>
                        @if($item->file_bukti_tf)
                        <a href="{{ asset('storage/' . $item->file_bukti_tf) }}" target="_blank">Lihat</a>
                        @else
                        Tidak ada
                        @endif
                    </td>
                    <td>
                        @if(auth()->user()->level !== 'owner')
                        <a href="{{ route('reservasi.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('reservasi.destroy', $item->id) }}" method="POST" style="display:inline;">
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
</div>
@endsection