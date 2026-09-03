@props([
    'status',
    'colour' => null,
])

<span
    @class([
        'tag',
        'is-light' => $colour === null,
        'is-info is-light' => $colour === 'blue',
        'is-success is-light' => $colour === 'green',
        'is-danger is-light' => $colour === 'red',
    ])
>
    {{ $status }}
</span>
