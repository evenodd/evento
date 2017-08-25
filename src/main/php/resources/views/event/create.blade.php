@extends('layouts.app')

@section('script')
<script src="{{ asset('js/evento/create.js') }}"></script>
@endsection

@section('content')

@include('event.subviews.create')

@endsection
