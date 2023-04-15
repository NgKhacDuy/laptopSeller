<?php
if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
  $tmp_name = $_FILES['image']['tmp_name'];
  $name = basename($_FILES['image']['name']);
  $upload_path = $_SERVER['DOCUMENT_ROOT'] . "/laptopSeller/assets/img/";
  move_uploaded_file($tmp_name, $upload_path . $name);
  var_dump("Upload successful!");
} else {
  var_dump("Error uploading file.");
}
?>