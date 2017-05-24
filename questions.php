<?php require_once 'template/header.php';   ?>

<?php 
    
    if( !empty( $_POST )){
        try {
            $user = new Cl_User();
            $results = $user->getQuestions($_POST);
            $time = $user->getTimer($_POST);
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        } 
    }else{
        $_SESSION['error'] = CHOOSE_CATEGORY;
        header('Location: home.php');exit;
    }
    
?>

        <!-- Main content -->
        <div class="main-content">
            <h1 class="page-title"></h1>
            <form role="form" id='quiz_form' method="post" action="quiz-result.php">
                <?php
                $sttQues=1;
                foreach ($results['questions'] as $res) {
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
                                        <input type="radio" name="'.$res['id'].'" id="radio-'.$res['id'].'" value="1" checked="checked">
                                        <label for="radio6">'.$res['answer1'].'</label>
                                    </div>';
                    }
                    if(isset( $res['answer2'] ) && !empty( $res['answer2'] )){
                        echo '<div class="radio radio-replace radio-success">
                                        <input type="radio" name="'.$res['id'].'" id="radio-'.$res['id'].'" value="2">
                                        <label for="radio7">'.$res['answer2'].'</label>
                                    </div>';
                    }
                    if(isset( $res['answer3'] ) && !empty( $res['answer3'] )) {
                        echo '<div class="radio radio-replace radio-info">
                                        <input type="radio" name="'.$res['id'].'" id="radio-'.$res['id'].'" value="3">
                                        <label for="radio8">' . $res['answer3'] . '</label>
                                    </div>';
                    }
                    if(isset( $res['answer4'] ) && !empty( $res['answer4'] )){
                        echo '<div class="radio radio-replace radio-warning">
                                        <input type="radio" name="'.$res['id'].'" id="radio-'.$res['id'].'" value="4">
                                        <label for="radio9">'.$res['answer4'].'</label>
                                    </div>';
                    }
                    if(isset( $res['answer5'] ) && !empty( $res['answer5'] )) {
                        echo '<div class="radio radio-replace radio-danger">
                                        <input type="radio" name="'.$res['id'].'" id="radio-'.$res['id'].'" value="5">
                                        <label for="radio10">'.$res['answer5'].'</label>
                                    </div>';
                    }
                    if(isset( $res['answer6'] ) && !empty( $res['answer6'] )){
                        echo '<div class="radio radio-replace radio-primary">
                                        <input type="radio" name="'.$res['id'].'" id="radio-'.$res['id'].'" value="6" checked="checked">
                                        <label for="radio6">'.$res['answer6'].'</label>
                                    </div>';
                    }
                    if(isset( $res['answer7'] ) && !empty( $res['answer7'] )){
                        echo '<div class="radio radio-replace radio-success">
                                        <input type="radio" name="'.$res['id'].'" id="radio-'.$res['id'].'" value="7">
                                        <label for="radio7">'.$res['answer7'].'</label>
                                    </div>';
                    }
                    echo '<div class="radio radio-replace radio-success">
                                        <input type="radio" checked="checked" style="display:none" value="smart_quiz" id="radio1_'.$result['id'].'" name="'.$result['id'].'"/>
                                    </div>';
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

<div class="fixed" style="position: fixed; right: 0px; top: 30%;">
    <div class="panel panel-success">
        <div class="panel-heading clearfix" style="height: 32px;border-bottom-width: 1px;padding-top: 9px;"> 
            <div class="panel-title">
                <b style="padding-left: 4px;">Timer</b>
            </div> 
        </div> 
                <!-- panel body --> 
        <div class="panel-body" style="height: 37px;padding-bottom: 29px;"> 
            <span id='timer'></span>
        </div> 
    </div>
</div>

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

<script>
    var timec="<?php echo $time; ?>";
    var c = 60*parseInt(timec);
    var t;
    timedCount();
    function timedCount() {
        var hours = parseInt( c / 3600 ) % 24;
        var minutes = parseInt( c / 60 ) % 60;
        var seconds = c % 60;
        var result = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds  < 10 ? "0" + seconds : seconds);
        
        $('#timer').html(result);
        if(c == 0 ){
            setConfirmUnload(false);
            $("#quiz_form").submit();
        }
        c = c - 1;
        t = setTimeout(function(){ timedCount() }, 1000);
    }
    </script>


</body>
</html>

<script type="text/javascript">
    // Prevent accidental navigation away
    setConfirmUnload(true);
    function setConfirmUnload(on)
    {
        window.onbeforeunload = on ? unloadMessage : null;
    }
    function unloadMessage()
    {
        return 'Your Answered Questions are resetted zero, Please select stay on page to continue your Quiz';
    }
    $(document).on('click', 'button:submit',function(){
        setConfirmUnload(false);
    });
 
</script>
