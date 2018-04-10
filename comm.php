<?php
    include("DBconn.php");
    if(isset($_POST['user_comm']))
    {
        $comm = mysqli_real_escape_string($link , $_POST['user_comm']);
        $idu = mysqli_real_escape_string($link , $_POST['user_id']);
        $id = mysqli_real_escape_string($link , $_POST['id_art']);
        $insert = mysqli_query($link, "insert into comment (id_user, comment, id_article) values('$idu','$comm','$id')");
        $insert_id = mysqli_insert_id($link);
        
        $select = mysqli_query($link, "select u.name, c.comment, c.date from comment c, user u, article a where c.id_user = u.id_user and a.id_text = c.id_article and c.id_com = '$insert_id'");
        $rsel = mysqli_fetch_row($select);
        ?>
        <div class="col-sm-8 clo-sm-offset-1">
            <br> <br>
            <p> <i> <?php echo $rsel['0']; echo " • "; echo $rsel['2']; echo " • "; echo '<a href="dltcomm.php?id=' . $insert_id . '&txt=' . $id . '">Usuń</a>'; ?> </i> </p>
            <h4> <?php echo $rsel['1']; ?> </h4>
            <hr>
        </div>
    <?php
    }
exit;
?>
