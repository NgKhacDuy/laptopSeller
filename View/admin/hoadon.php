<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="vendor/bootstrap_5/css/bootstrap.css">
</head>
<body>
    <?php
    include '../../Model/admin/bill.php';
    include '../../Model/admin/user.php';
    $user = new user();
    $bill = new bill();
    $fm = new format();
        if(isset($_GET['id'])){
            $idBL = $_GET['id'];
        }
        $getBill = $bill->get_Bill_by_Id($idBL);
        if($getBill){
            while($show = $getBill -> fetch_assoc()){
                $getUser = $user->Get_UserById($show['MaKH']);
                if($getUser){
                    $userName = $getUser->fetch_assoc();
                }
                
    ?>
<div class="card" style="margin:8px auto; width:42%;">
  <div class="card-body mx-4">
    <div class="container">
      <p class="my-5 " style="font-size: 24px;">Cảm ơn đã mua sắm tại cửa hàng</p>
      <div class="row">
        <ul class="list-unstyled">
          <li class="text-black"><?php echo $userName['TenKH'] ?></li>
          <li class="text-muted mt-1"><span class="text-black">Đơn hàng</span> #<?php echo $show['MaBL'] ?></li>
          <li class="text-black mt-1"><?php echo $show['ngaytao'] ?></li>
        </ul>
        <hr>
      </div>
      <?php
            }
        }
      ?>
      <?php
        $getBillDetail = $bill->get_BillDetails($idBL);
        if($getBillDetail){
            while($showDetail = $getBillDetail -> fetch_assoc()){
      ?>
      <div class="row">
        <div class="col-xl-8">
          <p><?php echo $showDetail['TenSP'] ?></p>
        </div>
        <div class="col-xl-2">
          <p class="float-end"><?php echo $showDetail['SoLuong'] ?>x
          </p>
        </div>
        <div class="col-xl-2">
          <p class="float-end"><?php echo $fm->format_currency($showDetail['DonGia']) ?>đ
          </p>
        </div>
        <hr>
      </div>
      <?php
    }
}
?>
      <div class="row text-black">
        <?php
            $getBill = $bill->get_Bill_by_Id($idBL);
            if($getBill){
                while($show = $getBill -> fetch_assoc()){
        ?>
        <div class="col-xl-12">
          <p class="float-end fw-bold">Tổng cộng: <?php echo $fm->format_currency($show['tongtien']) ?>đ
          </p>
        </div>
        <?php
            }
        }
        ?>
        <hr style="border: 2px solid black;">
      </div>
      <div class="text-center" style="margin-top: 60px;">
        <p>Vui lòng giữ lại biên lai và sản phẩm trong vòng 7 ngày để được đổi trả miễn phí. </p>
      </div>
    </div>
  </div>
</div>

<div class="printpdf" style="text-align:center;">
    <button class="btn btn-primary">In hóa đơn</button>
</div>
</body>
</html>