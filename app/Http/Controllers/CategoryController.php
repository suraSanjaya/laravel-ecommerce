<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::take(6)->get();
        $products = Product::with(['galleries'])->paginate(8);
        return view('pages.category', [
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function detail(Request $request, $slug){
        $categories = Category::take(6)->get();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::with(['galleries'])->where('categories_id', $category->id)->paginate(16);
        return view('pages.category', [
            'categories' => $categories,
            'products' => $products
        ]);
    }
}
