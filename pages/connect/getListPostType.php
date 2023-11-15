<?php
include "connect.php";
function getListPostType($id)
{
  $conn = connect();

  $listType = mysqli_query($conn, "SELECT * FROM baiviet WHERE ID_theloaitin2=$id");
  if (!$listType) {
    die("thất bại: " . $listType);
  };
  return $listType;
}
function getlistcontent($id)
{
  $conn = connect();
  $listcontent = mysqli_query($conn, "SELECT * FROM noidungbaiviet WHERE ID_baiviet=$id");
  if (!$listcontent) {
    die("thất bại:" . $listcontent);
  };
  return $listcontent;
};
function getPost($id)
{
  $conn = connect();
  $post = mysqli_query($conn, "SELECT * FROM `baiviet` WHERE ID_baiviet = $id");
  if (!$post) {
    die("thất bại:" . $post);
  };
  return $post;
};
