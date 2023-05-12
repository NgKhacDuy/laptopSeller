<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

?>
<?php include '../../Model/admin/brand.php'?>
<?php include '../../Model/admin/category.php'?>
<?php include '../../Model/admin/product.php'?>

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
        <h5 class="modal-title" id="exampleModalLabel">Thêm Sản Phẩm</h5>
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
    <h6 class="m-0 font-weight-bold text-primary">Danh Sách Sản Phẩm 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
             Thêm Sản Phẩm
            </button>
    </h6>
  </div>
  <div class="form-outline">
    <input type="search" id="inputSearch" class="form-control" placeholder="Tìm kiếm" aria-label="Search" style="margin:8px auto;width: 80%;"/>
  </div>

  <div class="card-body">

    <div class="table-responsive">

     <form action="" method="POST">
      <div class="scroll">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> ID </th>
            <th> Tên Sản Phẩm </th>
            <th> Ảnh </th>
            <th> Danh Mục </th>
            <th> Thương Hiệu </th>
            <th> Giá </th>
           
            <th> Chi Tiết </th>
            <th> Thao tác </th>
          </tr>
        </thead>
        <tbody>
          <?php
           
            $prodList = $prod->Show_ProductAdmin();
            if($prodList){
              $i = 0;
              while ($result = $prodList->fetch_assoc()) {
                $i++;
            
          ?>
          <tr>
            <td> <?php echo $result['MaSP']; ?> </td>
            <td> <?php echo $result['TenSP']; ?></td>
            <td><img src="uploads/<?php echo $result['HinhAnh']?>" width="70" ></td> 
            <td> <?php echo $result['TenLoaiSP']; ?></td>
            <td> <?php echo $result['TenThuongHieu']; ?></td>
           
             <td>$<?php echo $fm->format_currency($result['Gia']) ?></td>
             
           

            <td>
                <form action="" method="post ">
                   
                    <a href="productdetails.php?name=<?php echo $result['MaSP']?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Chi Tiết </a>
                    
                </form>
            </td>
            <td>
                <form action="" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $result['MaSP']?>">
                  <button  type="submit" name="delete_btn" class="btn btn-danger">Xóa</button>
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

<script>
    $(document).ready(function(){
        $('#category').change(function(){
            var catName = $('#category option:selected').text();
            data = {
                category:1,
                catName:catName
            };
            $.ajax({
                url:"size.php",
                type:"POST",
                data:data
            }).done(function(result){
                $('#size').html(result);
                
            })
        })

    });
</script>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>