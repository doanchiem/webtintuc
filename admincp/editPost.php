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
    $contents = getlistcontent($edit);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'] ?? ''; // Lấy ID bài viết từ form
    } else {
        $id = ''; // Set default value for $id
    }
    $title = $_POST['title'] ?? ''; // Lấy tiêu đề bài viết từ form
    $image = $_POST['image'] ?? ''; // Lấy link ảnh từ form
    $content = $_POST['content'] ?? ''; // Lấy nội dung bài viết từ form
    $IdTheloai = $_POST['ID_theloaitin2'] ?? '';
    // Kiểm tra và xử lý dữ liệu đầu vào ở đây để tránh SQL injection
    $conn = connect(); // Connect to the database
    $id = mysqli_real_escape_string($conn, $id);
    $title = mysqli_real_escape_string($conn, $title);
    $image = mysqli_real_escape_string($conn, $image);
    $content = mysqli_real_escape_string($conn, $content);
    $IdTheloai = mysqli_real_escape_string($conn, $IdTheloai);

    if (isset($_POST['deleteContent'])) {
        // Thực hiện câu lệnh SQL để xóa nội dung từ cơ sở dữ liệu dựa trên $contentId
        // Sau đó làm mới trang hoặc thực hiện các hành động khác sau khi xóa nội dung
        $contentId = $_POST['contentId'] ?? '';
        deleteContent($contentId);
        header("Refresh:0");
        exit;
    }

    if (isset($_POST['addContent'])) {
        if (isset($_GET['edit'])) {
            editPost($edit, $title, $image, $content);
            if (!is_null($contents)) {
                $Idnoidungbaiviet = $_POST['Idnoidungbaiviet'] ?? [];
                $contentTitle = $_POST['contentTitle'] ?? [];
                $contentImage = $_POST['contentImage'] ?? [];
                $contentContent = $_POST['contentContent'] ?? [];

                $count = 0;
                foreach ($Idnoidungbaiviet as $id) {
                    updateContent($id, $contentContent[$count] ?? '', $contentImage[$count] ?? '', $contentTitle[$count] ?? '');
                    $count++;
                }
                createContent('', '', '', $edit);
            } else {
                createContent('', '', '', $edit);
            }
            $contents = getlistcontent($edit);
        } else {

            $res =  createPost($IdTheloai, $title, $image, $content);
            // echo $res;
            $Idnoidungbaiviet = $_POST['Idnoidungbaiviet'] ?? [];
            $contentTitle = $_POST['contentTitle'] ?? [];
            $contentImage = $_POST['contentImage'] ?? [];
            $contentContent = $_POST['contentContent'] ?? [];
            if (!empty($Idnoidungbaiviet)) {
                foreach ($Idnoidungbaiviet as $id) {
                    createContent($contentContent[$count] ?? '', $contentImage[$count] ?? '', $contentTitle[$count] ?? '', $res);
                    $count++;
                }
            } else {
                createContent('', '', '',  $res);
                header("Location: editPost.php?edit=$res");
            }

            $contents = getlistcontent($res);
        }
    }

    // Gọi hàm editPost để sửa bài viết
    if (isset($_POST['save'])) {

        if (isset($_GET['edit'])) {
            editPost($edit, $title, $image, $content);
            if (!is_null($contents)) {
                $Idnoidungbaiviet = $_POST['Idnoidungbaiviet'] ?? [];
                $contentTitle = $_POST['contentTitle'] ?? [];
                $contentImage = $_POST['contentImage'] ?? [];
                $contentContent = $_POST['contentContent'] ?? [];

                $count = 0;
                foreach ($Idnoidungbaiviet as $id) {
                    updateContent($id, $contentContent[$count] ?? '', $contentImage[$count] ?? '', $contentTitle[$count] ?? '');
                    $count++;
                }
                // createContent('', '', '', $edit);
                header("Location: editPost.php?edit=$edit");

            } else {
                // createContent('', '', '', $edit);
            }
        } else {

            $res =  createPost($IdTheloai, $title, $image, $content);
            // echo $res;
            $Idnoidungbaiviet = $_POST['Idnoidungbaiviet'] ?? [];
            $contentTitle = $_POST['contentTitle'] ?? [];
            $contentImage = $_POST['contentImage'] ?? [];
            $contentContent = $_POST['contentContent'] ?? [];
            if (!empty($Idnoidungbaiviet)) {
                foreach ($Idnoidungbaiviet as $id) {
                    createContent($contentContent[$count] ?? '', $contentImage[$count] ?? '', $contentTitle[$count] ?? '', $res);
                    $count++;
                }
            }
            header("Location: editPost.php?edit=$res");

        }
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
                <input required class="image" type='text' id='image' name='image' value="<?php echo ($edit && $post) ? $post['img'] : ''; ?>">
                <br>
                <label for='content'>Nội dung bài viết:</label>
                <textarea required class="content" id='content' name='content'><?php echo ($edit && $post) ? $post['content'] : ''; ?></textarea>
                <br>
            </div>



            <!-- </form>
   
    
        <form class="detail" action='' method='POST'> -->

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
                        <input class="image" type='text' id='image' name='contentImage[<?php echo $count ?>]' value="<?php echo  $key['img']  ?>">
                        <br>
                        <label for='contentContent'>Nội dung bài viết:</label>
                        <textarea class="content" id='content' name='contentContent[<?php echo $count ?>]'><?php echo  $key['content']  ?></textarea>
                        <br>
                        
                            <div class="delbtl">
                                <input type="hidden" name="contentId" value="<?php echo $key['ID_noidungbaiviet']; ?>">
                                <button class="btl del" type="submit" name="deleteContent">➖</button>
                            </div>
                        <!-- </form> -->
                        <hr />
                <?php $count++;
                    }
                }   ?>

                <button name='addContent' class="btl" type='submit'>
                    ➕
                </button>

            </div>

            <button name="save" class="btl save" type='submit' >
                <?php echo ($edit) ? "Cập nhật" : "Thêm mới"; ?>
            </button>

        </form>
    </div>

</body>

</html>