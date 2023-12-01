<?php

function update_image($file,$filename){
 // Lấy thư mục lưu trữ ảnh
 $target_file = "../../images/" . $filename;

 if (move_uploaded_file($file, $target_file)) {
     echo "File " . basename($filename) .
         " Đã upload thành công.";

     echo "File lưu tại " . $target_file;
 } else {
     echo "Có lỗi xảy ra khi upload file.";
 }
 

}