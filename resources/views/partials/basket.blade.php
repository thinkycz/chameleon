<vue-basket :basket="{{ json_encode(activeBasket()) }}"
    :is-disabled="{{ booleanToString(request()->routeIs('basket.*', 'checkout.*', 'confirmation.*')) }}">
</vue-basket>