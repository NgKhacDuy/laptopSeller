<?php
$filename = $_POST['filename'];
$file_path = $_SERVER['DOCUMENT_ROOT'] . "/laptopSeller/assets/img/" . $filename;

if (file_exists($file_path)) {
    unlink($file_path);
    echo 'File has been deleted.';
} else {
    echo 'File does not exist.';
}
?>