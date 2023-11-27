<?php

	class MediaModel extends DModel
	{
		
		function __construct()
		{
			parent::__construct();

		}
		public function AddVideo($tableVideo,$data){
		 	return $this->db->insert($tableVideo,$data);
		}
		public function listVideo($tableVideo,$tableCateVideo){
			$query = "SELECT * from $tableVideo as a,$tableCateVideo as b 
			
			where b.catevideoId = a.catevideo  

			order by a.videoId desc";
			return $this->db->select($query);
		}		public function selectVideoByCat($tableCatVideo,$tableVideo,$id){			$query = "SELECT * from $tableVideo as a,$tableCatVideo as b 						where b.catevideoId = a.catevideo and a.catevideo = '$id'			order by a.videoId asc";			return $this->db->select($query);		}
		public function selectVideoById($tableVideo,$cond){
			$query = "SELECT * from $tableVideo where $cond";
			return $this->db->select($query);
		}
		public function selectVideoId($tableCatVideo,$tableVideo,$id){
			$query = "SELECT * from $tableVideo where videoId='$id'";
			return $this->db->select($query);
		}
		public function selectVideoByIdAdmin($tableVideo,$id){
			$query = "SELECT * from $tableVideo where videoId='$id'";
			return $this->db->select($query);
		}
		public function UpdateVideoById($tableVideo,$data,$cond){
			return $this->db->update($tableVideo,$data,$cond);
		}
		public function selectCatVideoById($tableCateVideo,$cond){
			$query = "SELECT * from $tableCateVideo where $cond";
			return $this->db->select($query);
		}
		public function delVideo($tableVideo,$cond){
			return $this->db->delete($tableVideo,$cond);
		}
		public function delCatVideo($tableCateVideo,$cond){
			return $this->db->delete($tableCateVideo,$cond);
		}
		public function AddCateVideo($tableCatVideo, $data){
			return $this->db->insert($tableCatVideo,$data);
		}
		public function listCatVideo($tableCatVideo){
			$query = "SELECT * from $tableCatVideo order by catevideoId asc";
			return $this->db->select($query);
		}
		public function updateCateVideobyId($tableCatVideo,$data,$cond){
			return $this->db->update($tableCatVideo,$data,$cond);
		}

	}


?>