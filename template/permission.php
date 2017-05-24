<?php
require_once 'config.php'; 
if (!isset($_SESSION['logged_in'])) {
	header('Location: index.php');
}else {
	if (isset($_SESSION['social_id']) == true) {
		// Ngược lại nếu đã đăng nhập
		$permission = $_SESSION['social_id'];
		// Kiểm tra quyền của người đó có phải là admin hay không
		if ($permission == '') {
			// Nếu không phải admin thì xuất thông báo
			$_SESSION['error'] = "Bạn không đủ quyền truy cập vào trang này<br>";
			header('Location: home.php');
			exit();
		}
	}
}
?>