<?php
    include_once('/xampp/htdocs/laptopSeller/Model/admin/databaseconnect.php');
    function getAllSanPham(){
        global $conn;
        $sql = "SELECT sanpham.MaSP,sanpham.TenSP,sanpham.ThuongHieu,sanpham.HinhAnh,sanpham.Gia,loaisp.TenLoaiSP,sanpham.SoLuong FROM sanpham,loaisp WHERE sanpham.MaLoaiSP = loaisp.MaLoaiSP";
        $result = mysqli_query($conn, $sql);
        $data = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;

        
    }
    function deleteSanPham(array $array){
        try {
            global $conn;
        // $sql = "Delete from sanpham where sanpham.MaSP in ";
            $str="";
            foreach($array as $value){
                if(count($array)==1){
                    $str.=$value;
                }
                else{
                    $str.=$value.",";
                }
            }
            $str = trim($str,'[]');
            $str = rtrim($str,',');
            $str = str_replace('"','',$str);
            // echo "String: ".$str;
            $sql = "Delete from sanpham where sanpham.MaSP in (".$str.") ";
            // var_dump($sql);
            if ($conn->query($sql) === TRUE) {
                echo "success";
                return true;
            } else {
                echo "Error deleting record: " . $conn->error;
                return false;
            }
        } catch (\Throwable $th) {
            print_r($th);
        }
    }
    function getAllLoaiSanPham(){
        global $conn;
        $sql = "SELECT * FROM loaisp";
        $result = mysqli_query($conn, $sql);
        $data = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    
?>