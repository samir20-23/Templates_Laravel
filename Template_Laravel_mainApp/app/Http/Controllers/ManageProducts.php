<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Product;
class ManageProducts extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {   
        $this->productRepository = $productRepository;
    }

    // Display a listing of the resource
    public function index()
    {
        $products = $this->productRepository->getAll();
        $users = $this->productRepository->getAll();
        return view('admin.products.index', compact('products'));
    }

    // Show form for creating a product
    public function create()
    {
        return view('admin.products.create');
    }

    // Store a new product
    public function store(Request $request)
    {
       
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'img_path' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $imgPath = null;

        if ($request->hasFile('img_path')) {
            $imageName = time() . '_' . $request->file('img_path')->getClientOriginalName();
            $request->file('img_path')->move(public_path('images/products'), $imageName);
            $imgPath = 'images/products/' . $imageName;
        }

       $product = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'img_path' => $imgPath,
        ]);
        
        return response()->json([
            'status' => 200,
            'success' => true,
            'product' => $product,
        ]);    
        // return response()->json(['message' => 'Product added successfully!']);
    }

    // Show a single product
    public function show($id)
    {
        $product = $this->productRepository->getById($id);

        if (!file_exists(public_path($product->img_path))) {
            $product->img_path = 'images/products/default.png';
        }

        return view('admin.products.show', compact('product'));
    }

    // Show form for editing a product
    public function edit($id)
    {
        $product = $this->productRepository->getById($id);
        return view('admin.products.edit', compact('product'));
    }

    // Update a product
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'img_path' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $imgPath = $this->productRepository->getById($id)->img_path;

        // Handle image upload
        if ($request->hasFile('img_path')) {
            // Delete old image
            if ($imgPath && file_exists(public_path($imgPath))) {
                unlink(public_path($imgPath));
            }

            $imageName = time() . '_' . $request->file('img_path')->getClientOriginalName();
            $request->file('img_path')->move(public_path('images/products'), $imageName);
            $imgPath = 'images/products/' . $imageName;
        }

        // Update product using repository
        $this->productRepository->update($id, [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'img_path' => $imgPath,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    // Delete a product
    // public function destroy($id)
    // {
    //     $product = $this->productRepository->getById($id);

    //     // Delete image if it exists
    //     if ($product->img_path && file_exists(public_path($product->img_path))) {
    //         unlink(public_path($product->img_path));
    //     }

    //     $this->productRepository->delete($id);

    //     return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    // }
    public function destroy(Product $id)
    {
        try {
            $id->delete();
    
            return response()->json([
                'status' => 200,
                'message' => 'Product deleted successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to delete product. Please try again.',
            ]);
        }
    }
    
}

// filter search
// / Display a listing of the resource
//     public function index(Request $request)
//     {
// // use App\Models\Product;

//         $query = Product::query();
    
//         // Apply price range filter if provided
//         if ($request->has('min_price') && $request->has('max_price')) {
//             $query->priceRange($request->min_price, $request->max_price);
//         }
    
//         // Apply in-stock filter if requested
//         if ($request->has('in_stock')) {
//             $query->inStock();
//         }
    
//         // Apply title search filter if a search term is provided
//         if ($request->has('search')) {
//             $query->search($request->search);
//         }
    
//         // Get the filtered products
//         $products = $query->paginate(10); // You can change the pagination number
    
//         return view('admin.products.index', compact('products'));
//     }


  
   
 
 

    //  public function store(Request $request)
    //  {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'description' => 'required|string|max:1000',
    //     ]);
        
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
        

    //      if ($validator->fails()) {
    //          return response()->json([
    //              'status' => 400,
    //              'errors' => $validator->messages(),
    //          ]);
    //      }

    //      $product = Product::create([
    //          'name' => $request->name,
    //          'description' => $request->description,
    //      ]);

    //      return response()->json([
    //          'status' => 200,
    //          'success' => true,
    //          'product' => $product,
    //      ]);
    //  }


//     public function destroy(Product $product)
// {
//     try {
//         $product->delete();

//         return response()->json([
//             'status' => 200,
//             'message' => 'Product deleted successfully!',
//         ]);
//     } catch (\Exception $e) {
//         return response()->json([
//             'status' => 500,
//             'message' => 'Failed to delete product. Please try again.',
//         ]);
//     }
// }

