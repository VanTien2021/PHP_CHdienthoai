<?php

	/**

	 * 

	 */

	class Guest extends DController

	{

		

		public function __construct()

		{

			parent::__construct();

			$data = array();

		}

		public function Index(){

			

			$this->listGuest();



		}

		public function listGuest(){

			Session::checkSession();

			$this->load->view('admin/header');

			$this->load->view('admin/sidebar');

			$tableRegisters = "tbl_registers";

			$tableCart = 'tbl_cart'; 

			$GuestModel = $this->load->model('GuestModel');

			$data['listguest'] = $GuestModel->listGuest($tableRegisters);

			$this->load->view('admin/listguest',$data);

			$this->load->view('admin/footer');

		}

		public function guest_filter_ordered($id){

			Session::checkSession();

			$this->load->view('admin/header');

			$this->load->view('admin/sidebar');

			$tableRegisters = "tbl_registers";

			$tableCart = 'tbl_cart'; 

			$GuestModel = $this->load->model('GuestModel');

			$this->load->count_ordered_by_id = $GuestModel->count_ordered_by_id($tableRegisters,$tableCart,$id);

			$data['filter_ordered_by_id'] = $GuestModel->filter_ordered_by_id($tableRegisters,$tableCart,$id);

			$this->load->view('admin/guest_ordered',$data);



			$this->load->view('admin/footer');



		}

		public function profile_guest($id){

			Session::checkSession();

			$this->load->view('admin/header');

			$this->load->view('admin/sidebar');

			

			$tableRegisters = "tbl_registers";

			$tableCart = 'tbl_cart'; 

			$GuestModel = $this->load->model('GuestModel');

			$this->load->count_ordered_by_id = $GuestModel->count_ordered_by_id($tableRegisters,$tableCart,$id);

			$data['view_detail_guest'] = $GuestModel->view_detail_guest($tableRegisters,$id);

			$this->load->view('admin/profile_guest',$data);



			$this->load->view('admin/footer');

		}

		public function change_active(){

			if($_POST["action"]=='change_status'){

				$user_id = $_POST['user_id'];

				$tableRegisters = 'tbl_registers';

				$GuestModel = $this->load->model('GuestModel');

				$status = '';

				if($_POST['user_status']==1){

					$active = 0;

					$data = array(

						'register_active' => $active

					);

					$cond_guest = "$tableRegisters.register_id='$user_id'";

					$result = $GuestModel->change_active_register($tableRegisters,$data,$cond_guest);

					if(isset($result)){

						echo '<div class="alert alert-success">Tài khoản đã chuyển sang chế độ Kích hoạt</div>';

					}

				}else{

					$active = 1;

					$data = array(

						'register_active' => $active

					);

					$cond_guest = "$tableRegisters.register_id='$user_id'";

					$result = $GuestModel->change_active_register($tableRegisters,$data,$cond_guest);

					if(isset($result)){

						echo '<div class="alert alert-success">Tài khoản đã chuyển sang chế độ Không kích hoạt</div>';

					}

				}

					



			}

		}



	}

?>