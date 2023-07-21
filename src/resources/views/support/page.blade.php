@section('main')

    @foreach($groups as $type => $group)
        <x-support-group
            description="{{ \App\Forms\SupportDetail\Questions\TypeQuestion::DESCRIPTIONS[$type] }}"
            :group="$group"
            title="{{ \App\Forms\SupportDetail\Questions\TypeQuestion::OPTIONS[$type] }}"
        />
     @endforeach

@endsection

@section('aside')
    <x-govuk::h2>System details</x-govuk::h2>
    <x-govuk::summary-list :list="$list" />
@endsection
