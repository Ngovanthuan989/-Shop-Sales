@extends('admin_layout')
@section('admin_content')
<link href="{{asset('public/fornt end/css/bootstrap.min.css')}}" rel="stylesheet">
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập Nhập Sản Phẩm
                        </header>

                        <div class="panel-body">
                        @foreach($edit_product as $key =>$product)
                            <div class="position-center">
                            <!-- nếu form có gửi ảnh lên thì phải có thêm cái  enctype="multipart/form-data" này -->

                                <form role="form" action="{{URL::to('/update-product/'.$product->product_id)}}" method="post" enctype="multipart/form-data">
                                 {{(csrf_field())}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Sản Phẩm</label>
                                    <input type="text" value="{{$product->product_name}}" name="product_name" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá Sản Phẩm</label>
                                    <input type="text"value="{{$product->product_price}}" name="product_price" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình Ảnh Sản Phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/upload/product/'.$product->product_image)}}" alt="" height="100" width="100">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả Sản Phẩm</label>
                              <textarea style="resize: none;" rows="8" class="form-control" name="product_desc" id="exampleInputPassword1">{{$product->product_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội Dung Sản Phẩm</label>
                              <textarea style="resize: none;" rows="8" class="form-control" name="product_content" id="exampleInputPassword1" placeholder="Nội dung sản phẩm">{{$product->product_content}}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                    <select name="product_cate" class="form-control input-sm m-bot15">
                                    <!-- lấy dữ liệu của danh mục -->
                                    @foreach($cate_product as $key => $cate)
                                        @if($cate->category_id==$product->category_id)
                                            <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @else
                                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @endif
                                    @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                                    <select name="product_brand" class="form-control input-sm m-bot15">
                                    <!-- lấy dữ liệu của thương thương hiệu -->
                                    @foreach($brand_product as $key => $brand)
                                        @if($brand->brand_id==$product->brand_id)
                                          <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        @else
                                            <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        @endif
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

                                <button type="submit" name="add_product" class="btn btn-info">Cập Nhập Sản Phẩm</button>
                            </form>
                            </div>
                        @endforeach
                        </div>

                    </section>

            </div>

@endsection
