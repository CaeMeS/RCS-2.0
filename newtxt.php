<?php
    include("DBconn.php");
    include("verify.php");
    $idcar = mysqli_real_escape_string($link , $_GET['ic']);
    $idu = mysqli_real_escape_string($link , $_GET['idu']);
    $txt = mysqli_real_escape_string($link , $_GET['txt']);
    $f = mysqli_real_escape_string($link , $_GET['f']);
    if(!isset($_SESSION['user_mail']) || $idu != $id_user)
    {
        header("Location: index.php");
    }
    $ir = mysqli_query($link, "insert into rozmowa (id_car, id_user, n_buyer) values ('$idcar', '$idu', 1);");
    $getir = mysqli_insert_id($link);
    $iw = mysqli_query($link, "insert into wiadomosc (tresc, kto, id_kon) values ('$txt', 1, '$getir');");
    if($f == 'y')
    {
        header("location: watchlist.php?id=$idcar");
    }
    else
    {
        header("location: rozmowa.php?id=$getir");
    }
?>