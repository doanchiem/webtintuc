<?php
include "../pages/connect/getListPostType.php";


$edit = isset($_GET['edit']) ? $_GET['edit'] : '';

$status = ($edit) ? "Chỉnh sửa" : "Thêm mới";
$post = null;
if (isset($_GET['edit'])) {
    $result = getPost($edit);
    $post = mysqli_fetch_assoc($result);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleadmin.css">
    <title>admin</title>
</head>

<body>
    <div class="editPost">

        <h1 class='header'>
            <?php echo $status; ?>
        </h1>
        <form class="from" action='' method='POST'>

            <label for='title'>Tên bài viết:</label>
            <input class="title" type='text' id='title' name='title'
                value="<?php echo ($edit && $post) ? $post['title'] : ''; ?>">
            <br>
            <label for='image'>Link ảnh:</label>
            <input class="image" type='text' id='image' name='image'
                value="<?php echo ($edit && $post) ? $post['img'] : ''; ?>">
            <br>
            <label for='content'>Nội dung bài viết:</label>
            <textarea class="content" id='content'
                name='content'><?php echo ($edit && $post) ? $post['content'] : ''; ?></textarea>
            <br>
            <button class="btl" type='submit'>
                <?php echo $status ?>
            </button>


        </form>


    </div>

</body>

</html>