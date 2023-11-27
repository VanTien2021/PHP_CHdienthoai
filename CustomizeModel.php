<?php

	class CustomizeModel extends DModel
	{
		
		function __construct()
		{
			parent::__construct();
			$data = array();
		}		public function DeleteColorMenu($tableChangeColor,$cond){				return $this->db->delete($tableChangeColor,$cond);		}		public function selectColorToChange($tableChangeColor,$condcolormenu){			$query = "SELECT * from $tableChangeColor where $condcolormenu";			return $this->db->select($query);		}		public function updateColorToActive($tableChangeColor,$data,$cond){			return $this->db->update($tableChangeColor,$data,$cond);		}				public function selectColorMenu($tableChangeColor){			$query = "SELECT * from $tableChangeColor where section='product' order by changeId desc";			return $this->db->select($query);		}		public function InsertColorMenu($tableChangeColor,$data){			return $this->db->insert($tableChangeColor,$data);		}
		public function AddSlide($tableSlider,$data){
			return $this->db->insert($tableSlider,$data);

		}
		public function InsertPriceByColor($tableProductColor,$data){
			return $this->db->insert($tableProductColor,$data);
		}
		public function count_table($table){
			$query = "SELECT * from $table";
			return $this->db->filterCount($query);
		}
		public function fetch_table($table){
			$query = "SELECT * from $table";
			return $this->db->select($query);
		}
		public function all_table($cond){
			$query = "$cond";
			return $this->db->select($query);
		}
		public function select_table($show_table_query){
			$query = "$show_table_query";
			return $this->db->select($query);
		}
		public function change_slide_status($tableSlider,$data,$cond_slide){
			return $this->db->update($tableSlider,$data,$cond_slide);
		}
		public function selectSlide($tableSlider){
			$query = "SELECT * from $tableSlider order by sliderId desc";
			return $this->db->select($query);
		}
		public function selectSlide_home($tableSlider){
			$query = "SELECT * from $tableSlider where slide_status=0 order by sliderId desc";
			return $this->db->select($query);
		}
		public function selectSlideById($tableSlider,$cond){
			$query = "SELECT * from $tableSlider where $cond";
			return $this->db->select($query);
		}
		public function delSlide($tableSlider,$cond){
			return $this->db->delete($tableSlider,$cond);
		}
		public function ClearAllDataPost($tablePost){
			return $this->db->clearall($tablePost);
		}
		public function ClearAllDataPro($tablePro){
			return $this->db->clearall($tablePro);
		}
		public function ClearAllDataSlide($tableSlider){
			return $this->db->clearall($tableSlider);
		}
		public function ClearAllDataGal($tableGal){
			return $this->db->clearall($tableGal);
		}
		public function ClearAllDataVideo($tableVideo){
			return $this->db->clearall($tableVideo);
		}
		public function ClearAllDataBrand($tableBrand){
			return $this->db->clearall($tableBrand);
		}
		public function ClearAllDataCatPost($tableCatPost){
			return $this->db->clearall($tableCatPost);
		}
		public function ClearAllDataCat($tableCat){
			return $this->db->clearall($tableCat);
		}

		public function ClearAllDataCatVideo($tableCatVideo){
			return $this->db->clearall($tableCatVideo);
		}




	}


?>