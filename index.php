<?php
    include 'inc/header.php'
?>
<!-- <?php //include 'Model/admin/product.php'?> -->
<?php
  $format = new Format();
  $product = new product();
?>
<section style="background-color: #E8E8E8">
        <div id="carouselExampleCaptions" class="carousel slide">
          <div class="carousel-indicators">
            <button
              type="button"
              data-bs-target="#carouselExampleCaptions"
              data-bs-slide-to="0"
              class="active"
              aria-current="true"
              aria-label="Slide 1"
            ></button>
            <button
              type="button"
              data-bs-target="#carouselExampleCaptions"
              data-bs-slide-to="1"
              aria-label="Slide 2"
            ></button>
            <button
              type="button"
              data-bs-target="#carouselExampleCaptions"
              data-bs-slide-to="2"
              aria-label="Slide 3"
            ></button>
          </div>
          <div class="carousel-inner">
          <?php
            $show = $product->getTop3Seller();
            if($show){
              while($result = $show->fetch_assoc()){
                $prod = $product->getproductByid($result['MaSP']);
                if($prod){
                  while($resultPro = $prod->fetch_assoc()){
                    $listImg = $product->get3ImgByIDPro($resultPro['MaSP']);
            ?>
            <div class="carousel-item">
              <div class="container">
                <div class="row main_slide">
                  <div class="col-lg-6">
                    <div class="main_pic">
                      <img
                        style="width: 100%"
                        src="View/admin/uploads/<?php echo $resultPro['HinhAnh'] ?>"
                        alt="ảnh chính "
                      />
                      <div class="small-pic">
                      <?php
                    if($listImg){
                      while($img=$listImg->fetch_assoc()){
                    ?>
                        <div class="active_hover"><img
                          class=" subimg"
                          src="View/admin/uploads/<?php echo $resultPro['HinhAnh'] ?>"
                          alt="ảnh phụ"
                        /></div>
                        <?php
                      }
                    }
                      ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="laptop_description">
                      <h3><?php echo $resultPro['TenSP'] ?></h3>
                      <h4><?php echo $fm->format_currency($resultPro['Gia']) ?> Đ</h4>
                      <p>
                      <?php echo $resultPro['MoTaNgan']?>
                    </p>

                      <button
                        onclick="location.href='sanpham?id=<?php echo $resultPro['MaSP']?>'"
                        style="
                          width: 350px;
                        height: 50px;
                        background-color: rgb(55,82, 120);
                        color: white;
                          
                        
                        font-size: 14px;

                        "
                        type="button"
                        class="btn btn-info active_hover"
                      >
                        BUY NOW
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="carousel-caption d-none d-md-block">
                <h3>huynh lam duy</h3>
                <h4>dai hoc sai gon</h4>
              </div> -->
            </div>

            <?php
                  }
                }
              }
            }
            ?>
           
            
          </div>
          <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </section>

      <section>
        <div class="relate-product">
          <h3>RELATE PRODUCT</h3>
          <div class="product-list-container">
            <div class="product-list">
              <div id="san_pham" class="card" style="width: 18rem">
                <img src="./img/img_1.png" class="card-img-top" alt="..." />
                <div class="card-body">
                  <h5 class="card-title">Macbook Air M2</h5>
                  <p class="card-text" style="text-align: center">
                    32.000.000 đ
                  </p>
                  <button
                    style="
                      width: 100%;
                      background-color: rgb(255, 255, 255);
                      color: black;
                      border: none;
                      transition: top 0.2s ease;
                    "
                    id="buy_now"
                    type="button"
                    class="btn btn-info active_hover"
                  >
                    <strong>BUY NOW</strong>
                  </button>
                </div>
              </div>
              <div id="san_pham" class="card" style="width: 18rem">
                <img src="./img/img_1.png" class="card-img-top" alt="..." />
                <div class="card-body">
                  <h5 class="card-title">Macbook Air M2</h5>
                  <p class="card-text" style="text-align: center">
                    32.000.000 đ
                  </p>
                  <button
                    style="
                      width: 100%;
                      background-color: rgb(255, 255, 255);
                      color: black;
                      border: none;
                      transition: top 0.2s ease;
                    "
                    id="buy_now"
                    type="button"
                    class="btn btn-info active_hover"
                  >
                    <strong>BUY NOW</strong>
                  </button>
                </div>
              </div>
              <div id="san_pham" class="card" style="width: 18rem">
                <img src="./img/img_1.png" class="card-img-top" alt="..." />
                <div class="card-body">
                  <h5 class="card-title">Macbook Air M2</h5>
                  <p class="card-text" style="text-align: center">
                    32.000.000 đ
                  </p>
                  <button
                    style="
                      width: 100%;
                      background-color: rgb(255, 255, 255);
                      color: black;
                      border: none;
                      transition: top 0.2s ease;
                    "
                    id="buy_now"
                    type="button"
                    class="btn btn-info active_hover"
                  >
                    <strong>BUY NOW</strong>
                  </button>
                </div>
              </div>
              <div id="san_pham" class="card" style="width: 18rem">
                <img src="./img/img_1.png" class="card-img-top" alt="..." />
                <div class="card-body">
                  <h5 class="card-title">Macbook Air M2</h5>
                  <p class="card-text" style="text-align: center">
                    32.000.000 đ
                  </p>
                  <button
                    style="
                      width: 100%;
                      background-color: rgb(255, 255, 255);
                      color: black;
                      border: none;
                      transition: top 0.2s ease;
                    "
                    id="buy_now"
                    type="button"
                    class="btn btn-info active_hover"
                  >
                    <strong>BUY NOW</strong>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section>
        
        <div class="product-list-container" style="position: relative">
          <div class="product-list make-center">
            <div class="card" style="width: 18rem">
              <img src="./img/img_1.png" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title">Macbook Air M2</h5>
                <p class="card-text" style="text-align: center">32.000.000 đ</p>
                <button
                  style="
                    width: 100%;
                    background-color: rgb(255, 255, 255);
                    color: black;
                    border: none;
                    transition: top 0.2s ease;
                  "
                  type="button"
                  class="btn btn-info active_hover"
                >
                  BUY NOW
                </button>
              </div>
            </div>
            <div class="card card_High" style="width: 18rem">
              <img src="./img/img_1.png" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title">Macbook Air M2</h5>
                <p class="card-text" style="text-align: center">32.000.000 đ</p>
                <button
                  style="
                    width: 100%;
                    background-color: rgb(255, 255, 255);
                    color: black;
                    border: none;
                    transition: top 0.2s ease;
                  "
                  type="button"
                  class="btn btn-info active_hover"
                >
                  BUY NOW
                </button>
              </div>
            </div>
            <div class="card card_High" style="width: 18rem">
              <img src="./img/img_1.png" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title">Macbook Air M2</h5>
                <p class="card-text" style="text-align: center">32.000.000 đ</p>
                <button
                  style="
                    width: 100%;
                    background-color: rgb(255, 255, 255);
                    color: black;
                    border: none;
                    transition: top 0.2s ease;
                    margin-top: -40px;
                  "
                  type="button"
                  class="btn btn-info active_hover"
                >
                  BUY NOW
                </button>
              </div>
            </div>
            <div class="card" style="width: 18rem">
              <img src="./img/img_1.png" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title">Macbook Air M2</h5>
                <p class="card-text" style="text-align: center">32.000.000 đ</p>
                <button
                  style="
                    width: 100%;
                    background-color: rgb(255, 255, 255);
                    color: black;
                    border: none;
                    transition: top 0.2s ease;
                  "
                  type="button"
                  class="btn btn-info active_hover"
                >
                  BUY NOW
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="best_seller" style="background-color:#444;">
          <h3 style="padding: 40px 0 0 0;  text-align: center; letter-spacing: 0.3em; font-weight: 500; color: white;">
            BEST SELLER
          </h3>
          <div class="container-fluid">
            <div class="row">
              <div
                class="col-md-12"
                style="height: 300px; background-color: #444"
              ></div>
              <div
                class="col-md-12"
                style="height: 300px; background-color: #f5f5f5"
              ></div>
              
            </div>
          </div>
        </div>
      </section>

      <div><img src="img/Group 67.png" style="width: 80%;"></div>
      <!-- <section style="padding-top: 200px">
        <div class="container only-picture">
          <div class="row">
            <div class="col-md-8" style="margin-right: 15px">
              <div class="row">
                <div
                  class="col-md-12"
                  style="
                    background-color: #e12245;
                    display: flex;
                    justify-content: center;
                    margin-bottom: 15px;
                  "
                >
                  <img src="./img/image 22.png" alt="" />
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div
                      class="col-md-8"
                      style="
                        background-color: #000;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        width: 70%;
                        margin-right: 15px;
                      "
                    >
                      <img
                        style="width: 80%"
                        src="./img/hero_endframe__ea0qze85eyi6_large_2x 2.png"
                        alt=""
                      />
                    </div>
                    <div
                      class="col-md-4"
                      style="
                        background-color: #f4e241;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        width: 28%;
                      "
                    >
                      <img
                        style="width: 100%"
                        src="./img/image 23.png"
                        alt=""
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="col-md-3"
              style="
                background-color: #64a795;
                display: flex;
                justify-content: center;
                align-items: center;
              "
            >
              <img style="width: 100%" src="./img/image 24.png" alt="" />
            </div>
          </div>
        </div>
      </section> -->

<script>
  // Get the parent element
var parentSlider = document.querySelector(".carousel-inner");

// Get the first child element
var firstChild = parentSlider.firstElementChild;

// Add the 'active' class to the first child
firstChild.classList.add("active");
</script>
<?php
    include 'inc/footer.php'
?>