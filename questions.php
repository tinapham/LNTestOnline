<?php require_once 'template/header.php';   ?>
        <?php

        $databaseHost = 'localhost';
        $databaseName = 'quiz';
        $databaseUsername = 'root';
        $databasePassword = '';

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
                                <img src="images/circle.png">
                                <div class="question-number">
                                    <div class="question-number-box">
                                        <p>'.$sttQues.'</p>
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
                <div class="col-md-10 col-md-offset-1">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>



            <!-- Footer -->
            <footer class="footer-main col-lg-10 footer-main-my">
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

</body>
</html>
