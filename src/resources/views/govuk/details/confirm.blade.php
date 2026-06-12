@extends('govuk::layout.page')
@section('main')
    <x-govuk::p>Deleting this Support Detail will immediately remove it and all of its contents.</x-govuk::p>
    <x-govuk::p>This action cannot be undone.</x-govuk::p>
    <x-govuk::p><b>Do you want to continue?</b></x-govuk::p>

    <x-govuk::form action="{{ $action }}" method="{{ $method }}">
        <x-govuk::button-group>
            <x-govuk::button :type="$submitButtonType" prevent-double-click>
                {{ $submitButtonLabel }}
            </x-govuk::button>

            <x-govuk::a href="{{ route('support-page.admin.index') }}">
                Cancel
            </x-govuk::a>
        </x-govuk::button-group>
    </x-govuk::form>
@endsection
