<?php

use App\Models\Category;
use App\Models\Product;

// Home
Breadcrumbs::for('home', function ($breadcrumbs) {
    $breadcrumbs->push(trans('breadcrumbs.home'), route('home'));
});

// Home > Categories
Breadcrumbs::register('categories', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('breadcrumbs.categories'), route('categories.index'));
});

// Home > Categories > Category
Breadcrumbs::register('category', function ($breadcrumbs, Category $category) {
    $breadcrumbs->parent('categories');
    foreach ($category->ancestors as $ancestor) {
        $breadcrumbs->push($ancestor->name, route('categories.show', $ancestor));
    }
    $breadcrumbs->push($category->name, route('categories.show', $category));
});

// Home > Category > {Product}
Breadcrumbs::register('products.show', function ($breadcrumbs, Product $product) {
    if ($product->hasCategory()) {
        $breadcrumbs->parent('category', $product->getFirstCategory());
    } else {
        $breadcrumbs->parent('home');
    }
    if ($parent = $product->parent) {
        $breadcrumbs->push($parent->name, route('products.show', $parent));
    }
    $breadcrumbs->push($product->name, route('products.show', $product));
});
