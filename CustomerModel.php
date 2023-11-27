<?php

class CustomerModel extends DModel
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	public function update_user_by_email_token($tableRegister,$data,$cond_update){
		return $this->db->update($tableRegister,$data,$cond_update); 
	}
	public function select_user_by_email_token($tableRegister,$cond){
		$sql = "SELECT * FROM $tableRegister where $cond LIMIT 1";
		return $this->db->select($sql);
	}
	public function update_user_token_by_email($tableRegister,$data,$cond){
		return $this->db->update($tableRegister,$data,$cond); 
	}
	public function select_user_by_email($tableRegister,$email){
			$sql = "SELECT * FROM $tableRegister where register_email = '$email' LIMIT 1";
		return $this->db->select($sql);
	}
	public function get_city($tableCity){
		$sql = "SELECT * FROM $tableCity";
		return $this->db->select($sql);
	}
	public function get_state($tableState,$city_id){
		$sql = "SELECT * FROM $tableState where matp = $city_id";
		return $this->db->select($sql);
	}
	public function get_customer_id($tableRegisters,$customer_email,$customer_phone){
		$sql = "SELECT * FROM $tableRegisters where register_email = '$customer_email' AND register_phone = '$customer_phone' LIMIT 1";
		return $this->db->select($sql);
	}
	public function fetch_comment_by_id($tableComment,$parent_id){
		$sql = "SELECT * FROM $tableComment where parent_comment_id = '$parent_id' and comment_status = 1 order by comment_date_created desc";
		return $this->db->select($sql);
	}
	public function listComment($tableComment){
		$query = "SELECT * from $tableComment where parent_comment_id = 0 order by comment_date_created asc";
		return $this->db->select($query); 
	}
	public function list_reply_comment($tableComment){
		$query = "SELECT * from $tableComment where parent_comment_id <> 0 order by comment_date_created desc";
		return $this->db->select($query); 
	}
	public function thembinhluan($tbl_comment,$data){
		return $this->db->insert($tbl_comment,$data);
	}
	public function laybinhluan($tbl_comment,$cond){
		$sql = "SELECT * FROM $tbl_comment where $cond and comment_status = 1 order by comment_date_created desc";
		return $this->db->select($sql);
	}
	public function replybinhluan($tbl_binhluan,$cond){
		$sql = "SELECT * FROM $tbl_binhluan where $cond order by comment_id DESC";
		return $this->db->select($sql);
	}
	public function countpost($tablePost){
		$sql = "SELECT COUNT(*) FROM $tablePost";
		return $this->db->countRow($sql);
	}
	public function countCustomers($tableCustomer){
		$sql = "SELECT COUNT(*) FROM $tableCustomer";
		return $this->db->countRow($sql);
	}
	public function AddCustomer($tableCus,$data){
		return $this->db->insert($tableCus,$data);
	}
	public function AddRegister($tableRegister,$data){
		return $this->db->insert($tableRegister,$data);
	}
	public function AddPayFast($tablePayfast,$data){
		return $this->db->insert($tablePayfast,$data);
	}
	public function listCustomer($tableCus,$cond){
		$query = "SELECT * from $tableCus where $cond =(SELECT MAX($cond) FROM $tableCus) Limit 1";
		return $this->db->select($query); 
	}
	public function AddComment($tableComment,$data){
		return $this->db->insert($tableComment,$data);
	}	
	public function delComment($tableComment,$cond){		
		return $this->db->delete($tableComment,$cond);	
	}
	public function change_customer_status($tableComment,$data,$cond){
		return $this->db->update($tableComment,$data,$cond); 
	}
	
	public function SelectVisitorByIp($tableVisitor,$ip){
		$sql = "SELECT * FROM $tableVisitor where ip = ?";
		return $this->db->affectedVisitor($sql,$ip);
	}
	public function CountVisitor($tableVisitor){
		$sql = "SELECT COUNT(*) FROM $tableVisitor";
		return $this->db->countRow($sql);
	}
	public function InsertVisitor($tableVisitor,$data){
		return $this->db->insert($tableVisitor,$data);
	}

}

?>