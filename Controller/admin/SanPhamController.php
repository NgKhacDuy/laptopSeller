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
        function getLastIDSanPhamAndPLus1Controller(){
            return intval(getLastIDSanPham())+1;
        }
    }
    if(isset($_POST['idToDelete'])){
        $id = array($_POST['idToDelete']);
        // echo "id go here".$id;
        deleteSanPham($id);
    }
    

    if(isset($_POST['dataInsert'])){
        $data =json_decode($_POST['dataInsert']);
        // echo "id go here".$id;
        insertSanPham($data);
        error_log($data);
    }
    
        
?>