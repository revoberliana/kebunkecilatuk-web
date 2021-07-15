<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class AboutController extends Controller
{
     public function index()
    {
        return view('pages.About');
    }
}
