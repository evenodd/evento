@extends('layouts.app')

@section('script')
<script src="{{ asset('js/home/home.js') }}"></script>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>Add (or update) Supplier</b>
                </div>
                <div class="panel-body">
                <!-- TODO: form errors -->
                    <form class="form-horizontal" method="POST" >
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title-input" class="col-md-4 control-label">Supplier Name</label>
                            <div class="col-md-6">
                                <input id="title-input" type="text" class="form-control" name="title-input"  placeholder="New Supplier Name" value="Jims Catering" required autofocus>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="description-input" class="col-md-4 control-label">Description</label>
                            <div class="col-md-6">
                                <textarea id="description-input" type="text" class="form-control" name="description-input" required> Professional Wedding Catering</textarea>
                            </div>
                        </div>

                     
                      <div class="form-group ">
                        <label for="product-input" class="col-md-4 control-label">Products</label>
                            <div class="col-md-3">
                                <input id="product-name-input" type="text" class="form-control" name="title-input"  placeholder="Product Name" value="Main Meal" required autofocus>
                            </div>
                            <div class="col-md-2">
                                <input id="product-name-input" type="text" class="form-control" name="title-input"  placeholder="Price" value="$30" required autofocus>
                            </div>
                            <div class="dropdown col-md-1">
                              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Per Person
                                <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="#">Per Person</a></li>
                                <li><a href="#">Per Event</a></li>
                              </ul>
                            </div>                 
                        </div>
                        <div class="form-group ">
                        <label for="description-input" class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                <textarea id="description-input" type="text" class="form-control" name="description-input" required >Duck Soup with chives</textarea>
                            </div>
                            
                            <div class="col-md-3">
                                <button type="button" class="btn btn-default">
                                    Add Another Product
                                </button>
                            </div>
                        </div>
                        <div class="form-group ">
                        <hr>
                        <label for="product-input" class="col-md-4 control-label"></label>
                            <div class="col-md-3">
                                <input id="product-name-input" type="text" class="form-control" name="title-input"  placeholder="Product Name" required autofocus>
                            </div>
                            <div class="col-md-2">
                                <input id="product-name-input" type="text" class="form-control" name="title-input"  placeholder="Price" required autofocus>
                            </div>
                            <div class="dropdown col-md-1">
                              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Type
                                <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="#">Per Person</a></li>
                                <li><a href="#">Per Event</a></li>
                              </ul>
                            </div>                 
                        </div>
                        <div class="form-group ">
                        <label for="description-input" class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                <textarea id="description-input" type="text" class="form-control" name="description-input" required></textarea>
                            </div>
                            
                            <div class="col-md-3">
                                <button type="button" class="btn btn-default">
                                    Add Another Product
                                </button>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="text-right col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
