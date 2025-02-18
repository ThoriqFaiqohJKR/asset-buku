@extends('layouts.admin')

@section('content')
    <livewire:admin.contact-edit :id="$contact->id" />
@endsection
