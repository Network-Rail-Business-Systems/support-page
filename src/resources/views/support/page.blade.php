@php use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion; @endphp
@php use NetworkRailBusinessSystems\SupportPage\resources\views\components\support-group; @endphp
@section('main')

    @foreach($groups as $type => $group)
        <x-vendor.support-page.components.support-group
                description="{{ TypeQuestion::DESCRIPTIONS[$type] }}"
                :group="$group"
                title="{{ TypeQuestion::OPTIONS[$type] }}"
        />
    @endforeach

@endsection

@section('aside')
    <x-govuk::h2>System details</x-govuk::h2>
    <x-govuk::summary-list :list="$list"/>
@endsection
