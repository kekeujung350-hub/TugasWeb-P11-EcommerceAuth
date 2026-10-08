<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category')   // eager loading
            ->available()                        // local scope
            ->search($request->query('q'))       // local scope
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('products.index', compact('products'));
    }

    // Demo: perbandingan jumlah query lazy loading (N+1) vs eager loading
    public function eagerDemo()
    {
        DB::enableQueryLog();

        foreach (Product::available()->take(10)->get() as $product) {
            $product->category->name;            // lazy: 1 query per produk
        }
        $lazy = collect(DB::getQueryLog());
        DB::flushQueryLog();

        foreach (Product::with('category')->available()->take(10)->get() as $product) {
            $product->category->name;            // eager: sudah ter-load
        }
        $eager = collect(DB::getQueryLog());
        DB::disableQueryLog();

        return view('products.eager-demo', compact('lazy', 'eager'));
    }
}
