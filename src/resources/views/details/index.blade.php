<section>
    <div class="content">
        <p>This page allows you to manage Support Details.</p>

        <p>You can:</p>

        <ul>
            <li>
                <a href="{{ \NetworkRailBusinessSystems\SupportPage\Models\SupportDetail::startFormRoute() }}">Create a new Support
                    Detail</a>
            </li>
            <li>Manage existing Support Details</li>
        </ul>
    </div>

    <table class="table">
        <caption class="subtitle has-text-left"><b>Exising Support Details</b></caption>

        <thead>
            <tr>
                <th>Type</th>
                <th>Label</th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach($supportDetails as $supportDetail)
                <tr>
                    @if(empty($supportDetail))
                        <td>No Support Details exist</td>
                    @endif
                    <td>{{ $supportDetail->type }}</td>
                    <td>{{ $supportDetail->label }}</td>
                    <td>
                        <a href="{{ route('forms.edit', [\NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm::key(), $supportDetail->id])}}">Edit</a>
                    </td>
                    <td>
                        <a href="{{ route('support-page.admin.confirm', $supportDetail->id) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
