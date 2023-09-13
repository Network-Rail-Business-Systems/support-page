@props([
    'key',
    'value',
    'action' => null,
])

@php
    if (is_array($value) !== true) {
        $value = [$value];
    }

    $rowClasses = $action !== null
        ? 'support-summary-list__row'
        : 'support-summary-list__row support-summary-list__row--no-actions';
@endphp

<div class="{{ $rowClasses }}">
    <dt class="support-summary-list__key">
        {!! $key !!}
    </dt>
    
    <dd class="support-summary-list__value">
        @foreach($value as $entry)
            <p>{!! $entry !!}</p>
        @endforeach
    </dd>
    
    @isset($action)
        <dd class="support-summary-list__actions">
            @if ($action !== true)
                @if ($action['asButton'] ?? false === true)
                    <form :action="$action['url']" :method="$action['method'] ?? 'post'">
                        <button as-link>
                            {{ $action['label'] }}
                            @isset($action['hidden'])
                                <hidden>{{ $action['hidden'] }}</hidden>
                            @endisset
                        </button>
                    </form>
                @else
                    <a href="{{ $action['url'] }}">
                        {{ $action['label'] }}
                        @isset($action['hidden'])
                            <hidden>{{ $action['hidden'] }}</hidden>
                        @endisset
                    </a>
                @endif
            @endif
        </dd>
    @endisset
</div>
