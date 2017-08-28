{{--
Params:
    object  $product contains a supplier's product information
--}}

 <li role="presentation">
    <div class="row">
        <a href="#">
            <div class=" col-xs-4 "> {!! $product->name !!}</div>
            <div class="col-xs-4 text-right"> <b> Price </b> ${{ sprintf('%01.2f', $product->price) }} x 
                <span class="ml-1"><button class="sl-2 btn btn-primary btn-xs"><span class="badge" name="event-guest-nb">{{ $product->multiplier}} </span> {{ $product->multiplierType }}</button></span>
                = ${{ sprintf('%01.2f', $product->price * $product->multiplier) }}
            </div>
            <div class="col-xs-4 text-right">
                <button class="btn btn-default"> Click For Details </button>
            </div>
        </a> 
    </div>
</li>

@if (property_exists($product, 'last'))
    <br>
@else
    <hr>
@endif