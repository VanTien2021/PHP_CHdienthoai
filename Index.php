<?php

	class Index extends DController
	{

		public function __construct()
		{
			parent::__construct();
			$data = array();

		}
		public function Index(){
			$this->load->active = 'active';
			$this->home();
			
		}
		public function home(){
			Session::init();    
			//META SECTIONS
			$this->load->title = 'Shop điện thoại điện thoại 3tphone';
			$this->load->desc = 'Shop buôn bán các thiết bị điện tử chính hãng tại việt nam';
			$this->load->keywords = 'Shop buôn bán các thiết bị điện tử chính hãng tại việt nam';
			$this->load->image = 'SHOP PHỤ KIỆN ĐIỆN THOẠI';
			//TABLE SECTIONS
			$tableChangeColor = 'tbl_changecolor';
			$tableCat = 'tbl_cat';
			$tableCatPost = 'tbl_cate_post';
			$tableOneCatPost = 'tbl_onecatpost';
			$tablePro = 'tbl_product';
			$tablePost = 'tbl_post';
			$tableCatVideo = 'tbl_catvideo';	
			$tableBrand = 'tbl_brand';
			$tableSlider = 'tbl_slider';
			$tableInfo = 'tbl_info';
			//CONDITIONS SQL SECTION
			$condcolormenu = "activecolor=1";
			$cond = "parent_id = 0";
			$condsub = "parent_id != 0";
			//MODELS SECTION
			$PostModel = $this->load->model('PostModel');
			$modelName = $this->load->model('CatModel');
			$ProductModel = $this->load->model('ProductModel');
			$CustomizeModel = $this->load->model('CustomizeModel');		
			$MediaModel = $this->load->model('MediaModel');	
			//GET DATABASE SECTION
			//paging product index page
			$this->load->countproduct = $ProductModel->countproductPaging($tablePro);
			$pagination_buttons = 4;
			$record_per_page = 10;
			$this->load->pagination_buttons = $pagination_buttons;
			$this->load->record_per_page = $record_per_page;
			$page_number = (isset($_GET['page']) AND !empty($_GET['page']))? $_GET['page']:1;
			$this->load->pagenumber = $page_number;
			$start_from = ($page_number - 1)*$record_per_page;
			$data['listproducthome'] = $ProductModel->ProductHomePaging($tablePro, $tableCat, $start_from, $record_per_page);
			$data['product_feathered'] = $ProductModel->listproduct_feadered($tablePro);
			//end paging product index page
			$cond_info = 'infoId = 1';
			$data['info'] = $ProductModel->listInfo($tableInfo,$cond_info);
			$data['allproduct'] = $ProductModel->allproduct_home($tablePro);
			$data['catvideo'] = $MediaModel->listCatVideo($tableCatVideo);
			$data['allcatlist'] = $modelName->allCategoryHome($tableCat,$cond);
			$data['allsubcatlist'] = $modelName->allSubCategory($tableCat);
			$data['listposthome'] = $PostModel->listPostHome_limit($tablePost, $tableCatPost);
			$data['catlistposthome'] = $modelName->listCategoryPostHome($tableCatPost);
			$data['catsublistpost'] = $modelName->listSubCategoryPost($tableCatPost,$condsub);
			$data['onecatpost'] = $modelName->listOneCategoryPost($tableOneCatPost);
			$data['changecolormenu'] = $CustomizeModel->selectColorToChange($tableChangeColor,$condcolormenu);
			$data['postfooter'] = $PostModel->allPostFooter($tablePost);
			$data['postfeathered'] = $PostModel->PostFeatheredHome($tablePost);
			$data['list_slider'] = $CustomizeModel->selectSlide_home($tableSlider);
			//THEMES SECTION
			$this->load->view('header');
			$this->load->view('topbar',$data);
			$this->load->view('menu',$data);
			$this->load->view('slider',$data);
			$this->load->view('home',$data);
			$this->load->view('footer',$data);

		}
		public function notFound(){
			Session::init();  
			//TABLE SECTION
			$tablePost = 'tbl_post';
			$tableCat = 'tbl_cat';
			$tableCatPost = 'tbl_cate_post';
			$tablePro = 'tbl_product';
			$tableOneCatPost = 'tbl_onecatpost';
			$tableInfo = 'tbl_info';
			$tableCatVideo = 'tbl_catvideo';
			//CONDITIONS SQL SECTION
			$cond = "parent_id = 0";
            $condsub = "parent_id != 0";
            //MODELS SECTION
            $PostModel = $this->load->model('PostModel');
			$CateModel = $this->load->model('CatModel');			
			$MediaModel = $this->load->model('MediaModel');	
			$ProductModel = $this->load->model('ProductModel');	
			//GET DATABASE SECTION
			$data['catvideo'] = $MediaModel->listCatVideo($tableCatVideo);	
			$data['allcatlist'] = $CateModel->allCategory($tableCat,$cond);
            $data['allsubcatlist'] = $CateModel->allSubCategory($tableCat);
           	$data['onecatpost'] = $CateModel->listOneCategoryPost($tableOneCatPost);
            $data['catlistposthome'] = $CateModel->listCategoryPostHome($tableCatPost);
            $data['catsublistpost'] = $CateModel->listSubCategoryPost($tableCatPost,$condsub);
			$data['postfooter'] = $PostModel->allPostFooter($tablePost);
			$data['postfeathered'] = $PostModel->PostFeatheredHome($tablePost);
			$cond_info = 'infoId = 1';
			$data['info'] = $ProductModel->listInfo($tableInfo,$cond_info);
			//META SECTION
			$this->load->title = '404 Không tìm thấy trang';
            //THEMES SECTION
			$this->load->view('header');
			$this->load->view('topbar',$data);
			$this->load->view('menu',$data);
			$this->load->view('404',$data);
			$this->load->view('footer',$data);

			
		}

	}

?>