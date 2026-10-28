@use(NetworkRailBusinessSystems\SupportPage\Models\SupportDetail)

<x-support-page::layout>
    <div class="column is-full">
        <div class="is-flex" style="justify-content: space-between; flex-wrap: wrap;">
            <h2 class="title mb-3">{{ $title }}</h2>
        </div>
    </div>

    <div class="column is-full">
        <section>
            <div class="content">
                <p>Deleting this Support Detail will immediately remove it and all of its contents.</p>
                <p>This action cannot be undone.</p>
                <p><b>Do you want to continue?</b></p>
            </div>

            <form action="{{ route(SupportDetail::routeName('delete'), $supportDetail->id) }}"
                method="{{ $method }}">
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
        </section>
    </div>
</x-support-page::layout>
