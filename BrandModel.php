<?php

class BrandModel extends DModel

{

	

	function __construct()

	{

		parent::__construct();

	}

	public function change_active_brand($tableBrand,$data,$cond_brand){

		return $this->db->update($tableBrand, $data,$cond_brand);

	}

	public function AddBrand($tableBrand, $data){

		return $this->db->insert($tableBrand, $data);

	}

	public function listBrand($tableBrand){

		$query = "SELECT * from $tableBrand  order by brandId desc";

		return $this->db->select($query);

	}

	public function DelBrand($tableBrand, $cond){

		return $this->db->delete($tableBrand,$cond);

	}

	public function BrandById($tableBrand, $id){

		$query = "SELECT * from $tableBrand where brandId='$id'";

		return $this->db->select($query);

	}

	public function updateBrandbyId($tableBrand, $data, $cond){

		return $this->db->update($tableBrand, $data, $cond);

	}

	public function UpdateInAction($tableBrand,$data,$cond,$a){

			return $this->db->update($tableBrand,$data,$cond,$a);

	}

}



?>