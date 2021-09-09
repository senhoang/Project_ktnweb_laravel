@extends('admin_layout')
@section('admin_content')
<div class="form-w3layouts">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach($info_products as $key => $info_product)
                        <form role="form" action="{{URL::to('/update-product/'.$info_product->product_id.'/'.$info_product->product_image)}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="product_name">Tên sản phẩm</label>
                                <input type="text" name="product_name" class="form-control" id="product_name" value="{{$info_product->product_name}}">
                            </div>
                            <div class="form-group">
                                <label for="product_price">Giá sản phẩm</label>
                                <input type="text" name="product_price" class="form-control" id="product_price" value="{{$info_product->product_price}}">
                            </div>
                            <div class="form-group">
                                <label for="product_desc">Mô tả sản phẩm</label>
                                <input type="text" name="product_desc" class="form-control" id="product_desc" value="{{$info_product->product_desc}}">
                            </div>
                            <div class="form-group">
                                <label for="product_content">Nội dung sản phẩm</label>
                                <input type="text" name="product_content" class="form-control" id="product_content" value="{{$info_product->product_content}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                <input type="file" name="product_image" class="form-control" id="" >
                                <img src="{{URL::to('public/uploads/products/'.$info_product->product_image)}}" alt="product" width="120px" height="120px">
                            </div>
                            <div class="form-group">
                                <label for="category_id">Danh mục sản phẩm</label>
                                <select class="form-control input-sm m-bot15" name="category_id" id="category_id">
                                    <option value="">--Danh mục sản phẩm--</option>
                                    @foreach($categorys as $key => $category)
                                        @if($category->category_id == $info_product->category_id)
                                        <option value="{{$category->category_id}}" selected>{{$category->category_name}}</option>
                                        @else
                                        <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="brand_id">Thương hiệu</label>
                                    <select class="form-control input-sm m-bot15" name="brand_id" id="brand_id">
                                        <option value="">--Thương hiệu--</option>
                                        @foreach($brands as $key => $brand)
                                            @if($brand->brand_id == $info_product->brand_id)
                                                <option value="{{$brand->brand_id}}" selected>{{$brand->brand_name}}</option>
                                            @else
                                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                            @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Hiển thị</label>
                                <select class="form-control input-sm m-bot15" name="product_status" id="">
                                    <?php
                                        if($info_product->product_status == 0) {
                                            echo '<option value="0" selected>Ẩn</option>
                                                <option value="1">Hiển Thị</option>';
                                        } else {
                                            echo '<option value="0">Ẩn</option>
                                                <option value="1" selected>Hiển Thị</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <?php
                                $message = session()->get('message');

                                if($message) {
                                    echo 
                                        '<div class="alert alert-success d-flex align-items-center" role="alert">
                                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                            '
                                                ,$message,
                                            '
                                        </div>';
                                    session()->put('message', null);
                                }
		                    ?>
                            <button type="submit" name="add_product" class="btn btn-info">Cập nhật</button>
                        </form>
                        @endforeach
                    </div>

                </div>
            </section>

        </div>
    </div>
</div>
@endsection