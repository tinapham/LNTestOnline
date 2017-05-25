<?php require_once 'template/header-admin.php';	
	try {
		$user = new Cl_User();
		$results = $user->getListQuestions();
		$cate = $user->getCate();
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
			<li class="active"><strong>Thêm câu hỏi</strong></li> 
	</ol>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<h3 class="panel-title">Thêm câu hỏi</h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form">
					
						<div class="form-group"> 
							<label class="col-sm-2 control-label">ID</label> 
							<div class="col-sm-10"> 
								<textarea placeholder="ID" name="id" class="form-control" id="m-id"></textarea> 
							</div> 
						</div>

						<div class="line-dashed"></div>

	        			<div class="form-group"> 
							<label class="col-sm-2 control-label">Câu hỏi</label> 
							<div class="col-sm-10"> 
								<textarea placeholder="Câu hỏi" class="form-control" id="m-question"></textarea> 
							</div> 
						</div>

						<div class="line-dashed"></div>

					 	<div class="form-group"> 
							<label class="col-sm-2 control-label">Lựa chọn 1</label> 
							<div class="col-sm-10"> 
								<textarea placeholder="Lựa chọn 1" class="form-control" id="m-ch1"></textarea>
							</div> 
						</div>

						<div class="line-dashed"></div>

						<div class="form-group"> 
							<label class="col-sm-2 control-label" >Lựa chọn 2</label> 
							<div class="col-sm-10"> 
								<textarea placeholder="Lựa chọn 1" class="form-control" id="m-ch2"></textarea> 
							</div> 
						</div>
						<div class="line-dashed"></div>
						<div class="form-group"> 
							<label class="col-sm-2 control-label" >Lựa chọn 3</label> 
							<div class="col-sm-10"> 
								<textarea placeholder="Lựa chọn 3" class="form-control" id="m-ch3"></textarea> 
							</div> 
						</div>
						<div class="line-dashed"></div>
						<div class="form-group"> 
							<label class="col-sm-2 control-label" >Lựa chọn 4</label> 
							<div class="col-sm-10"> 
								<textarea placeholder="Lựa chọn 4" class="form-control" id="m-ch4"></textarea> 
							</div> 
						</div>
						<div class="line-dashed"></div>
						<div class="form-group"> 
							<label class="col-sm-2 control-label" >Lựa chọn 5</label> 
							<div class="col-sm-10"> 
								<textarea placeholder="Lựa chọn 5" class="form-control" id="m-ch5"></textarea> 
							</div> 
						</div>
						<div class="line-dashed"></div>
						<div class="form-group"> 
							<label class="col-sm-2 control-label" >Lựa chọn 6</label> 
							<div class="col-sm-10"> 
								<textarea placeholder="Lựa chọn 6" class="form-control" id="m-ch6"></textarea>
							</div> 
						</div>
						<div class="line-dashed"></div>
						<div class="form-group"> 
							<label class="col-sm-2 control-label" >Đáp án</label> 
							<div class="col-sm-10"> 
								<input type="text" placeholder="Đáp án" class="form-control" id="m-ans"></input>
							</div> 
						</div>
						<div class="line-dashed"></div>
						<div class="form-group"> 
							<label class="col-sm-2 control-label" >Loại đề</label> 
							<div class="col-sm-10"> 
								<select class="form-control" id="select-category"> 
									<?php foreach ($cate as $ca) { ?>
										<option value="<?php echo $ca['id']; ?>"><?php echo $ca['category_name'];?></option> 
									<?php } ?>
								</select>
							</div> 
						</div>
						<div class="form-group">
								<div class="col-sm-4 col-sm-offset-6">
									<button type="submit" class="btn btn-primary">Thêm câu hỏi</button>
								</div>
							</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>   


<!--Basic Modal-->
<div id="modalForm" class="modal fade" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-lg">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="myModalLabel">Chi tiết câu hỏi</h4>
      		</div>
      		<div class="modal-body">
        		<p class="statusMsg"></p>
        		<form class="form-horizontal" role="form">
					
					<div class="form-group"> 
						<label class="col-sm-2 control-label">ID</label> 
						<div class="col-sm-10"> 
							<textarea placeholder="ID" name="id" class="form-control" id="m-id"></textarea> 
						</div> 
					</div>

					<div class="line-dashed"></div>

        			<div class="form-group"> 
						<label class="col-sm-2 control-label">Câu hỏi</label> 
						<div class="col-sm-10"> 
							<textarea placeholder="Câu hỏi" class="form-control" id="m-question"></textarea> 
						</div> 
					</div>

					<div class="line-dashed"></div>

				 	<div class="form-group"> 
						<label class="col-sm-2 control-label">Lựa chọn 1</label> 
						<div class="col-sm-10"> 
							<textarea placeholder="Lựa chọn 1" class="form-control" id="m-ch1"></textarea>
						</div> 
					</div>

					<div class="line-dashed"></div>

					<div class="form-group"> 
						<label class="col-sm-2 control-label" >Lựa chọn 2</label> 
						<div class="col-sm-10"> 
							<textarea placeholder="Lựa chọn 1" class="form-control" id="m-ch2"></textarea> 
						</div> 
					</div>
					<div class="line-dashed"></div>
					<div class="form-group"> 
						<label class="col-sm-2 control-label" >Lựa chọn 3</label> 
						<div class="col-sm-10"> 
							<textarea placeholder="Lựa chọn 3" class="form-control" id="m-ch3"></textarea> 
						</div> 
					</div>
					<div class="line-dashed"></div>
					<div class="form-group"> 
						<label class="col-sm-2 control-label" >Lựa chọn 4</label> 
						<div class="col-sm-10"> 
							<textarea placeholder="Lựa chọn 4" class="form-control" id="m-ch4"></textarea> 
						</div> 
					</div>
					<div class="line-dashed"></div>
					<div class="form-group"> 
						<label class="col-sm-2 control-label" >Lựa chọn 5</label> 
						<div class="col-sm-10"> 
							<textarea placeholder="Lựa chọn 5" class="form-control" id="m-ch5"></textarea> 
						</div> 
					</div>
					<div class="line-dashed"></div>
					<div class="form-group"> 
						<label class="col-sm-2 control-label" >Lựa chọn 6</label> 
						<div class="col-sm-10"> 
							<textarea placeholder="Lựa chọn 6" class="form-control" id="m-ch6"></textarea>
						</div> 
					</div>
					<div class="line-dashed"></div>
					<div class="form-group"> 
						<label class="col-sm-2 control-label" >Đáp án</label> 
						<div class="col-sm-10"> 
							<input type="text" placeholder="Đáp án" class="form-control" id="m-ans"></input>
						</div> 
					</div>
					<div class="line-dashed"></div>
					<div class="form-group"> 
						<label class="col-sm-2 control-label" >Loại đề</label> 
						<div class="col-sm-10"> 
							<select class="form-control" id="select-category"> 
								<?php foreach ($cate as $ca) { ?>
									<option value="<?php echo $ca['id']; ?>"><?php echo $ca['category_name'];?></option> 
								<?php } ?>
							</select>
						</div> 
					</div>
					
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary submitBtn" onclick="submitQuestionForm()">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--End Basic Modal-->
<?php require_once 'template/footer.php';	?>