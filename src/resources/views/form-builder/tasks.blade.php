@php
    $currentGroup = null;
@endphp

<x-support-page::breadcrumbs :breadcrumbs="$breadcrumbs" />

<div class="content">
    <h1>{{ $title }}</h1>

    <x-support-page::description :description="$description" />

    @forelse($tasks as $task)
        @if($task['group'] !== $currentGroup && $task['group'] !== null)
            <h2 class="title is-4 mt-5">
                {{ $task['group'] }}
            </h2>
        @endif

        <hr class="my-2">

        <div
            id="{{ $task['id'] }}"
            class="is-flex is-justify-content-space-between is-align-items-center py-2"
        >
            <div>
                @if($task['url'] !== null)
                    <a href="{{ $task['url'] }}">
                        {{ $task['label'] }}
                    </a>
                @else
                    {{ $task['label'] }}
                @endif

                @foreach($task['hint'] as $hint)
                    <p class="has-text-grey mt-1 mb-0">
                        {{ $hint }}
                    </p>
                @endforeach
            </div>

            <div class="ml-5">
                <x-support-page::status :status="$task['status']" :colour="$task['colour']" />
            </div>
        </div>

        <hr class="my-2">

        @php
            $currentGroup = $task['group'];
        @endphp
    @empty
        <div class="notification is-light">
            No tasks have been added to this form.
        </div>
    @endforelse

    <x-support-page::actions
        :actions="$actions"
        primary="summary"
        gap="1rem"
    />
</div>
