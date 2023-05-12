<?php
ob_start();
    include 'inc/header.php'
?>
<?php 
// include 'Model/admin/user.php';
$user = new User();
        $check = Session::get('customer_login');
        if(!isset($check)){
           header('Location:login.php');
        }
?>
<?php 

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
        $loginCus = $user->Login_Customer($_POST);
    }
?> 
<link rel="stylesheet" href="vendor/bootstrap_5/css/bootstrap.css">
    <link rel="stylesheet" href="vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/login/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/login/main.css">
<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Account Login
				</span>
				<form class="login100-form validate-form p-b-33 p-t-5" method="post">

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" placeholder="User name">
						<!-- <span class="focus-input100" data-placeholder="&#xe82a;"></span> -->
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<!-- <span class="focus-input100" data-placeholder="&#xe80f;"></span> -->
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn" name="login">
							Login
						</button>
						<?php  
							if(isset($loginCus)){
								echo $loginCus;
							}
						?>   
					</div>
                    <div style="text-align: center; margin-top: 12px;" class="container-redirect-signup">
                        <a  class="" href="dangky">Chưa có tài khoản ? Đăng ký ngay</a>
                    </div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>

<?php
ob_end_flush();
?>
