@includeWhen($category->children->where('enabled', true)->isEmpty(), 'home.partials.category')
@includeWhen($category->children->where('enabled', true)->isNotEmpty(), 'home.partials.category_with_sub')