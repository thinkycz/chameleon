<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('category_is_enabled');
    }

    public function index()
    {
        $categories = Category::withCount('products')
            ->whereEnabled(true)
            ->whereIsRoot()
            ->get();

        return view('categories.index', compact('categories'));
    }

    public function show(Request $request, Category $category, ProductRepository $productRepository)
    {
        $subcategory = $request->has('subcategory') ? Category::find($request->get('subcategory')) : null;

        $products = $productRepository->getProductsForCategory($subcategory ?? $category);
        $properties = $productRepository->getPropertiesRelatedToProducts($products);
        $tags = $productRepository->getTagsRelatedToProducts($products);

        $products = $productRepository->filterAndGetProducts($products);

        return view('categories.show', compact('category', 'products', 'tags', 'properties'));
    }
}
