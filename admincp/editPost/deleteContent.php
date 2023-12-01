<?php
include "../../pages/connect/connect.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = file_get_contents('php://input');
    $param = json_decode($data, true);
    $action = $param['action'] ?? '';
    if ($action == 'deleteContent') {
        // Gọi hàm deleteContent với tham số id
        $id = $param['id'] ?? '';
        if (!empty($id)) {
            deleteContent($id);
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

function deleteContent($id)
{
    $conn = connect();
    // Xử lý logic xóa nội dung ở đây
    // Ví dụ: 
    // Xóa nội dung có id là $id từ cơ sở dữ liệu
    // Trả về kết quả (nếu cần) dưới dạng JSON
    $result = mysqli_query($conn, "DELETE FROM `noidungbaiviet` WHERE `ID_noidungbaiviet` = '$id'");
    
    if ($result) {
        // Xóa thành công
        $response = array('status' => 'success', 'message' => 'Nội dung đã được xóa thành công');
    } else {
        // Xóa thất bại
        $response = array('status' => 'error', 'message' => 'Xóa nội dung thất bại');
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>