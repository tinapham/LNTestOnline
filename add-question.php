<?php 			
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
	if( !empty( $_POST )){
		try {
			$user_obj = new Cl_User();
			$data = $user_obj->addQuestion( $_POST );
			
		} catch (Exception $e) {
			$error = $e->getMessage();
			$_SESSION['error'] = $error;
		}
	}	
?> 
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="form-add-question">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Chi tiết câu hỏi</h4>
				</div>
				<div class="modal-body">
					<div class="panel panel-default">
						<div class="panel-body">	
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Câu hỏi</label> 
								<div class="col-sm-10"> 
									<div class="input-group"> 
										<span class="input-group-addon">?</span> 
										<input name="question_name" id="question_name" type="text" placeholder="Nội dung câu hỏi" class="form-control"> 
										<span id="question_name_error"></span>
									</div>
								</div> 
							</div>
							<div class="line-dashed"></div>
							<div class="form-group"> 
								<label class="col-sm-2 control-label">Lựa chọn</label> 
									<div class="col-sm-10"> 
										<div class="input-group"> 
											<span class="input-group-addon">1</span> 
											<input name="answer1" type="text" placeholder="Nội dung phương án lựa chọn" class="form-control"> 
										</div> <br>
										<div class="input-group"> 
											<span class="input-group-addon">2</span> 
											<input name="answer2" type="text" placeholder="Nội dung phương án lựa chọn" class="form-control"> 
										</div> <br>
										<div class="input-group"> 
											<span class="input-group-addon">3</span> 
											<input name="answer3" type="text" placeholder="Nội dung phương án lựa chọn" class="form-control"> 
										</div> <br>
										<div class="input-group"> 
											<span class="input-group-addon">4</span> 
											<input name="answer4" type="text" placeholder="Nội dung phương án lựa chọn" class="form-control"> 
										</div> <br>
										<div class="input-group"> 
											<span class="input-group-addon">5</span> 
											<input name="answer5" type="text" placeholder="Nội dung phương án lựa chọn" class="form-control"> 
										</div> <br>
										<div class="input-group"> 
											<span class="input-group-addon">6</span> 
											<input name="answer6" type="text" placeholder="Nội dung phương án lựa chọn" class="form-control"> 
										</div>
									</div> 
								</div>
								<div class="line-dashed"></div>
								<div class="form-group"> 
									<label class="col-sm-2 control-label">Đáp án</label> 
									<div class="col-sm-10"> 
										<div class="input-group"> 
											<span class="input-group-addon"><i class="icon-check"></i></span>
											<input name="answer" type="text"  placeholder="Đáp án đúng" class="form-control"> 
										</div>
									</div> 
								</div>
								<div class="line-dashed"></div>
								<div class="form-group"> 
									<label class="col-sm-2 control-label">Môn học</label> 
									<div class="col-sm-10"> 
										<div class="input-group"> 
											<span class="input-group-addon"><i class="icon-layout"></i></span>
											<select class="form-control" name="category" id="category">
												<?php  foreach ($categories as $key=>$category){ ?>
												<option value="<?php echo $key; ?>"><?php echo $category; ?></option>
												<?php } ?>
											</select> 
										</div>
									</div> 
								</div>
								<div class="alert alert-danger hide"> </div>
								<div class="form-group"> 
									<div class="col-md-10 col-md-offset-5">
                    					<button type="" class="btn btn-primary">Submit</button>
               						</div>
								</div>
							</div>
						</div>
					</div>
			</form>
		</div>
	</div>
</div>
<script src="js/start.js"></script>	