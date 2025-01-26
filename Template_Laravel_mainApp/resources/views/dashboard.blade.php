@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <h1 class="mb-4">Product Dashboard</h1>

    
        <!-- Dashboard Cards -->
        <div class="row">
            <!-- Products Card -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-box fa-3x mb-3"></i> <!-- Icon for products -->
                        <h1>{{ $totalProducts }}</h1>
                        <p>Total Products</p>
                        <a href="{{ route('admin.products.index',$products) }}" class="btn btn-primary">Show More</a>
                    </div>
                </div>
            </div>

            <!-- Users Card -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x mb-3"></i> <!-- Icon for users -->
                        <h1>{{ $totalUsers }}</h1>
                        <p>Total Users</p>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Show More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @forelse ($products as $product)
                @forelse ($users as $user)
                <h1>{{$totalProducts}}</h1>
                <h1>{{$totalUsers}}</h1> --}}