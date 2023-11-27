	<?php
	class Product extends DController
	{
		public $key;
		public $value;
		public $data;
		public $i;
		function __construct()
		{
			parent::__construct();

			$data = array();
		}
		public function update_color_product(){
			if(isset($_POST['product_id'])){
				$price = $_POST['price'];
				$product_id = $_POST['product_id'];
				$color_id = $_POST['mamau'];
				$tableProductColor = 'tbl_product_color';

				$ProductModel = $this->load->model('ProductModel');
				$cond = "$tableProductColor.color_attribute='$color_id' AND $tableProductColor.product_id='$product_id'";
				$data = array(
					'price_color' => $price
				);
				$result = $ProductModel->update_color_price($tableProductColor,$data,$cond);


			}
		}
		public function Color(){
			Session::checkSession();
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$tableChangeColor = 'tbl_changecolor';
		
			$CustomizeModel = $this->load->model('CustomizeModel');
			
			
			$data['changecolor'] = $CustomizeModel->selectColorMenu($tableChangeColor);
			$this->load->view('admin/addcolor',$data);
			$this->load->view('admin/footer');
		}
		public function delColorProduct($id){
			$id_product = $_GET['id_product'];
			$qty_color = $_GET['qty_color'];
			$tableProductColor = 'tbl_product_color';
			$tableProduct = 'tbl_product';
			$ProductModel = $this->load->model('ProductModel');
			$cond_update = "$tableProduct.productId='$id_product'";
			$cond = "$tableProductColor.color='$id' AND $tableProductColor.product_id='$id_product'";
			 
			
			$data['colorbyid'] = $ProductModel->SelectColorById($tableProductColor,$cond);
			
			
			if($qty_color==1){
				$color_product = 0;
				
			}elseif($qty_color>1){
				$color_product = 1;
				
			}
			$data_product = array(
					'color_product' => $color_product
			);
			foreach($data['colorbyid'] as $key => $value){
				$path_unlink = "teamplate/image/attribute/";
				$image_attr = $value['image_color'];
							
				$image_del = unlink($path_unlink.$image_attr);	
								
			}
			$result_update = $ProductModel->update_product_color($tableProduct,$data_product,$cond_update);
			$result = $ProductModel->DelColorById($tableProductColor,$cond);
			if($result){
									
					$mdata['msg'] = "Xóa thành công";
									
					}else{
						$mdata['msg'] = "Xóa màu thất bại";
					}
			$url = BASE_URL."/Product/add_color/".$id_product."/?msg=".urlencode(serialize($mdata));
								header("Location:$url");
			}
		
		public function addcolorbyproduct($id){
			Session::checkSession();
			if(!$_POST){
				header("Location:".BASE_URL."/Product/add_color/".$id);
			}else{
			$helper = $this->load->Helper('Helper');
			$tableProductColor = 'tbl_product_color';
			$tableProduct = 'tbl_product';
			$CustomizeModel = $this->load->model('CustomizeModel');
			$ProductModel = $this->load->model('ProductModel');
			$color = $_POST['color'];
			$price_color = $_POST['price_color'];
			$cond_update = "$tableProduct.productId='$id'";
			$file_name = $_FILES["image_color"]["name"];
			$tmp_name = $_FILES["image_color"]['tmp_name'];
			$file_array = explode(".", $file_name);
			$current = strtolower(current($file_array));
			$file_extension = end($file_array);
			$unique_image = $helper->makeUrl($current).'-'.$time_name.$rand_name.'.'.$file_extension;

			if (!file_exists('teamplate/image/attribute')) {
				mkdir('teamplate/image/attribute', 0777, true);
			}
					
			
			
		
			$color_product = 1;
			$data_product = array(
				'color_product' => $color_product
			);
			
			$data = array(
				'color' => $color,
				'price_color' => $price_color,
				'product_id' => $id,
				'image_color' => $unique_image
			);
			
			$result_update = $ProductModel->update_product_color($tableProduct,$data_product,$cond_update);

			$result = $CustomizeModel->InsertPriceByColor($tableProductColor,$data);

			if($result){
				$upload_image = "teamplate/image/attribute/".$unique_image;
				move_uploaded_file($tmp_name, $upload_image);				
				$mdata['msg'] = "Thêm màu thành công";
							
				}else{
					$mdata['msg'] = "Thêm màu thất bại";
				}
				
			}
			$url = BASE_URL."/Product/add_color/".$id."/?msg=".urlencode(serialize($mdata));
						header("Location:$url");
		}
		public function add_color($id){
			Session::checkSession();
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$CustomizeModel = $this->load->model('CustomizeModel');
			$ProductModel = $this->load->model('ProductModel');
			$tableProduct = 'tbl_product';
			$tableProductColor = 'tbl_product_color';
			$tableChangeColor = 'tbl_changecolor';
			$this->load->id_product = $id;
			$count_color = $ProductModel->ProductColor_by_id($tableProductColor,$id);
			$this->load->count_color = $count_color;
			$data['changecolor'] = $CustomizeModel->selectColorMenu($tableChangeColor);
			
			$data['productbyid'] = $ProductModel->ColorProductById($tableProduct, $id);
		
		
			
			$data['color_by_product'] = $ProductModel->ColorById($tableProductColor,$tableChangeColor,$tableProduct,$id);
			$this->load->view('admin/addcolor_product',$data);
			$this->load->view('admin/footer');
		}
		public function upload_file_pdf($id){
				Session::checkSession();
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				
				
				$this->load->id_product = $id;
				$tableProduct = 'tbl_product';
				$ProductModel = $this->load->model('ProductModel');
				$cond = "$tableProduct.productId='$id'";
				$data['upload_file_data'] = $ProductModel->select_upload_file($tableProduct,$cond);
				$this->load->view('admin/upload_file',$data);

				$this->load->view('admin/footer');
		}
		public function upload_document($id){
				$file_tmp = $_FILES['document']['tmp_name'];
				$file_name = $_FILES['document']['name'];
				if (!file_exists('teamplate/uploads/files')) {
					mkdir('teamplate/uploads/files', 0777, true);
				}
				chmod('teamplate/uploads/files', 0777);
				$tableProduct = 'tbl_product';
				$ProductModel = $this->load->model('ProductModel');
				$cond = "$tableProduct.productId='$id'";
				$data = array(
					'product_document' => $file_name

				);
				$result = $ProductModel->upload_file($tableProduct,$data,$cond);
				if($result){
						move_uploaded_file($file_tmp, 'teamplate/uploads/files/' . $file_name);
						$mdata['msg'] = "Tải files thành công";
							

					}else{
							$mdata['msg'] = "Tải files thất bại,xin thử lại";
						}
				$url = BASE_URL."/Product/upload_file_pdf/".$id."?msg=".urlencode(serialize($mdata));
						header("Location:$url");

		}
		public function upload_image_ckeditor(){
			if(isset($_FILES['upload']['name'])){
				$help = $this->load->helper('Helper');
				$file = $_FILES['upload']['tmp_name'];
				$file_name = $_FILES['upload']['name'];
				$file_name_array = explode(".", $file_name);
				$current = strtolower(current($file_name_array));
				$extension = end($file_name_array);
				$rand_name = rand(0,99); 
				$time_name = date("s");
				$unique_image = $help->makeUrl($current).'-'.$time_name.$rand_name.'.'.$extension;
				if (!file_exists('teamplate/image/upload')) {
					mkdir('teamplate/image/upload', 0777, true);
				}
				chmod('teamplate/image/upload/', 0777);
				$allowed_extension = array("jpg", "gif", "png", "jpeg");
				if(in_array($extension, $allowed_extension))
				{

				  move_uploaded_file($file, 'teamplate/image/upload/' . $unique_image);
				  $function_number = $_GET['CKEditorFuncNum'];
				  $url = BASE_URL.'/teamplate/image/upload/' . $unique_image;
				  $message = '';
				  echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
				}

			}
		}
		public function insert_rating(){
			if(isset($_POST['index'])){
				$product_id = $_POST['product_id'];
				$index = $_POST['index'];
				$tableRating = 'tbl_rating';

				$ProductModel = $this->load->model('ProductModel');
				$data = array(
					'productId' => $product_id,
					'rating' => $index
				);
				$result = $ProductModel->insert_rating_start($tableRating,$data);
				if(isset($result)){
					echo 'done';
				}
			}
		}
		public function Index(){
			
			$this->makeProduct();
		}

		public function change_feathered_product(){
			if($_POST["action"]=='change_product_feathered'){
				$product_id = $_POST['product_id'];
				$tableProduct = 'tbl_product';
				$ProductModel = $this->load->model('ProductModel');
				$status = '';
				if($_POST['product_type']==0){
					$type = 0;
					$data = array(
						'type' => $type
					);
					$cond_type = "$tableProduct.productId='$product_id'";
					$result = $ProductModel->change_type_pro($tableProduct,$data,$cond_type);
					if(isset($result)){
						echo '<script>alert("Đã chuyển sản phẩm sang không nổi bật")</script>';
					}
				}else{
					$type = 1;
					$data = array(
						'type' => $type
					);
					$cond_type = "$tableProduct.productId='$product_id'";
					$result = $ProductModel->change_type_pro($tableProduct,$data,$cond_type);
					if(isset($result)){
						echo '<div class="alert alert-success">Đã chuyển sản phẩm sang nổi bật</div>';
					}
				}
					

			}
		}
		public function change_active_product(){
			if($_POST["action"]=='change_product'){
				$product_id = $_POST['product_id'];
				$tableProduct = 'tbl_product';
				$ProductModel = $this->load->model('ProductModel');
				$status = '';
				if($_POST['product_status']==1){
					$active = 0;
					$data = array(
						'status' => $active
					);
					$cond_pro = "$tableProduct.productId='$product_id'";
					$result = $ProductModel->change_active_pro($tableProduct,$data,$cond_pro);
					if(isset($result)){
						echo '<div class="alert alert-success">Danh mục đã chuyển sang chế độ Kích hoạt</div>';
					}
				}else{
					$active = 1;
					$data = array(
						'status' => $active
					);
					$cond_pro = "$tableProduct.productId='$product_id'";
					$result = $ProductModel->change_active_pro($tableProduct,$data,$cond_pro);
					if(isset($result)){
						echo '<div class="alert alert-success">Danh mục đã chuyển sang chế độ Không Kích hoạt</div>';
					}
				}	
			}
		}
		public function AddProperty(){
			if(isset($_POST['data_id'])){
				$data_id = $_POST['data_id'];
				$id_newest = $_POST['id_newest'];
				$thuoctinh = $_POST['thuoctinh'];
				$danhmuc = $_POST['danhmuc'];
				
				foreach($data_id as $val){
					$data_id = $val;
				}
				foreach($thuoctinh as $value){
					$thuoctinh = $value;
				}
				foreach($danhmuc as $value2){
					$danhmuc = $value2;
				}

				$data = array(
					'productId' => $id_newest,
					'catId' => $danhmuc,
					'attribute_id' => $thuoctinh,
					'detail_attribute_id' => $data_id
				);
				$tableProperty = 'tbl_property';
				$ProductModel = $this->load->model('ProductModel');
				$result = $ProductModel->AddProductDetailId($tableProperty,$data);
				
				 }
			
			

		}
		public function insert_product_variants(){
			if(isset($_POST['get_classes'])){

				$tableProductVariants = 'tbl_product_variants';
				$tableVariantsSave = "tbl_product_variants_save";
				$VariantsModel = $this->load->model('VariantsModel');
				$output = '';
				$get_classes = $_POST['get_classes'];
				$productid = $_POST['productid'];
				$select_group_detail = $_POST['select_group_detail'];
				$get_variants = $_POST['get_variants'];
				$class_cate_id = $_POST['class_cate_id'];

					$data = array(
					'product_id' => $productid,
					'class_cate_id' => $class_cate_id,
					'cate_classes_group_id' => $get_classes,
					'cate_classes_group_details_id' => $select_group_detail,
					'variants_attribute_id' => $get_variants
					);

					$result = $VariantsModel->insert_product_variants($tableProductVariants,$data);
					if($result){
						$output.= 'Thêm thành công tính năng,f5 trình duyệt để thấy sự thay đổi';
						echo $output;
					}
			}
		}
		public function insert_variants_product(){

			if(isset($_POST['action'])=='insert_variants'){
				$tableVariantsSave = "tbl_product_variants_save";
				$VariantsModel = $this->load->model('VariantsModel');
				
			
					$data = array(
					'product_id' => $_POST['productid'],
					'class_cate_id' => $_POST['class_cate_id'],
					);
					$result = $VariantsModel->insert_variants_product($tableVariantsSave,$data);
		
			}
			
		}
		public function delete_cate_classes_group(){
			if(isset($_POST["group_id"])){
				$id_product = $_POST['productid'];
				$group_id = $_POST['group_id'];
				$table_product_variant = "tbl_product_variants";
				$VariantsModel = $this->load->model('VariantsModel');
				$cond_del = "$table_product_variant.product_id='$id_product' AND $table_product_variant.cate_classes_group_id='$group_id'";
				$data['get_group_class'] = $VariantsModel->select_product_variants($table_product_variant);
				foreach($data['get_group_class'] as $key => $get_classes){
					$get_classes_id = $get_classes['product_id'];
					if(isset($get_classes_id)){
						$result = $VariantsModel->delete_cate_classes_group($table_product_variant,$cond_del);
					} 
				}
				
			}
		}
		public function delete_cate_classes_group_detail(){
			if(isset($_POST["group_detail"])){
				$id_product = $_POST['productid'];
				$group_detail = $_POST['group_detail'];
				$table_product_variant = "tbl_product_variants";
				$VariantsModel = $this->load->model('VariantsModel');
				$cond_del = "$table_product_variant.product_id='$id_product' AND $table_product_variant.cate_classes_group_details_id='$group_detail'";
				$data['get_group_class_detail'] = $VariantsModel->select_product_variants($table_product_variant);
				foreach($data['get_group_class_detail'] as $key => $get_classes){
					$get_classes_id = $get_classes['product_id'];
					$cate_classes_group_details_id = $get_classes['cate_classes_group_details_id'];
					if(isset($get_classes_id) && isset($cate_classes_group_details_id)){
						$result = $VariantsModel->delete_classes_group_detail($table_product_variant,$cond_del);
					} 
				}
				
			}
		}
		public function delete_variant(){
			if(isset($_POST["variants_id"])){
				$id_product = $_POST['productid'];
				$variants_id = $_POST['variants_id'];
				$table_product_variant = "tbl_product_variants";
				$VariantsModel = $this->load->model('VariantsModel');
				$cond_del = "$table_product_variant.product_id='$id_product' AND $table_product_variant.variants_attribute_id='$variants_id'";
				$data['get_group_class_detail'] = $VariantsModel->select_product_variants($table_product_variant);
				foreach($data['get_group_class_detail'] as $key => $get_classes){
					$get_classes_id = $get_classes['product_id'];
					$variants_attribute_id = $get_classes['variants_attribute_id'];

					if(isset($get_classes_id) && isset($variants_attribute_id)){
						$result = $VariantsModel->delete_variants_detail($table_product_variant,$cond_del);
					} 
				}
				
			}
		}
		public function insert_option_linked(){
			if(isset($_POST['product_id_option'])){
			
				
				$product_id_option = $_POST['product_id_option'];
				$table_linked_variants = "tbl_linked_variants";

				$CustomizableModel = $this->load->model('CustomizableModel');
				if(!empty($image_name)){
				}else{
					$size_of = sizeof($_POST['hidden_option']);
						if($size_of==1){
							for($for=0;$for<count($_POST['hidden_option']);$for++){
						
							$data = array(
								'product_id' => $product_id_option,
								'option_customizable_id_'.$for => $_POST['hidden_option'][$for]	
								);
							break;
							}
							
						}elseif($size_of==2){
							for($for=1;$for<count($_POST['hidden_option']);$for++){
								for($count=0;$count<count($_POST['hidden_option']);$count++){
							$data = array(
								'product_id' => $product_id_option,
								'option_customizable_id_'.$count => $_POST['hidden_option'][$count],
								'option_customizable_id_'.$for => $_POST['hidden_option'][$for]
								);
							break;
							}
							}		
						
						}
			$result = $CustomizableModel->insert_option_linked($table_linked_variants,$data);
		}
	}
}
		public function insert_option_customizable_variants(){
			if(isset($_POST['product_id_option'])){
				$product_id_option = $_POST['product_id_option'];
				$customizable_id = $_POST['customizable_id'];
				$table_option_customizable_variants = "tbl_option_customizable_variants";
				$CustomizableModel = $this->load->model('CustomizableModel');
					for($count=0;$count<count($_POST['hidden_option']);$count++){
						$data = array(

						'product_id' => $product_id_option,
						'customizable_id' => $customizable_id,
						'option_customizable_id' => $_POST['hidden_option'][$count]

					);
				$result = $CustomizableModel->insert_option_customizable_variants($table_option_customizable_variants,$data);
				}
				if(isset($result)){
					echo 'done';
				}
				
				
			}
		}
		public function delete_optioned_customizable(){
			if(isset($_POST['product_id_option'])){
				$product_id_option = $_POST['product_id_option'];
				$customizable_id = $_POST['customizable_id'];
				$table_customizable_product = "tbl_customizable_product";
				$table_option_customizable_variants = "tbl_option_customizable_variants";
				$CustomizableModel = $this->load->model('CustomizableModel');
			
				$cond1 = "$table_customizable_product.product_id = '$product_id_option' AND $table_customizable_product.customizable_id = '$customizable_id'";

				$result = $CustomizableModel->delete_customizable_product($table_customizable_product,$cond1);
				$data['select_option_customizable'] = $CustomizableModel->select_option_customizable_variants($table_option_customizable_variants,$customizable_id);
				foreach($data['select_option_customizable'] as $key => $value){
					$cond2 = "$table_option_customizable_variants.product_id = '$product_id_option' AND $table_option_customizable_variants.customizable_id = '$customizable_id'";
					$customizable_id_value = $value['customizable_id'];
					if($customizable_id_value){
						$result = $CustomizableModel->delete_option_customizable_variants($table_option_customizable_variants,$cond2);
					}
				}
				
				
			}
		}
		public function insert_option_customizable_product(){
			Session::checkSession();
			if(isset($_POST['customizable_id'])){
				$table_customizable_product = "tbl_customizable_product";
				$CustomizableModel = $this->load->model('CustomizableModel');
				$data = array(
					'product_id' => $_POST['product_id'],
					'customizable_id' => $_POST['customizable_id']

				);
				$result = $CustomizableModel->insert_customizable_product($table_customizable_product,$data);
			}
		}
		public function del_option_customizable_product(){
			if(isset($_POST['customizable_product_id'])){
				$id = $_POST['customizable_product_id'];
				$table_customizable_product = "tbl_customizable_product";
				$CustomizableModel = $this->load->model('CustomizableModel');
				$cond = "$table_customizable_product.customizable_product_id='$id'";
				$result = $CustomizableModel->del_option_customizable_product($table_customizable_product,$cond);
			}
		
		}
		public function select_option_customizable(){
			if(isset($_POST['customizable_id'])){
				$customizable_id = $_POST['customizable_id'];
				$table_option_customizable = "tbl_option_customizable";
				$CustomizableModel = $this->load->model('CustomizableModel');
			
				$output = '';

				$data['select_option_customizable'] = $CustomizableModel->select_option_customizable($table_option_customizable,$customizable_id);
				foreach ($data['select_option_customizable'] as $key => $value) {

					$output .= '<option value="'.$value['option_customizable_id'].'">'.$value['option_customizable_name'].'</option>';
				}
				echo $output;

			}
		}
		public function fetch_img_variants_demo(){
			if(isset($_POST['id_list_two'])){
				$table_option_customizable = "tbl_option_customizable";
				$table_linked_variants = "tbl_linked_variants";
				$help = $this->load->helper('Helper');
				$table_product = "tbl_product";
				$id_option_two = $_POST['id_list_two'];
				$id_option_one = $_POST['id_list'];
				$id_product = $_POST['id_product_two'];
				$output = '';
				$CustomizableModel = $this->load->model('CustomizableModel');
				$cond_variants = "$table_linked_variants.product_id='$id_product' AND $table_linked_variants.option_customizable_id_0='$id_option_one' AND $table_linked_variants.option_customizable_id_1='$id_option_two' AND $table_linked_variants.product_id = $table_product.productId";

						$data['get_image_variants'] = $CustomizableModel->get_image_variants($table_linked_variants,$table_product,$cond_variants);
						foreach($data['get_image_variants'] as $key => $value){
							if($value['price_change']!=''){
								$price_change = $value['price_change'];
							}else{
								$price_change = '0';
							}
							if($value['option_customizable_id_0']!=0 && $value['option_customizable_id_1']!=0){
								$output .= '<img src="'.BASE_URL.'/teamplate/image/variants/'.$value['customizable_image'].'" class="img img-thumbnail" width="250px"><br>';
								$output .= '<span>Giá gốc sản phẩm: '.$help->format_currency($value['price']).' '."VNĐ".'</span><br>';
								$output .= '<span>Giá gốc khuyến mãi: '.$help->format_currency($value['price_promo']).' '."VNĐ".'</span><br>';
								$output .= '<span>Giá tùy chọn này: '.' + '.$help->format_currency($price_change).' '."VNĐ".'</span><br>';
							}
						
						}

				echo $output;
				
			}
		}
		public function fetch_variants_by_variants(){
			if(isset($_POST['id_list'])){
				$table_option_customizable = "tbl_option_customizable";
				$table_linked_variants = "tbl_linked_variants";

				$id_option_1 = $_POST['id_list'];
				$id_product = $_POST['id_product'];
				$output = '<ul class="variants_two">';
				$CustomizableModel = $this->load->model('CustomizableModel');
				$cond_demo = "$table_option_customizable.option_customizable_id=$table_linked_variants.option_customizable_id_0 AND $table_linked_variants.product_id='$id_product' AND $table_linked_variants.option_customizable_id_0='$id_option_1'";
				$data['get_variants_two'] = $CustomizableModel->get_variants($table_option_customizable,$table_linked_variants,$cond_demo);
				$data['get_name_variants_two'] = $CustomizableModel->fetch_data_linked_variants_2($table_option_customizable);

				foreach($data['get_variants_two'] as $key => $value){
					

					if($value['option_customizable_id_0']!=0 && $value['option_customizable_id_1']!=0){
						$id_value_1 = $value['option_customizable_id_1'];
						foreach($data['get_name_variants_two'] as $key => $value2){
							if($id_value_1==$value2['option_customizable_id']){
								$output .= '<input type="hidden" class="id_pro_two" name="id_pro_two" value="'.$id_product.'">';
								
								$output .= '<input type="hidden" class="id_list_two" name="id_list_two" value="'.$id_option_1.'">';
								
								$output .= '<li class="variants_two_li" id="'.$value2['option_customizable_id'].'">'.$value2['option_customizable_name'].'</li>';
							}
						}
					}
					
				}
				$output .= '</ul>';
				echo $output;
				
			}
		}
		public function AddVariants($id = NULL){
				Session::checkSession();
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$output = '';
				$tableProduct = 'tbl_product';
				$tableVariantsAttributes = "tbl_variants_attribute";
				$table_cate_class = "tbl_cate_classes";
				$table_customizable_product = "tbl_customizable_product";
			
				$table_customizable = 'tbl_customizable';
				$table_product_variant = "tbl_product_variants";
				$table_option_customizable = "tbl_option_customizable";
				$table_product_variants_save = "tbl_product_variants_save";
				$table_linked_variants = "tbl_linked_variants";
				$table_cate_classes_group = "tbl_cate_classes_group";
				$table_cate_classes_group_details = "tbl_cate_classes_group_details";
				$table_option_customizable_variants = "tbl_option_customizable_variants";
				$ProductModel = $this->load->model('ProductModel');
				$VariantsModel = $this->load->model('VariantsModel');
				$table_option_customizable = "tbl_option_customizable";
				$CustomizableModel = $this->load->model('CustomizableModel');

				$cond_demo = "$table_option_customizable.option_customizable_id=$table_linked_variants.option_customizable_id_0 AND $table_linked_variants.product_id='$id'";

				$data['demo_variants_1'] = $CustomizableModel->demo_variants_1($table_option_customizable,$table_linked_variants,$cond_demo);


				$data['select_customizable_product_by_id'] = $CustomizableModel->select_customizable_product_by_id($table_customizable_product,$table_customizable,$id);
				$data['select_customizable'] = $CustomizableModel->select_customizable($table_customizable);
				$data['select_product_variants_by_id'] = $VariantsModel->select_product_variants_by_id($table_product_variant,$id);
				$data['select_variants_save'] = $VariantsModel->select_variants_save($table_product_variants_save,$id);
				$data['select_linked_customizable'] = $CustomizableModel->select_linked_customizable($table_customizable,$table_customizable_product,$id);
				$data['select_linked_option_customizable'] = $CustomizableModel->select_linked_option_customizable($table_option_customizable,$table_option_customizable_variants,$id);

				$data['count_value_class'] = $VariantsModel->count_value_class($table_product_variants_save,$id);

				$this->load->count_value = $data['count_value_class'];
				if($this->load->count_value>0){
					foreach($data['select_variants_save'] as $key => $value){
						
						$class_cate_id = $value['class_cate_id'];
						$data['select_value_class'] = $VariantsModel->select_value_class($table_product_variants_save,$table_cate_classes_group,$id,$class_cate_id);
				
						$data['select_class_name'] = $VariantsModel->select_class_name($table_product_variants_save,$table_cate_class,$class_cate_id);
						$this->load->class_cate_id = $value['class_cate_id'];
					}
				
				}else{
						$data['select_value_class'] = $VariantsModel->select_value_class($table_product_variants_save,$table_cate_classes_group,$id,$class_cate_id=null);
						
						$data['select_class_name'] = $VariantsModel->select_class_name($table_product_variants_save,$table_cate_class,$class_cate_id=null);
				}
			
				$this->load->count_variants = $CustomizableModel->count_option_customizable_variants($table_option_customizable_variants);

				$data['product_details'] = $ProductModel->updateProductById($tableProduct,$id);
				$data['get_cate_group_details'] = $VariantsModel->get_cate_group_details($table_cate_classes_group_details);
				$data['get_variants'] = $VariantsModel->get_variants($tableVariantsAttributes);
				$data['get_cate_classes'] = $VariantsModel->get_cate_classes($table_cate_class);
				$this->load->view('admin/add_variants_products',$data);
				$this->load->view('admin/footer');
		}
		public function insert_image_linked_variants(){
				$id_linked = $_POST['linked_variants_id'];
				$help = $this->load->helper('Helper');
				$CustomizableModel = $this->load->model('CustomizableModel');
				$table_linked_variants = "tbl_linked_variants";
				date_default_timezone_set('asia/ho_chi_minh');
	            $date = date("d/m/Y");
	            $hour = date("h:i:sa");
	            $date_created = $date.' '.$hour;
				$file_name = $_FILES['image']['name'];
				$file_tmp = $_FILES['image']['tmp_name'];
				$file_size = $_FILES['image']['size'];

				$div = explode('.', $file_name);
				$current = strtolower(current($div));
				$file_ext = strtolower(end($div));
				$rand_name = rand(0,99); 
				$time_name = date("s");
				$cond = "$table_linked_variants.linked_variants_id='$id_linked'";
				$data['select_linked_variants'] = $CustomizableModel->select_linked_variants($table_linked_variants,$cond);
				if (!file_exists('teamplate/image/variants')) {
					mkdir('teamplate/image/variants', 0777, true);
				}
				$unique_image = $help->makeUrl($current).'-'.$time_name.$rand_name.'.'.$file_ext;
				$upload_image = "teamplate/image/variants/".$unique_image;
			if(isset($_POST['action'])=='insert'){
				if(!empty($file_name)){
					move_uploaded_file($file_tmp, $upload_image);
					foreach($data['select_linked_variants'] as $key => $value){
						$path = "teamplate/image/variants/";
						$image = $value['customizable_image'];
						if($image){
							unlink($path.$image);
						}
					}
					$data = array(
						'customizable_image' => $unique_image
					);
				}else{
					$data = array(
						'customizable_image' => ''
					);
				}
				$result = $CustomizableModel->update_linked_variants_image($table_linked_variants,$data,$cond);

			}else if($_POST['action']=='update'){
				

				if(!empty($file_name)){
					move_uploaded_file($file_tmp, $upload_image);

					$data['select_linked_variants'] = $CustomizableModel->select_linked_variants($table_linked_variants,$cond);

					foreach($data['select_linked_variants'] as $key => $value){
						$path = "teamplate/image/variants/";
						$image = $value['customizable_image'];
						if($image){
							unlink($path.$image);
						}
					}
					
				}
				$data = array(
						'customizable_image' => $unique_image
				);
					
				$result = $CustomizableModel->update_linked_variants_image_by_id($table_linked_variants,$data,$cond);	
				
				
			}
		}
		public function update_price_linked(){
			if(isset($_POST['customizable_option_id'])){
				$customizable_id = $_POST['customizable_option_id'];
				$value_price = $_POST['price_linked_variants'];
				$table_linked_variants = "tbl_linked_variants";
				$cond = "$table_linked_variants.linked_variants_id='$customizable_id'";
				$CustomizableModel = $this->load->model('CustomizableModel');
				$data = array(
					'price_change' => $value_price
				);
				$result = $CustomizableModel->update_price_linked($table_linked_variants,$data,$cond);
			}
		}
		public function fetch_data_linked_variants(){
			if(isset($_POST['product_id_option'])){
				$product_id_option = $_POST['product_id_option'];
				$CustomizableModel = $this->load->model('CustomizableModel');
				$help = $this->load->helper('Helper');
				$table_option_customizable = "tbl_option_customizable";
				$table_product = "tbl_product";
				$table_linked_variants = "tbl_linked_variants";
				$output = '<table class="table table-bordered table-striped">  
				    <tr>
				     <th width="10%">ID</th>
				     <th width="20%">Tên tùy biến 1</th>
				     <th width="20%">Tên tùy biến 2(nếu có)</th>
				     <th width="20%">Giá ban đầu</th>
				     <th width="20%">Giá tăng | giảm</th>
				     <th width="10%">Hình ảnh</th>
				     <th colspan="2" width="10%">Quản lý</th>
				    </tr>';
				
				$cond = "$table_option_customizable.option_customizable_id=$table_linked_variants.option_customizable_id_0 AND $table_linked_variants.product_id=$table_product.productId AND $table_linked_variants.product_id='$product_id_option'";
				
				$data['fetch_data_linked_variants_1'] = $CustomizableModel->fetch_data_linked_variants_1($table_option_customizable,$table_linked_variants,$table_product,$cond);

				$i = 0;
				$price = 0;
				$price_change_after = 0;
				foreach($data['fetch_data_linked_variants_1'] as $key => $value){
					if($value['price_promo']!='' && $value['price_promo']!=0){
						$price = $value['price_promo'];
						$price_change_after = $price + $value['price_change'];
					}else{
						$price = $value['price'];
						$price_change_after = $price + $value['price_change'];
					}
				if($value['option_customizable_id_0']>0 && $value['option_customizable_id_1']==0){

					$i++;
					$output .= ' <tr>
				     <td>'.$i.'</td>
				   
				    <td>'.$value['option_customizable_name'].'</td>
					
				    <td><span class="text text-info">Không có tùy chọn 2</span></td>	
					<td>'.$help->format_currency($value['price']).' '."VNĐ".'.<br><span class="text text-danger">Giá khuyến mãi: '.$help->format_currency($value['price_promo']).' '."VNĐ".'</span></td>
					<td contentediteable><input data-customizable_option_id="'.$value['linked_variants_id'].'" type="text"  placeholder="điền giá mới(nếu có)..." class="form-control price_linked_variants">
						<input type="text"  disabled class="form-control format_money'.$value['linked_variants_id'].'">
						<span class="text text-success">Giá tùy chọn này: '.$help->format_currency($value['price_change']).' '."VNĐ".'</span><br>
						<span class="text text-success">Giá thay đổi: '.$help->format_currency($price_change_after).' '."VNĐ".'</span>
						<br/>
					</td>
				   	<td>
					'.(($value['customizable_image'])?'<img src="'.BASE_URL.'/teamplate/image/variants/'.$value['customizable_image'].'" class="img" width="100px">':'<button type="button" name="add_image_variants" data-id_image="'.$value['linked_variants_id'].'" class="btn btn-success btn-xs add_image_variants">Thêm hình ảnh</button>').'
				   	</td>
				     <td>'.(($value['customizable_image'])?'<button type="button" name="update" class="btn btn-warning btn-xs update_image_variants" data-id_update="'.$value['linked_variants_id'].'">Đổi ảnh</button>':'').'</td>
				     <td><button type="button" name="delete" class="btn btn-danger btn-xs delete_fetch_variants" data-id_del="'.$value['linked_variants_id'].'">Xóa</button></td>
				    </tr>';
					}elseif($value['option_customizable_id_0']>0 && $value['option_customizable_id_1']>0){

						$option_1 = $value['option_customizable_id_1'];
						$cond1 = "$table_option_customizable.option_customizable_id=$table_linked_variants.option_customizable_id_1 AND $table_linked_variants.product_id='$product_id_option' AND $table_linked_variants.option_customizable_id_1='$option_1'";

						$data['fetch_data_linked_variants_2'] = $CustomizableModel->fetch_data_linked_variants_2($table_option_customizable);

						foreach($data['fetch_data_linked_variants_2'] as $key => $value1){
							if($value1['option_customizable_id']==$option_1){

						$i++;

						$output .= ' <tr>
					     <td>'.$i.'</td>
					    <td>'.$value['option_customizable_name'].'</td>	
					   	<td>'.$value1['option_customizable_name'].'</td>
					   		<td>'.$help->format_currency($value['price']).' '."VNĐ".'.<br><span class="text text-danger">Giá khuyến mãi: '.$help->format_currency($value['price_promo']).' '."VNĐ".'</span></td>

					   	<td contentediteable><input type="text" placeholder="điền giá mới(nếu có)..." class="form-control price_linked_variants" data-customizable_option_id="'.$value['linked_variants_id'].'">
					   		<input type="text" disabled class="form-control format_money'.$value['linked_variants_id'].'">
		
					   		<span class="text text-success">Giá tùy chọn này: '.$help->format_currency($value['price_change']).' '."VNĐ".'</span><br>
							<span class="text text-success">Giá thay đổi: '.$help->format_currency($price_change_after).' '."VNĐ".'</span>
					   		<br/>
							
					   	</td>
					   	<td>
						'.(($value['customizable_image'])?'<img src="'.BASE_URL.'/teamplate/image/variants/'.$value['customizable_image'].'" class="img" width="100px">':'<button type="button" name="add_image_variants" data-id_image="'.$value['linked_variants_id'].'" class="btn btn-success btn-xs add_image_variants">Thêm hình ảnh</button>').'
					   	</td>
					     <td>'.(($value['customizable_image'])?'<button type="button" name="update" class="btn btn-warning btn-xs update_image_variants" data-id_update="'.$value['linked_variants_id'].'">Đổi ảnh</button>':'').'</td>
					     <td><button type="button" name="delete" class="btn btn-danger btn-xs delete_fetch_variants" data-id_del="'.$value['linked_variants_id'].'">Xóa</button></td>
					    </tr>';
						}

						}

					}
	
				}
				$output .= '</table>';
				echo $output;
			

			}
		}
		public function del_fetch_data_linked_variants(){
			if(isset($_POST['id_del'])){
				$id_del = $_POST['id_del'];
				$table_linked_variants = "tbl_linked_variants";
				$CustomizableModel = $this->load->model('CustomizableModel');
				$cond = "$table_linked_variants.linked_variants_id = '$id_del'";

				$data['select_linked_variants'] = $CustomizableModel->select_linked_variants($table_linked_variants,$cond);
				
				foreach ($data['select_linked_variants'] as $key => $value) {
					$path = "teamplate/image/variants/";
					$image = $value['customizable_image'];
					if($image){
						unlink($path.$image);
					}
				}
				$result = $CustomizableModel->del_fetch_data_linked_variants($table_linked_variants,$cond);

			}
		}
		public function fetch_data_variants(){
			if(isset($_POST['productid'])){
				$output = '';
				$id_product = $_POST['productid'];
				$table_product_variant = "tbl_product_variants";
				$table_cate_class = "tbl_cate_classes";
				$table_cate_classes_group = "tbl_cate_classes_group";
				$table_cate_classes_group_details = "tbl_cate_classes_group_details";
				$tableVariantsAttributes = "tbl_variants_attribute";
				$VariantsModel = $this->load->model('VariantsModel');
				
				$data['count_value_class_variants'] = $VariantsModel->count_value_class_variants($table_product_variant,$id_product);
				$this->load->count_value = $data['count_value_class_variants'];

				if($this->load->count_value>0){
					$data['select_product_variants_by_id'] = $VariantsModel->select_product_variants_by_id($table_product_variant,$id_product);
					foreach($data['select_product_variants_by_id'] as $key => $get_product_variants){
						$class_cate_id = $get_product_variants['class_cate_id'];
					}
				}else{
							$class_cate_id = NULL;
				}
				
				$data['get_cate_classes_group_id'] = $VariantsModel->get_cate_classes_group_id($table_product_variant,$table_cate_classes_group,$id_product,$class_cate_id);

					foreach($data['get_cate_classes_group_id'] as $key => $get_cate_classes_group){
						$output .= '<span style="color:blue">---'.$get_cate_classes_group['group_name'].'</span><input type="button" class="btn btn-xs btn-danger delete_get_cate_classes_group" style="margin-left:5px" data-group_id='.$get_cate_classes_group['cate_classes_group_id'].' value="xóa"><br><br>';
							
							$group_id = $get_cate_classes_group['cate_classes_group_id'];
							$data['get_cate_classes_group_detail'] = $VariantsModel->get_cate_classes_group_detail($table_product_variant,$table_cate_classes_group_details,$id_product,$class_cate_id,$group_id);


							foreach($data['get_cate_classes_group_detail'] as $key => $get_cate_classes_group_detail){
								$output .= '<span style="color:purple;margin-left:20px">---|---'.$get_cate_classes_group_detail['group_details_name'].'</span><input type="button" class="btn btn-xs btn-info delete_get_cate_classes_group_detail" data-group_detail='.$get_cate_classes_group_detail['cate_classes_group_details_id'].' style="margin-left:5px" value="xóa" ><br><br>';

								$detail_id = $get_cate_classes_group_detail['cate_classes_group_details_id'];
								$data['get_variants_attribute_id'] = $VariantsModel->get_variants_attribute_id($table_product_variant,$tableVariantsAttributes,$id_product,$class_cate_id,$group_id,$detail_id);


								foreach($data['get_variants_attribute_id'] as $key => $variant){
									$output .= '<span style="color:red;margin-left:50px">---|---|---'.$variant['variants_name'].'</span><input type="button" data-variants_id='.$variant['variants_attribute_id'].' class="btn btn-xs btn-warning delete_variant" style="margin-left:5px" value="xóa" ><br><br>';
								}
							}



					}

				echo $output;
			}

		}
		public function update_product_variants(){

			if(isset($_POST['productid'])){
				$table_product_variants_save = "tbl_product_variants_save";
				$table_product_variant = "tbl_product_variants";
				$VariantsModel = $this->load->model('VariantsModel');
				$id = $_POST['productid'];
				$variants_id = $_POST['variants_id'];
				$data = array(
					'class_cate_id' => $variants_id
				);
				$cond = "$table_product_variants_save.product_id='$id'";
				$result = $VariantsModel->update_variants_product($table_product_variants_save,$data,$cond);

				$data['select_product_variants_by_id'] = $VariantsModel->select_product_variants_by_id($table_product_variant,$id);
				foreach($data['select_product_variants_by_id'] as $key => $value){
					if(isset($value['product_id'])){
						$cond_del = "$table_product_variant.product_id ='$id'";
						$result = $VariantsModel->del_variants_product($table_product_variant,$cond_del);
					}
				}
				


			}

		}
		public function select_variants_product(){
			if(isset($_POST['group_detail_id'])){
				$tableVariantsAttributes = "tbl_variants_attribute";
				$VariantsModel = $this->load->model('VariantsModel');
				$id = $_POST['group_detail_id'];
				$output = '';
				$output = '<option>----Chọn chi tiết tính năng----</option>';
			
				$data['get_variants'] = $VariantsModel->get_variants_product($tableVariantsAttributes,$id);

				foreach($data['get_variants'] as $key => $value){
					$output .= '<option value="'.$value['variants_attribute_id'].'">'.$value['variants_name'].'</option>';
				}
				echo $output;
			}
		}
		public function select_group_classes(){
			
			if(isset($_POST['class_cate_id'])){
				$table_cate_classes_group_details = "tbl_cate_classes_group_details";
				$VariantsModel = $this->load->model('VariantsModel');
				$id = $_POST['class_cate_id'];
				$output = '';
				$output = '<option>----Chọn chi tiết tính năng----</option>';
			
				$data['get_cate_group_details'] = $VariantsModel->get_cate_group_details_product($table_cate_classes_group_details,$id);

				foreach($data['get_cate_group_details'] as $key => $value){
					$output .= '<option value="'.$value['cate_classes_group_details_id'].'">'.$value['group_details_name'].'</option>';
				}
				echo $output;
			}
		}
		public function select_variants(){
				$output = '';

				$tableProduct = 'tbl_product';
				$tableVariantsAttributes = "tbl_variants_attribute";
				$table_cate_class = "tbl_cate_classes";
				$table_cate_classes_group = "tbl_cate_classes_group";
				$table_cate_classes_group_details = "tbl_cate_classes_group_details";
				$ProductModel = $this->load->model('ProductModel');
				$VariantsModel = $this->load->model('VariantsModel');


				
				if(isset($_POST['id_attribute'])){

					$id_attribute = $_POST['id_attribute'];

					$data['get_cate_classes'] = $VariantsModel->get_cate_classes_by_id($table_cate_class,$id_attribute);
					

					foreach($data['get_cate_classes'] as $key => $value_group_cate){

					$output .= '
						Chọn tính năng : '.$value_group_cate['class_group_name'].'<br><br>
						<input type="hidden" id="class_cate_id" name="class_cate_id[]" value="'.$value_group_cate['class_cate_id'].'">
						<input type="hidden" id="productid" name="productid[]" value="'.$_POST['productid'].'">
					';
					
				}

				}elseif($id_attribute=='0'){
					$output.= '<p>Mời chọn thuộc tính</p>';
				}
					echo $output;

		}
		public function makeProduct(){
				Session::checkSession();
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$tableCat = 'tbl_cat';
				$tableBrand = 'tbl_brand';
				$CateModel = $this->load->model('CatModel');
				$BrandModel = $this->load->model('BrandModel');

				$data['brand'] = $BrandModel->listBrand($tableBrand);
				$data['catlist'] = $CateModel->listCategory($tableCat);
				$this->load->view('admin/addproduct',$data);

				$this->load->view('admin/footer');
		}
		
		public function delPro($id = NULL){
				Session::checkSession();

				$tablePro = 'tbl_product';
				$tableGal = 'tbl_gallery';
				$cond = "productId='$id'";
				$ProductModel = $this->load->model('ProductModel');
				
				$data['productbyid'] = $ProductModel->updateProductById($tablePro, $id);
				
				foreach($data['productbyid'] as $key => $value){
							$path_unlink = "teamplate/image/product/";
							$image_pro = $value['image'];
								
							$image_del = unlink($path_unlink.$image_pro);	
							
				}
				$result = $ProductModel->delProductById($tablePro, $cond);
				if($result){
							
							$mdata['msg'] = "Đã xóa sản phẩm thành công";
							

						}else{
							$mdata['msg'] = "Đã xóa sản phẩm thất bại";
						}
				$url = BASE_URL."/Product/ListProduct?msg=".urlencode(serialize($mdata));
						header("Location:$url");

		}
		public function AddProduct(){
			Session::checkSession();
			if(!$_POST){
				header("Location:".BASE_URL."/Product");
			}else{
				$mdata = array();
				$tablePro = 'tbl_product';
				$ProModel = $this->load->model('ProductModel');
				$help = $this->load->helper('Helper');
				$productName =$_POST['productname'];
				
				$price = $_POST['price'];
				
				$quantity = $_POST['quantity'];
				$cat = $_POST['cate'];;
				$brand = $_POST['brand'];
				$desc = $_POST['desc'];
				$tags = $_POST['tags'];
				$tinhtrangsp = $_POST['tinhtrangsp'];
				$meta_keywords = $_POST['meta_keywords'];
				$meta_desc = $_POST['meta_desc'];
				$sum = $_POST['summary'];
				$status = $_POST['status_product'];
				$type = $_POST['hot'];
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

				if (!file_exists('teamplate/image/product')) {
					mkdir('teamplate/image/product', 0777, true);
				}
				$unique_image = $help->makeUrl($current).'-'.$time_name.$rand_name.'.'.$file_ext;
				$upload_image = "teamplate/image/product/".$unique_image;
				$data = array (

						'productName' => $productName,
						'price' => $price,
						'color_product' => '0',
						'meta_desc' => $meta_desc,
						'meta_keywords' => $meta_keywords,
						'tinhtrangsp' => $tinhtrangsp,
						'tags' => $tags,
						'quantity' => $quantity,
						'date_created' => $date_created,
						'catId' => $cat,
						'brandId' => $brand,
						'image' => $unique_image,
						'status' => $status,
						'type' => $type,
						'body' => $desc,
						'sum_text' => $sum
						
						
					);
					$result = $ProModel->AddProduct($tablePro,$data);
					if($result == 1){
							move_uploaded_file($file_tmp,$upload_image);
							$mdata['msg'] = "Sản phẩm đã thêm vào thành công...";
							

					}else{
							$mdata['msg'] = "Sản phẩm đã thêm vào thất bại...";
					}

					$url = BASE_URL."/Product/ListProduct?msg=".urlencode(serialize($mdata));
						header("Location:$url");

			
			}

		}
		public function updateProduct($id = NULL){
			Session::checkSession();
			if(!$_POST){
				header("Location:".BASE_URL."/Product/ListProduct");
			}else{
				$mdata = array();
				$help = $this->load->helper('Helper');
				$ProModel = $this->load->model('ProductModel');
				$cond = "productId=$id";
				$tablePro = 'tbl_product';
				$productName = $_POST['productname'];
				$brand = $_POST['brand'];
				$price = $_POST['price'];
				$tinhtrangsp = $_POST['tinhtrangsp'];
				$sum = $_POST['sum'];
				$quantity = $_POST['quantity'];
				$cat = $_POST['cate'];
				$desc = $_POST['desc'];
				$tags = $_POST['tags'];
				$type = $_POST['hot'];
				$meta_desc = $_POST['meta_desc'];
				$meta_keywords = $_POST['meta_keywords'];
				$status = $_POST['status_product'];
				date_default_timezone_set('asia/ho_chi_minh');
	            $date = date("d/m/Y");
	            $hour = date("h:i:sa");
	            // $date_updated = $date.' '.$hour;
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

				if (!file_exists('teamplate/image/product')) {
					mkdir('teamplate/image/product', 0777, true);
				}
				$upload_image = "teamplate/image/product/".$unique_image;
				
				
				if(!empty($file_name)){
						
							$data['productbyid'] = $ProModel->updateProductById($tablePro, $id);
							foreach($data['productbyid'] as $key => $value){
									$path_unlink = "teamplate/image/product/";
									$image_pro = $value['image'];
									$result = unlink($path_unlink.$image_pro);
							}
							
							$data = array (
								'productName' => $productName,
								'price' => $price,
								'meta_desc' => $meta_desc,
								'meta_keywords' => $meta_keywords,
								'tinhtrangsp' => $tinhtrangsp,
								'tags' => $tags,
								'quantity' => $quantity,
								
								'catId' => $cat,
								'brandId' => $brand,
								'image' => $unique_image,
								'status' => $status,
								'type' => $type,
								'body' => $desc,
								'sum_text' => $sum
								

							);
						
							
				}else{
						$data = array (
								'productName' => $productName,
								'price' => $price,
								'meta_desc' => $meta_desc,
								'meta_keywords' => $meta_keywords,
								'tinhtrangsp' => $tinhtrangsp,
								'tags' => $tags,
								'quantity' => $quantity,
								
								'catId' => $cat,
								'brandId' => $brand,
								
								'status' => $status,
								'type' => $type,
								'body' => $desc,
								'sum_text' => $sum
										

									);
							
						


				}
					$result = $ProModel->UpdateProduct($tablePro,$data,$cond);
							if($result == 1){
									move_uploaded_file($file_tmp,$upload_image);
									$mdata['msg'] = "Cập nhật sản phẩm thành công...";
									

								}else{
									$mdata['msg'] = "Cập nhật sản phẩm thất bại...";
							}
				$url = BASE_URL."/Product/ListProduct?msg=".urlencode(serialize($mdata));
						header("Location:$url");
		

		}
	}
		public function editPro($id = NULL){
			Session::checkSession();
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$tablePro = 'tbl_product';
			$tableCat = 'tbl_cat';
			$tableBrand = 'tbl_brand';
			$cond = 'parent_id!=0';

			$BrandModel = $this->load->model('BrandModel');
			$CateModel = $this->load->model('CatModel');
			$data['catsublist'] = $CateModel-> listSubCategory($tableCat,$cond);
			$data['catlist'] = $CateModel->listCategory($tableCat);

			$ProductModel = $this->load->model('ProductModel');
			$data['productbyid'] = $ProductModel->updateProductById($tablePro, $id);
			$data['brand'] = $BrandModel->listBrand($tableBrand);
			$this->load->view('admin/editproduct',$data);
			$this->load->view('admin/footer');
		}
		public function ListProduct(){
				Session::checkSession();
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');

				$tablePro = 'tbl_product';
				$tableProductColor = 'tbl_product_color';
				$tableCat = 'tbl_cat';
				$tableGallery = 'tbl_gallery';
				$tableAttr = 'tbl_attribute';
				$tableBrand ='tbl_brand';
				$ProductModel = $this->load->model('ProductModel');
				$CatModel = $this->load->model('CatModel');
				$cond = 'parent_id=0';
				$data['attribute'] = $ProductModel->AttributeById($tableAttr);
				
				$data['listgallery'] = $ProductModel->listGallery($tableGallery,$tablePro);
				$data['listproduct'] = $ProductModel->listProduct($tablePro, $tableCat, $tableBrand);
				$data['product_color'] = $ProductModel->ProductColor($tableProductColor);
				$this->load->view('admin/listproduct',$data);

				$this->load->view('admin/footer');
		}

		public function AddGallery($id = NULL){
				Session::checkSession();
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');

				$tablePro = 'tbl_product';
				$tableGal = 'tbl_gallery';
				$ProductModel = $this->load->model('ProductModel');

				$data['productidgallery'] = $ProductModel->updateProductById($tablePro, $id);	
				$data['listgallery'] = $ProductModel->listGal($tableGal, $id);
				$this->load->view('admin/addgallery',$data);

				$this->load->view('admin/footer');
		}
		public function change_active_gallery(){
			if($_POST["action"]=='change_gallery'){
				$gallery_id = $_POST['gallery_id'];
				$tableGallery = 'tbl_gallery';
				$ProductModel = $this->load->model('ProductModel');
				$gallery_status = '';
				if($_POST['gallery_status']==1){
					$active = 0;
					$data = array(
						'image_active' => $active
					);
					$cond_gallery = "$tableGallery.galleryId='$gallery_id'";
					$result = $ProductModel->change_active_gallery($tableGallery,$data,$cond_gallery);
					if(isset($result)){
						echo '<div class="alert alert-success">Hình ảnh đã chuyển sang chế độ Không kích hoạt</div>';
					}
				}else{
					$active = 1;
					$data = array(
						'image_active' => $active
					);
					$cond_gallery = "$tableGallery.galleryId='$gallery_id'";
					$result = $ProductModel->change_active_gallery($tableGallery,$data,$cond_gallery);
					if(isset($result)){
						echo '<div class="alert alert-success">Hình ảnh đã chuyển sang chế độ Không kích hoạt</div>';
					}
				}	

			}
		}
		public function delImageGal(){
				Session::checkSession();
				if(isset($_POST["image_id"]))
				{
				$ProductModel = $this->load->model('ProductModel');
				$id = $_POST['image_id'];
				$tableGal = 'tbl_gallery';
				
				$cond = "$tableGal.galleryId = '$id'";

				$data['get_image_name'] = $ProductModel->select_image_name_by_id($tableGal,$cond);
				foreach($data['get_image_name'] as $key => $value){
					$image = $value['image'];
					$file_path = 'teamplate/image/gallery/'.$image;
					if($image){
						unlink($file_path);
					}

				}
				
				
				$result = $ProductModel->delGalleryById($tableGal, $cond);
				
			}
		}
		public function updateImageGal(){

					$tableGallery = 'tbl_gallery';
					$ProductModel = $this->load->model('ProductModel');
			if(isset($_POST["image_id"]))
				{
					$id = $_POST["image_id"];
					$cond = "$tableGallery.galleryId='$id'";
					$data['get_image_name'] = $ProductModel->select_image_name_by_id($tableGallery,$cond);
					foreach($data['get_image_name'] as $key => $value){
						$old_name = $value['image_name'];
						$file_array = explode(".", $old_name);
						$file_extension = end($file_array);
					}
					$new_name = $_POST["image_name"] . '.' . $file_extension;
					
					if($old_name != $new_name){
						$old_path = 'teamplate/image/' . $old_name;
  						$new_path = 'teamplate/image/' . $new_name;
  						if(rename($old_path, $new_path)){
  							$data = array(
  								'image_name' => $new_name,
  								'image_desc' => $_POST['image_description']
  							);
  						}

					}else{
						$data = array(
  								
  								'image_desc' => $_POST['image_description']
  						);
					}
					
					$result = $ProductModel->update_gallery($tableGallery,$data,$cond);

				}
		}
		public function editImageGal($id){
			$tableGal = 'tbl_gallery';
			$ProductModel = $this->load->model('ProductModel');
			$data['gallery_by_gallery_id'] = $ProductModel->gallerybyId($tableGal, $id);
			foreach($data['gallery_by_gallery_id'] as $row)
			{
			 $file_array = explode(".", $row["image_name"]);
			 $output['image_name'] = $file_array[0];
			 $output['image_description'] = $row["image_desc"];
			}

			echo json_encode($output);

		}
		public function fetch_gallery($id){
			$tableGal = 'tbl_gallery';
			$ProductModel = $this->load->model('ProductModel');
			$data['gallery_by_product_id'] = $ProductModel->gallery_by_product_id($tableGal, $id);
			$output = '';
			$output .= '
			 <table class="table table-bordered table-striped">
			  <tr>
			   <th>Thứ tự</th>
			   <th>Hình ảnh</th>
			   <th>Tên ảnh</th>
			 
			   <th>Xóa</th>
			  </tr>
			';
			if($data['gallery_by_product_id']!=''){
				 $count = 0;
				 foreach($data['gallery_by_product_id'] as $row)
				 {
				  $count ++; 
				  $output .= '
				  <tr id="gallery_sortable">
				   <td>'.$count.'</td>
				   <td><img src="'.BASE_URL.'/teamplate/image/gallery/'.$row["image_name"].'" class="img-thumbnail" width="100" height="100" /></td>
				   <td>'.$row["image_name"].'</td>
				 
				  
			
				  
				   <td><button type="button" class="btn btn-danger btn-xs delete_gallery" id="'.$row["galleryId"].'" data-image_name="'.$row["image"].'">Xóa</button></td>
				  </tr>
				  ';
				 }
			}else{
				 $output .= '
				  <tr>
				   <td colspan="6" align="center">Không có dữ liệu hình ảnh</td>
				  </tr>
				 ';
			}
			$output .= '</table>';
			echo $output;
		}
		public function InsertGallery($id){
			$tableGallery = 'tbl_gallery';
			$ProductModel = $this->load->model('ProductModel');
			$helper = $this->load->Helper('Helper');
			
					$rand_name = rand(0,99); 
					$time_name = date("s");
					
			
			if(count($_FILES["file"]["name"])>0){
				
				for($count=0; $count<count($_FILES["file"]["name"]); $count++)
				{

					$file_name = $_FILES["file"]["name"][$count];
					$tmp_name = $_FILES["file"]['tmp_name'][$count];
					$file_array = explode(".", $file_name);
					$current = strtolower(current($file_array));
					$file_extension = end($file_array);
					$unique_image = $helper->makeUrl($current).'-'.$time_name.$rand_name.'.'.$file_extension;

					if (!file_exists('teamplate/image/gallery')) {
						mkdir('teamplate/image/gallery', 0777, true);
					}
					
					$upload_image = "teamplate/image/gallery/".$unique_image;
					$data = array(
						'image_name' => $unique_image,
					  	'productId' => $id,
					  	'image' => $unique_image
					  	);
					move_uploaded_file($tmp_name, $upload_image);
					$result = $ProductModel->uploaded_multi_image($tableGallery,$data);
					 
				}
				

			}
		}
		
		public function Attribute($id){
			Session::checkSession();
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$tableCat = 'tbl_cat';
			$tablePro = 'tbl_product';
			$tableAttr = 'tbl_attribute';
			$tableCity = 'tbl_tinhthanhpho';
			$tableDist = 'devvn_quanhuyen';

			$cond = 'attr_id="$id"';
			$ProductModel = $this->load->model('ProductModel');
			$data['city'] = $ProductModel->SelectCity($tableCity);
			$data['district'] = $ProductModel->SelectDistrict($tableDist);
			$data['listproduct'] = $ProductModel->ProductDetails($tablePro, $tableCat , $id);
			$data['attribute'] = $ProductModel->AttributeById($tableAttr);
			$this->load->view('admin/addattribute',$data);


			$this->load->view('admin/footer');
		}
		public function delAttr($id){
			$idback = $_GET['id'];
			$tableAttr = 'tbl_attribute';
			$cond = "attr_id='$id'";
			$ProductModel = $this->load->model('ProductModel');
			$result = $ProductModel->delAttr($tableAttr, $cond);
			if($result){
						
							$mdata['msg'] = "Deleted Color Successfully...";
						}else{
							$mdata['msg'] = "Deleted Color Not Successfully...";
			}
			$url = BASE_URL."/Product/Attribute/".$idback;
						header("Location:$url");

		}
		public function InsertAttribute(){
			Session::checkSession();
			if(!$_POST){
				$url = BASE_URL."/Product/ListProduct";
				header("Location:$url");
			}else{

				$number = count($_POST['name']);
				$productId = $_POST['productId'];
				$tableAttr = 'tbl_attribute';
			    $ProductModel = $this->load->model('ProductModel');
				for($i=0; $i<$number; $i++)  
			      {  
			      		
			           if(trim($_POST["name"][$i] != ''))  
			           {  
			           	$data = array(
			           		'color' => $_POST["name"][$i],
			           		'productId' => $productId
			           	);
			          
						$result = $ProductModel->InsertAttr($tableAttr,$data);

			           }  
			      }  
			    

			}
		}
		public function InsertMoreAttribute($id){
			Session::checkSession();
			if(!$_POST){
				$url = BASE_URL."/Product/Attribute/$id";
				header("Location:$url");
			}else{

				$direction = $_POST['direction'];
				$area = $_POST['area'];
				$pricereal = $_POST['pricereal'];
				$city = $_POST['city'];
				$district = $_POST['district'];
				$productId = $id;
				$tableAttr = 'tbl_attribute';
			    $ProductModel = $this->load->model('ProductModel');
			    if($direction == '' || $area =='' || $pricereal =='' || $productId =='' || $city =='' || $district == ''){
			    	$mdata['msg'] = "Plz Do Not Empty Field...";
			    }else{

			    

			           	$data = array(
			           		'direction' => $direction,
			           		'area' => $area,
			           		'productId' => $productId,
			           		'city' => $city,
			           		'district' => $district,
			           		'price_realestate' => $pricereal
			           	);
			          
				$result = $ProductModel->InsertMoreAttr($tableAttr,$data);
				if($result==1){
					$mdata['msg'] = "Insert Attribute Successfully...";
				}else{
					$mdata['msg'] = "Insert Attribute Not Successfully...";
				}

					
				}
				$url = BASE_URL."/Product/Attribute/".$id."?msg=".urlencode(serialize($mdata));
						header("Location:$url");
			}
		}
		public function UpdateMoreAttribute($id){
			Session::checkSession();
			if(!$_POST){
				$url = BASE_URL."/Product/Attribute/$id";
				header("Location:$url");
			}else{

				$direction = $_POST['direction'];
				$area = $_POST['area'];
				$pricereal = $_POST['pricereal'];
				$cond = 'productId="$id"';
				$tableAttr = 'tbl_attribute';
			    $ProductModel = $this->load->model('ProductModel');
			    if($direction == '' || $area =='' || $pricereal ==''){
			    	$mdata['msg'] = "Plz Do Not Empty Field...";
			    }else{
			           	$data = array(
			           		'direction' => $direction,
			           		'area' => $area,
			           		'price_realestate' => $pricereal
			           	);
			          
				$result = $ProductModel->UpdateMoreAttr($tableAttr,$data,$cond);
				if($result==1){
					$mdata['msg'] = "Update Attribute Successfully...";
				}else{
					$mdata['msg'] = "Update Attribute Not Successfully...";
				}
				$url = BASE_URL."/Product/Attribute/".$id."?msg=".urlencode(serialize($mdata));
						header("Location:$url");
					
				}
				
			}

		}
		public function SelectCity(){
			$tableDist = 'devvn_quanhuyen';
			$cityId = $_POST['cityId'];
			
			$ProductModel = $this->load->model('ProductModel');
			$data['districtselect'] = $ProductModel->SelectDistrictById($tableDist,$cityId);
			$output = '<option value="">----Select State----</option>';
			foreach($data['districtselect'] as $key => $district){
				$output .= '<option value="'.$district['maqh'].'">'.$district['name'].'</option>';
			}
			echo $output;

		}
		public function Action(){
			Session::checkSession();
			if(!$_POST){
				$url = BASE_URL."/Product/ListProduct";
				header("Location:$url");
			}else{
				
				$value = $_POST['select_smart'];
				$idProduct = $_REQUEST["select_id"];
				if($value == 'del'){
					
					
					$cond = "productId";
					$a=implode(',',$idProduct);
					$tablePro = 'tbl_product';
					$productModel = $this->load->model('ProductModel');
					$result = $productModel->DelInAction($tablePro,$cond,$a);
					if($result){
						
							$mdata['msg'] = "Deleted Multiple Product Successfully...";
						}else{
							$mdata['msg'] = "Deleted Multiple Product Not Successfully...";
					}
					

				}elseif($value == 'empty' || $idProduct == ''){
					$mdata['msg'] = "Please choose something to do...";
				}elseif($value == 'feathered'){
	
					$cond = "productId";
					$a=implode(',',$idProduct);
					$cond = "productId";
					$data = array(
						'type' => '0'
					);
					$a = implode(',',$idProduct);
					$tablePro = 'tbl_product';
					$productModel = $this->load->model('ProductModel');
					$result = $productModel->UpdateInAction($tablePro,$data,$cond,$a);
					if($result){
						
							$mdata['msg'] = "Updated Multiple Product Successfully...";
						}else{
							$mdata['msg'] = "Updated Multiple Product Not Successfully...";
					}
					
				}elseif($value == 'unfeathered'){
	
					$cond = "productId";
					$a=implode(',',$idProduct);
					$cond = "productId";
					$data = array(
						'type' => '1'
					);
					$a = implode(',',$idProduct);
					$tablePro = 'tbl_product';
					$productModel = $this->load->model('ProductModel');
					$result = $productModel->UpdateInAction($tablePro,$data,$cond,$a);
					if($result){
						
							$mdata['msg'] = "Updated Multiple Product Successfully...";
						}else{
							$mdata['msg'] = "Updated Multiple Product Not Successfully...";
					}
				
				}elseif($value == 'inactive'){
	
					$cond = "productId";
					$a=implode(',',$idProduct);
					$cond = "productId";
					$data = array(
						'action' => '1'
					);
					$a = implode(',',$idProduct);
					$tablePro = 'tbl_product';
					$productModel = $this->load->model('ProductModel');
					$result = $productModel->UpdateInAction($tablePro,$data,$cond,$a);
					if($result){
						
							$mdata['msg'] = "InActived Multiple Product Successfully...";
						}else{
							$mdata['msg'] = "InActived Multiple Product Not Successfully...";
					}
				
				}elseif($value == 'active'){
	
					$cond = "productId";
					$a=implode(',',$idProduct);
					$cond = "productId";
					$data = array(
						'action' => '0'
					);
					$a = implode(',',$idProduct);
					$tablePro = 'tbl_product';
					$productModel = $this->load->model('ProductModel');
					$result = $productModel->UpdateInAction($tablePro,$data,$cond,$a);
					if($result){
						
							$mdata['msg'] = "Actived Multiple Product Successfully...";
						}else{
							$mdata['msg'] = "Actived Multiple Product Not Successfully...";
					}
				
				}
				$url = BASE_URL."/Product/ListProduct?msg=".urlencode(serialize($mdata));
						header("Location:$url");
			
			
		}

	}
}
	?>