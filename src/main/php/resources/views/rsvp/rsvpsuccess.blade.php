@extends('layouts.app')

@section('script')
<script src="{{ asset('js/rsvp/rsvp.js') }}"></script>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>RSVP</b>
                </div>
                <div class="panel-body">
                 
                    <center><h1> Thank You! Your RSVP Has Been Submmited</h1></center>   

                </div>
            </div>
        </div>
    </div>
</div>


@endsection