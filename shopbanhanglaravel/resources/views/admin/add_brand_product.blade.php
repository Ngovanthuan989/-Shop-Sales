@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm Thương Hiệu Sản Phẩm
                        </header>

                        <div class="panel-body">

                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-brand-product')}}" method="post">
                                 {{(csrf_field())}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Thương Hiệu</label>
                                    <input type="text" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô Tả Thương Hiệu</label>
                              <textarea style="resize: none;" rows="8" class="form-control" name="brand_product_desc" id="exampleInputPassword1" placeholder="Mô tả thương hiệu"></textarea>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Hiển Thị</label>
                                    <select name="brand_product_status" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn</option>
                                    <option value="1">Hiển thị</option>
                                    </select>
                                </div>

                                <button type="submit" name="add_brand_product" class="btn btn-info">Thêm Thương Hiệu</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection
