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
function getAllPost()
{
  $conn = connect();
  $post = mysqli_query($conn, "SELECT * FROM `baiviet`");
  if (!$post) {
    die("thất bại:" . $post);
  };
  return $post;
};
function getAllPostType()
{
  $conn = connect();
  $postType = mysqli_query($conn, "SELECT * FROM `theloaitin2`");
  if (!$postType) {
    die("thất bại:" . $postType);
  };
  return $postType;
};
function deletePost($id)
{
  $conn = connect();
  $delete = mysqli_query($conn, "DELETE FROM baiviet WHERE `baiviet`.`ID_baiviet` = $id");
  if (!$delete) {
    die("thất bại:" . !$delete);
  }
  return $delete;
}
function createPost($IdTheloai, $title, $image, $content)
{
  $conn = connect();
  $insert = mysqli_query($conn, "INSERT INTO `baiviet` (`ID_theloaitin2`,`title`, `img`, `content`) VALUES ('$IdTheloai','$title', '$image', '$content')");
  if (!$insert) {
    die("thất bại:" . $insert);
  };
  $newPostId = mysqli_insert_id($conn);
  return $newPostId;
};
function editPost($id, $title, $image, $content)
{
  $conn = connect();
  $update = mysqli_query($conn, "UPDATE `baiviet` SET `title` = '$title', `img` = '$image', `content` = '$content' WHERE `ID_baiviet` = $id");
  if (!$update) {
    die("thất bại:" . $update);
  };
  return $update;
};
function createContent($content,$img, $title, $postId){
  $conn = connect();
  $insert = mysqli_query($conn, "INSERT INTO `noidungbaiviet`( `content`, `img`, `title`, `ID_baiviet`) VALUES ('$content','$img','$title','$postId')");
  if (!$insert) {
    die("thất bại:" . $insert);
  };
  $newPostId = mysqli_insert_id($conn);
  return $newPostId;
}
function updateContent($id,$content,$img, $title){
  $conn = connect();
  $insert = mysqli_query($conn, "UPDATE `noidungbaiviet` SET `content`='$content',`img`='$img',`title`='$title' WHERE `ID_noidungbaiviet`='$id' ");
  if (!$insert) {
    die("thất bại:" . $insert);
  };
  // $newPostId = mysqli_insert_id($conn);
   return  $insert;
}
