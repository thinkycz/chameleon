<div class="method">
    <div class="method-image">
        <img src="{{ $deliveryMethod->logo }}" alt="{{ str_slug($deliveryMethod->name) }}"/>
    </div>
    <input class="method-option" type="radio" name="delivery_method_id" id="{{ str_slug($deliveryMethod->name) }}" value="{{ $deliveryMethod->id }}"/>
    <label class="method-label" for="{{ str_slug($deliveryMethod->name) }}">{{ $deliveryMethod->name }}</label>
</div>