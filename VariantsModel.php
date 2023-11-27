<?php


	class VariantsModel extends DModel



	{



		function __construct()



		{



			parent::__construct();



		}

		public function fetch_cate_group_classes_by_id($table_cate_class,$table_cate_classes_group,$cond){

			$sql = "SELECT $table_cate_class.class_cate_id,$table_cate_classes_group.* from $table_cate_classes_group,$table_cate_class where $table_cate_class.class_cate_id = $table_cate_classes_group.class_cate_id and $cond ";

			return $this->db->select($sql);

		}

		public function get_cate_group_name($table_cate_classes_group,$id_cate_group){

			$sql = "SELECT * from $table_cate_classes_group where $table_cate_classes_group.class_cate_id = '$id_cate_group'";

			return $this->db->select($sql);

		}

		public function get_cate_group_product($table_cate_classes_group,$id_attribute){

			$sql = "SELECT * from $table_cate_classes_group where $table_cate_classes_group.class_cate_id = '$id_attribute'";

			return $this->db->select($sql);

		}

	



		public function get_cate_group($table_cate_classes_group_details,$table_cate_classes_group,$id_cate){

			$sql = "SELECT $table_cate_classes_group_details.cate_classes_group_id,$table_cate_classes_group.* from $table_cate_classes_group_details,$table_cate_classes_group where $table_cate_classes_group_details.cate_classes_group_id = $table_cate_classes_group.cate_classes_group_id and $table_cate_classes_group_details.cate_classes_group_id ='$id_cate' ";

			return $this->db->select($sql);

		}

		public function get_cate_classes_by_id($table_cate_class,$id){

			$sql = "SELECT * from $table_cate_class where class_cate_id = '$id'";

			return $this->db->select($sql);

		}

		public function get_cate_group_details_product($table_cate_classes_group_details,$id){

			$sql = "SELECT * from $table_cate_classes_group_details where cate_classes_group_id = '$id'";

			return $this->db->select($sql);

		}

		public function get_cate_group_details($table_cate_classes_group_details){

			$sql = "SELECT * from $table_cate_classes_group_details";

			return $this->db->select($sql);

		}

		public function get_cate_group_detail_by_id($table_cate_classes_group_details,$id){

			$sql = "SELECT * from $table_cate_classes_group_details where $table_cate_classes_group_details.cate_classes_group_details_id = '$id'";

			return $this->db->select($sql);

		}

		public function select_cate_classes_by_id($table_cate_class,$id_attribute){

			$sql = "SELECT * from $table_cate_class where class_cate_id = '$id_attribute'";

			return $this->db->select($sql);

		}

		public function select_product_variants_by_id($table_product_variant,$id_attribute){

				$sql = "SELECT * from $table_product_variant where product_id = '$id_attribute'";

			return $this->db->select($sql);

		}

		public function select_product_variants($table_product_variant){

				$sql = "SELECT * from $table_product_variant";

			return $this->db->select($sql);

		}

		public function select_variants_save($table_product_variants_save,$id){

				$sql = "SELECT * from $table_product_variants_save where product_id = '$id'";

			return $this->db->select($sql);

		}

		public function select_value_class($table_product_variants_save,$table_cate_classes_group,$id,$class_cate_id){

			$sql = "SELECT * from $table_product_variants_save,$table_cate_classes_group where $table_product_variants_save.product_id = '$id' and $table_cate_classes_group.class_cate_id = $table_product_variants_save.class_cate_id and $table_product_variants_save.class_cate_id='$class_cate_id'";

			return $this->db->select($sql);

		}

		public function select_class_name($table_product_variants_save,$table_cate_class,$class_cate_id){

				$sql = "SELECT * from $table_product_variants_save,$table_cate_class where $table_cate_class.class_cate_id = $table_product_variants_save.class_cate_id and $table_product_variants_save.class_cate_id='$class_cate_id' LIMIT 1";

			return $this->db->select($sql);

		}

		public function del_variants_product($table_product_variant,$cond_del){

			return $this->db->delete($table_product_variant,$cond_del);

		}

		public function insert_product_variants($tableProductVariants,$data){

			return $this->db->insert($tableProductVariants,$data);

		}

		public function count_value_class($table_product_variant_save,$id){

				$sql = "SELECT COUNT(*) from $table_product_variant_save where product_id = '$id'";

			return $this->db->countRow($sql);

		}

		public function count_value_class_variants($table_product_variants,$id_product){

				$sql = "SELECT COUNT(*) from $table_product_variants where product_id = '$id_product'";

			return $this->db->countRow($sql);

		}

		public function update_variants_product($table_product_variants_save,$data,$cond){

			return $this->db->update($table_product_variants_save,$data,$cond);

		}

		public function get_cate_classes_group_id($table_product_variant,$table_cate_classes_group,$id_product,$class_cate_id){

				$sql = "SELECT * from $table_product_variant,$table_cate_classes_group where $table_product_variant.class_cate_id = '$class_cate_id' AND $table_product_variant.product_id='$id_product' AND $table_product_variant.cate_classes_group_id=$table_cate_classes_group.cate_classes_group_id GROUP BY $table_product_variant.cate_classes_group_id";

			return $this->db->select($sql);

		}

		public function get_cate_classes_group_detail($table_product_variant,$table_cate_classes_group_details,$id_product,$class_cate_id,$group_id){

				$sql = "SELECT * from $table_product_variant,$table_cate_classes_group_details where $table_product_variant.class_cate_id = '$class_cate_id' AND $table_product_variant.product_id='$id_product' AND $table_product_variant.cate_classes_group_id='$group_id' AND $table_product_variant.cate_classes_group_details_id=$table_cate_classes_group_details.cate_classes_group_details_id GROUP BY $table_product_variant.cate_classes_group_details_id";

			return $this->db->select($sql);



		}

		public function get_variants_attribute_id($table_product_variant,$tableVariantsAttributes,$id_product,$class_cate_id,$group_id,$detail_id){

			$sql = "SELECT * from $table_product_variant,$tableVariantsAttributes where $table_product_variant.class_cate_id = '$class_cate_id' AND $table_product_variant.product_id='$id_product' AND $table_product_variant.cate_classes_group_id='$group_id' AND $table_product_variant.cate_classes_group_details_id ='$detail_id' AND $table_product_variant.variants_attribute_id=$tableVariantsAttributes.variants_attribute_id GROUP BY $table_product_variant.variants_attribute_id";

			return $this->db->select($sql);

		}

		public function get_cate_classes($table_cate_class){

			$sql = "SELECT * from $table_cate_class order by class_cate_id desc";

			return $this->db->select($sql);

		}

		public function get_variants_product($tableVariantsAttributes,$id){

			$sql = "SELECT * from $tableVariantsAttributes where cate_classes_group_details_id = '$id'";

			return $this->db->select($sql);

		}

		public function get_variants($tableVariantsAttributes){

			$sql = "SELECT * from $tableVariantsAttributes";

			return $this->db->select($sql);

		}

		public function get_variants_by_id($tableVariantsAttributes,$id){

			$sql = "SELECT * from $tableVariantsAttributes where cate_classes_group_details_id='$id'";

			return $this->db->select($sql);

		}

		public function insert_variants_product($tableProductVariants,$data){

			return $this->db->insert($tableProductVariants,$data);

		}

		public function insert_cate_group_classes_details($table_cate_classes_group_details,$data){

			return $this->db->insert($table_cate_classes_group_details,$data);

		}

		public function insert_variants_details($tableVariantsAttributes,$data){

			return $this->db->insert($tableVariantsAttributes,$data);

		}

		public function insert_cate_classes($table_cate_class,$data){

			return $this->db->insert($table_cate_class,$data);

		}

		public function insert_cate_group_classes($table_cate_classes_group,$data){

			return $this->db->insert($table_cate_classes_group,$data);

		}

		public function update_cate_group_classes_details($table_cate_classes_group_details,$data,$cond){

			return $this->db->update($table_cate_classes_group_details,$data,$cond);

		}

		public function update_variants_attribute($tableVariantsAttributes,$data,$cond){

			return $this->db->update($tableVariantsAttributes,$data,$cond);

		}

		public function update_cate_classes($table_cate_class,$data,$cond){

			return $this->db->update($table_cate_class,$data,$cond);

		}

		public function update_cate_classes_group($table_cate_classes_group,$data,$cond){

			return $this->db->update($table_cate_classes_group,$data,$cond);

		}

		public function del_variants_attribute($tableVariantsAttributes,$cond){

			return $this->db->delete($tableVariantsAttributes,$cond);

		}

		public function delete_cate_classes($table_cate_class,$cond){

			return $this->db->delete($table_cate_class,$cond);

		}

		public function delete_cate_classes_group($table_cate_classes_group,$cond){

			return $this->db->delete($table_cate_classes_group,$cond);

		}

		public function delete_classes_group_detail($table_product_variant,$cond_del){

			return $this->db->delete($table_product_variant,$cond_del);

		}

		public function delete_variants_detail($table_product_variant,$cond_del){

			return $this->db->delete($table_product_variant,$cond_del);

		}

		public function delete_cate_classes_group_detail($table_cate_classes_group_details,$cond){

			return $this->db->delete($table_cate_classes_group_details,$cond);

		}





	}



?>