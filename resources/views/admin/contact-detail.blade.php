@extends('layouts.admin')

@section('content')
    <livewire:admin.contact-detail :id="$contact->id" />
@endsection
