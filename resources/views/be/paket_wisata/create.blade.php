@extends('be.master')
@section('sidebar')
@include('be.sidebar')
@endsection
@section('header')
@include('be.header')
@endsection

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Paket Wisata Baru</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('paket_wisata.store') }}" method="POST" enctype="multipart/form-data" id="paketForm">
                    @csrf

                    <div class="form-group row">
                        <label for="nama_paket" class="col-sm-2 col-form-label">Nama Paket <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('nama_paket') is-invalid @enderror"
                                id="nama_paket" name="nama_paket"
                                value="{{ old('nama_paket') }}"
                                placeholder="Masukkan nama paket wisata" required>
                            @error('nama_paket')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                id="deskripsi" name="deskripsi" rows="3"
                                placeholder="Masukkan deskripsi lengkap tentang paket wisata ini" required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="fasilitas" class="col-sm-2 col-form-label">Fasilitas <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <textarea class="form-control @error('fasilitas') is-invalid @enderror"
                                id="fasilitas" name="fasilitas" rows="3"
                                placeholder="Masukkan fasilitas yang didapatkan dalam paket ini" required>{{ old('fasilitas') }}</textarea>
                            @error('fasilitas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="harga_per_pack" class="col-sm-2 col-form-label">Harga per Pack <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" class="form-control @error('harga_per_pack') is-invalid @enderror"
                                    id="harga_per_pack" name="harga_per_pack"
                                    value="{{ old('harga_per_pack') }}"
                                    placeholder="Masukkan harga paket" required>
                                @error('harga_per_pack')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">Harga dalam Rupiah (tanpa titik atau koma)</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="foto1" class="col-sm-2 col-form-label">Foto Utama <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('foto1') is-invalid @enderror"
                                    id="foto1" name="foto1" accept="image/*" required>
                                <label class="custom-file-label" for="foto1">Pilih file gambar</label>
                                @error('foto1')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">
                                Format: JPEG, PNG, JPG (Maksimal 2MB)
                            </small>
                            <div class="mt-2" id="imagePreviewContainer" style="display: none;">
                                <img id="imagePreview" src="#" alt="Preview Gambar" class="img-thumbnail" style="max-height: 200px;">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Paket
                            </button>
                            <a href="{{ route('paket_wisata.manage') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Success message
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: successAlert.textContent,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        }

        // Error message
        const errorAlert = document.getElementById('error-alert');
        if (errorAlert) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: errorAlert.textContent,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        }

        // Delete confirmation
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection