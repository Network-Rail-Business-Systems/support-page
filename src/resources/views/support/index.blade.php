@php use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm; @endphp

    <section>
        <div class="content">
            <p>This page allows you to manage Support Details.</p>

            <p>You can:</p>

            <ul>
                <li>
                    <a href="{{ config('support-page.support_detail_model')::startFormRoute() }}">Create a new Support Detail</a>
                </li>
                <li>Manage existing Support Details</li>
            </ul>
        </div>

        {{--            empty-message="No Support Details exist"--}}

        <table class="table">
            <caption class="subtitle has-text-left">Exising Support Details</caption>

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
                    <td>{{ $supportDetail->type }}</td>
                    <td>{{ $supportDetail->label }}</td>
                    <td>
                        <a href="{{ route('forms.edit', [SupportDetailForm::key(), $supportDetail->id])}}">Edit</a>
                    </td>
                    <td>
                        <a href="{{ route('support-page.delete', $supportDetail->id) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
