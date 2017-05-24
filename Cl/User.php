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
				throw new Exception( "Hãy nhập email chính xác!" );
			}
			
			$query = "SELECT * FROM users where email = '$email'";
			$result = mysqli_query($this->_con, $query);
			$count = mysqli_num_rows($result);
			if( $count == 1){
				throw new Exception( EMAIL_EXISTED );
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
			$password = mysqli_real_escape_string( $this->_con, $trimmed_data['password'] );
			$cpassword = $trimmed_data['confirm_password'];
			$user_id = $_SESSION['id'];
			if((!$password) || (!$cpassword) ) {
				throw new Exception( FIELDS_MISSING );
			}
			if ($password !== $cpassword) {
				throw new Exception( PASSWORD_NOT_MATCH );
			}
			$password = md5( $password );
			$query = "UPDATE users SET password = '$password' WHERE id = '$user_id'";
			if(mysqli_query($this->_con, $query)){
				mysqli_close($this->_con);
				return true;
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
		$query = "SELECT * FROM `categories`";
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
		$query = "SELECT `scores`.`id`,`categories`.`category_name`,`right_answer`,`wrong_answer`,`unanswered` FROM `scores` JOIN `categories` WHERE `user_id`= $user_id AND `categories`.`id` = `scores`.`category_id` ORDER BY `scores`.`id` ASC";
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
		$results = array();
		$row = mysqli_query( $this->_con, "select `questions`.*, `categories`.`category_name` from `questions` JOIN `categories` where `questions`.`category_id` = `categories`.`id` order by `questions`.`id` ASC");
		while ( $result = mysqli_fetch_assoc($row) ) {
			$results[] = $result;
		}
		mysqli_close($this->_con);
		return $results;
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
			$results = array();
			$results['right_answer'] = $right_answer;
			$results['wrong_answer'] = $wrong_answer;
			$results['unanswered'] = $unanswered;
			$update_query = "update scores set right_answer='$right_answer', wrong_answer = '$wrong_answer', unanswered = '$unanswered' where user_id='$user_id' and id ='$score_id' ";
			mysqli_query( $this->_con, $update_query)   or die(mysqli_error());
			mysqli_close($this->_con);
			return $results;
		}	
	}

	public function addQuestion (array $data)
	{
		if( !empty( $data ) ){	
			$question_name = $_POST['question_name'];
			$answer1 = $_POST['answer1'];
			$answer2 = $_POST['answer2'];
			$answer3 = $_POST['answer3'];
			$answer4 = $_POST['answer4'];
			$answer5 = $_POST['answer5'];
			$answer6 = $_POST['answer6'];
			$answer = $_POST['answer'];
			$category_id = $_POST['category'];
			$query = "INSERT INTO questions ( `question_name`,`answer1`,`answer2`,`answer3`,`answer4`,`answer5`,`answer6`,`answer`, `category_id` ) VALUES ( `$question_name`,`$answer1`,`$answer2`,`$answer3`,`$answer4`,`$answer5`,`$answer6`, $answer , $category_id )";
			$row = mysqli_query( $this->_con, $query);
			// var_dump($row);
			exit;
			mysqli_close($this->_con);
		} else{
			throw new Exception( FIELDS_MISSING );
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

	public function setExam($id, $loaide, $numQ, $time){

		$update_query = "update categories set category_name='$loaide', time_quiz = '$time', num_question = '$numQ' where id='$id' ";

		if ($this->_con->query($update_query) === TRUE) {
		    echo "Record updated successfully";
		} else {
		    echo "Error updating record: " . $conn->error;
		}

		$this->_con->close();
	}
}

