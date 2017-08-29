@extends('layouts.app')

@section('script')
<script src="{{ asset('js/home/home.js') }}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">        
                <div class="panel-heading"><b>Supplier View</b></div>
                <div class="panel-body">
                    @include('suppliers.subviews.details', [
                        'supplier' => (object)[
                            'name' => 'Jims Catering',
                            'products' => array(
                                (object) [
                                    'name' => '<b>Main Meal: </b> Duck Soup', 
                                    'price' => 30, 
                                    'multiplier' => 5, 
                                    'multiplierType' => 'Guests'
                                ],
                                (object) [
                                    'name' => '<b>Buffet: </b> Vegetariann', 
                                    'price' => 900, 
                                    'multiplier' => 1, 
                                    'multiplierType' => 'Event',
                                    'last' => true
                                ]
                            )
                        ]
                    ])                                      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
