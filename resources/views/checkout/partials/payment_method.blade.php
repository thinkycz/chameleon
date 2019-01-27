<div class="input-wrap -mx-2">
    <div class="radio">
        <input type="radio"
            id="{{ str_slug($paymentMethod->name) }}"
            value="{{ $paymentMethod->id }}"
            name="payment_method_id">
        <label for="{{ str_slug($paymentMethod->name) }}"
            class="radio-label text-sm"><span>{{ $paymentMethod->name }}</span> <span class="inline-block float-right text-primary">{{ $paymentMethod->formatted_price }}</span></label>
    </div>
</div>