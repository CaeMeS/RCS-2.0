<?php 
$link = mysqli_connect("127.0.0.1", "root") or die ("connection error: " . mysqli_connect_error ());
$db_selected = mysqli_select_db($link, 'rcs');
  if (!$db_selected) {
    die ("Can\'t use this database : " . mysqli_error($link));
  }
mysqli_query($link, "SET NAMES utf8");
?>


