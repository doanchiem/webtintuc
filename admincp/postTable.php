<?php
include "../pages/connect/getListPostType.php";
$types = getAllPostType();
$list = getAllPost();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delId'])) {
        echo $_POST['delId'];
        $result = deletePost(($_POST['delId']));
        if ($result) {
            header("Location: ".$_SERVER['PHP_SELF']);
        exit;
        } else {
            echo "<script>alert('Xóa thất bại');</script>";
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
    <title>admin</title>
</head>

<body>
    <div id="postTable">
        <div class="header_menu">
            <a href="/webtintuc/admincp/editPost.php" target="_blank">
                <button class="btl">
                    thêm mới bài viết
                </button></a>
        </div>
        <div id='main'>
            <table border-collapse="collapse" border-style="solid">
                <thead>
                    <tr>
                        <td>STT</td>
                        <td>thể loại bài viết</td>
                        <td>tiêu đề</td>
                        <td>ảnh </td>
                        <td class='content'>nội dung</td>
                        <td>sửa</td>
                        <td>xóa</td>
                        <!-- <td></td>
                        <td></td>
                        <td></td> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $s = 0;

                    foreach ($list as $key) {

                        $type = null;

                        foreach ($types as $k => $value) {

                            if ($key['ID_theloaitin2'] === $value['ID_theloaitin2']) {
                                $type = $value;
                                break;
                            }
                        }

                    ?>

                        <tr>
                            <td><?php echo $s ?></td>
                            <td><?php if ($type !== null && $type['tentheloaitin2']) {
                                    echo $type['tentheloaitin2'];
                                } ?></td>
                            <td class='title'><?php echo $key['title'] ?></td>
                            <td> <img class="table_item_img" style="width: 100px;" src=<?php echo $key["img"] ?> alt="" /></td>
                            <td class='content'><?php echo $key['content'] ?></td>
                            <td>
                                <a href="/webtintuc/admincp/editPost.php?edit=<?php echo $key['ID_baiviet'] ?>" target="_blank">
                                    <button class='edit_btl'>
                                        sửa
                                    </button></a>
                            </td>
                            <td>
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <input type="hidden" name="delId" value="<?php echo $key['ID_baiviet']; ?>">
                                    <input class='del_btl' type="submit" value="Xóa" name="delete">
                                </form>
                            </td>
                            <!-- <td></td>
                            <td></td>
                            <td></td> -->
                        </tr>

                    <?php $s++;
                    } ?>

                </tbody>
            </table>
        </div>
    </div>
</body>

</html>