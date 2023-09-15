@props([
    'columns'
])

<div class="content">
<th class="support-table__head">
    <x-support-page::table.row>
        @foreach($columns as $column)
            <x-support-page::table.cell
                heading
                :numeric="$column['numeric']"
            >
                {{ $column['label'] }}
            </x-support-page::table.cell>
        @endforeach
    </x-support-page::table.row>
</th>
</div>