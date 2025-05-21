<!-- Paket Wisata Section -->
<section id="paket-wisata" class="py-5">
    <div class="container-fluid px-lg-5">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="display-5 fw-semibold mb-3">Paket Wisata Unggulan</h2>
                <p class="lead text-muted">Temukan pengalaman liburan terbaik dengan pilihan paket wisata kami</p>
            </div>
        </div>
        
        <div class="row g-4 justify-content-center">
            @foreach($paketWisatas as $paket)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="paket-card">
                    <div class="paket-image-wrapper">
                        <img src="{{ asset('storage/' . $paket->foto1) }}" alt="{{ $paket->name_paket }}" class="paket-image">
                    </div>
                    
                    <div class="paket-content">
                        <h3 class="paket-title">{{ $paket->name_paket }}</h3>
                        <p class="paket-desc">{{ Str::limit($paket->deskripsi, 100) }}</p>
                        
                        <div class="paket-footer">
                            <span class="paket-price">Rp {{ number_format($paket->harga_per_pack, 0, ',', '.') }}</span>
                            <a href="{{ route('paket_wisata.detail', $paket->id) }}" class="paket-button">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('paket_wisata.index') }}" class="btn-see-all">
                Lihat Semua Paket
                <i class="fas fa-long-arrow-alt-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<style>
/* Base Styles */
#paket-wisata {
    background: linear-gradient(to bottom, #f8f9fa, #ffffff);
    font-family: 'Poppins', sans-serif;
}

/* Card Design */
.paket-card {
    background: white;
    border-radius: 18px;
    overflow: hidden;
    transition: all 0.4s ease;
    box-shadow: 0 8px 25px rgba(0,0,0,0.05);
    height: 100%;
    display: flex;
    flex-direction: column;
    border: none;
}

.paket-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

/* Image Section */
.paket-image-wrapper {
    position: relative;
    overflow: hidden;
    border-radius: 18px 18px 0 0;
}

.paket-image {
    width: 100%;
    height: 220px;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.paket-card:hover .paket-image {
    transform: scale(1.03);
}

/* Content Section */
.paket-content {
    padding: 22px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.paket-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 12px;
    color: #2c3e50;
}

.paket-desc {
    color: #7f8c8d;
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 20px;
    flex-grow: 1;
}

/* Footer Section */
.paket-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
}

.paket-price {
    font-size: 1.15rem;
    font-weight: 700;
    color: #e74c3c;
}

.paket-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background: #3498db;
    color: white;
    border-radius: 50%;
    text-decoration: none;
    transition: all 0.3s ease;
}

.paket-button:hover {
    background: #2980b9;
    transform: translateX(5px);
}

/* See All Button */
.btn-see-all {
    display: inline-flex;
    align-items: center;
    background: transparent;
    color: #3498db;
    border: 2px solid #3498db;
    padding: 10px 25px;
    border-radius: 30px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-see-all:hover {
    background: #3498db;
    color: white;
    transform: translateY(-2px);
}
</style>