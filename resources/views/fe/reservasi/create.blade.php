@extends('fe.master')

@section('header')
@include('fe.header')
@endsection

@section('content')
<div class="reservation-container py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="reservation-card shadow-lg">
                    <div class="reservation-header bg-gradient-primary text-white">
                        <h2 class="mb-0"><i class="fas fa-calendar-check me-2"></i> Form Reservasi Paket Wisata</h2>
                    </div>
                    
                    <div class="reservation-body">
                        <form action="{{ route('reservasi.store') }}" method="POST" enctype="multipart/form-data" id="reservationForm">
                            @csrf
                            
                            <input type="hidden" name="id_paket" value="{{ $paket->id }}">
                            <input type="hidden" name="id_pelanggan" value="{{ $pelanggan->id }}">

                            <!-- Package Information Section -->
                            <div class="info-section mb-4 p-4 rounded-3 bg-light">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="info-item">
                                            <span class="info-label fw-bold">Paket Wisata:</span>
                                            <span class="info-value">{{ $paket->nama_paket }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="info-item">
                                            <span class="info-label fw-bold">Harga Paket:</span>
                                            <span class="info-value text-success">Rp {{ number_format($paket->harga_per_pack, 0, ',', '.') }}/orang</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="info-item">
                                            <span class="info-label fw-bold">Nama Pemesan:</span>
                                            <span class="info-value">{{ $pelanggan->nama_lengkap }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="info-item">
                                            <span class="info-label fw-bold">Kontak:</span>
                                            <span class="info-value">{{ $pelanggan->no_hp }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reservation Details Section -->
                            <div class="form-section">
                                <h5 class="section-title mb-4"><i class="fas fa-clipboard-list me-2"></i> Detail Reservasi</h5>
                                
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <label for="tgl_reservasi" class="form-label fw-bold">
                                            <i class="fas fa-calendar-day me-2"></i>Tanggal Reservasi
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            <input type="date" 
                                                class="form-control @error('tgl_reservasi') is-invalid @enderror" 
                                                id="tgl_reservasi" 
                                                name="tgl_reservasi" 
                                                min="{{ date('Y-m-d') }}"
                                                required>
                                        </div>
                                        @error('tgl_reservasi')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="jumlah_peserta" class="form-label fw-bold">
                                            <i class="fas fa-users me-2"></i>Jumlah Peserta
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="number" 
                                                class="form-control @error('jumlah_peserta') is-invalid @enderror" 
                                                id="jumlah_peserta" 
                                                name="jumlah_peserta" 
                                                min="1" 
                                                value="{{ old('jumlah_peserta', 1) }}"
                                                required>
                                        </div>
                                        @error('jumlah_peserta')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted mt-1 d-block">*Harga total akan dihitung otomatis</small>
                                    </div>
                                </div>

                                <!-- Payment Section -->
                                <div class="payment-section mb-4">
                                    <h5 class="section-title mb-4"><i class="fas fa-credit-card me-2"></i> Pembayaran</h5>
                                    
                                    <div class="mb-3">
                                        <label for="file_bukti_tf" class="form-label fw-bold">
                                            <i class="fas fa-receipt me-2"></i>Bukti Transfer
                                        </label>
                                        <div class="file-upload-container">
                                            <input type="file" 
                                                class="form-control @error('file_bukti_tf') is-invalid @enderror" 
                                                id="file_bukti_tf" 
                                                name="file_bukti_tf" 
                                                required 
                                                accept="image/jpeg,image/png">
                                            <div class="preview-container mt-2 d-none">
                                                <img id="filePreview" src="#" alt="Preview" class="img-thumbnail" style="max-height: 150px; display: none;">
                                            </div>
                                        </div>
                                        @error('file_bukti_tf')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Format: JPG/PNG (maks. 2MB)</div>
                                    </div>
                                    
                                    <div class="bank-info p-3 rounded-3 bg-light">
                                        <h6 class="fw-bold mb-3"><i class="fas fa-university me-2"></i> Rekening Pembayaran</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="info-item">
                                                    <span class="info-label">Bank:</span>
                                                    <span class="info-value">BRI</span>
                                                </div>
                                                <div class="info-item">
                                                    <span class="info-label">Nomor Rekening:</span>
                                                    <span class="info-value">1234-5678-9012</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-item">
                                                    <span class="info-label">Atas Nama:</span>
                                                    <span class="info-value">PT. Wisata Indonesia</span>
                                                </div>
                                                <div class="info-item">
                                                    <span class="info-label">Total Transfer:</span>
                                                    <span class="info-value fw-bold text-primary" id="totalPayment">Rp {{ number_format($paket->harga_per_pack, 0, ',', '.') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="action-buttons d-flex justify-content-between mt-4">
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary-gradient">
                                    <i class="fas fa-paper-plane me-2"></i> Konfirmasi Reservasi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Base Styles */
.reservation-container {
    font-family: 'Poppins', sans-serif;
    background-color: #f8f9fa;
}

.reservation-card {
    border-radius: 12px;
    overflow: hidden;
    border: none;
}

.reservation-header {
    padding: 1.5rem;
    border-radius: 12px 12px 0 0;
}

.reservation-body {
    padding: 2rem;
    background-color: white;
}

/* Info Section */
.info-section {
    border-left: 4px solid #3498db;
}

.info-item {
    display: flex;
    flex-direction: column;
}

.info-label {
    color: #6c757d;
    font-size: 0.9rem;
}

.info-value {
    font-size: 1rem;
    color: #212529;
}

/* Form Styles */
.section-title {
    color: #2c3e50;
    border-bottom: 2px solid #3498db;
    padding-bottom: 0.5rem;
    display: inline-block;
}

.form-control {
    padding: 0.75rem 1rem;
    border-radius: 8px;
    border: 1px solid #ced4da;
    transition: all 0.3s;
}

.form-control:focus {
    border-color: #3498db;
    box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
}

.input-group-text {
    background-color: #e9ecef;
    border-right: none;
}

/* Payment Section */
.bank-info {
    border: 1px dashed #3498db;
}

.file-upload-container {
    border: 2px dashed #dee2e6;
    padding: 1.5rem;
    border-radius: 8px;
    transition: all 0.3s;
}

.file-upload-container:hover {
    border-color: #3498db;
    background-color: #f8f9fa;
}

/* Buttons */
.btn-primary-gradient {
    background: linear-gradient(135deg, #3498db, #2ecc71);
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    color: white;
    font-weight: 600;
    transition: all 0.3s;
}

.btn-primary-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(46, 204, 113, 0.3);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .reservation-body {
        padding: 1.5rem;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 1rem;
    }
    
    .action-buttons .btn {
        width: 100%;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum date to today
    document.getElementById('tgl_reservasi').min = new Date().toISOString().split("T")[0];
    
    // Calculate total payment
    const hargaPaket = {{ $paket->harga_per_pack }};
    const jumlahPesertaInput = document.getElementById('jumlah_peserta');
    const totalPaymentElement = document.getElementById('totalPayment');
    
    function updateTotalPayment() {
        const jumlahPeserta = parseInt(jumlahPesertaInput.value) || 1;
        const total = hargaPaket * jumlahPeserta;
        totalPaymentElement.textContent = 'Rp ' + total.toLocaleString('id-ID');
    }
    
    jumlahPesertaInput.addEventListener('input', updateTotalPayment);
    updateTotalPayment();
    
    // File preview
    const fileInput = document.getElementById('file_bukti_tf');
    const previewContainer = document.querySelector('.preview-container');
    const filePreview = document.getElementById('filePreview');
    
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewContainer.classList.remove('d-none');
                filePreview.style.display = 'block';
                filePreview.src = e.target.result;
            }
            
            reader.readAsDataURL(file);
        }
    });
    
    // Form validation
    document.getElementById('reservationForm').addEventListener('submit', function(e) {
        const file = fileInput.files[0];
        if (file) {
            const fileSize = file.size / 1024 / 1024; // in MB
            if (fileSize > 2) {
                e.preventDefault();
                alert('Ukuran file maksimal 2MB');
                return false;
            }
        }
        return true;
    });
});
</script>

<!-- Required Libraries -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
@endsection