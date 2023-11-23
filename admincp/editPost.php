<?php
include "../pages/connect/getListPostType.php";


$edit = isset($_GET['edit']) ? $_GET['edit'] : '';

$status = ($edit) ? "Chỉnh sửa" : "Thêm mới";
$post = null;
if (isset($_GET['edit'])) {
    $result = getPost($edit);
    $post = mysqli_fetch_assoc($result);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $id = $_POST['id']; // Lấy ID bài viết từ form
    } else {
        $id = ''; // Set default value for $id
    }
    $title = $_POST['title']; // Lấy tiêu đề bài viết từ form
    $image = $_POST['image']; // Lấy link ảnh từ form
    $content = $_POST['content']; // Lấy nội dung bài viết từ form

    // Kiểm tra và xử lý dữ liệu đầu vào ở đây để tránh SQL injection
    $conn = connect(); // Connect to the database
    $id = mysqli_real_escape_string($conn, $id);
    $title = mysqli_real_escape_string($conn, $title);
    $image = mysqli_real_escape_string($conn, $image);
    $content = mysqli_real_escape_string($conn, $content);

    // Gọi hàm editPost để sửa bài viết
    if (isset($_GET['edit'])) {
        editPost($id, $title, $image, $content);
    } else {
        createPost($title, $image, $content);
    }
} 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleadmin.css">
    <title>edit</title>
</head>



<body>
    <div class="editPost">

        <h1 class='header'>
            <?php echo $status; ?>
        </h1>
        <form class="from" action='' method='POST'>

            <label for='title'>Tên bài viết:</label>
            <input class="title" type='text' id='title' name='title' value="<?php echo ($edit && $post) ? $post['title'] : ''; ?>">
            <br>
            <label for='image'>Link ảnh:</label>
            <input class="image" type='text' id='image' name='image' value="<?php echo ($edit && $post) ? $post['img'] : ''; ?>">
            <br>
            <label for='content'>Nội dung bài viết:</label>
            <textarea class="content" id='content' name='content'><?php echo ($edit && $post) ? $post['content'] : ''; ?></textarea>
            <br>
            <button class="btl" type='submit'>
                <?php echo $status ?>
            </button>


        </form>


    </div>

</body>

</html>