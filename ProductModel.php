	<?php

		class ProductModel extends DModel
		{
			
			function __construct()
			{
				parent::__construct();
			}
			public function update_color_price($tableProductColor,$data,$cond){
				return $this->db->update($tableProductColor,$data,$cond);
			}
			public function SelectColorById($tableProductColor,$cond){
				$query = "SELECT * from $tableProductColor where $cond";
				return $this->db->select($query);
			}
			public function ImageColor($tableProductColor,$id){
				$query = "SELECT * from $tableProductColor where product_id='$id'";
				return $this->db->select($query);
			}
			public function update_product_color($tableProduct,$data_product,$cond_update){
				return $this->db->update($tableProduct,$data_product,$cond_update);
			}
			public function ProductColor($tableProductColor){
					$query = "SELECT * from $tableProductColor";
				return $this->db->select($query);
			}
			public function productcolor_by_id($tableProductColor,$id_product){
				$sql = "SELECT COUNT($tableProductColor.product_id) FROM $tableProductColor where $tableProductColor.product_id='$id_product'";
					return $this->db->countRow($sql);
			}
			public function fetch_product_by_cat($tableProduct,$tableCat,$cond){
				$query = "SELECT $tableProduct.*,$tableCat.catName,$tableCat.catId from $tableProduct,$tableCat where $cond";
				return $this->db->select($query);
			}
			public function get_variants($tableChangeColor,$tableProductColor,$cond_variant){
				$query = "SELECT * from $tableChangeColor,$tableProductColor where $cond_variant";
				return $this->db->select($query);
			}
			public function CountColor($tableProductColor,$id){
			$sql = "SELECT COUNT(*) from $tableProductColor where product_id='$id'";
				return $this->db->countRow($sql);
			}
			public function getPriceByColor($tableChangeColor,$tableProductColor,$cond){
					$query = "SELECT * from $tableChangeColor,$tableProductColor where $cond";
				return $this->db->select($query);
			}
			public function DelColorById($tableProductColor,$cond){
				return $this->db->delete($tableProductColor, $cond);
			}
			public function ColorProductById($tableProduct, $id){
				$query = "SELECT * from $tableProduct where productId = '$id'";
				return $this->db->select($query);
			}
			public function ColorById($tableProductColor,$tableChangeColor,$tableProduct,$id){
				$query = "SELECT * from $tableProductColor,$tableChangeColor,$tableProduct where $tableProductColor.product_id = $tableProduct.productId AND $tableProductColor.color = $tableChangeColor.changeId AND $tableProductColor.product_id ='$id'";
				return $this->db->select($query);
			}
			public function search_product($tablePro,$search){
				$sql = "SELECT * FROM $tablePro WHERE productName LIKE '%$search%' ORDER BY productId desc";
				return $this->db->select($sql);
			}
			public function listproduct_feadered($tablePro){
				$sql = "SELECT * FROM $tablePro WHERE type='1' ORDER BY productId desc";
				return $this->db->select($sql);
			}
			public function allproduct_home($tablePro){
				$sql = "SELECT * FROM $tablePro ORDER BY price DESC ";
				return $this->db->select($sql);
			}
			public function get_max_price($tableProduct){
				$sql = "SELECT MAX($tableProduct.price) FROM $tableProduct";
				return $this->db->select($sql);
			}
			public function get_min_price($tableProduct){
				$sql = "SELECT MIN($tableProduct.price) FROM $tableProduct";
				return $this->db->select($sql);
			}
			public function select_upload_file($tableProduct,$cond){
				$sql = "SELECT * FROM $tableProduct WHERE $cond";
				return $this->db->select($sql);
			}
			public function upload_file($tableProduct,$data,$cond){
				return $this->db->update($tableProduct,$data,$cond);
			}
			public function count_rating($tableRating,$id){
				$sql = "SELECT AVG($tableRating.rating) as rating from $tableRating where productId='$id'";
				return $this->db->select($sql);
			}
			public function insert_rating_start($tableRating,$data){
				return $this->db->insert($tableRating,$data);
			}
			public function change_type_pro($tableProduct,$data,$cond_type){
				$this->db->update($tableProduct,$data,$cond_type);
			}
			public function change_active_pro($tableProduct,$data,$cond_pro){
				$this->db->update($tableProduct,$data,$cond_pro);
			}
			public function countproductPaging($tablePro){
			$sql = "SELECT COUNT(*) from $tablePro order by productId desc";
				return $this->db->countRow($sql);
			}
			public function countproduct_bycate_paging($tableProduct,$tableCat,$id){
				$sql = "SELECT COUNT(*) from $tableProduct,$tableCat where $tableProduct.catId = $tableCat.catId and $tableProduct.catId = $id order by $tableProduct.productId desc";
				return $this->db->countRow($sql);
			}

			public function AddProductDetailId($tableProperty,$data){
				return $this->db->insert($tableProperty,$data);
			}
			public function NewestProduct($tableProduct){
				$sql = "SELECT $tableProduct.productId,$tableProduct.productName FROM $tableProduct ORDER BY $tableProduct.productId DESC LIMIT 1";
				return $this->db->select($sql);
			}
			public function sorting($tableProduct,$tableCat,$catId,$cond){
				$sql = "SELECT $tableProduct.*,$tableCat.catId from $tableProduct,$tableCat where $tableCat.catId=$tableProduct.catId AND $tableProduct.catId=$catId $cond";
				return $this->db->filterRow($sql);
			}
			public function countsorting($result){
				$sql = "SELECT COUNT(*)";
				return $this->db->filterCount($sql);
			}
			public function ProductHomePaging($tablePro, $tableCat, $start_from, $record_per_page){
				$query = "SELECT $tablePro.*, $tableCat.catName, $tableCat.catId from $tablePro,$tableCat
				WHERE  $tablePro.catId = $tableCat.catId order by $tablePro.productId desc
					LIMIT $start_from, $record_per_page";
				return $this->db->select($query);
			}
			public function ProductCategoryHome_Paging($tableProduct, $tableCat, $start_from, $record_per_page,$id){
				$query = "SELECT $tableProduct.*, $tableCat.catName, $tableCat.catId from $tableProduct,$tableCat
				WHERE  $tableProduct.catId = $tableCat.catId AND $tableProduct.catId = $id order by $tableProduct.productId desc
					LIMIT $start_from, $record_per_page";
				return $this->db->select($query);
			}
			public function filter_advance($tableProduct,$tableAttribute,$tableDetailAttribute,$tableCat,$tableProperty,$catId,$cond){
				$sql = "SELECT $tableProduct.*,$tableCat.catId,$tableAttribute.attribute_id,$tableDetailAttribute.detail_attribute_id,$tableProperty.* from $tableProduct,$tableAttribute,$tableDetailAttribute,$tableProperty,$tableCat where $tableProduct.productId=$tableProperty.productId AND $tableCat.catId=$tableProperty.catId $cond group by $tableProduct.productId";

				return $this->db->filterRow($sql);
			}
			public function countFilter($result){
				$sql = "SELECT COUNT(*)";
				return $this->db->filterCount($sql);
			}
			
			public function filterpriceproduct($tableProduct,$tableBrand,$tableCat,$condcat){
				$sql = "SELECT $tableProduct.* ,$tableCat.catId,$tableCat.catName,$tableBrand.brandName from $tableProduct,$tableCat,$tableBrand where $condcat";
				return $this->db->select($sql);
			}
			public function listRam($tableProduct){
				$sql = "SELECT DISTINCT($tableProduct.ram) from $tableProduct order by ram asc";
				return $this->db->select($sql);
			}
			public function listStorage($tableProduct){
				$sql = "SELECT DISTINCT($tableProduct.storage) from $tableProduct order by storage asc";
				return $this->db->select($sql);
			}
			public function listInfo($tableInfo,$cond){
				$sql = "SELECT * FROM $tableInfo where $cond";
				return $this->db->select($sql);
			}
			public function countProduct($tablePro){
				$sql = "SELECT COUNT(*) FROM $tablePro";
				return $this->db->countRow($sql);
			}
			public function countProductActive($tablePro){
				$sql = "SELECT COUNT(*) FROM $tablePro where action = '0'";
				return $this->db->countRow($sql);
			}
			public function countProductInActive($tablePro){
				$sql = "SELECT COUNT(*) FROM $tablePro where action = '1'";
				return $this->db->countRow($sql);
			}
			public function countProductfeathered($tablePro){
				$sql = "SELECT COUNT(*) FROM $tablePro where type = '0'";
				return $this->db->countRow($sql);
			}
			public function countProductCat($tableProduct,$tableCat,$id){
				$sql = "SELECT COUNT(*) FROM $tableProduct, $tableCat where $tableProduct.catId = $tableCat.catId AND $tableProduct.catId = $id";
				return $this->db->countRow($sql);
			}
			public function select_image_galley($tableGallery,$cond){
				$sql = "SELECT COUNT(*) FROM $tableGallery where $cond";
				return $this->db->countRow($sql);
			}
			public function AddGallery($tableGal,$data){
				return $this->db->insert($tableGal, $data);
			}
			public function uploaded_multi_image($tableGallery,$data){
				return $this->db->insert($tableGallery, $data);
			}
			public function UpdateInfo($tableInfo,$data,$cond){
				return $this->db->update($tableInfo, $data, $cond);
			}
			public function UpdateProduct($tablePro,$data,$cond){
				return $this->db->update($tablePro, $data, $cond);
			}
			public function UpdateInAction($tablePro,$data,$cond,$a){
				return $this->db->updateinAction($tablePro,$data,$cond,$a);
			}
			public function updateProductById($tablePro, $id){
				$query = "SELECT * from $tablePro where productId = '$id'";
				return $this->db->select($query);
			}
			public function unlinkMultigallerybyId($tableGal, $id){
				$query = "SELECT * from $tableGal where productId = '$id'";
				return $this->db->select($query);
			}
			public function delMultigallerybyId($tableGal, $cond){
				return $this->db->delete($tableGal, $cond);
			}
			public function delProductById($tablePro, $cond){
				return $this->db->delete($tablePro, $cond);
			}
			public function DelInAction($tablePro,$cond,$a){
				return $this->db->deleteInAction($tablePro,$cond,$a);
			}
			public function change_active_gallery($tableGallery,$data,$cond_gallery){
				return $this->db->update($tableGallery,$data,$cond_gallery);
			}
			public function delGalleryById($tableGal, $cond){
				return $this->db->delete($tableGal, $cond);
			}
			public function update_gallery($tableGallery,$data,$cond){
				return $this->db->update($tableGallery,$data,$cond);
			}
			public function select_image_name_by_id($tableGallery,$cond){
				$query = "SELECT * from $tableGallery where $cond";
				return $this->db->select($query);
			}
			public function gallerybyId($tableGal, $id){
				$query = "SELECT * from $tableGal where galleryId = '$id'";
				return $this->db->select($query);
			}
			public function gallery_by_product_id($tableGal, $id){
				$query = "SELECT * from $tableGal where $tableGal.productId = '$id' order by $tableGal.galleryId desc";
				return $this->db->select($query);
			}
			public function CatFromProduct($tableProduct, $catid){
				$query = "SELECT $tableProduct.catId from $tableProduct where catId = '$catid'";
				return $this->db->select($query);
			}
			public function listProduct($tablePro, $tableCat, $tableBrand){
				$query = "SELECT $tablePro.*, $tableBrand.brandId,$tableBrand.brandName , $tableCat.catId, $tableCat.catName from $tablePro,$tableCat,$tableBrand
				WHERE  $tablePro.catId = $tableCat.catId and $tableBrand.BrandId = $tablePro.BrandId order by  $tablePro.productId desc
				";
				return $this->db->select($query);
			}
			
			public function listProductHome($tablePro, $tableCat, $tableBrand){
				$query = "SELECT $tablePro.*, $tableBrand.brandId,$tableBrand.brandName , $tableCat.catId, $tableCat.catName from $tablePro,$tableCat,$tableBrand
				WHERE  $tablePro.catId = $tableCat.catId and $tableBrand.BrandId = $tablePro.BrandId order by  $tablePro.productId desc
				";
				return $this->db->select($query);
			}
			public function delAttr($tableAttr, $cond){
				return $this->db->delete($tableAttr, $cond);
			}
			public function AttributeById($tableAttr){
				$query = "SELECT * from $tableAttr";
				return $this->db->select($query);
			}
			public function listProductPaging($tablePro, $tableCat,$paging){
				$query = "SELECT $tablePro.*, $tableCat.catId, $tableCat.catName from $tablePro,$tableCat
				WHERE  $tablePro.catId = $tableCat.catId order by  $tablePro.productId desc LIMIT $paging,6
				";
				return $this->db->select($query);
			}
			public function listProductPagingAjax($tablePro, $tableCat,$start_from,$record_per_page){
				$query = "SELECT $tablePro.*, $tableCat.catId, $tableCat.catName from $tablePro,$tableCat
				WHERE  $tablePro.catId = $tableCat.catId order by  $tablePro.productId desc LIMIT $start_from,$record_per_page
				";
				return $this->db->select($query);
			}
			public function ProductByCatPaging($tableProduct,$tableCat, $paging,$id){
				$query = "SELECT $tableProduct.*, $tableCat.catName from $tableProduct , $tableCat where $tableProduct.catId = $tableCat.catId and $tableProduct.catId = '$id' order by  $tableProduct.productId desc LIMIT $paging,5";
				return $this->db->select($query);
			}
			public function listGallery($tableGallery,$tablePro){
				$query = "SELECT * from $tableGallery,$tablePro where $tableGallery.productId = $tablePro.productId  order by $tableGallery.galleryId desc";
				return $this->db->select($query);
			}
			public function listGal($tableGal, $id){
				$query = "SELECT * from $tableGal where $tableGal.productId = '$id' order by $tableGal.galleryId desc";
				return $this->db->select($query);
			} 
			public function allProduct($tableProduct){
				$query = "SELECT * from $tableProduct order by productId desc";
				return $this->db->select($query);
			}
			public function ProductByCatHome_AdvandeFilter($tableProduct,$tableCat, $catId){
				$query = "SELECT $tableProduct.*, $tableCat.catName from $tableProduct , $tableCat where $tableProduct.catId = $tableCat.catId and $tableProduct.catId = '$catId' order by $tableProduct.price DESC";
				return $this->db->select($query);
			}
			public function ProductByCatHome($tableProduct,$tableCat, $id){
				$query = "SELECT $tableProduct.*, $tableCat.catName from $tableProduct , $tableCat where $tableProduct.catId = $tableCat.catId and $tableProduct.catId = '$id' order by $tableProduct.price DESC";
				return $this->db->select($query);
			}
			public function ProductCatFilter($tableProduct, $tableCat, $cat){
				$query = "SELECT $tableProduct.*, $tableCat.catName from $tableProduct , $tableCat where $tableProduct.catId = $tableCat.catId and $tableProduct.catId = '$cat' order by $tableProduct.productId desc";
				return $this->db->select($query);
			}
			public function ProductDetails($tableProduct, $tableCat , $id){
					$query = "SELECT $tableProduct.*, $tableCat.catName,$tableCat.catId from $tableProduct , $tableCat where $tableProduct.catId = $tableCat.catId and $tableProduct.productId = '$id'";
				return $this->db->select($query);
			}
			public function ProductDetailsHome($tableProduct, $tableCat ,$tableBrand, $id){
					$query = "SELECT $tableProduct.*, $tableCat.catName,$tableCat.catId,$tableBrand.brandName from $tableProduct , $tableCat,$tableBrand where $tableProduct.catId = $tableCat.catId and $tableProduct.brandId=$tableBrand.brandId AND $tableProduct.productId = '$id' LIMIT 1";
				return $this->db->select($query);
			}
			public function ProductRelatedHome($tableProduct,$tableCat,$idcat,$id){
					$query = "SELECT $tableProduct.*, $tableCat.catName,$tableCat.catId from $tableProduct , $tableCat where $tableProduct.catId = $tableCat.catId and $tableProduct.catId = '$idcat' AND $tableProduct.productId NOT IN('$id') order by $tableProduct.productId desc LIMIT 8";
				return $this->db->select($query);
			}
			public function AddProduct($tablePro,$data){
				return $this->db->insert($tablePro, $data);
			}
			public function InsertAttr($tableAttr,$data){
				return $this->db->insert($tableAttr, $data);
			}
			public function InsertMoreAttr($tableAttr,$data){
				return $this->db->insert($tableAttr, $data);
			}
			public function UpdateMoreAttr($tableAttr,$data,$cond){
				return $this->db->update($tableAttr, $data,$cond);
			}
			public function SelectCity($tableCity){
				$query = "SELECT * from $tableCity";
				return $this->db->select($query);
			}
			public function SelectDistrict($tableDist){
				$query = "SELECT * from $tableDist";
				return $this->db->select($query);
			}
			public function SelectDistrictById($tableDist,$cityId){
				$query = "SELECT * from $tableDist where matp = '$cityId'";
				return $this->db->select($query);
			}

		}




	?>