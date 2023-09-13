@php use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion; @endphp
<head>
<body>
<section>
    <aside>
        <div style="float: right;">
            <h2>System details</h2>
            <x-support-page::support-summary-list :list="$list"/>
        </div>
    </aside>
</section>
<section>
    <header>
        <div class="container is-fullhd">
            <h2> Support</h2>
        </div>
    </header>
</section>

<div>
    <section>
        @foreach($groups as $type => $group)
            <x-support-page::support-group
                    description="{{ TypeQuestion::DESCRIPTIONS[$type] }}"
                    :group="$group"
                    title="{{ TypeQuestion::OPTIONS[$type] }}"
            />
        @endforeach
    </section>
</div>
</body>
</head>




