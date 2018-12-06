<div class="address-card px-2" @click.prevent="handleAddressBoxClicked('{{ $address->id }}')">
    <div class="address-card__inner">
        <a href="!#" class="text-danger btn-delete"
            @click.stop.prevent="destroy('{{ route('profiles.addresses.destroy', [$user, $address]) }}')">
            <icon-trash></icon-trash>
        </a>

        @if($address->company_name)
            <p class="font-bold text-lg mb-0">{{ $address->company_name }}</p>
        @endif
        <p class="mb-2">{{ $address->first_name . ' ' . $address->last_name}}</p>
        <p class="text-sm mb-0">
            <span class="icon-wrap">
                <icon-navigate></icon-navigate>
                <span>{{ $address->street .', '. $address->zip .' '. $address->city }}</span>
            </span>
        </p>
    </div>
</div>