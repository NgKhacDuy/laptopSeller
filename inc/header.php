<?php
  include 'lib/session.php';
  include_once ("lib/database.php");
    include_once ("helpers/format.php");
    Spl_autoload_register(function ($className){ 
        include_once ("Model/admin/".$className.".php");
    });
  session::init();
  $brand = new brand();
  $db=new database();
  $fm=new format();
  $ct=new cart();
  $cat=new category();
  $brand = new brand();
  $pro=new product();
  $city=new city();
  $user=new User();
  $bill=new bill();
  if(isset($_GET['customer_user'])){
    Session::destroy();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="vendor/bootstrap_5/css/bootstrap.css">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/homePage.scss">
    <style>
      .brand-item {
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: flex-start;
      }
      .brand-item > a {
        font-weight: normal;
        margin-top: 8px;
        text-decoration: none;
        color: #202020;
        position: relative;
        top: 0;
        transition: right 0.2s ease;
      }
      .brand-item > a:hover {
        right: -3px;
        text-decoration: underline;
      }
    </style>
</head>
<body>
<header></header>
    <main>
      <section style="background-color: #E8E8E8; padding-bottom: 20px" class="header">
        <button
          class="btn"
          id="menu_btn"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasScrolling"
          aria-controls="offcanvasScrolling"
        >
          <i class="ti-menu"></i>
        </button>

        <div
          class="offcanvas offcanvas-start"
          style="background-color: #bcbcbc"
          data-bs-scroll="true"
          data-bs-backdrop="false"
          tabindex="-1"
          id="offcanvasScrolling"
          aria-labelledby="offcanvasScrollingLabel"
        >
          <div class="offcanvas-header">
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="offcanvas"
              aria-label="Close"
            ></button>
          </div>
          <div class="offcanvas-body">
            <div class="nav_the-loai">
              <a href="" class="nav_the-loai-item">LAPTOP</a>
              <a href="" class="nav_the-loai-item">PHONE</a>
              <a href="" class="nav_the-loai-item">IPAD</a>
              <a href="" class="nav_the-loai-item">PC</a>
              <a href="" class="nav_the-loai-item">SUPPORT</a>
              <div>
                <button href="" class="btn">
                  <i class="ti-search"></i>
                </button>
                <button href="" class="btn">
                  <i class="ti-bag"></i>
                </button>

                <a class="btn btn-facebook" href="dangnhap">
                  Đăng Nhập</a
                >
                <a
                  class="btn btn-facebook"
                  href="dangky"
                >
                  Đăng Ký</a
                >
              </div>
            </div>
          </div>
        </div>

        <a style="text-decoration:none;color:black;" href="trangchu">
          <h2 class="title">WEBSITE</h2>
        </a>
        <div style="padding: top 15px; align-items:center;" class="nav_the-loai full_screnn">
          <a
            id="laptop_brand"
            class="nav_the-loai-item"
            data-bs-toggle="collapse"
            href="#collapseExample3"
            role="button"
            aria-expanded="false"
            aria-controls="collapseExample3"
            >LAPTOP <i style="font-size: 15px" class="ti-angle-down"></i
          ></a>
          <a
            id="phone_brand"
            class="nav_the-loai-item"
            data-bs-toggle="collapse"
            href="#collapseExample3"
            role="button"
            aria-expanded="false"
            aria-controls="collapseExample3"
            >PHONE <i style="font-size: 15px" class="ti-angle-down"></i
          ></a>
          <a href="" class="nav_the-loai-item">IPAD</a>
          <a href="" class="nav_the-loai-item">PC</a>
          <a href="" class="nav_the-loai-item">SUPPORT</a>

          <div style="display:flex; align-items:center;">
            <button
              class="btn"
              data-bs-toggle="collapse"
              href="#collapseExample"
              role="button"
              aria-expanded="false"
              aria-controls="collapseExample"
            >
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <button onclick="location.href='giohang'" class="btn">
              <i class="fa-solid fa-cart-shopping"></i>
            </button>
            <?php 
               $check = Session::get('customer_login');
                if($check== false){
            ?>
            <a class="btn btn-facebook" href="dangnhap">
              Đăng Nhập</a
            >
            <a
              class="btn btn-facebook"
              href="dangky"
            >
              Đăng Ký</a
            >
            <?php
              } else{
                $Cus = $user->Get_User(Session::get('customer_user'));
                if($Cus){
                  $idCus = $Cus->fetch_assoc();
                }
            ?>
            <div class="user-block">
              <i style="font-size: 20px; margin-left:10px;cursor:pointer;" id="dropdownMenuButton" data-toggle="dropdown" class="dropdown-toggle fa-solid fa-user"></i>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item disabled" href="#"><?php echo $idCus['TenKH'] ?></a>
                <a class="dropdown-item" href="user">Thông tin cá nhân</a>
                <a class="dropdown-item" href="donhang">Đơn hàng & lịch sử mua hàng</a>
                <a class="dropdown-item" href="?customer_user=<?php echo Session::get('customer_user') ?>">Đăng xuất</a>
              </div>
            </div>
            <?php
              }
            ?>
          </div>
        </div>
      </section>
      <div class="collapse" id="collapseExample">
        <div class="card card-body" style="padding: 0">
          <div class="row">
            <div
              class="table__header d-flex justify-content-center"
            
            >
              <div class="input-group" style="position: relative">
                <input id="search" type="search" placeholder="Search Data..." />
                <!-- <img style="vertical-align: top" src="./img/search.png" alt="" /> -->
                <!-- <div style="position: absolute; top: 20px; right: 20px">
              <i style="width: 30px" class="ti-search"> </i>
            </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="collapse" id="collapseExample3">
        <div class="card card-body" style="padding: 0">
          <div class="row">
            <div
              class="table__header d-flex justify-content-center"
              style="background-color: #bcbcbc; border: 0"
            >
              <div class="container">
                <div class="row">
                  <div class="col-md-3">
                    <p class="brand-title">BRAND</p>
                    <div class="brand-item">
                      <a href="" id="asus">Asus</a>
                      <a href="" id="samsung">SamSung</a>
                      <a href="" id="apple">Apple</a>
                      <a href="" id="huawei">Huawei</a>
                      <a href="" id="dell">Dell</a>
                      <a href="" id="hp">HP</a>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <p class="brand-title">CONFIGURATION</p>
                    <div class="brand-item">
                      <a href="" id="asus">Core i3</a>
                      <a href="" id="samsung">Core i5</a>
                      <a href="" id="apple">Core i7</a>
                      <a href="" id="huawei">Core i9</a>
                      <a href="" id="dell">Aplle M1</a>
                      <a href="" id="hp">Apple M1 Pro</a>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <p class="brand-title">PRICE</p>
                    <div class="brand-item">
                      <a href="" id="asus"> < 10Tr</a>
                      <a href="" id="samsung">10Tr - 15Tr</a>
                      <a href="" id="apple">15Tr - 20Tr</a>
                      <a href="" id="huawei">20Tr - 25Tr</a>
                      <a href="" id="dell"> > 25Tr</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<script>
document.getElementById("search").addEventListener("keyup", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
    var query = this.value;
    var href = "danhsachsanpham?q=" + query;
    location.href = href;
  }
});

</script>

