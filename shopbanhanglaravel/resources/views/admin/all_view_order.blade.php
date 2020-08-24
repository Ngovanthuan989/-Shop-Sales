@extends('admin_layout')
@section('admin_content')
<link href="{{asset('public/fornt end/css/bootstrap.min.css')}}" rel="stylesheet">
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
        Thông Tin Khách Hàng
    </div>
    <?php
        $message = Session::get('message');
        if ($message) {
            # code...
            echo '<span class="text-alert">'.$message.'</span>';
            Session::put('message',null);
        }
    ?>

    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>

            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>


          </tr>
        </thead>
        <tbody>


          <tr>
            <td>{{$order_by_id->customer_name}}</td>
            <td>{{$order_by_id->customer_phone}}</td>



            </span></td>
            <!-- <td><span class="text-ellipsis">7.10.2020</span></td> -->

          </tr>


        </tbody>
      </table>
    </div>

  </div>
</div>
<br><br/>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
        Thông Tin Vận Chuyển
    </div>
    <?php
        $message = Session::get('message');
        if ($message) {
            # code...
            echo '<span class="text-alert">'.$message.'</span>';
            Session::put('message',null);
        }
    ?>

    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>

            <th>Tên người vận chuyển</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>


          </tr>
        </thead>
        <tbody>


          <tr>
            <td>{{$order_by_id->shipping_name}}</td>
            <td>{{$order_by_id->shipping_address}}</td>
            <td>{{$order_by_id->shipping_phone}}</td>



            </span></td>
            <!-- <td><span class="text-ellipsis">7.10.2020</span></td> -->

          </tr>


        </tbody>
      </table>
    </div>

  </div>
</div>

<br><br/>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
       Liệt Kê Chi Tiết Đơn Hàng
    </div>
    <?php
        $message = Session::get('message');
        if ($message) {
            # code...
            echo '<span class="text-alert">'.$message.'</span>';
            Session::put('message',null);
        }
    ?>
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
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Tổng tiền</th>
          </tr>
        </thead>
        <tbody>

          <tr>

            <td>{{$order_by_id->product_name}}</td>
            <td>{{$order_by_id->product_sales_quantity}}</td>
            <td>{{$order_by_id->product_price}}</td>
            <td>{{$order_by_id->order_total}}</td>

            <!-- <td><span class="text-ellipsis">7.10.2020</span></td> -->

          </tr>


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
@endsection
