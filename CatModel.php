<?php

	class CatModel extends DModel
	{
		
		function __construct()
		{
			parent::__construct();
		}	
		public function allcategory_admin($tableCat,$cond){
			$query = "SELECT * from $tableCat where $cond";
			return $this->db->select($query);
		}
		public function allsubcategory_admin($tableCat){
			$query = "SELECT * from $tableCat where parent_id!=0";
			return $this->db->select($query);
		}	
		public function change_active_one_cate($tableOneCatPost,$data,$cond_cate){
			return $this->db->update($tableOneCatPost,$data,$cond_cate);
		}
		public function change_active_cate($tableCat,$data,$cond_cate){
			return $this->db->update($tableCat,$data,$cond_cate);	
		}
		public function UpdateOrderList($tableCat,$data,$cond){			
			return $this->db->update($tableCat,$data,$cond);		
		}
		public function allCategory($tableCat,$cond){
			$query = "SELECT * from $tableCat where $cond";
			return $this->db->select($query);
		}
		public function allcategory_byid($tableCat,$id){
			$query = "SELECT * from $tableCat where parent_id='$id'";
			return $this->db->select($query);
		}
		public function select_cate_by_id($tableCat,$id){
			$query = "SELECT * from $tableCat where parent_id='$id'";
			return $this->db->select($query);
		}
		public function allCategoryHome($tableCat,$cond){
			$query = "SELECT * from $tableCat where $cond";
			return $this->db->select($query);
		}

		public function allSubCategory($tableCat){
			$query = "SELECT * from $tableCat where parent_id!=0";
			return $this->db->select($query);
		}
		public function AddCate($tableCat, $data){
			return $this->db->insert($tableCat,$data);

		}
		public function InsertOneCatePost($tableOneCatPost, $data){
			return $this->db->insert($tableOneCatPost,$data);
		}
		public function insertcatpost($tableCatPost, $data){
			return $this->db->insert($tableCatPost,$data);
		}
		public function listOneCategoryPost($tableOneCatPost){
			$query = "SELECT * from $tableOneCatPost order by id_onecatpost desc";
			return $this->db->select($query);
		}
		public function listCategory($tableCat){
			$query = "SELECT * from $tableCat order by catId desc";
			return $this->db->select($query);
		}
		public function listCategoryPost($tableCatPost){
			$query = "SELECT * from $tableCatPost where parent_id='0' order by catepostId desc";
			return $this->db->select($query);
		}
		public function listSubCategoryPost($tableCatPost,$cond){
			$query = "SELECT * from $tableCatPost where $cond";
			return $this->db->select($query);
		}
		public function listCategoryPostHome($tableCatPost){
			$query = "SELECT * from $tableCatPost where parent_id='0' order by catepostId desc";
			return $this->db->select($query);
		}
		public function listSubCategoryPostHome($tableCatPost,$cond){
			$query = "SELECT * from $tableCatPost where $cond";
			return $this->db->select($query);
		}
		public function listSubCategory($tableCat,$cond){
			$query = "SELECT * from $tableCat where $cond";
			return $this->db->select($query);
		}
		public function CatOnePostById($tableOneCatPost, $cond){
			$query = "SELECT * from $tableOneCatPost where $cond ";
			return $this->db->select($query);
		}
	
		public function DelCategory($tableCat, $cond){
			return $this->db->delete($tableCat,$cond);
		}
		public function DelOneCategoryPost($tableOneCatPost, $cond){
			return $this->db->delete($tableOneCatPost,$cond);
		}
		public function CatById($tableCat, $cond){
			$query = "SELECT * from $tableCat where $cond";
			return $this->db->select($query);
		}
		public function CatPostById($tableCatPost, $cond){
			$query = "SELECT * from $tableCatPost where $cond";
			return $this->db->select($query);
		}
		public function updateCatebyId($tableCat,$data,$cond){
			return $this->db->update($tableCat, $data, $cond);
		}
		public function UpdateOneCatePost($tableOneCatPost,$data, $cond){
			return $this->db->update($tableOneCatPost, $data, $cond);
		}
		public function updateCatePostbyId($tableCatPost, $data, $cond){
			return $this->db->update($tableCatPost, $data, $cond);
		}
		public function UpdateInAction($tableCat,$data,$cond,$a){
			return $this->db->update($tableCat,$data,$cond,$a);
		}
	}




?>