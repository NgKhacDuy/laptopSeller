<?php
include '../Model/admin/product.php';
$product = new product();
$format = new Format();
  $num_per_page = 8;
  $page ='';
  $output = '';
  if(isset($_POST["page"])){
    $page = $_POST["page"];
  }
  else{
    $page = 1;
  }
  $start_from=($page-1)*$num_per_page;
  if(isset($_POST['q'])){
    $search = $_POST['q'];
    $show = $product->ShowAllProduct($start_from,$num_per_page,$search);
  }
  else{
    $show = $product->ShowAllProduct($start_from,$num_per_page,'');
  }

            if($show){
              while($result = $show->fetch_assoc()){
                $output .='
                <div class="col" style="width:50%; min-height: 400px; display: flex;">
                <div class="text-center card text-black" style="width: 100%; height: 100%;">
                    <img style="width:60%;margin-top:46px;margin-bottom:30px" src="View/admin/uploads/'.$result['HinhAnh'].'"
                    class="text-center mx-auto d-block card-img-top" alt="Apple Computer" />
                    <div class="card-body">
                    <div class="text-center">
                        <h3 class="text-center bold text-muted mb-4">'.$result['TenSP'].'</h3>
                        <h4 class="text-center card-title">'.$format->format_currency($result['Gia']).'đ</h4>
                    </div>
                    <a href="sanpham?id='.$result['MaSP'].'" class="link-primary">Buy now</a>
                    </div>
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
    $output .='
    <nav style="margin-top:16px;" aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
    ';
    for($i=1;$i<=$totalPage;$i++){
        $output .= '<li id='.$i.' class="page-item"><a class="page-link" href="#">'.$i.'</a></li>';  
    }
    $output.='
        </ul>
    </nav>';
    echo $output;
    ?>
      