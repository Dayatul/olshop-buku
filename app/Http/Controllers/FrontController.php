<?php

namespace App\Http\Controllers;

use App\Models\Article;
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
        $products = Product::with('category')->orderBy('id', 'DESC')->take(8)->get();
        $categories = Category::all();
        $articles = Article::with(['user', 'category'])->latest()->take(4)->get();
        return view('front.index', [
            'products' => $products,
            'categories' => $categories,
            'user' => $user,
            'articles' => $articles,
        ]);
    }

    public function product()
    {
        $user = Auth::user();
        $products = Product::with('category')->orderBy('id', 'DESC')->get();
        $categories = Category::all();
        $articles = Article::with(['user', 'category'])->latest()->get();
        return view('front.product', [
            'products' => $products,
            'categories' => $categories,
            'user' => $user,
            'articles' => $articles,
        ]);
    }

    public function searchProduct(Request $request)
    {
        $query = $request->get('search', '');
        $products = Product::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->take(20)
            ->get();

        return response()->json($products);
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

    public function blog()
    {
        $articles = Article::with(['user', 'category'])->latest()->paginate(6);
        return view('front.blog', [
            'articles' => $articles
        ]);
    }

    public function article(Article $article)
    {
        $article->load(['user', 'category']);
        return view('front.article', [
            'article' => $article
        ]);
    }

    public function articleDetails(Article $article)
    {
        $article->load(['user', 'category']);
        return view('front.blog-details', [
            'article' => $article
        ]);
    }

    public function searchArticle(Request $request)
    {
        $keyword = $request->input('search');
        $articles = Article::where('title', 'LIKE', '%' . $keyword . '%')->get();

        return view('front.search-article', [
            'articles' => $articles,
            'keyword' => $keyword
        ]);
    }

    public function about()
    {
        return view('front.about');
    }
    public function contact()
    {
        return view('front.contact');
    }
}
