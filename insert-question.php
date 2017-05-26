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
					<p class="statusMsg"></p>
					<form class="form-horizontal" role="form">

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
									<button type="button" class="btn btn-primary submitBtn" onclick="insertQuestionForm()"">Thêm câu hỏi</button>
								</div>
							</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>   


<script>
function insertQuestionForm(){
	var question = $('#m-question').val();
	var ch1 = $('#m-ch1').val();
	var ch2 = $('#m-ch2').val();
	var ch3 = $('#m-ch3').val();
	var ch4 = $('#m-ch4').val();
	var ch5 = $('#m-ch5').val();
	var ch6 = $('#m-ch6').val();
	var ans = $('#m-ans').val();
	var cate = $('#select-category').val();

	// console.log("content: "+id+"--"+question+"--"+ch1+"--"+ch2+"--"+ch3+"--"+ch4+"--"+ch5+"--"+ch6+"--"+ans+"-cate-"+cate);
	// var x = 'contactFrmSubmit=1&id='+id+'&question='+question+'&ch1='+ch1+'&ch2='+ch2+'&ch3='+ch3+'&ch4='+ch4+'&ch5='+ch5+'&ch6='+ch6+'&answer='+ans+'&category='+cate;
	// console.log(x);
	// return;
    if(question.trim() == '' ){
        alert('Câu hỏi không được trống');
        $('#m-question').focus();
        return false;
    }
	else{
        $.ajax({
            type:'POST',
            url:'insert-question-ajax.php',
            data:'contactFrmSubmit=1&question='+question+'&ch1='+ch1+'&ch2='+ch2+'&ch3='+ch3+'&ch4='+ch4+'&ch5='+ch5+'&ch6='+ch6+'&answer='+ans+'&category='+cate,
            beforeSend: function () {
                $('.submitBtn').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success:function(msg){
            	// alert(msg);
            	console.log(msg);
                if(msg == 'ok'){
                    // $('#inputQ').val('');
                    // $('#inputTime').val('');
                    $('.statusMsg').html('<span style="color:green;">Cập nhật thành công</p>');
                }else{
                    $('.statusMsg').html('<span style="color:red;">Cập nhật thất bại, vui lòng thử lại</span>');
                }
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
    }
}
</script>


<?php require_once 'template/footer.php';	?>