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
        function deleteSanPhamController(){
            try {
                
            } catch (\Throwable $th) {
                print_r("error deleting");
            }
        }
    }
    if(isset($_POST['idToDelete'])){
        $id = array($_POST['idToDelete']);
        // echo "id go here".$id;
        deleteSanPham($id);
    }
    else{
        echo 'lioi ';
    }
        
?>