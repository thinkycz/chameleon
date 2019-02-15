<section id="categories" class="py-16 bg-grey-lightest">
    <div class="container">

        <vue-categoriesshowcase :categories="{{ json_encode($categories->values()) }}" inline-template>
            <div class="row">
                <div class="col-full">
                    <h2 class="text-grey-darkest mb-3 text-2xl w-full">{{ trans('home.categories_showcase') }}</h2>
                </div>

                <div class="col-full">
                    <div class="flex flex-wrap justify-start mb-6">
                        <span class="badge accent mr-4 cursor-pointer" v-for="category in categories" @click="change(category.id)">@{{ category.name[locale] }}</span>
                    </div>
                </div>

                <template name="fade" mode="out-in">
                    @foreach($categories as $category)
                        <div class="col-full" v-if="current == {{ $category->id }}" key="category-{{ $category->id }}">
                            <div class="row">
                                @foreach($category->products as $product)
                                    <div class="col-product">
                                        @include('products.partials.card')
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </template>

            </div>
        </vue-categoriesshowcase>

    </div>
</section>