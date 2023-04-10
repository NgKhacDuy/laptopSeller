
  var input = document.getElementsByTagName('input');

function uncheckAll() {
  for (var i = 0; i < input.length; i++) {
    if (input[i].type == 'checkbox') {
        input[i].checked =false;
    }
}
}

var modal = document.getElementById("myModal");
var btn = document.querySelector('.btn-admin-sanpham-them')
var span = document.getElementsByClassName("modal-admin_sanpham-close")[0];
var btn_huy = document.querySelector('.btn-admin-sanpham-huy');

btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

btn_huy.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

function getIdSanPhamCheckBox(){
    let id_array = []; 
    var table = document.querySelector(".table_content-sanpham");
    var tr = table.querySelectorAll("tr");
    var checkboxes = [];

    for (var i = 0; i < tr.length; i++) {
        var checkboxList = tr[i].querySelectorAll("input[type=checkbox]");
        checkboxes.push(checkboxList);
    }

    for(var i = 0; i < checkboxes.length; i++) {
        var checkboxList = checkboxes[i];
        for (var j = 0; j < checkboxList.length; j++) {
            
            if(checkboxList[j].checked){
                let str = checkboxList[j].id;
                // console.log(checkboxList[j].id);
                id_array.push(str[3]);
                
            }
        }
    }
    return id_array
}

function selectAll() {
  var checkboxes = document.querySelectorAll('table tbody input[type="checkbox"]');
  var selectAllCheckbox = document.getElementById("select_all-sanpham_table");

  for(var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].checked = selectAllCheckbox.checked;
  }
}

const imageInput = document.getElementById('image-input-admin-sanpham');
const imagePreview = document.getElementById('image-preview-admin-sanpham');

imageInput.addEventListener('change', (event) => {
  const file = event.target.files[0];
  const reader = new FileReader();
  
  reader.addEventListener('load', (event) => {
    const imageUrl = event.target.result;
    imagePreview.style.backgroundImage = `url(${imageUrl})`;
  });
  
  reader.readAsDataURL(file);
});

// Get all checkboxes in the table
const checkboxes = document.querySelectorAll('table__body input[type="checkbox"]');

// Add an event listener to the checkboxes
checkboxes.forEach(checkbox => {
  checkbox.addEventListener('click', () => {
    // Count the number of checked checkboxes
    const checkedCount = document.querySelectorAll('table__body input[type="checkbox"]:checked').length;
    
    // Disable the unchecked checkboxes if two checkboxes are already checked
    checkboxes.forEach(c => {
      if (checkedCount === 2 && !c.checked) {
        c.disabled = true;
      } else {
        c.disabled = false;
      }
    });
    
    // Enable all checkboxes if no checkboxes are checked
    if (checkedCount === 0) {
      checkboxes.forEach(c => {
        c.disabled = false;
      });
    }
  });
});

// Add a submit button listener to ensure at least one checkbox is selected
const btn_sua = document.querySelector('.btn-admin-sanpham-sua');
const btn_xoa = document.querySelector('.btn-admin-sanpham-xoa');
btn_sua.addEventListener('click', event => {
  const checkedCount = document.querySelectorAll('table input[type="checkbox"]:checked').length;
  if (checkedCount !== 1) {
    event.preventDefault();
    toast({
      title: "Thất bại!",
      message: "Vui lòng chỉ chọn 1 sản phẩm để sửa.",
      type: "error",
      duration: 5000
    });
  }
});

btn_xoa.addEventListener('click', event => {
  const checkedCount = document.querySelectorAll('table input[type="checkbox"]:checked').length;
  if (checkedCount <= 0) {
    event.preventDefault();
    toast({
      title: "Thất bại!",
      message: "Vui lòng chọn ít nhất 1 sản phẩm để xóa.",
      type: "error",
      duration: 5000
    });
  }
  else{
    deleteSanPham((getIdSanPhamCheckBox()));
  }
});

function deleteSanPham(data){
  $.ajax({
    url: '/laptopSeller/Controller/admin/SanPhamController.php',
    method: 'POST',
    data: {idToDelete: JSON.stringify(data)},
    success: function(response) {
      console.log(response);
      reloadTable();
      toast({
        title: "Thành công!",
        message: "Đã xóa sản phẩm",
        type: "success",
        duration: 5000
      });
    },
    error: function(error) {
      toast({
        title: "Thất bại!",
        message: "Đã có lỗi xảy ra.",
        type: "error",
        duration: 5000
      });
      console.log(error);
    }
  });
}

// JavaScript code to reload table using AJAX
function reloadTable() {
  $.ajax({
      type: "GET",
      url: "/laptopSeller/View/admin/tablesanpham.php", // replace with your server-side file name
      success: function(data) {
          // update table content with new data
          $(".table_content-sanpham").html(data);
          uncheckAll();
      }
  });
}
reloadTable();
uncheckAll();


function getRowValues(checkbox) {
  var row = checkbox.parentNode.parentNode; // Get the parent row of the checkbox
  var cells = row.cells; // Get all the cells in the row
  var values = [];
  var lastValue = ''; // Create an empty array to store the values

  // Loop through all the cells in the row and get their values
  for (var i = 0; i < cells.length; i++) {
      values.push(cells[i].textContent); // Add the value of the cell to the array
  }

  if (checkbox.checked) { // Check if the checkbox is checked
      lastValue = values[values.length - 1]; // Get the last value in the array

      return lastValue; // Return the last value
  } else {
      // If the checkbox is unchecked, set the value to an empty string
      lastValue = '';
  }

}




