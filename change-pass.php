<?php 
	ob_start();
	session_start();
	if( !empty( $_POST )){
		try {
			$user_obj = new Cl_User();
			$data = $user_obj->account( $_POST );
			var_dump($data);
			if($data) {
				$_SESSION['success'] = PASSWORD_CHANGE_SUCCESS;
				header('Location: index.php'); exit;
			}
		} catch (Exception $e) {
			$_SESSION['error'] = $e->getMessage();
			header('Location: account.php'); exit;
		} 
	}
?>