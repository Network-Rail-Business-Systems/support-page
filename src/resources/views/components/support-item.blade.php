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

<div class="content">
    <table class="table">
        <div class="{{ $rowClasses }}">
            <tr class="support-summary-list__key">
                <th>{!! $key !!}</th>
            </tr>

            <tr class="support-summary-list__value">
                @foreach($value as $entry)
                    <td>{!! $entry !!}</td>
                @endforeach
            </tr>

            @isset($action)
                <dd class="support-summary-list__actions">
                    @if ($action !== true)
                        @if ($action['asButton'] ?? false === true)
                            <form action="$action['url']" method="$action['method'] ?? 'post'">
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
    </table>
</div>