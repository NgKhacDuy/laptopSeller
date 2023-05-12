<?php
include('includes/header.php');
include('includes/navbar.php');
include ("../../helpers/format.php");

?>
<?php include '../../Model/admin/bill.php'?>
<?php include '../../Model/admin/user.php'?>
<?php 
    $bill = new bill();
    $user = new User();
  $fm=new format();
    
 ?>
 <?php 

   if(isset($_POST["test"])){
     $id = $_POST["test"];
     if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){

     $status = $_POST['status'];
     $updatestt = $bill->update_Status($status,$id);
    
    
    }

  }
  
     
  

 ?>
 <div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cập nhật trạng thái</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
     
      <form action="" method="POST">

        <div class="modal-body">

            <div class="form-group">

                <label> Trạng thái </label>
                <input type="hidden" name="test" id="test"  value="">
                <!-- <input type="text" name="brandName" class="form-control" placeholder="Enter Brand"> -->
                <select class="form-control"  id="status" name="status">
                    
                  
                        <option  selected value="Đang chờ xác nhận đơn hàng">Đang chờ xác nhận đơn hàng</option>
                        <option value="Đã xác nhận đơn hàng">Đã xác nhận đơn hàng</option>
                        <option value="Đơn hàng đã huỷ">Đơn hàng đã huỷ</option>
                        <option value="Đã thanh toán">Đã thanh toán</option>
                  </select>
                
            </div>
            
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="submit" class="btn btn-primary">Lưu</button>
        </div>
      </form>

    </div>
  </div>
</div>
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Danh Sách Đơn Hàng
            
    </h6>
    
  </div>
  <div class="form-outline">
    <input type="search" id="inputSearch" class="form-control" placeholder="Tìm kiếm" aria-label="Search" style="margin:8px auto;width: 80%;"/>
  </div>

  <div class="card-body">
  <form action="" method="post">
  

    <div class="table-responsive">

      
      <?php 
          $level=session::get("level");
          if ($level==1) { ?>
            <table class="table table-bordered" id="dataTable"  width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> ID </th>
            <th> Ngày Đặt </th>
            <th width="15%">Khách Hàng </th>
            <th>Tổng Tiền</th>
            <th>Đia Chỉ</th>
            <th width="15%">Trạng Thái </th>
          </tr>
        </thead>
        <tbody>
            <?php
                    
                    $get_Bill=$bill->get_Bill();
                    if ($get_Bill){
                    while ($result=$get_Bill->fetch_assoc()) {
                    
                    
                    ?>
          <tr>
             
            <td value="idbill" name="idbill" data-name="<?= $result['order_Id'] ?>" ><a href="billdetails.php?idbill=<?php echo $result['order_Id']?>"> <?php echo $result['order_Id'] ?></a></td>
            <td><?php echo $fm->formatDate($result['date']) ?></td>
            <td><?php echo $result['receiver'] ?></td>
            <td>$<?php echo $fm->format_currency($result['totalprice']) ?></td>
            <td><?php echo $result['address'] ?></td>
            
                
            <?php
                  if ($result['status']=='Đang chờ xác nhận đơn hàng') {
                    echo '<td class="text-danger">Đang chờ xác nhận đơn hàng</td>';
                  }elseif($result['status']=='Đã xác nhận đơn hàng'){
                   echo '<td class="text-success">Đã xác nhận đơn hàng/td>';
                  }elseif($result['status']=='Đơn hàng đã huỷ'){
                   echo '<td class="text-success">Đơn hàng đã huỷ</td>';
                  }elseif($result['status']=='Đã thanh toán')
                  echo '<td class="text-success">Đã thanh toán</td>';
                  ?>
       
                    
               
          </tr>
         <?php
                    }
                    }
                    ?>
        </tbody>
      </table>

       <?php     
          }else{ ?>
<table class="table table-bordered" id="dataTable"  width="100%" cellspacing="0">
        <thead>
          <tr>
            <th> ID </th>
            <th> Ngày Đặt </th>
            <th width="15%">Khách Hàng </th>
            <th>Tổng Tiền</th>
            <th>Địa Chỉ</th>
            <th width="15%">Trạng Thái </th>
            <th>Thao Tác</th>
          </tr>
        </thead>
        <tbody>
            <?php
                    
                    $get_Bill=$bill->get_Bill();
                    $nameCus="";
                    if ($get_Bill){
                    while ($result=$get_Bill->fetch_assoc()) {
                    
                    
                    ?>
          <tr>
             
            <td value="idbill" name="idbill" data-name="<?= $result['MaBL'] ?>" ><a href="billdetails.php?idbill=<?php echo $result['MaBL']?>"> <?php echo $result['MaBL'] ?></a></td>
            <td><?php echo $fm->formatDate($result['ngaytao']) ?></td>
            <?php 
              if($user->Get_UserById($result['MaKH'])){
                $nameCus = (($user->Get_UserById($result['MaKH']))->fetch_assoc());
              }
            ?>
            <td><?php echo $nameCus['TenKH'] ?></td>
            <td>$<?php echo $fm->format_currency($result['tongtien']) ?></td>
            <td><?php echo $nameCus['diachi'] ?></td>
            
                
            <?php
                  if ($result['status']=='Đang chờ xác nhận đơn hàng') {
                    echo '<td class="text-danger">Đang chờ xác nhận đơn hàng</td>';
                  }elseif($result['status']=='Đã xác nhận đơn hàng'){
                   echo '<td class="text-success">Đã xác nhận đơn hàng</td>';
                  }elseif($result['status']=='Đơn hàng đã huỷ'){
                   echo '<td class="text-success">Đơn hàng đã huỷ</td>';
                  }elseif($result['status']=='Đã thanh toán'){
                  echo '<td class="text-success">Đã thanh toán</td>';
                  }else
                      echo '<td class="text-danger">Hủy Đơn</td>';
                  ?>
       
                    
               
          
            <td>
                
      
               
                  <input  id="edit" type="button" name="submit" class="btn btn-primary" value="Cập nhật trạng thái" data-toggle="modal" data-target="#addadminprofile">
                 
               
            </td>
          </tr>
         <?php
                    }
                    }
                    ?>
        </tbody>
      </table>
  
      <?php
          }
       ?>         
        
    </div>
  </form>
  </div>
</div>

</div>
<script>
  $(document).ready(function(){
    
    $("#dataTable").on('click','#edit',function(){
      
      var currentRow = $(this).closest("tr");
      var id=currentRow.find("td:eq(0)").text();
      // var status=currentRow.find("td:eq(5)").val(); 
      
      // var show = id;
      // alert(show);
      $("#test").val(id);
      // $("#statuss").val(matp);
    });
 });
  
  
</script>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>