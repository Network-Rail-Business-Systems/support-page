<div class="columns">
    <section class="column is-two-thirds">
        <p class="column is-0-desktop-only">This page allows you to manage Support Details.</p>

        <p class="column is-0-desktop-only">You can:</p>

        <div class="-list-ul" style="margin-left: 2rem;">
            <li>
                Create a new Support Detail
            </li>
            <li>
                Manage existing Support Details
            </li>
            <br/>
        </div>

        <div>
            <table
                caption="Exising Support Details"
                :data="$supportDetails"
                empty-message="No Support Details exist"
            >
                <table-column label="Type">
                    ~type
                </table-column>

                <table-column label="Label">
                    ~label
                </table-column>

                <xtable-column label="" numeric>
                    <a href="~editLink">Edit<hidden> ~type</hidden></a>
                </xtable-column>

                <table-column label="" numeric>
                    <a href="~deleteLink">Delete<hidden> ~type</hidden></a>
                </table-column>
            </table>
        </div>
    </section>

    <section class="column is-one-third">
        <aside>
            <p class="subtitle is-4"><b>Actions</b></p>
            <ul>
                <li>
                    <a href="{{ config('support-page.support_detail_model')::startFormRoute() }}">
                        Create a new Support Detail
                    </a>
                </li>
            </ul>
        </aside>
    </section>
</div>
