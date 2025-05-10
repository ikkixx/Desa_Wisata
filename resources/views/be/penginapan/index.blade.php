@extends('be.master')
@section('header')
@include('be.header')
@endsection
@section('sidebar')
@include('be.sidebar')
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Berita Management</h4>
                        
                        <a href="{{ route('berita.create') }}" class="btn btn-primary mb-3">
                            <i class="fa fa-plus-circle me-2"></i>Add Berita
                        </a>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Penulis</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($beritas as $index => $berita)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ Str::limit($berita->judul, 30) }}</td>
                                        <td>{{ $berita->kategori }}</td>
                                        <td>{{ $berita->penulis }}</td>
                                        <td>{{ $berita->tanggal_publikasi->format('d M Y') }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($berita->status == 'published') badge-success 
                                                @elseif($berita->status == 'draft') badge-warning 
                                                @else badge-secondary @endif">
                                                {{ ucfirst($berita->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('berita.show', $berita->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('berita.destroy', $berita->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $beritas->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection