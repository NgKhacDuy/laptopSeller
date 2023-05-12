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
<section>
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
                      style="width: 100%"
                      src="View/admin/uploads/<?php echo $result['HinhAnh'] ?>"
                      alt="ảnh chính "
                    />
                    <div class="small-pic">
                      <img
                        class="active_hover"
                        src="View/admin/uploads/<?php echo $result['HinhAnh'] ?>"
                        alt="ảnh phụ"
                      />
                      <img
                        class="active_hover"
                        src="View/admin/uploads/<?php echo $result['HinhAnh'] ?>"
                        alt="ảnh phụ"
                      />
                      <img
                        class="active_hover"
                        src="View/admin/uploads/<?php echo $result['HinhAnh'] ?>"
                        alt="ảnh phụ"
                      />
                    </div>
                  </div>
                </div>
                <div class="col-xs-12" style="padding-top: 50px">
                  <div class="laptop_description">
                    <h3 style="text-align: center"><?php echo $result['TenSP'] ?></h3>
                    <h4><?php echo $format->format_currency($result['Gia'] )?> đ</h4>
                    <p>
                      MacBook Air with M1 is an incredibly portable laptop —
                      it’s nimble and quick, with a silent, fanless design and a
                      beautiful Retina display. Thanks to its slim profile and
                      all‑day battery life, this Air moves at the speed of
                      lightness.
                    </p>

                    <div class="color-container">
                      <button
                        id="black-color"
                        class="btn btn-info active_hover"
                        style="
                          height: 50px;
                          width: 50px;
                          background-color: black;
                          border-radius: 100%;
                          transition: top 0.2s ease;
                        "
                      ></button>
                      <button
                        id="gray-color"
                        class="btn btn-info active_hover"
                        style="
                          height: 50px;
                          width: 50px;
                          background-color: rgb(176, 176, 176);
                          border-radius: 100%;
                          transition: top 0.2s ease;
                        "
                      ></button>
                      <button
                        id="gold-color"
                        class="btn btn-info active_hover"
                        style="
                          height: 50px;
                          width: 50px;
                          background-color: rgb(217, 255, 112);
                          border-radius: 100%;
                          transition: top 0.2s ease;
                        "
                      ></button>
                    </div>

                    <div style="display: flex; justify-content: center">
                      <p style="flex: 1; text-align: end; line-height: 40px">
                      Price: <?php echo $format->format_currency($result['Gia'] )?>Đ
                      </p>
                      <div style="flex: 1; padding-left: 10px">
                        <button
                          style="
                            width: 100%;
                            background-color: rgb(255, 255, 255);
                            color: rgb(0, 0, 0);
                            transition: top 0.2s ease;
                            width: 120px;
                            float: left;
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
                class="nav-link active"
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
                class="nav-link"
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
              <div>
                <h2><?php echo $result['title'] ?></h2>
                <p>
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