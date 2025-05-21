<!-- Penginapan Section -->
<section id="penginapan" class="py-5" style="background: linear-gradient(to bottom, #f9fafb, #ffffff);">
    <div class="container px-lg-5">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-semibold mb-3">Penginapan Tersedia</h2>
            <p class="lead text-muted">Temukan akomodasi terbaik untuk kenyamanan liburan Anda</p>
        </div>

        <div class="row g-4">
            @foreach($penginapans as $penginapan)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="accommodation-card">
                    <!-- Bagian Gambar -->
                    <div class="accommodation-image">
                        <img src="{{ asset('storage/' . $penginapan->foto1) }}" alt="{{ $penginapan->name_penginapan }}" class="img-fluid">
                        <div class="rating-badge">
                            <i class="fas fa-star"></i> 4.8
                        </div>
                    </div>

                    <!-- Bagian Konten - NAMA PENGGINAPAN DITARUH DI SINI -->
                    <div class="accommodation-content">
                        <!-- NAMA PENGGINAPAN YANG DITONJOLKAN -->
                        <h3 class="accommodation-name">
                            <i class="fas fa-hotel me-2"></i>
                            {{ $penginapan->nama_penginapan }}
                        </h3>

                        <div class="accommodation-meta">
                            <span class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ $penginapan->lokasi ?? 'Lokasi tidak tersedia' }}
                            </span>
                            <span class="price">
                                Rp {{ number_format($penginapan->harga, 0, ',', '.') }}/malam
                            </span>
                        </div>

                        <p class="accommodation-desc">
                            {{ Str::limit($penginapan->deskripsi, 100) }}
                        </p>

                        <div class="accommodation-footer">
                            <a href="{{ route('nginap_wisata.detail', $penginapan->id) }}" class="view-detail-btn">
                                Lihat Detail <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('nginap_wisata.index') }}" class="see-all-btn">
                Lihat Semua Penginapan
                <i class="fas fa-long-arrow-alt-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<style>
    /* Base Styles */
    #penginapan {
        font-family: 'Poppins', sans-serif;
    }

    /* Accommodation Card */
    .accommodation-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        transition: all 0.4s ease;
        height: 100%;
        border: none;
    }

    .accommodation-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    /* Image Section */
    .accommodation-image {
        position: relative;
        height: 220px;
        overflow: hidden;
    }

    .accommodation-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .accommodation-card:hover .accommodation-image img {
        transform: scale(1.05);
    }

    /* Name Overlay */
    .accommodation-name-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), transparent);
        padding: 15px;
    }

    .accommodation-title {
        color: white;
        font-size: 1.3rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .rating-badge {
        position: absolute;
        bottom: 15px;
        left: 15px;
        background: rgba(255, 255, 255, 0.9);
        color: #ff9529;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Content Section */
    .accommodation-content {
        padding: 20px;
    }

    .accommodation-meta {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 0.9rem;
    }

    .location {
        color: #3498db;
    }

    .price {
        color: #2ecc71;
        font-weight: 600;
    }

    .accommodation-desc {
        color: #7f8c8d;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    /* Footer Section */
    .accommodation-footer {
        display: flex;
        justify-content: flex-end;
    }

    .view-detail-btn {
        display: inline-flex;
        align-items: center;
        background: #3498db;
        color: white;
        padding: 8px 16px;
        border-radius: 30px;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .view-detail-btn:hover {
        background: #2980b9;
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
</style>