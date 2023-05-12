<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../../lib/database.php');
	include_once  ($filepath.'/../../helpers/format.php');
 ?>




<?php 

	/**
	 * 
	 */
	class User
	{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function insert_Customer($data){
			$result=null;
			$alert="";
			$firstName = mysqli_real_escape_string($this->db->link, $data['first_name']);
			$lastName = mysqli_real_escape_string($this->db->link, $data['last_name']);
			$name = $firstName.' '.$lastName;
			$username = mysqli_real_escape_string($this->db->link, $data['username']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			$password = mysqli_real_escape_string($this->db->link, $data['password']);
			// $repeatpassword = mysqli_real_escape_string($this->db->link, $data['repeatpassword']);
			// $email = mysqli_real_escape_string($this->db->link, $data['email']);
			error_log("user here");

			if($name == "" || $username == ""  || $address == ""  || $password == "" ||$phone==""){
				$alert = '<span class="text-danger">Vui lòng không để trống thông tin</span>'; 
				return $alert;
				error_log($alert);
			}else{
				$check = "SELECT * FROM khachhang ";
				$result_check = $this->db->select($check);
					$data=mysqli_fetch_array($result_check);
					// $check_mail=$data['emailCus'];
					$check_username=$data['username'];
					error_log($check_username);
					// $check_phone=$data['phone'];
				if($username==$check_username){
					$alert = '<span class="text-danger">Username Tồn Tại</span>';
					error_log($alert);
					return $alert;
				}else{
						$password=md5($password);
						$query = "INSERT INTO khachhang( username ,  password ,  TenKH , diachi,phone) VALUES ('$username','$password','$name','$address','$phone')";
						$result = $this->db->insert($query);
						if($result){
							$alert = '<span class="text-success">Đăng ký khách hàng thành công</span>';
							error_log($alert);
							return $alert;
						}
						else{
							$alert = '<span class="text-danger">Lỗi. Đăng ký khách hàng thất bại</span>';
							error_log($alert);
								return $alert;	
						}
					}
					
			
				}
				

			return $result;
		}
		 // 
		public function Login_Customer($data){
			$username = mysqli_real_escape_string($this->db->link, $data['username']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));	
			error_log($username);
			error_log($password);
			$check = "SELECT * FROM khachhang WHERE (username= '$username')  AND password ='$password' limit 1";
				$result_check = $this->db->select($check);
				if($result_check){
					$value = $result_check-> fetch_assoc();
					Session::set('customer_login',true);
					Session::set('customer_user',$value['username']);
					Session::set('customer_name',$value['TenKH']);
					// error_log($value['username']);
					// error_log($value['TenKH']);
					header('location:trangchu');
				
				}else{
					$alert = '<span class="text-danger" > Sai tài khoản hoặc mật khẩu</span>'; 
					return $alert; 	
				}

			
		}

		public function Get_User($username){
			$query = "SELECT *
					  FROM khachhang 
					  WHERE username = '$username'";
			$result_check = $this->db->select($query);
			return $result_check;
		}

		public function Get_UserById($id){
			$query = "SELECT *
					  FROM khachhang 
					  WHERE MaKH = '$id'";
			$result_check = $this->db->select($query);
			return $result_check;
		}

		

		public function Update_Customer($data,$userr){
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			$password= mysqli_real_escape_string($this->db->link, $data['password']);
			if($name == ""   || $address == "" || $phone == "" ){
				$alert = "<span>Vui lòng không để trống thông tin</span>"; 
				return $alert;
			}else{
				if ($password=="") {
					$query = "UPDATE khachhang SET TenKH='$name',diachi='$address',phone='$phone' WHERE username = '$userr'";
					$result = $this->db->update($query);
					
					if($result){
						$alert = '<span class="text-success" >Cập nhật thông tin thành công</span>';
						return $alert;
					}else{
						$alert = '<span class="text-danger">Lỗi. Cập nhật thông tin không thành công</span>';
						return $alert;	
					}
				}else{
					$query = "UPDATE tbl_customer SET TenKH='$name',diachi='$address',phone='$phone',password=md5('$password') WHERE username = '$userr'";
					$result = $this->db->update($query);
					if($result){
						$alert = '<span class="text-success" >Cập nhật thông tin thành công </span>';						return $alert;
					}
					else{
						$alert = '<span class="text-danger">Lỗi. Cập nhật thông tin không thành công</span>';
						return $alert;	
					}
				}
			}
		}

		public function Show_CustomerAdmin(){
			$query = " SELECT khachhang.MaKH,khachhang.TenKH,khachhang.diachi,SUM(bienlai.tongtien) AS tongtien FROM `khachhang` ,`bienlai`GROUP BY khachhang.MaKH ";
			$result = $this->db->select($query);
			return $result;
		}

		



	}

 ?>