@extends('layouts.user')

@section('content')
<livewire:user.asset-detail :assetId="$asset->id" />

@endsection
