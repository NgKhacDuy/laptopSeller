<?php
    include 'inc/header.php'
?>
<?php //include 'Model/admin/product.php'?>
<?php
  $format = new Format();
  $product = new product();
?>

<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="pagination-data row justify-content-center">
    
    </div>
  </div>
</section>


  <script>
    load_data();
    $(document).on('click','.page-item', function(){
      var page =$(this).attr("id");
      load_data(page); 
    })

    function load_data(page) {
  <?php if(isset($_GET['q'])) { ?>
    let q = '<?php echo $_GET['q']; ?>';
  <?php } ?>
  $.ajax({
    url: "ajax/pagination.php",
    method: "POST",
    data: {
      page: page,
      <?php if(isset($_GET['q'])) { ?>
        q: q
      <?php } ?>
    },
    success: function(data) {
      $(".pagination-data").html(data);
    }
  });
}


    
    
  </script>
<?php
    include 'inc/footer.php'
?>