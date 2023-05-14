 <?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../../lib/database.php');
	include_once  ($filepath.'/../../helpers/format.php');
 ?>



<?php 

	/**
	 * 
	 */
	class product
	{
		private $db;
		private $fm;
		

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function insert_product($data,$files){
			// $prodName = $this->fm->validation($prodName);
			// $prodSize = $this->fm->validation($prodSize);


			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$quantity = mysqli_real_escape_string($this->db->link, $data['quantity']);

			$permited=array('jpg','jpeg','png','gif');
	    	$file_name=$_FILES['image']['name'];
	    	$file_size=$_FILES['image']['size'];
	    	$file_temp=$_FILES['image']['tmp_name'];

	    	$div=explode('.', $file_name);
	    	$file_ext=strtolower(end($div));
	    	$unique_image=substr(md5(time()), 0, 10).'.'.$file_ext;
	    	$uploaded_image="uploads/".$unique_image;

			if($productName == "" || $brand == "" || $category == ""  || $price == "" || $file_name == ""){
				$alert = "vui lòng không để trống thông tin"; 
				return $alert;
			}else{
				$temp="";
				$temp2="";
				if($this->getIdCategoryByName($category))
					$temp = (($this->getIdCategoryByName($category))->fetch_assoc());
				if($this->getIdThuongHieuByName($brand))
					$temp2 = (($this->getIdThuongHieuByName($brand))->fetch_assoc());
				$category = $temp['MaLoaiSP'];
				$brand = $temp2['MaThuongHieu'];
				$query = "INSERT INTO sanpham(TenSP, HinhAnh, thuonghieu, gia ,MaLoaiSP, SoLuong) VALUES ('$productName','$unique_image','$brand','$price','$category','$quantity')";
				// error_log($query);
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span>Thêm product thành công</span>";
					move_uploaded_file($file_temp,$uploaded_image);
					return $alert;

				}
				else{
					$alert = "<span>Lỗi. Thêm product thất bại</span>";
					return $alert;	
				}

			}
			
		}

		public function getIdCategoryByName($id){
			$query = "SELECT MaLoaiSP FROM loaisp WHERE TenLoaiSP = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function getIdThuongHieuByName($name){
			$query = "SELECT MaThuongHieu FROM thuonghieu WHERE TenThuongHieu = '$name' ";
			$result = $this->db->select($query);
			return $result;
		}


		public function ShowAllProduct($start,$numPerPage,$search,$brand){
			if($brand !=""||$search != ""){
				if($brand != ""){
					$query = "SELECT * FROM sanpham WHERE thuonghieu = '$brand' LIMIT $start,$numPerPage";
				}
				else{
					$query = "SELECT * FROM sanpham WHERE TenSP LIKE '%$search%' LIMIT $start,$numPerPage";
				}
			}
			
			else {
				$query = "SELECT * FROM sanpham LIMIT $start,$numPerPage";
			}
			$result = $this->db->select($query);
			error_log($query);
			return $result;
		}

		public function getNumberOfProduct(){
			$query = "SELECT COUNT(*) as count from sanpham";
			$result = $this->db->select($query);
			return $result;
		}

		public function Show_Product($searchpost,$searchget){
			$query = "SELECT A.productName,A.image,A.size, C.brandName,B.catName,A.price,A.type,A.description FROM sanpham A, loaisp B, thuonghieu C WHERE ".$searchpost." ".$searchget."  A.catId=B.catId AND A.brandId=C.brandId GROUP BY A.productName, A.description, A.price  ORDER BY A.productName  DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function Show_ProductById($id){
			$query = "select * from sanpham";
			$result = $this->db->select($query);
			return $result;
		}
		public function Show_ProductAdmin(){
			$query = "SELECT A.MaSP, A.TenSP,A.HinhAnh,B.TenLoaiSP,c.TenThuongHieu,A.Gia FROM sanpham A, loaisp B, thuonghieu C WHERE A.MaLoaiSP = B.MaLoaiSP and A.thuonghieu = C.MaThuongHieu group by a.TenSP,a.Gia";
			$result = $this->db->select($query);
			return $result;
		}
		

		public function update_product($data,$files, $id){
			
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			// $description = mysqli_real_escape_string($this->db->link, $data['description']);

			$permited=array('jpg','jpeg','png','gif');
	    	$file_name=$_FILES['image']['name'];
	    	$file_size=$_FILES['image']['size'];
	    	$file_temp=$_FILES['image']['tmp_name'];

	    	$div=explode('.', $file_name);
	    	$file_ext=strtolower(end($div));
	    	$unique_image=substr(md5(time()), 0, 10).'.'.$file_ext;
	    	$uploaded_image="uploads/".$unique_image;

			
				if(!empty($file_name)){
					error_log("file is not empty");
					if($file_size > 1048567){
						$alert = "<span>Kích thước ảnh quá lớn</span>";
						return $alert;
					}
					// elseif (in_array($file_ext,$permited) === false) 
					// {
					// 	$alert = "<span>Bạn chỉ có thể cập nhật:-".implode(', ',$permited)."</span>";
					// 	return $alert;
					// }
					$query = "UPDATE sanpham 
							  SET TenSP = '$productName' , 
							      Gia = '$price', 
							       
							      HinhAnh = '$unique_image' 						       
							    WHERE MaSP = '$id'";
			  		move_uploaded_file($file_temp, $uploaded_image);

					error_log($query);
					// error_log($alert);

				}else{
					error_log("file is empty");
					$query = "UPDATE sanpham 
							  SET TenSP = '$productName' ,
							  	 
								  Gia = '$price' 
							  	   
							  	   
							  WHERE MaSP = '$id'";
					error_log($query);
				}
			

				
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='text-success >Update thành công</span";
					return $alert;

				}
				else{
					$alert = "<span class='text-success >Update không thành công</span";
					return $alert;	
				}
			
			
		}
		public function delete_product($id){
			$query = "DELETE  FROM sanpham WHERE productId = '$id' ";
			$result = $this->db->delete($query);
			return $result;		
		}
		public function getThongSoKyThuatProductById($id){
			$query = "SELECT chitietsanpham.title,chitietsanpham.content FROM chitietsanpham WHERE MaSP = '$id' and isMoTa = 0 ";
			$result = $this->db->delete($query);
			return $result;	
		}

		Public function getMoTaProductById($id){
			$query = "SELECT chitietsanpham.title,chitietsanpham.content,chitietsanpham.hinhanh FROM chitietsanpham WHERE MaSP = '$id' and isMoTa = 1 ";
			$result = $this->db->delete($query);
			return $result;	
		}
		public function delete_productName($name){			
			$querySP = "DELETE FROM sanpham WHERE MaSP='$name'";
			$resultSP = $this->db->delete($querySP);
			return $resultSP;		
		}
		public function getproductByid($id){
			$query = "SELECT * FROM sanpham WHERE MaSP = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function Get_ProductFeathered(){
			$query = "SELECT  A.productName, C.brandName,B.catName,A.price,A.image,A.type,A.description
					  FROM sanpham A, loaisp B, thuonghieu C
					  WHERE A.catId = B.catId AND A.brandId = C.brandId AND A.type = '1'
					  GROUP by A.productName LIMIT 8";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_ProductNew(){
			$query = "SELECT A.productId, A.productName, C.brandName,B.catName,A.price,A.image,A.type,A.description
					  FROM sanpham A, loaisp B, thuonghieu C
					  WHERE A.catId = B.catId AND A.brandId = C.brandId
					  GROUP by A.productName
					  ORDER BY A.productId DESC LIMIT 8";
			$result = $this->db->select($query);
			return $result;
		}

		public function get_1Product($name){
			$query = "SELECT A.productId, A.productName, C.brandName,B.catName,A.price,A.image,A.type,A.size,A.description
					  FROM sanpham A, loaisp B, thuonghieu C
					  WHERE A.catId = B.catId AND A.brandId = C.brandId AND A.productName = '$name'
					  GROUP by A.productName";
			$result = $this->db->select($query);
			return $result;
		}
		public function getSize_1Product($name){
			$query = "SELECT * FROM sanpham WHERE MaSP = '$name' ";
			$result = $this->db->select($query);
			return $result;
		}
		public function Show_ProductByName($Name){
			$query = "SELECT * FROM sanpham A, loaisp B, thuonghieu C WHERE A.MaLoaiSP = B.MaLoaiSP and A.thuonghieu = C.MaThuongHieu  AND A.TenSP ='$Name' GROUP BY A.TenSP LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}

		public function Show_ProductByIdAdmin($id){
			$query = "SELECT * FROM sanpham A, loaisp B, thuonghieu C WHERE A.MaLoaiSP = B.MaLoaiSP and A.thuonghieu = C.MaThuongHieu  AND A.MaSP ='$id' GROUP BY A.MaSP LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function Show_ProductByBrand($id){
			$query = "SELECT * FROM sanpham A, loaisp B, thuonghieu C WHERE A.catId=B.catId AND A.brandId=C.brandId AND C.brandId ='$id' GROUP BY A.productName ORDER BY A.productName DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function updateQuantity($id,$quantity){

			$id = mysqli_real_escape_string($this->db->link, $id);
			$quantity = $this->fm->validation($quantity);
			$quantity = mysqli_real_escape_string($this->db->link,$quantity);
			
				$query = "UPDATE sanpham SET SoLuong = '$quantity' WHERE MaSP = '$id' ";
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='text-success' >Update thành công</span";
					return $alert;

				}
				else{
					$alert = '<span class="text-danger">Lỗi. Cập nhật thông tin không thành công</span>';
					return $alert;	
				}
			
		}

		public function deleteAllThongSoKyThuatProdById($id){
			$query = "delete from chitietsanpham where MaSP = '$id' and isMoTa =0";
			$result = $this->db->insert($query);
			return $result;
		}

		public function deleteMoTaProdById($id,$position){
			$tempquery = "
				SELECT COUNT(*)
				FROM chitietsanpham
				WHERE MaSP = $id and isMoTa = 1
			";
			$tempResult = $this->db->select($tempquery);
			$count = $tempResult->fetch_row()[0];
			if ($position > $count) {
				$position = $position - 1;
			}
			$query = "
				DELETE FROM chitietsanpham
				WHERE MaChiTietSP IN (
				SELECT MaChiTietSP
				FROM (
					SELECT *,
						ROW_NUMBER() OVER (PARTITION BY MaChiTietSP ORDER BY MaChiTietSP) AS row_num,
						ROW_NUMBER() OVER (ORDER BY MaChiTietSP) AS position
					FROM chitietsanpham
					WHERE isMoTa = 1 AND MaSP = $id
				) AS subquery
				WHERE position = $position
				);
			";
			// error_log($query);
			$result = $this->db->delete($query);
			return $result;
		}

		public function insertThongSoKyThuatProd($id,$title,$content){
				$query = "insert into chitietsanpham (MaSP,title,content,isMoTa) VALUES ('$id','$title','$content',0)";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='text-success >Thêm thành công</span";
					return $alert;

				}
				else{
					$alert = "<span class='text-success >Thêm thất bại</span";
					return $alert;	
				}
		}	


		public function updateMoTaNgan($id,$data){
			$content = mysqli_real_escape_string($this->db->link, $data['shortDescripText']);
			$query = "update sanpham set MoTaNgan = '$content' where MaSP = '$id'";
			$result = $this->db->update($query);
			if($result){
				$alert = "<span class='text-success >update thành công</span";
				return $alert;

			}
			else{
				$alert = "<span class='text-success >update thất bại</span";
				return $alert;	
			}
		}

		public function getMoTaNgan($id){
			$query = "select MoTaNgan from sanpham where MaSP = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function insertMoTaProd($id, $title, $content, $file) {
			$permited = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $file['name'];
			$file_size = $file['size'];
			$file_temp = $file['tmp_name'];
			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = uniqid() . '.' . $file_ext;	
			$uploaded_image = "uploads/" . $unique_image;
			
			// Make sure the "uploads" folder exists and has write permissions
			
			if(!empty($file_name)){
				$query = "INSERT INTO chitietsanpham (MaSP, title, content, hinhanh, isMoTa) VALUES ('$id', '$title', '$content', '$unique_image', 1)";
			}
			else{
				$query = "INSERT INTO chitietsanpham (MaSP, title, content, isMoTa) VALUES ('$id', '$title', '$content', 1)";

			}
			$result = $this->db->insert($query);
			error_log($query);
			
			if ($result) {
			  $alert = "<span class='text-success'>Thêm thành công</span>";
			  move_uploaded_file($file_temp, $uploaded_image);
			  return $alert;
			} else {
			  $alert = "<span class='text-success'>Thêm thất bại</span>";
			  return $alert;  
			}
		}


		public function updateMoTaProd($id, $title, $content, $file,$position) {
			$permited = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $file['name'];
			$file_size = $file['size'];
			$file_temp = $file['tmp_name'];
			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = uniqid() . '.' . $file_ext;	
			$uploaded_image = "uploads/" . $unique_image;
			
			// Make sure the "uploads" folder exists and has write permissions
			$tempquery = "
				SELECT COUNT(*)
				FROM chitietsanpham
				WHERE MaSP = $id and isMoTa = 1
			";
			$tempResult = $this->db->select($tempquery);
			$count = $tempResult->fetch_row()[0];
			if ($position > $count) {
				$position = $position - 1;
			}
			if(!empty($file_name)){
				$query = "
					UPDATE chitietsanpham
					SET title = '$title', content = '$content',hinhanh = '$unique_image'
					WHERE MaSP = $id
					AND isMoTa = 1
					AND (MaChiTietSP,MaSP, isMoTa) IN (
						SELECT MaChiTietSP,MaSP, isMoTa
						FROM (
						SELECT *,
								ROW_NUMBER() OVER (PARTITION BY MaChiTietSP ORDER BY MaChiTietSP) AS row_num,
								ROW_NUMBER() OVER (ORDER BY MaChiTietSP) AS position
						FROM chitietsanpham
						WHERE isMoTa = 1 AND MaSP = $id
						) AS subquery
						WHERE position = $position
					)
					LIMIT 1;				
				";
			}
			else{
				$query = "
				UPDATE chitietsanpham
				SET title = '$title', content = '$content'
				WHERE MaSP = $id
				AND isMoTa = 1
				AND (MaChiTietSP,MaSP, isMoTa) IN (
					SELECT MaChiTietSP,MaSP, isMoTa
					FROM (
					SELECT *,
							ROW_NUMBER() OVER (PARTITION BY MaChiTietSP ORDER BY MaChiTietSP) AS row_num,
							ROW_NUMBER() OVER (ORDER BY MaChiTietSP) AS position
					FROM chitietsanpham
					WHERE isMoTa = 1 AND MaSP = $id
					) AS subquery
					WHERE position = $position
				)
				LIMIT 1;				
			";
			}
			$result = $this->db->insert($query);
			error_log($query);
			
			if ($result) {
			  $alert = "<span class='text-success'>Thêm thành công</span>";
			  move_uploaded_file($file_temp, $uploaded_image);
			  return $alert;
			} else {
			  $alert = "<span class='text-success'>Thêm thất bại</span>";
			  return $alert;  
			}
		}
		
		
		
		public function add_Size_Product($productName,$size,$quantity){
			
			$size = $this->fm->validation($size);
			$size = mysqli_real_escape_string($this->db->link, $size);
			$quantity = $this->fm->validation($quantity);
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);

			$query_select = "SELECT * FROM sanpham WHERE productName = '$productName' ";
			$get_product = $this->db->select($query_select);
			if($get_product){
				while ($result = $get_product->fetch_assoc()) {
					$brandId = $result['brandId'];
					$catId = $result['catId'];
					$description = $result['description'];
					$image = $result['image'];
					$type = $result['type'];
					$price = $result['price'];
					$size1 = $result['size'];
				}

			}
			if($size1==$size){
				$alert = "<span class='text-success' >ADD không thành công</span";
					return $alert;	
			
			}else{
				$query = "INSERT INTO sanpham(productName, catId, brandId, size ,price, image, type,description, quantity) VALUES ('$productName','$catId','$brandId','$size','$price','$image','$type','$description','$quantity')";
				$insert = $this->db->insert($query);
			}

			
		}

		public function getTop3Seller(){
			$query = "SELECT MaSP,COUNT(MaSP) as count
						FROM chitietbienlai
						GROUP BY MaSP
						ORDER BY count DESC
						LIMIT 3
			";
			$result = $this->db->select($query);
			return $result;
		}
		public function getTop4Seller(){
			$query = "SELECT MaSP,COUNT(MaSP) as count
						FROM chitietbienlai
						GROUP BY MaSP
						ORDER BY count DESC
						LIMIT 4
			";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function get3ImgByIDPro($id){
			$query = "SELECT * FROM hinhanh WHERE id_SanPham='$id' LIMIT 3";
			$result = $this->db->select($query);
			return $result;
		}

		public function getImgByIDPro($id){
			$query = "SELECT * FROM hinhanh WHERE id_SanPham='$id'";
			$result = $this->db->select($query);
			return $result;
		}
	

	}
 ?>