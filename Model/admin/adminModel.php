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

    function insertSanPham(array $data){
        error_log(print_r($data));
        global $conn;
        $maLoaiSP = getMaLoaiSP($data[4]);
        if ($maLoaiSP === null) {
            error_log("MaLoaiSP not found for TenLoaiSP: " . $data[4]);
            return;
        }
        $data[4] = $maLoaiSP;
        error_log(print_r($data, true));
        $stmt = $conn->prepare("INSERT INTO sanpham (TenSP, ThuongHieu, HinhAnh, Gia, MaLoaiSP, SoLuong) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiii", ...$data);
        // error_log($stmt);
        $stmt->execute();
        $stmt->close();
    }
    
    function getMaLoaiSP($tenloaisp){
        global $conn;
        $sql = "SELECT MaLoaiSP FROM loaisp WHERE TenLoaiSP = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $tenloaisp);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = null;
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data = $row['MaLoaiSP'];
                break; // Only return the first result
            }
        }
        return $data;
    }
    
    

    function getLastIDSanPham(){
        global $conn;
        $sql = "SELECT MAX(MaSP) as MaSP FROM sanpham";
        $result = $conn->query($sql);
        if ($result !== FALSE && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["MaSP"];
        } else {
            return NULL;
        }
    }

    
?>