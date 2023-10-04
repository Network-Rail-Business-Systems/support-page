@props([
    'list',
    'noBorders' => false,
])

@php
    $defaultAction = null;
    $listClasses = 'details-summary-list';

    if ($noBorders === true) {
        $listClasses .= 'details-summary-list--no-border';
    }

    foreach ($list as $item) {
        if (isset($item['action']) === true) {
            $defaultAction = true;
            break;
        }
    }
@endphp

<div class="content">
    <dl class="{{ $listClasses }}">
        @foreach($list as $key => $data)
            <x-details-page::support-item
                    :key="$key"
                    :value="$data['value'] ?? $data"
                    :action="$data['action'] ?? $defaultAction"
            />
        @endforeach
    </dl>
</div>
