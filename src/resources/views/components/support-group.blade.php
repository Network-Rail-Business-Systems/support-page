@props([
    'description',
    'group',
    'title',
])

<div class="content">
    <h4 class="subtitle is-4">{{ $title }}</h4>
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

