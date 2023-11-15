<?php
//include "./connect/getListPostType.php";
?>
<div id="column1">
    <ul id="latestnews">
        <?php
        $list = getListPostType(9);
        foreach ($list as $key) { ?>

            <li><img class="tokyo" src=<?php echo $key["img"] ?> alt="" />
                <p><strong><a href="#">
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