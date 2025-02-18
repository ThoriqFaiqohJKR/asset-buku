@extends('layouts.user')

@section('content')
<livewire:user.buku-detail :bookId="$book->id" />

@endsection
