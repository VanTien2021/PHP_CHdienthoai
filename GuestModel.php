<?php

class GuestModel extends DModel
{
	public function count_ordered_by_id($tableRegisters,$tableCart,$id){
		$sql = "SELECT COUNT(DISTINCT $tableCart.datecreated) FROM $tableCart,$tableRegisters where $tableCart.register_id = $tableRegisters.register_id AND $tableCart.register_id='$id'";
		return $this->db->countRow($sql);
	}
	public function filter_ordered_by_id($tableRegisters,$tableCart,$id){
		$sql="SELECT * FROM $tableRegisters,$tableCart where $tableCart.register_id = $tableRegisters.register_id AND $tableCart.register_id='$id' group by $tableCart.datecreated order by $tableCart.datecreated desc";
		return $this->db->select($sql);
	}
	public function listGuest($tableRegisters){
		$sql="SELECT * FROM $tableRegisters order by $tableRegisters.register_id desc";
		return $this->db->select($sql);
	}
	public function view_detail_guest($tableRegisters,$id){
		$sql="SELECT * FROM $tableRegisters where $tableRegisters.register_id = '$id' group by $tableRegisters.register_id order by $tableRegisters.register_id desc";
		return $this->db->select($sql);
	}
	public function change_active_register($tableRegisters,$data,$cond_guest){
		return $this->db->update($tableRegisters,$data,$cond_guest);
	}

	
}