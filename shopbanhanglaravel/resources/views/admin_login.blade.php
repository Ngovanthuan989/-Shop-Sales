
<!DOCTYPE html>
<head>
<title>Trang quản lý Admin Web</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{('public/backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet">
<!-- //font-awesome icons -->
<script src="{{('/public/backend/js/jquery2.0.3.min.js')}}"></script>

<style>

body {
    font-family: 'Roboto', sans-serif;
    font-size: 100%;
    overflow-x: hidden;
    background: url(../images/bg.jpg) no-repeat 0px 0px;
    background-size: cover;
}
span.text-alert {
    color: red;
    font-size: 17px;
    width: 100%;
    text-align: center;
    font-weight: bold;
}
</style>
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<h2>Đăng Nhập</h2>
    <?php
       $message = Session::get('message');
       if ($message) {
           # code...
           echo '<span class="text-alert">'.$message.'</span>';
           Session::put('message',null);
       }
    ?>
	 	<form action="{{URL::to('/admin-dashboard')}}" method="post">
         <!-- tạo token -->
            {{csrf_field()}}
			<input type="text" class="ggg" name="admin_email" placeholder="Điền email" required="">
			<input type="password" class="ggg" name="admin_password" placeholder="Điền password" required="">
			<span><input type="checkbox" />Nhớ Đăng Nhập</span>
			<h6><a href="#">Quên Mật Khẩu</a></h6>
				<div class="clearfix"></div>
				<input type="submit" value="Đăng Nhập" name="login">
		</form>
        <a href="{{URL::to('/login-facebook')}}">Login Facebook</a>
		<!-- <p>Don't Have an Account ?<a href="registration.html">Create an account</a></p> -->
</div>
</div>
<script src="{{asset('/public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('/public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('/public/backend/js/scripts.js')}}"></script>
<script src="{{asset('/public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('/public/backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('/public/backend/js/jquery.scrollTo.js')}}"></script>





</body>
</html>
