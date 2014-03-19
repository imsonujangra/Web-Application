<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'project');
################### Created by sonu  ##########################################################
class Common
	{
		public $mysqli;
		public function __construct()
		{
			$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
			$this->mysqli = $mysqli;
		}
		
		public function checkLogin($username , $password)
		{	//echo $username;die;
			
			$query = "select id from login where username='$username' and password='$password'";
			$result = $this->mysqli->query($query);
			$records = $result->fetch_array();//print_r($query);die;
			
			if($result->num_rows != '')
			{
				$_SESSION['login'] = true;
				//echo $records['username'];die;
				$_SESSION['id'] = $records['username'];

				return true;
			}else
			{
				return false;
			}
				
		}
		
		
		public function getSession()
		{
			return $_SESSION['login'];
				
		}
		
		public function logout()
		{
			$_SESSION['login'] = false;
			//$_SESSION['flash'] = false;
			session_destroy();	
			header('Location:index.php');
		}
			
		
		public function fetching($table)
		{
		$query = "SELECT * FROM ".$table." where id>0";
		$result = $this->mysqli->query($query);
		//$records = $result->fetch_array();
		//echo "<pre>";print_r($records);die;
		$total = array();
		while($row = $result->fetch_assoc()){
				//print_r($row);die;
			 $total[] = $row;
		}//print_r($total);die;
		return $total;
		
		}
		
		public function completeQuery($cmplet_query)
		{
		$query = $cmplet_query;
		$result = $this->mysqli->query($query);
		//$records = $result->fetch_array();
		//echo "<pre>";print_r($result);die;
		$records = $result->fetch_assoc();
		//print_r($records);die;
		$total = array();
		while($row = $result->fetch_assoc()){
				//print_r($row);die;
			 $total[] = $row;
		}//print_r($total);die;
		return $total;
		
		}
		
		public function InsertQuery($set_table_name,$data)
		{	///print_r($data);
			if(count($data)>0){
				$string ='insert into '.$set_table_name.' set ';
				foreach($data as $key=>$value){
					$value = '"'.$value.'"';
					$value = str_replace("'", "''", $value);
					$string .= $key.'='.$value.',';
				}
			}
			
			$trimm =  rtrim($string,',');
			//$query = mysql_query($trimm);
			//print_r($trimm);die;
        	$result = $this->mysqli->query($trimm);
		}
		
		public function updateQuery($set_table_name,$data,$whr)
		{
				if(count($data)>0){
				$string ='update '.$set_table_name.' set ';
				foreach($data as $key=>$value){
					$value = '"'.$value.'"';
					$value = str_replace("'", "''", $value);
					$string .= $key.'='.$value.',';
				}
			}
			
			$trimm =  rtrim($string,',').' where '.$whr;
			//echo $trimm;die;
			//$query = mysql_query($trimm);
			//print_r($trimm);die;
        	$result = $this->mysqli->query($trimm);
		}
		
		
		public function deleteQuery($set_table_name,$whr)
		{
			
			$query = "delete from ".$set_table_name." where id =".$whr;
			
        	$result = $this->mysqli->query($query);
			//print_r($result);die;
		}

	}
