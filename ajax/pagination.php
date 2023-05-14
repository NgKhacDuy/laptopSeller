<?php
include '../Model/admin/product.php';
$product = new product();
$format = new Format();
  $num_per_page = 8;
  $page ='';
  $output = '';
  $pagination ='';
  if(isset($_POST["page"])){
    $page = $_POST["page"];
  }
  else{
    $page = 1;
  }
  // if(isset($_POST['minPrice']) && isset($_POST['maxPrice'])){
  //   $m
  // }
  $start_from=($page-1)*$num_per_page;
  if(isset($_POST['q'])){
    $search = $_POST['q'];
    $show = $product->ShowAllProduct($start_from,$num_per_page,$search,'');
  }
  elseif(isset($_POST['brand'])){
    $brand = $_POST['brand'];
    $show = $product->ShowAllProduct($start_from,$num_per_page,'',$brand);
  }
  else{
    $show = $product->ShowAllProduct($start_from,$num_per_page,'','');
  }

            if($show){
              while($result = $show->fetch_assoc()){
                $output .='
                <div id="san_pham" class="card" style="width: 18rem" data-price="'.$result['Gia'].'">
                <img src="View/admin/uploads/'.$result['HinhAnh'].'" class="card-img-top" alt="..." />
                <div class="card-body">
                  <h5 class="card-title">'.$result['TenSP'].'</h5>
                  <p class="card-text" style="text-align: center">
                    '.$format->format_currency($result['Gia']).' đ
                  </p>
                  <button
                    onclick="location.href=\'sanpham?id='.$result['MaSP'].'\'"
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
                ';
              }
            }
            $showNum = $product->getNumberOfProduct();
    if($showNum){
        $count = $showNum->fetch_assoc();
    }
    $totalRecord = $count['count'];
    $totalPage = ceil($totalRecord/$num_per_page);
    for($i=1;$i<=$totalPage;$i++){
        $pagination .= '<li id='.$i.' class="page-item"><a class="page-link" href="#">'.$i.'</a></li>';  
    }
    echo $output.'|'.$pagination;
    ?>
      