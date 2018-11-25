@extends('layouts.app')

@section('content')
    <div class="container py-16">
        <div class="row">
            <div class="col-half mx-auto">
                <div class="card p-12">
                    <div class="card-heading mb-8">
                        <h3><span>Are you</span> an existing user?</h3>
                        <p>Using your credentials, please login on our system. Your online shopping experience with us starts here! </p>
                    </div>
                    <div class="card-body">
                        <form action="">
                            <div class="row pb-4">
                                <div class="col-full">
                                    <div class="input-wrap">
                                        <label for="email">Email *</label>
                                        <input type="email" id="email" required class="input" placeholder="Your email">
                                    </div>
                                </div>

                                <div class="col-full">
                                    <div class="input-wrap">
                                        <label for="password">Password *</label>
                                        <input type="password" id="password" required class="input" placeholder="Your password">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop