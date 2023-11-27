<?php

	class PrivateAdmin extends DController
	{
		
		function __construct()
		{
			parent::__construct();
			
			$data = array();
		}
		public function Index(){
			
			$this->home();

		}
		public function update_social_icon(){
			if($_POST['social_id']){
				$output = array();
				$tableSocials = 'tbl_social';
				$id = $_POST['social_id'];
				$VisitorModel = $this->load->model('VisitorModel');
				$cond = "$tableSocials.socials_id='$id'";
				$data['social_by_id'] = $VisitorModel->select_social_by_id($tableSocials,$cond);
				foreach($data['social_by_id'] as $key => $value_social){
					$output['social_link'] = $value_social['socials_link'];
					$output['social_title'] = $value_social['socials_title'];
					if($value_social['socials_image']!=''){
						$output["social_image"] = '<img src="'.BASE_URL.'/teamplate/image/'.$value_social['socials_image'].'" class="img img-thumbnail" width="80" height="80"><input type="hidden" name="hidden_social_image" value="'.$value_social['socials_image'].'">';
					}else{
						$output["social_image"] = '<input type="hidden" name="hidden_social_image" value="">';
					}
				}
				echo json_encode($output);
			}
		}
		public function delete_social_icon(){
			if(isset($_POST["social_id"]))
				{
				$tableSocials = 'tbl_social';
				$VisitorModel = $this->load->model('VisitorModel');
				$social_id = $_POST["social_id"];
				$cond_del_socials = "$tableSocials.socials_id='$social_id'";
				 $data['social_by_id'] = $VisitorModel->social_by_id($tableSocials,$cond_del_socials);
				foreach($data['social_by_id'] as $key => $value_social){
					$image = $value_social['socials_image'];
				 	unlink("teamplate/image/" . $image);
				}
				 $result = $VisitorModel->delete_social($tableSocials,$cond_del_socials);
				 if(!empty($result))
				 {
				  echo 'Đã xóa';
				 }
				}
		}
		public function insert_social_icon(){
			if($_POST['operation']=='Add'){
				$image = '';
				if($_FILES["social_image"]["name"] != ''){
					$helper = $this->load->Helper('Helper');
					$image = $helper->upload_image();
				}
				$tableSocials = 'tbl_social';
				$VisitorModel = $this->load->model('VisitorModel');
				$data = array(
					'socials_link' => $_POST['social_link'],
					'socials_title' => $_POST['social_title'],
					'socials_image' => $image
				);
				$result = $VisitorModel->insert_social($tableSocials,$data);
			}
			if($_POST['operation']=='Edit'){
				$image = '';
				if($_FILES["social_image"]["name"] != ''){
					$helper = $this->load->Helper('Helper');
					$image = $helper->upload_image();
				}else{
					$image = $_POST['hidden_social_image'];
				}
				$tableSocials = 'tbl_social';
				$VisitorModel = $this->load->model('VisitorModel');
				$social_id = $_POST["social_id"];
				$cond_update_socials = "$tableSocials.socials_id='$social_id'";
				$data = array(
					'socials_link' => $_POST['social_link'],
					'socials_title' => $_POST['social_title'],
					'socials_image' => $image
				);
				$result = $VisitorModel->update_social($tableSocials,$data,$cond_update_socials);
			}
		}
		public function home(){
			Session::checkSession();
			$this->load->view("admin/header");
			$this->load->view("admin/sidebar");

			$tableCus = "tbl_customers";
			$tablePro = "tbl_product";
			$tableCart = "tbl_cart";						
			$tablePost = "tbl_post";
			$tableCustomer = "tbl_customers";
			$tableVisitor = "tbl_visitor";
			$ProductModel = $this->load->model('ProductModel');
			$PostModel = $this->load->model('PostModel');
			$OrderModel = $this->load->model('OrderModel');
			$CartModel = $this->load->model('CartModel');
			$CustomerModel = $this->load->model('CustomerModel');
			//Count Visitor
			$ip = $_SERVER['REMOTE_ADDR'];
			$result = $CustomerModel->SelectVisitorByIp($tableVisitor,$ip);
			$this->load->useronline = $CustomerModel->SelectVisitorByIp($tableVisitor,$ip);
			if($result == 0){
				$data = array(
					'ip' => $ip
				);
				$result = $CustomerModel->InsertVisitor($tableVisitor,$data);

			}
			//End Count Visitor
			$data['listOrder'] = $OrderModel->listOrder($tablePro,$tableCart);
			$this->load->count_all_order = $OrderModel->CountAllOrder($tableCart);
			$this->load->count_all_order_pending = $OrderModel->CountAllOrder_Pending($tableCart);
			$this->load->count_all_order_notpay = $OrderModel->CountAllOrder_NotPay($tableCart);
			$this->load->count_all_order_notdeliver = $OrderModel->CountAllOrder_NotDeliver($tableCart);
			//end count order
			$this->load->countTotalVisitor = $CustomerModel->CountVisitor($tableVisitor);
			$this->load->countcustomers = $CustomerModel->countCustomers($tableCustomer);			
			$this->load->countpost = $CustomerModel->countpost($tablePost);
			$this->load->countpostactive = $PostModel->countpostActive($tablePost);
			$this->load->countpostinactive = $PostModel->countpostInActive($tablePost);
			$this->load->countpostfeathered = $PostModel->countpostFeathered($tablePost);

			$this->load->countcart = $CartModel->countCart($tableCart);
			$this->load->countordernew = $CartModel->countOrderNew($tableCart);
			$this->load->countpayed = $CartModel->countPayed($tableCart);
			$this->load->countpaynotyet = $CartModel->countPayNotYet($tableCart);
			
			$this->load->countproduct = $ProductModel->countProduct($tablePro);
			$this->load->countproductactive = $ProductModel->countProductActive($tablePro);
			$this->load->countproductinactive = $ProductModel->countProductInActive($tablePro);
			$this->load->countproductfeathered = $ProductModel->countProductfeathered($tablePro);
			
			$this->load->view("admin/home",$data);
			$this->load->view("admin/footer");
			
			
		}
	}



?>