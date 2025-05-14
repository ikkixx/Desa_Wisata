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

                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Oops!</strong> Ada kesalahan dalam input:<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('reservasi.update', $reservasi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Input Hidden untuk Data yang Diperlukan -->
                    <input type="hidden" name="harga" id="harga_nilai" value="{{ $reservasi->harga }}">
                    <input type="hidden" name="nilai_diskon" id="nilai_diskon_nilai" value="{{ $reservasi->nilai_diskon }}">

                    <!-- Field Pelanggan -->
                    <div class="form-group">
                        <label for="id_pelanggan">Pelanggan</label>
                        <select class="form-control" name="id_pelanggan" id="id_pelanggan" required>
                            <option value="" disabled>Pilih Pelanggan</option>
                            @foreach($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->id }}" {{ $reservasi->id_pelanggan == $pelanggan->id ? 'selected' : '' }}>
                                {{ $pelanggan->nama_lengkap }} ({{ $pelanggan->no_hp }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Field Paket Wisata -->
                    <div class="form-group">
                        <label for="id_paket">Paket Wisata</label>
                        <select name="id_paket" id="id_paket" class="form-control" required>
                            @foreach($pakets as $p)
                            <option value="{{ $p->id }}" data-harga="{{ $p->harga_per_pack }}" {{ $reservasi->id_paket == $p->id ? 'selected' : '' }}>
                                {{ $p->nama_paket }} (Rp {{ number_format($p->harga_per_pack, 0, ',', '.') }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Field Tanggal Reservasi -->
                    <div class="form-group">
                        <label for="tgl_reservasi">Tanggal Reservasi</label>
                        <input type="datetime-local" class="form-control" id="tgl_reservasi" name="tgl_reservasi" 
                            value="{{ \Carbon\Carbon::parse($reservasi->tgl_reservasi)->format('Y-m-d\TH:i') }}" required>
                    </div>

                    <!-- Field Jumlah Peserta -->
                    <div class="form-group">
                        <label for="jumlah_peserta">Jumlah Peserta</label>
                        <input type="number" name="jumlah_peserta" id="jumlah_peserta" class="form-control"
                            value="{{ $reservasi->jumlah_peserta }}" min="1" required>
                    </div>

                    <!-- Field Diskon -->
                    <div class="form-group">
                        <label for="diskon">Diskon (%)</label>
                        <input type="number" name="diskon" id="diskon" class="form-control" 
                            value="{{ $reservasi->diskon ?? 0 }}" min="0" max="100">
                    </div>

                    <!-- Field Nilai Diskon -->
                    <div class="form-group">
                        <label for="nilai_diskon">Nilai Diskon (Rp)</label>
                        <input type="text" class="form-control" id="nilai_diskon_display" readonly 
                            value="Rp {{ number_format($reservasi->nilai_diskon, 0, ',', '.') }}">
                    </div>

                    <!-- Field Total Bayar -->
                    <div class="form-group">
                        <label for="total_bayar">Total Bayar (Rp)</label>
                        <input type="text" class="form-control" id="total_bayar_display" readonly 
                            value="Rp {{ number_format($reservasi->total_bayar, 0, ',', '.') }}">
                        <input type="hidden" name="total_bayar" id="total_bayar_nilai" value="{{ $reservasi->total_bayar }}">
                    </div>

                    <!-- Field Status Reservasi -->
                    <div class="form-group">
                        <label for="status_reservasi">Status Reservasi</label>
                        <select name="status_reservasi" id="status_reservasi" class="form-control" required>
                            <option value="pesan" {{ $reservasi->status_reservasi == 'pesan' ? 'selected' : '' }}>Pesan</option>
                            <option value="dibayar" {{ $reservasi->status_reservasi == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                            <option value="selesai" {{ $reservasi->status_reservasi == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <!-- Field Bukti Transfer -->
                    <div class="form-group">
                        <label for="file_bukti_tf">Bukti Transfer</label>
                        <input type="file" name="file_bukti_tf" id="file_bukti_tf" class="form-control">
                        @if($reservasi->file_bukti_tf)
                        <div class="mt-2">
                            <small>File saat ini:
                                <a href="{{ asset('storage/' . $reservasi->file_bukti_tf) }}" target="_blank">
                                    {{ basename($reservasi->file_bukti_tf) }}
                                </a>
                            </small>
                        </div>
                        @endif
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary mr-2">Simpan Perubahan</button>
                        <a href="{{ route('reservasi.manage') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk Hitung Otomatis -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paketSelect = document.getElementById('id_paket');
        const jumlahPeserta = document.getElementById('jumlah_peserta');
        const diskonInput = document.getElementById('diskon');
        const totalBayarDisplay = document.getElementById('total_bayar_display');
        const totalBayarNilai = document.getElementById('total_bayar_nilai');
        const nilaiDiskonDisplay = document.getElementById('nilai_diskon_display');
        const nilaiDiskonNilai = document.getElementById('nilai_diskon_nilai');
        const hargaNilai = document.getElementById('harga_nilai');

        function formatRupiah(angka) {
            return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function calculateTotal() {
            const harga = parseFloat(hargaNilai.value) || 0;
            const peserta = parseInt(jumlahPeserta.value) || 0;
            const diskon = parseFloat(diskonInput.value) || 0;

            const subtotal = harga * peserta;
            const nilaiDiskon = subtotal * (diskon / 100);
            const total = subtotal - nilaiDiskon;

            // Update nilai hidden
            nilaiDiskonNilai.value = nilaiDiskon;
            totalBayarNilai.value = total;

            // Update tampilan
            nilaiDiskonDisplay.value = formatRupiah(nilaiDiskon);
            totalBayarDisplay.value = formatRupiah(total);
        }

        // Event listeners
        jumlahPeserta.addEventListener('input', calculateTotal);
        diskonInput.addEventListener('input', calculateTotal);

        // Hitung saat pertama kali load
        calculateTotal();
    });
</script>
@endsection