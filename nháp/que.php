

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mouldifi - A fully responsive, HTML5 based admin theme">
    <meta name="keywords" content="Responsive, HTML5, admin theme, business, professional, Mouldifi, web design, CSS3">
    <title>LN's Test Online | Home</title>
    <link rel='shortcut icon' type='image/x-icon' href='../images/favicon.ico' />
    <link href="../css/entypo.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/mouldifi-core.css" rel="stylesheet">
    <link href="../css/mouldifi-forms.css" rel="stylesheet">
    <link href="../css/my-css.css" rel="stylesheet">

</head>
<body>

<!-- Page container -->
<div class="page-container">

    <!-- Page Sidebar -->
    <div class="page-sidebar">

        <!-- Site header  -->
        <header class="site-header">
            <div class="site-logo"><a href=""><img src="../images/logo1.png" alt="Mouldifi" title="Mouldifi"></a></div>
            <div class="sidebar-collapse hidden-xs"><a class="sidebar-collapse-icon" href="#"><i class="icon-menu"></i></a></div>
            <div class="sidebar-mobile-menu visible-xs"><a data-target="#side-nav" data-toggle="collapse" class="mobile-menu-icon" href="#"><i class="icon-menu"></i></a></div>
        </header>
        <!-- /site header -->

        <!-- Main navigation -->
        <ul id="side-nav" class="main-menu navbar-collapse collapse">
            <li class=""><a href=""><i class="icon-home"></i><span class="title">Trang chủ</span></a>
            </li>
            <li class=""><a href=""><i class="icon-newspaper"></i><span class="title">Lịch sử thi</span></a>
            </li>
            <li class=""><a href=""><i class="icon-reply"></i><span class="title">Vào thi </span></a>
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
                    <li class="profile-info dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false"> <img width="44" class="img-circle avatar" alt="" src="../images/face.png">Chào mừng Tina Phạm <span class="caret"></span></a>

                        <!-- User action menu -->
                        <ul class="dropdown-menu pull-right">

                            <li><a href="#/"><i class="icon-user"></i>Tài khoản của tôi</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="icon-logout"></i>Đăng xuất</a></li>
                        </ul>
                        <!-- /user action menu -->

                    </li>
                </ul>
                <!-- /user info -->

            </div>
        </div>
        <!-- /main header -->

<?php

        $databaseHost = 'localhost';
        $databaseName = 'quiz';
        $databaseUsername = 'root';
        $databasePassword = 'root';

        $mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
        $result = mysqli_query($mysqli, "select * from questions where category_id=1 ORDER BY RAND()");


?>


        <!-- Main content -->
        <div class="main-content">
            <h1 class="page-title"></h1>

            <form role="form" id='quiz_form' method="post" action="quiz-result.php">
				<?php
                    $sttQues=1;
                    while($res = mysqli_fetch_array($result)) {
                        echo '<div class="col-md-10 col-md-offset-1 question-box">
                            <div class="icon-question">
                                <img src="../images/circle.png">
                                <div class="question-number">
                                    <div class="question-number-box">
                                        <p>' .$sttQues.'</p>
                                    </div>
                                </div>
                            </div>';

                        echo '<div class="panel panel-primary">
                                <div class="panel-heading clearfix question-text">
                                    <div class="panel-title">'.$res['question_name'].'</div>
                                    <ul class="panel-tool-options panel-tool-options-custom">
                                        <li><a data-rel="collapse" href="#"><i class="icon-down-open"></i></a></li>
                                    </ul>
                                </div>';
                        echo '<div class="panel-body panel-text">';

                        if(isset( $res['answer1'] ) && !empty( $res['answer1'] )){
                                    echo '<div class="radio radio-replace radio-primary">
                                        <input type="radio" name="'.$res['id'].'" id="radio-'.$res['id'].'" value="color" checked="checked">
                                        <label for="radio6">'.$res['answer1'].'</label>
                                    </div>';
                        }

                        if(isset( $res['answer2'] ) && !empty( $res['answer2'] )){
                                    echo '<div class="radio radio-replace radio-success">
                                        <input type="radio" name="'.$res['id'].'" id="radio-'.$res['id'].'" value="color">
                                        <label for="radio7">'.$res['answer2'].'</label>
                                    </div>';
                        }

                        if(isset( $res['answer3'] ) && !empty( $res['answer3'] )) {
                            echo '<div class="radio radio-replace radio-info">
                                        <input type="radio" name="'.$res['id'].'" id="radio-'.$res['id'].'" value="color">
                                        <label for="radio8">' . $res['answer3'] . '</label>
                                    </div>';
                        }

                        if(isset( $res['answer4'] ) && !empty( $res['answer4'] )){
                                    echo '<div class="radio radio-replace radio-warning">
                                        <input type="radio" name="'.$res['id'].'" id="radio-'.$res['id'].'" value="color">
                                        <label for="radio9">'.$res['answer4'].'</label>
                                    </div>';
                        }

                        if(isset( $res['answer5'] ) && !empty( $res['answer5'] )) {
                            echo '<div class="radio radio-replace radio-danger">
                                        <input type="radio" name="'.$res['id'].'" id="radio-'.$res['id'].'" value="color">
                                        <label for="radio10">'.$res['answer5'].'</label>
                                    </div>';
                        }
                        if(isset( $res['answer6'] ) && !empty( $res['answer6'] )){
                            echo '<div class="radio radio-replace radio-primary">
                                        <input type="radio" name="'.$res['id'].'" id="radio-'.$res['id'].'" value="color" checked="checked">
                                        <label for="radio6">'.$res['answer6'].'</label>
                                    </div>';
                        }

                        if(isset( $res['answer7'] ) && !empty( $res['answer7'] )){
                            echo '<div class="radio radio-replace radio-success">
                                        <input type="radio" name="'.$res['id'].'" id="radio-'.$res['id'].'" value="color">
                                        <label for="radio7">'.$res['answer7'].'</label>
                                    </div>';
                        }

                echo '
                        </div>
                    </div>
                </div>';
                    $sttQues++;
                    }?>
            </form>

            <!-- Footer -->
            <footer class="footer-main col-lg-10">
                &copy; 2017 <strong>LN's test online</strong> Admin Theme by <a target="_blank" href="#/">Lam-na</a>
            </footer>
            <!-- /footer -->
        </div>
        <!-- /main content -->

    </div>
    <!-- /main container -->

</div>
<!-- /page container -->

<!--Load JQuery-->
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/plugins/metismenu/jquery.metisMenu.js"></script>
<script src="../js/plugins/blockui-master/jquery-ui.js"></script>
<script src="../js/plugins/blockui-master/jquery.blockUI.js"></script>
<!--Float Charts-->
<script src="../js/plugins/flot/jquery.flot.min.js"></script>
<script src="../js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="../js/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="../js/plugins/flot/jquery.flot.selection.min.js"></script>
<script src="../js/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="../js/plugins/flot/jquery.flot.time.min.js"></script>
<script src="../js/functions.js"></script>

<!--ChartJs-->
<script src="../js/plugins/chartjs/Chart.min.js"></script>

</body>
</html>
