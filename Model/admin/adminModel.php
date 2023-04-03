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
    function deleteSanPham($array){
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
        $sql = "Delete from sanpham where sanpham.MaSP in (".$str.") ";
        echo $sql;
        
        // $result = mysqli_query($conn, $sql);
        // $data = array();
        // if (mysqli_num_rows($result) > 0) {
        //     while ($row = mysqli_fetch_assoc($result)) {
        //         $data[] = $row;
        //     }
        // }
        // return $data;
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
    $array = array("id1");
    deleteSanPham($array);
    
?>