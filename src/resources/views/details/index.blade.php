@use(\NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm)
@use(\NetworkRailBusinessSystems\SupportPage\Models\SupportDetail)

<section>
    <div class="content">
        <h2>{{ $title }}</h2>
        <p>This page allows you to manage Support Details.</p>

        <p>You can:</p>

        <ul>
            <li>
                <a href="{{ SupportDetail::startFormRoute() }}">Create a new Support
                    Detail</a>
            </li>
            <li>Manage existing Support Details</li>
        </ul>
    </div>

    <table class="table">
        <caption class="subtitle has-text-left"><b>Existing Support Details</b></caption>

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
                    <a href="{{ route('forms.edit', [SupportDetailForm::key(), $supportDetail->id])}}">Edit</a>
                </td>
                <td>
                    <a href="{{ route('support-page.admin.confirm', $supportDetail->id) }}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</section>
