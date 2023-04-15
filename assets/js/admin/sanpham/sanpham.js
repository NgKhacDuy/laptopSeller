
  var input = document.getElementsByTagName('input');

function uncheckAll() {
  for (var i = 0; i < input.length; i++) {
    if (input[i].type == 'checkbox') {
        input[i].checked =false;
    }
}
}

var modal = document.getElementById("myModal");
var btn_them = document.querySelector('.btn-admin-sanpham-them')
var btn_sua = document.querySelector('.btn-admin-sanpham-sua')
var span = document.getElementsByClassName("modal-admin_sanpham-close")[0];
var btn_huy = document.querySelector('.btn-admin-sanpham-huy');
var titleModal = document.querySelector('.modal-admin_sanpham-title');
var input_masp = document.querySelector('#input-admin_sanpham-masp');
var input_tensp = document.querySelector('#input-admin_sanpham-tensp');
var input_loaisp = document.querySelector('#input-admin_sanpham-loaisp');
var input_gianhap = document.querySelector('#input-admin_sanpham-gianhap');
var input_giaban = document.querySelector('#input-admin_sanpham-giaban');
var input_thuonghieu = document.querySelector('#input-admin_sanpham-thuonghieu');
var input_soluong =document.querySelector('#input-admin_sanpham-soluong');
var input_img = document.querySelector('#image-input-admin-sanpham');
var error_modal = document.querySelector('.error-modal');
var btn_luu = document.querySelector('.btn-admin-sanpham-luu');
var stateModal ='';
btn_luu.addEventListener('click', function() {
  saveModal(stateModal);
});
btn_them.onclick = function() {
  titleModal.innerText = "Thêm sản phẩm";
  modal.style.display = "block";
  stateModal='insert';
}

span.onclick = function() {
  modal.style.display = "none";
  resetAllInputModal();
}

btn_huy.onclick = function() {
  modal.style.display = "none";
  resetAllInputModal();
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
// const btn_sua = document.querySelector('.btn-admin-sanpham-sua');
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
  else{
    titleModal.innerText="Sửa sản phẩm";
    modal.style.display = "block";
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

function deleteImg(name){
  $.ajax({
    type: "POST",
    url: "/laptopSeller/View/admin/deleteImg.php",
    data: { filename: filename },
    success: function(data){
      alert(data);
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

function resetAllInputModal(){
  input_giaban.value ="";
  input_gianhap.value ="";
  input_img.value ="";
  input_masp.value ="";
  input_tensp.value ="";
  imagePreview.style.backgroundImage=`url(../../laptopSeller/assets/img/default-img.png)`;
}
function saveimage(){
 var form_data = new FormData();
 form_data.append('image',$('#image-input-admin-sanpham')[0].files[0]);
 checkImageNameDuplicate(input_img.files[0].name)
  .then(function (doesNotExist){
    if(doesNotExist){
      $.ajax({
        url: '/laptopSeller/View/admin/saveImg.php',
        type: 'POST',
        data: form_data,
        processData: false,
        contentType: false,
        success: function(response) {
          // Handle the success response from the server
          const arr = getAllValueInput();
          arr.splice(2,0,input_img.files[0].name);
          console.log(JSON.stringify(arr));
          $.ajax({
            url: '/laptopSeller/Controller/admin/SanPhamController.php',
            type: 'POST',
            data: {dataInsert: JSON.stringify(arr)},
            success:function(response){
              modal.style.display = "none";
              resetAllInputModal();
              reloadTable();
              toast({
                title: "Thành công",
                message: "Thêm sản phẩm thành công.",
                type: "success",
                duration: 5000
              });
            },
            error:function(response){
              toast({
                title: "Thất bại!",
                message: "Tên hình ảnh bị trùng.",
                type: "error",
                duration: 5000
              });
            }
          })
        },
        error: function(jqXHR, textStatus, errorThrown) {
          // Handle any errors that occur during the request
        }
       })
    }
    else{
      toast({
        title: "Thất bại!",
        message: "Tên hình ảnh bị trùng.",
        type: "error",
        duration: 5000
      });
    }
  })
}

function checkImageNameDuplicate(fileName) {
  return new Promise(function(resolve, reject) {
    $.ajax({
      type: "POST",
      url: "/laptopSeller/View/admin/checkImgDuplicated.php",
      data: { file_name: fileName },
      success: function(data) {
        if (data == "exists") {
          // Handle the case where the file already exists
          resolve(false);
        } else {
          // Proceed with uploading the file
          resolve(true);
        }
      },
      error: function(xhr, textStatus, errorThrown) {
        // Handle any errors that occur during the request
        console.log("Error: " + textStatus + " " + errorThrown);
        reject(errorThrown);
      }
    });
  });
}



function getAllValueInput(){
  let data =[];
  data.push(input_tensp.value);
  data.push(input_thuonghieu.value);
  var giaban = parseInt(input_giaban.value.replace(/\./g,""));
  data.push(giaban);
  data.push(input_loaisp.value);
  data.push(input_soluong.value);
  return data;
}


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

function validateModal(){
  isValid = true;
  switch(true){
    case input_tensp.value.trim()==='':
      error_modal.style.display='block';  
      error_modal.innerText='Tên sản phẩm không được để trống';
      isValid = false;
    break;
    case input_giaban.value.trim()==='':
      error_modal.style.display='block';  
      error_modal.innerText='Giá bán không được để trống';
      isValid = false;
    break;
    case input_soluong.value.trim()==='':
      error_modal.style.display='block';  
      error_modal.innerText='Số lượng không được để trống';
      isValid = false;
    break;
    case input_img.value.trim()==='':
      error_modal.style.display='block';  
      error_modal.innerText='Hình ảnh sản phẩm không được để trống';
      isValid = false;
    break;
    case input_thuonghieu.value.trim()==='':
      error_modal.style.display='block';  
      error_modal.innerText='Thương hiệu sản phẩm không được để trống';
      isValid = false;
    break;
    default:
      error_modal.style.display = 'none';
      error_modal.innerText = '';
  }
  if(isValid){}
  return isValid;
}

function saveModal(state){
  switch(state){
    case 'insert':
      if(validateModal()){
        alert('insert');
        saveimage();
      }
  }
}
input_giaban.addEventListener('input', (event) => {
  // Get the input value
  let value = event.target.value;

  // Remove all non-digit characters
  value = value.replace(/\D/g, '');

  // Format the value with commas
  value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

  // Set the formatted value back to the input field
  event.target.value = value;
});




