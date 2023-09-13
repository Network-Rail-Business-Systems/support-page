@php use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion; @endphp
<head>
    <title>Support</title>
</head>
    <body>
        <section>
            <aside>
                <div style="float: right;">
                    <h2>System details</h2>
                    <x-support-page::support-summary-list :list="$list"/>
                </div>
            </aside>
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




