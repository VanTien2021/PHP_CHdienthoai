<?php


	class UserModel extends DModel

	{

		

		function __construct()

		{

			parent::__construct();

		}
		public function change_active_user($tableUser,$data,$cond_users){
			return $this->db->update($tableUser,$data,$cond_users);
		}
		public function AddUser($tableUser,$data){

			$this->db->insert($tableUser,$data);

		}

		public function listUser($tableUser){

			$query = "SELECT * from $tableUser order by userId desc";

			return $this->db->select($query);

		}
		public function update_user_password($tableUser,$data,$cond_updated){
			return $this->db->update($tableUser,$data,$cond_updated);
		} 
		public function get_user_by_id($tableUser,$cond_user){
			$query = "SELECT * from $tableUser where $cond_user LIMIT 1";

			return $this->db->select($query);
		}
		public function delUserById($tableUser, $cond){

			return $this->db->delete($tableUser, $cond);

		}
		public function UpdateInAction($tableUser,$data,$cond,$a){
			$this->db->updateinAction($tableUser,$data,$cond,$a);
		}

	}

?>