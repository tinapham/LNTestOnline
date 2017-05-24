<?php require_once 'template/header.php';?>
<?php 
	if( !empty( $_POST )){
		try {
			$user_obj = new Cl_User();
			$data = $user_obj->account( $_POST );
			if($data)$_SESSION['success'] = PASSOWRD_CHANAGE_SUCCESS;
		} catch (Exception $e) {
			$_SESSION['error'] = $e->getMessage();
		} 
	}
?>

<div class="main-content">
	<h1 class="page-title">Quản lí đề thi</h1>
		<!-- Breadcrumb -->
	<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="index-2.php"><i class="fa fa-home"></i>Trang chủ</a></li> 
			<li class="active"><strong>Quản lí đề thi</strong></li> 
	</ol>
	<div class="row">