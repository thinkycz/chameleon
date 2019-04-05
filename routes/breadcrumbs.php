<?php

use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\User;

// Home
Breadcrumbs::for('home', function ($breadcrumbs) {
    $breadcrumbs->push(trans('breadcrumbs.home'), route('home'));
});

// Home > My Profile
Breadcrumbs::for('profiles.show', function ($breadcrumbs) {
    $breadcrumbs->push(trans('breadcrumbs.home'), route('home'));
    $breadcrumbs->push(trans('breadcrumbs.my_profile'), route('profiles.show'));
});

// Home > About Us
Breadcrumbs::for('about', function ($breadcrumbs) {
    $breadcrumbs->push(trans('breadcrumbs.home'), route('home'));
    $breadcrumbs->push(trans('breadcrumbs.about_us'), route('about'));
});

// Home > Contact
Breadcrumbs::for('contact.index', function ($breadcrumbs) {
    $breadcrumbs->push(trans('breadcrumbs.home'), route('home'));
    $breadcrumbs->push(trans('breadcrumbs.contact_us'), route('contact.index'));
});

// Home > Register
Breadcrumbs::for('register', function ($breadcrumbs) {
    $breadcrumbs->push(trans('breadcrumbs.home'), route('home'));
    $breadcrumbs->push(trans('breadcrumbs.register'), route('register'));
});

// Home > Login
Breadcrumbs::for('login', function ($breadcrumbs) {
    $breadcrumbs->push(trans('breadcrumbs.home'), route('home'));
    $breadcrumbs->push(trans('breadcrumbs.login'), route('login'));
});

// Home > {Page}
Breadcrumbs::register('pages.show', function ($breadcrumbs, Page $page) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($page->title, route('pages.show', $page));
});

// Home > Categories
Breadcrumbs::register('categories.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('breadcrumbs.categories'), route('categories.index'));
});

// Home > Categories > Category
Breadcrumbs::register('categories.show', function ($breadcrumbs, Category $category) {
    $breadcrumbs->parent('categories.index');
    foreach ($category->ancestors as $ancestor) {
        $breadcrumbs->push($ancestor->name, route('categories.show', $ancestor));
    }
    $breadcrumbs->push($category->name, route('categories.show', $category));
});

// Home > Category > {Product}
Breadcrumbs::register('products.show', function ($breadcrumbs, Product $product) {
    if ($product->hasCategory()) {
        $breadcrumbs->parent('categories.show', $product->getFirstCategory());
    } else {
        $breadcrumbs->parent('home');
    }

    if ($parent = $product->parent) {
        $breadcrumbs->push($parent->name, route('products.show', $parent));
    }

    $breadcrumbs->push($product->name, route('products.show', $product));
});
