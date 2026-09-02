<x-support-page::breadcrumbs :breadcrumbs="$breadcrumbs" />

<div class="content">
    <h1>{{ $title }}</h1>

    <x-support-page::description :description="$description" />
    <x-support-page::actions :actions="$actions" />
</div>
