<?php
include('DBconn.php');
include('verify.php');
if(!isset($_SESSION['user_mail']))
{
    header("Location: zaloguj.php");
}
$id = mysqli_real_escape_string($link , $_GET['id']);
$q = mysqli_query($link, "select id_user from user where mail = '$login_session'");
$row = mysqli_fetch_row($q);
$q2 = mysqli_query($link, "select id_option from car where id_car = '$id'");
$row2 = mysqli_fetch_row($q2);
$wt=mysqli_query($link, "insert into watchlist (id_user, id_car) values ('$row[0]', '$id')");
$wu=mysqli_query($link, "update options set watched = watched + 1 where id_option = '$row2[0]'");
header("Location: auto.php?id=$id");