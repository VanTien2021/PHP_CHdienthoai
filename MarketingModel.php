<?php

class MarketingModel extends DModel
{
	
	public function __construct()
	{
		parent::__construct();
		
	}
	public function insert_popup($tablePopup,$data){
		return $this->db->insert($tablePopup,$data);
	}
	public function del_popup($tablePopup,$cond_del_popup){
		return $this->db->delete($tablePopup,$cond_del_popup);
	}
	public function del_coupon($tableCoupon,$cond_del_coupon){
		return $this->db->delete($tableCoupon,$cond_del_coupon);
	}
	public function change_active_coupon($tableCoupon,$data,$cond_coupon){
		return $this->db->update($tableCoupon,$data,$cond_coupon);
	}
	public function change_active_popup($tablePopup,$data,$cond_popup){
		return $this->db->update($tablePopup,$data,$cond_popup);
	}
	public function insert_coupon($tableCoupon,$data){
		return $this->db->insert($tableCoupon,$data);
	}
	public function listCoupon($tableCoupon){
		$sql = "SELECT * FROM $tableCoupon order by $tableCoupon.coupon_id desc";
		return $this->db->select($sql);
	}
	public function listPopup($tablePopup){
		$sql = "SELECT * FROM $tablePopup order by $tablePopup.popup_category";
		return $this->db->select($sql);
	}
	public function list_coupon_by_id($tableCoupon,$id){
		$sql = "SELECT * FROM $tableCoupon where $tableCoupon.coupon_id = $id  LIMIT 1";
		return $this->db->select($sql);
	}
	public function list_popup_by_id($tablePopup,$id){
		$sql = "SELECT * FROM $tablePopup where $tablePopup.popup_id = $id  LIMIT 1";
		return $this->db->select($sql);
	}
	public function update_coupon($tableCoupon,$data,$cond_update_coupon){
		return $this->db->update($tableCoupon,$data,$cond_update_coupon);
	}
	public function update_popup($tablePopup,$data,$cond_update_popup){
		return $this->db->update($tablePopup,$data,$cond_update_popup);
	}

	
}