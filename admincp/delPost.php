<?php
include "../pages/connect/connect.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = file_get_contents('php://input');
    $param = json_decode($data, true);
    $action = $param['action'] ?? '';
    if ($action == 'delete-all') {
        // Gọi hàm deleteContent với tham số id
        $ids = $param['ids'] ?? '';
        if (!empty($ids)) {
            deleteAll($ids);
        } else {
            // Xử lý khi thiếu tham số id
            echo "Thiếu tham số id";
        }
    } else {
        // Xử lý khi action không phù hợp
       
        echo "Action không hợp lệ";
    }
} else {
    // Xử lý khi không phải là yêu cầu POST
    echo "Yêu cầu không hợp lệ";
}
function deleteAll($ids){
    $conn = connect();
    $id_list = implode(',', $ids); // Chuyển mảng ID thành chuỗi ngăn cách bởi dấu phẩy
    $delete = mysqli_query($conn, "DELETE FROM baiviet WHERE `baiviet`.`ID_baiviet` IN ($id_list)");
    if (!$delete) {
        die("thất bại:" . mysqli_error($conn));
    }
    return $delete;
}