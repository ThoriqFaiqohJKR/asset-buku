@extends('layouts.admin')

@section('content')
    <livewire:admin.peminjaman-edit :id="$peminjaman->id" />
@endsection
