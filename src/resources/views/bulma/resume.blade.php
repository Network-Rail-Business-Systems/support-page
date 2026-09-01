<x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs" />

<div id="content">
    <div class="content">
        <h2 class="subtitle is-4">{{ $title }}</h2>

        <x-form-builder::description :description="$description" />

        <x-form-builder::actions
            :actions="$actions"
            primary="resume"
            secondary="restart"
        />
    </div>
</div>
