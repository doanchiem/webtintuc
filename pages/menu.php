<!-- ####################################################################################################### -->
<?php
// Get the path of the current URL
// $current_url = explode("?", $_SERVER['REQUEST_URI']);
// echo (count($current_url));
//  = count($current_url) < 2 || $current_url[1] == "index.php" ? "index.php" : $current_url[1];

// $current_url = $_SERVER['REQUEST_URI'];
// $parts = explode('/', $current_url);
// echo '1234567';
// echo $parts[5];
// Include the appropriate PHP file based on the path
$fileName =  "index.php";
if (isset($_GET['main'])) {
  $fileName =  $_GET['main'];
}
?>
<div class="wrapper col2">
  <div id="topbar">
    <div id="topnav">
      <ul>
        <li <?php if ($fileName == "index.php") echo 'class="active"'; ?>><a href="index.php">trang chủ</a></li>
        <li <?php if ($fileName == "kinhnghiem") echo 'class="active"'; ?>><a href="index.php?main=kinhnghiem">kinh nghiệm</a></li>
        <li <?php if ($fileName == "amthuc") echo 'class="active"'; ?>><a href="index.php?main=amthuc">ẩm thực</a></li>
        <li <?php if ($fileName == "tokyo" || $fileName == "vietnam" || $fileName == "hanquoc") echo 'class="active"'; ?>><a href="#">địa danh</a>
          <ul>
            <li <?php if ($fileName == "tokyo") echo 'class="active"'; ?>><a href="index.php?main=tokyo">Tokyo</a></li>
            <li <?php if ($fileName == "vietnam") echo 'class="active"'; ?>><a href="index.php?main=vietnam">Việt Nam</a></li>
            <li <?php if ($fileName == "hanquoc") echo 'class="active"'; ?>><a href="index.php?main=hanquoc">Hàn Quốc</a></li>
          </ul>
        </li>
        <li <?php if ($fileName == "trainghiemcanhan") echo 'class="active"'; ?> class="last"><a href="index.php?main=trainghiemcanhan">trải nghiệm cá nhân</a></li>
      </ul>
    </div>
    <div id="search">
      <form action="index.php" method="get">
        <fieldset>
          <legend>từ khóa tìm kiếm</legend>
          <input name='seach' type="text" placeholder="từ khóa tìm kiếm&hellip;" />
          <button type="submit" id="go">
            Tìm kiếm
          </button>
        </fieldset>
      </form>
    </div>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->