<?php

	class signup extends DController

	{

		

		public function __construct()

		{

			parent::__construct();

			$data = array();

		}

		public function Index(){

			$this->load->active = 'signup';

			$this->signup();

			

		}

		public function check_match_pass(){

			if(isset($_POST['user_password'])){

				if($_POST['user_password']== $_POST['confirm_pass']){

					echo '<span style="color:green;font-size:14px">Mật khẩu trùng khớp</span>';

				}else{

					echo '<span style="color:red;font-size:14px">Mật khẩu không trùng khớp</span>';

				}

			}

		}

		public function signup(){

			Session::init();

			if(Session::get("login_register_home") == true){

				header("Location:".BASE_URL."/c");

			}
		}

		public function loginAuth(){

			$tableRegisters = 'tbl_registers';

			$re_username = $_POST['re_username'];

			$pass_username = $_POST['pass_username'];

			$re_confirm_pass = $_POST['re_confirm_pass'];

			$salt = sha1("h6j8d^&BD*HHsc7d&%#%&^os88JJGXSN*&%8d!!%^a765");

			$password = md5($_POST['pass_username']).$salt;


			$loginModel = $this->load->model("LoginModel");



			$count = $loginModel->count_user_login($tableRegisters, $re_username, $password);



			if($count>0){

				$result = $loginModel->get_user_data($tableRegisters, $re_username, $password);

				Session::init();

				Session::set("register_active",$result[0]['register_active']);

				$register_active = Session::get("register_active");



				if($register_active==0){



					$mdata['msg'] = "Tài khoản của bạn đã bị khóa.Vui lòng liên hệ Admin";

					



				}elseif($register_active==1){

					

					Session::set("login_register_home",true);

					Session::set("register_id",$result[0]['register_id']);

					Session::set("register_username",$result[0]['register_name']);

					Session::set("register_email",$result[0]['register_email']);

					Session::set("register_phone",$result[0]['register_phone']);

					Session::set("register_address",$result[0]['register_address']);

					Session::set("register_userId",$result[0]['register_id']);

					Session::set("register_level",$result[0]['register_role']);

					date_default_timezone_set('asia/ho_chi_minh');

		            $date = date("d/m/Y");

		            $hour = date("h:i:sa");

		            $id_register = Session::get("register_id");

		            $cond_register = "$tableRegisters.register_id='$id_register'";

		            $data = array(

		            	'register_last_login' => $date.' '.$hour

		            );

		            $result = $loginModel->last_time_login($tableRegisters,$data,$cond_register);

					$mdata['msg'] = "Đăng nhập vào tài khoản thành công";

					

					

				}

			}else{

				$mdata['msg'] = "Sai tên tài khoản hoặc mật khẩu,vui lòng thử lại...";

			}

			$url = BASE_URL."/register?msg=".urlencode(serialize($mdata));

						header("Location:$url");



		}

		public function logout_register(){

			Session::init();

			unset($_SESSION['login_register_home']);

			unset($_SESSION['register']);

			unset($_SESSION['payfast']);

			$mdata['msg'] = "Đăng xuất tài khoản thành công";

			$url = BASE_URL."/register?msg=".urlencode(serialize($mdata));

				header("Location:$url");

			

		}

		

	}

?>