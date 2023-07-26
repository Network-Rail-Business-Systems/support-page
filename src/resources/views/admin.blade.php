@section('main')
    <x-govuk::p>From this page you can manage various parts of the system.</x-govuk::p>
    <x-govuk::p>Select from one of the following options:</x-govuk::p>

    <x-govuk::ul spaced>
        @can('manage_support_page')
            <li>
                <x-govuk::a href="{{ route('support-details.index') }}">
                    Manage support page
                </x-govuk::a>
            </li>
        @endcan

        @can('manage_users')
            <li>
                <x-govuk::a href="{{ route('users.index') }}">
                    Manage Users and Roles
                </x-govuk::a>
            </li>
        @endcan
    </x-govuk::ul>
@endsection
