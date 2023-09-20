

<div class="columns">
    <section class="column is-one-third">
        <div class="notification is-warning">
            <p class="subtitle is-3" style="text-align: center">
                <b>Confirm deletion of Support Detail {{ $subject->id }}</b>
            </p>
        </div>
        <div>
            <a class="button is-danger" href="{{ route('support-page.delete', $supportDetail->id) }}">Delete</a>

            <a class="button" href="{{ route('support-page.index') }}">Cancel</a>
        </div>
    </section>
</div>
