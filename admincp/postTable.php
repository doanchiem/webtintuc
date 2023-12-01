<?php
include "../pages/connect/getListPostType.php";
$types = getAllPostType();
$list = getAllPost();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delId'])) {
        echo $_POST['delId'];
        $result = deletePost(($_POST['delId']));
        if ($result) {
            header("Location: " . $_SERVER['PHP_SELF']);
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
            <a href="/webtintuc/admincp/editPost/editPost.php" target="_blank">
                <button class="btl">
                    thêm mới bài viết
                </button></a>
            <button onclick="delAll()" type="button" class="btl del_btl">
                xóa bài viết
            </button>
        </div>
        <div id='main'>
            <table border-collapse="collapse" border-style="solid">
                <thead>
                    <tr>
                        <td></td>
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
                            <td class="items-center"><input type="checkbox" name="" id="checkbox" onchange="addToList(<?php echo $key['ID_baiviet']; ?>)"></td>
                            <td class="items-center"><?php echo $s + 1 ?></td>
                            <td><?php if ($type !== null && $type['tentheloaitin2']) {
                                    echo $type['tentheloaitin2'];
                                } ?></td>
                            <td class='title'><?php echo $key['title'] ?></td>
                            <td class="items-center"> <img class="table_item_img" style="width: 100px;" src=<?php echo '/webtintuc/images/' . $key["img"] ?> alt="" /></td>
                            <td class='content'><?php echo $key['content'] ?></td>
                            <td class="items-center">
                                <a href="/webtintuc/admincp/editPost/editPost.php?edit=<?php echo $key['ID_baiviet'] ?>" target="_blank">
                                    <button class='edit_btl'>
                                        sửa
                                    </button></a>
                            </td>
                            <td class="items-center">
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
    <script>
        const listId = []

        function addToList(id) {
            if (!listId.includes(id)) {
                listId.push(id)
            } else {
                const index = listId.indexOf(id)
                listId.splice(index, 1)
            }
            console.log(listId)
        }

        function delAll() {
            const data = {
                action: 'delete-all',
                ids: listId
            }
            fetch('./delPost.php', {
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