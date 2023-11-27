<?php


class CustomizableModel extends DModel

{

	

	function __construct()

	{

		parent::__construct();

	}

	public function get_variants_cartproduct($table_linked_variants,$cond_one_two){

		$sql = "SELECT * FROM $table_linked_variants where $cond_one_two";

		return $this->db->select($sql);

	}

	public function get_variants_one_product($table_option_customizable,$cond_one){

		$sql = "SELECT * FROM $table_option_customizable where $cond_one";

		return $this->db->select($sql);

	}

	public function get_variants_two_product($table_option_customizable,$cond_two){

		$sql = "SELECT * FROM $table_option_customizable where $cond_two";

		return $this->db->select($sql);

	}

	public function update_price_linked($table_linked_variants,$data,$cond){

		return $this->db->update($table_linked_variants,$data,$cond);

	}

	public function update_option_customizable_data($table_option_customizable,$data,$cond){

		return $this->db->update($table_option_customizable,$data,$cond);

	}

	public function update_linked_variants_image($table_linked_variants,$data,$cond){

		return $this->db->update($table_linked_variants,$data,$cond);

	}

	public function get_image_variants_one($table_linked_variants,$cond_variants_one){

		$sql = "SELECT * FROM $table_linked_variants where $cond_variants_one";

		return $this->db->select($sql);

	}

	public function update_linked_variants_image_by_id($table_linked_variants,$data,$cond){

		return $this->db->update($table_linked_variants,$data,$cond);

	}

	public function del_fetch_data_linked_variants($table_linked_variants,$cond){

		return $this->db->delete($table_linked_variants,$cond);

	}

	public function select_linked_variants($table_linked_variants,$cond){

		$sql = "SELECT * FROM $table_linked_variants where $cond";

		return $this->db->select($sql);

	}

	public function get_image_variants($table_linked_variants,$table_product ,$cond_variants){

		$sql = "SELECT * FROM $table_linked_variants,$table_product where $cond_variants";

		return $this->db->select($sql);

	}

	public function fetch_data_linked_variants_1($table_option_customizable,$table_linked_variants,$table_product,$cond){

		$sql = "SELECT * FROM $table_option_customizable,$table_linked_variants,$table_product where $cond ORDER BY $table_linked_variants.option_customizable_id_0 asc";

		return $this->db->select($sql);

	}

	public function get_variants($table_option_customizable,$table_linked_variants,$cond_demo){

		$sql = "SELECT * FROM $table_option_customizable,$table_linked_variants where $cond_demo";

		return $this->db->select($sql);

	}

	public function demo_variants_1($table_option_customizable,$table_linked_variants,$cond){

		$sql = "SELECT * FROM $table_option_customizable,$table_linked_variants where $cond GROUP BY $table_linked_variants.option_customizable_id_0";

		return $this->db->select($sql);

	}

	public function fetch_data_linked_variants_2($table_option_customizable){

		$sql = "SELECT * FROM $table_option_customizable";

		return $this->db->select($sql);

	}

	public function insert_option_linked($table_linked_variants,$data){

		return $this->db->insert($table_linked_variants,$data);

	}

	public function count_linked_variants($table_linked_variants,$count_linked_variants){

		$sql = "SELECT COUNT(DISTINCT $table_linked_variants.product_id) FROM $table_linked_variants where $count_linked_variants ";

		return $this->db->countRow($sql);

	}

	public function count_option_customizable_variants($table_option_customizable_variants){

		$sql = "SELECT COUNT(DISTINCT $table_option_customizable_variants.customizable_id) FROM $table_option_customizable_variants";

		return $this->db->countRow($sql);

	}

	public function select_linked_customizable($table_customizable,$table_customizable_product,$id){

		$sql = "SELECT * FROM $table_customizable,$table_customizable_product where $table_customizable_product.product_id='$id' AND $table_customizable.customizable_id = $table_customizable_product.customizable_id GROUP BY $table_customizable.customizable_id";

		return $this->db->select($sql);

	}

	public function select_linked_option_customizable($table_option_customizable,$table_option_customizable_variants,$id){

		$sql = "SELECT * FROM $table_option_customizable,$table_option_customizable_variants where $table_option_customizable_variants.option_customizable_id = $table_option_customizable.option_customizable_id AND $table_option_customizable_variants.product_id='$id' GROUP BY $table_option_customizable_variants.option_customizable_id";

		return $this->db->select($sql);

	}

	public function select_option_customizable_variants($table_option_customizable_variants,$customizable_id){

		$sql = "SELECT * FROM $table_option_customizable_variants where customizable_id='$customizable_id'";

		return $this->db->select($sql);

	}

	public function insert($table_customizable,$data){

		return $this->db->insert($table_customizable,$data);

	}

	public function delete_customizable_product($table_customizable_product,$cond){

		return $this->db->delete($table_customizable_product,$cond);

	}

	public function delete_option_customizable_variants($table_option_customizable_variants,$cond){

		return $this->db->delete($table_option_customizable_variants,$cond);

	}

	public function fetch_option_customizable($table_option_customizable,$id){

			$sql = "SELECT * from $table_option_customizable where $table_option_customizable.customizable_id='$id'";

		return $this->db->select($sql);

	}

	public function insert_option_customizable_variants($table_option_customizable_variants,$data){

		return $this->db->insert($table_option_customizable_variants,$data);

	}

	public function select_option_customizable($table_option_customizable,$customizable_id){

			$sql = "SELECT * from $table_option_customizable WHERE customizable_id='$customizable_id'";

		return $this->db->select($sql);

	}

	public function del_option_customizable_product($table_customizable_product,$cond){

		return $this->db->delete($table_customizable_product,$cond);

	}

	public function select_customizable_product_by_id($table_customizable_product,$table_customizable,$id){

			$sql = "SELECT * from $table_customizable_product,$table_customizable where $table_customizable_product.customizable_id=$table_customizable.customizable_id AND $table_customizable_product.product_id='$id'";

		return $this->db->select($sql);

	}

	public function insert_customizable_product($table_customizable_product,$data){

		return $this->db->insert($table_customizable_product,$data);

	}

	public function del_option_customizable($table_option_customizable,$cond){

		return $this->db->delete($table_option_customizable,$cond);

	}

	public function select_customizable($table_customizable){

		$sql = "SELECT * from $table_customizable ORDER BY customizable_id desc";

		return $this->db->select($sql);

	}

	public function select_customizable_by_id($table_customizable,$id){

		$sql = "SELECT * from $table_customizable where customizable_id='$id'";

		return $this->db->select($sql);

	}

	public function get_customizable_by_id($table_customizable,$cond){

		$sql = "SELECT * from $table_customizable where $cond";

		return $this->db->select($sql);

	}

	public function update($table_customizable,$data,$cond){

		return $this->db->update($table_customizable,$data,$cond);

	}

	public function insert_option_customizable($table_option_customizable,$data){

		return $this->db->insert($table_option_customizable,$data);

	}

	



}



?>