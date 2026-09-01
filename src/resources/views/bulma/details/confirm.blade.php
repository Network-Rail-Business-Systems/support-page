@use(NetworkRailBusinessSystems\SupportPage\Models\SupportDetail)


<div class="content">
    <h2>{{ $title }}</h2>
    <p>Deleting this Support Detail will immediately remove it and all of its contents.</p>
    <p>This action cannot be undone.</p>
    <p><b>Do you want to continue?</b></p>
</div>

<form action="{{ route(SupportDetail::routeName('delete'), $supportDetail->id) }}" method="{{ $method }}">
    @csrf
    @method($action)
    <div class="field is-grouped">
        <p class="control">
            <button class="button is-danger">Delete</button>
        </p>

        <p class="control">
            <a class="button" href="{{ route(SupportDetail::routeName('index')) }}">Cancel</a>
        </p>
    </div>
</form>