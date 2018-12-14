@if(Session::has('snackbar'))
    <vue-snackbar text="{!! Session::pull('snackbar.text') !!}"
        type="{!! Session::pull('snackbar.type') !!}">
    </vue-snackbar>
    @php
        Session::forget('snackbar');
    @endphp
@endif