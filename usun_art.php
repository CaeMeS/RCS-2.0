<?php
    include("DBconn.php");
    include("verify.php");
    $id = mysqli_real_escape_string($link , $_GET['id']);
    $q = mysqli_query($link, "SELECT id_user, id_cat, foto FROM article WHERE id_text = '$id'");
    $row = mysqli_fetch_row($q);
    if(!isset($_SESSION['user_mail']) || $id_user != $row['0'])
    {
        header("Location: index.php");
    }
    else
    {
        if($row['id_cat'] == 2 || $row['id_cat'] == 3 || $row['id_cat'] == 4)
        {
            $q1 = mysqli_query($link, "SELECT id_auto1 FROM article WHERE id_text = '$id'");
            $row1 = mysqli_fetch_row($q1);
            $dl1 = $row1['id_auto1'];
            mysqli_query($link, "delete from auto_art where id_opt = '$dl1'");
        }
        if($row['id_cat'] == 3)
        {
            $q2 = mysqli_query($link, "SELECT id_auto2 FROM article WHERE id_text = '$id'");
            $row2 = mysqli_fetch_row($q2);
            $dl2 = $row1['id_auto2'];
            mysqli_query($link, "delete from auto_art where id_opt = '$dl2'");
        }
        $q3 = mysqli_query($link, "SELECT name FROM fotki WHERE c.id_art = '$id'");
        $sql1 = "DELETE FROM article WHERE id_text = '$id'";
        if (mysqli_query($link, $sql1))
        { 
            unlink("res/".$row['foto']);
            while($r3 = mysqli_fetch_array($q3, MYSQLI_ASSOC))
            {
                unlink("res/".$r3['name']);
            }
            header("location: konto.php");
        }
        else 
        {
            echo "Błąd przy usuwaniu: " . mysqli_error($link);
        }
    }
?>