<section id="category-{{ $category->id }}" class="my-16">
    <div class="container">
        <div class="row">
            <div class="col-full">
                <h2 class="mb-4 text-2xl w-full">
                    <a href="{{ route('categories.show', $category) }}" class="text-grey-darkest hover:text-grey-darker">{{ $category->name }}</a>
                </h2>
            </div>
        </div>

        <div class="row">
            <div class="col-small-sidebar">
                <div class="card p-4">
                    <h2 class="text-grey-darkest mb-4 pb-2 text-lg w-full border-b">{{ trans('home.subcategories') }}</h2>

                    <ul class="categories-list overflow-y-auto" style="max-height: 20rem;">
                        @foreach($category->children->where('enabled', true) as $subcategory)
                            <li><a href="{{ route('categories.show', $subcategory) }}" class="text-grey-darkest">{{ $subcategory->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-big-content">
                <div class="row has-sidebar">
                    @forelse(\App\Models\Product::processCategoryClient($category)->inRandomOrder()->take(3)->get() as $product)
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