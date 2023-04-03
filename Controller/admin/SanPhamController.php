<?php
    require_once('/xampp/htdocs/laptopSeller/Model/admin/adminModel.php');
    class adminController {
        public function __construct(){
            
        }
        function getAllSanPhamController() { 
            return getAllSanPham();
        }
        function getAllLoaiSanPhamController() {
            return getAllLoaiSanPham();
        }
    }
        
?>