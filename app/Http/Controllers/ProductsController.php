<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function foodBeverage()
    {
        return view('products.food-beverage')
            ->with('namaHalaman', 'Food Beverage');
    }
    public function beautyHealth()
    {
        return view('products.beauty-health')
            ->with('namaHalaman', 'Beauty Health');
    }
    public function homeCare()
    {
        return view('products.home-care')
            ->with('namaHalaman', 'Home Care');
    }
    public function babyKid()
    {
        return view('products.baby-kid')
            ->with('namaHalaman', 'baby Kid');
    }
}
