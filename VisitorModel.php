<?php


	class VisitorModel extends DModel

	{

		

		function __construct()

		{

			parent::__construct();

		}

		public function social_by_id($tableSocials,$cond_del_socials){

			$query = "SELECT * from $tableSocials where $cond_del_socials";

			return $this->db->select($query);

		}

		public function  select_social_by_id($tableSocials,$cond){

			$query = "SELECT * from $tableSocials where $cond LIMIT 1";

			return $this->db->select($query);

		}

		public function update_social($tableSocials,$data,$cond_update_socials){

			return $this->db->update($tableSocials,$data,$cond_update_socials);

		}

		public function delete_social($tableSocials,$cond_del_socials){

			return $this->db->delete($tableSocials,$cond_del_socials);

		}

		public function list_socials($tableSocials){

			$query = "SELECT * from $tableSocials order by socials_id desc";

			return $this->db->select($query);

		}

		public function insert_social($tableSocials,$data){

			return $this->db->insert($tableSocials,$data);

		}

		public function selectVisitor($tableVisitor,$cond){

			$query = "SELECT * from $tableVisitor where $cond";

			return $this->db->select($query);

		}

		public function insertVisitor($tableVisitor,$data){

			return $this->db->insert($tableVisitor,$data);

		}

		public function updateVisitor($tableVisitor,$data,$cond){

			return $this->db->update($tableVisitor,$data,$cond);

		}

		public function selectAllVisitor($tableVisitor){

			$query = "SELECT count(id) from $tableVisitor";

			return $this->db->select($query);

		}

		public function deleteVisitor($tableVisitor,$cond){

			return $this->db->delete($tableVisitor,$cond);

		}



	}



?>