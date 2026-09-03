<x-support-page::breadcrumbs :breadcrumbs="$breadcrumbs" />

<div class="content">
    <h1>{{ $title }} - IN SUPPORT</h1>

    <x-support-page::description :description="$description" />

    @isset($status)
        <x-support-page::status :status="$status" :colour={{ $colour ?? null }}" />
    @endisset

    <table class="table is-fullwidth">
        <tbody>
            @forelse($questions as $label => $details)
                <tr>
                    <th>
                        {{ $label }}
                    </th>

                    <td>
                        {{ $details['value'] }}
                    </td>

                    <td class="has-text-right">
                        @isset($details['status'])
                            <x-support-page::status :status="$details['status']" :colour="$details['colour']" />
                        @endisset

                        @isset($details['actions']['change'])
                            <a
                                href="{{ $details['actions']['change']['url'] }}"
                                class="is-underlined ml-3"
                            >
                                {{ $details['actions']['change']['label'] }}
                            </a>
                        @endisset
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        No questions have been added to this task.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <x-support-page::actions
        :actions="$actions"
        primary="back"
    />
</div>
