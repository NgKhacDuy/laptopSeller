<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

?>
<?php include '../../Model/admin/brand.php'?>
<?php include '../../Model/admin/category.php'?>
<?php include '../../Model/admin/product.php'?>
<?php include '../../Model/admin/bill.php'?>



<?php 
  $fm = new Format();
  $brand = new brand();
  $cat = new category();
  $prod = new product();
  $bill = new bill();
  
          if(isset($_POST["delete_id"])){
          $id = $_POST["delete_id"];
        $delbrand = $prod->delete_productName($id);
          }
   
 ?>


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
h4{
  font-weight: bold;
  color: red;
}
#top{
  padding-top: 9px;
}
</style>
 
<!-- /.container-fluid -->


<?php 

  if (isset($_GET['idbill'])) {
      $id_bill=$_GET['idbill'];
    }
    
  

 ?>



<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">BILL DETAILS 

    </h6>
     <form action="" method="POST">
           
  </div>

  <div class="card-body">

    <div class="table-responsive">

     <form action="" method="POST">
      <h4>PRODUCT ORDER</h4>
      
      
        </tbody>
      <div class="scroll">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            
            <th> Product name </th>
            <th> Image </th>
            <!-- <th> Size </th> -->
            <th> Quantity </th>
            <th> Price </th>
            <th> Total</th>
          </tr>
        </thead>
        <tbody>
          <?php 
             


              $get_BillDetails=$bill->get_BillDetails($id_bill);
              if ($get_BillDetails){
                  while ($result=$get_BillDetails->fetch_assoc()) {
                    $showPro=$prod->getproductByid($result['MaSP']);
                    if($showPro){
                      while($resultPro = $showPro->fetch_assoc()){
             ?>
          <tr>
            <td> <?php echo $resultPro['TenSP']; ?></td>
            <td><img src="uploads/<?php echo $resultPro['HinhAnh']?>" width="70" ></td>  
            <!-- <td> <?php //echo $result['size']; ?></td> -->
            <td> <?php echo $result['SoLuong']; ?></td>
           
            <td>$<?php echo  $fm->format_currency($result['DonGia']) ?></td>
            <td>$<?php echo  $fm->format_currency($result['ThanhTien']) ?></td>
           </tr>

        <?php
                  }
                }
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