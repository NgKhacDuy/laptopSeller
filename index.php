<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laptop Seller</title>
    <link rel="stylesheet" href="./assets/css/admin.css">
    <link rel="stylesheet" href="./assets/css/groups.css">
    <link rel="stylesheet" href="./assets/css/chucvu/chucvu.css">
    <link rel="stylesheet" href="./assets/css/sanpham/sanpham.css">
    <link rel="stylesheet" href="./assets/css/trangchu-sanpham/sanpham.css">
    <link rel="stylesheet" href="./assets/css/toast/toast.css">
    <link rel="stylesheet" href="./assets/css/loading/loading.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

</head>

<body onload="removeLoader()">
    <div id="loading-animation"></div>
    <?php
    // echo phpinfo();
    include("/xampp/htdocs/laptopSeller/View/admin/adminView.php");
    // include("/xampp/htdocs/laptopSeller/View/admin/groups.php");
    // include("/xampp/htdocs/laptopSeller/View/admin/adminView.php");
    // include("/xampp/htdocs/laptopSeller/View/admin/groups.php")
    // include("/xampp/htdocs/laptopSeller/View/sanpham/sanpham.php")
    ?>
    <script src="./assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
<script>
    window.addEventListener("load", function() {
        // When the website has finished loading, remove the loader animation
        document.querySelector('.loader').style.display = "none";
    });


    window.addEventListener('DOMContentLoaded', function() {
        // var loadingAnimation = document.getElementById('loading-animation');
        // loadingAnimation.innerHTML = `<?php #include("./assets/js/custom/loading/loading.php"); 
                                            ?>`;
        document.body.insertAdjacentHTML("beforeend",
            `<?php include("./assets/js/custom/loading/loading.php"); ?>`);
    });
</script>

</html>