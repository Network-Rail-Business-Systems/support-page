<x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs" />

<div class="content">
    @if ($errors->any())
        <div class="box" style="border: 5px solid #d4351c; border-radius: 0;">
            <h2 class="title is-3">There is a problem</h2>

            @foreach ($errors->all() as $error)
                <p class="has-text-danger has-text-weight-bold">
                    {{ $error }}
                </p>
            @endforeach
        </div>
    @endif

    <h1>{{ $title }}</h1>

    <x-form-builder::description :description="$description" />

    @forelse($summary as $task)
        <div class="mb-5">

            <div class="is-flex is-justify-content-space-between is-align-items-center has-background-light p-3">
                <h2 id="{{ $task['id'] }}" class="is-size-5 has-text-weight-semibold mb-0">
                    {{ $task['title'] }}
                </h2>

                <div class="is-flex is-align-items-center" style="gap: 0.75rem;">
                    <x-form-builder::status :status="$task['status']" :colour="$task['colour']" />

                    @isset($task['actions']['change'])
                        <a
                            href="{{ $task['actions']['change']['url'] }}"
                            class="has-text-weight-semibold is-underlined"
                        >
                            {{ $task['actions']['change']['label'] }}
                        </a>
                    @endisset
                </div>
            </div>

            <table class="table is-fullwidth">
                <tbody>
                @forelse($task['list'] as $label => $details)
                    <tr>
                        <th>
                            {{ $label }}
                        </th>

                        <td>
                            {{ $details['value'] }}
                        </td>

                        <td class="has-text-right">
                            @isset($details['status'])
                                <x-form-builder::status :status="$details['status']" :colour="$details['colour']" />
                            @endisset

                            @isset($details['actions']['change'])
                                <div class="mt-1">
                                    <a
                                        href="{{ $details['actions']['change']['url'] }}"
                                        class="is-underlined"
                                    >
                                        {{ $details['actions']['change']['label'] }}
                                    </a>
                                </div>
                            @endisset
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">
                            No questions have been added to this task.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>

    @empty
        <p>No tasks have been added to this form.</p>
    @endforelse

    <x-form-builder::actions
            :actions="$actions"
            :submit="$submit"
            gap="1rem"
    />
</div>
