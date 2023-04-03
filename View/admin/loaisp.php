<div class="content">
    <h3 class="title">Dashboard</h3>
    <!-- <h4>Khuyến mãi</h4> -->
    <!-- <button class="btn">Thêm</button> -->
    <!-- <div class="search">
        <input type="text" class="search__input" placeholder="Type your text">
        <button class="search__button">
            <svg class="search__icon" aria-hidden="true" viewBox="0 0 24 24">
                <g>
                    <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                </g>
            </svg>
        </button>
    </div> -->
    <!-- <h5>3 khuyến mãi</h5> -->
    <main class="table">
        <section class="table__header">
            <h1>
                <?php
                        if (isset($_GET['chon'])){
                            if ($_GET['chon'] =='qlsp'){
                                if (isset($_GET['id'])){

                                    switch($_GET['id']){

                                        case 'loaisp':
                                            echo 'Quản Lí Loại sản phẩm';
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
                    </tr>
                </thead>
                <tbody class="table_content-sanpham">
                    <?php
                        require_once('./Controller/admin/adminController.php');
                        $adminModel = new adminController();
                        $loaiSanphamResult = $adminModel->getAllLoaiSanPhamController();
                        for($i =0; $i< count($loaiSanphamResult); $i++){
                            echo "<tr>";
                                echo"<td>";
                                    echo"<input checked='' type='checkbox' id='cbx' class='hidden-xs-up'>";
                                    echo'<label for="cbx" class="cbx"></label>';
                                echo"</td>";
                                echo"<td>" .$loaiSanphamResult[$i]['MaLoaiSP']. "</td>";
                                echo"<td>" .$loaiSanphamResult[$i]['TenLoaiSP']. "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <!-- dưới này để quản lí các nút trong mục chức vụ -->
    <!-- sau này sẽ đổi tên để tránh trung lập -->
    <div class="button-container">

        <button class="btn-insert">Thêm</button>
        <button class="btn-insert">Xóa</button>
        <button class="btn-insert">Sửa</button>
    </div>


</div>
<script src="./assets/js/script.js"></script>