@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Daftar Reservasi Saya</h4>
                        <a href="{{ route('paket-wisata.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-plus-circle"></i> Buat Reservasi Baru
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($reservasis->isEmpty())
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle"></i> Anda belum memiliki reservasi
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Paket Wisata</th>
                                        <th>Tanggal</th>
                                        <th>Peserta</th>
                                        <th>Total Bayar</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservasis as $reservasi)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($reservasi->paket->foto1)
                                                        <img src="{{ asset('storage/'.$reservasi->paket->foto1) }}" 
                                                            alt="{{ $reservasi->paket->nama_paket }}" 
                                                            class="rounded me-3" 
                                                            width="60" height="60" style="object-fit: cover">
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0">{{ $reservasi->paket->nama_paket }}</h6>
                                                        <small class="text-muted">Rp {{ number_format($reservasi->harga, 0, ',', '.') }}/org</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $reservasi->tgl_reservasi->translatedFormat('d M Y') }}</td>
                                            <td>{{ $reservasi->jumlah_peserta }} orang</td>
                                            <td>Rp {{ number_format($reservasi->total_bayar, 0, ',', '.') }}</td>
                                            <td>
                                                <span class="badge bg-{{ $statusColors[$reservasi->status_reservasi] }}">
                                                    {{ ucfirst($reservasi->status_reservasi) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($reservasi->status_reservasi === 'pesan')
                                                    <form action="{{ route('reservasi.destroy', $reservasi->id) }}" 
                                                        method="POST" 
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('Batalkan reservasi ini?')">
                                                            <i class="bi bi-x-circle"></i> Batalkan
                                                        </button>
                                                    </form>
                                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-receipt"></i> Invoice
                                                    </a>
                                                @else
                                                    <a href="#" class="btn btn-sm btn-outline-secondary">
                                                        <i class="bi bi-eye"></i> Detail
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection