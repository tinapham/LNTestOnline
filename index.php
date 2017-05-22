<?php 
ob_start();
session_start();
require_once 'config.php'; 
?>
<?php 
	if( !empty( $_POST )){
		try {
			$user_obj = new Cl_User();
			$data = $user_obj->login( $_POST );
			if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
				$_SESSION['success'] = 'You are logged in successfully';
				if($_SESSION['social_id']=='admin') {
					header('Location: index-2.php'); exit;
				} 
				header('Location: home.php');exit;
			}
		} catch (Exception $e) {
			$error = $e->getMessage();
			$_SESSION['error'] = $error;
		}
	}
	//print_r($_SESSION);
	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
		header('Location: home.php');exit;
	}
?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Mouldifi - A fully responsive, HTML5 based admin theme">
<meta name="keywords" content="Responsive, HTML5, admin theme, business, professional, Mouldifi, web design, CSS3">
<title>LN's Test Online | Login</title>
<!-- Site favicon -->
<link rel='shortcut icon' type='image/x-icon' href='images/favicon.ico' />
<!-- /site favicon -->

<!-- Entypo font stylesheet -->
<link href="css/entypo.css" rel="stylesheet">
<!-- /entypo font stylesheet -->

<!-- Font awesome stylesheet -->
<link href="css/font-awesome.min.css" rel="stylesheet">
<!-- /font awesome stylesheet -->

<!-- Bootstrap stylesheet min version -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- /bootstrap stylesheet min version -->

<!-- Mouldifi core stylesheet -->
<link href="css/mouldifi-core.css" rel="stylesheet">
<!-- /mouldifi core stylesheet -->

<link href="css/mouldifi-forms.css" rel="stylesheet">
<link href="css/login.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
<![endif]-->


</head>
<body class="login-page" style="background:url('images/bg.jpg') no-repeat center center; height:700px;">
<div class="login-container">
	<div class="login-branding">
		<a href="index-2.html"><img src="images/logo1.png" alt="Mouldifi" title="Mouldifi"></a>
	</div>
	<div class="login-content">
		<?php require_once 'template/message.php';?>
		<h2><strong>Mời bạn đăng nhập</strong></h2>
		<form id="login-form" class="form-signin" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">                        
			<div class="form-group">
				<input name="email" id="email" type="email" placeholder="Email" class="form-control" autofocus>
			</div>                        
			<div class="form-group">
				<input name="password" id="password" type="password" placeholder="Password" class="form-control">
			</div>
			<div class="form-group">
				 <div class="checkbox checkbox-replace">
					<input type="checkbox" id="remeber">
					<label for="remeber">Ghi nhớ</label>
				  </div>
			 </div>
			<div class="form-group">
				<button class="btn btn-primary btn-block bt-login">Đăng nhập</button>
			</div>
			<p class="text-center"><a href="forgot-password.php">Quên mật khẩu? | </a><a href="register.php">Đăng kí</a></p>                     
		</form>
	</div>
</div>
<!--Load JQuery-->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>

<!-- Mirrored from g-axon.com/mouldifi-3.0/light/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 18 May 2017 08:24:49 GMT -->
</html>
<?php ob_end_flush(); ?>
<?php unset($_SESSION['success'] ); unset($_SESSION['error']);  ?>    