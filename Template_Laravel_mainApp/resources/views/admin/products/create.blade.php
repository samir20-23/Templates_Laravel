<form action="{{ route('products.store') }}" method="POST" id="addProduct">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" name="price" id="price" class="form-control" step="0.01" required>
    </div>

    <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" name="stock" id="stock" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="img_path" class="form-label">Image</label>
        <input type="file" name="img_path" id="img_path" class="form-control" accept="image/*">
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>

