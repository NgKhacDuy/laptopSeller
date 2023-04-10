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
            <div id="toast"></div>
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
                        <!-- <th class="table_heading">Chọn sản phẩm</th> -->
                        <th class="table_heading">
                            <input type="checkbox" id="select_all-sanpham_table" class="" onclick="selectAll()">
                            <label for="select_all" class="">Chọn tất cả</label>
                        </th>
                        <th class="table_heading"> Mã <span class="icon-arrow">&UpArrow;</span></th>
                        <th class="table_heading"> Tên <span class="icon-arrow">&UpArrow;</span></th>
                        <th class="table_heading"> Thương hiệu <span class="icon-arrow">&UpArrow;</span></th>
                        <th class="table_heading"> Giá <span class="icon-arrow">&UpArrow;</span></th>
                        <th class="table_heading"> Số lượng <span class="icon-arrow">&UpArrow;</span></th>
                        <th class="table_heading"> Loại sản phẩm <span class="icon-arrow">&UpArrow;</span></th>

                    </tr>
                </thead>
                <tbody class="table_content-sanpham">

                </tbody>
            </table>
        </section>
    </main>

    <div id="myModal" class="modal-admin_sanpham">
        <div class="modal-content-admin_sanpham">
            <div class="modal-content-admin_sanpham-header">
                <span class="modal-admin_sanpham-close">&times;</span>
                <h3 class="modal-admin_sanpham-title">Sửa sản phẩm</h3>
            </div>
            <div class="modal-content-admin_sanpham-body">
                <div class="modal-sanpham_input">
                    <label class="label-input-admin-sanpham" for="input-admin_sanpham-masp">Mã sản phẩm</label>
                    <input type="text" id="input-admin_sanpham-masp">
                    <label class="label-input-admin-sanpham" for="input-admin_sanpham-tensp">Tên sản phẩm</label>
                    <input type="text" id="input-admin_sanpham-tensp">
                    <div class="admin-sanpham-input-price">
                        <div class="admin-sanpham-input-price-in">
                            <label class="label-input-admin-sanpham" for="input-admin_sanpham-gianhap">Giá nhập</label>
                            <input type="text" id="input-admin_sanpham-gianhap">
                        </div>
                        <div class="admin-sanpham-input-price-out">
                            <label class="label-input-admin-sanpham" for="input-admin_sanpham-giaban">Giá bán</label>
                            <input type="text" id="input-admin_sanpham-giaban">
                        </div>
                    </div>
                    <label class="label-input-admin-sanpham" for="input-admin_sanpham-loaisp">Loại sản phẩm</label>
                    <select name="input-admin_sanpham-loaisp" id="input-admin_sanpham-loaisp">
                        <?php
                        include_once('./Controller/admin/SanPhamController.php');
                        $adminModel = new adminController();
                        $loaiSanphamResult = $adminModel->getAllLoaiSanPhamController();
                        foreach ($loaiSanphamResult as $loaiSanpham) {
                            echo "<option value='" . $loaiSanpham['TenLoaiSP'] . "'>" . $loaiSanpham['TenLoaiSP'] . "</option>";
                        }
                    ?>
                    </select>

                </div>
                <div class="vertical-line">

                </div>
                <span class="modal-sanpham-img-title">
                    Hình ảnh
                </span>
                <div class="modal-sanpham_img-btn">
                    <div id="image-preview-admin-sanpham"></div>
                    <input type="file" id="image-input-admin-sanpham" accept="image/*">
                    <div class="modal-sanpham-group-btn">
                        <button class="modal-sanpham-btn">Lưu</button>
                        <button class="modal-sanpham-btn btn-admin-sanpham-huy">Hủy</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- dưới này để quản lí các nút trong mục chức vụ -->
    <!-- sau này sẽ đổi tên để tránh trung lập -->
    <div class="button-container">

        <button class="btn-insert btn-admin-sanpham-them">Thêm</button>
        <button class="btn-insert btn-admin-sanpham-xoa">Xóa</button>
        <button class="btn-insert btn-admin-sanpham-sua">Sửa</button>
    </div>
</div>
<!-- <script src="./assets/js/script.js"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../laptopSeller/assets/js/admin/sanpham/sanpham.js"></script>
<script src="../../laptopSeller/assets/js/custom/toast/toast.js"></script>
<script>

</script>