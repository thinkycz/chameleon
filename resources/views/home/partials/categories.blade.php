<section id="categories" class="py-16 bg-grey-lightest">
    <div class="container">

        <vue-categoriesshowcase :categories="{{ json_encode($categories->values()) }}" inline-template>
            <div class="row">

                <div class="col-small-sidebar">
                    <div class="card p-4">
                        <h2 class="text-grey-darkest mb-4 pb-2 text-lg w-full border-b">{{ trans('home.categories_showcase') }}</h2>

                        <ul class="list-reset categories-list">
                            <li :class="{'active': current === category.id}" v-for="category in categories" @click="change(category.id)">@{{ category.name[locale] }}</li>
                        </ul>
                    </div>
                </div>

                <div class="col-big-content">
                    @foreach($categories as $category)
                    <template name="fade" mode="out-in">
                        <div class="row" v-if="current == {{ $category->id }}" key="category-{{ $category->id }}">
                            @foreach($category->products as $product)
                                <div class="col-third">
                                    @include('products.partials.card')
                                </div>
                            @endforeach
                        </div>
                    </template>
                    @endforeach
                </div>

            </div>
        </vue-categoriesshowcase>

    </div>
</section>