@use(\NetworkRailBusinessSystems\SupportPage\Models\SupportDetail)
@extends('govuk::layout.page')
@php
    $title='Manage Support Details'
@endphp

@section('main')
    <x-govuk::p>This page allows you to manage Support Details.</x-govuk::p>

    <x-govuk::p>You can:</x-govuk::p>

    <x-govuk::ul bulleted spaced>
        <li>Create a new Support Detail</li>
        <li>Manage existing Support Details</li>
    </x-govuk::ul>

    <x-govuk::section-break/>

    <x-govuk::table
        caption="Exising Support Details"
        :data="$supportDetails"
        empty-message="No Support Details exist"
    >
        <x-govuk::table-column label="Type">
            ~type
        </x-govuk::table-column>

        <x-govuk::table-column label="Label">
            ~label
        </x-govuk::table-column>

        <x-govuk::table-column label="" numeric>
            <x-govuk::a href="~editLink">Edit
                <x-govuk::hidden> ~type</x-govuk::hidden>
            </x-govuk::a>
        </x-govuk::table-column>

        <x-govuk::table-column label="" numeric>
            <x-govuk::a href="~deleteLink">Delete
                <x-govuk::hidden> ~type</x-govuk::hidden>
            </x-govuk::a>
        </x-govuk::table-column>
    </x-govuk::table>
@endsection

@section('aside')
    <x-govuk::h2>Actions</x-govuk::h2>

    <x-govuk::ul spaced>
        <li>
            <x-govuk::a href="{{ SupportDetail::startFormRoute() }}">
                Create a new Support Detail
            </x-govuk::a>
    </x-govuk::ul>
@endsection
