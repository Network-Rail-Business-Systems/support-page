@props([
    'description',
    'group',
    'title',
])

<div class="content">
    <h2 class="subtitle is-4">{{ $title }}</h2>
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
</div>

