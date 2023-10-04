<div class="content">
    <p>Deleting this Support Detail will immediately remove it and all of its contents.</p>
    <p>This action cannot be undone.</p>
    <p><b>Do you want to continue?</b></p>
</div>

<form action="{{ route('details-page.admin.delete', $supportDetail->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <div class="field is-grouped">
        <p class="control">
            <button class="button is-danger">Delete</button>
        </p>

        <p class="control">
            <a class="button" href="{{ route('details-page.admin.index') }}">Cancel</a>
        </p>
    </div>
</form>
