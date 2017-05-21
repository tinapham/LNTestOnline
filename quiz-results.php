<?php require_once 'template/header.php';	
	try {
		$user = new Cl_User();
		$results = $user->getResults();
		if(empty($results)){
			// $_SESSION['error'] = NO_CATEGORY;
			header('Location: home.php');exit;
		}
	} catch (Exception $e) {
		$_SESSION['error'] = $e->getMessage();
		header('Location: home.php');exit;
	}
?>

<!-- Main content -->
<div class="main-content">
	<h1 class="page-title">Data Tables</h1>
		<!-- Breadcrumb -->
	<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="home.php"><i class="fa fa-home"></i>Trang chủ</a></li> 
			<li class="active"><strong>Lịch sử thi</strong></li> 
	</ol>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<h3 class="panel-title">Kết quả các lần thi</h3>
					<ul class="panel-tool-options"> 
						<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
						<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
						<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
					</ul>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example" >
							<thead>
								<tr>
									<th>Mã bài thi</th>
									<th>Môn học</th>
									<th>Câu trả lời đúng</th>
									<th>Câu trả lời sai</th>
									<th>Câu chưa trả lời</th>
									<th>Điểm số</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								foreach ($results as $result) { 
								?>
								<tr class="gradeX">
									<td><?php echo $result['id'];?></td>
									<td><?php echo $result['category_name'];?></td>
									<td><?php echo $result['right_answer'];?></td>
									<td><?php echo $result['wrong_answer'];?></td>
									<td><?php echo $result['unanswered'];?></td>
									<td><?php 
										$right = (int) $result['right_answer'];
										$total = $right+$result['wrong_answer']+$result['unanswered'];
										if($total==0) echo 0; 
										else echo round($right*10/$total , 1);
									?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require_once 'template/footer.php';?>