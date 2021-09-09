@extends('admin_layout')
@section('admin_content')
<div class="form-w3layouts">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach($info_brand_products as $key => $info_brand_product)
                        <form role="form" action="{{URL::to('/update-brand-product/'.$info_brand_product->brand_id)}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" name="brand_product_name" class="form-control" id="" value="{{$info_brand_product->brand_name}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả danh mục</label>
                                <textarea style="resize:none" rows="5" class="form-control" id="exampleInputPassword1" name="brand_product_desc" placeholder="Mô tả danh mục">{{$info_brand_product->brand_desc}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Hiển thị</label>
                                <select class="form-control input-sm m-bot15" name="brand_product_status" id="">
                                    <?php
                                        if($info_brand_product->brand_status == 0) {
                                            echo '<option value="0" selected>Ẩn</option>
                                                  <option value="1">Hiển Thị</option>';
                                        } else {
                                            echo '<option value="0">Ẩn</option>
                                                  <option value="1" selected>Hiển Thị</option>';
                                        }

                                    ?>
                                </select>
                            </div>
                            <button type="submit" name="add_brand_product" class="btn btn-info">Cập nhật</button>
                        </form>
                        @endforeach
                    </div>

                </div>
            </section>

        </div>
    </div>
</div>
@endsection