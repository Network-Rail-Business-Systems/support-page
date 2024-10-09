@use(\NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion)
@extends('govuk::layout.page')
@php
$title = 'Support'
@endphp
@section('main')
    @foreach($groups as $type => $group)
        <x-support-page::support-group
                description="{{ TypeQuestion::DESCRIPTIONS[$type] }}"
                :group="$group"
                title="{{ TypeQuestion::OPTIONS[$type] }}"
        />
    @endforeach

@endsection

@section('aside')
    <x-govuk::h2>System details</x-govuk::h2>
    <x-govuk::summary-list :list="$list"/>
@endsection
