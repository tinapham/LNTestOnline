<?php

require_once 'config.php'; 

if(!empty($_POST['category']) && !empty($_POST['question']) && !empty($_POST['answer'])){
    $question = $_POST['question'];
	$ch1 = $_POST['ch1'];
	$ch2 = $_POST['ch2'];
	$ch3 = $_POST['ch3'];
	$ch4 = $_POST['ch4'];
	$ch5 = $_POST['ch5'];
	$ch6 = $_POST['ch6'];
	$ans = $_POST['answer'];
	$cate = $_POST['category'];
	if(empty($ch1)) $ch1="";
	if(empty($ch2)) $ch2="";
	if(empty($ch3)) $ch3="";
	if(empty($ch4)) $ch4="";
	if(empty($ch5)) $ch5="";
	if(empty($ch6)) $ch6="";
	// echo "arrayysad:".$id." ".$question." ".$ch1." ".$ch2." ".$ch3." ".$ch4." ".$ch5." ".$ch6." ".$ans."cate: ".$cate;
        try {
            $ques = new Cl_Question();
            $results = $ques->insert($question,$ch1,$ch2,$ch3,$ch4,$ch5,$ch6,$ans,$cate);

            if($results) echo "ok";
            else "notok";
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        } 
}