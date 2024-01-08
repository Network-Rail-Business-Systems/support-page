@section('main')
    <x-govuk::panel
            colour="green"
            title="Support Detail created"
    >
        The ID is
        <br/><strong>{{ $subject->id }}</strong>
    </x-govuk::panel>

    <x-govuk::h2>What would you like to do now?</x-govuk::h2>
    <x-govuk::ul bulleted spaced>
        <li>
            <x-govuk::a href="{{ \NetworkRailBusinessSystems\SupportPage\Models\SupportDetail::editFormRoute($subject) }}">
                View created Support Detail
            </x-govuk::a>
        </li>
        <li>
            <x-govuk::a href="{{ route('support-page.admin.index') }}">
                Return to Manage Support Details page
            </x-govuk::a>
        </li>
    </x-govuk::ul>
@endsection
