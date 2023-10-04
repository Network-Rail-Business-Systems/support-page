<div class="columns">
    <div class="content">
        <div class="notification is-success">
            <p class="subtitle is-3" style="text-align: center">
                <b>Support Detail created</b>
            </p>
            <p class="subtitle is-5" style="text-align: center">
                The ID is <b>{{ $subject->id }}</b>
            </p>
        </div>
        <p class="subtitle is-4"><b>What would you like to do now?</b></p>
        <ul>
            <li>
                <a href="{{ config('support-page.support_detail_model')::editFormRoute($subject) }}">
                    View created Support Detail
                </a>
            </li>
            <li>
                <a href="{{ route('details-page.index') }}">
                    Return to Manage Support Details page
                </a>
            </li>
        </ul>
    </div>
</div>
