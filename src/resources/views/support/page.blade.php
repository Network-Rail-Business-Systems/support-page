@php use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion; @endphp
<body>

<div class="title">
    <div class="container is-fullhd">
        <h2> Support</h2>
    </div>
</div>

<div>
    @foreach($groups as $type => $group)
        <x-support-page::support-group
                description="{{ TypeQuestion::DESCRIPTIONS[$type] }}"
                :group="$group"
                title="{{ TypeQuestion::OPTIONS[$type] }}"
        />
    @endforeach
</div>

<div style="float:right;">
    <h2>System details<div>
            <x-support-page::support-summary-list :list="$list"/>
        </div>
</body>
