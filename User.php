<?php

		class User extends DController

		{

			

			function __construct()

			{

				parent::__construct();

				$data = array();

			}

			public function Index(){

				

				$this->makeUser();

			}
			public function change_active_user(){
				if($_POST["action"]=='change_status'){

				$user_id = $_POST['user_id'];
				$tableUser = 'tbl_user';
				$UserModel = $this->load->model('UserModel');
				$status = '';

				if($_POST['user_status']==1){
					$active = 0;
					$data = array(
						'active' => $active
					);
					$cond_users = "$tableUser.userId='$user_id'";
					$result = $UserModel->change_active_user($tableUser,$data,$cond_users);
					if(isset($result)){
						echo '<div class="alert alert-success">Tài khoản đã chuyển sang chế độ Kích hoạt</div>';
					}
				}else{
					$active = 1;
					$data = array(
						'active' => $active
					);
					$cond_users = "$tableUser.userId='$user_id'";
					$result = $UserModel->change_active_user($tableUser,$data,$cond_users);
					if(isset($result)){
						echo '<div class="alert alert-success">Tài khoản đã chuyển sang chế độ Không kích hoạt</div>';
					}
				}
			}
			}
			public function change_password($id){
				Session::checkSession();

				$this->load->view('admin/header');

				$this->load->view('admin/sidebar');
				$tableUser = 'tbl_user';
				$cond_user = "$tableUser.userId='$id'";
				$UserModel = $this->load->model('UserModel');
				$data['get_user_by_id'] = $UserModel->get_user_by_id($tableUser,$cond_user);

				$this->load->view('admin/change_password',$data);



				$this->load->view('admin/footer');
			}
			public function update_password_user($id){
				Session::checkSession();
				if(!$_POST){
					header("Location:".BASE_URL."/User/change_password".$id);
				}else{
					$password_old = $_POST['password_old'];
					$password_new = $_POST['password_new'];
					date_default_timezone_set('asia/ho_chi_minh');
		            $date = date("d/m/Y");
		            $hour = date("h:i:sa");
		            $date_updated = $date.' '.$hour;
					$salt = sha1("h6j8d^&BD*HHsc7d&%#%&^os88JJGXSN*&%8d!!%^a765");
					$level = $_POST['level'];
					$tableUser = 'tbl_user';
					$cond_user = "$tableUser.userId='$id'";
					$UserModel = $this->load->model('UserModel');
					$data['get_user_by_id'] = $UserModel->get_user_by_id($tableUser,$cond_user);
					foreach($data['get_user_by_id'] as $key => $value){
						$password_get_old = $value['password_not'];
					}
					if($password_old == '' || $password_new==''){
						$mdata['msg'] = "Làm ơn không bỏ trống các trường";
						$url = BASE_URL."/User/change_password/".$id."?msg=".urlencode(serialize($mdata));
						header("Location:$url");
					}elseif($password_old != $password_get_old){
						$mdata['msg'] = "Sai mật khẩu cũ .Vui lòng thử lại...";
						$url = BASE_URL."/User/change_password/".$id."?msg=".urlencode(serialize($mdata));
						header("Location:$url");
					}elseif($password_old == $password_get_old){
						$password_encryt = md5($password_new).$salt;
						$data = array(
							'password' => $password_encryt,
							'password_not' => $password_new
						);
						$cond_updated = "$tableUser.userId='$id'";
						$result = $UserModel->update_user_password($tableUser,$data,$cond_updated);
						if($result){
							$id_session_current = Session::get("userId");
							if($id_session_current==$id){
								unset($_SESSION['login']);
								$mdata['msg'] = "Đổi thành công .Đăng nhập lại mật khẩu vừa thay đổi....";
								$url = BASE_URL."/phone3t?msg=".urlencode(serialize($mdata));
							}elseif($id_session_current!=$id){
								$mdata['msg'] = "Cập nhật lại mật khẩu thành công...";
								$url = BASE_URL."/User/change_password/".$id."?msg=".urlencode(serialize($mdata));
							}
							header("Location:$url");
						}
					}
				}
				}
					
			
				
			
			public function makeUser(){

				Session::checkSession();

				$this->load->view('admin/header');

				$this->load->view('admin/sidebar');

				$this->load->view('admin/adduser');

				$this->load->view('admin/footer');

			}

			public function AddUser(){

				Session::checkSession();

				if(!$_POST){

					header("Location:".BASE_URL."/User");

				}else{
					$mdata = array();
					$tableUser = 'tbl_user';

					$username = $_POST['username'];

				    $salt = sha1("h6j8d^&BD*HHsc7d&%#%&^os88JJGXSN*&%8d!!%^a765");

					$password = md5($_POST['password']).$salt;
					$password_not = $_POST['password'];


					$level = $_POST['level'];

					date_default_timezone_set('asia/ho_chi_minh');
		            $date = date("d/m/Y");
		            $hour = date("h:i:sa");
		            $date_created = $date.' '.$hour;

					$data = array(

						'username' => $username,
						'password_not' => $password_not,
						'password' => $password,
						'date_created'=> $date_created,
						'last_login' =>$date_created,
						'level' => $level

					);

					$userModel = $this->load->model('UserModel');

					$result = $userModel->AddUser($tableUser,$data);

					



				if($result == 1){

					$mdata['msg'] = "Thêm người dùng thành công...";

				}else{

					$mdata['msg'] = "Thêm người dùng thất bại...";

				}

				$url = BASE_URL."/User/ListUser?msg=".urlencode(serialize($mdata));

				header("Location:$url");

				}




			}

			public function ListUser(){

				Session::checkSession();

				$this->load->view('admin/header');

				$this->load->view('admin/sidebar');

				$tableUser = 'tbl_user';



				$userModel = $this->load->model('UserModel');

				$data['listuser'] = $userModel->listUser($tableUser);



				$this->load->view('admin/listuser', $data);



				$this->load->view('admin/footer');



			}

			public function delUser($id = NULL){

				Session::checkSession();

				$tableUser = "tbl_user";

				$cond = "userId=$id";

				$userModel = $this->load->model('UserModel');

				$result = $userModel->delUserById($tableUser,$cond);



				if($result == 1){

					$mdata['msg'] = "User Deleted Successfully...";

				}else{

					$mdata['msg'] = "User Not Deleted...";

				}

				$url = BASE_URL."/User/listUser?msg=".urlencode(serialize($mdata));

				header("Location:$url");

			}
		}	

?>