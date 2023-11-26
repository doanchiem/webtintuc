<?php
include "../pages/connect/getListPostType.php";
$types = getAllPostType();


$edit = isset($_GET['edit']) ? $_GET['edit'] : '';

$status = ($edit) ? "Chỉnh sửa" : "Thêm mới";
$post = null;
$contents = null;
if (isset($_GET['edit'])) {
    $result = getPost($edit);
    $post = mysqli_fetch_assoc($result);
    $contents = getlistcontent(9);
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
    $IdTheloai = $_POST['ID_theloaitin2'];
    // Kiểm tra và xử lý dữ liệu đầu vào ở đây để tránh SQL injection
    $conn = connect(); // Connect to the database
    $id = mysqli_real_escape_string($conn, $id);
    $title = mysqli_real_escape_string($conn, $title);
    $image = mysqli_real_escape_string($conn, $image);
    $content = mysqli_real_escape_string($conn, $content);
    $IdTheloai = mysqli_real_escape_string($conn, $IdTheloai);
    // Gọi hàm editPost để sửa bài viết
    if (isset($_GET['edit'])) {
        editPost($id, $title, $image, $content);
    } else {
        $res =  createPost($IdTheloai, $title, $image, $content);
        echo $res;
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
        <form name='mainArticle' class="from" action='' method='POST'>
            <label for='title'>Loại bài viết:</label>
            <select name='ID_theloaitin2'><?php foreach ($types as $type) { ?>
                    <option <?php echo ($edit && $post && $post['ID_theloaitin2'] == $type['ID_theloaitin2']) ? 'selected' : ''; ?> value="<?php echo $type['ID_theloaitin2']; ?>">
                        <?php echo $type['tentheloaitin2']; ?>
                    </option>
                <?php } ?>
            </select>
            <br />
            <label for='title'>Tên bài viết:</label>
            <input required class="title" type='text' id='title' name='title' value="<?php echo ($edit && $post) ? $post['title'] : ''; ?>">
            <br>
            <label for='image'>Link ảnh:</label>
            <input required class="image" type='text' id='image' name='image' value="<?php echo ($edit && $post) ? $post['img'] : ''; ?>">
            <br>
            <label for='content'>Nội dung bài viết:</label>
            <textarea required class="content" id='content' name='content'><?php echo ($edit && $post) ? $post['content'] : ''; ?></textarea>
            <br>
            <button class="btl" type='submit'>
                <?php echo $status ?>
            </button>


        </form>
   
    
        <form class="detail" action='' method='POST'>
            <?php
           if (!is_null($contents) ) {
            foreach ($contents as $key) {  ?>
                <label for='title'>Tiêu đề</label>
                <input required class="title" type='text' id='title' name='title' value="<?php echo $key['title'] ?>">
                <br>
                <label for='image'>Link ảnh:</label>
                <input required class="image" type='text' id='image' name='image' value="<?php echo  $key['img']  ?>">
                <br>
                <label for='content'>Nội dung bài viết:</label>
                <textarea required class="content" id='content' name='content'><?php echo  $key['content']  ?></textarea>
                <br>
                <hr/>
            <?php }}   ?>
            <button class="btl" type='submit'>
               Lưu
            </button>
        </form>
    </div>

</body>

</html>