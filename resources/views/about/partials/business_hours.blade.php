<div class="card p-4">
    <h3 class="text-grey-darkest  pb-4 mb-4 border-b">{{ trans('about.business_hours') }}</h3>

    <ul class="list-reset">
        @php
            $businessHours = settingsRepository()->configuration('business_hours');
            $days = [
                'mo',
                'tu',
                'we',
                'th',
                'fr',
                'sa',
                'su',
            ];
        @endphp

        @foreach($days as $day)
            @php
                $value = $businessHours[$day];
            @endphp

            <li class="flex flex-wrap justify-between mb-1">
                <span>{{ trans('about.business_hours.' . $day) }}</span>

                @if(!$value || $value === 'closed')
                    <span class="text-danger">
                        <icon-closecircle></icon-closecircle>
                    </span>
                @else
                    <span class="text-primary icon-wrap font-bold">
                        <span>{{ $value }}</span>
                    </span>
                @endif
            </li>
        @endforeach
    </ul>
</div>