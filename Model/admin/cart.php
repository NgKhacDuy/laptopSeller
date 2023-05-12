<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../../lib/database.php');
	include_once  ($filepath.'/../../helpers/format.php');
 ?>




<?php 

	/**
	 * 
	 */
	class cart
	{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function AddToCart($idPro,$idCus){
			$idPro = mysqli_real_escape_string($this->db->link, $idPro);
			$idCus = mysqli_real_escape_string($this->db->link, $idCus);
			$query = "insert into giohang (MaSP,MaKH,SoLuong) values ('$idPro','$idCus',1)";
			$result = $this->db->insert($query);
		}
		
		public function cartToBill($idCus,$totalMoney){
			$query="INSERT INTO bienlai (MaKH,tongtien) VALUES ('$idCus','$totalMoney');";
			error_log($query);
			$result = $this->db->insert($query);
			$queryTemp = "SELECT MaBL from bienlai where MaKH = $idCus ORDER BY MaBL DESC LIMIT 1";
			error_log($queryTemp);
			$resultTemp = $this->db->select($queryTemp);
			$id=mysqli_fetch_array($resultTemp);
			$query2="SELECT MaSP,SoLuong from giohang WHERE MaKH = '$idCus';";
			error_log($query2);
			$result2 = $this->db->select($query2);
			while($data=mysqli_fetch_array($result2)){
				$idBienLai = $id['MaBL'];
				$quantityCart = $data['SoLuong'];
				$idPro = $data['MaSP'];
				$query3="select * from sanpham where MaSP = '$idPro'";
				error_log($query3);
				$result3 = $this->db->select($query3);
				$product = mysqli_fetch_array($result3);
				$productName = $product['TenSP'];
				$productPrice = $product['Gia'];
				$thanhtien = $quantityCart*$productPrice;
				$query4="INSERT into chitietbienlai (MaBienLai,MaSP,TenSP,SoLuong,DonGia,ThanhTien) VALUES ('$idBienLai','$idPro','$productName','$quantityCart','$productPrice','$thanhtien')";
				error_log($query4);
				$result4 = $this->db->insert($query4);
			}
			$query5="DELETE FROM giohang where MaKH = '$idCus'";
			$result5 = $this->db->delete($query5);
		}

		public function get_Cart($idCus){
			$query = "SELECT * FROM giohang WHERE MaKH = '$idCus'";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function getCartById($id){
			$query = "SELECT bd.TenSP, bd.SoLuong, bd.DonGia, bd.ThanhTien,b.ngaytao,b.status
			FROM bienlai b
			JOIN chitietbienlai bd ON b.MaBL = bd.MaBienLai
			WHERE b.MaKH = '$id'
			ORDER BY b.ngaytao DESC
			";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function update_Slcart($quantity,$idPro,$idCus,$idCart){
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);
			$idPro = mysqli_real_escape_string($this->db->link, $idPro);
			$idCus = mysqli_real_escape_string($this->db->link, $idCus);
			$idCus = mysqli_real_escape_string($this->db->link, $idCus);
			if($quantity <= 0){
				
				
			}
			else{
				$query1 = "UPDATE giohang SET soluong = '$quantity',MaSP = '$idPro' WHERE MaKH = '$idCus' and MaGioHang = '$idCart'";
				$result1 = $this->db->update($query1);
				if($result1){
					// header('Location:cart.php');
				}
				
			}
			

		}
		public function deleteProfromCart($idPro,$idCus){
			$query = "delete from giohang where MaSP = $idPro and MaKH = $idCus";	
			$result = $this->db->delete($query);
		}
		public function delete_cart($cartId){
			$query = "DELETE  FROM tbl_cart WHERE cartId = '$cartId' ";
			$result = $this->db->delete($query);
			if($result){
					header('Location:cart.php');
				}
		}

		public function Del_cart_by_Session(){

			$session_id = session_id();
			$query = "DELETE FROM tbl_cart WHERE ssId = '$session_id'";
			$result = $this->db->delete($query);
			return $result;
		}

		public function get_Max_Id(){
			
			$query = "SELECT order_Id FROM tbl_order WHERE order_Id= (SELECT max(order_Id) FROM tbl_order)";
			// $query = "SELECT order_Id FROM tbl_order ORDER By order_Id DESC LIMIT 1";
			$get = $this->db->select($query);
			return $get;
		}



		
		public function get_id(){
			
			$query = "SELECT * FROM tbl_discount ";
			$result = $this->db->select($query);
			if($result){
				return $result;
			}
		}
		public function insert_Discount($code,$discount){

			$code = $this->fm->validation($code);
			$code = mysqli_real_escape_string($this->db->link, $code);

			$discount = $this->fm->validation($discount);
			$discount = mysqli_real_escape_string($this->db->link, $discount);
			if(empty($code) || empty($discount)){
				$alert = "Vui lòng điền thông tin ";
				return $alert;
			}else{
				$query = "INSERT INTO tbl_discount(code, discount) VALUES ('$code', '$discount')";
				$result = $this->db->insert($query);
				if($result){
					// $alert = "Thêm brand thành công";
					// return $alert;
					header('Location:discount.php');

				}
				else{
					$alert = "Lỗi. Thêm discount thất bại";
					return $alert;	
				}

			}
			
		}

		public function delete_Discount($id){
			$query = "DELETE FROM tbl_discount WHERE id_discount = '$id' ";
			$result = $this->db->delete($query);
			$alert = "<span>Xóa thàh công</span";
			return $alert;
		}
		public function get_Discount($code){
			
			$query = "SELECT * FROM tbl_discount WHERE code = '$code'";
			$result = $this->db->select($query);
			if($result){
				return $result;
			}
		} 
	}
 ?>