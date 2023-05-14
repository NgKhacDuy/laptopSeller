<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

?>
<?php include '../../Model/admin/brand.php'?>
<?php include '../../Model/admin/category.php'?>
<?php include '../../Model/admin/product.php'?>
<?php include '../../Model/admin/user.php'?>

<style type="text/css">
  .scroll{
  height: 700px;
  overflow: scroll;
}
</style>
<?php 
  $fm=new format();
  $brand = new brand();
  $cat = new category();
  $prod = new product();
  $user = new User();
  
          if(isset($_POST["delete_id"])){
          $id = $_POST["delete_id"];
        $delbrand = $prod->delete_productName($id);
          }
   
 ?>

<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registerbtn'])){

       

        $insertProd = $prod->insert_product($_POST,$_FILES);
    }
       ?>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm khách hàng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
     
      <form action="" method="POST" enctype="multipart/form-data">

        <div class="modal-body">

            <div class="form-group">

                <label> Tên Sản Phẩm </label>
                <input type="text" name="productName" class="form-control" placeholder="Enter Product">
            </div>
             <div class="form-group">
              <label >Thương Hiệu</label>
                <select class="form-control" id="brand" name="brand">
                  <?php
                                $brand = new brand();
                                $brandlist = $brand->show_brand();
                                if($brandlist){
                                    while ($result = $brandlist->fetch_assoc()) {
                                        
                            ?>
                                 <option value="<?php echo $result['TenThuongHieu']?>"><?php echo $result['TenThuongHieu']?></option>
                            <?php  
                                }
                            }
                            ?>

                </select>
            </div>
             <div class="form-group">
              <label >Category</label>
                <select id="category" name="category" class="form-control">
                    <option>Chọn Danh Mục</option>

                    <?php
                                $cat = new category();
                                $catlist = $cat->show_category();
                                if($catlist){
                                    while ($result = $catlist->fetch_assoc()) {
                                        
                            ?>
                                 <option value="<?php echo $result['TenLoaiSP']?>" data-name="<?= $result['TenLoaiSP'] ?>"><?php echo $result['TenLoaiSP']?></option>
                            <?php  
                                }
                            }
                            ?>

                </select>
            </div>
            <div class="form-group">

                <label> Giá </label>
                <input type="text" name="price" class="form-control" placeholder="Enter price">
            </div>
            <div class="form-group">

                <label> Số Lượng </label>
                <input type="text" name="quantity" class="form-control" placeholder="Enter quantity">
            </div>
            <div class="form-group">

                <label> Ảnh </label>
                <input type="file" name="image" class="form-control" >
            </div>
<!--             <div class="form-group">

                <label> Image Thumbnail </label>
                <input type="file" name="thumb1" class="form-control" >
                <input type="file" name="thumb2" class="form-control" >
                <input type="file" name="thumb3" class="form-control" >
                <input type="file" name="thumb4" class="form-control" >
            </div> -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="submit" name="registerbtn" class="btn btn-primary">Lưu</button>
        </div>
      </form>

    </div>
  </div>
</div>


 
<!-- /.container-fluid -->






<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Danh Sách khách hàng
            
    </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">

     <form action="" method="POST">
      <div class="scroll">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> ID </th>
            <th> Tên khách hàng </th>
            <th> Địa chỉ </th>
            <th> Tổng tiền đã mua  </th>
            <th> Lịch sử đơn hàng </th>
          </tr>
        </thead>
        <tbody>
          <?php
           
            $userList = $user->Show_CustomerAdmin();
            if($userList){
              $i = 0;
              while ($result = $userList->fetch_assoc()) {
                $i++;
            
          ?>
          <tr>
            <td> <?php echo $result['MaKH']; ?> </td>
            <td> <?php echo $result['TenKH']; ?></td>
            <td> <?php echo $result['diachi']; ?></td> 
            <td> <?php echo $fm->format_currency($result['tongtien']) ?>Đ</td>
            <td>
              <form action="" method="post ">
                <a href="lichsudonhang.php?name=<?php echo $result['MaKH']?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Lịch sử đơn hàng </a>
               </form>
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

<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>