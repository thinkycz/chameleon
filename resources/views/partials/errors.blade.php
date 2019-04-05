@if (count($errors) > 0)
    <div class="row mb-4">
        <div class="col-full mb-6" role="alert">
            <div class="bg-danger-light p-4 border-l-8 border-danger card text-white">
                <p class="font-bold">{{ trans('partials.there_are_errors') }}</p>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif