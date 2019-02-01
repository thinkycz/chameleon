@component('mail::message')

# {{__('mail.export_data_subject')}}

{{ __('mail.export_data_mail_message') }}

@component('mail::button', ['url' => $path])
{{ __('mail.download_exported_data') }}
@endcomponent

@include('mail.partials.footer')

@endcomponent
