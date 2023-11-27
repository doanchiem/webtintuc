<?php
// include "connect.php";
function SearchContent($text)
{
  $conn = connect();

  $listType = mysqli_query($conn, "SELECT * FROM baiviet WHERE content LIKE '%" . $text . "%'");
  if (!$listType) {
    die("không có kết quả " . $listType);
  };
  return $listType;
};
