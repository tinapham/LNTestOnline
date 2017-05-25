<?php

require_once 'config.php';  
if(isset($_POST['contactFrmSubmit']) &&  !empty($_POST['loaide']) && !empty($_POST['question']) && !empty($_POST['time'])){

    $loaide= $_POST['loaide'];
    $question   = $_POST['question'];
    $time  = $_POST['time'];
    $id  = $_POST['id'];
    $status = $_POST['status'];

        try {
            $user = new Cl_User();
            $results = $user->setExam($id, $loaide, $question, $time, $status);
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        } 
}