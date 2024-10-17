@use(\NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion)
<div class="content">
    <h2>{{ $title }}</h2>
    <div class="columns">
        <section class="column is-two-thirds">
            @foreach($groups as $type => $group)
                <x-support-page::support-group
                    description="{{ TypeQuestion::DESCRIPTIONS[$type] }}"
                    :group="$group"
                    title="{{ TypeQuestion::OPTIONS[$type] }}"
                />
            @endforeach
        </section>

        <section class="column is-one-third">
            <aside>
                <p class="subtitle is-4"><b>System details</b></p>
                <x-support-page::support-summary-list :list="$list"/>
            </aside>
        </section>
    </div>
</div>
