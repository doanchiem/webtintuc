<?php
//include "./connect/getListPostType.php";
?>
<div id="column1">
    <ul id="latestnews">
        <?php
        $list = getListPostType(14);
        foreach ($list as $key) { ?>

            <li><img class="PhotoNhatban" src=<?php echo $key["img"] ?> alt="" />
                <p><strong><a href="#">
                            <?php echo $key["title"] ?>
                        </a></strong></p>
                <p><?php echo $key["content"] ?></p>
            </li>
        <?php
        };

        ?>
    </ul>
</div>

<br class="clear" />