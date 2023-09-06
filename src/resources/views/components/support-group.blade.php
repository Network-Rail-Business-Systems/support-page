@props([
    'description',
    'group',
    'title',
])

<x-govuk::h2>{{ $title }}</x-govuk::h2>
<x-govuk::p>{{ $description }}</x-govuk::p>
<x-govuk::ul>
    @foreach($group as $supportDetail)
        <li>
            <x-govuk::a href="{{ $supportDetail->getTarget() }}" target="_blank">
                {{ $supportDetail->label }} {{ $supportDetail->getType() }}
            </x-govuk::a>
        </li>
    @endforeach
</x-govuk::ul>
