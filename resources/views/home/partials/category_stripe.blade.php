@includeWhen($category->children->isEmpty(), 'home.partials.category')
@includeWhen($category->children->isNotEmpty(), 'home.partials.category_with_sub')