@section('main')
<panel
    colour="green"
    title="Support Detail created"
>
    The ID is
    <br/><strong>{{ $subject->id }}</strong>
</panel>

<h2>What would you like to do now?</h2>
<ul bulleted spaced>
    <li>
        <a href="{{ config('support-page.support_detail_model')::editFormRoute($subject) }}">
            View created Support Detail
        </a>
    </li>
    <li>
        <a href="{{ route('support-details.index') }}">
            Return to Manage Support Details page
        </a>
    </li>
</ul>

@endsection
