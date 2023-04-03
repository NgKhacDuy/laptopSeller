<div id="header">
    <h1 class="title">Ti<span>tle</span></h1>
    <div class="vertical_line"></div>
    <div class="infor">
        <h6>Võ Trần Gia Bảo</h6>
        <img src="./assets/img/meme7.jpg" alt="">

    </div>
</div>



<div style="display:flex;">
    <div id="navbar">
        <ul>
            <li class="line_function">
                <div class="line"></div>
                <div class="layout"></div>
                <img class="icon_nav" src="./assets/icon/Filter.png" alt="">
                <h4 class="title_nav">Dashboard</h4>
                <ul class="subnav">
                    <li>
                        <div class="line1"></div>
                        <div class="line2"></div>
                        <div class="layout1"></div>
                        <img class="icon_nav" src="./assets/icon/Swap.png" alt="">
                        <a style="text-decoration: none; color: white;" href="./index.php?chon=dashboard&id=groups"
                            class="title_nav">Phân quyền</a>
                    </li>
                    <li>
                        <div class="line1"></div>
                        <div class="line2"></div>
                        <div class="layout1"></div>
                        <img class="icon_nav" src="./assets/icon/acc.png" alt="">
                        <a style="text-decoration: none; color: white;" href="./index.php?chon=dashboard&id=account"
                            class="title_nav">Tài khoản</a>
                    </li>
                    <li>
                        <div class="line1"></div>
                        <div class="line2"></div>
                        <div class="layout1"></div>
                        <img class="icon_nav" src="./assets/icon/discount.png" alt="">
                        <a style="text-decoration: none; color: white;" href="./index.php?chon=dashboard&id=discount"
                            class="title_nav">Sale</a>
                    </li>
                </ul>
            </li>
            <li class="line_function">
                <div class="line"></div>
                <div class="layout"></div>
                <img class="icon_nav" src="./assets/icon/product.png" alt="">
                <h4 class="title_nav">Sản phẩm</h4>
                <ul class="subnav">
                    <li>
                        <div class="line1"></div>
                        <div class="line2"></div>
                        <div class="layout1"></div>
                        <img class="icon_nav" src="./assets/icon/classify_product.png" alt="">
                        <a style="text-decoration: none; color: white;" href="./index.php?chon=qlsp&id=loaisp"
                            class="title_nav">Loại sản phẩm</a>
                    </li>
                    <li>
                        <div class="line1"></div>
                        <div class="line2"></div>
                        <div class="layout1"></div>
                        <img class="icon_nav" src="./assets/icon/product.png" alt="">
                        <a style="text-decoration: none; color: white;" href="./index.php?chon=qlsp&id=sanpham"
                            class="title_nav">Sản phẩm</a>
                    </li>
                    <li>
                        <div class="line1"></div>
                        <div class="line2"></div>
                        <div class="layout1"></div>
                        <img class="icon_nav" src="./assets/icon/detail_product.png" alt="">
                        <h4 class="title_nav">CTSP</h4>
                    </li>
                </ul>
            </li>
            <li>
                <div class="line"></div>
                <div class="layout"></div>
                <img class="icon_nav" src="./assets/icon/customer.png" alt="">
                <h4 class="title_nav">Khách hàng</h4>
            </li>
            <li class="line_function line_2function">
                <div class="line"></div>
                <div class="layout"></div>
                <img class="icon_nav" src="./assets/icon/staff.png" alt="">
                <h4 class="title_nav">Nhân viên</h4>
                <ul class="subnav">
                    <li>
                        <div class="line1"></div>
                        <div class="line2"></div>
                        <div class="layout1"></div>
                        <img class="icon_nav" src="./assets/icon/job.png" alt="">
                        <a style="text-decoration: none; color: white;" href="./index.php?chon=qlnv&id=chucvu"
                            class="title_nav">Chức
                            vụ</a>
                    </li>
                    <li>
                        <div class="line1"></div>
                        <div class="line2"></div>
                        <div class="layout1"></div>
                        <img class="icon_nav" src="./assets/icon/staff.png" alt="">
                        <a style="text-decoration: none; color: white;" class="title_nav"
                            href="./index.php?chon=qlnv&id=nhanvien">Nhân viên</a>
                    </li>
                </ul>
            </li>
            <li class="line_function line_2function">
                <div class="line"></div>
                <div class="layout"></div>
                <img class="icon_nav" src="./assets/icon/bill.png" alt="">
                <h4 class="title_nav">Hóa đơn</h4>
                <ul class="subnav">
                    <li>
                        <div class="line1"></div>
                        <div class="line2"></div>
                        <div class="layout1"></div>
                        <img class="icon_nav" src="./assets/icon/bill.png" alt="">
                        <h4 class="title_nav">Hóa đơn</h4>
                    </li>
                    <li>
                        <div class="line1"></div>
                        <div class="line2"></div>
                        <div class="layout1"></div>
                        <img class="icon_nav" src="./assets/icon/receipt.png" alt="">
                        <h4 class="title_nav">Biên lai</h4>
                    </li>
                </ul>
            </li>
            <li>
                <div class="line"></div>
                <div class="layout"></div>
                <img class="icon_nav" src="./assets/icon/supplier.png" alt="">
                <h4 class="title_nav">Nhà cung cấp</h4>
            </li>
            <li>
                <div class="line"></div>
                <div class="layout"></div>
                <img class="icon_nav" src="./assets/icon/transport.png" alt="">
                <h4 class="title_nav">Nhà vận chuyển</h4>
            </li>
        </ul>



    </div>
    <div style="flex:4; background-color:lightblue;">
        <?php
        if (isset($_GET['chon'])){
            if ($_GET['chon'] =='qlnv'){
                if (isset($_GET['id'])){

                    switch($_GET['id']){

                        case 'chucvu':
                            include("./View/admin/chucVu.php");
                            break;
                        
                       
                    }
                }
            }
            elseif ($_GET['chon'] == 'qlsp'){
                if (isset($_GET['id'])){
                    switch($_GET['id']){
                        case 'sanpham':
                            include("./View/admin/sanpham.php");
                            break;
                        case 'loaisp':
                            include("./View/admin/loaisp.php");
                            break;
                            
                    }
                }
            }
            else if($_GET['chon'] =='dashboard'){
                    if (isset($_GET['id'])){
    
                        switch($_GET['id']){
    
                            case 'groups':
                                include("./View/admin/groups.php");
                                break;
                            case 'account':
                                include("./View/admin/account.php");
                                break;
                            case 'discount':
                                include("./View/admin/discount.php");
                                break;
                           
                        }  
                    }
            }
        }
        ?>
    </div>
</div>





<!-- <div style="flex:4;background-color: lighblue;border: 2px solid red;" class="right-content">

    </div> -->