<div class="col-half mx-auto">
    <div class="card py-4">
        <p class="text-center font-bold icon-4x">
            <icon-sad></icon-sad>
        </p>
        <p class="text-center font-bold">{{ trans('basket.basket_empty') }}</p>
        <p class="text-center">
            <a href="{{ route('home') }}" class="btn btn-primary">{{ trans('header.start_shopping') }}</a>
        </p>
    </div>
</div>