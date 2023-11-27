<?php

	class Brand extends DController

	{

		

		function __construct()

		{

			parent::__construct();

		}

		public function Index(){

			

			$this->makeBrand();

		}

		public function makeBrand(){

				Session::checkSession();

				$this->load->view('admin/header');

				$this->load->view('admin/sidebar');



			

				$this->load->view('admin/addbrand');



				$this->load->view('admin/footer');

		}

		public function change_active_brand(){

			if($_POST["action"]=='change_brand'){

				$brand_id = $_POST['brand_id'];

				$tableBrand = 'tbl_brand';

				$BrandModel = $this->load->model('BrandModel');

				$status = '';

				if($_POST['brand_status']==1){

					$active = 0;

					$data = array(

						'status' => $active

					);

					$cond_brand = "$tableBrand.brandId='$brand_id'";

					$result = $BrandModel->change_active_brand($tableBrand,$data,$cond_brand);

					if(isset($result)){

						echo '<div class="alert alert-success">Thương hiệu đã chuyển sang chế độ Kích hoạt</div>';

					}

				}else{

					$active = 1;

					$data = array(

						'status' => $active

					);

					$cond_brand = "$tableBrand.brandId='$brand_id'";

					$result = $BrandModel->change_active_brand($tableBrand,$data,$cond_brand);

					if(isset($result)){

						echo '<div class="alert alert-success">Thương hiệu đã chuyển sang chế độ Kích hoạt</div>';

					}

				}

					



			}

		}

		public function AddBrand(){



				if(!$_POST){

					header("Location:".BASE_URL."/Brand");

				}else{

					$mdata = array();

					$tableBrand = 'tbl_brand';



					$brandname = $_POST['brandname'];

					$meta_desc = $_POST['desc'];

					$meta_keywords = $_POST['keywords'];

					$brand_status = $_POST['brand_status'];

					$help = $this->load->helper('Helper');

					$BrandModel = $this->load->model('BrandModel');

					date_default_timezone_set('asia/ho_chi_minh');

		            $date = date("d/m/Y");

		            $hour = date("h:i:sa");

		            $date_created = $date.' '.$hour;

					$file_name = $_FILES['image']['name'];

					$file_tmp = $_FILES['image']['tmp_name'];

					$file_size = $_FILES['image']['size'];

					$permited = array('jpg','jpeg','png','gif');

					$div = explode('.', $file_name);

					$current = strtolower(current($div));

					$file_ext = strtolower(end($div));

					$rand_name = rand(0,99); 

					$time_name = date("s");

					$unique_image = $help->makeUrl($current).'-'.$time_name.$rand_name.'.'.$file_ext;

					if (!file_exists('teamplate/image/brand')) {

							mkdir('teamplate/image/brand', 0777, true);

					}

					$upload_image = "teamplate/image/brand/".$unique_image;

					if($brandname == ''){

						$mdata['msg'] = "Field do not empty";	

					}

					$data = array(

							'meta_desc' => $meta_desc,

							'meta_keywords' => $meta_keywords,

							'image' => $unique_image,

							'brandName' => $brandname,

							'brand_date_created' => $date_created,

							'status' => $brand_status

					);					

						$result = $BrandModel->AddBrand($tableBrand, $data);

						if($result == 1){

							move_uploaded_file($file_tmp, $upload_image);

							$mdata['msg'] = "Thêm hiệu sản phẩm thành công.";

						}else{

							$mdata['msg'] = "Thêm hiệu sản phẩm thất bại.";

						}

						

							$url = BASE_URL."/Brand?msg=".urlencode(serialize($mdata));

						header("Location:$url");

						

					}

				

				}

		

		public function ListBrand(){

			Session::checkSession();

			$this->load->view('admin/header');

			$this->load->view('admin/sidebar');

			$tableBrand = 'tbl_brand';



			$BrandModel = $this->load->model('BrandModel');

			$data['brandlist'] = $BrandModel->listBrand($tableBrand);

			

		

			$this->load->view('admin/listbrand', $data);



			$this->load->view('admin/footer');

			

		}

		public function editBrand($id = NULL){

			Session::checkSession();

			$this->load->view('admin/header');

			$this->load->view('admin/sidebar');



			$tableBrand = 'tbl_brand';



		

			

			$BrandModel = $this->load->model('BrandModel');

			$data['brandbyid'] = $BrandModel->BrandById($tableBrand, $id);



			$this->load->view('admin/editbrand', $data);

			$this->load->view('admin/footer');

		}

		public function delBrand($id = NULL){

			Session::checkSession();

			$tableBrand = "tbl_brand";

			$cond = "brandId=$id";

			$BrandModel = $this->load->model('BrandModel');

			$data['brandbyid'] = $BrandModel->BrandById($tableBrand, $id);

			$path_unlink = "teamplate/image/brand/";

			foreach($data['brandbyid'] as $key => $value){

				$value_image = $value['image'];

				if($value_image){

					unlink($path_unlink.$value_image);

				}

			}

			$result = $BrandModel->DelBrand($tableBrand, $cond);



			$mdata = array();

						if($result == 1){

							$mdata['msg'] = "Xóa thương hiệu sản phẩm thành công";

						}else{

							$mdata['msg'] = "Xóa thương hiệu sản phẩm thất bại";

						}

						$url = BASE_URL."/Brand/ListBrand?msg=".urlencode(serialize($mdata));

						header("Location:$url");



		}

	public function UpdateBrand($id = NULL){

			Session::checkSession();

			if(!$_POST){

				header("Location:".BASE_URL."/Brand/ListBrand");

			}else{

				$mdata = array();

				$cond = "brandId=$id";

				$tableBrand = 'tbl_brand';

				$brandName = $_POST['brandname'];

				$help = $this->load->helper('Helper');

				$brandname = $_POST['brandname'];

				$meta_desc = $_POST['desc'];

				$meta_keywords = $_POST['keywords'];

				$brand_status = $_POST['brand_status'];

				$BrandModel = $this->load->model('BrandModel');

				date_default_timezone_set('asia/ho_chi_minh');

		       	$date = date("d/m/Y");

		        $hour = date("h:i:sa");

		        $date_created = $date.' '.$hour;



					$file_name = $_FILES['image']['name'];

					$file_tmp = $_FILES['image']['tmp_name'];

					$file_size = $_FILES['image']['size'];

					$permited = array('jpg','jpeg','png','gif');

					$div = explode('.', $file_name);

					$current = strtolower(current($div));

					$file_ext = strtolower(end($div));



					$rand_name = rand(0,99); 

					$time_name = date("s");



					$unique_image = $help->makeUrl($current).'-'.$time_name.$rand_name.'.'.$file_ext;



					if (!file_exists('teamplate/image/brand')) {

							mkdir('teamplate/image/brand', 0777, true);

					}

					$upload_image = "teamplate/image/brand/".$unique_image;



				if($brandName == ''){

						$mdata['msg'] = "Field do not empty";	



				}

				if(!empty($file_name)){

					$data['brandbyid'] = $BrandModel->BrandById($tableBrand, $id);

							$path_unlink = "teamplate/image/brand/";

							foreach($data['brandbyid'] as $key => $value){

									$image_brand = $value['image'];

									if($image_brand){

										unlink($path_unlink.$image_brand);

									}

									

								}

					$data = array (

							'meta_desc' => $meta_desc,

							'meta_keywords' => $meta_keywords,

							'image' => $unique_image,

							'brandName' => $brandname,

							'brand_date_created' => $date_created,

							'status' => $brand_status

							);

					



				}else{

					$data = array (

							'meta_desc' => $meta_desc,

							'meta_keywords' => $meta_keywords,

							'brandName' => $brandname,

							'brand_date_created' => $date_created,

							'status' => $brand_status

							);



				}

					$result = $BrandModel->updateBrandbyId($tableBrand,$data,$cond);

							

					if($result == 1){

						move_uploaded_file($file_tmp,$upload_image);

						$mdata['msg'] = "Cập nhật thương hiệu thành công";

						}else{

						$mdata['msg'] = "Cập nhật thương hiệu thất bại";

						}
							

				}

				$url = BASE_URL."/Brand/ListBrand?msg=".urlencode(serialize($mdata));

						header("Location:$url");

		}			

		public function Action(){

				Session::checkSession();

				if(!$_POST){

					$url = BASE_URL."/Brand/ListBrand";

					header("Location:$url");

				}else{

				$value = $_POST['select_smart'];

				$idBrand = $_REQUEST["select_id"];

							

				}if($value == 'empty' || $idBrand == ''){

					$mdata['msg'] = "Please choose something to do...";

				

				}elseif($value == 'inactive'){

	

					

					$a=implode(',',$idBrand);

					$cond = "brandId";

					$data = array(

						'status' => '1'

					);

					$a = implode(',',$idBrand);

					$tableBrand = 'tbl_brand';

					$BrandModel = $this->load->model('BrandModel');

					$result = $BrandModel->UpdateInAction($tableBrand,$data,$cond,$a);

					if($result){

						

							$mdata['msg'] = "Actived Multiple Brand Successfully...";

						}else{

							$mdata['msg'] = "Actived Multiple Brand Not Successfully...";

					}

				

				}elseif($value == 'active'){

	

					

					$a=implode(',',$idBrand);

					$cond = "brandId";

					$data = array(

						'status' => '0'

					);

					$a = implode(',',$idBrand);

					$tableBrand = 'tbl_brand';

					$BrandModel = $this->load->model('BrandModel');

					$result = $BrandModel->UpdateInAction($tableBrand,$data,$cond,$a);

					if($result){

						

							$mdata['msg'] = "Actived Multiple Brand Successfully...";

						}else{

							$mdata['msg'] = "Actived Multiple Brand Not Successfully...";

					}

				

				}

				$url = BASE_URL."/Brand/ListBrand?msg=".urlencode(serialize($mdata));

						header("Location:$url");

			

			

		}

}

?>