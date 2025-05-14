@extends('be.master')
@section('header')
@include('be.header')
@endsection
@section('sidebar')
@include('be.sidebar')
@endsection

@section('content')
<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid"></div>
    <div class="container">
        <!-- Header Section -->
        <h1 class="mb-3">Manajemen Pengguna</h1>
        
        <!-- Tombol Tambah di kiri bawah judul -->
        @if(auth()->user()->level !== 'owner')
        <div class="mb-4">
            <a href="{{ route('user.create') }}" class="btn btn-primary">
                Tambah Pengguna
            </a>
        </div>
        @endif

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="alert alert-success d-none" id="success-alert">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger d-none" id="error-alert">
            {{ session('error') }}
        </div>
        @endif

        <!-- Main Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Role</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                <tbody>
                    @foreach ($users as $nmr => $data)
                    <tr>
                        <td>{{ $nmr + 1 }}</td>
                        <td>
                            @php
                            $photo = null;
                            if ($data->level == 'pelanggan' && $data->pelanggan && $data->pelanggan->foto) {
                                $photo = asset('storage/' . $data->pelanggan->foto);
                            } elseif ($data->karyawan && $data->karyawan->foto) {
                                $photo = asset('storage/' . $data->karyawan->foto);
                            } else {
                                $photo = asset('images/default-user.png');
                            }
                            @endphp
                            <img src="{{ $photo }}"
                                alt="Foto Pengguna"
                                class="rounded-circle border"
                                width="40"
                                height="40"
                                style="cursor:pointer; object-fit: cover;"
                                onclick="showImgPreview('{{ $photo }}')">
                        </td>
                        <td>{{ $data['name'] }}</td>
                        <td>{{ $data['email'] }}</td>
                        <td>{{ $data['no_hp'] ?? '-' }}</td>
                        <td>
                            {{ ucfirst($data['level']) }}
                            @if ($data['level'] === 'admin' || $data['level'] === 'bendahara' || $data['level'] === 'owner')
                            @php
                            $jabatan = \App\Models\Karyawan::where('id_user', $data->id)->first()?->jabatan;
                            @endphp
                            @if ($jabatan)
                            <br><small class="text-success">({{ ucfirst($jabatan) }})</small>
                            @endif
                            @endif
                        </td>
                        <td>
                            @if($data->level == 'pelanggan' && $data->pelanggan)
                            {{ Str::limit($data->pelanggan->alamat ?? '-', 20) }}
                            @elseif($data->karyawan)
                            {{ Str::limit($data->karyawan->alamat ?? '-', 20) }}
                            @else
                            -
                            @endif
                        </td>
                        <td>
                            @if($data['aktif'])
                            <span class="badge bg-success">Aktif</span>
                            @else
                            <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                                <a href="{{ route('user.edit', $data->id) }}"
                                    class="btn btn-sm btn-warning">
                                    <i class="fa fa-pencil-square-o"></i> Edit
                                </a>
                                <form action="{{ route('user.destroy', $data->id) }}"
                                    method="POST" class="d-inline" id="deleteForm-{{ $data->id }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger delete-btn"
                                        data-id="{{ $data->id }}">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($users->isEmpty())
        <div class="alert alert-info text-center mt-3">
            Tidak ada data pengguna tersedia
        </div>
        @endif
    </div>
</div>

<!-- Image Preview Modal -->
<div class="modal fade" id="imgPreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pratinjau Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="imgPreview" src="" alt="Preview" class="img-fluid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Function to show image preview
    function showImgPreview(src) {
        const modal = new bootstrap.Modal(document.getElementById('imgPreviewModal'));
        document.getElementById('imgPreview').src = src;
        modal.show();
    }

    // Function for delete confirmation
    function deleteConfirm(id) {
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
                document.getElementById('deleteForm' + id).submit();
            }
        });
    }

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
    });
</script>
@endsection