<?php

	class CartModel extends DModel

	{

		

		public function __construct()

		{

			parent::__construct();

			

		}

		public function countCart($tableCart){

				$sql = "SELECT COUNT(*) FROM $tableCart";

				return $this->db->countRow($sql);

		}

		public function getProductbyMultiId($tablePro,$a){

			$query = "SELECT * from $tablePro where productId IN($a)";

			return $this->db->select($query);

		}

		public function InsertCart($tableCart,$data){

			return $this->db->insert($tableCart,$data);

		}
		public function countOrderNew($tableCart){
			$query = "SELECT COUNT(*) from $tableCart where datemodified =''";

			return $this->db->countRow($query);
		}
		public function countPayed($tableCart){
			$query = "SELECT COUNT(*) from $tableCart where solve = '1'";

			return $this->db->countRow($query);
		}
		public function countPayNotYet($tableCart){
			$query = "SELECT COUNT(*) from $tableCart where solve = '0'";

			return $this->db->countRow($query);
		}

		

	}





?>