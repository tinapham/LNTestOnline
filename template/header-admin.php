<?php 
	ob_start();
	session_start();
	require_once 'permission.php'; 
?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Mouldifi - A fully responsive, HTML5 based admin theme">
<meta name="keywords" content="Responsive, HTML5, admin theme, business, professional, Mouldifi, web design, CSS3">
<title>LN's Test Online | Admin</title>
<link rel='shortcut icon' type='image/x-icon' href='images/favicon.ico' />
<link href="css/entypo.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/mouldifi-core.css" rel="stylesheet">
<link href="css/mouldifi-forms.css" rel="stylesheet">
<link href="css/login.css" rel="stylesheet">

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metismenu/jquery.metisMenu.js"></script>
<script src="js/plugins/blockui-master/jquery-ui.js"></script>
<script src="js/plugins/blockui-master/jquery.blockUI.js"></script>
<!--Float Charts-->
<script src="js/plugins/flot/jquery.flot.min.js"></script>
<script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="js/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="js/plugins/flot/jquery.flot.selection.min.js"></script>        
<script src="js/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="js/plugins/flot/jquery.flot.time.min.js"></script>
<script src="js/functions.js"></script>

<!--ChartJs-->
<script src="js/plugins/chartjs/Chart.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
</head>
<body>

<!-- Page container -->
<div class="page-container">

	<!-- Page Sidebar -->
	<div class="page-sidebar">
	
		<!-- Site header  -->
		<header class="site-header">
		  <div class="site-logo"><a href=""><img src="images/logo1.png" alt="Mouldifi" title="Mouldifi"></a></div>
		  <div class="sidebar-collapse hidden-xs"><a class="sidebar-collapse-icon" href="#"><i class="icon-menu"></i></a></div>
		  <div class="sidebar-mobile-menu visible-xs"><a data-target="#side-nav" data-toggle="collapse" class="mobile-menu-icon" href="#"><i class="icon-menu"></i></a></div>
		</header>
		<!-- /site header -->
		<?php 
			$arr = explode("/",$_SERVER['REQUEST_URI']);
			$uri = end( $arr ); 
			?>

		<!-- Main navigation -->
		<ul id="side-nav" class="main-menu navbar-collapse collapse">
			<li <?php if($uri == 'index-2.php') echo "class='active'"; ?>><a href="index-2.php"><i class="icon-home"></i><span class="title">Trang chủ</span></a>
			</li>
			<li <?php if($uri == 'ques-management.php') echo "class='has-sub active'"; ?>><a href="ques-management.php"><i class="icon-help"></i><span class="title">Quản lý câu hỏi</span></a>
				<ul class="nav">
					<li <?php if($uri == 'ques-management.php') echo "class='active'"; ?>><a href="ques-management.php"><span class="title">Danh sách câu hỏi</span></a></li>
					<li><a href=""><span class="title">Thêm câu hỏi</span></a></li>
				</ul>
			</li>
			<li <?php if($uri == 'exam-management.php') echo "class='active'"; ?>><a href="exam-management.php"><i class="icon-folder"></i><span class="title">Quản lý đề thi </span></a>
			<li <?php if($uri == 'statistic.php') echo "class='active'"; ?>><a href="statistic.php"><i class="icon-chart-pie"></i><span class="title">Thống kê </span></a>
			</li>
		</ul>
		<!-- /main navigation -->			
  </div>
  <!-- /page sidebar -->
  
  <!-- Main container -->
  <div class="main-container gray-bg">
  
		<!-- Main header -->
		<div class="main-header row">
			  <div class="col-sm-12 col-xs-7">
			  
				<!-- User info -->
				<ul class="user-info pull-right">          
					  <li class="profile-info dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false"> <img width="44" class="img-circle avatar" alt="" src="images/face.png">
					  		Chào mừng 
					  		<?php if($_SESSION['logged_in'])  ?>
							<?php echo $_SESSION['name']; ?>
					   <span class="caret"></span></a>
					  
						<!-- User action menu -->
						<ul class="dropdown-menu pull-right">
						  
							<li><a href="account.php"><i class="icon-user"></i>Tài khoản của tôi</a></li>
							<li class="divider"></li>
							<li><a href="logout.php"><i class="icon-logout"></i>Đăng xuất</a></li>
						</ul>
						<!-- /user action menu -->
						
					  </li>
				</ul>
				<!-- /user info -->
				
			  </div>
		</div>
		<!-- /main header -->