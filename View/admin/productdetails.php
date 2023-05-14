<?php
include('includes/header.php');
include('includes/navbar.php');

?>
<?php include '../../Model/admin/brand.php';?>
<?php include '../../Model/admin/category.php';?>
<?php include '../../Model/admin/product.php'?>
<style type="text/css">

.rows {
display: flex;
flex-wrap: wrap;
margin-right: -.100rem;
margin-left: -.75rem;
}
.scroll{
  height: 400px;
  overflow: scroll;
}
h5{
  margin-top: 10px;
  margin-left: 80px;
  color: black;
  width: 80%;
  text-align: justify;
}
h3{
  margin-left: 80px;
  color: red;
  font-weight: bold;
}
#redd{
  color: red;
  font-weight: bold;
}
</style>
<?php
    $fm=new format();
    $prod = new product();
    $cat = new category();

    
    // get name product

    if(!isset($_GET['name']) || $_GET['name']==NULL){
    echo "<script>window.location = 'productlist.php'</script>";

    }else{
    $name = $_GET['name'];
    }

    // xoa product theo size
    


    $product= $prod->Show_ProductByIdAdmin($name);
      if($product){
        while ($result = $product->fetch_assoc()){
          $namecat = $result['TenLoaiSP'];

        }
    }
    // update product
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updaepro'])){

    $updateProd = $prod->update_product($_POST,$_FILES,$name);
    // error_log($name);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['shortDescrip'])){

      $updateShort = $prod->updateMoTaNgan($name,$_POST);
      // error_log($name);
      }
    
    // add product detail
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addThongSoKyThuatProdDetail'])){

        if($prod->deleteAllThongSoKyThuatProdById($name)){
        $titles = $_POST['title'];
        $contents = $_POST['content'];
        for($i =0;$i<count($titles);$i++){
          if($contents[$i]!=''&&$titles[$i]!= ''){
            $product = $prod->insertThongSoKyThuatProd($name,$titles[$i],$contents[$i]);
          }
        };
        }

        //$insert_product = $prod->add_Size_Product($name,$size,$quantity);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addMoTaProdDetail'])){

        if(isset($_POST['UpdateMoTaTitle'])){
          $updateTitlesMoTa = $_POST['UpdateMoTaTitle'];
          $updateContentsMoTa = $_POST['UpdateMoTaContent'];
          $updateImgMoTa = $_FILES['UpdateMoTaImg'];
          for ($i = 0; $i < count($updateTitlesMoTa); $i++) {
            if($updateContentsMoTa[$i]!=''){
                
                $file = array(
                    'name' => $updateImgMoTa['name'][$i],
                    'type' => $updateImgMoTa['type'][$i],
                    'tmp_name' => $updateImgMoTa['tmp_name'][$i],
                    'error' => $updateImgMoTa['error'][$i],
                    'size' => $updateImgMoTa['size'][$i]
                );
                 $product = $prod->updateMoTaProd($name, $updateTitlesMoTa[$i], $updateContentsMoTa[$i], $file,$i+1);
              }
              if($updateTitlesMoTa[$i]=='' && $updateContentsMoTa[$i]==''){
                $product = $prod->deleteMoTaProdById($name,$i+1);
                // error_log('input null at '.$i+1);
              }
          }
        }
        
        if(isset($_POST['InsertMoTaTitle'])){
          $insertTitlesMoTa = $_POST['InsertMoTaTitle'];
          $insertContentsMoTa = $_POST['InsertMoTaContent'];
          $insertImgMoTa = $_FILES['InsertMoTaImg'];
          for ($i = 0; $i < count($insertTitlesMoTa); $i++) {
            if($insertContentsMoTa[$i]!=''){
                
                $file = array(
                    'name' => $insertImgMoTa['name'][$i],
                    'type' => $insertImgMoTa['type'][$i],
                    'tmp_name' => $insertImgMoTa['tmp_name'][$i],
                    'error' => $insertImgMoTa['error'][$i],
                    'size' => $insertImgMoTa['size'][$i]
                );
                 $product = $prod->insertMoTaProd($name, $insertTitlesMoTa[$i], $insertContentsMoTa[$i], $file);
              }
          }
        }
         
        

        
      



      // $insert_product = $prod->add_Size_Product($name,$size,$quantity);
    }

    
    
?> 

  
<!-- Begin editproduct -->
<div class="modal fade" id="editproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cập Nhât Sản Phẩm</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" enctype="multipart/form-data">
        
        <div class="modal-body">
            <?php 
              $get_list= $prod->Show_ProductByIdAdmin($name);
              if($get_list){
                  while($result_prod = $get_list->fetch_assoc()){
                ?>
            <div class="form-group">

                <label> Tên Sản Phẩm </label>
                <input type="text" name="productName" class="form-control" placeholder="Enter Product" value="<?php echo $result_prod['TenSP'] ?>">
            </div>
             
             
             
            <div class="form-group">

                <label> Giá </label>
                <input type="text" name="price" class="form-control" placeholder="Enter price" value="<?php echo $result_prod['Gia'] ?>">
            </div>
            <!-- <div class="form-group">

                <label> Mô Tả </label>
                <input type="text" name="description" class="form-control" placeholder="Enter Description" value="<?php //echo $result_prod['description'] ?>">
            </div> -->
            <div class="form-group">

                <label> Ảnh </label>
                 <img src="uploads/<?php echo $result_prod['HinhAnh']?>"  width="80" ?>
                <input type="file" name="image" class="form-control" v >
            </div>

        <?php 
            }
          }
         ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="submit" name="updaepro" class="btn btn-primary">Lưu</button>
        </div>
      </form>

    </div>
  </div>
</div>
<!-- End editproduct -->
<!-- Begin addsize -->
 <form action="" method="POST" enctype="multipart/form-data">
<div class="modal fade" id="addmota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa mô tả</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" enctype="multipart/form-data">

        <div class="modal-body">

            <!-- <div class="form-group">
              <label >Loại Sản Phẩm</label>
                 <select id="size" name="size"  class="form-control action">
                  
                            <option>Chọn Size</option>
                            
                            
                                 <option ><?php //echo $result['catSize'] ?></option>
                              
                            
                            
                        </select>
            </div> -->
             
             
             
            <!-- <div class="form-group">

                <label> Số Lượng </label>
                <input type="text" id="quantity" name="quantity" class="form-control" placeholder="Enter quantity">
            </div> -->
            
              <ul class="list-group mb-3 "id="sortable1">
              <?php
                $prodDetailList = $prod->getMoTaProductById($name);
                if($prodDetailList){
                      while ($result = $prodDetailList->fetch_assoc()) {
                ?>
              <li class="list-group-item">
                <div class="form-row align-items-start">
                  <div class="col-md-12">
                    <label class="sr-only" for="<?php echo $result['title']?>"><?php echo $result['title']?></label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="<?php echo $result['title']?>" name="UpdateMoTaTitle[]" placeholder="Title" value="<?php echo $result['title']?>">
                  </div>
                  <div class="col-md-12">
                    <label class="sr-only" for="">Image</label>
                    <img src="uploads/<?php echo $result['hinhanh']?>"  width="80" ?>
                    <input type="file" class="form-control-file mb-2 mr-sm-2" id="<?php echo $result['hinhanh']?>" name="UpdateMoTaImg[]">
                  </div>
                  <div class="col-md-12">
                    <label class="sr-only" for="<?php echo $result['content']?>"><?php echo $result['content']?></label>
                    <textarea class="form-control mb-2 mr-sm-2" id="<?php echo $result['content']?>" name="UpdateMoTaContent[]" placeholder="Content"><?php echo $result['content']?></textarea>
                  </div>
                </div>
              </li>



              <?php 
                      }
                  }
                ?>
              </ul>
              <button class="btn btn-primary" onclick="addListItemMoTaProdDetail()">Add Item</button>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="submit" name="addMoTaProdDetail" class="btn btn-primary">Lưu</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- End addsize -->
<!-- chinh sua mo ta ngan -->
<form action="" method="POST" enctype="multipart/form-data">
<div class="modal fade" id="addmotangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa mô tả ngắn</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" enctype="multipart/form-data">

        <div class="modal-body">
          <div class="form-group green-border-focus">
            <label for="exampleFormControlTextarea5">Chỉnh sửa mô tả ngắn</label>
            <?php
              $shortDescrib = $prod->getMoTaNgan($name);
              if($shortDescrib){
                    while ($resultShort = $shortDescrib->fetch_assoc()) {
            ?>
            <textarea value ="" name="shortDescripText" class="form-control" id="exampleFormControlTextarea5" rows="3"><?php echo $resultShort['MoTaNgan'] ?></textarea>
          <?php
                    }
                  }
          ?>
          </div>
            

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="submit" name="shortDescrip" class="btn btn-primary">Lưu</button>
        </div>
      </form>

    </div>
  </div>
</div>
<!-- end mo ta ngan -->
<!-- chinh sua mo ta -->
<form action="" method="POST" enctype="multipart/form-data">
<div class="modal fade" id="addthongsokythuat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa thông số kỹ thuật</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" enctype="multipart/form-data">

        <div class="modal-body">

            <!-- <div class="form-group">
              <label >Loại Sản Phẩm</label>
                 <select id="size" name="size"  class="form-control action">
                  
                            <option>Chọn Size</option>
                            
                            
                                 <option ><?php //echo $result['catSize'] ?></option>
                              
                            
                            
                        </select>
            </div> -->
             
             
             
            <!-- <div class="form-group">

                <label> Số Lượng </label>
                <input type="text" id="quantity" name="quantity" class="form-control" placeholder="Enter quantity">
            </div> -->
            
              <ul class="list-group mb-3 "id="sortable">
              <?php
                $prodDetailList = $prod->getThongSoKyThuatProductById($name);
                if($prodDetailList){
                      while ($result = $prodDetailList->fetch_assoc()) {
                ?>
                <li class="list-group-item">
                  <div class="form-row align-items-center">
                    <div class="col-md-6">
                      <label class="sr-only" for="<?php echo $result['title']?>"><?php echo $result['title']?></label>
                      <input type="text" class="form-control mb-2 mr-sm-2" id="<?php echo $result['title']?>" name="title[]" placeholder="Value" value="<?php echo $result['title']?>">
                    </div>
                    <div class="col-md-6">
                      <label class="sr-only" for="<?php echo $result['content']?>"><?php echo $result['content']?></label>
                      <input type="text" class="form-control mb-2 mr-sm-2" id="<?php echo $result['content']?>" name="content[]" placeholder="Value 2" value="<?php echo $result['content']?>">
                    </div>
                  </div>
                </li>

                <?php 
                      }
                  }
                ?>
              </ul>
              <button class="btn btn-primary" onclick="addListItem()">Add Item</button>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="submit" name="addThongSoKyThuatProdDetail" class="btn btn-primary">Lưu</button>
        </div>
      </form>

    </div>
  </div>
</div>


<!-- end mo ta -->
<div class="container-fluid">
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h3 class="m-0 font-weight-bold text-primary" style="margin-left:80px;">Danh Sách Sản Phẩm
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editproduct">
              Cập Nhật Sản Phẩm
            </button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addmota">
              Chỉnh sửa mô tả
            </button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addthongsokythuat">
              Chỉnh sửa thông số kỹ thuật
        </button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addmotangan">
              Chỉnh sửa mô tả ngắn
        </button>
      </h3>
    </div>
    
     <?php 
          
                
          $get_list= $prod->Show_ProductByIdAdmin($name);
          if($get_list){
              while($result_prod = $get_list->fetch_assoc()){
                ?>     
    <div class="card-body">
     
      
     
      <form action="" method="POST">
     
        <div class="rows">
           
          <div class="col-4" >
            <img src="uploads/<?php echo $result_prod['HinhAnh']?>" width="400px">
          </div>
          <div class=" col-8">
            <h3 class="m-0 font-weight-bold text-primary"><?php echo $result_prod['TenSP'] ?></h3>
            
            <!-- <h5><?php //echo $result_prod['description'] ?></h5> -->
            
            <h5 id="redd">Thương hiệu: <?php echo $result_prod['TenThuongHieu'] ?></h5>
           
             <h5 id="redd">Danh mục: <?php echo $result_prod['TenLoaiSP'] ?></h5>
             
              
            <h3>Giá: $<?php echo $fm->format_currency($result_prod['Gia']) ?></h3>
              
          </div>
        </div>
        <form action="" method="post">
          
        <div class="scroll">
         
              <table class="table table-bordered" id="editable_table" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th> ID </th>
                    <!-- <th> Size </th> -->
                    <th> Số Lượng </th>
                    
                    <th> Chỉnh Sửa </th>
                   
                  </tr>
                </thead>
                <tbody>
                   <?php
                                
                                $Sizelist = $prod->getSize_1Product($name);
                                if($Sizelist){
                                    while ($result = $Sizelist->fetch_assoc()) {        
                            ?>
                  <tr>
                    <td> <?php echo $result['MaSP']?> </td>
                    <!-- <td> <?php //echo $result['size']?></td> -->
                   <td  id="quantity" name="quantity"> 
                        <?php echo $result['SoLuong']?>
                    </td> 
                    
                    <td>
                        <a href="updatequan.php?porid=<?php echo $result['MaSP']?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Cập Nhật</a>
                        
                     
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


       
      </form>
      
    </div>
     <?php  
                                }
                            }
                            ?>
    
  </div>
</div>
</form>


<!-- /.container-fluid -->
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>