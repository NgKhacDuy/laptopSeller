<?php
ob_start();
    include 'inc/header.php'
?>
<!-- <?php //include 'Model/admin/product.php'?> -->

<?php
  $format = new Format();
  $product = new product();
  if(isset($_GET['id'])){
    $id = $_GET['id'];
  }

?>
<link rel="stylesheet" href="assets/css/chitietsanpham.css">
<section style="background-color: #E8E8E8;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="container">
              <div
                class="row main_slide"
                style="display: flex; flex-wrap: wrap"
              >
                <div class="col-xs-12">
                  <div class="main_pic">
                    <?php 
                        $showProd = $product->getproductByid($id);
                        if($showProd){
                            while($result = $showProd->fetch_assoc()){
                    ?>
                    <img
                      style="width: 70%; padding-top:50px"
                      src="View/admin/uploads/<?php echo $result['HinhAnh'] ?>"
                      alt="ảnh chính "
                    />
                    <div class="small-pic">
                    <?php
                      $listImg = $product->getImgByIDPro($id);
                      if($listImg){
                        while($img=$listImg->fetch_assoc()){
                      ?>
                      <div class="active_hover">
                      <img
                        class=""
                        src="View/admin/uploads/<?php echo $img['Img'] ?>"
                        alt="ảnh phụ"
                      /></div>
                      <?php
                      }
                    }
                      ?>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12" style="padding-top: 50px">
                  <div class="laptop_description">
                    <h3 style="text-align: center" class="title"><?php echo $result['TenSP'] ?></h3>
                    <!-- <h4><?php echo $format->format_currency($result['Gia'] )?> đ</h4> -->
                    <p style="padding: 0 240px;text-align: center;">
                    <?php echo $result['MoTaNgan'] ?>
                    </p>

                    <div class="color-container">
                      <button
                        id="black-color"
                        class="btn btn-info active_hover"
                        style="
                          height: 25px;
                          width: 25px;
                          background-color: #B3B2B4;
                          border-radius: 100%;
                          transition: top 0.2s ease;
                          border: none;
                        "
                      ></button>
                      
                    </div>

                    <div style="display: flex; justify-content: center">
                      <p style="flex: 1; text-align: end; line-height: 25px;font-size:18px">
                      Price: <?php echo $format->format_currency($result['Gia'] )?>đ<span style="font-size: 30px;"> |  </span>
                      </p>
                      <div style="flex: 1; padding-left: 10px">
                        <button
                          style="
                            width: 400px;
                            background-color: #375278;
                            color: white;
                            transition: top 0.2s ease;
                            width: 120px;
                            float: left;
                            font-size: 15px;
                            border-radius: 30px;
                            letter-spacing: 0.1em;
                          "
                          type="button"
                          class="btn active_hover"
                        >
                          <strong id="btn-buy">BUY NOW</strong>
                          <?php
                            }
                        }
                          ?>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<section>
      <div class="container">
        <div class="row" style="padding-top: 50px; padding-left: 20px">
          <ul
            class="nav nav-underline d-flex justify-content-center"
            id="myTab"
            role="tablist"
          >
            <li class="nav-item" role="presentation">
              <button
                class="nav-link active font_weight400"
                id="home-tab"
                data-bs-toggle="tab"
                data-bs-target="#home"
                type="button"
                role="tab"
                aria-controls="home"
                aria-selected="true"
              >
                Mô tả sản phẩm
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link font_weight400"
                id="profile-tab"
                data-bs-toggle="tab"
                data-bs-target="#profile"
                type="button"
                role="tab"
                aria-controls="profile"
                aria-selected="false"
              >
                Thông tin chi tiết
              </button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div
              class="tab-pane fade show active"
              id="home"
              role="tabpanel"
              aria-labelledby="home-tab"
              style="padding-top: 30px"
            >
            <?php $showMoTa = $product->getMoTaProductById($id);
                  if($showMoTa){
                    while($result = $showMoTa->fetch_assoc()){
            ?>
              <div style=" margin: 100px 0;">
                <h2 style="text-align: left; letter-spacing:0.15em; margin-bottom: 30px;"><?php echo $result['title'] ?></h2>
                <p style="    font-weight: 400;
    letter-spacing: 0.1em;">
                <?php echo $result['content'] ?>
                </p>

                <div class="">
                  <img style="width: 100%" src="View/admin/uploads/<?php echo $result['hinhanh'] ?>" alt="" />
                </div>
              </div>
              <?php
                    }
                  }
              ?>
            </div>
            <div
              class="tab-pane fade"
              id="profile"
              role="tabpanel"
              aria-labelledby="profile-tab"
            >
              <div style="padding-top: 50px">
                <!-- chỗ này nhớ dùng JS chạy vòng lặp xuất ra từng dòng -->
                <?php $showSpec = $product->getThongSoKyThuatProductById($id);
                  if($showSpec){
                    while($result = $showSpec->fetch_assoc()){
                ?>
                <div
                  class="row"
                  style="
                    padding-top: 30px;
                    border-top: 1px solid rgb(192, 192, 192);
                  "
                >
                  <div class="col-md-6"><h4 id="cpu_name"><?php echo $result['title'] ?></h4></div>
                  <div class="col-md-6">
                    <h4 style="text-align: start" id="cpu-info"><?php echo $result['content'] ?></h4>
                  </div>
                </div>
                <?php
                    }
                    }
                ?>
                
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php
      $Cus = $user->Get_User(Session::get('customer_user'));
      if($Cus){
        $idCus = $Cus->fetch_assoc();
      }
    ?>
<script>
  $(document).ready(function() {
  $("#btn-buy").click(function(event) {
    event.preventDefault(); // prevent the form from submitting normally
    <?php
      $login = Session::get('customer_login');
      if($login == false){
        header('Location:login.php');
      }
    ?>
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        alert("Đã thêm sản phẩm vào giỏ hàng");
      }
    };

    var formData = new FormData();
    formData.append('id', <?php echo $id; ?>);
    formData.append('idCus', <?php echo $idCus['MaKH']; ?>);

    xhr.open('POST', 'sanpham.php', true);
    xhr.send(formData);
  });
});
</script>
<?php
if(isset($_POST['id'])){
  $idProduct = $_POST['id'];
  $idCustomer = $_POST['idCus'];
  $insertCart = $ct->AddToCart($idProduct,$idCustomer);
}
?>
<?php
ob_end_flush();
    include 'inc/footer.php'
?>