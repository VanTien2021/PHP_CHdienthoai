<?php
 class account extends DController

 {

 	

 	public function __construct()

	{

		parent::__construct();

		$data = array();

	}

	public function Index(){

		$this->load->active = 'active';

		$this->account_home();

			

	}

	public function account_home(){

			Session::init();    

			//META SECTIONS

			$this->load->title = 'SHOP PHỤ KIỆN MÁY TÍNH';

			$this->load->desc = 'SHOP PHỤ KIỆN MÁY TÍNH';

			$this->load->keywords = 'SHOP PHỤ KIỆN MÁY TÍNH';

			$this->load->image = 'SHOP PHỤ KIỆN MÁY TÍNH';

			//TABLE SECTIONS

			$tableChangeColor = 'tbl_changecolor';

			$tableCat = 'tbl_cat';

			$tableCatPost = 'tbl_cate_post';

			$tableOneCatPost = 'tbl_onecatpost';

			$tablePro = 'tbl_product';

			$tablePost = 'tbl_post';

			$tableCatVideo = 'tbl_catvideo';	

			$tableBrand = 'tbl_brand';

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

			$data['catvideo'] = $MediaModel->listCatVideo($tableCatVideo);

			$data['allcatlist'] = $modelName->allCategoryHome($tableCat,$cond);

			$data['allsubcatlist'] = $modelName->allSubCategory($tableCat);

			$data['catlistposthome'] = $modelName->listCategoryPostHome($tableCatPost);

			$data['catsublistpost'] = $modelName->listSubCategoryPost($tableCatPost,$condsub);

			$data['onecatpost'] = $modelName->listOneCategoryPost($tableOneCatPost);

			$data['changecolormenu'] = $CustomizeModel->selectColorToChange($tableChangeColor,$condcolormenu);

			$data['postfooter'] = $PostModel->allPostFooter($tablePost);

			$data['postfeathered'] = $PostModel->PostFeatheredHome($tablePost);

			//THEMES SECTION

			$this->load->view('header');

			$this->load->view('topbar',$data);

			$this->load->view('slider',$data);

			$this->load->view('menu',$data);

			$this->load->view('sidebar',$data);

			$this->load->view('account',$data);

			$this->load->view('footer',$data);

		}

 }

?>