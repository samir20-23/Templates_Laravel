<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // List all products
    public function index()
    {
        $products = Product::all();
        $users = User::all();
        $totalProducts = Product::count();
        $totalUsers = User::count();
        return view('dashboard', compact('products','users','totalProducts','totalUsers'));
    }
   }
