@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê danh mục sản phẩm
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                </select>
                <button class="btn btn-sm btn-default">Apply</button>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Tên danh mục</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_category_product as $key => $cate_pro)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{$cate_pro->category_name}}</td>
                        <td><span class="text-ellipsis">{{$cate_pro->category_desc}}</span></td>
                        <td><span class="text-ellipsis">
                                <?php
                                if ($cate_pro->category_status == 0) {
                                ?>
                                    <a href="{{URL::to('/active-category-product/'.$cate_pro->category_id)}}" class="my-eye-status">
                                        <i class="fa fa-eye-slash"></i>
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <a href="{{URL::to('/unactive-category-product/'.$cate_pro->category_id)}}"> <i class="fa fa-eye alert-success"></i></a>
                                <?php
                                }
                                ?>
                            </span></td>
                        <td>
                            <a href="{{URL::to('/edit-category-product/'.$cate_pro->category_id)}}" class="">
                                <i class="fa fa-pencil text-success"></i>
                            </a>
                        </td>
                        <td>
                            <a onclick="return confirm('Dữ liệu sẽ không thể khôi phục?')" href="{{URL::to('/delete-category-product/'.$cate_pro->category_id)}}" class="">
                                <i class="fa fa-times text-danger"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">

                <div class="col-sm-5 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                </div>
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                        <li><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var scrollpos = localStorage.getItem('scrollpos');
        if (scrollpos) window.scrollTo(0, scrollpos);
    });

    window.onbeforeunload = function(e) {
        localStorage.setItem('scrollpos', window.scrollY);
    };
</script>
@endsection