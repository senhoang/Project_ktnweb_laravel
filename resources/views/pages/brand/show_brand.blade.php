@extends('layouts.master')
@section('content')
<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Danh muc theo cai </h2>
    @foreach($products as $key => $product)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <!-- <img src="public/uploads/products/{{$product->product_image}}" alt="" width="220px" height="220px"/> -->
                    <img src="{{URL::to('/public/uploads/products/'.$product->product_image)}}" alt="" width="220px" height="220px" />
                    <h2>@money($product->product_price)</h2>
                    <p>{{$product->product_name}}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
<!--features_items-->