<x-support-page::breadcrumbs :breadcrumbs="$breadcrumbs" />

<div id="content">
    @if($hideTitle === false)
        <h1 class="title is-2">{{ $title }}</h1>

        @include('support-page::components.description', [
            'description' => $description,
        ])
    @endif

    <form
        action="{{ $save->link }}"
        enctype="multipart/form-data"
        method="POST"
    >
        @csrf

        @yield('before-fields')

        @forelse($fields as $field)
            <x-support-page::field :field="$field" />
        @empty
            <div class="notification is-warning is-light">
                No fields have been added to this question.
            </div>
        @endforelse

        @yield('after-fields')

        <x-support-page::actions
            :actions="$actions"
            :submit="$save"
            gap="1rem"
        />
    </form>
</div>
