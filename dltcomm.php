<?php
    include("DBconn.php");
    include("verify.php");
    $id = mysqli_real_escape_string($link , $_GET['id']);
    $txt = mysqli_real_escape_string($link , $_GET['txt']);
    $u = mysqli_query($link, "select id_user from user where mail = '$login_session'");
    $ru = mysqli_fetch_row($u);
    $v = mysqli_query($link, "select id_user from comment where id_com = '$id'");
    $rv = mysqli_fetch_row($v);
    if(!isset($_SESSION['user_mail']) || $ru['0'] != $rv['0'])
    {
        header("Location: index.php");
    }
    else
    {
        $sql = "DELETE FROM comment WHERE id_com = '$id'";
        if (mysqli_query($link, $sql)) 
        { 
            header("Location: text.php?id=$txt");
        }
        else 
        {
            echo "Błąd przy usuwaniu: " . mysqli_error($link);
        }
    }
?>