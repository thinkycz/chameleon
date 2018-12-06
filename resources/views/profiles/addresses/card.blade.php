<vue-address-box :address="{{ json_encode($address) }}"
    :address-box-clicked="handleAddressBoxClicked"
    :address-box-destroyed="handleAddressBoxDestroyed"
    route="{{ route('profiles.addresses.destroy', [$user, $address]) }}">
</vue-address-box>