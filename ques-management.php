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
			<li class="active"><strong>Danh sách câu hỏi</strong></li> 
	</ol>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<h3 class="panel-title">Kết quả các lần thi</h3>
					<ul class="panel-tool-options"> 
<<<<<<< HEAD
						<li><a href="insert-question.php" class="btn" data-toggle="modal" data-target="#insert"><span class="icon-plus"></span>Thêm câu hỏi</a></li>
=======
						<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
						<li><a class="btn" data-toggle="modal" data-target="#myModal"><span class="icon-plus"></span>Thêm câu hỏi</a></li>
>>>>>>> 573fbedbdaf90d7a8bd353c09926f23c5a616591
					</ul>
				</div>
				<div class="panel-body fulltable">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example" >
							<thead>
								<tr>
									<th style="width: 5%">Stt</th>
									<th style="width: 13%">Câu hỏi</th>
									<th style="width: 13%">Choice 1</th>
									<th style="width: 13%">Choice 2</th>
									<th style="width: 13%">Choice 3</th>
									<th style="width: 13%">Choice 4</th>
									<th style="width: 7%">Choice 5</th>
									<th style="width: 7%">Choice 6</th>
									<th style="width: 4%">Đáp án</th>
									<th style="width: 7%">Loại đề</th>
									<th style="width: 5%">Edit</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								foreach ($results as $result) { 
								?>
								<tr class="gradeX" a href="question-detail.php">
									<td><?php echo $result['id'];?></td>
									<td><?php echo $result['question_name'];?></td>
									<td><?php echo $result['answer1'];
									?></td>
									<td><?php 
										echo $result['answer2'];
									?></td>
									<td><?php 
										echo $result['answer3'];
									?></td>
									<td><?php 
										echo $result['answer4'];
									?></td>
									<td><?php 
										echo $result['answer5'];
									?></td>
									<td><?php 
										echo $result['answer6'];
									?></td>
									<td><?php 
										echo $result['answer'];
									?></td>
									<td><?php 
										echo $result['category_name'];
									?></td>
									<td>
												<a dataq-id="<?php echo $result['id'];?>" class="viewmodal"><i class="fa fa-pencil-square-o"></i></a>
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
<script>
function submitQuestionForm(){
	var id = $('#m-id').val();
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
	// return;
    if(question.trim() == '' ){
        alert('Câu hỏi không được trống');
        $('#m-question').focus();
        return false;
    }
	else{
        $.ajax({
            type:'POST',
            url:'submit_modal_question.php',
            data:'contactFrmSubmit=1&id='+id+'&question='+question+'&ch1='+ch1+'&ch2='+ch2+'&ch3='+ch3+'&ch4='+ch4+'&ch5='+ch5+'&ch6='+ch6+'&answer='+ans+'&category='+cate,
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
                    window.location.reload(true);
                }else{
                    $('.statusMsg').html('<span style="color:red;">Cập nhật thất bại, vui lòng thử lại</span>');
                }
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
    }
}
$(document).ready(function(){
	$('.viewmodal').click(function(event){
	 	event.preventDefault();
	 	$('#m-question').val($(this).parent().parent().find('td').eq(1).text());
	 	$('#m-ch1').val($(this).parent().parent().find('td').eq(2).text());
	 	$('#m-ch2').val($(this).parent().parent().find('td').eq(3).text());
	 	$('#m-ch3').val($(this).parent().parent().find('td').eq(4).text());
	 	$('#m-ch4').val($(this).parent().parent().find('td').eq(5).text());
	 	$('#m-ch5').val($(this).parent().parent().find('td').eq(6).text());
	 	$('#m-ch6').val($(this).parent().parent().find('td').eq(7).text());
	 	$('#m-ans').val($(this).parent().parent().find('td').eq(8).text());
	 	$('#m-id').val($(this).attr('dataq-id'));
	 	$('#modalForm').modal();
	});
});
</script>
<?php require_once 'template/footer.php';	?>