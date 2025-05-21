<!-- Enhanced Berita Section -->
<section id="berita" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3">Berita Terkini</h2>
            <p class="lead text-muted">Update terbaru seputar wisata dan traveling</p>
        </div>
        
        <div class="row g-4">
            @foreach($beritas as $berita)
            <div class="col-lg-4 col-md-6">
                <div class="news-card card h-100 border-0 shadow-sm overflow-hidden">
                    <!-- Image Section -->
                    @if($berita->foto)
                    <div class="news-image" style="height: 200px;">
                        <img src="{{ asset('storage/' . $berita->foto) }}" class="card-img-top h-100 w-100 object-fit-cover" alt="{{ $berita->judul }}">
                        @if($berita->kategori)
                        <div class="category-badge bg-primary text-white px-3 py-1 small">
                            {{ $berita->kategori->nama_kategori }}
                        </div>
                        @endif
                    </div>
                    @else
                    <div class="news-image bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                        <span class="text-white"><i class="far fa-newspaper fa-3x"></i></span>
                    </div>
                    @endif
                    
                    <!-- Content Section -->
                    <div class="card-body">
                        <div class="d-flex align-items-center text-muted mb-2 small">
                            <i class="far fa-calendar-alt me-2"></i>
                            {{ $berita->tgl_post->isoFormat('D MMMM Y') }}
                        </div>
                        
                        <h3 class="h5 card-title fw-bold mb-3">{{ $berita->judul }}</h3>
                        
                        <p class="card-text text-muted mb-4">
                            {{ Str::limit(strip_tags($berita->berita), 100) }}
                        </p>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('berita_wisata.detail', $berita->id) }}" class="read-more-btn text-decoration-none">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('berita_wisata.index') }}" class="btn btn-primary px-4 py-2">
                <i class="fas fa-list me-2"></i> Lihat Semua Berita
            </a>
        </div>
    </div>
</section>

<style>
/* Base Styles */
#berita {
    font-family: 'Poppins', sans-serif;
}

/* News Card */
.news-card {
    transition: all 0.3s ease;
    border-radius: 8px !important;
}

.news-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

/* Image Section */
.news-image {
    position: relative;
    overflow: hidden;
}

.category-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    border-radius: 4px;
    font-weight: 500;
}

/* Content Section */
.card-title {
    color: #212529;
    transition: color 0.3s ease;
}

.news-card:hover .card-title {
    color: #0d6efd;
}

.read-more-btn {
    color: #0d6efd;
    font-weight: 500;
    transition: all 0.3s ease;
}

.read-more-btn:hover {
    color: #0b5ed7;
    transform: translateX(5px);
}

/* Button Styles */
.btn-primary {
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .news-image {
        height: 180px !important;
    }
    
    .card-title {
        font-size: 1.1rem;
    }
}
</style>

<!-- Required Libraries -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">