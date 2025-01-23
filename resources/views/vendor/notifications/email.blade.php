<x-mail::message>
{{-- Logo --}}
<div style="text-align: center; margin-bottom: 20px;">
    <img src="{{ asset('pic/khqr.png') }}" alt="{{ config('app.name') }} Logo" style="max-height: 100px;">
</div>

{{-- Greeting --}}
@if (!empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Oops!')
@else
# @lang('Hello!')
@endif
@endif

{{-- Introductory Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Call to Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
<x-mail::button :url="$actionUrl" :color="$color" style="font-size: 18px; padding: 12px 20px;">
    {{ $actionText }}
</x-mail::button>
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (!empty($salutation))
{{ $salutation }}
@else
@lang('Best regards'),<br>
{{ config('app.name') }}
@endif

{{-- Subcopy Section --}}
@isset($actionText)
<x-slot:subcopy>
@lang(
    "If you’re unable to click the \":actionText\" button, copy and paste the following URL into your browser:",
    [
        'actionText' => $actionText,
    ]
)  
<span class="break-all" style="color: #555;">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
@endisset
</x-mail::message>
