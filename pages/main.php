<?php
include "./connect/getListPostType.php";
?>
<div class="wrapper col4" style='display:flex;'>
  <div id="container">
    <?php
    // Get the path of the current URL
    // $current_url = explode("?", $_SERVER['REQUEST_URI']);
    $tam =  "index.php";
    if (isset($_GET['main'])) {
      $tam =  $_GET['main'];
    }
    $postId = null;
    if (isset($_GET['postsId'])) {
      $postId =  $_GET['postsId'];
    }
    $seach = null;
    if (isset($_GET['seach'])) {
      $seach = $_GET['seach'];
    }
    // Include the appropriate PHP file based on the path
    if ($postId !== null) {
      include("deatilsPage/index.php");
    } elseif ($seach !== null) {
      include("main/seach.php");
    } elseif ($tam == 'kinhnghiem') {
      include("main/kinhnghiem.php");
    } elseif ($tam == 'amthuc') {
      include("main/amthuc.php");
    } elseif ($tam == 'diadanh') {
      include("main/diadanh.php");
    } elseif ($tam == 'trainghiemcanhan') {
      include("main/trainghiemcanhan.php");
    } elseif ($tam == 'tokyo')
      include("main/tokyo.php");
    elseif ($tam == 'vietnam') {
      include("main/vietnam.php");
    } elseif ($tam == 'hanquoc') {
      include("main/hanquoc.php");
    } else {
      include("main/index.php");
    }

    // Include the sidebar
    include("right.sidebar/sidebar.php");
    ?>

  </div>
</div>