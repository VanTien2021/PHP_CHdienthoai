<?php

class register extends DController
{
	
	function __construct()
	{
		parent::__construct();
		$data = array();
	}
	public function Index(){
		
		$this->makeCustomer();
	}

	public function select_state(){
		$output = '';
		$output = '<option value="0" selected>------Chọn tỉnh thành----------</option>';
		if(isset($_POST['city_id'])){
			$city_id = $_POST['city_id'];
			$tableState = 'devvn_quanhuyen';
			$CustomerModel = $this->load->model('CustomerModel');
			$data['get_state'] = $CustomerModel->get_state($tableState,$city_id);
			foreach($data['get_state'] as $key => $state){
				$output.= '<option value="'.$state['maqh'].'">'.$state['name'].'</option>';
			}
			
		}
		echo $output;
	}
	public function makeCustomer(){
			//START_SESSION
			Session::init();
			//META SECTION
			$this->load->title = 'Đăng ký tài khoản khách hàng';
			//TABLE SECTION
			$tableCat = 'tbl_cat';
            $tableProduct = 'tbl_product';
            $tablePost = 'tbl_post';
            $tableCatPost = 'tbl_cate_post';
            $tableOneCatPost = 'tbl_onecatpost';
            $tableCatVideo = 'tbl_catvideo';
            $tablePost = 'tbl_post';
            $tableCity = 'tbl_tinhthanhpho';		
			//CONDITIONS SQL SECTION
			$cond = "parent_id = 0";
            $condsub = "parent_id != 0";	
			//MODELS SECTION
			$CustomerModel = $this->load->model('CustomerModel');
			$MediaModel = $this->load->model('MediaModel');
            $PostModel = $this->load->model('PostModel');
            $CateModel = $this->load->model('CatModel');
            $ProductModel = $this->load->model('ProductModel');
			//GET DATABASE SECTION
			$data['get_city'] = $CustomerModel->get_city($tableCity);
			$data['onecatpost'] = $CateModel->listOneCategoryPost($tableOneCatPost);
            $data['allcatlist'] = $CateModel->allCategory($tableCat,$cond);
            $data['allsubcatlist'] = $CateModel->allSubCategory($tableCat);
            $data['catlistpost'] = $CateModel->listCategoryPost($tableCatPost);
            $data['catsublistpost'] = $CateModel->listSubCategoryPost($tableCatPost,$condsub);
			$data['catvideo'] = $MediaModel->listCatVideo($tableCatVideo);
			$data['postfeathered'] = $PostModel->PostFeatheredHome($tablePost);
			$data['postfooter'] = $PostModel->allPostFooter($tablePost);
			//THEMES SECTION
			$this->load->view('topbar');
			$this->load->view('header');
            $this->load->view('menu',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('register',$data);
            $this->load->view('footer',$data);
	}
	public function reset_password(){
		//START_SESSION
			Session::init();
			//META SECTION
			$this->load->title = 'Quên mật khẩu';
			//TABLE SECTION
			$tableCat = 'tbl_cat';
            $tableProduct = 'tbl_product';
            $tablePost = 'tbl_post';
            $tableCatPost = 'tbl_cate_post';
            $tableOneCatPost = 'tbl_onecatpost';
            $tableCatVideo = 'tbl_catvideo';
            $tablePost = 'tbl_post';
            $tableCity = 'tbl_tinhthanhpho';		
			//CONDITIONS SQL SECTION
			$cond = "parent_id = 0";
            $condsub = "parent_id != 0";	
			//MODELS SECTION
			$CustomerModel = $this->load->model('CustomerModel');
			$MediaModel = $this->load->model('MediaModel');
            $PostModel = $this->load->model('PostModel');
            $CateModel = $this->load->model('CatModel');
            $ProductModel = $this->load->model('ProductModel');
			//GET DATABASE SECTION
			$data['get_city'] = $CustomerModel->get_city($tableCity);
			$data['onecatpost'] = $CateModel->listOneCategoryPost($tableOneCatPost);
            $data['allcatlist'] = $CateModel->allCategory($tableCat,$cond);
            $data['allsubcatlist'] = $CateModel->allSubCategory($tableCat);
            $data['catlistpost'] = $CateModel->listCategoryPost($tableCatPost);
            $data['catsublistpost'] = $CateModel->listSubCategoryPost($tableCatPost,$condsub);
			$data['catvideo'] = $MediaModel->listCatVideo($tableCatVideo);
			$data['postfeathered'] = $PostModel->PostFeatheredHome($tablePost);
			$data['postfooter'] = $PostModel->allPostFooter($tablePost);
			//THEMES SECTION
			$this->load->view('topbar');
			$this->load->view('header');
            $this->load->view('menu',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('reset_password',$data);
            $this->load->view('footer',$data);
	}
	public function get_forgot_password(){
		if(isset($_POST['reset-request-submit'])){

			$email = $_POST['email_forgot'];

			$tableRegister = 'tbl_registers';
			$CustomerModel = $this->load->model('CustomerModel');
			$result = $CustomerModel->select_user_by_email($tableRegister,$email);
			if($result){

				$token = 'ffsdf435345fjgh87zvbxvoirjdn43289635gfsg';
				$token = str_shuffle($token);
				$token = substr($token,0,10);
				$minutes_to_add = 5;
				date_default_timezone_set('asia/ho_chi_minh');
				$time = new DateTime();
				$time->add(new DateInterval('PT' . $minutes_to_add . 'M'));

				$stamp = $time->format('d-m-Y H:i:s');
				$cond = "$tableRegister.register_email = '$email'";
				
				$data = array(
					'register_token' => $token,
					'register_token_expire' => $stamp
				);
				$result = $CustomerModel->update_user_token_by_email($tableRegister,$data,$cond);
				header("Location:".BASE_URL."/register/reset_password?email=".$email."&token=".$token."");	

			}else{
				$mdata['msg'] = "Làm ơn điền email đăng ký.Email chưa đăng ký";
					$url = BASE_URL."/register/forgot_password?msg=".urlencode(serialize($mdata));
						header("Location:$url");
				
			}
		


		}else{
			header("Location:".BASE_URL."/register/forgot_password");	
		}
		

	}
	public function update_password(){
		if(isset($_POST['email']) && isset($_POST['token'])){
			$mdata = "";
			$email = $_POST['email'];
			$token = $_POST['token'];
			$tableRegister = 'tbl_registers';
			$CustomerModel = $this->load->model('CustomerModel');
			date_default_timezone_set('asia/ho_chi_minh');
			$time = new DateTime();
			$stamp = $time->format('d-m-Y H:i:s');
			$cond = "register_email = '$email' AND register_token='$token' AND register_token <> '' AND register_token_expire > '$stamp'";
			$result = $CustomerModel->select_user_by_email_token($tableRegister,$cond);
			if($result){

				$token = 'ffsdf435345fjgh87zvbxvoirjdn43289635gfsg';
				$token = str_shuffle($token);
				$token = substr($token,0,10);
				$salt = sha1("h6j8d^&BD*HHsc7d&%#%&^os88JJGXSN*&%8d!!%^a765");
				$password_new = $_POST['password_new'];
				$password_new_confirm = $_POST['password_new_confirm'];
				if($password_new == '' || $password_new_confirm == ''){

					$mdata['msg'] = "Làm ơn không để trống các trường";
					$url = BASE_URL."/register/reset_password?email=".$email."&token=".$token."?msg=".urlencode(serialize($mdata));

				}else{
					
					$password = md5($password_new).$salt;
					$data = array(
						'register_token' => '',
						'register_password' => $password,
						'register_password_decrypt' => $password_new
					);
					$cond_update = "register_email='$email'";
					$result = $CustomerModel->update_user_by_email_token($tableRegister,$data,$cond_update);
					if($result){
						$mdata['msg'] = "Cập nhật mật khẩu mới thành công";
						$url = BASE_URL."/register?msg=".urlencode(serialize($mdata));
					}
				}
					
			}else{
				$mdata['msg'] = "Lỗi,làm ơn gửi lại email để lấy lại mật khẩu";
				$url = BASE_URL."/register/forgot_password?msg=".urlencode(serialize($mdata));
				
			}
			
		}else{
			$mdata['msg'] = "Lỗi,làm ơn gửi lại email để lấy lại mật khẩu";
			$url = BASE_URL."/register/forgot_password?msg=".urlencode(serialize($mdata));
			
					
		}
		header("Location:".$url);
				
		
	}
	public function forgot_password(){
		//START_SESSION
			Session::init();
			//META SECTION
			$this->load->title = 'Quên mật khẩu';
			//TABLE SECTION
			$tableCat = 'tbl_cat';
            $tableProduct = 'tbl_product';
            $tablePost = 'tbl_post';
            $tableCatPost = 'tbl_cate_post';
            $tableOneCatPost = 'tbl_onecatpost';
            $tableCatVideo = 'tbl_catvideo';
            $tablePost = 'tbl_post';
            $tableCity = 'tbl_tinhthanhpho';		
			//CONDITIONS SQL SECTION
			$cond = "parent_id = 0";
            $condsub = "parent_id != 0";	
			//MODELS SECTION
			$CustomerModel = $this->load->model('CustomerModel');
			$MediaModel = $this->load->model('MediaModel');
            $PostModel = $this->load->model('PostModel');
            $CateModel = $this->load->model('CatModel');
            $ProductModel = $this->load->model('ProductModel');
			//GET DATABASE SECTION
			$data['get_city'] = $CustomerModel->get_city($tableCity);
			$data['onecatpost'] = $CateModel->listOneCategoryPost($tableOneCatPost);
            $data['allcatlist'] = $CateModel->allCategory($tableCat,$cond);
            $data['allsubcatlist'] = $CateModel->allSubCategory($tableCat);
            $data['catlistpost'] = $CateModel->listCategoryPost($tableCatPost);
            $data['catsublistpost'] = $CateModel->listSubCategoryPost($tableCatPost,$condsub);
			$data['catvideo'] = $MediaModel->listCatVideo($tableCatVideo);
			$data['postfeathered'] = $PostModel->PostFeatheredHome($tablePost);
			$data['postfooter'] = $PostModel->allPostFooter($tablePost);
			//THEMES SECTION
			$this->load->view('topbar');
			$this->load->view('header');
            $this->load->view('menu',$data);
            $this->load->view('sidebar',$data);
            $this->load->view('forgot_password');
            $this->load->view('footer',$data);
	}
//----------------------------------------------------------FUNCTION WEBSITES------------------------------------------//
	public function AddRegister(){
		if(!$_POST){
			header("Location:".BASE_URL."/register");
		}else{
			Session::init();
			$tableRegister = "tbl_registers";
			$registerName = $_POST['registerName'];
			$registerPhone = $_POST['registerPhone'];
			$registerEmail = $_POST['registerEmail'];
			$registerAddress = $_POST['registerAddress'];
			$registerNotice = $_POST['registerNotice'];
			$register_captcha = $_POST['register_captcha'];
			$sum_captcha = $_POST['sum_captcha'];
			$salt = sha1("h6j8d^&BD*HHsc7d&%#%&^os88JJGXSN*&%8d!!%^a765");
			$registerPassword = md5($_POST['registerPassword']).$salt;
			if($register_captcha == '' || $registerName == '' || $registerPhone == '' || $registerNotice == '' || $registerEmail == '' || $registerAddress == '' || $registerPassword == '' ){
				$mdata['msg'] = "Làm ơn điền đầy đủ thông tin";
				
			}elseif($sum_captcha!=$register_captcha){
				$mdata['msg'] = "Mã captcha bị sai";
			}else{
			Session::set('register',true);
			Session::set('register_username', $registerName);
			Session::set('register_email', $registerEmail);
			Session::set('register_phone', $registerPhone);
			Session::set('register_address', $registerAddress);
			date_default_timezone_set('asia/ho_chi_minh');
            $date = date("d/m/Y");
            $hour = date("h:i:sa");
			$data = array(
				'register_name' => $registerName,
				'register_password' => $registerPassword,
				'register_password_decrypt' => $_POST['registerPassword'],
				'register_phone' => $registerPhone,
				'register_address' => $registerAddress,
				'register_datecreated' => $date.' '.$hour,
				'register_email' => $registerEmail,
				'register_note' => $registerNotice

			);

			$CustomerModel = $this->load->model('CustomerModel');
			$result = $CustomerModel->AddRegister($tableRegister,$data);
			if($result==1){
				$mdata['msg'] = "Bạn đã đăng ký tài khoản thành công ";
				
			}
		
			}
			$url = BASE_URL."/c?msg=".urlencode(serialize($mdata));
						header("Location:$url");
			
		}
			
			
		
	}

	public function payfast(){
		if(!$_POST){
			header("Location:".BASE_URL."/register");
		}else{
			Session::init();
			$tablePayfast = "tbl_payfast";
			$payfast_name = $_POST['payfast_name'];
			$payfast_phone = $_POST['payfast_phone'];
			$payfast_email = $_POST['payfast_email'];
			$payfast_address = $_POST['payfast_address'];
			$payfast_note = $_POST['payfast_note'];
			if($payfast_name == '' || $payfast_phone == '' || $payfast_email == '' || $payfast_address == '' || $payfast_note == '' ){
				$mdata['msg'] = "Làm ơn điền đầy đủ thông tin đăng ký";

			}else{
				Session::set('payfast',true);
				Session::set('register_username', $payfast_name);
				Session::set('register_email', $payfast_email);
				Session::set('register_phone', $payfast_phone);
				Session::set('register_address', $payfast_address);
				Session::set('register_note', $payfast_note);
				$data = array(
					'payfast_name' => $payfast_name,
					'payfast_phone' => $payfast_phone,
					'payfast_address' => $payfast_address,
					'payfast_email' => $payfast_email,
					'payfast_note' => $payfast_note

				);

				$CustomerModel = $this->load->model('CustomerModel');
				$result = $CustomerModel->AddPayFast($tablePayfast,$data);
				if($result==1){
					$mdata['msg'] = "Bạn đã điền thông tin thành công";
				}
		
			}
		}	
	}
	public function logout(){
		
			Session::init();
			unset($_SESSION['customer']);
			$mdata['msg'] = "Đăng xuất thành công . Đăng ký để thanh toán.";
		
		$url = BASE_URL."/register?msg=".urlencode(serialize($mdata));
						header("Location:$url");
	}
	public function comment(){
		if(!$_POST){
		$mdata['msg'] = "Gửi yêu cầu liên hệ thất bại";
		$url = BASE_URL."/Index?msg=".urlencode(serialize($mdata));
						header("Location:$url");
		
		}
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$comment = $_POST['comment'];
		if($name == '' || $phone == '' || $comment == ''){
            	$mdata['msg'] = "Gửi yêu cầu liên hệ thất bại";
		}else{
			$tableComment = 'tbl_comment';
			$CustomerModel = $this->load->model('CustomerModel');
			$mail = $this->load->mailserver('PHPMailer');
			
			date_default_timezone_set('asia/ho_chi_minh');
            $date = date("d/m/Y");
            $hour = date("h:i:sa");
			$email = $_POST['email'];
		
			/*--------------Start Section Mail------------------------------*/
				$mail -> IsSMTP();

				  $mail -> IsHTML(true);

				  $mail -> Host     = "";

				  $mail -> Port     = 465;

				  $mail -> SMTPAuth = true;

				  $mail -> Username = "";

				  $mail -> Password = "";

				 

				  $mail -> Body     = "<p>----Tên người gửi : ".'<b>'.$name.'</b></p>'."</br>"."<p>---- Sdt:".'<b>'.'0'.$phone.'</b></p>'."</br></br>"."<p>-----Ghi chú :".'<b>'.$comment.'</b></p>';

				  $mail -> Subject  = "Contact to create Website";

				 

				  $mail -> From     = $email;

				  $mail -> FromName = $name;

				  $mail -> AddAddress("");
				  
				 

				  if ($mail -> Send())

				  {

					$mdata['msg'] = "Chúng tôi sẽ nhanh chóng liên hệ với bạn. Cảm ơn bạn đã liên hệ";

				  } 

				  else

				  {

					$mdata['msg'] = "Gửi yêu cầu liên hệ thất bại";

					echo "Hiba: " . $mail -> ErrorInfo;

				  }
			/*---------------End Section Mail------------------------------*/
			
           

		}
		
			
			$url = BASE_URL."/Index?msg=".urlencode(serialize($mdata));
						header("Location:$url");
		}
		
	
	public function registerdemo($id){
		if(!$_POST){
		$mdata['msg'] = "Gửi yêu cầu thất bại";
		$url = BASE_URL."/Index?msg=".urlencode(serialize($mdata));
						header("Location:$url");
		}else{
			$mail = $this->load->mailserver('PHPMailer');
			$name = $_POST['name'];
			$phone = $_POST['phone'];
			$comment = $_POST['comment'];
			date_default_timezone_set('asia/ho_chi_minh');
            $date = date("d/m/Y");
            $hour = date("h:i:sa");
			$email = $_POST['email'];
			/*--------------Start Section Mail------------------------------*/
				$mail -> IsSMTP();

				  $mail -> IsHTML(true);

				  $mail -> Host     = "ssl://smtp.gmail.com";

				  $mail -> Port     = 465;

				  $mail -> SMTPAuth = true;

				  $mail -> Username = "tanhieu2014@gmail.com";

				  $mail -> Password = "@#truongngoctanhieu!123";

				 

				  $mail -> Body     = "<p>----Tên người gửi : ".'<b>'.$name.'</b></p>'."</br>"."<p>---- Sdt:".'<b>'.'0'.$phone.'</b></p>'."</br></br>"."<p>-----Ghi chú :".'<b>'.$comment.'</b></p>';

				  $mail -> Subject  = "Contact to create Website";

				 

				  $mail -> From     = $email;

				  $mail -> FromName = $name;

				  $mail -> AddAddress("");
				  
				 

				  if ($mail -> Send())

				  {

					$mdata['msg'] = "Chúng tôi sẽ nhanh chóng liên hệ với bạn.Cảm ơn bạn";

				  } 

				  else

				  {

					$mdata['msg'] = "Gửi yêu cầu thất bại";

					echo "Hiba: " . $mail -> ErrorInfo;

				  }

		}
			
			$url = BASE_URL."/t/details/".$id."?msg=".urlencode(serialize($mdata));
						header("Location:$url");
		
	}
}

?>