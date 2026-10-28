@php
    $layoutName = config('support-page.layout.name');
    $layoutSection = config('support-page.layout.section');
@endphp

@if($layoutName !== null)
    @extends($layoutName)
@endif

@if($layoutSection !== null)
    @section($layoutSection)
@endif

{{ $slot }}

@if($layoutSection !== null)
    @endsection
@endif
