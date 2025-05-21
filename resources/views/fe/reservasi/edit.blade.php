{{-- filepath: resources/views/fe/reservasi/edit.blade.php --}}
@extends('fe.master')
@section('content')
<div class="container py-5">
    <h2>Edit Reservasi: {{ $paket->nama_paket }}</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('fe.reservasi.update', $reservasi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Nama Paket (readonly) --}}
        <div class="mb-3">
            <label class="form-label">Nama Paket</label>
            <input type="text" class="form-control" value="{{ $paket->nama_paket }}" readonly>
        </div>

        {{-- Tanggal Reservasi --}}
        <div class="mb-3">
            <label class="form-label">Tanggal Reservasi</label>
            <input type="datetime-local" name="tgl_reservasi" class="form-control" value="{{ old('tgl_reservasi', \Carbon\Carbon::parse($reservasi->tgl_reservasi)->format('Y-m-d\TH:i')) }}" required>
        </div>

        {{-- Jumlah Peserta --}}
        <div class="mb-3">
            <label class="form-label">Jumlah Peserta</label>
            <input type="number" name="jumlah_peserta" class="form-control" min="1" value="{{ old('jumlah_peserta', $reservasi->jumlah_peserta) }}" required>
        </div>

        {{-- Harga per Paket (readonly) --}}
        <div class="mb-3">
            <label class="form-label">Harga per Paket</label>
            <input type="text" id="harga" class="form-control" value="{{ $paket->harga_per_pack }}" readonly>
        </div>

        {{-- Nilai Diskon --}}
        <div class="mb-3">
            <label class="form-label">Nilai Diskon (opsional)</label>
            <input type="number" name="nilai_diskon" id="nilai_diskon" class="form-control" min="0" value="{{ old('nilai_diskon', $reservasi->nilai_diskon ?? 0) }}">
        </div>

        {{-- Total Bayar --}}
        <div class="mb-3">
            <label class="form-label">Total Bayar</label>
            <input type="text" name="total_bayar" id="total_bayar" class="form-control" value="{{ old('total_bayar', $reservasi->total_bayar) }}" readonly>
        </div>

        {{-- Bukti Transfer --}}
        <div class="mb-3">
            <label class="form-label">Upload Bukti Transfer (opsional)</label>
            <input type="file" name="file_bukti_tf" class="form-control">
            @if($reservasi->file_bukti_tf)
                <small class="text-muted">Bukti sebelumnya: <a href="{{ asset('storage/'.$reservasi->file_bukti_tf) }}" target="_blank">Lihat</a></small>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Reservasi</button>
    </form>
</div>
<script>
    const harga = {{ $paket->harga_per_pack }};
    const jumlahPesertaInput = document.querySelector('[name="jumlah_peserta"]');
    const diskonInput = document.getElementById('nilai_diskon');
    const totalBayarInput = document.getElementById('total_bayar');

    function updateTotal() {
        const jumlah = parseInt(jumlahPesertaInput.value) || 1;
        const diskon = parseInt(diskonInput.value) || 0;
        let total = (harga * jumlah) - diskon;
        if (total < 0) total = 0;
        totalBayarInput.value = total;
    }

    jumlahPesertaInput.addEventListener('input', updateTotal);
    diskonInput.addEventListener('input', updateTotal);
    updateTotal();
</script>
@endsection