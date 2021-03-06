<?php
/**
 * This User will have functions that hadles user registeration,
 * login and forget password functionality
 * @author vetripandi
 * @copyright www.vetbossel.in
 */
class Cl_User
{
	/**
	 * @var will going contain database connection
	 */
	protected $_con;
	
	protected $_timer = "";

	protected $catego = array();
	/**
	 * it will initalize DBclass
	 */
	public function __construct()
	{
		$db = new Cl_DBclass();
		$this->_con = $db->con;
	}
	
	/**
	 * this will handles user registration process
	 * @param array $data
	 * @return boolean true or false based success 
	 */
	public function registration( array $data )
	{
		if( !empty( $data ) ){
			
			// Trim all the incoming data:
			$trimmed_data = array_map('trim', $data);
			
			
			
			// escape variables for security
			$name = mysqli_real_escape_string( $this->_con, $trimmed_data['name'] );
			$password = mysqli_real_escape_string( $this->_con, $trimmed_data['password'] );
			$cpassword = mysqli_real_escape_string( $this->_con, $trimmed_data['confirm_password'] );
			
			
			// Check for an email address:
			if (filter_var( $trimmed_data['email'], FILTER_VALIDATE_EMAIL)) {
				$email = mysqli_real_escape_string( $this->_con, $trimmed_data['email']);
			} else {
				throw new Exception( "Hãy nhập địa chỉ email chính xác!" );
			}
			
			
			if((!$name) || (!$email) || (!$password) || (!$cpassword) ) {
				throw new Exception( FIELDS_MISSING );
			}
			if ($password !== $cpassword) {
				throw new Exception( PASSWORD_NOT_MATCH );
			}
			$password = md5( $password );
			$query = "INSERT INTO users (id, name, email, password, created) VALUES (NULL, '$name', '$email', '$password', CURRENT_TIMESTAMP)";
			if(mysqli_query($this->_con, $query)){
				mysqli_close($this->_con);
				return true;
			};
		} else{
			throw new Exception( USER_REGISTRATION_FAIL );
		}
	}
	/**
	 * This method will handle user login process
	 * @param array $data
	 * @return boolean true or false based on success or failure
	 */
	public function login( array $data )
	{
		$_SESSION['logged_in'] = false;
		if( !empty( $data ) ){
			
			// Trim all the incoming data:
			$trimmed_data = array_map('trim', $data);
			
			// escape variables for security
			$email = mysqli_real_escape_string( $this->_con,  $trimmed_data['email'] );
			$password = mysqli_real_escape_string( $this->_con,  $trimmed_data['password'] );
				
			if((!$email) || (!$password) ) {
				throw new Exception( LOGIN_FIELDS_MISSING );
			}
			$password = md5( $password );
			$query = "SELECT id, name, email, created, social_id FROM users where email = '$email' and password = '$password' ";
			$result = mysqli_query($this->_con, $query);
			$data = mysqli_fetch_assoc($result);
			$count = mysqli_num_rows($result);
			mysqli_close($this->_con);
			if( $count == 1){
				$_SESSION = $data;
				$_SESSION['logged_in'] = true;
				return true;
			}else{
				throw new Exception( LOGIN_FAIL );
			}
		} else{
			throw new Exception( LOGIN_FIELDS_MISSING );
		}
	}
	
	/**
	 * This will shows account information and handles password change
	 * @param array $data
	 * @throws Exception
	 * @return boolean
	 */
	
	public function account( array $data )
	{
		if( !empty( $data ) ){
			// Trim all the incoming data:
			$trimmed_data = array_map('trim', $data);
			
			// escape variables for security
			$current_password = mysqli_real_escape_string( $this->_con, $trimmed_data['old_password'] );
			$password = mysqli_real_escape_string( $this->_con, $trimmed_data['password'] );
			if( $current_password =="" || $password ==""){
				throw new Exception( FIELDS_MISSING );
			}
			$user_id = $_SESSION['id'];
			$current_password = md5($current_password);
			$query = "SELECT * FROM users WHERE id = '$user_id' and password = '$current_password'";
			$result = mysqli_query($this->_con, $query);
			$data = mysqli_fetch_assoc($result);
			$count = mysqli_num_rows($result);
			if( $count == 0){
				throw new Exception( "Hãy nhập mật khẩu hiện tại chính xác" );
			} else {
				$password = md5( $password );
				$query = "UPDATE users SET password = '$password' WHERE id = '$user_id'";
				if(mysqli_query($this->_con, $query)){
					mysqli_close($this->_con);
					return true;
				}
			}
		} else{
			throw new Exception( FIELDS_MISSING );
		}
	}
	
	/**
	 * This handle sign out process
	 */
	public function logout()
	{
		session_unset();
		session_destroy();
		session_start();
		$_SESSION['success'] = LOGOUT_SUCCESS;
		header('Location: index.php');
	}
	
	/**
	 * This reset the current password and send new password to mail
	 * @param array $data
	 * @throws Exception
	 * @return boolean
	 */
	public function forgetPassword( array $data )
	{
		if( !empty( $data ) ){
			
			// escape variables for security
			$email = mysqli_real_escape_string( $this->_con, trim( $data['email'] ) );
			
			if((!$email) ) {
				throw new Exception( FIELDS_MISSING );
			}
			$password = $this->randomPassword();
			$password1 = md5( $password );
			$query = "UPDATE users SET password = '$password1' WHERE email = '$email'";
			if(mysqli_query($this->_con, $query)){
				mysqli_close($this->_con);
				$to = $email;
				$subject = "New Password Request";
				$txt = "Your New Password ".$password;
				$headers = "From: admin@vetbossel.in" . "\r\n" .
						"CC: admin@vetbossel.in";
					
				mail($to,$subject,$txt,$headers);
				return true;
			}
		} else{
			throw new Exception( FIELDS_MISSING );
		}
	}
	
	/**
	 * This will generate random password
	 * @return string
	 */
	
	private function randomPassword()
	{
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	
	public function pr($data = '' )
	{
		echo "<pre>"; print_r($data); echo "</pre>";
	}
	
	public function getCategory()
	{
		$query = "SELECT * FROM `categories` WHERE status=1";
		$results = mysqli_query($this->_con, $query)  or die(mysqli_error());
		$categories = array();
		while ( $result = mysqli_fetch_assoc($results) ) {
			$categories[$result['id']] = $result['category_name'];
		}
		mysqli_close($this->_con);
		return $categories;
	}

	public function getResults()
	{
		$user_id = $_SESSION['id'];
		$query = "SELECT `scores`.`id`,`categories`.`category_name`,`right_answer`,`wrong_answer`,`unanswered`,`mark` FROM `scores` JOIN `categories` WHERE `user_id`= $user_id AND `categories`.`id` = `scores`.`category_id` ORDER BY `scores`.`id` ASC";
		$results = mysqli_query($this->_con, $query)  or die(mysqli_error());
		$scores = array();
		while ( $result = mysqli_fetch_assoc($results) ) {
			$scores[$result['id']] = $result;
		}
		mysqli_close($this->_con);
		return $scores;
	}

	public function getListQuestions()
	{
		$cate = array();
		$rownum = mysqli_query( $this->_con, "select * from categories");
		while ( $catetemp = mysqli_fetch_assoc($rownum) ) {
			$cate[$catetemp['id']] = $catetemp;
		}
		$this->catego = $cate;
		
		$results = array();
		$row = mysqli_query( $this->_con, "select `questions`.*, `categories`.`category_name` from `questions` JOIN `categories` where `questions`.`category_id` = `categories`.`id` order by `questions`.`id` ASC");
		while ( $result = mysqli_fetch_assoc($row) ) {
			$results[] = $result;
		}
		mysqli_close($this->_con);
		return $results;
	}

	public function getCate(){
		return $this->catego;
	}

	public function getQuestions(array $data)
	{
		if( !empty( $data ) ){
				
			// escape variables for security
			$category_id = mysqli_real_escape_string( $this->_con, trim( $data['category'] ) );
			if((!$category_id) ) {
				throw new Exception( FIELDS_MISSING );
			}
			$user_id = $_SESSION['id'];
			$numquestion = array();
			$rownum = mysqli_query( $this->_con, "SELECT num_question,time_quiz FROM categories where id=$category_id");
			$result = mysqli_fetch_assoc($rownum);
			$numquestion = $result['num_question'];
			$timerc = $result['time_quiz'];
			$this->_timer = $this->_timer.$timerc;
			// echo $numquestion;
			$query = "INSERT INTO scores ( user_id,right_answer,category_id)VALUES ( '$user_id',0,'$category_id')";
			mysqli_query( $this->_con, $query);
			$_SESSION['score_id'] = mysqli_insert_id($this->_con);
			$results = array();
			$row = mysqli_query( $this->_con, "select * from questions where category_id=$category_id ORDER BY RAND()  LIMIT $numquestion");
			while ( $result = mysqli_fetch_assoc($row) ) {
				$results['questions'][] = $result;
			}
			mysqli_close($this->_con);
			return $results;
		} else{
			throw new Exception( FIELDS_MISSING );
		}
	}
	public function getTimer(){
		return $this->_timer;
	}
	public function getAnswers(array $data)
	{
		// var_dump($data);
		// exit();
		if( !empty( $data ) ){
			$right_answer=0;
			$wrong_answer=0;
			$unanswered=0;
			$keys=array_keys($data);
			$order=join(",",$keys);
			$query = "select id,answer from questions where id IN($order) ORDER BY FIELD(id,$order)";
			$response=mysqli_query( $this->_con, $query)   or die(mysqli_error());
			
			$user_id = $_SESSION['id'];
			$score_id = $_SESSION['score_id'];
			while($result=mysqli_fetch_array($response)){
				if($result['answer']==$_POST[$result['id']]){
					$right_answer++;
				}else if($data[$result['id']]=='smart_quiz'){
					$unanswered++;
				}
				else{
					$wrong_answer++;
				}
			}
			$mark=$right_answer*10/($right_answer+$unanswered+$wrong_answer);
			$results = array();
			$results['right_answer'] = $right_answer;
			$results['wrong_answer'] = $wrong_answer;
			$results['unanswered'] = $unanswered;
			$results['mark'] = $mark;
			// echo "fghj".$right_answer." ".$unanswered." ".$wrong_answer." ".$mark;
			// exit();
			$update_query = "update scores set right_answer='$right_answer', wrong_answer = '$wrong_answer', unanswered = '$unanswered', mark='$mark' where user_id='$user_id' and id ='$score_id' ";
			mysqli_query( $this->_con, $update_query)   or die(mysqli_error());
			mysqli_close($this->_con);
			return $results;
		}	
	}

	public function getExam()
	{
		$results = array();
		$row = mysqli_query( $this->_con, "select * from categories");
		while ( $result = mysqli_fetch_assoc($row) ) {
			$results['categories'][] = $result;
		}
		mysqli_close($this->_con);
		return $results;
	}

	public function setExam($id, $loaide, $numQ, $time, $status){
		// echo $id." ".$loaide." ".$numQ." ".$time." ".$status;
		$update_query = "update categories set category_name='$loaide', time_quiz = '$time', num_question = '$numQ', status=$status where id='$id' ";
		// echo $update_query;
	public function setExam($id, $loaide, $numQ, $time){
		echo $id." ".$loaide." ".$numQ." ".$time;
		$update_query = "update categories set category_name='$loaide', time_quiz = '$time', num_question = '$numQ' where id='$id' ";
		// echo $update_query;
		if ($this->_con->query($update_query) === TRUE) {
		    echo "ok";
		} else {
		    echo "error" . $conn->error;
		}

		$this->_con->close();
	}
}
