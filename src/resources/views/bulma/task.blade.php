<x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs" />

<div class="content">
    <h1>{{ $title }}</h1>

    <x-form-builder::description :description="$description" />

    @isset($status)
        <x-form-builder::status :status="$status" :colour={{ $colour ?? null }}" />
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
                            <x-form-builder::status :status="$details['status']" :colour="$details['colour']" />
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

    <x-form-builder::actions
        :actions="$actions"
        primary="back"
    />
</div>
