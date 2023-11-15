<?php
//include "./connect/getListPostType.php";
?>
<div id="column1">
    <ul id="latestnews">
        <?php
        $list = getListPostType(13);
        foreach ($list as $key) { ?>
            <a href=<?php echo 'index.php?main=amthuc&postsId=' . $key['ID_baiviet'] ?>>

                <li><img class="deital" src=<?php echo $key["img"] ?> alt="" />
                    <p><strong><a>
                                <?php echo $key["title"] ?>
                            </a></strong></p>
                    <p class="text-white"><?php echo $key["content"] ?></p>
                </li>
            <?php
        };

            ?>
    </ul>
</div>

<br class="clear" />