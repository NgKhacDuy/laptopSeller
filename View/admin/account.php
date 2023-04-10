<div class="content">
    <h3 class="title">Dashboard</h3>

    <button class="btn" id="btn_Add_Sale">Thêm</button>

    <!-- Table -->
    <main class="table">
        <section class="table__header">
            <h1>List Account</h1>
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
                        <th><input type="checkbox" id="cb_RemoveAll" class="cb"></th>
                        <th class="sort">User Name<span class="icon-arrow">&UpArrow;</span></th>
                        <th class="sort">Họ và Tên<span class="icon-arrow">&UpArrow;</span></th>
                        <th class="sort">Mật khẩu<span class="icon-arrow">&UpArrow;</span></th>
                        <th class="sort">Trạng thái nhân viên<span class="icon-arrow">&UpArrow;</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="sort_row">
                        <td><input type="checkbox" id="cb_Remove" class="cb"></td>
                        <td>ironman123</td>
                        <td>Nguyễn Văn A</td>
                        <td>ironpeppep</td>
                        <td>
                            <img src="./assets/icon/cross.png">
                        </td>

                    </tr>
                    <tr class="sort_row">
                        <td><input type="checkbox" id="cb_Remove" class="cb"></td>
                        <td>admin</td>
                        <td>admin</td>
                        <td>1234567</td>
                        <td>
                            <img src="./assets/icon/check.png">
                        </td>
                    </tr>
                    <tr class="sort_row">
                        <td><input type="checkbox" id="cb_Remove" class="cb"></td>
                        <td>peppa_Pink</td>
                        <td>Lãnh chúa Peppa</td>
                        <td>peppathift</td>
                        <td>
                            <img src="./assets/icon/check.png">
                        </td>
                    </tr>
                    <tr class="sort_row">
                        <td><input type="checkbox" id="cb_Remove" class="cb"></td>
                        <td>Doraemon</td>
                        <td>Doraemon</td>
                        <td>BanhRanThomNgon</td>
                        <td>
                            <img src="./assets/icon/cross.png">
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <!-- Modal -->
    <div id="modal-container">
        <div id="modal_Sale" class="modal">
            <div class="modal-header">
                <h3>Thêm khuyến mãi mới</h3>
            </div>
            <div class="modal-body">
                <form action="" method="get">
                    <p><strong>Chi tiết khuyến mãi</strong></p>
                    <label for="txt_IDKM" class="name_txt">Mã khuyến mãi</label>
                    <input type="text" name="txt_IDKM" class="txt">
                    <label for="txt_NameKM" class="name_txt">Tên khuyến mãi</label>
                    <input type="text" name="txt_NameKM" class="txt">
                    <div class="line_form"></div>

                    <p><strong>Loại khuyến mãi</strong></p>
                    <label for="txt_Sale" class="name_txt">Giảm</label>
                    <input type="text" name="txt_Sale" class="txt txt1">
                    <label for="cbb_Apply" class="name_txt">Khi mua</label>
                    <select name="cbb_Apply" class="txt cbb">
                        <option value="AllProduct">Tất cả sản phẩm</option>
                        <option value="OnlyOneProduct">Một loại sản phẩm chỉ đinh</option>
                        <option value="OnBill">Giảm trên hóa đơn</option>
                    </select>
                    <label for="txt_SaleMax" class="name_txt">Max</label>
                    <input type="text" name="txt_SaleMax" class="txt txt1">
                    <div class="line_form"></div>

                    <p><strong>Thời gian áp dụng</strong></p>
                    <label for="cb_Unlimit" class="name_txt">Không giới hạn thời gian</label>
                    <input type="checkbox" name="cb_Unlimit" class="cb">
                    <label for="txt_TimeFrom" class="name_txt">Từ</label>
                    <input type="date" name="txt_TimeFrom" class="txt txt2">
                    <label for="txt_TimeTo" class="name_txt">Đến</label>
                    <input type="date" name="txt_TimeTo" class="txt txt2">

                    <input type="submit" name="btn_Save" value="Lưu" class="btn" id="btn_Save" />
                    <input type="submit" name="btn_Cancel" value="Hủy" class="btn" id="btn_Cancel" />
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>

    <!-- End Modal -->
</div>