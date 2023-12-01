<?php
//include "./connect/getListPostType.php";
?>
<div id="column1">
    <ul id="latestnews">
        <?php
        $list = getListPostType(14);
        foreach ($list as $key) { ?>


            <li>
                <a class="text-white " style="color: white;" href=<?php echo 'index.php?main=tokyo&postsId=' . $key['ID_baiviet'] ?>>
                    <img class="PhotoNhatban" src="<?php echo '/webtintuc/images/' . $key["img"] ?>" alt="" />
                    <p><strong><a href="#">
                                <?php echo $key["title"] ?>
                            </a></strong></p>
                    <p><?php echo $key["content"] ?></p>
                </a>
            </li>
        <?php
        };

        ?>
    </ul>
</div>

<br class="clear" />