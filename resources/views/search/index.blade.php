@extends('layouts.sidebar')

@section('sidebar')
    <div class="card pt-2">
        <div class="card-heading border-b px-4 py-2">
            <div class="icon-wrap">
                <icon-filter></icon-filter>
                <h4>Filter</h3>
            </div>
        </div>
        <div class="card-body p-4">
            Some fiters here
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-third">
            @include('products.partials.card')
        </div>
    </div>
@stop