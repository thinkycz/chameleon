<template>
    <div class="flex flex-wrap p-4">
        <span class="block icon-4x text-center w-full">
            <icon-sad></icon-sad>
        </span>
        <h3 class="text-center block text-grey-darkest w-full">{{ $trans('basket.basket_empty') }}</h3>
        <p class="mt-4 text-center w-full"><a href="/"
                class="btn btn-primary">{{ $trans('header.start_shopping') }}</a></p>
    </div>
</template>