<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

?>
<?php include '../../Model/admin/product.php'?>
<?php include '../../Model/admin/bill.php'?>
<?php
    $fm=new format();
    $name = $_GET['name'];
    $bill = new bill();
    $product = new product();
?>
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Lịch sử đơn hàng
            
    </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">

     <form action="" method="POST">
      <div class="scroll">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> Mã sản phẩm </th>
            <th> Tên sản phẩm </th>
            <th> Hình ảnh </th>
            <th> Số lượng </th>
            <th> Đơn giá  </th>
            <th> Thành tiền </th>
            <th> Ngày mua </th>
          </tr>
        </thead>
        <tbody>
          <?php
           
            $listBill = $bill->getHistoryBill($name);
            if($listBill){
              while ($result = $listBill->fetch_assoc()) {
                
          ?>
          <tr>
            <td> <?php echo $result['MaSP']; ?> </td>
            <td> <?php echo $result['TenSP']; ?> </td>
            <td> <img src="uploads/<?php echo $result['HinhAnh']; ?>" width="70" alt=""> </td>
            <td> <?php echo $result['SoLuong']; ?></td>
            <td> <?php echo $fm->format_currency($result['DonGia']); ?>Đ</td> 
            <td> <?php echo $fm->format_currency($result['ThanhTien']) ?>Đ</td>
            <td>
                <?php echo $result['NgayXuat']; ?></td> 
            </td>
            
          </tr>
        <?php
            }
        }
            ?>  
        </tbody>
      </table>
      </div>
       </form>

    </div>
  </div>
</div>

</div>