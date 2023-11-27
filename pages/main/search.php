<?php
// include the correct file

$text = $_GET['search'];



$list = SearchContent($text);
?>
<div id="column1">
    <ul id="latestnews">
        <?php
        foreach ($list as $key) { ?>
            <li> <a href=<?php echo 'index.php?main=kinhnghiem&postsId=' . $key['ID_baiviet'] ?>>
                    <img class="detail" src=<?php echo $key["img"] ?> alt="" />
                    <p><strong><a href=<?php echo 'index.php?main=kinhnghiem&postsId=' . $key['ID_baiviet'] ?>>
                                <?php echo $key["title"] ?>
                            </a></strong></p>
                    <p class="text-white"><?php echo $key["content"] ?></p>
                </a> </li>
        <?php
        };
        ?>
    </ul>
</div>
<?php

?>