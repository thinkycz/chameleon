@php
    $products = $category->products()->inRandomOrder()->take(8)->get();
@endphp

<section id="category-{{ $category->id }}" class="py-16 {{ $category->is($firstCategory)  ? 'bg-white' : 'bg-grey-lighest' }}">
    <div class="container">
        <div class="row">
            <div class="col-full">
                <h2 class="text-grey-darkest mb-3 text-2xl w-full">{{ $category->name }}</h2>

                <div class="row">
                    @forelse($products as $product)
                        <div class="col-product">
                            @include('products.partials.card')
                        </div>
                    @empty
                        @include('partials.no_results_found')
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>