@extends('layouts.app')

@section('content')
    <div class="container py-16">
        <div class="row">
            <div class="col-9 main-basket">
                <div class="card">
                    <span style="height: 800px" class="inline-block">This is where the products will go</span>
                </div>
            </div>
            <vue-basket-sidebar>
                <div class="inner">
                    <div class="card">
                        <span>Some sidebar content to test</span>
                    </div>
                </div>
            </vue-basket-sidebar>
        </div>
    </div>
@stop