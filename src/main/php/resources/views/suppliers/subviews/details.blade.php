{{--
Params: object $supplier contains all the supplier information
--}}
<p><b> {{ $supplier->name }} </b></p>
<ul class="nav nav-pills nav-stacked">
    @each('suppliers.subviews.product', $supplier->products, 'product')                                      
</ul>