<?php
//include "./connect/getListPostType.php";
?>
<div id="column1">
    <ul id="latestnews">
        <?php
        $list = getListPostType(11);
        foreach ($list as $key) { ?>

            <li>
                <a href=<?php echo 'index.php?main=hanquoc&postsId=' . $key['ID_baiviet'] ?>>
                    <img class="hanquocPhoto" src=<?php echo $key["img"] ?> alt="" />
                    <p><strong>
                            <?php echo $key["title"] ?>
                        </strong></p>
                    <p class="text-white"><?php echo $key["content"] ?></p>
                </a>
            </li>
        <?php
        };

        ?>
    </ul>
</div>

<br class="clear" />