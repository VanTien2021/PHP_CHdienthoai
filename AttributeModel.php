<?php


	class AttributeModel extends DModel

	{

		

		function __construct()

		{

			parent::__construct();



		}	


		public function AttributeByCatIdHome($tableCat,$tableAttribute,$id){

			$sql = "SELECT $tableCat.catId,$tableAttribute.* from $tableCat,$tableAttribute where $tableAttribute.catId = $tableCat.catId and $tableAttribute.catId = $id";

			return $this->db->select($sql);

		}

		public function ListDetailAttributeHome($tableDetailAttribute){

			$sql = "SELECT * from $tableDetailAttribute";

			return $this->db->select($sql);

		}

		public function ListProperty($tableProperty,$tableProduct,$tableAttribute,$tableDetailAttribute,$tableCat,$cond){

			$sql = "SELECT $tableProduct.productName,$tableProduct.productId,$tableAttribute.attribute_id,$tableAttribute.name_attribute,$tableCat.catName,$tableCat.catId,$tableDetailAttribute.detail_attribute_id,$tableDetailAttribute.detail_attribute,$tableProperty.* from $tableAttribute,$tableCat,$tableDetailAttribute,$tableProperty,$tableProduct where $tableProperty.productId = $tableProduct.productId and $tableProperty.catId = $tableCat.catId and $tableProperty.attribute_id = $tableAttribute.attribute_id and $tableProperty.detail_attribute_id = $tableDetailAttribute.detail_attribute_id and $cond order by $tableProperty.attribute_id desc";

			return $this->db->select($sql);

		}


		public function ListDetailAttribute($tableAttribute,$tableCat,$tableDetailAttribute){

			$sql = "SELECT $tableAttribute.*,$tableCat.*,$tableDetailAttribute.* from $tableAttribute,$tableCat,$tableDetailAttribute where $tableAttribute.catId = $tableCat.catId and $tableDetailAttribute.catId = $tableCat.catId and $tableAttribute.attribute_id = $tableDetailAttribute.attribute_id order by $tableDetailAttribute.detail_attribute_id desc";

			return $this->db->select($sql);

		}

		public function AddProperty($tableProperty,$data){

			return $this->db->insert($tableProperty,$data);

		}

		public function InsertAttribute($tableAttribute,$data){

			return $this->db->insert($tableAttribute,$data);

		}

		public function InsertDetailAttribute($tableAttribute,$data){

			return $this->db->insert($tableAttribute,$data);

		}

		public function ListAttribute($tableAttribute,$tableCat){

			$sql = "SELECT * from $tableAttribute,$tableCat where $tableAttribute.catId = $tableCat.catId order by catName desc";

			return $this->db->select($sql);

		}

		public function SelectAttributeById($tableAttribute,$tableDetailAttribute,$cond){

			$sql = "SELECT $tableAttribute.*,$tableDetailAttribute.* from $tableAttribute,$tableDetailAttribute where $tableDetailAttribute.attribute_id = $tableAttribute.attribute_id and $cond ORDER BY $tableDetailAttribute.attribute_id ASC";

			return $this->db->select($sql);

		}

		public function SelectDetailAttribute($tableAttribute,$tableCat,$cond){

			$sql = "SELECT * from $tableAttribute,$tableCat where $tableAttribute.catId = $tableCat.catId and $cond";

			return $this->db->select($sql);

		}

		public function SelectAttributeMultiSelect($tableAttribute,$tableCat,$cond){

			$sql = "SELECT * from $tableAttribute,$tableCat where $tableAttribute.catId = $tableCat.catId and $cond";

			return $this->db->select($sql);

		}

		public function SelectAttributeAddProduct($tableAttribute,$tableCat,$cond){

			$sql = "SELECT * from $tableAttribute,$tableCat where $tableAttribute.catId = $tableCat.catId and $cond";

			return $this->db->select($sql);

		}

		public function DelAttribute($tableAttribute,$cond){

			return $this->db->delete($tableAttribute,$cond);

		}

		public function DelDetailAttribute($tableDetailAttribute,$cond){

			return $this->db->delete($tableDetailAttribute,$cond);

		}

		public function DelProperty($tableProperty,$cond){

			return $this->db->delete($tableProperty,$cond);

		}

		public function AttributeById($tableAttribute,$cond){

			$sql = "SELECT * from $tableAttribute where $cond LIMIT 1";

			return $this->db->select($sql);

		}

		public function AttributeDetailById($tableAttribute,$tableDetailAttribute,$tableCat,$cond){

			$sql = "SELECT $tableAttribute.*,$tableCat.*,$tableDetailAttribute.* from $tableAttribute,$tableCat,$tableDetailAttribute where $tableAttribute.catId = $tableCat.catId and $tableDetailAttribute.catId = $tableCat.catId and $tableAttribute.attribute_id = $tableDetailAttribute.attribute_id and $cond LIMIT 1";

			return $this->db->select($sql);

		}

		public function UpdateAttribute($tableAttribute,$data,$cond){

			return $this->db->update($tableAttribute,$data,$cond);

		}

		public function UpdateDetailAttribute($tableDetailAttribute,$data,$cond){

			return $this->db->update($tableDetailAttribute,$data,$cond);

		}



	}









?>