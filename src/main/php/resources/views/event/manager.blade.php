@extends('layouts.app')

@section('script')
<script src="{{ asset('js/evento/manager.js') }}"></script>
@endsection

@section('content')

@include('event.subviews.manager')

@include('event.subviews.list')

@endsection
