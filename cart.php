<style>
  .header{
    background-color: #f5f5f5 !important;
  }
</style>
<?php
ob_start();
    include 'inc/header.php'
?>
<?php
  $totalMoney = array();
  $login = Session::get('customer_login');
  if($login == false){
    header('Location:dangnhap');
  }
 
     


  

  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idCart'])){
    $idCart = $_POST['idCart'];
    $idCus = $_POST['idCus'];
    $idPro = $_POST['idPro'];
    $quantity = $_POST['quantity'];

    $update_Slcart = $ct->update_Slcart($quantity,$idPro,$idCus,$idCart);    
    
 }

 
?>
    <div class="container" style="height: fit-content;" >
      <section class="h-100" style="background-color: #f5f5f5">
        <div class="container h-100 py-5">
          <div
            class="row d-flex justify-content-center align-items-center h-100"
          >
            <div class="col-10">
              
            </div>
          </div>
        </div>
      </section>
    </div>
<script>
  updateCart();
  var cart = `
        <div
                class="d-flex justify-content-between align-items-center mb-4"
              >
                <h3 class="fw-normal mb-0 text-black">Prieview your Bag</h3>
              </div>
              <?php
              $index=0;
                $Cus = $user->Get_User(Session::get('customer_user'));
                if($Cus){
                  $idCus = $Cus->fetch_assoc();
                }
                // echo($idCus['MaKH']);
                $showCart = $ct->get_Cart($idCus['MaKH']);
                if($showCart){
                  while($result = $showCart->fetch_assoc()){
                    $showPro=$pro->getproductByid($result['MaSP']);
                    // echo($result['MaSP']);
                    if($showPro){
                      
                      while($resultPro = $showPro->fetch_assoc()){
                        $index++;
                        array_push($totalMoney,$resultPro['Gia']);
              ?>
              <div class="card cardIndex<?php echo $index; ?> rounded-3 mb-4" style="border: none;margin-bottom:0 !important">
                <div class="card-body p-4" style="background-color: #f5f5f5">
                  <div
                    class="row d-flex justify-content-between align-items-center"
                  >
                    <div class="col-md-2 col-lg-2 col-xl-2">
                      <img
                        src="View/admin/uploads/<?php echo $resultPro['HinhAnh'] ?>"
                        class="img-fluid rounded-3"
                        alt=""
                      />
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                      <p class="lead fw-normal mb-2">
                        <?php echo $resultPro['TenSP'] ?>
                      </p>
                      
                    </div>

                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                      

                        <input
                          
                          id="quantity<?php echo $index; ?>"
                          min="1"
                          name="quantity"
                          value="<?php echo $result['SoLuong'] ?>"
                          type="number"
                          class="quantity form-control form-control-sm"
                        />
                        <input type="hidden" id="idCart<?php echo $index; ?>" name="idCart" value="<?php echo $result['MaGioHang'] ?>">
                        <input type="hidden" id="idCus<?php echo $index; ?>" name="idCus" value="<?php echo $idCus['MaKH'] ?>">
                        <input type="hidden" id="idPro<?php echo $index; ?>" name="idPro" value="<?php echo $result['MaSP'] ?>">

                        <button type="" name="updateQuantity" onclick="updateTotal(<?php echo $index; ?>)" class="update-quantity_cart">
                          <i class="fa-solid fa-rotate-right"></i>
                        </button>

                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                      <h5 class="price priceIndex<?php echo $index; ?> mb-0"><?php echo $fm->format_currency($resultPro['Gia']) ?>đ</h5>
                    </div>
                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                      
                        <input type="hidden" name="delete_id<?php echo $index ?>" value="<?php echo $resultPro['MaSP']?>">
                        <button onclick = "deleteProductFromCart(<?php echo $index ?>)" class="text-danger" style="background:transparent;border:none;">

                        <i class="fas fa-trash fa-lg"></i>Xóa</>
                      
                    </div>
                    
                  </div>
                </div>
              </div>
              <?php
                      }
                    }
                  }
                  
                }
              ?>
              <?php
                if($showCart){
              ?>
              <p id="total" style="text-align:end;background-color:#f5f5f5; margin:0; padding-right:20px" >Tổng tiền: 0đ
                  
              </p>
              <div class="card" style="border:none;background-color:#f5f5f5;">
                <div class="card-body" 
                style="
                  padding-bottom: 30px;
                  width: 300px;
                  align-self: end;"
                >
                  
                    
                      <input
                        onclick="thanhtoan()"
                        class="btn btn-block btn-lg"
                        value="Thanh Toán"
                        name=""
                        style="background-color: #363A95;color: white; font-weight:500"
                      />
                    
                </div>
              </div>
              <?php
                }
              ?>
        `;
  var idCus1= <?php echo $idCus['MaKH']; ?>;
  function updateCart(){
    // create an XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    // define the request URL
    var url = "ajax/giohang.php";
    // define the request method and set the async flag to true
    xhr.open("POST", url, true);
    // set the request headers (if necessary)
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    // define the callback function to handle the response
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // update the cart items container with the new content
        document.querySelector('.col-10').innerHTML = cart;
        updateTextTotal();
      }
    };
    // send the request with the necessary data (if any)
    xhr.send(`updateCart`);
  }
  
  function deleteProductFromCart(index){
    var idDelete = document.querySelector('input[name="delete_id' + index + '"]').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'cart.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // document.querySelector('.col-10').innerHTML = cart;
        document.querySelector('.priceIndex'+index).textContent = '0đ';
        document.querySelector('.cardIndex'+index).style.display = 'none';
        updateTextTotal();
      }
    };

    xhr.send(`idDelete=${idDelete}&idCus1=${idCus1}`);
}
  function updateTotal(index) {
    const idCart = document.querySelector('#idCart'+index).value;
    const idCus = document.querySelector('#idCus'+index).value; 
    const idPro = document.querySelector('#idPro'+index).value;
    const quantity = document.querySelector('#quantity'+index).value;   	
    const xhr = new XMLHttpRequest();

    xhr.open('POST', 'cart.php', true);

    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        // console.log(xhr.responseText);
      }
    };

    xhr.send(`idCart=${idCart}&idCus=${idCus}&idPro=${idPro}&quantity=${quantity}`);
    
    
    updateTextTotal();

  // console.log(newTotal) 
  // const totalElement = document.getElementById("total");
  // const total = parseFloat(totalElement.textContent.replace(/\D/g,''));
  // console.log(total)
  // totalElement.textContent = `Tổng tiền: ${newTotal+total}đ`;
}
var totalMoney = 0;
function updateTextTotal(){
  let sum=0;
    const priceElement = document.querySelectorAll(".price");
    const quantityElement = document.querySelectorAll(".quantity");
    for(let i=0;i<priceElement.length;i++){
      // console.log(priceElement[i]);	
      // console.log(quantityElement[i].value);	
       temp = priceElement[i].textContent
       temp = parseFloat(temp.replace(/\D/g,''));
      sum+= (temp*quantityElement[i].value);
      totalMoney = sum;
    }
  const totalElement = document.getElementById("total")
  totalElement.textContent = `Tổng tiền: ${sum.toLocaleString("vi-VN")}đ`;
}

function thanhtoan(){
    var xhr = new XMLHttpRequest();
    // define the request URL
    var url = "cart.php";
    // define the request method and set the async flag to true
    xhr.open("POST", url, true);
    // set the request headers (if necessary)
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    // define the callback function to handle the response
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // update the cart items container with the new content
        window.location.href = 'thanhtoan.php';
      }
    };
    // send the request with the necessary data (if any)
    xhr.send(`cartToBill=${idCus1}&totalMoney=${totalMoney}`);
  }

</script>

<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cartToBill'])){
    $idCus1 = $_POST['cartToBill'];
    $totalMoney = $_POST['totalMoney'];
    $insertCartToBill = $ct->cartToBill($idCus1,$totalMoney);
  }

   if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idDelete'])){
    $idPro1 = $_POST['idDelete'];
    $idCus1 = $_POST['idCus1'];
    $delPro = $ct->deleteProfromCart($idPro1,$idCus1); 
  }
  ob_end_flush();
    include 'inc/footer.php'
?>