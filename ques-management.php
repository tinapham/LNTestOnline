<?php require_once 'template/header-admin.php';	
	try {
		$user = new Cl_User();
		$results = $user->getListQuestions();
		if(empty($results)){
			$_SESSION['error'] = NO_QUESTION;
			header('Location: home.php');exit;
		}
	} catch (Exception $e) {
		$_SESSION['error'] = $e->getMessage();
		header('Location: home.php');exit;
	}
?>
<div class="main-content">
	<h1 class="page-title">Danh sách câu hỏi</h1>
		<!-- Breadcrumb -->
	<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="index-2.php"><i class="fa fa-home"></i>Trang chủ</a></li> 
			<li>Quản lí câu hỏi</li> 
			<li class="active"><strong>Danh sách câu hỏi</strong></li> 
	</ol>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<h3 class="panel-title">Kết quả các lần thi</h3>
					<ul class="panel-tool-options"> 
						<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
						<li><a class="btn" data-toggle="modal" data-target="#myModal"><span class="icon-plus"></span>Thêm câu hỏi</a></li>
					</ul>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example" >
							<thead>
								<tr>
									<th>Stt</th>
									<th>Câu hỏi</th>
									<th>Choice 1</th>
									<th>Choice 2</th>
									<th>Choice 3</th>
									<th>Choice 4</th>
									<th>Choice 5</th>
									<th>Choice 6</th>
									<th>Đáp án</th>
									<th>Môn thi</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								foreach ($results as $result) { 
								?>
								<tr class="gradeX" a href="question-detail.php">
									<td><?php echo $result['id'];?></td>
									<td><?php echo substr($result['question_name'],0,10)."...";?></td>
									<td><?php 
										if(strlen($result['answer1'])>7)
											echo substr($result['answer1'],0,7)."...";
										else echo $result['answer1'];
									?></td>
									<td><?php 
										if(strlen($result['answer2'])>7)
											echo substr($result['answer2'],0,7)."...";
										else echo $result['answer2'];
									?></td>
									<td><?php 
										if(strlen($result['answer3'])>7)
											echo substr($result['answer3'],0,7)."...";
										else echo $result['answer3'];
									?></td>
									<td><?php 
										if(strlen($result['answer4'])>7)
											echo substr($result['answer4'],0,7)."...";
										else echo $result['answer4'];
									?></td>
									<td><?php 
										if(strlen($result['answer5'])>7)
											echo substr($result['answer5'],0,7)."...";
										else echo $result['answer5'];
									?></td>
									<td><?php 
										if(strlen($result['answer6'])>7)
											echo substr($result['answer6'],0,7)."...";
										else echo $result['answer6'];
									?></td>
									<td><?php 
										echo $result['answer'];
									?></td>
									<td><?php 
										echo $result['category_name'];
									?></td>
									<td>
										<form method="post" action="question-detail.php">
											<input class="btn btn-success" type="submit" id="btn-update" value="Sửa">
											<input class="btn btn-primary" type="submit" value="Xóa">
										</form>
									</td>
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
<?php require_once 'template/footer.php';	?>