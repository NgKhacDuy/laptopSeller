<?php

// Get the filename from the POST parameters
$fileName = $_POST['file_name'];

// Specify the path to the folder where the images are stored
$folderPath = $_SERVER['DOCUMENT_ROOT'] . "/laptopSeller/assets/img/";

// Check if the file already exists in the folder
if (file_exists($folderPath . $fileName)) {
  // If the file exists, return a response of "exists"
  echo "exists";
} else {
  // If the file does not exist, return an empty response
  echo "";
}
?>