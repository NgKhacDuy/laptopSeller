<div class="content">
    <h3 class="title">Dashboard</h3>
    <main class="table">
        <section class="table__header">
            <h1>
                <?php
                        if (isset($_GET['chon'])){
                            if ($_GET['chon'] =='qlsp'){
                                if (isset($_GET['id'])){

                                    switch($_GET['id']){

                                        case 'sanpham':
                                            echo 'Quản lí sản phẩm';
                                            break;
                                        
                                    }
                                    
                                }
                            }
                        }
                ?>
            </h1>
            <div class="input-group">
                <input type="search" placeholder="Search Data...">
                <img src="./assets/icon/search.png" alt="">
            </div>
            <div class="export__file">
                <label for="export-file" class="export__file-btn" title="Export File"></label>
                <input type="checkbox" id="export-file">

                <div class="export__file-options">
                    <label>Export As &nbsp; &#10140;</label>
                    <label for="export-file" id="toPDF">PDF <img src="./assets/icon/pdf.png" alt=""></label>
                    <label for="export-file" id="toJSON">JSON <img src="./assets/icon/json.png" alt=""></label>
                    <label for="export-file" id="toCSV">CSV <img src="./assets/icon/csv.png" alt=""></label>
                    <label for="export-file" id="toEXCEL">EXCEL <img src="./assets/icon/excel.png" alt=""></label>
                </div>
            </div>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th class="table_heading">Chọn sản phẩm</th>
                        <th class="table_heading"> Mã <span class="icon-arrow">&UpArrow;</span></th>
                        <th class="table_heading"> Tên <span class="icon-arrow">&UpArrow;</span></th>
                        <th class="table_heading"> Thương hiệu <span class="icon-arrow">&UpArrow;</span></th>
                        <th class="table_heading"> Giá <span class="icon-arrow">&UpArrow;</span></th>
                        <th class="table_heading"> Số lượng <span class="icon-arrow">&UpArrow;</span></th>
                        <th class="table_heading"> Loại sản phẩm <span class="icon-arrow">&UpArrow;</span></th>
                    </tr>
                </thead>
                <tbody class="table_content-sanpham">
                    <?php
                            require_once('./Controller/admin/SanPhamController.php');
                            $adminModel = new adminController();
                            $sanphamResult = $adminModel->getAllSanPhamController();
                            for($i =0; $i< count($sanphamResult); $i++){
                                echo "<tr style='border: 1px solid red;'>";
                                echo"<td>";
                                    echo"<input checked='' type='checkbox' class='cbx' id='cbx".$sanphamResult[$i]['MaSP']."' class='hidden-xs-up'>";
                                    echo'<label for="cbx'.$sanphamResult[$i]['MaSP'].'" class="cbx_label"></label>';
                                echo"</td>";
                                echo"<td>" .$sanphamResult[$i]['MaSP']. "</td>";
                                if (isset($sanphamResult[$i]['HinhAnh']) && !empty($sanphamResult[$i]['HinhAnh'])) {
                                    echo '<td> <img class="sanpham_img" src="data:image/png;base64,'.base64_encode($sanphamResult[$i]['HinhAnh']).'" alt="">'.$sanphamResult[$i]["TenSP"].'</td>';
                                } else {
                                    echo '<td> <img class="sanpham_img" src="/laptopSeller/assets/img/no-img.png" alt="">'.$sanphamResult[$i]["TenSP"].'</td>';
                                }                                
                                echo"<td>".$sanphamResult[$i]['ThuongHieu']."</td>";
                                echo"<td>".$sanphamResult[$i]['Gia']."</td>";
                                echo"<td>";
                                    echo"<p class='status delivered'>".$sanphamResult[$i]['SoLuong']."</p>";
                                echo"</td>";
                                echo"<td> <strong>".$sanphamResult[$i]['TenLoaiSP']."</strong></td>";
                                echo"</tr>";
                            }
                        ?>


                    <!-- <tr>
                        <td>
                            <input checked="" type="checkbox" id="cbx" class="hidden-xs-up">
                            <label for="cbx" class="cbx"></label>
                        </td>
                        <td> 1 </td>
                        <td> <img src="./assets/img/1.png" alt="">Zinzu Chan Lee</td>
                        <td> Seoul </td>
                        <td> 17 Dec, 2022 </td>
                        <td>
                            <p class="status delivered">Delivered</p>
                        </td>
                        <td> <strong> $128.90 </strong></td>
                    </tr> -->

                </tbody>
            </table>
        </section>
    </main>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>This is a modal.</p>
        </div>
    </div>

    <!-- dưới này để quản lí các nút trong mục chức vụ -->
    <!-- sau này sẽ đổi tên để tránh trung lập -->
    <div class="button-container">

        <button class="btn-insert">Thêm</button>
        <button class="btn-insert">Xóa</button>
        <button class="btn-insert btn-sua">Sửa</button>
    </div>
</div>
<script src="./assets/js/script.js"></script>
<script src="../../laptopSeller/assets/js/admin/sanpham/sanpham.js"></script>