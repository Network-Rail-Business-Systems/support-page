@props([
    'description',
    'group',
    'title',
])

<h2>{{ $title }}</h2>
<p>{{ $description }}</p>
<ul>
    @foreach($group as $supportDetail)
        <li>
            <a href="{{ $supportDetail->getTarget() }}" target="_blank">
                {{ $supportDetail->label }} {{ $supportDetail->getType() }}
            </a>
        </li>
    @endforeach
</ul>
