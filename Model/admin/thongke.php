<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../../lib/database.php');
	include_once  ($filepath.'/../../helpers/format.php');
 ?>
<?php
    class thongke{
        private $db;
		private $fm;
		

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}


        function getAllTotalByCategory(){
            $query = "SELECT c.TenLoaiSP, SUM(bd.ThanhTien) AS totalMoney
                        FROM chitietbienlai bd
                        JOIN sanpham p ON bd.MaSP = p.MaSP
                        JOIN loaisp c ON p.MaLoaiSP = c.MaLoaiSP
                        GROUP BY c.TenLoaiSP
                    ";
            $result = $this->db->select($query);
			return $result;
        }

        function getMonthlyTotal(){
            $query = "SELECT MONTH(ngaytao) AS month, SUM(tongtien) AS totalMoney
                        FROM bienlai
                        GROUP BY month;
                    ";
            $result = $this->db->select($query);
			return $result;
        }
    }
?>