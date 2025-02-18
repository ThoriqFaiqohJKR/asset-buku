@extends('layouts.admin')

@section('content')
    <livewire:admin.asset-detail :id="$asset->id" />
@endsection
