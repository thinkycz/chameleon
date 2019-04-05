@extends('layouts.app')

@section('title', getPageTitle('Authorization'))

@section('content')
    <div class="container py-16">
        <div class="row">
            <div class="col-half mx-auto">
                <div class="card p-12">
                    <div class="card-heading">
                        <h3>Authorization Request</h3>
                    </div>

                    <div class="card-body">
                        <p><strong>{{ $client->name }}</strong> is requesting permission to access your account.</p>

                        @if (count($scopes) > 0)
                            <div class="scopes">
                                <p><strong>This application will be able to:</strong></p>

                                <ul>
                                    @foreach ($scopes as $scope)
                                        <li>{{ $scope->description }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="flex justify-end pt-6">
                            <!-- Cancel Button -->
                            <form csrf method="delete" form-action="passport.authorizations.deny">
                                <input type="hidden" name="state" value="{{ $request->state }}">
                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                <button class="btn btn-link text-grey-darkest">Cancel</button>
                            </form>

                            <!-- Authorize Button -->
                            <form csrf method="post" form-action="passport.authorizations.approve">
                                <input type="hidden" name="state" value="{{ $request->state }}">
                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                <button type="submit" class="btn btn-primary">Authorize</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop