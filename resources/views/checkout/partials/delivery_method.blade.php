<div class="input-wrap -mx-2">
    <div class="radio">
        <input type="radio"
            id="{{ str_slug($deliveryMethod->name) }}"
            value="{{ $deliveryMethod->id }}"
            name="delivery_method_id">
        <label for="{{ str_slug($deliveryMethod->name) }}"
            class="radio-label text-sm"><span>{{ $deliveryMethod->name }}</span> <span class="inline-block float-right text-primary">{{ $deliveryMethod->formatted_price }}</span></label>
    </div>
</div>