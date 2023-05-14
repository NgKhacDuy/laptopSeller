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
      <th scope="col">Đơn hàng số</th>
      <th scope="col">Tổng tiền</th>
      <th scope="col">Ngày mua</th>
      <th scope="col">Trạng thái đơn hàng</th>
      <th scope="col">Chi tiết đơn hàng</th>
    </tr>
  </thead>
  <tbody>
    
    <?php
        $Cus = $user->Get_User(Session::get('customer_user'));
        if($Cus){
          $idCus = $Cus->fetch_assoc();
        }
        $maBL = '';
        $show = $ct->getDonHangById($idCus['MaKH']);
        if($show){
            while($result = $show->fetch_assoc()){
              $chitietdonhang = $ct->getChiTietDonHang($result['MaBL']);
              // if($chitietdonhang){
                // while($resultDetail = $chitietdonhang->fetch_assoc()){
    ?>
    <tr>
      <th scope="row"><?php echo $result['MaBL']; ?></th>
      <td><?php echo $fm->format_currency($result['tongtien']); ?>đ</td>
      <!-- <td><?php //echo $fm->format_currency($result['DonGia']); ?>đ</td> -->
      <!-- <td><?php //echo $fm->format_currency($result['ThanhTien']); ?>đ</td> -->
      <td><?php echo $result['ngaytao']; ?></td>
      <td><?php echo $result['status']; ?></td>
      <td>
        <button onclick="location.href='chitietdonhang?id=<?php echo $result['MaBL']; ?>' " class="btn btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Chi tiết đơn hàng
        </button>
      </td>
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