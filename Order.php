<?php

	class Order extends DController
	{
		
		function __construct()
		{
			parent::__construct();
			$data = array();
		}
		public function add_more_product(){
			if(isset($_POST['product_price'])){
			$OrderModel = $this->load->model('OrderModel');
			$tableCart = 'tbl_cart';
			$order_id = $_POST['order_id'];
			date_default_timezone_set('asia/ho_chi_minh');
            $date = date("d/m/Y");
            $hour = date("h:i:sa");
            $datecreated = $date.' '.$hour;
			$cond = "$tableCart.order_id = '$order_id'";
			$data = array(
				'datecreated' => $datecreated,
				'register_id' => $_POST['register_id'],
				'productId' => $_POST['product_id'],
				'product_status' => $_POST['product_status'],
				'price' => $_POST['product_price'],
				'quantity'=> $_POST['product_quantity'],
				'order_id' => $_POST['order_id']

			);
			$result = $OrderModel->add_more_product_order($tableCart,$data,$cond);

			}
		}
		public function autofill_input(){
			if(isset($_POST['product_search'])){
				$output = '';
				$OrderModel = $this->load->model('OrderModel');
				$tablePro = 'tbl_product';
				$cond = "$tablePro.productName LIKE '%".$_POST['product_search']."%'";
				$data['select_product'] = $OrderModel->select_product_to_add($tablePro,$cond);
				foreach($data['select_product'] as $key => $value){
					$data['pricepromo'] = $value['price_promo'];
					$data['productid'] = $value['productId'];

				}
				echo json_encode($data);
			}

		}
		public function search_product_to_add(){
			if(isset($_POST['query'])){
				$output = '';
				$OrderModel = $this->load->model('OrderModel');
				$tablePro = 'tbl_product';
				$cond = "$tablePro.productName LIKE '%".$_POST['query']."%'";
				$data['select_product'] = $OrderModel->select_product_to_add($tablePro,$cond);
				$output = '<ul class="list-unstyled">';
				if($data['select_product']!=''){
				foreach($data['select_product'] as $key => $value){
					$name = $value['productName'];
					$output.='<li id="choose_name">'.$name.'</li>';
				}
				}else{
						$output.='<li>Không có tên sản phẩm này</li>';
					}
				$output.='</ul>';
				echo $output;
			}

		}
		public function change_ordered_product(){
			if(isset($_POST['product_status'])){
				$OrderModel = $this->load->model('OrderModel');
				$tableCart = 'tbl_cart';
				$order_datecreated = $_POST['order_datecreated'];
				$orderid = $_POST['orderid'];
				$product_status = $_POST['product_status'];
				$product_id = $_POST['product_id'];
				$cond = "$tableCart.productId = '$product_id' AND $tableCart.order_id = '$orderid' AND $tableCart.datecreated = '$order_datecreated'";
				$data = array(
					'product_status' => $product_status

				);
				$result = $OrderModel->update_ordered_product($tableCart,$data,$cond);

			}
		}
		public function filter_order(){
			if(!isset($_GET['option_order'])){
				header("Location:".BASE_URL."/Order");
			}else{
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$OrderModel = $this->load->model('OrderModel');
				$tableRegisters = 'tbl_registers';
				$tableCart = 'tbl_cart';
				$option_order = $_GET['option_order'];
				$this->load->count_all_order = $OrderModel->CountAllOrder($tableCart);
				$this->load->count_all_order_pending = $OrderModel->CountAllOrder_Pending($tableCart);
				$this->load->count_all_order_notpay = $OrderModel->CountAllOrder_NotPay($tableCart);
				$this->load->count_all_order_notdeliver = $OrderModel->CountAllOrder_NotDeliver($tableCart);
				if($option_order == 'pending'){
					$solve = 0;
					$data['get_customers_order'] = $OrderModel->filter_order_by_pending($tableRegisters,$tableCart,$solve);
					$this->load->view('admin/filter_order',$data);
				}elseif($option_order == 'notpay'){
					$pay = 0;
					$data['get_customers_order'] = $OrderModel->filter_order_by_notpay($tableRegisters,$tableCart,$pay);
					$this->load->view('admin/filter_order',$data);
				}elseif($option_order == 'paynotdelivery'){
					$delivery = 0;
					$data['get_customers_order'] = $OrderModel->filter_order_by_paynotdelivery($tableRegisters,$tableCart,$delivery);
					$this->load->view('admin/filter_order',$data);
				}
				$this->load->view('admin/footer');
			}
		}
		public function Index(){
			
			$this->listOrder();
		}
		public function FilterOrder(){
			$tableCart = 'tbl_cart';
			$tableCus = 'tbl_customers';
			$tablePro = 'tbl_product';
			$pay = $_POST['pay'];
			$output = '
				<thead>

			<tr>

				<th><input type="checkbox" id="checkall"  name="select[]"></th>

				<th>Order ID</th>

				<th>Name Customer</th>



				<th>Date Created</th>

				<th>Date Modified</th>

				<th>Status</th>

				<th>Pay</th>

				<th>Action</th>

			</tr>



			</thead>

			 ';
			$OrderModel = $this->load->model('OrderModel');
		
			$data['pay'] = $OrderModel->FilterPayed($tableCart,$tableCus,$tablePro,$pay);

			foreach($data['pay'] as $key => $payed){
				$output .= '
					<tr>

				<td><input type="checkbox" class="checkitem" value="'.$payed['customerId'].'" name="select_id[]"></td>

				<td><?php echo $i; ?></td>

				<td>'.$payed['customerName'].'</td>



				<td>

				
					'.$payed['datecreated'].'


					

				</td>

				<td>

					
					'.$payed['datemodified'].'


					

				</td>

				<td></td>

				

				<td></td>

				<td>

				 <a href="<?php echo BASE_URL ?>/Order/ViewOrder/'.$payed['customerId'].'">View</a>

				<a class="delete_link" href="<?php echo BASE_URL ?>/Order/delOrder/'.$payed['customerId'].'"><i class="fa fa-trash-o"></i></a>

				</td>

			</tr>

				';
			}
			echo $output;
		}
		public function listOrder(){
			Session::checkSession();
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$tablePro = "tbl_product";
			$tableCart = "tbl_cart";
			$tableRegisters = "tbl_registers";
			$OrderModel = $this->load->model('OrderModel');
			$this->load->count_all_order = $OrderModel->CountAllOrder($tableCart);
			$this->load->count_all_order_pending = $OrderModel->CountAllOrder_Pending($tableCart);
			$this->load->count_all_order_notpay = $OrderModel->CountAllOrder_NotPay($tableCart);
			$this->load->count_all_order_notdeliver = $OrderModel->CountAllOrder_NotDeliver($tableCart);
			
			$data['listOrder'] = $OrderModel->listOrder($tablePro,$tableCart);

			$this->load->view('admin/listorder',$data);

			$this->load->view('admin/footer');
		}
		public function ViewOrder(){
			Session::checkSession();
			$order_id = $_GET['order_id'];
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			
			$tableCus = "tbl_customers";
			$tableRegisters = "tbl_registers";
			$tablePayFast = "tbl_payfast";
			$tablePro = "tbl_product";
			$tableCart = "tbl_cart";
			$tableProductColor = 'tbl_product_color';
			$tableChangeColor = 'tbl_changecolor';

			$OrderModel = $this->load->model('OrderModel');
			$data['get_customers_order'] = $OrderModel->detail_customer_by_order_id($tableCart,$order_id);
			$data['get_detail_products'] = $OrderModel->get_detail_products($tablePro,$tableCart,$order_id);
			$data['get_product_color'] = $OrderModel->get_product_color($tableProductColor);
			$data['get_all_color'] = $OrderModel->get_all_color($tableChangeColor);
			$this->load->view('admin/orderdetail',$data);

			$this->load->view('admin/footer');

		}
		public function delOrder($id = NULL){
			Session::checkSession();
			$order_id = $_GET['order_id'];
			$tableCart = "tbl_cart";
			$cond = "$tableCart.order_id = '$order_id'";
			$OrderModel = $this->load->model('OrderModel');
			$result = $OrderModel->delOrder($tableCart,$cond);
			
				$url = BASE_URL."/Order";
				header("Location:$url");
		}
		public function UpdateOrder($id = NULL){
			$order_id = $_POST['order_id'];
			if(!$_POST){
			header("Location:".BASE_URL."/Order/ViewOrder/".$id.'/?order_id='.$order_id."&msg=".urlencode(serialize($mdata)));
			}else{

				$tableCart = "tbl_cart";
				$OrderModel = $this->load->model('OrderModel');
				
				foreach($_POST['quantity'] as $key => $value){
					
					$solve = $_POST['pay'];
					$deliver = $_POST['deliver'];
					date_default_timezone_set('asia/ho_chi_minh');
			        $date = date("d/m/Y");
			        $hour = date("h:i:sa");

					$cond = "cart_token='$key' AND order_id='$order_id'";

					
					$data = array(
						
						'quantity' => $value['quantity'],
						
						'solve' => $solve,
						'deliver' => $deliver,
						'status' => 1
					);
					
					$result = $OrderModel->updateOrder($tableCart,$data,$cond);

				}
				if($result == 1){
					$mdata['msg'] = "Cập nhật đơn hàng thành công";

				}else{
					$mdata['msg'] = "Cập nhật đơn hàng thất bại";
				}
				
			}
			$url = BASE_URL."/Order/ViewOrder/".$id.'/?order_id='.$order_id."&msg=".urlencode(serialize($mdata));
				header("Location:$url");
		
		}

		public function Search(){
			Session::checkSession();
			if(!$_POST){
				$mdata['msg'] = "Search Order Failed";	
				$url = BASE_URL."/Order?msg=".urlencode(serialize($mdata));
				header("Location:$url");
			}else{

				$start_day = $_POST['fromdate'];

				$end_day = $_POST['todate'];
				$cond = "datecreated BETWEEN '$start_day' AND '$end_day'";
				if($start_day == '' || $end_day == ''){
					$mdata['msg'] = "Please select day to search order";	
					
					}else{
						
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						
						$tableCus = "tbl_customers";
						$tablePro = "tbl_product";
						$tableCart = "tbl_cart";
						
						$OrderModel = $this->load->model('OrderModel');

						$data['listOrder'] = $OrderModel->listOrderSearch($tableCus,$tablePro,$tableCart,$cond);
						
						$this->load->view('admin/searchresult',$data);

						$this->load->view('admin/footer');	
						$mdata['msg'] = "Finded Order from Table";

					}
					$url = BASE_URL."/Order?msg=".urlencode(serialize($mdata));
						header("Location:$url");
				
				
			}
		}

		public function printOrder($id){
			Session::checkSession();
			$tableCus = "tbl_customers";
			$tablePro = "tbl_product";
			$tableCart = "tbl_cart";
						
			$OrderModel = $this->load->model('OrderModel');
			$data['productbycustomer'] = $OrderModel->productByCustomer($tableCus,$tablePro,$tableCart,$id);
			$data['invoiceOrder'] = $OrderModel->invoice($tableCus,$tablePro,$tableCart);
			$this->load->view('admin/printorder',$data);

		}



	}


?>