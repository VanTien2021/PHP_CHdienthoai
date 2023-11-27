<?php

class LoginModel extends DModel
{
	
	public function __construct()
	{
		parent::__construct();
		
	}
	public function listuser($tableUser, $cond){
		$sql = "SELECT * from $tableUser where $cond LIMIT 1";
		return $this->db->select($tableUser, $cond);
	}
	public function updateUser_Last_Login($tableUser,$data,$cond_last_login){
		return $this->db->update($tableUser,$data,$cond_last_login);
	}
	public function userControl($table, $username, $password){

		$sql = "SELECT * from $table where username =? AND password =?";
		return $this->db->affectedRows($sql, $username, $password);
	}
	public function getUserData($table, $username, $password){

		$sql = "SELECT * from $table where username =? AND password =?";
		return $this->db->selectUser($sql, $username, $password);
	}
	public function count_user_login($tableRegisters, $re_username, $password){

		$sql = "SELECT * from $tableRegisters where register_email =? AND register_password =?";
		return $this->db->affectedRows($sql, $re_username, $password);
	}
	public function get_user_data($tableRegisters, $re_username, $password){

		$sql = "SELECT * from $tableRegisters where register_email =? AND register_password =?";
		return $this->db->selectUser($sql, $re_username, $password);
	}
	public function last_time_login($tableRegisters,$data,$cond_register){
		return $this->db->update($tableRegisters,$data,$cond_register);
	}
	
	

	
}