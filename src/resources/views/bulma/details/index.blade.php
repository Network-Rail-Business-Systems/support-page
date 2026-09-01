@use(NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm)
@use(NetworkRailBusinessSystems\SupportPage\Models\SupportDetail)

<div class="content">
    <h2>{{ $title }}</h2>

    <p>This page allows you to manage Support Details.</p>
    <p>You can:</p>

    <ul>
        <li>
            <a href="{{ SupportDetail::formRoute() }}">
                Create a new Support Detail
            </a>
        </li>

        <li>
            Manage existing Support Details
        </li>
    </ul>

    <table class="table is-fullwidth">
        <caption class="subtitle has-text-left">
            <strong>
                Existing Support Details
            </strong>
        </caption>
        <thead>
            <tr>
                <th>Type</th>
                <th>Label</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @forelse($supportDetails as $supportDetail)
            <tr>
                <td>{{ $supportDetail->type }}</td>
                <td>{{ $supportDetail->label }}</td>
                <td>
                    <a href="{{ route('forms.edit', [SupportDetailForm::key(), $supportDetail->id])}}">Edit</a>
                </td>
                <td>
                    <a href="{{ route(SupportDetail::routeName('delete'), $supportDetail->id) }}">Delete</a>
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="4">
                    No Support Details exist
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>