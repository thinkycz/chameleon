@extends('layouts.print')

@section('content')
    @foreach($orders as $order)
        @include('invoices.partials.order')
        <div style="margin: 80px 0;"></div>
    @endforeach
@endsection