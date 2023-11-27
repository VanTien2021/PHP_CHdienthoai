<?php

	class PostModel extends DModel
	{
		
		function __construct()
		{
			parent::__construct();
		}
		public function change_active_onepost($tableOnePost,$data,$cond_onepost){
			return $this->db->update($tableOnePost,$data,$cond_onepost);
		}
		public function change_active_post($tablePost,$data,$cond_post){
			return $this->db->update($tablePost,$data,$cond_post);
		}
		public function countpostActive($tablePost){
				$sql = "SELECT COUNT(*) FROM $tablePost where active = '0'";
				return $this->db->countRow($sql);
			}
		public function countpost_bycate_paging($tablePost,$tableCatPost,$id){
			$sql = "SELECT COUNT(*) from $tablePost,$tableCatPost where $tablePost.postcat = $tableCatPost.catepostId and $tablePost.postcat = $id order by $tablePost.postId desc";
				return $this->db->countRow($sql);
		}
		public function PostCategoryHome_Paging($tablePost, $tableCatPost, $start_from, $record_per_page,$id){
			$query = "SELECT $tablePost.*, $tableCatPost.catpost, $tableCatPost.catepostId from $tablePost,$tableCatPost
				WHERE  $tablePost.postcat = $tableCatPost.catepostId AND $tablePost.postcat = $id order by $tablePost.postId desc
					LIMIT $start_from, $record_per_page";
				return $this->db->select($query);
		}
		public function countpostInActive($tablePost){
				$sql = "SELECT COUNT(*) FROM $tablePost where active = '1'";
				return $this->db->countRow($sql);
			}
		public function countpostFeathered($tablePost){
				$sql = "SELECT COUNT(*) FROM $tablePost where type = '0'";
				return $this->db->countRow($sql);
			}
		public function AddPost($tablePost,$data){
			return $this->db->insert($tablePost,$data);
		}
		public function InsertOnePost($tableOnePost,$data){
			return $this->db->insert($tableOnePost,$data);
		}
		public function post_limit($tablePost){
			$sql = "SELECT * FROM $tablePost ORDER BY postId desc LIMIT 5 ";
				return $this->db->select($sql);
		}
		public function AddPostByCat($tablePost,$data){
			return $this->db->insert($tablePost,$data);
		}
		public function listPost($tablePost, $tableCatPost){
			$query = "SELECT $tablePost.*, $tableCatPost.catepostId, $tableCatPost.catpost from $tablePost,$tableCatPost
			WHERE  $tablePost.postcat = $tableCatPost.catepostId order by $tablePost.postId desc
				";
			return $this->db->select($query);
		}
		public function listPostHome($tablePost, $tableCatPost){
			$query = "SELECT $tablePost.*, $tableCatPost.catepostId, $tableCatPost.catpost from $tablePost,$tableCatPost
			WHERE  $tablePost.postcat = $tableCatPost.catepostId order by $tablePost.postId desc
				";
			return $this->db->select($query);
		}
		public function listPostHome_limit($tablePost, $tableCatPost){
			$query = "SELECT $tablePost.*, $tableCatPost.catepostId, $tableCatPost.catpost from $tablePost,$tableCatPost
			WHERE  $tablePost.postcat = $tableCatPost.catepostId order by $tablePost.postId desc
				LIMIT 5";
			return $this->db->select($query);
		}
		public function PostRelatedHome($tablePost,$tableCatPost,$postcatId,$id){
			$query = "SELECT $tablePost.*, $tableCatPost.catepostId, $tableCatPost.catpost from $tablePost,$tableCatPost
			WHERE  $tablePost.postcat = $tableCatPost.catepostId AND $tablePost.postcat = '$postcatId' AND $tablePost.postId NOT IN('$id') order by $tablePost.postId desc
				";
			return $this->db->select($query);
		}
		public function listOnePost($tableOnePost, $tableOneCatPost){
			$query = "SELECT $tableOnePost.*, $tableOneCatPost.id_onecatpost, $tableOneCatPost.onecatpostName from $tableOnePost,$tableOneCatPost
			WHERE  $tableOnePost.onepostcat = $tableOneCatPost.id_onecatpost order by $tableOnePost.id_onepost desc
				";
			return $this->db->select($query);
		}
		public function OnePostById($tableOnePost, $condonepost){
			$query = "SELECT * FROM $tableOnePost WHERE $condonepost ORDER BY id_onepost DESC LIMIT 1
				";
			return $this->db->select($query);
		}

		public function delOnePostById($tableOnePost, $cond){
			return $this->db->delete($tableOnePost,$cond);
		}
		public function PostByCat($tablePost, $tableCatPost, $id){
			$query = "SELECT $tablePost.*, $tableCatPost.catepostId, $tableCatPost.catpost from $tablePost,$tableCatPost
			WHERE  $tablePost.postcat = $tableCatPost.catepostId and $tablePost.postcat='$id'  order by $tablePost.postId desc
				";
			return $this->db->select($query);
		}
		public function PostByCatHome($tablePost, $tableCatPost, $id){
			$query = "SELECT $tablePost.*, $tableCatPost.catepostId, $tableCatPost.catpost from $tablePost,$tableCatPost
			WHERE  $tablePost.postcat = $tableCatPost.catepostId and $tablePost.postcat='$id' order by $tablePost.postId desc
				LIMIT 1";
			return $this->db->select($query);
		}
		public function PostCategory($tableCatePost){
			$query = "SELECT * from $tableCatePost order by catepostId desc";
			return $this->db->select($query);
		}
		public function allPost($tablePost){
			$query = "SELECT * from $tablePost order by postId desc";
			return $this->db->select($query);
		}
		public function allPostFooter($tablePost){
			$query = "SELECT * from $tablePost order by postId desc LIMIT 5";
			return $this->db->select($query);
		}
		public function PostFeatheredHome($tablePost){
			$query = "SELECT * from $tablePost order by postId desc LIMIT 5";
			return $this->db->select($query);
		}
		public function postDetailHome($tablePost,$tableCatPost, $id){
			$query = "SELECT $tablePost.*,$tableCatPost.catepostId,$tableCatPost.catpost from $tablePost,$tableCatPost where $tablePost.postcat = $tableCatPost.catepostId and $tablePost.postId = '$id'";
			return $this->db->select($query);
		}
		public function PostById($tablePost, $id){
			$query = "SELECT * from $tablePost where postId = '$id'";
			return $this->db->select($query);
		}
		public function delPostById($tablePost, $cond){
			return $this->db->delete($tablePost, $cond);
		}
		public function DelInActionPost($tablePost,$cond,$a){
				return $this->db->deleteInAction($tablePost,$cond,$a);
			}
		public function UpdatePost($tablePost,$data,$cond){
				return $this->db->update($tablePost, $data, $cond);
		}
		public function UpdateOnePost($tableOnePost,$data,$cond){
				return $this->db->update($tableOnePost, $data, $cond);
			}
		public function UpdateInActionPost($tablePost,$data,$cond,$a){
			return $this->db->updateinAction($tablePost, $data, $cond,$a);
		}
	}




?>