<section id="categoryies" class="py-16 bg-grey-lightest">
    <div class="container">
        <div class="row">
            <div class="col-full">
                <h2 class="text-grey-darkest mb-3 text-2xl w-full">{{ trans('home.all_categories') }}</h2>

                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-category">
                            @include('categories.partials.card')
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>