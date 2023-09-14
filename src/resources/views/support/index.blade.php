@section('main')
    <p>This page allows you to manage Support Details.</p>

    <p>You can:</p>

    <ul bulleted spaced>
        <li>Create a new Support Detail</li>
        <li>Manage existing Support Details</li>
    </ul>

    <section-break />

    <table
        caption="Exising Support Details"
        :data="$supportDetails"
        empty-message="No Support Details exist"
    >
        <table-column label="Type">
            ~type
        </table-column>

        <table-column label="Label">
            ~label
        </table-column>

        <table-column label="" numeric>
            <a href="~editLink">Edit<hidden> ~type</hidden></a>
        </table-column>

        <table-column label="" numeric>
            <a href="~deleteLink">Delete<hidden> ~type</hidden></a>
        </table-column>
    </table>
@endsection

@section('aside')
    <h2>Actions</h2>

    <ul spaced>
        <li>
            <a href="{{ config('support-page.support_detail_model')::startFormRoute() }}">
                Create a new Support Detail
            </a>
    </ul>
@endsection
