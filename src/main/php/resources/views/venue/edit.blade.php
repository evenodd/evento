@extends('layouts.app')

@section('script')
<script src="{{ asset('js/venue/editVenue.js') }}"></script>
@endsection

<!-- small change -->

@section('content')
    <div id="venueData" data-venue="{{ $venue }}"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @component('components.alerts')
                @endcomponent
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Update Venue</b>
                    </div>
                    <div class="panel-body">
                        <venue-form
                            id="updateVenueForm"
                            :venue="venue"
                            :token="token"
                            v-on:failed="showError">
                        </venue-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
