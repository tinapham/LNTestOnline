<?php

class Cl_Question
{
	
	protected $_con;
	
	public function __construct()
	{
		$db = new Cl_DBclass();
		$this->_con = $db->con;

	}
	
	public function update($id,$question,$ch1,$ch2,$ch3,$ch4,$ch5,$ch6,$ans,$cate){
		// echo "arrayysad:".$id." ".$question." ".$ch1." ".$ch2." ".$ch3." ".$ch4." ".$ch5." ".$ch6." ".$ans."cate: ".$cate;
		$update_query = "update questions set question_name='$question', answer1='$ch1',answer2='$ch2',answer3='$ch3',answer4='$ch4',answer5='$ch5',answer6='$ch6',answer=$ans,category_id=$cate where id=$id";
		// echo $update_query;
		if ($this->_con->query($update_query) === TRUE) {
		    echo "ok";
		} else {
		    echo "error" . $conn->error;
		}

		$this->_con->close();
	}

	public function insert($question,$ch1,$ch2,$ch3,$ch4,$ch5,$ch6,$ans,$cate){
		$query = "INSERT INTO questions (id,question_name, answer1, answer2, answer3, answer4, answer5, answer6, answer, category_id) VALUES (NULL, '$question', '$ch1', '$ch2', '$ch3', '$ch4', '$ch5', '$ch6', $ans, $cate)";
		 // echo $query;
		 	// mysql_query($this->_con,'SET NAMES "UTF-8"');
			if(mysqli_query($this->_con, $query)){
				mysqli_close($this->_con);

				return true;
			}
		return false;

	}
}
