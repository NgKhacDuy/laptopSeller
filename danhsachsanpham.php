<?php
    include 'inc/header.php'
?>
<style>
.min-max-slider {position: absolute; width: 200px; text-align: center;top: 60px;
    left: 142px;}
.min-max-slider > label {display: none;}
span.value {height: 1.7em; font-weight: bold; display: inline-block;}
span.value.lower::before {content: "€"; display: inline-block;}
span.value.upper::before {content: "- €"; display: inline-block; margin-left: 0.4em;}
.min-max-slider > .legend {display: flex; justify-content: space-between;}
.min-max-slider > .legend > * {font-size: small; opacity: 0.25;}
.min-max-slider > input {cursor: pointer; position: absolute;}

/* webkit specific styling */
.min-max-slider > input {
  -webkit-appearance: none;
  outline: none!important;
  background: transparent;
  background-image: linear-gradient(to bottom, transparent 0%, transparent 30%, silver 30%, silver 60%, transparent 60%, transparent 100%);
}
.min-max-slider > input::-webkit-slider-thumb {
  -webkit-appearance: none; /* Override default look */
  appearance: none;
  width: 14px; /* Set a specific slider handle width */
  height: 14px; /* Slider handle height */
  background: #eee; /* Green background */
  cursor: pointer; /* Cursor on hover */
  border: 1px solid gray;
  border-radius: 100%;
}
.min-max-slider > input::-webkit-slider-runnable-track {cursor: pointer;}
</style>
<?php //include 'Model/admin/product.php'?>
<?php
  $format = new Format();
  $product = new product();
?>

<section style="background-color: #eee;">
  
<div class="filter-and-sort" style="display:flex; align-items:center;position:relative;">
  <div class="min-max-slider" data-legendnum="2">
    <label for="min">Minimum price</label>
    <input id="min" class="min" name="min" type="range" step="1" min="1000000" max="100000000" />
    <label for="max">Maximum price</label>
    <input id="max" class="max" name="max" type="range" step="1" min="1000000" max="100000000" />
  </div>

  <div class="group-radio" style="display:flex;position: relative;top: 73px;left: 24%;justify-content: space-around;width: 24%;">
    <div class="form-check">
      <input class="sort-option form-check-input" value="low-to-high" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
      <label class=" form-check-label" for="flexRadioDefault1">
        Giá từ thấp đến cao
      </label>
    </div>
    <div class="form-check">
      <input class="sort-option form-check-input" value="high-to-low" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
      <label class=" form-check-label" for="flexRadioDefault2">
        Giá từ cao đến thấp
      </label>
    </div>
  </div>
</div>

  <div class="relate-product">
    <div class="search-keyword">
      <?php
        if(isset($_GET['q'])){
          $q=$_GET['q'];
      ?>
      <p style="margin-bottom: 0;margin-top: 40px;">Kết quả tìm kiếm: <?php echo $q;?> </p>
      <?php
        }
      ?>
    </div>
    <div class="product-list-container">
      <div class="product-list">

      </div>
    </div>
    <nav style="margin-top:16px;" aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
        </ul>
    </nav>
  </div>
</section>


  <script>
    load_data();
    var thumbsize = 14;
function draw(slider,splitvalue) {

    /* set function vars */
    var min = slider.querySelector('.min');
    var max = slider.querySelector('.max');
    var lower = slider.querySelector('.lower');
    var upper = slider.querySelector('.upper');
    var legend = slider.querySelector('.legend');
    var thumbsize = parseInt(slider.getAttribute('data-thumbsize'));
    var rangewidth = parseInt(slider.getAttribute('data-rangewidth'));
    var rangemin = parseInt(slider.getAttribute('data-rangemin'));
    var rangemax = parseInt(slider.getAttribute('data-rangemax'));

    /* set min and max attributes */
    min.setAttribute('max',splitvalue);
    max.setAttribute('min',splitvalue);

    /* set css */
    min.style.width = parseInt(thumbsize + ((splitvalue - rangemin)/(rangemax - rangemin))*(rangewidth - (2*thumbsize)))+'px';
    max.style.width = parseInt(thumbsize + ((rangemax - splitvalue)/(rangemax - rangemin))*(rangewidth - (2*thumbsize)))+'px';
    min.style.left = '0px';
    max.style.left = parseInt(min.style.width)+'px';
    min.style.top = lower.offsetHeight+'px';
    max.style.top = lower.offsetHeight+'px';
    legend.style.marginTop = min.offsetHeight+'px';
    slider.style.height = (lower.offsetHeight + min.offsetHeight + legend.offsetHeight)+'px';
    
    /* correct for 1 off at the end */
    if(max.value>(rangemax - 1)) max.setAttribute('data-value',rangemax);

    /* write value and labels */
    max.value = max.getAttribute('data-value'); 
    min.value = min.getAttribute('data-value');
    lower.innerHTML = min.getAttribute('data-value');
    upper.innerHTML = max.getAttribute('data-value');

}
var minValue = '';
var maxValue = '';
function init(slider) {
    /* set function vars */
    var min = slider.querySelector('.min');
    var max = slider.querySelector('.max');
    var rangemin = parseInt(min.getAttribute('min'));
    var rangemax = parseInt(max.getAttribute('max'));
    var avgvalue = (rangemin + rangemax)/2;
    var legendnum = slider.getAttribute('data-legendnum');

    /* set data-values */
    min.setAttribute('data-value',rangemin);
    max.setAttribute('data-value',rangemax);
    
    /* set data vars */
    slider.setAttribute('data-rangemin',rangemin); 
    slider.setAttribute('data-rangemax',rangemax); 
    slider.setAttribute('data-thumbsize',thumbsize); 
    slider.setAttribute('data-rangewidth',slider.offsetWidth);

    /* write labels */
    var lower = document.createElement('span');
    var upper = document.createElement('span');
    lower.classList.add('lower','value');
    upper.classList.add('upper','value');
    lower.appendChild(document.createTextNode(rangemin));
    upper.appendChild(document.createTextNode(rangemax));
    slider.insertBefore(lower,min.previousElementSibling);
    slider.insertBefore(upper,min.previousElementSibling);
    
    /* write legend */
    var legend = document.createElement('div');
    legend.classList.add('legend');
    var legendvalues = [];
    for (var i = 0; i < legendnum; i++) {
        legendvalues[i] = document.createElement('div');
        var val = Math.round(rangemin+(i/(legendnum-1))*(rangemax - rangemin));
        legendvalues[i].appendChild(document.createTextNode(val));
        legend.appendChild(legendvalues[i]);

    } 
    slider.appendChild(legend);

    /* draw */
    draw(slider,avgvalue);

    /* events */
    min.addEventListener("input", function() {
    update(min);
    minValue = min.value;
    searchByRange();
  });
  max.addEventListener("input", function() {
    update(max);
    maxValue = max.value;
    searchByRange();
  });
}

function searchByRange(){
  var products = document.querySelectorAll('.card');
  for (var i = 0; i < products.length; i++) {
    var productPrice = parseInt(products[i].getAttribute('data-price'));
    if (productPrice >= minValue && productPrice <= maxValue) {
      products[i].style.display = 'block';
    } else {
      products[i].style.display = 'none';
    }
  }
}

const sortOptions = document.querySelectorAll('.sort-option');
const productList = document.querySelector('.product-list');

// Sort the product list based on the selected sort option
function sortProducts() {
  const sortOption = document.querySelector('.sort-option:checked').value;

  // Get all product elements in an array
  const products = Array.from(productList.querySelectorAll('.card'));

  // Sort the product array based on the selected sort option
  if (sortOption === 'low-to-high') {
    products.sort((a, b) => a.dataset.price - b.dataset.price);
  } else {
    products.sort((a, b) => b.dataset.price - a.dataset.price);
  }

  // Update the product list with the sorted products
  products.forEach(product => {
    productList.appendChild(product);
  });
}

// Sort the products on initial load
sortProducts();

// Add event listener to sort options to re-sort products when selected
sortOptions.forEach(option => {
  option.addEventListener('change', sortProducts);
});


function update(el){
    /* set function vars */
    var slider = el.parentElement;
    var min = slider.querySelector('#min');
    var max = slider.querySelector('#max');
    var minvalue = Math.floor(min.value);
    var maxvalue = Math.floor(max.value);
    
    /* set inactive values before draw */
    min.setAttribute('data-value',minvalue);
    max.setAttribute('data-value',maxvalue);

    var avgvalue = (minvalue + maxvalue)/2;

    /* draw */
    draw(slider,avgvalue);
}

var sliders = document.querySelectorAll('.min-max-slider');
sliders.forEach( function(slider) {
    init(slider);
});
    

    $(document).on('click','.page-item', function(){
      var page =$(this).attr("id");
      load_data(page); 
    })

    function load_data(page) {
  <?php if(isset($_GET['q'])) { ?>
    let q = '<?php echo $_GET['q']; ?>';
  <?php } ?>
  <?php if(isset($_GET['brand'])) { ?>
    let brand = '<?php echo $_GET['brand']; ?>';
  <?php } ?>
  $.ajax({
    url: "ajax/pagination.php",
    method: "POST",
    data: {
      page: page,
      <?php if(isset($_GET['q'])) { ?>
        q: q,
      <?php } ?>
      <?php if(isset($_GET['brand'])) { ?>
        brand: brand
      <?php } ?>
    },
    success: function(data) {
      var dataArray = data.split('|');
      $(".product-list").html(dataArray[0]);
      $(".pagination").html(dataArray[1]);
      // console.log(dataArray[0]);
      // console.log(dataArray[1]);
    }
  });
}


    
    
  </script>
<?php
    include 'inc/footer.php'
?>