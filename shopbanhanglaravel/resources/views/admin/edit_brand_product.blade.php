@extends('admin_layout')
@section('admin_content')
<link href="{{asset('public/fornt end/css/bootstrap.min.css')}}" rel="stylesheet">
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập Nhập Thương Hiệu Sản Phẩm
                        </header>
                        <?php
                                $message = Session::get('message');
                                if ($message) {
                                    # code...
                                    echo '<span class="text-alert">'.$message.'</span>';
                                    Session::put('message',null);
                                }
                            ?>
                        <div class="panel-body">




                             <!-- cách 2 dùng model -->
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-brand-product/'.$edit_brand_product->brand_id)}}" method="post">
                                 {{(csrf_field())}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Danh Mục</label>
                                    <input type="text" value="{{$edit_brand_product ->brand_name}}" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả Danh Mục</label>
                              <textarea style="resize: none;" rows="8" class="form-control" name="brand_product_desc" id="exampleInputPassword1" placeholder="Mô tả danh mục">{{$edit_brand_product ->brand_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Hiển Thị</label>
                                    <select name="brand_product_status" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                    </select>
                                </div>

                                <button type="submit" name="add_brand_product" class="btn btn-info">Cập Nhập Thương Hiệu</button>
                            </form>
                            </div>
                            <!-- ------------------------ -->
                        </div>
                    </section>

            </div>

@endsection
