<?php
    include("DBconn.php");
    include("verify.php");
    $id = mysqli_real_escape_string($link , $_GET['id']);
    $q = mysqli_query($link, "SELECT u.mail, o.foto, c.id_car FROM user u, car c, options o WHERE u.id_user = c.id_user and c.id_option = o.id_option and c.id_option = '$id'");
    $row = mysqli_fetch_row($q);
    $idc = $row['id_car'];
    $q2 = mysqli_query($link, "SELECT f.name FROM fotki f, car c WHERE c.id_car = f.id_car and c.id_car = '$idc'");
    if(!isset($_SESSION['user_mail']) || $login_session != $row['0'])
    {
        header("Location: index.php");
    }
    else
    {
        $sql1 = "DELETE FROM car WHERE id_option = '$id'";
        $sql2 = "DELETE FROM options WHERE id_option = '$id'";
        if (mysqli_query($link, $sql1) && mysqli_query($link, $sql2))
        { 
            unlink("res/".$row['foto']);
            while($r2 = mysqli_fetch_array($q2, MYSQLI_ASSOC))
            {
                unlink("res/".$r2['name']);
            }
            header("location: konto.php");
        }
        else 
        {
            echo "Błąd przy usuwaniu: " . mysqli_error($link);
        }
    }
?>