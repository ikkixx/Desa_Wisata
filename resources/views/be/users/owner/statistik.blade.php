@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('header') @include('be.header') @endsection

@section('content')
<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="container">
            <h1 class="mb-4">Statistik Reservasi</h1>

            <div class="mb-4">
                <a href="{{ route('owner.statistik.exportPdf') }}" class="btn btn-danger mb-3" id="exportStatistikBtn">
                    <i class="fas fa-file-pdf"></i> Export Statistik
                </a>
            </div>

            <!-- Card stats -->
            <div class="row mb-4">
                <!-- ... (kode card statistik tetap sama) ... -->
            </div>

            <!-- Tabel data -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <!-- ... (kode tabel tetap sama) ... -->
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('exportStatistikBtn').addEventListener('click', function() {
    Swal.fire({
        title: 'Membuat Statistik PDF',
        didOpen: () => Swal.showLoading()
    });
});
</script>
@endsection