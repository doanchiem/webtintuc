<?php
$id = $_GET['postsId'];
//include "./connect/getListPostType.php";
$p = getPost($id);
$contents = getlistcontent($id);

?>
<div id="column1">
    <?php
    foreach ($p as $key) { ?>
        <div id="contentdeatil">
            <h2><?php echo $key['title'] ?></h2>
            <img src=<?php echo $key['img'] ?>></img>
            <p> <?php echo $key['content'] ?> </p>
        </div>
    <?php
    }
    ?>

    <?php
    foreach ($contents as $key) { ?>
        <div id="contentdeatil">
            <h2><?php echo $key['title'] ?></h2>
            <img src=<?php echo $key['img'] ?>></img>
            <p> <?php echo $key['content'] ?> </p>
        </div>
    <?php
    }
    ?>
</div>