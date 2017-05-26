<?php
	ob_start();
	session_start();
	ini_set('display_errors', 'off');
    ini_set('log_errors', 'on');
    ini_set('error_log','php-error.log');
	if (isset($_SESSION['social_id']) == true) {
		// Ngược lại nếu đã đăng nhập
		$permission = $_SESSION['social_id'];
		// Kiểm tra quyền của người đó có phải là admin hay không
		if ($permission == 'admin') {
			require_once 'template/header-admin.php';
		} else require_once 'template/header.php';
	} 
?>
<?php
	if( !empty( $_POST )){
		try {
			$user_obj = new Cl_User();
			$data = $user_obj->account( $_POST );
			var_dump($data);
			if($data) {
				$_SESSION['success'] = PASSWORD_CHANGE_SUCCESS;
				header('Location: index.php'); exit;
			}
		} catch (Exception $e) {
			$_SESSION['error'] = $e->getMessage();
		} 
	}
?>

<div class="main-content">
	<h1 class="page-title">Quản lí tài khoản</h1>
		<!-- Breadcrumb -->
	<ol class="breadcrumb breadcrumb-2"> 
			<li><a href=""><i class="fa fa-home"></i>Trang chủ</a></li> 
			<li class="active"><strong>Quản lí tài khoản</strong></li> 
	</ol>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<h3 class="panel-title">Tài khoản của tôi</h3>
					<?php require_once 'template/message.php';  ?>
					<ul class="panel-tool-options"> 
						<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
						<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
						<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
					</ul>
				</div>
				<div class="panel-body">
					<form class="form-horizontal myaccount" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="account-form" method="post" role="form">
						<div class="form-group"> 
							<label class="col-sm-2 control-label">Tên</label> 
							<div class="col-sm-10"> 
								<input type="text" placeholder="Tên" class="form-control" value="<?php echo $_SESSION['name']; ?>" readonly> 
							</div> 
						</div>
						<div class="line-dashed"></div>
						<div class="form-group"> 
							<label class="col-sm-2 control-label">Email</label> 
							<div class="col-sm-10"> 
								<input name="email" type="text" placeholder="Email" class="form-control" value="<?php echo $_SESSION['email']; ?>" readonly> 
							</div> 
						</div>
						<div class="line-dashed"></div>
						<div class="form-group"> 
							<label class="col-sm-2 control-label">Mật khẩu hiện tại</label> 
							<div class="col-sm-10"> 
								<input name="old_password" type="password" placeholder="Mật khẩu hiện tại" class="form-control"> 
								<span class="help-block"></span>
							</div> 
						</div>
						<div class="line-dashed"></div>
						<div class="form-group"> 
							<label class="col-sm-2 control-label">Mật khẩu mới</label> 
							<div class="col-sm-10"> 
								<input name="password" type="password" placeholder="Mật khẩu mới" class="form-control"> 
								<span class="help-block"></span>
							</div> 
						</div>
						<div class="line-dashed"></div>
						<div class="form-group"> 
							<div class="col-sm-offset-5 col-sm-10"> 
								<button class="btn btn-primary" type="submit">Lưu thay đổi</button> 
							</div> 
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

