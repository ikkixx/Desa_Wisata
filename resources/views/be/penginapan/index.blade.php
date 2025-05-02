@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('header') @include('be.header') @endsection

@section('content')
<div class="content-wrapper">
    <div class="container">
        <h1>Edit Penginapan</h1>
        <form action="{{ route('penginapan.update', $penginapan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Penginapan</label>
                <input type="text" name="nama_penginapan"
                    class="form-control @error('nama_penginapan') is-invalid @enderror"
                    value="{{ old('nama_penginapan', $penginapan->nama_penginapan) }}" required>
                @error('nama_penginapan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" rows="4"
                    class="form-control @error('deskripsi') is-invalid @enderror"
                    required>{{ old('deskripsi', $penginapan->deskripsi) }}</textarea>
                @error('deskripsi')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Fasilitas</label>
                <textarea name="fasilitas" rows="3"
                    class="form-control @error('fasilitas') is-invalid @enderror"
                    required>{{ old('fasilitas', $penginapan->fasilitas) }}</textarea>
                @error('fasilitas')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Foto Penginapan</label>
                <div class="row">
                    @for($i = 1; $i <= 5; $i++)
                        <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                @if($penginapan["foto{$i}"])
                                <img src="{{ asset('storage/'.$penginapan["foto{$i}"]) }}"
                                    class="img-fluid mb-2"
                                    style="height: 150px; object-fit: cover;">
                                @endif

                                <input type="file" name="foto{{ $i }}" class="form-control mt-2">

                                @if($penginapan["foto{$i}"])
                                <div class="form-check mt-2">
                                    <input type="checkbox" name="hapus_foto{{ $i }}" id="hapus_foto{{ $i }}" class="form-check-input">
                                    <label for="hapus_foto{{ $i }}" class="form-check-label text-danger">Hapus Foto Ini</label>
                                </div>
                                @endif
                            </div>
                        </div>
                </div>
                @endfor
            </div>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('penginapan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</div>
@endsection