<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $products = Product::with('category')->orderBy('id', 'DESC')->take(6)->get();
        $categories = Category::all();
        return view('front.index', [
            'products' => $products,
            'categories' => $categories,
            'user' => $user,
        ]);
    }

    public function details(Product $product)
    {
        $product->load('category');
        return view('front.details', [
            'product' => $product,
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('search');
        $products = Product::where('name', 'LIKE', '%' . $keyword . '%')->get();

        return view('front.search', [
            'products' => $products,
            'keyword' => $keyword
        ]);
    }

    public function category(Category $category)
    {
        $products = Product::where('category_id', $category->id)->with('category')->get();
        // $category->load('category');
        // $products = Product::with('category')->get();

        return view('front.category', [
            'products' => $products,
            'category' => $category
        ]);
    }
}
