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

                    <div class="form-group">
                                <label for="foto1">Main Image (Required)</label>
                                <input type="file" class="form-control" id="foto1" name="foto1" required>
                                @error('foto1')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="foto2">Additional Image 1 (Optional)</label>
                                <input type="file" class="form-control" id="foto2" name="foto2">
                                @error('foto2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="foto3">Additional Image 2 (Optional)</label>
                                <input type="file" class="form-control" id="foto3" name="foto3">
                                @error('foto3')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="foto4">Additional Image 3 (Optional)</label>
                                <input type="file" class="form-control" id="foto4" name="foto4">
                                @error('foto4')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="foto5">Additional Image 4 (Optional)</label>
                                <input type="file" class="form-control" id="foto5" name="foto5">
                                @error('foto5')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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

<script>
    // Preview gambar sebelum upload
    document.getElementById('foto1').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('imagePreview');
        const previewContainer = document.getElementById('imagePreviewContainer');
        const fileLabel = this.nextElementSibling;

        if (file) {
            // Update label nama file
            fileLabel.textContent = file.name;

            // Validasi tipe file
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!validTypes.includes(file.type)) {
                alert('Hanya file JPEG, PNG, atau JPG yang diizinkan');
                this.value = '';
                return;
            }

            // Validasi ukuran file (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB');
                this.value = '';
                return;
            }

            // Tampilkan preview gambar
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
            fileLabel.textContent = 'Pilih file gambar';
        }
    });
</script>
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