<?php require_once 'template/header.php';				
	try {
		$user = new Cl_User();
		$categories = $user->getCategory();
		if(empty($categories)){
			$_SESSION['error'] = NO_CATEGORY;
			header('Location: home.php');exit;
		}
		} catch (Exception $e) {
			$_SESSION['error'] = $e->getMessage();
			header('Location: home.php');exit;
		}
		
	?> 
	<!-- Main content -->
	<div class="main-content">
		<h1 class="page-title">Vào thi</h1>
		<!-- Breadcrumb -->
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="index.php"><i class="fa fa-home"></i>Trang chủ</a></li> 
			<li class="active"><strong>Vào thi</strong></li> 
		</ol>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h3 class="panel-title">Chọn đề thi:</h3>
						<ul class="panel-tool-options"> 
							<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>
					<div class="panel-body">
						 <form class="form-horizontal" method="post" id='signin' name="signin" action="questions.php">
						 	<div class="form-group">
						 		<div class="col-sm-offset-1 col-sm-10"> 
						 			<select class="form-control" name="category" id="category">
										<option value="">Chọn đề thi</option>
										<?php  foreach ($categories as $key=>$category){ 
											var_dump($categories) ?>
										<option value="<?php echo $key; ?>"><?php echo $category; ?></option>
										<?php } ?>
									</select> 
									<span class="help-block"></span>
						 		</div>
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<div class="col-sm-offset-1 col-sm-10"> 
									<button id="start_btn" class="btn btn-success btn-block" type="submit">Bắt đầu!!!</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<<<<<<< HEAD
	
<?php require_once 'template/footer.php';?>
=======
</div>
  <!-- /main container -->
  
</div>
<!-- /page container -->

<!--Load JQuery-->
<script src="js/jquery.validate.min.js"></script>
<script src="js/start.js"></script>	

</body>
</html>
<?php ob_end_flush(); ?>
<?php unset($_SESSION['success'] ); unset($_SESSION['error']);  ?>    
>>>>>>> 573fbedbdaf90d7a8bd353c09926f23c5a616591
	
