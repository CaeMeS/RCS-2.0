<?php
    include('DBconn.php');
    session_start();
    $user_check = $_SESSION['user_mail'];
    $ses_sql = mysqli_query($link,"select mail, special, id_user from USER where mail = '$user_check' ");
    $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
    $login_session = $row['mail'];
    $spc = $row['special'];
    $id_user = $row['id_user'];
?>