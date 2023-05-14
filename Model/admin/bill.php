<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../../lib/database.php');
	include_once  ($filepath.'/../../helpers/format.php');
 ?>




<?php 

	/**
	 * 
	 */
	class bill
	{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
				public function insert_Order($data,$buyerr){
			
			$name = mysqli_real_escape_string($this->db->link, $data['name']);	
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$total = 0;
			$session_id = session_id();
			$query = "SELECT * FROM tbl_cart WHERE ssId = '$session_id'";
			$get_cart = $this->db->select($query);
			if($get_cart){
				while ($result = $get_cart->fetch_assoc()) {
					$quantity = $result['quantity'];
					$price = $result['price'];
					$totalprice = $quantity * $price;
					$total +=$totalprice;
				}

			}
			
			$query_order = "INSERT INTO bienlai ( MaKH, status) VALUES ('$buyerr','Đang chờ xác nhận đơn hàng')";
			$insertOder = $this->db->insert($query_order);
			return $insertOder;
			}
		
		
		public function get_Bill_by_Customer($cus){

			$query = "SELECT * FROM bienlai WHERE MaKH = '$cus' ORDER BY MaBL DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_Bill(){

			$query = "SELECT * FROM bienlai ORDER BY MaBL DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function delete_Order($id){
			$query = "DELETE  FROM bienlai WHERE MaBL = '$id' ";
			$result = $this->db->delete($query);
			return $result;		
		}

		public function get_BillDetails($bill){

			$query = "SELECT * FROM chitietbienlai WHERE MaBienLai = '$bill'";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_Bill_by_Id($id){

			$query = "SELECT * FROM bienlai where MaBL = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function insert_OrderDetail($MaxId){
			$session_id = session_id();
			$query = "SELECT * FROM tbl_cart WHERE ssId = '$session_id'";
			$get_cart = $this->db->select($query);
			if($get_cart){
				while ($result = $get_cart->fetch_assoc()) {
					$productName = $result['productName'];
					$size = $result['size'];
					$quantity = $result['quantity'];
					$image = $result['image'];
					$price = $result['price'];
					$query = "INSERT INTO tbl_orderdetails(id_order, productName, size, quantity, image, price) VALUES ('$MaxId','$productName','$size','$quantity','$image','$price')";
					$insertOrderDetails = $this->db->insert($query);
					

				}
			}
			return $insertOrderDetails;
		}
		public function get_Bill_Max(){
			
			$query = "SELECT * FROM tbl_order WHERE order_Id= (SELECT max(order_Id) FROM tbl_order)";
			
			$get = $this->db->select($query);
			return $get;
		}
		public function show_Discount(){
			
			$query = "SELECT * FROM tbl_discount ";
			$result = $this->db->select($query);
			if($result){
				return $result;
			}
		}
		public function update_Status($status,$id){
			
			$id = mysqli_real_escape_string($this->db->link, $id);
			$status = mysqli_real_escape_string($this->db->link, $status);

			
			$query = "UPDATE bienlai SET status = '$status' WHERE MaBL = '$id'";
			$result = $this->db->update($query);
			error_log($query);
			if($result){
				$alert = "<span class='text-danger' >Update status thành công</span";
				return $alert;
				

			}
			else{
				$alert = "Lỗi. Update staus thất bại";
				return $alert;	
			}
			
		}
		public function totalprice(){
			$query = "SELECT SUM(ThanhTien)  as 'total' FROM chitietbienlai ";
			$result = $this->db->select($query);
			if($result){
				return $result;
			}
		}

		public function getPending(){
			$query = "SELECT Count(status)  as 'status' FROM bienlai WHERE status = 'Đang chờ xác nhận đơn hàng'";
			$result = $this->db->select($query);
			if($result){
				return $result;
			}
		}
		public function deleteBill($id){
			$query = "DELETE  FROM tbl_order WHERE order_Id = '$id' ";
			$result = $this->db->delete($query);
			return $result;		
		}
		public function CountProduct(){
			$query = "SELECT COUNT(quantity) as A FROM tbl_orderdetails";
			$insert = $this->db->insert($query);

		}

		public function getHistoryBill($id){
			$query = "
			WITH MaSPList AS (
				SELECT bd.MaSP, bd.SoLuong, bd.DonGia, bd.ThanhTien, bd.NgayXuat
				FROM chitietbienlai bd
				JOIN bienlai b ON bd.MaBienLai = b.MaBL
				WHERE b.MaKH = $id AND b.status = 'Đã thanh toán'
			  )
			  SELECT s.MaSP,s.TenSP,s.HinhAnh, c.SoLuong, c.DonGia, c.ThanhTien, c.NgayXuat
			  FROM sanpham s
			  JOIN MaSPList c ON s.MaSP = c.MaSP;
			";
			$result = $this->db->select($query);
			return $result;
		}

	}
 ?>