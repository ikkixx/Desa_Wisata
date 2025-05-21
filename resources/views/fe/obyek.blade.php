<!-- Enhanced Obyek Wisata Section with Proper Reservation Links -->
<section id="obyek-wisata" class="py-5" style="background: linear-gradient(to bottom, #f8f9fa, #ffffff);">
    <div class="container px-lg-5">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-semibold mb-3">Destinasi Wisata</h2>
            <p class="lead text-muted">Jelajahi keindahan destinasi wisata pilihan kami</p>
        </div>
        
        <div class="row g-4">
            @foreach($obyekWisatas as $wisata)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="destination-card">
                    <div class="destination-image">
                        <img src="{{ asset('storage/' . $wisata->foto1) }}" alt="{{ $wisata->name_wisata }}" class="img-fluid">
                        <div class="category-badge">
                            {{ $wisata->kategori->nama_kategori ?? 'Umum' }}
                        </div>
                    </div>
                    <div class="destination-content">
                        <h3>{{ $wisata->nama_wisata }}</h3>
                        <div class="rating mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <span class="ms-1">4.8 (120 reviews)</span>
                        </div>
                        <p>{{ Str::limit($wisata->deskripsi_wisata, 100) }}</p>
                        <div class="destination-footer">
                            <span class="price">Rp {{ number_format($wisata->harga_tiket, 0, ',', '.') }}</span>
                            <div>
                                <a href="{{ route('obyek_wisata.detail', $wisata->id) }}" class="explore-btn me-2" title="Detail">
                                    <i class="fas fa-info"></i>
                                </a>
                                @if(Auth::check())
                                    <a href="{{ route('reservasi.create', ['paket' => $wisata->id]) }}" class="explore-btn bg-success" title="Reservasi">
                                        <i class="fas fa-calendar-check"></i>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="explore-btn bg-success" title="Reservasi">
                                        <i class="fas fa-calendar-check"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('obyek_wisata.index') }}" class="see-all-btn">
                Lihat Semua Destinasi
                <i class="fas fa-long-arrow-alt-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<style>
/* Base Styles */
#obyek-wisata {
    font-family: 'Poppins', sans-serif;
}

/* Destination Card Enhancements */
.destination-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.05);
    transition: all 0.4s ease;
    height: 100%;
    position: relative;
}

.destination-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

/* Image Section */
.destination-image {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.destination-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.destination-card:hover .destination-image img {
    transform: scale(1.05);
}

.category-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(0,0,0,0.7);
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

/* Content Section */
.destination-content {
    padding: 20px;
}

.destination-content h3 {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 5px;
    color: #2c3e50;
}

.rating {
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 10px;
}

.destination-content p {
    color: #7f8c8d;
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 15px;
}

/* Footer Section */
.destination-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.price {
    font-weight: 700;
    color: #e74c3c;
    font-size: 1.1rem;
}

.explore-btn {
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

.explore-btn.bg-success {
    background: #2ecc71;
}

.explore-btn:hover {
    transform: translateX(5px);
}

/* See All Button */
.see-all-btn {
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

.see-all-btn:hover {
    background: #3498db;
    color: white;
    transform: translateY(-2px);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .destination-image {
        height: 200px;
    }
    
    .destination-content h3 {
        font-size: 1.1rem;
    }
}
</style>

<!-- Required Libraries -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">