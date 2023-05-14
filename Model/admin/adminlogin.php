<?php  
	$filepath = realpath(dirname(__FILE__));
	include_once ("../../lib/session.php");
	Session::checkLogin();
	include_once ($filepath.'/../../lib/database.php');
	include_once  ($filepath.'/../../helpers/format.php');


 ?>


<?php 

	/**
	 * 
	 */
	class adminlogin
	{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function login_admin($admin_User,$admin_Pass){

			$admin_User = $this->fm->validation($admin_User);
			$admin_Pass = $this->fm->validation($admin_Pass);

			$admin_User = mysqli_real_escape_string($this->db->link, $admin_User);
			$admin_Pass = mysqli_real_escape_string($this->db->link, $admin_Pass);

			$query = "SELECT * FROM nhanvien WHERE username = '$admin_User' AND password = '$admin_Pass' LIMIT 1";
			$result = $this->db->select($query);

			if($result == false){
				$alert = "Tài khoản hoặc mật khẩu không đúng";
				return $alert;
					
			}else{
					
				$value = $result->fetch_assoc();

				Session::set('adminlogin',true);
				Session::set('admin_Id',$value['MaNV']);
				Session::set('admin_User',$value['username']);
				Session::set('Name',$value['TenNV']);
				Session::set('level',$value['MaChucVu']);
				header('Location:index.php');
			}
		}

	}
 ?>