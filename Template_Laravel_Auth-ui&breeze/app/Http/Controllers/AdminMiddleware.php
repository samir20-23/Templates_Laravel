<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminMiddleware extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
}
