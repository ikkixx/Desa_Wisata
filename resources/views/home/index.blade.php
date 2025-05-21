@extends('fe.master')
@section('slider')
@include('fe.slider')
@endsection

@section('header')
@include('fe.header')
@endsection

@section('penginapan')
@include('fe.penginapan')
@endsection

@section('obyek')
@include('fe.obyek')
@endsection

@section('paket')
@include('fe.paket')
@endsection

@section('berita')
@include('fe.berita')
@endsection

@section('content')
<div class="container">
    <!-- Hero Section -->
    <!-- <section class="hero-section mb-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-4 fw-bold">Selamat Datang di Desa Wisata Kami</h1>
                <p class="lead">Temukan pengalaman wisata yang tak terlupakan dengan paket lengkap dan penginapan nyaman</p>
                <a href="#paket-wisata" class="btn btn-primary btn-lg">Jelajahi Paket Wisata</a>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('fe/images/wisata-hero.jpg') }}" alt="Desa Wisata" class="img-fluid rounded">
            </div>
        </div>
    </section> -->

    <!-- Paket Wisata Section -->
    <!-- <section id="paket-wisata" class="mb-5">
        <h2 class="text-center mb-4">Paket Wisata Unggulan</h2>
        <div class="row">
            @foreach($paketWisatas as $paket)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $paket->foto1) }}" class="card-img-top" alt="{{ $paket->name_paket }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $paket->name_paket }}</h5>
                        <p class="card-text">{{ Str::limit($paket->deskripsi, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-primary fw-bold">Rp {{ number_format($paket->harga_per_pack, 0, ',', '.') }}</span>
                            <a href="{{ route('paket_wisata.detail', $paket->id) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('paket_wisata.index') }}" class="btn btn-primary">Lihat Semua Paket</a>
        </div>
    </section> -->

    <!-- Obyek Wisata Section -->
    <!-- <section id="obyek-wisata" class="mb-5">
        <h2 class="text-center mb-4">Destinasi Wisata</h2>
        <div class="row">
            @foreach($obyekWisatas as $wisata)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $wisata->foto1) }}" class="card-img-top" alt="{{ $wisata->name_wisata }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $wisata->name_wisata }}</h5>
                        <p class="card-text">{{ Str::limit($wisata->deskripsi_wisata, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-secondary">{{ $wisata->kategori->nama_kategori ?? 'Umum' }}</span>
                            <a href="{{ route('obyek_wisata.detail', $wisata->id) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('obyek_wisata.index') }}" class="btn btn-primary">Lihat Semua Destinasi</a>
        </div>
    </section> -->

    <!-- Penginapan Section -->
    <!-- <section id="penginapan" class="mb-5">
        <h2 class="text-center mb-4">Penginapan Tersedia</h2>
        <div class="row">
            @foreach($penginapans as $penginapan)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $penginapan->foto1) }}" class="card-img-top" alt="{{ $penginapan->name_penginapan }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $penginapan->name_penginapan }}</h5>
                        <p class="card-text">{{ Str::limit($penginapan->deskripsi, 100) }}</p>
                        <a href="{{ route('nginap_wisata.detail', $penginapan->id) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('nginap_wisata.index') }}" class="btn btn-primary">Lihat Semua Penginapan</a>
        </div>
    </section> -->

    <!-- Berita Section
    <section id="berita" class="mb-5">
        <h2 class="text-center mb-4">Berita Terkini</h2>
        <div class="row">
            @foreach($beritas as $berita)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($berita->foto)
                    <img src="{{ asset('storage/' . $berita->foto) }}" class="card-img-top" alt="{{ $berita->judul }}" style="height: 200px; object-fit: cover;">
                    @else
                    <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                        <span class="text-white">No Image</span>
                    </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $berita->judul }}</h5>
                        @if($berita->kategori)
                        <span class="badge bg-primary mb-2">{{ $berita->kategori->nama_kategori }}</span>
                        @endif
                        <p class="card-text">{{ Str::limit(strip_tags($berita->berita), 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                {{ $berita->tgl_post->isoFormat('D MMMM Y') }}
                            </small>
                            <a href="{{ route('berita_wisata.detail', $berita->id) }}" class="btn btn-sm btn-outline-primary">Baca</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('berita_wisata.index') }}" class="btn btn-primary">Lihat Semua Berita</a>
        </div>
    </section> -->
</div>
@endsection

@section('client')
@include('fe.client')
@endsection

@section('contact_us')
@include('fe.contact_us')
@endsection