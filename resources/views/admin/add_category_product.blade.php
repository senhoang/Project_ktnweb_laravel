@extends('admin_layout')
@section('admin_content')
<div class="form-w3layouts">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save-category-product')}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục</label>
                                <input type="text" name="category_product_name" class="form-control" id="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả danh mục</label>
                                <textarea style="resize:none" rows="5" class="form-control" id="exampleInputPassword1" name="category_product_desc" placeholder="Mô tả danh mục"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Hiển thị</label>
                                <select class="form-control input-sm m-bot15" name="category_product_status" id="">
                                    <option value="1" selected>Hiển Thị</option>
                                    <option value="0">Ẩn</option>
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
                                    // echo $message;
                                    session()->put('message', null);
                                }
		                    ?>
                            <button type="submit" name="add_category_product" class="btn btn-info">Thêm</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
</div>
@endsection