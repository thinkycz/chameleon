<div class="card category-card">
    <div class="category-image">
        <a href="{{ route('categories.show', $category) }}"><img src="{{ $category->thumb }}" alt="{{ $category->name }}"></a>
        <span class="badge accent text-xs">{{ trans('categories.products_count', ['count' => $category->products_count]) }}</span>
    </div>
    <div class="category-data">
        <h3><a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a></h3>
    </div>
</div>