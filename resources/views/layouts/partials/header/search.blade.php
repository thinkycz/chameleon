<vue-search query="{{ request('query') }}" route="{{ route('search') }}"
    eligible-to-see-prices="{{ booleanToString(auth()->check()) }}">
</vue-search>