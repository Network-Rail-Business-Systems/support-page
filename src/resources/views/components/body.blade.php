@props([
    'columns',
    'emptyMessage' => null,
    'rows' => [],
])

<div class="content"
<tbody class="support-table__body">
    @empty($rows)
        <x-support-page::table.row>
            <x-support-page::table.cell
                colour="dark-grey"
                colspan="{{ count($columns) }}"
            >
                {!! $emptyMessage !!}
            </x-support-page::table.cell>
        </x-support-page::table.row>
    @else
        @foreach($rows as $row)
            <x-support-page::table.row>
                @foreach($columns as $column)
                    <x-support-page::table.cell
                        :heading="$column['heading']"
                        :numeric="$column['numeric']"
                    >
                        {!! AnthonyEdmonds\GovukLaravel\Helpers\GovukComponent::renderTableContent($column, $row) !!}
                    </x-support-page::table.cell>
                @endforeach
            </x-support-page::table.row>
        @endforeach
    @endempty
</tbody>
</div>
