<div class="method">
    <div class="method-image">
        <img src="{{ $paymentMethod->logo }}" alt="{{ str_slug($paymentMethod->name) }}"/>
    </div>
    <input class="method-option" type="radio" name="payment_method_id" id="{{ str_slug($paymentMethod->name) }}" value="{{ $paymentMethod->id }}"/>
    <label class="method-label" for="{{ str_slug($paymentMethod->name) }}">{{ $paymentMethod->name }}</label>
</div>