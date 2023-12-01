<?php
include "../../pages/connect/getListPostType.php";
include "./logic.php";

$edit = isset($_GET['edit']) ? $_GET['edit'] : '';

// $status = ($edit) ? "Chỉnh sửa" : "Thêm mới";
// $post = null;
$contents = null;
if (isset($_GET['edit'])) {
    // $result = getPost($edit);
    // $post = mysqli_fetch_assoc($result);
    $contents = getlistcontent($edit);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'] ?? ''; // Lấy ID bài viết từ form
    } else {
        $id = ''; // Set default value for $id
    }
    $title = $_POST['title'] ?? ''; // Lấy tiêu đề bài viết từ form
    $oldImage = $_POST['oldImage'] ?? ''; // Lấy link ảnh từ form
    $content = $_POST['content'] ?? ''; // Lấy nội dung bài viết từ form
    $IdTheloai = $_POST['ID_theloaitin2'] ?? '';
    // Kiểm tra và xử lý dữ liệu đầu vào ở đây để tránh SQL injection
    $conn = connect(); // Connect to the database
    $id = mysqli_real_escape_string($conn, $id);
    $title = mysqli_real_escape_string($conn, $title);
    $oldImage = mysqli_real_escape_string($conn, $oldImage);
    $content = mysqli_real_escape_string($conn, $content);
    $IdTheloai = mysqli_real_escape_string($conn, $IdTheloai);



    if (isset($_POST['addContent'])) { //bấm dấu cộng
        if (isset($_GET['edit'])) { // nếu là sửa bài viết
            if ($_FILES["image"]["name"] !== '') {
                $uniqueString = uniqid();
                $filename = $uniqueString .  str_replace(' ', '', $_FILES["image"]["name"]);
                $file = $_FILES["image"]["tmp_name"];
                update_image($file, $filename);
                editPost($edit, $title, $filename, $content);
            }

            editPost($edit, $title, $oldImage, $content);

            if (!is_null($contents)) { // bài viết có nhiều nội dung
                $Idnoidungbaiviet = $_POST['Idnoidungbaiviet'] ?? [];
                $contentTitle = $_POST['contentTitle'] ?? [];
                $oldContentImage = $_POST['oldContentImage'] ?? [];
                $contentContent = $_POST['contentContent'] ?? [];
                $count = 0;
                foreach ($Idnoidungbaiviet as $id) { // cập nhật từng nội dung
                    if ($_FILES["contentImage"]["name"][$count] !== '') {
                        $uniqueString = uniqid();
                        $filename = $uniqueString .  str_replace(' ', '', $_FILES["contentImage"]["name"][$count]);
                        $file = $_FILES["contentImage"]["tmp_name"][$count];
                        update_image($file, $filename);
                        echo $filename;

                        updateContent($id, $contentContent[$count], $filename, $contentTitle[$count] ?? '');
                    } else {
                        updateContent($id, $contentContent[$count], $oldContentImage[$count] ?? '', $contentTitle[$count] ?? '');
                    }
                    $count++;
                }
                createContent('', '', '', $edit); // thêm nội dung mới
            } else {
                createContent('', '', '', $edit); // thêm nội dung mới
            }
            $contents = getlistcontent($edit);
            header("Location: editPost.php?edit=$edit");
        } else { // nếu là bài viết mới
            $uniqueString = uniqid();
            $filename = $uniqueString .  str_replace(' ', '', $_FILES["image"]["name"]);
            $file = $_FILES["image"]["tmp_name"];
            update_image($file, $filename);
          
            $res =  createPost($IdTheloai, $title,  $filename, $content); // tạo bài viết
            createContent('', '', '',  $res);
                header("Location: editPost.php?edit=$res");

            $contents = getlistcontent($res);
        }
    }

    // Gọi hàm editPost để sửa bài viết
    if (isset($_POST['save'])) {
        // Lấy tên tệp đã tải lên
        $uniqueString = uniqid();
        $filename = $uniqueString .  str_replace(' ', '', $_FILES["image"]["name"]);
        $file = $_FILES["image"]["tmp_name"];
        update_image($file, $filename);

        if (isset($_GET['edit'])) {


            editPost($edit, $title, $filename, $content);
            if (!is_null($contents)) {
                $Idnoidungbaiviet = $_POST['Idnoidungbaiviet'] ?? [];
                $contentTitle = $_POST['contentTitle'] ?? [];
                // $contentImage = $_POST['contentImage'] ?? [];
                $oldContentImage = $_POST['oldContentImage'] ?? [];
                $contentContent = $_POST['contentContent'] ?? [];
                $count = 0;
                foreach ($Idnoidungbaiviet as $id) {
                    if ($_FILES["contentImage"]["name"][$count] !== '') {
                        $uniqueString = uniqid();
                        $filename = $uniqueString .  str_replace(' ', '', $_FILES["contentImage"]["name"][$count]);
                        $file = $_FILES["contentImage"]["tmp_name"][$count];
                        update_image($file, $filename);
                        echo $filename;

                        updateContent($id, $contentContent[$count], $filename, $contentTitle[$count] ?? '');
                    } else {
                        updateContent($id, $contentContent[$count], $oldContentImage[$count] ?? '', $contentTitle[$count] ?? '');
                    }
                    $count++;
                }
                // createContent('', '', '', $edit);
                header("Location: editPost.php?edit=$edit");
            } else {
                // createContent('', '', '', $edit);
            }
        } else {
            if ($_FILES["image"]["name"] !== '') {
                $uniqueString = uniqid();
                $filename = $uniqueString .  str_replace(' ', '', $_FILES["image"]["name"]);
                $file = $_FILES["image"]["tmp_name"];
                update_image($file, $filename);
                $res =  createPost($IdTheloai, $title, $filename, $content);
            } else {
                $res =  createPost($IdTheloai, $title, '', $content);
                 echo $res;
                // $Idnoidungbaiviet = $_POST['Idnoidungbaiviet'] ?? [];
                // $contentTitle = $_POST['contentTitle'] ?? [];
                // $contentImage = $_POST['contentImage'] ?? [];
                // $contentContent = $_POST['contentContent'] ?? [];
                // if (!empty($Idnoidungbaiviet)) {
                //     foreach ($Idnoidungbaiviet as $id) {
                //         createContent($contentContent[$count] ?? '', $contentImage[$count] ?? '', $contentTitle[$count] ?? '', $res);
                //         $count++;
                //     }
                // }
            }


            header("Location: editPost.php?edit=$res");
        }
    }
}
