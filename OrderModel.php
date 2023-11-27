<?php

class OrderModel extends DModel
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function get_all_color($tableChangeColor){
		$query = "SELECT * from $tableChangeColor";
		return $this->db->select($query);
	}
	public function get_product_color($tableProductColor){
		$query = "SELECT * from $tableProductColor";
		return $this->db->select($query);
	}
	public function Count_Ordered($tableCart,$tableRegisters,$id){
		$sql = "SELECT COUNT(DISTINCT $tableCart.order_id) FROM $tableCart where register_id = '$id'";
		return $this->db->countRow($sql);
	}
	public function CountAllOrder($tableCart){
		$sql = "SELECT COUNT(DISTINCT $tableCart.order_id) FROM $tableCart";
		return $this->db->countRow($sql);
	}
	public function CountAllOrder_Pending($tableCart){
		$sql = "SELECT COUNT(DISTINCT $tableCart.order_id) FROM $tableCart where status='0'";
		return $this->db->countRow($sql);
	}
	public function CountAllOrder_NotPay($tableCart){
		
		$sql = "SELECT COUNT(DISTINCT $tableCart.order_id) FROM $tableCart where solve='0'";
		return $this->db->countRow($sql);
	}
	public function CountAllOrder_NotDeliver($tableCart){
		
		$sql = "SELECT COUNT(DISTINCT $tableCart.order_id) FROM $tableCart where deliver='0'";
		return $this->db->countRow($sql);
	}
	public function filter_order_by_pending($tableRegisters,$tableCart,$solve){
		$query = "SELECT * from $tableRegisters,$tableCart where $tableCart.status = '$solve' group by $tableCart.order_id 
		 ";
		return $this->db->select($query);
	}
	public function filter_order_by_notpay($tableRegisters,$tableCart,$status){
		$query = "SELECT * from $tableRegisters,$tableCart where $tableCart.solve = '$status' group by $tableCart.order_id 
		 ";
		return $this->db->select($query);
	}
	public function filter_order_by_paynotdelivery($tableRegisters,$tableCart,$delivery){
		$query = "SELECT * from $tableRegisters,$tableCart where $tableCart.deliver = '$delivery' group by $tableCart.order_id 
		 ";
		return $this->db->select($query);
	}
	public function detail_customer_by_order_id($tableCart,$order_id){
		$query = "SELECT * from $tableCart where $tableCart.order_id='$order_id' GROUP BY $tableCart.order_id
		 ";
		return $this->db->select($query);
	}
	public function get_detail_products($tablePro,$tableCart,$order_id){
		$query = "SELECT * from $tablePro,$tableCart where $tablePro.productId = $tableCart.productId AND $tableCart.order_id = '$order_id'
		 ";
		return $this->db->select($query);
	}
	public function get_customer_by_id($tableCart,$id){
		$query = "SELECT * from $tableCart as a where 
		a.cartId = $id LIMIT 1
		 ";
		return $this->db->select($query);
	}
	public function FilterPayed($tableCart,$tableCus,$tablePro,$pay){
		$query = "SELECT * from $tableCus as a,$tablePro as b,$tableCart as c where 
		c.productId = b.productId and c.customerId = a.customerId and status='$pay' group by c.customerId order by c.customerId desc
		 ";
		return $this->db->select($query);
	}
	public function listOrder($tablePro,$tableCart){
		$query = "SELECT * from $tablePro as a,$tableCart as b where 
		a.productId = b.productId group by b.order_id order by b.datecreated desc 
		 ";
		return $this->db->select($query);
	}
	public function listOrder_home_limited($tablePro,$tableCart){
		$query = "SELECT * from $tablePro as a,$tableCart as b where 
		a.productId = b.productId group by b.customer_email order by b.datecreated desc LIMIT 4 
		 ";
		return $this->db->select($query);
	}
	public function invoice($tableCus,$tablePro,$tableCart){
		$query = "SELECT * from $tableCus as a,$tablePro as b,$tableCart as c where 
		c.productId = b.productId and c.customerId = a.customerId group by c.customerId order by c.customerId desc
		 ";
		return $this->db->select($query);
	}
	public function listOrderSearch($tableCus,$tablePro,$tableCart,$cond){
		$query = "SELECT * from $tableCus as a,$tablePro as b,$tableCart as c where 
		c.productId = b.productId and c.customerId = a.customerId and $cond group by c.customerId order by c.customerId desc
		 ";
		return $this->db->select($query);
	}
	public function listOrderById($tableCus,$tablePro,$tableCart,$id){
		$query = "SELECT * from $tableCus as a,$tablePro as b,$tableCart as c where 
		c.productId = b.productId and c.customerId = a.customerId and c.customerId = $id group by c.customerId order by c.customerId desc
		 ";
		return $this->db->select($query);

	}
	public function productByCustomer($tableCus,$tablePro,$tableCart,$id){
		$query = "SELECT * from $tableCus as a,$tablePro as b,$tableCart as c where 
		c.productId = b.productId and c.customerId = a.customerId and c.customerId = $id order by b.productId desc
		 ";
		return $this->db->select($query);

	}
	public function select_product_to_add($tablePro,$cond){
		$sql = "SELECT * FROM $tablePro where $cond";
		return $this->db->select($sql);
	}
	public function add_more_product_order($tableCart,$data,$cond){
		return $this->db->insert($tableCart,$data,$cond);
	}
	public function updateOrder($tableCart,$data,$cond){
		return $this->db->update($tableCart,$data,$cond);
	}
	public function update_ordered_product($tableCart,$data,$cond){
		return $this->db->update($tableCart,$data,$cond);
	}
	public function delOrder($tableCart,$cond){
		return $this->db->delete_in($tableCart,$cond);
	}
}

?>