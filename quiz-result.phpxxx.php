<?php 
	require_once 'template/header.php';	
	if( !empty( $_POST )){
		try {
			$user = new Cl_User();
			$result = $user->getAnswers( $_POST );
		} catch (Exception $e) {
			$_SESSION['error'] = $e->getMessage();
		} 
	}else{
		// header('Location: home.php');exit;
	}
?>
	<div class="content">
     	<div class="container">
     		<div class="row">
				<div class="col-lg-10">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h3 class="panel-title">Your Quiz Results:</h3>
							<ul class="panel-tool-options"> 
								<li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
								<li><a data-rel="close" href="#"><i class="icon-cancel"></i></a></li>
							</ul>
						</div>
						<div class="panel-body">	
							 <form class="form-horizontal">
								<div class="form-group"> 
									<label class="col-sm-2 control-label">Right Answers:</label> 
									<div class="col-sm-8"> 
										<span class="form-control input-lg">
										<?php echo isset($result['right_answer'])? $result['right_answer']:''; ?>
										</span> 
									</div> 
								</div>
								<div class="line-dashed"></div>
								<div class="form-group"> 
									<label class="col-sm-2 control-label">Wrong Answers:</label> 
									<div class="col-sm-8"> 
										<span class="form-control input-lg">
										<?php echo isset($result['wrong_answer'])? $result['wrong_answer']:''; ?>
										</span>
									</div> 
								</div>
								<div class="line-dashed"></div>
								<div class="form-group"> 
									<label class="col-sm-2 control-label">Unanswered Answers:</label> 
									<div class="col-sm-8"> 
										<span class="form-control input-lg">
										<?php echo isset($result['unanswered'])? $result['unanswered']:''; 
										?>
										</span> 
									</div> 
								</div>
								<div class="line-dashed"></div>
								<div class="col-sm-offset-2 col-xs-10 col-sm-5 col-md-5 col-lg-5">
			     					<a href="start-quiz.php" class="btn btn-success btn-home">Start New Quiz</a>
			     				</div>
			     				<div class="col-xs-10 col-sm-5 col-md-5 col-lg-5">
			     					<a href="quiz-results.php" class="btn btn-info btn-home">Your Quiz Results</a>
			     				</div>
							</form>
						</div>
					</div>
				</div>
			</div>
     	</div>
    </div> <!-- /container -->

<?php require_once 'template/footer.php';?>