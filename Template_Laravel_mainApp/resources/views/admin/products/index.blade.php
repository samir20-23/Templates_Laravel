@extends('layouts.app')

@section('subtitle', 'Dashboard')
@section('content_header_title', 'Dashboard')
@section('content_header_subtitle', 'Products')

@section('content_body')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Liste des Produits</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="{{Route('dashboard')}}">Accueil</a></li> remm --}}
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row mb-2 justify-content-end">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <button><a id="show" href="{{ route('products.create') }}">create product</a></button>
                        {{-- <a href="" class="btn btn-primary btn-sm p-2 text-white"><i class="fas fa-plus"></i> Ajouter produit</a> --}}
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Table des produits</h3>
                </div>
                <!-- /.card-header -->
                @if ($products->isEmpty())
                    <p class="p-5 text-center">aucun produit trouvé.</p>
                @else
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                            @if ($product->img_path)
                                                <img src="{{ asset($product->img_path) }}" alt="Image" width="50">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>
                                            
        
        {{-- <a href="{{ route('products.edit'),'' }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a> --}}
        {{-- <a href="{{ route('products.show', $product->id) }}" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a> --}}
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                class="d-inline deleteForm">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="fas fa-trash"></i> </button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                       
                    </div>
                @endif
                <!-- /.card-body -->
            </div>
            {{-- {{ $Products->links('pagination::bootstrap-5') remm }} --}}
            <!-- /.card -->
        </div>
    </section>

@stop
