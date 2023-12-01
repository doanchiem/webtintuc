<?php
include "../../pages/connect/getListPostType.php";
include "./logic.php";
$types = getAllPostType();
$serverName = $_SERVER['SERVER_NAME'];
// echo $serverName;
// define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/');
// echo ROOT_PATH;
$edit = isset($_GET['edit']) ? $_GET['edit'] : '';

$status = ($edit) ? "Chỉnh sửa" : "Thêm mới";
$post = null;
$contents = null;
if (isset($_GET['edit'])) {
    $result = getPost($edit);
    $post = mysqli_fetch_assoc($result);
    $contents = getlistcontent($edit);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleadmin.css">
    <title>edit</title>
</head>



<body>
    <div class="editPost">

        <h1 class='header'>
            <?php echo $status; ?>
        </h1>
        <form name='mainArticle' class="from" enctype="multipart/form-data" action='./createPost.php<?php echo $edit !== '' ? '?edit=' . $edit : '' ?>' method='POST'>
            <div class="postDetail">
                <label for='ID_theloaitin2'>Loại bài viết:</label>
                <select name='ID_theloaitin2'><?php foreach ($types as $type) { ?>
                        <option <?php echo ($edit && $post && $post['ID_theloaitin2'] == $type['ID_theloaitin2']) ? 'selected' : ''; ?> value="<?php echo $type['ID_theloaitin2']; ?>">
                            <?php echo $type['tentheloaitin2']; ?>
                        </option>
                    <?php } ?>
                </select>
                <br>
                <br>
                <label for='title'>Tên bài viết:</label>
                <input required class="title" type='text' id='title' name='title' value="<?php echo ($edit && $post) ? $post['title'] : ''; ?>">
                <br>
                <label for='image'>Link ảnh:</label>
                <div class="imgGroup">
                    <input type="text" name="oldImage" value="<?php echo ($edit && $post) ? $post['img'] : ''  ?>" hidden>
                    <img class="preview" id="mainImgPreview" src="<?php echo ($edit && $post) ? '/webtintuc/images/' . $post['img'] : ''  ?>" alt="Ảnh xem trước" />
                    <input type="file" id="image" name="image" onchange="previewImage(this ,'mainImgPreview')" accept="image/jpg, image/jpeg, image/png">
                </div>
                <br>
                <label for='content'>Nội dung bài viết:</label>
                <textarea required class="content" id='content' name='content'><?php echo ($edit && $post) ? $post['content'] : ''; ?></textarea>
                <br>
            </div>






            <div><b>Nội dung chi tiết</b></div>
            <div class="content">
                <?php
                if (!is_null($contents)) {
                    $count = 0;

                    foreach ($contents as $key) {  ?>
                        <input type="text" name="Idnoidungbaiviet[<?php echo $count ?>]" hidden value="<?php echo $key['ID_noidungbaiviet'] ?>">
                        <label for='contentTitle[<?php echo $count ?>]'>Tiêu đề</label>
                        <input class="title" type='text' id='title' name='contentTitle[<?php echo $count ?>]' value="<?php echo $key['title'] ?>">
                        <br>
                        <label for='contentImage'>Link ảnh:</label>
                        <div class="imgGroup">
                            <img class="preview" id="contentImage[<?php echo $count ?>]" src="<?php echo '/webtintuc/images/' . $key['img']   ?>" alt="Ảnh xem trước" />
                            <input type="file" id="image" class="image" onchange="previewImage(this ,'contentImage[<?php echo $count ?>]')" name='contentImage[<?php echo $count ?>]' accept="image/jpg, image/jpeg, image/png">
                            <input type="text" name="oldContentImage[<?php echo $count ?>]" value="<?php echo $key['img']  ?>" hidden>

                        </div>
                        <br>
                        <label for='contentContent'>Nội dung bài viết:</label>
                        <textarea class="content" id='content' name='contentContent[<?php echo $count ?>]'><?php echo  $key['content']  ?></textarea>
                        <br>
                        <button name='deleteContent' type="button" onclick="deleteContentByID(<?php echo $key['ID_noidungbaiviet'] ?>)" class="btl del">➖</button>
                        <hr />
                <?php $count++;
                    }
                }   ?>

                <button name='addContent' class="btl" type='submit'>
                    ➕
                </button>
            </div>



            <button name="save" class="btl save" type='submit'>
                <?php echo ($edit) ? "Cập nhật" : "Thêm mới"; ?>
            </button>

        </form>
    </div>
    <script>
        // Đoạn mã JavaScript để hiển thị ảnh khi người dùng chọn
        function previewImage(input, id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById(id).setAttribute('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function deleteContentByID(id) {
            console.log(id)
            const data = {
                action: 'deleteContent',
                id: id
            }
            fetch('./deleteContent.php', {
                    method: 'POST',
                    headers: {

                        'Content-Type': 'application/json; charset=utf-8'
                    },
                    body: JSON.stringify(data),
                })
                .then(response => {
                    // Xử lý phản hồi từ máy chủ
                    console.log(response);
                    return response.text();
                })
                .then(data => {
                    console.log('data', data);
                    location.reload();
                })
                .catch(error => {
                    console.log('error', error);
                    // Xử lý lỗi trong quá trình gửi yêu cầu AJAX
                });
        }
    </script>
</body>

</html>