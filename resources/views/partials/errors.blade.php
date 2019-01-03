@if (count($errors) > 0)
    <div class="row">
        <div class="col-full mb-6" role="alert">
            <div class="bg-danger-light pl-2 py-2 mt-4 border-l-8 border-danger card text-white">
                <p class="font-bold">{{ trans('partials.there_are_errors') }}</p>

                <ul class="list-reset">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif