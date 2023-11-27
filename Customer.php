<?php
class Customer extends DController
{
	
	function __construct()
	{
		parent::__construct();
		$data = array();
	}
	public function Index(){
		
		$this->makeCustomer();
	}
	
	public function ListComment(){
		Session::checkSession();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
			
		
		$tableComment = "tbl_comment";

		$CustomerModel = $this->load->model('CustomerModel');
		$data['listcomment'] = $CustomerModel->listComment($tableComment);
		$data['list_reply_comment'] = $CustomerModel->list_reply_comment($tableComment);
		$this->load->view('admin/listcomment',$data);

		$this->load->view('admin/footer');
	}
	public function comment_status(){
		
			$tableComment = "tbl_comment";
			$CustomerModel = $this->load->model('CustomerModel');
			
			$comment_id = $_POST['comment_id'];
			$cond = "$tableComment.comment_id='$comment_id'";
			$active = '';
			if($_POST['comment_status']==1){
				$active = 1;
				$data = array(
					'comment_status' => $active
				);
			}else{
				$active = 0;
				$data = array(
					'comment_status' => $active
				);
			}
			$result = $CustomerModel->change_customer_status($tableComment,$data,$cond);
			
		
	}
	public function delComment($id){		
		Session::checkSession();			
		$tableComment = "tbl_comment";		
			$cond = "comment_id='$id'";	
			$CustomerModel = $this->load->model('CustomerModel');			
			$result = $CustomerModel->delComment($tableComment,$cond);				
			if($result == 1){					
			$mdata['msg'] = "Xóa comment thành công";				
		}else{	
			$mdata['msg'] = "Xóa comment thất bại";				
		}	
			$url = BASE_URL."/Customer/ListComment?msg=".urlencode(serialize($mdata));			header("Location:$url");	}
	
	public function comment(){
		$error = '';
		$id = $_POST['comment_id'];
		$comment_name = '';
		$comment_content = '';
		$url_current = $_POST['comment_url'];
		date_default_timezone_set('asia/ho_chi_minh');
        $date = date("d/m/Y");
        $hour = date("h:i:sa");
		
		if(empty($_POST['comment_name'])){
			$error .= '<p class="text-danger">Yêu cầu điền tên để bình luận</p>';
		}else{
			$comment_name = $_POST['comment_name'];
		}
		if(empty($_POST['comment_content'])){
			$error .= '<p class="text-danger">Yêu cầu thêm nội dung bình luận</p>';
		}else{
			$comment_content = $_POST['comment_content'];
		}
		if($error == ''){
			$tbl_comment = 'tbl_comment';
			$CustomerModel = $this->load->model('CustomerModel');
			$data = array(
				'parent_comment_id' => $id, 
				'comment' => $comment_content,
				'comment_url' => $url_current,
				'comment_sender_name' => $comment_name,
				'comment_date_created' => $date.' '.$hour
			);
			$CustomerModel->thembinhluan($tbl_comment,$data);
			$error = '<label class="text-success">Thêm thành công,bình luận sẽ được hiển thị khi admin duyệt nhé.</label>';
		}
		$data = array(
			'error' => $error
		);
		echo json_encode($data);

	}
	
	public function fetch_comment(){
		$output = '';
		$helper = $this->load->helper('Helper');
		$tbl_comment = 'tbl_comment';
		$CustomerModel = $this->load->model('CustomerModel');
		$cond = "parent_comment_id='0'";
		$data['laybinhluan'] = $CustomerModel->laybinhluan($tbl_comment,$cond);
		foreach($data['laybinhluan'] as $key => $binhluan){
			 $output .= '
			 <div class="panel panel-default">
			  <div class="panel-heading">Bởi <b>'.$binhluan["comment_sender_name"].'</b> vào lúc <i>'.$binhluan["comment_date_created"].'</i></div>
			  <div class="panel-body">'.$binhluan["comment"].'</div>
			  <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply_comment" id="'.$binhluan["comment_id"].'">Reply</button></div>
			 </div>
			 ';
			
			$output .= $helper->get_reply_comment($CustomerModel,$binhluan["comment_id"]);
			
	}
	echo $output;
	}

}

?>