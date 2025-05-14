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
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Kategori Wisata</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('kategori_wisata.update', $kategori->id) }}" method="POST" enctype="multipart/form-data" id="editKategoriForm">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="kategori_wisata" class="col-sm-2 col-form-label">Nama Kategori <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('kategori_wisata') is-invalid @enderror"
                                id="kategori_wisata" name="kategori_wisata"
                                value="{{ old('kategori_wisata', $kategori->kategori_wisata) }}"
                                placeholder="Masukkan nama kategori" required>
                            @error('kategori_wisata')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="current_foto" class="col-sm-2 col-form-label">Foto Saat Ini</label>
                        <div class="col-sm-10">
                            @if($kategori->foto)
                            <img src="{{ asset('storage/' . $kategori->foto) }}" alt="Foto Kategori" class="img-thumbnail mb-2" width="150">
                            @else
                            <p class="text-muted">Tidak ada foto</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label">Ganti Foto</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('foto') is-invalid @enderror"
                                    id="foto" name="foto" accept="image/*">
                                <label class="custom-file-label" for="foto">Pilih file gambar baru</label>
                                @error('foto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">
                                Format: JPEG, PNG, JPG (Maksimal 2MB). Kosongkan jika tidak ingin mengubah foto.
                            </small>
                            <div class="mt-2" id="imagePreviewContainer" style="display: none;">
                                <img id="imagePreview" src="#" alt="Preview Gambar" class="img-thumbnail" style="max-height: 200px;">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                id="deskripsi" name="deskripsi" rows="5"
                                placeholder="Masukkan deskripsi lengkap tentang kategori wisata ini" required>{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                            @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('kategori_wisata.manage') }}" class="btn btn-secondary">
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
    // Preview image before upload
    document.getElementById('foto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
                document.getElementById('imagePreviewContainer').style.display = 'block';
            }
            reader.readAsDataURL(file);
            document.querySelector('.custom-file-label').textContent = file.name;
        } else {
            document.getElementById('imagePreviewContainer').style.display = 'none';
            document.querySelector('.custom-file-label').textContent = 'Pilih file gambar';
        }
    });

    // Form validation
    document.getElementById('editKategoriForm').addEventListener('submit', function(e) {
        const kategoriName = document.getElementById('kategori_wisata').value.trim();
        const deskripsi = document.getElementById('deskripsi').value.trim();

        if (!kategoriName || !deskripsi) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Harap lengkapi semua field yang wajib diisi!',
            });
        }
    });
</script>
@endsection