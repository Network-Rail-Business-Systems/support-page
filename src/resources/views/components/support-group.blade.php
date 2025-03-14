@props([
    'description',
    'group',
    'title',
])

<div class="content">
    <p class="subtitle is-3">{{ $title }}</p>
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

