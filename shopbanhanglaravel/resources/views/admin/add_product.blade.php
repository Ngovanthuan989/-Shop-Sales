@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm Sản Phẩm
                        </header>

                        <div class="panel-body">

                            <div class="position-center">
                            <!-- nếu form có gửi ảnh lên thì phải có thêm cái  enctype="multipart/form-data" này -->
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                 {{(csrf_field())}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                                    <input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="Làm ơn điền ít nhất 3 kí tự" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá Sản Phẩm</label>
                                    <input type="text" data-validation="number" data-validation-error-msg="Làm ơn điền đúng giá tiền là số" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Giá sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình Ảnh Sản Phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả Sản Phẩm</label>
                              <textarea style="resize: none;" rows="8" class="form-control" name="product_desc" id="ckeditor1" placeholder="Mô tả sản phẩm"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội Dung Sản Phẩm</label>
                              <textarea style="resize: none;" rows="8" class="form-control" name="product_content" id="ckeditor" placeholder="Nội dung sản phẩm"></textarea>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                    <select name="product_cate" class="form-control input-sm m-bot15">
                                    <!-- lấy dữ liệu của danh mục -->
                                    @foreach($cate_product as $key => $cate)

                                        <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                    @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                                    <select name="product_brand" class="form-control input-sm m-bot15">
                                    <!-- lấy dữ liệu của thương thương hiệu -->
                                    @foreach($brand_product as $key => $brand)
                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Hiển Thị</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                    </select>
                                </div>

                                <button type="submit" name="add_product" class="btn btn-info">Thêm Sản Phẩm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection
