<?php
    include 'inc/header.php';
?>

<link href='https://fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700' rel='stylesheet' type='text/css'>
	<style>
		@import url(//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css);
		@import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);
        body{
            padding: 0;
        }
	</style>
	<link rel="stylesheet" href="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/default_thank_you.css">
	<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/jquery-1.9.1.min.js"></script>
	<script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/html5shiv.js"></script>
<header class="site-header" id="header">
		<h1 style="font-size:3.25rem;" class="site-header__title" data-lead-id="site-header-title">Cảm ơn đã mua sắm tại cửa hàng!</h1>
	</header>

	<div class="main-content">
		<i class="fa fa-check main-content__checkmark" id="checkmark"></i>
		<p class="main-content__body" data-lead-id="main-content-body">Tự động chuyển hướng về trang chủ sau 10s</p>
		<p class="main-content__body" data-lead-id="main-content-body">Quản trị viên sẽ sớm kiểm tra đơn hàng của bạn. Bạn có thể xem trạng thái đơn hàng <a href="donhang">tại đây</a></p>
	</div>

	<footer class="site-footer" id="footer">
		<p class="site-footer__fineprint" id="fineprint">Copyright ©2014 | All Rights Reserved</p>
	</footer>
	<script>
		setTimeout(function() {
		window.location.href = "index.php";
		}, 10000);
	</script>
<?php
include 'inc/footer.php'
?>
