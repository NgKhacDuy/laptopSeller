<?php
ob_start();
    include 'inc/header.php'
?>
<?php
  $login = Session::get('customer_login');
  if($login == false){
    header('Location:dangnhap');
  }
?>
<table class="table" style="border: 1px solid #ccc;margin: 35px auto;width: 80%;">
  <thead>
    <tr>
      <th scope="col">Tên sản phẩm</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Đơn giá</th>
      <th scope="col">Thành tiền</th>
      <th scope="col">Ngày mua</th>
      <th scope="col">Trạng thái đơn hàng</th>
    </tr>
  </thead>
  <tbody>
    
    <?php
        $Cus = $user->Get_User(Session::get('customer_user'));
        if($Cus){
          $idCus = $Cus->fetch_assoc();
        }
        $show = $ct->getCartById($idCus['MaKH']);
        if($show){
            while($result = $show->fetch_assoc()){
    ?>
    <tr>
      <th scope="row"><?php echo $result['TenSP']; ?></th>
      <td><?php echo $result['SoLuong']; ?></td>
      <td><?php echo $fm->format_currency($result['DonGia']); ?>đ</td>
      <td><?php echo $fm->format_currency($result['ThanhTien']); ?>đ</td>
      <td><?php echo $result['ngaytao']; ?></td>
      <td><?php echo $result['status']; ?></td>
    </tr>
    <?php
            }
        }
    ?>
  </tbody>
</table>
<?php
ob_end_flush();
include 'inc/footer.php'
?>