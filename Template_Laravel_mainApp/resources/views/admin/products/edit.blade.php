<form action="{{ route('products.update') }}" method="POST" id="addProduct">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $product->title) }}">
            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $product->description) }}</textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" step="0.01" value="{{ old('price', $product->price) }}">
            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $product->stock) }}">
            @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="img_path" class="form-label">Image</label>
            <input type="file" class="form-control @error('img_path') is-invalid @enderror" id="img_path" name="img_path">
            @error('img_path') <div class="invalid-feedback">{{ $message }}</div> @enderror
            @if($product->img_path)
                <div class="mt-2">
                    <img src="{{ asset($product->img_path) }}" alt="Product Image" style="width: 100px;">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-warning">Update Product</button>
    </form>

