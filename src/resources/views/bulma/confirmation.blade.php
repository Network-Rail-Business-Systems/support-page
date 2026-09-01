<x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs" />

<div class="content">
    <h1>{{ $title }}</h1>

    <x-form-builder::description :description="$description" />
    <x-form-builder::actions :actions="$actions" />
</div>
