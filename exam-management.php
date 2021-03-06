<?php require_once 'template/header-admin.php';	?>
<?php 
    
    try {
            $user = new Cl_User();
            $results = $user->getExam();
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
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
		<div class="col-lg-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h3 class="panel-title">Thi lập trình mạng</h3>
						<ul class="panel-tool-options"> 
							<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>
					<div class="panel-body" style="display: block;">
						<div class="table-responsive">
							<table class="table">
								<thead> 
									<tr> 
										<th><b>#</b></th> 
										<th><b>Loại đề</b></th> 
										<th><b>Số câu</b></th> 
										<th><b>Thời gian thi</b></th>
										<th><b>Trạng thái</b></th>
										<th><b>Điều khiển</b></th>
									</tr> 
								</thead> 
								<tbody> 
								<?php
                					$stt=1;
                					foreach ($results['categories'] as $res) {?>
										<tr class="<?php if($res['status'] == 1) echo "bg-success";?>"> 
											<th scope="row"><?php echo $stt;?></th> 
											<td class="name-<?php echo $res['id'];?>"><?php echo $res['category_name'];?></td> 
											<td class="numq-<?php echo $res['id'];?>"><?php echo $res['num_question'];?></td> 
											<td class="time-<?php echo $res['id'];?>"><?php echo $res['time_quiz'];?> phút</td> 
											<td class="status-<?php echo $res['id'];?>"><b><?php if($res['status'] == 1) echo "ON"; else echo "OFF"?></b></td>
											<td>
												<a data-Id="<?php echo $res['id'];?>" class="viewmodal"><i class="fa fa-pencil-square-o"></i></a>
											</td>
										</tr> 
										<?php $stt++;
								}?>
				
								</tbody> 
							</table>
						</div>
					</div>
				</div>
			</div>
	</div>

	<div class="row">
		
		<div class="col-lg-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h3 class="panel-title">Đề thi java</h3>
						<ul class="panel-tool-options"> 
							<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
							<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
							<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
						</ul>
					</div>
					<div class="panel-body" style="display: block;">
						<div class="table-responsive">
							<table class="table" id="example">
								<thead> 
									<tr> 
										<th>#</th> 
										<th>Loại đề</th> 
										<th>Số câu</th> 
										<th>Thời gian thi</th>
										<th>Trạng thái</th>
									</tr> 
								</thead> 
								<tbody> 
									<tr> 
										<th scope="row">1</th> 
										<td>Giữa kỳ</td> 
										<td>35</td> 
										<td>30 phút</td> 
										<th></th>
									</tr> 
									<tr> 
										<th scope="row">2</th> 
										<td>Cuối kỳ</td> 
										<td>30</td> 
										<td>50 phút</td> 
										<th></th>
									</tr> 
									<tr> 
										<th scope="row">3</th> 
										<td>Bài tập</td> 
										<td>15</td> 
										<td>20 phút</td>
										<th></th>
									 </tr> 
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
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="myModalLabel">Đề thi LTM/Giua kỳ</h4>
      		</div>
      		<div class="modal-body">
        		<p class="statusMsg"></p>
        		<form class="form-horizontal" role="form">

        			<div class="form-group"> 
						<label class="col-sm-2 control-label">ID</label> 
						<div class="col-sm-10"> 
							<input type="text" placeholder="ID" name="id" class="form-control" id="userId" disabled> 
						</div> 
					</div>

					<div class="line-dashed"></div>

		        	<div class="form-group"> 
						<label class="col-sm-2 control-label">Loại đề</label> 
						<div class="col-sm-10"> 
							<input type="text" placeholder="Loại đề" class="form-control" id="inputLoaide"> 
						</div> 
					</div>

					<div class="line-dashed"></div>

				 	<div class="form-group"> 
						<label class="col-sm-2 control-label">Số câu</label> 
						<div class="col-sm-10"> 
							<input type="text" placeholder="Số câu" class="form-control" id="inputQ"> 
						</div> 
					</div>

					<div class="line-dashed"></div>

					<div class="form-group"> 
						<label class="col-sm-2 control-label" >Thời gian</label> 
						<div class="col-sm-10"> 
							<input type="text" placeholder="Thời gian	" class="form-control" id="inputTime"> 
						</div> 
					</div>

					<div class="form-group"> 
						<div class="col-lg-2 col-md-offset-10">
							<input type="checkbox" class="js-switch js-check-click col-lg-2 col-md-offset-8" data-switchery="true">
						</div>
						
					</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--End Basic Modal-->

<script>
function submitContactForm(){

	var clickCheckbox = document.querySelector('.js-check-click');

	if(clickCheckbox.checked) var statusx = 1;
	else var statusx = 0;
	// console.log("status"+statusx);
	var loaide = $('#inputLoaide').val();
    var question = $('#inputQ').val();
    var time = parseInt($('#inputTime').val());
    var id = parseInt($('#userId').val());
    // console.log(id);
    // console.log(question);
    // console.log(loaide);
    // console.log(time);
    if(loaide.trim() == '' ){
        alert('Loại đề không được trống');
        $('#inputLoaide').focus();
        return false;
    }else if(question.trim() == '' ){
        alert('Vui lòng nhập số câu hỏi của đề. ');
        $('#inputQ').focus();
        return false;
    }else if(time == null){
        alert('Vui lòng nhập thời gian thi.');
        $('#inputTime').focus();
        return false;
    }else{

        $.ajax({
            type:'POST',
            url:'submit_modal_exam.php',
            data:'contactFrmSubmit=1&loaide='+loaide+'&question='+question+'&time='+time+'&id='+id+'&status='+statusx,
            beforeSend: function () {
                $('.submitBtn').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success:function(msg){
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
	 	$('#inputLoaide').val($(this).parent().parent().find('td').eq(0).text());
	 	$('#inputQ').val($(this).parent().parent().find('td').eq(1).text());
	 	$('#inputTime').val($(this).parent().parent().find('td').eq(2).text());
	 	$('#userId').val($(this).attr('data-Id'));
	 	$('#modalForm').modal();
	});
});
</script>

<script>
		
		var elem = document.querySelector('.js-switch');
		var init = new Switchery(elem);

		var clickCheckbox = document.querySelector('.js-check-click')
  			, clickButton = document.querySelector('.js-check-click-button');

</script>

<script>


<?php require_once 'template/footer.php';	?>