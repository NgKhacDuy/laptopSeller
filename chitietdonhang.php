<?php
ob_start();
    include 'inc/header.php'
?>
<?php
  $login = Session::get('customer_login');
  if($login == false){
    header('Location:dangnhap');
  }
  if(isset($_GET['id'])){
    $id = $_GET['id'];
  }
?>


<div class="container table-responsive py-5"> 
<table class="table table-bordered table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Mã sản phẩm</th>
      <th scope="col">Tên sản phẩm</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Đon giá</th>
      <th scope="col">Thành tiền</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $show = $ct->getChiTietDonHang($id);
        if($show){
            while($result = $show->fetch_assoc()){
    ?>
    <tr>
      <th scope="row"><a href="sanpham?id=<?php echo $result['MaSP']; ?>"><?php echo $result['MaSP']; ?></a></th>
      <td><?php echo $result['TenSP']; ?></td>
      <td><?php echo $result['SoLuong']; ?></td>
      <td><?php echo $fm->format_currency($result['DonGia']); ?>đ</td>
      <td><?php echo $fm->format_currency($result['ThanhTien']); ?>đ</td>
    </tr>
    <?php
            }
        }
    ?>
  </tbody>
</table>
</div>




<?php
ob_end_flush();
include 'inc/footer.php'
?>