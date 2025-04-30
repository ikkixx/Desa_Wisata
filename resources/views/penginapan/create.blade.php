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
    <div class="container-fluid"></div>

    <div class="container">
        <h1>Create Penginapan</h1>
        <form action="{{ route('penginapan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter description" required></textarea>
            </div>
            <div class="form-group">
                <label for="nama_penginapan">Nama Penginapan</label>
                <input type="text" class="form-control" id="nama_penginapan" name="nama_penginapan" placeholder="Enter nama penginapan" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    @endsection