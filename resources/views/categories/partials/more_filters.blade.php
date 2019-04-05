<div class="row my-2">
    <vue-price-filter currency="{{ preferenceRepository()->getDefaultCurrency()->isocode }}"
        :current-min="{{ request()->get('price_min') ?? 'null' }}"
        :current-max="{{ request()->get('price_max') ?? 'null' }}">
    </vue-price-filter>
</div>