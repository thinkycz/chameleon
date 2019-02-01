@component('mail::subcopy')
{{ trans('mail.kind_regards') }}

<a href="{{ route('home') }}">{{ $companyDetails['name'] ?? '' }}</a>

{{ $companyDetails['street'] ?? '' .' '. $companyDetails['location'] ?? '' }}
@endcomponent