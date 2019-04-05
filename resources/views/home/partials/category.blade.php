<section id="category-{{ $category->id }}" class="my-16">
    <div class="container">
        <div class="row">
            <div class="col-full">
                <h2 class="mb-4 text-2xl w-full">
                    <a href="{{ route('categories.show', $category) }}" class="text-grey-darkest hover:text-grey-darker">{{ $category->name }}</a>
                </h2>

                <div class="row">
                    @forelse($category->products()->inRandomOrder()->take(4)->get() as $product)
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