<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/laptopSeller/Controller/admin/SanPhamController.php';
    $adminModel = new adminController();
    $sanphamResult = $adminModel->getAllSanPhamController();
    for($i =0; $i< count($sanphamResult); $i++){
        echo "<tr>";
        echo"<td>";
            echo"<input checked='' type='checkbox' class='cbx hidden-xs-up' id='cbx".$sanphamResult[$i]['MaSP']."' onclick='getRowValues(this)' class='hidden-xs-up'>";
            echo'<label for="cbx'.$sanphamResult[$i]['MaSP'].'" class="cbx_label"></label>';
        echo"</td>";
        echo "<td>" .$sanphamResult[$i]['MaSP']. "</td>";
        if (isset($sanphamResult[$i]['HinhAnh']) && !empty($sanphamResult[$i]['HinhAnh'])) {
            echo '<td> <img class="sanpham_img" src="data:image/png;base64,'.base64_encode($sanphamResult[$i]['HinhAnh']).'" alt="">'.$sanphamResult[$i]["TenSP"].'</td>';
        } else {
            echo '<td> <img class="sanpham_img" src="/laptopSeller/assets/img/no-img.png" alt="">'.$sanphamResult[$i]["TenSP"].'</td>';
        }
        echo "<td>".$sanphamResult[$i]['ThuongHieu']."</td>";
        echo "<td>".$sanphamResult[$i]['Gia']."</td>";
        echo "<td>";
        echo "<p class='status delivered'>".$sanphamResult[$i]['SoLuong']."</p>";
        echo "</td>";
        echo "<td> <strong>".$sanphamResult[$i]['TenLoaiSP']."</strong></td>";
        echo "</tr>";
    }
?>