<x-support-page::breadcrumbs :breadcrumbs="$breadcrumbs" />

<div id="content">
    <div class="content">
        <h2 class="subtitle is-4">{{ $title }}</h2>

        <x-support-page::description :description="$description" />

        <x-support-page::actions
            :actions="$actions"
            primary="resume"
            secondary="restart"
        />
    </div>
</div>
