<?php
ob_start();
    include 'inc/header.php'
?>
<?php
$login = Session::get('customer_login');
if($login == false){
  header('Location:dangnhap');
}
$username=session::get('customer_user');
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateCustomer'])){       
    $updateCus=$user->Update_Customer($_POST,$username);
 }
?>
<style>
    form{
        width: 80%;
        margin: 16px auto;
    }
    form *{
        text-align:left;
    }
</style>
<center><h3><?php if (isset($updateCus)) {
            echo $updateCus;
      } ?></h3></center>
<form method="POST"> 
    <?php
        $Cus = $user->Get_User(Session::get('customer_user'));
        if($Cus){
          $idCus = $Cus->fetch_assoc();
        }
        $userInfo = $user->Get_UserById($idCus['MaKH']);
        if($userInfo){
            while($result = $userInfo->fetch_assoc()){
    ?>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Username</label>
      <input disabled value="<?php echo $result['username'] ?>" type="text" class="form-control" id="inputEmail4" placeholder="">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Tên khách hàng</label>
      <input name="name" value="<?php echo $result['TenKH'] ?>" type="text" class="form-control" id="inputPassword4" placeholder="">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Địa chỉ</label>
    <input name="address" value="<?php echo $result['diachi'] ?>" type="text" class="form-control" id="inputAddress" placeholder="">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Số điện thoại</label>
    <input name="phone" value="<?php echo $result['phone']?>" type="number" class="form-control" id="inputAddress2" placeholder="">
  </div>
  <div class="form-group">
    <label for="inputPassword">Mật khẩu</label>
    <input name="password" type="password" class="form-control" id="inputPassword" placeholder="">
  </div>
  <button type="submit" name="updateCustomer" class="btn btn-primary btn-lg btn-block">Cập nhật</button>
</form>
<?php
            }
        }
?>




<?php
ob_end_flush();
include 'inc/footer.php'
?>