<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../../lib/database.php');
	include_once  ($filepath.'/../../helpers/format.php');
 ?>




<?php 

	/**
	 * 
	 */
	class category
	{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function insert_category($catName){

			$catName = $this->fm->validation($catName);
			// $catSize = $this->fm->validation($catSize);
			$catName = mysqli_real_escape_string($this->db->link, $catName);
			// $catSize = mysqli_real_escape_string($this->db->link, $catSize);

			if(empty($catName)){
				$alert = "Vui lòng điền thông tin danh mục";
				return $alert;
			}else{
				$query = "INSERT INTO loaisp(TenLoaiSP) VALUES ('$catName')";
				$result = $this->db->insert($query);
				if($result){
					$alert = "Thêm danh mục thành công";
					return $alert;

				}
				else{
					$alert = "Lỗi. Thêm danh mục thất bại";
					return $alert;	
				}

			}
			
		}

		public function getAllCategory(){
			$query = "SELECT * FROM loaisp ";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_category(){
			$query = "SELECT * FROM loaisp GROUP BY TenLoaiSP order by MaLoaiSP desc ";
			$result = $this->db->select($query);
			return $result;
		}
		public function getnamebyId($name){
			$query = "SELECT * FROM loaisp WHERE TenLoaiSP = '$name' group by TenLoaiSP";
			$result = $this->db->select($query);
			return $result;
		}

		public function getIdByName($id){
			$query = "SELECT MaLoaiSP FROM loaisp WHERE TenLoaiSP = '$name' ";
			$result = $this->db->select($query);
			return $result['MaLoaiSP'];
		}

		public function getSizebyCat($cat){
			$query = "SELECT * FROM loaisp WHERE TenLoaiSP = '$cat'";
			$result = $this->db->select($query);
			return $result;
		}


		public function update_Category($catName,$name){
			$catName = $this->fm->validation($catName);
			
			$catName = mysqli_real_escape_string($this->db->link, $catName);
			
			$name = mysqli_real_escape_string($this->db->link, $name);

			if(empty($catName)){
				$alert = "Vui lòng điền thông tin danh mục";
				return $alert;
			}else{
				$query = "UPDATE loaisp SET TenLoaiSP = '$catName'  WHERE TenLoaiSP = '$name'";
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success' >Update danh mục thành công</span";
					return $alert;

				}
				else{
					$alert = "Lỗi. Thêm danh mục thất bại";
					return $alert;	
				}

			}
		}
		public function delete_Category($name){
			$query = "DELETE  FROM loaisp WHERE TenLoaiSP = '$name' ";
			$result = $this->db->delete($query);
			return $result;		
		}
	}
 ?>