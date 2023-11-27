<?php

	class Variants extends DController

	{

		

		function __construct()

		{

			parent::__construct();



			$data = array();

		}

		public function Index(){

			

			$this->GlobalAttributes();

		}

		public function AttributeClass($id){

			Session::checkSession();

			$this->load->view('admin/header');

			$this->load->view('admin/sidebar');	

			$table_cate_class = "tbl_cate_classes";

			$table_cate_classes_group = "tbl_cate_classes_group";

			$table_cate_classes_group_details = "tbl_cate_classes_group_details";

			$cond = "$table_cate_classes_group.class_cate_id = '$id'";

			$VariantsModel = $this->load->model('VariantsModel');

			$data['get_cate_classes_by_id'] = $VariantsModel->get_cate_classes_by_id($table_cate_class,$id);

			$data['get_cate_group_details'] = $VariantsModel->get_cate_group_details($table_cate_classes_group_details);

			$data['fetch_data_by_id'] = $VariantsModel->fetch_cate_group_classes_by_id($table_cate_class,$table_cate_classes_group,$cond);



			$this->load->view('admin/attribute_class',$data);

			$this->load->view('admin/footer');

		}

		public function GlobalAttributes(){

			Session::checkSession();

			$this->load->view('admin/header');

			$this->load->view('admin/sidebar');	

			$table_cate_class = "tbl_cate_classes";

			$VariantsModel = $this->load->model('VariantsModel');

			

			$data['get_cate_classes'] = $VariantsModel->get_cate_classes($table_cate_class);

			$this->load->view('admin/global_variants',$data);

			$this->load->view('admin/footer');

		}

		public function update_cate_group_detail($id){

			if(isset($_POST['group_details_name'])){

				$table_cate_classes_group_details = "tbl_cate_classes_group_details";

				$VariantsModel = $this->load->model('VariantsModel');

				$group_detail_name = $_POST['group_details_name'];

				$group_name_id = $_POST['cate_classes_group'];

				$group_sort = $_POST['group_sort'];

				$cond = "$table_cate_classes_group_details.cate_classes_group_details_id='$id'";

				$data = array(

					'group_details_name' => $group_detail_name,

					'cate_classes_group_id' => $group_name_id,

					'group_details_sort' => $group_sort

				);

				$result = $VariantsModel->update_cate_group_classes_details($table_cate_classes_group_details,$data,$cond);

				if($result){

							

							$mdata['msg'] = "Cập nhật thành công";



						}else{

							$mdata['msg'] = "Cập nhật thất bại";

						}

				$url = BASE_URL."/Variants/update_group_details/".$id."?msg=".urlencode(serialize($mdata));

						header("Location:$url");

			}

		}

		public function insert_variants(){

				if(isset($_POST['id_cate'])){

				$tableVariantsAttributes = "tbl_variants_attribute";

				$VariantsModel = $this->load->model('VariantsModel');

				$id_cate = $_POST['id_cate'];

				$variants_name = $_POST['variants_name'];

				$data = array(

					'variants_name' => $variants_name,

					'cate_classes_group_details_id' => $id_cate,

				);

				$result = $VariantsModel->insert_variants_details($tableVariantsAttributes,$data);

			}

		}

		public function update_group_details($id){

			Session::checkSession();

			$this->load->view('admin/header');

			$this->load->view('admin/sidebar');	



			$table_cate_class = "tbl_cate_classes";

			$table_cate_classes_group = "tbl_cate_classes_group";

			$table_cate_classes_group_details = "tbl_cate_classes_group_details";

			$tableVariantsAttributes = "tbl_variants_attribute";

			$VariantsModel = $this->load->model('VariantsModel');

			

			$data['get_cate_group_detail_by_id'] = $VariantsModel->get_cate_group_detail_by_id($table_cate_classes_group_details,$id);

			foreach($data['get_cate_group_detail_by_id'] as $key => $value){

				$id_cate = $value['cate_classes_group_id'];

			}

			$data['get_cate_group'] = $VariantsModel->get_cate_group($table_cate_classes_group_details,$table_cate_classes_group,$id_cate);

			foreach($data['get_cate_group'] as $key => $value){

				$id_cate_group = $value['class_cate_id'];

			}



			$data['get_cate_group_name'] = $VariantsModel->get_cate_group_name($table_cate_classes_group,$id_cate_group);

			$data['get_variants_by_id'] =  $VariantsModel->get_variants_by_id($tableVariantsAttributes,$id);

			$this->load->view('admin/edit_group_details',$data);

			$this->load->view('admin/footer');

		}

		public function insert_group_details(){

			if(isset($_POST['group_detail_name'])){

				$table_cate_classes_group_details = "tbl_cate_classes_group_details";

				$VariantsModel = $this->load->model('VariantsModel');

				$group_detail_name = $_POST['group_detail_name'];

				$group_name_id = $_POST['group_name_id'];

				$group_sort = $_POST['group_sort'];



				$data = array(

					'group_details_name' => $group_detail_name,

					'cate_classes_group_id' => $group_name_id,

					'group_details_sort' => $group_sort

				);

				$result = $VariantsModel->insert_cate_group_classes_details($table_cate_classes_group_details,$data);

			}

		}

		public function insert_group_classes_cate(){

			if(isset($_POST['classes_group_name'])){

				$table_cate_classes_group = "tbl_cate_classes_group";

				$VariantsModel = $this->load->model('VariantsModel');

				$classes_group_name = $_POST['classes_group_name'];

				$data = array(

					'class_cate_id' => $_POST['id_class_cate'],

					'group_name' => $classes_group_name

				);

				$result = $VariantsModel->insert_cate_group_classes($table_cate_classes_group,$data);

			}

		}

		public function delete_classes_cate_group(){

			$id = $_POST['id'];

			

			$table_cate_classes_group = "tbl_cate_classes_group";

			$cond = "$table_cate_classes_group.cate_classes_group_id='$id'";

			$VariantsModel = $this->load->model('VariantsModel');

			

			$result = $VariantsModel->delete_cate_classes_group($table_cate_classes_group,$cond);

		}

		public function delete_classes_detail_group(){

			$id = $_POST['id'];

			

			$table_cate_classes_group_details = "tbl_cate_classes_group_details";

			$cond = "$table_cate_classes_group_details.cate_classes_group_details_id='$id'";

			$VariantsModel = $this->load->model('VariantsModel');

			

			$result = $VariantsModel->delete_cate_classes_group_detail($table_cate_classes_group_details,$cond);

		}

		public function del_variants_attribute(){

			$id = $_POST['id'];

			$tableVariantsAttributes = "tbl_variants_attribute";

			

			$cond = "$tableVariantsAttributes.variants_attribute_id='$id'";

			$VariantsModel = $this->load->model('VariantsModel');

			

			$result = $VariantsModel->del_variants_attribute($tableVariantsAttributes,$cond);

		}

		public function active_variants_attribute(){

			$id = $_POST['id'];

			$variants_active = $_POST['variants_active'];



			$tableVariantsAttributes = "tbl_variants_attribute";

			$cond = "$tableVariantsAttributes.variants_attribute_id='$id'";

			$VariantsModel = $this->load->model('VariantsModel');

			$active = '';

			if($variants_active == 1){

				$active = 0;

				$data = array(

					'variants_active' => $active

				);



			}else{

				$active = 1;

				$data = array(

					'variants_active' => $active

				);

			}

			$result = $VariantsModel->update_variants_attribute($tableVariantsAttributes,$data,$cond);



		}

		public function update_classes_cate_group(){

			if(isset($_POST['value'])){

				$id = $_POST['id'];

				$value = $_POST['value'];

				$table_cate_classes_group = "tbl_cate_classes_group";

				$cond = "$table_cate_classes_group.cate_classes_group_id='$id'";

				$VariantsModel = $this->load->model('VariantsModel');

				

				$data = array(

					'group_name' => $value

				);

				$result = $VariantsModel->update_cate_classes_group($table_cate_classes_group,$data,$cond);

			}

		}

		public function insert_classes_cate(){

			if(isset($_POST['classes_cate_name'])){

				$table_cate_class = "tbl_cate_classes";

				$VariantsModel = $this->load->model('VariantsModel');

				$classes_cate_name = $_POST['classes_cate_name'];

				$data = array(

					'class_group_name' => $classes_cate_name

				);

				$result = $VariantsModel->insert_cate_classes($table_cate_class,$data);

			}

		}



		public function update_classes_cate(){

			if(isset($_POST['column_name'])){

				$id = $_POST['id'];

				$value = $_POST['value'];

				$table_cate_class = "tbl_cate_classes";

				$cond = "$table_cate_class.class_cate_id='$id'";

				$VariantsModel = $this->load->model('VariantsModel');

				$data = array(

					'class_group_name' => $value

				);

				$result = $VariantsModel->update_cate_classes($table_cate_class,$data,$cond);

			}

		}

		

		public function delete_classes_cate(){

			$id = $_POST['id'];

			

			$table_cate_class = "tbl_cate_classes";

			$cond = "$table_cate_class.class_cate_id='$id'";

			$VariantsModel = $this->load->model('VariantsModel');

			

			$result = $VariantsModel->delete_cate_classes($table_cate_class,$cond);

		}

		

		

	}

?>