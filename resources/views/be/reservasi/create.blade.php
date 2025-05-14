@extends('be.master')
@section('sidebar')
@include('be.sidebar')
@endsection
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Reservasi</h4>
                        <p class="card-description">Form Tambah Data Reservasi</p>

                        <form class="forms-sample" method="POST" action="{{ route('reservasi.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="id_pelanggan">Pelanggan</label>
                                <select class="form-control" id="id_pelanggan" name="id_pelanggan" required>
                                    <option value="" disabled selected>Pilih Pelanggan</option>
                                    @foreach($pelanggans as $pelanggan)
                                    <option value="{{ $pelanggan->id }}" {{ old('id_pelanggan') == $pelanggan->id ? 'selected' : '' }}>
                                        {{ $pelanggan->nama_lengkap }} ({{ $pelanggan->no_hp }})
                                    </option>
                                    @endforeach
                                </select>
                                @error('id_pelanggan')
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="id_paket">Paket Wisata</label>
                                <select class="form-control" id="id_paket" name="id_paket" required>
                                    <option value="" disabled selected>Pilih Paket Wisata</option>
                                    @foreach($pakets as $paket)
                                    <option value="{{ $paket->id }}" data-harga="{{ $paket->harga_per_pack }}" {{ old('id_paket') == $paket->id ? 'selected' : '' }}>
                                        {{ $paket->nama_paket }} (Rp {{ number_format($paket->harga_per_pack, 0, ',', '.') }})
                                    </option>
                                    @endforeach
                                </select>
                                @error('id_paket')
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tgl_reservasi">Tanggal Reservasi</label>
                                <input type="datetime-local" class="form-control" id="tgl_reservasi" name="tgl_reservasi" value="{{ old('tgl_reservasi') }}" required>
                                @error('tgl_reservasi')
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="jumlah_peserta">Jumlah Peserta</label>
                                <input type="number" class="form-control" id="jumlah_peserta" name="jumlah_peserta" min="1" value="{{ old('jumlah_peserta', 1) }}" required>
                                @error('jumlah_peserta')
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="harga">Harga Paket</label>
                                <input type="text" class="form-control" id="harga_display" readonly>
                                <input type="hidden" name="harga" id="harga_nilai">
                            </div>

                            <div class="form-group">
                                <label for="diskon">Diskon (%)</label>
                                <input type="number" class="form-control" id="diskon" name="diskon" min="0" max="100" value="{{ old('diskon', 0) }}">
                                @error('diskon')
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nilai_diskon">Nilai Diskon (Rp)</label>
                                <input type="text" class="form-control" id="nilai_diskon_display" readonly>
                                <input type="hidden" name="nilai_diskon" id="nilai_diskon_nilai">
                            </div>

                            <div class="form-group">
                                <label for="total_bayar">Total Bayar</label>
                                <input type="text" class="form-control" id="total_bayar_display" readonly>
                                <input type="hidden" name="total_bayar" id="total_bayar_nilai">
                            </div>

                            <div class="form-group">
                                <label for="status_reservasi">Status Reservasi</label>
                                <select class="form-control" id="status_reservasi" name="status_reservasi" required>
                                    <option value="pesan" {{ old('status_reservasi') == 'pesan' ? 'selected' : '' }}>Pesan</option>
                                    <option value="dibayar" {{ old('status_reservasi') == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                                    <option value="selesai" {{ old('status_reservasi') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                                @error('status_reservasi')
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="file_bukti_tf">Upload Bukti Transfer</label>
                                <input type="file" class="form-control" id="file_bukti_tf" name="file_bukti_tf">
                                @error('file_bukti_tf')
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                            <a href="{{ route('reservasi.manage') }}" class="btn btn-light">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paketSelect = document.getElementById('id_paket');
        const jumlahPeserta = document.getElementById('jumlah_peserta');
        const diskonInput = document.getElementById('diskon');
        const hargaDisplay = document.getElementById('harga_display');
        const hargaNilai = document.getElementById('harga_nilai');
        const nilaiDiskonDisplay = document.getElementById('nilai_diskon_display');
        const nilaiDiskonNilai = document.getElementById('nilai_diskon_nilai');
        const totalBayarDisplay = document.getElementById('total_bayar_display');
        const totalBayarNilai = document.getElementById('total_bayar_nilai');

        function formatRupiah(angka) {
            return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function calculateTotal() {
            const selectedOption = paketSelect.options[paketSelect.selectedIndex];
            const harga = selectedOption ? parseFloat(selectedOption.dataset.harga) || 0 : 0;
            const peserta = parseInt(jumlahPeserta.value) || 0;
            const diskon = parseFloat(diskonInput.value) || 0;

            const subtotal = harga * peserta;
            const nilaiDiskon = subtotal * (diskon / 100);
            const total = subtotal - nilaiDiskon;

            // Update nilai
            hargaNilai.value = harga;
            nilaiDiskonNilai.value = nilaiDiskon;
            totalBayarNilai.value = total;

            // Update tampilan
            hargaDisplay.value = formatRupiah(harga);
            nilaiDiskonDisplay.value = formatRupiah(nilaiDiskon);
            totalBayarDisplay.value = formatRupiah(total);
        }

        // Event listeners
        paketSelect.addEventListener('change', calculateTotal);
        jumlahPeserta.addEventListener('input', calculateTotal);
        diskonInput.addEventListener('input', calculateTotal);

        // Initial calculation
        calculateTotal();
    });
</script>
@endsection