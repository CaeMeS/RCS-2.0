<?php
    include("DBconn.php");
    include("navbar.php");
    include("verify.php");
    $pro = 0;
    if(!isset($_SESSION['user_mail']))
    {
        header("Location: index.php");
    }
    else
       $pro = 1;
?>
<!DOCTYPE html>
<head lang="en">
    <title> Konto </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" integrity="sha384-o9KO9jVK1Q4ybtHgJCCHfgQrTRNlkT6SL3j/qMuBMlDw3MmFrgrOHCOaIMJWGgK5" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/tooltip.js"></script>

    <style>
        .affix 
        {
            top: 0;
            width: 100%;
            z-index: 9999
        }
        .affix + .container-fluid 
        {
            padding-top: 70px;
        }
        .margins
        {
            margin-top:60px;
        }
        .bgaqua
        {
            background-color: #00cccc;
            color: white;
        }
        .clear
        {
            clear:both;
        }
        .navbar-inverse .navbar-brand .glyphicon:hover
        {
            color: #00cccc;
        }
        .navbar-inverse .navbar-collapse .dodaj:hover
        {
            color: #00cccc;
        }
        .btn:hover
        {
            background-color: #00cccc;
            border-color: #00cccc;
        }
    </style>
    
</head>
<body>
    <?php 
        GetNavbar(0, $pro + $spc);
    ?>
    <div style="text-align: center">
        <h2> <b> Zarządzanie kontem <i><?php echo $login_session; ?></i> </b></h2>
    </div>
    <div class="col-sm-8 col-sm-offset-2" style=" margin-top:30px;">
        <h2 class="col-sm-offset-1"> Moje ogłoszenia </h2> <br>
        <?php
            $q = mysqli_query($link, "SELECT c.id_car, o.id_option, o.foto, m.name as marka, mm.name as model, o.price, o.prod_date, o.watched, o.views FROM options o, car_make m, car_model mm, car c, user u WHERE c.id_option = o.id_option and u.id_user = c.id_user and m.id_m = c.id_m and mm.id_mm = c.id_mm and u.mail = '$login_session' order by c.date_add desc");
            if($q->num_rows === 0)
            {
                echo 'Brak wystawionych ogłoszeń';
            }
            else
            {
                ?>
                <table class="table table-hover">
                    <tbody>
                        <thead>
                        <tr>
                            <th>Marka</th>
                            <th>Model</th>
                            <th>Rok</th>
                            <th>Cena</th>
                            <th>Wyś.</th>
                            <th>Obs.</th>
                            <th>Opcje</th>
                        </tr>
                        </thead>
                    <?php
                $m = 0;
            while($row = mysqli_fetch_array($q, MYSQLI_ASSOC))
            {   
                $marka = $row['marka'];
                $model = $row['model'];
                $idc = $row['id_car'];
                $kon = mysqli_query($link, "SELECT count(r.id_kon), r.n_buyer FROM rozmowa r, car c WHERE c.id_car = r.id_car and r.id_car = '$idc'");
                $rkon = mysqli_fetch_row($kon);
                ?>
                    <tr id="clicktr" data-toggle="tool" data-placement="left" title="<img src='res/<?php echo $row['foto']; ?>' width='160' height='90'/>" >
                        <td onclick="window.location='auto.php?id=<?php echo $idc; ?>';"> <?php echo $row['marka']; ?> </td>
                        <td onclick="window.location='auto.php?id=<?php echo $idc; ?>';"> <?php echo $row['model']; ?> </td>
                        <td onclick="window.location='auto.php?id=<?php echo $idc; ?>';"> <?php echo $row['prod_date']; ?> </td>
                        <td style="white-space: nowrap;" onclick="window.location='auto.php?id=<?php echo $idc; ?>';"> <?php echo $row['price']; echo " PLN"; ?> </td>
                        <td onclick="window.location='auto.php?id=<?php echo $idc; ?>';"> <?php echo $row['views']; ?> </td>
                        <td onclick="window.location='auto.php?id=<?php echo $idc; ?>';"> <?php echo $row['watched']; ?> </td>
                        <td> 
                            <?php
                            if($rkon[0] != 0)
                            {
                                ?>
                                <button type="button" class="btn btn-primary" data-toggle='modal' data-target="#show_kon<?php echo $m; ?>"> <span class='glyphicon glyphicon-envelope <?php if($rkon[1] == 1) echo "flashy"; ?>'></span>  </button>
                                <div id="show_kon<?php echo $m; ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                            <?php
                                            $u = mysqli_query($link, "SELECT id_user FROM user WHERE mail = '$login_session'");
                                            $ru = mysqli_fetch_row($u);
                                            $idusr = $ru[0];
                                            $w = mysqli_query($link, "SELECT r.id_kon, u.name, r.n_buyer FROM user u, rozmowa r WHERE r.id_user = u.id_user and r.id_car = '$idc'");
                                            ?>
                                            <table class="table table-hover">
                                                <tbody>
                                                <thead>
                                                    <tr>
                                                        <th>Od</th>
                                                        <th>Ostatnia wiadomość</th>
                                                        <th>Ilość wiadomości</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                while($rw = mysqli_fetch_array($w, MYSQLI_ASSOC))
                                                {   
                                                    $kon = $rw['id_kon'];
                                                    $wt = mysqli_query($link, "SELECT count(w.id_wia) as ile, max(w.data) as dd FROM wiadomosc w, rozmowa r WHERE r.id_kon = w.id_kon and r.id_kon = '$kon'");
                                                    $rwt = mysqli_fetch_row($wt);
                                                    $name = $rw['name'];
                                                    $ile = $rwt['0'];
                                                    $dd = $rwt['1'];
                                                    $new = $rw['n_buyer'];
                                                    ?>
                                                    <tr onclick="window.location='rozmowa.php?id=<?php echo $kon; ?>';">
                                                        <td> <?php echo $name; ?> </td>
                                                        <td> <?php echo $dd; ?> </td>
                                                        <td> <?php echo $ile; ?> </td>
                                                        <td style="color: red"> <span class="flashy"> <?php if($new == 1) echo "NOWE!!!"; ?> </span>  </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                </tbody>
                                            </table>    
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            else
                            {
                                ?>
                                <button type="button" class="btn btn-primary" disabled > <span class="glyphicon glyphicon-envelope"></span> </button>
                                <?php
                            }
                            ?>
                            <a href = "edytuj.php?id=<?php echo $row['id_option']; ?>" role="button" class="btn btn-warning" data-toggle='tooltip' title='Edytuj'> <span class='glyphicon glyphicon-cog'></span> </a>
                            <a href = "usun.php?id=<?php echo $row['id_option']; ?>" role="button" class="btn btn-danger" data-toggle='tooltip' title='Usuń'> <span class='glyphicon glyphicon-trash'></span> </a>
                        </td>
                    <?php
            $m++;
            }
            ?>
        </tbody>
        </table>
                <?php
            }
        ?>
    </div>
    <?php
    if(@spc == 1)
    {
    ?>
    <div class="col-sm-8 col-sm-offset-2" style=" margin-top:30px;">
        <h2 class="col-sm-offset-1"> Moje artykuły </h2> <br>
        <?php
            $a = mysqli_query($link, "SELECT id_text, topic, views FROM article WHERE id_user = '$id_user' order by data desc");
            if($a->num_rows === 0)
            {
                echo 'Brak artykułów';
            }
            else
            {
                ?>
                <table class="table table-hover" style="table-layout: fixed; width: 100%">
                    <tbody>
                        <thead>
                        <tr>
                            <th>Tytuł</th>
                            <th>Wyświetlenia</th>
                            <th>Komentarze</th>
                            <th>Opcje</th>
                        </tr>
                        </thead>
                    <?php
            while($ra = mysqli_fetch_array($a, MYSQLI_ASSOC))
            {
                $ida = $ra['id_text'];
                $at = mysqli_query($link, "SELECT count(c.id_com) FROM article a, comment c WHERE a.id_text = c.id_article and id_article = '$ida'");
                $rat = mysqli_fetch_row($at)
                ?>
                    <tr data-toggle='tooltip' title='<?php echo $ra['topic']; ?>'>
                        <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;" onclick="window.location='text.php?id=<?php echo $ida; ?>';"> <?php echo $ra['topic']; ?> </td>
                        <td onclick="window.location='text.php?id=<?php echo $ida; ?>';"> <?php echo $ra['views']; ?> </td>
                        <td onclick="window.location='text.php?id=<?php echo $ida; ?>';"> <?php echo $rat['0']; ?> </td>
                        <td> 
                            <a href = "edytuj_art.php?id=<?php echo $ida; ?>" role="button" class="btn btn-warning" data-toggle='tooltip' title='Edytuj'> <span class='glyphicon glyphicon-cog'></span> </a>
                            <a href = "usun_art.php?id=<?php echo $ida; ?>" role="button" class="btn btn-danger" data-toggle='tooltip' title='Usuń'> <span class='glyphicon glyphicon-trash'></span> </a>
                        </td>
                    <?php
            }
            ?>
        </tbody>
        </table>
                <?php
            }
        ?>
    </div>
    <?php
    }
    ?>
    <div class="col-sm-8 col-sm-offset-2" style=" margin-top:30px;">
        <h2 class="col-sm-offset-1"> Obserwowane </h2> <br>
        <?php
            $what_id = 0;
            $wlist = mysqli_query($link, "SELECT c.id_car, o.id_option, o.foto, m.name as marka, mm.name as model, o.price, o.prod_date, w.id_user, w.id_car, w.date FROM options o, car_make m, car_model mm, car c, user u, watchlist w WHERE c.id_option = o.id_option and m.id_m = c.id_m and mm.id_mm = c.id_mm and u.id_user = w.id_user and c.id_car = w.id_car and u.mail = '$login_session' order by w.date desc");
            if($wlist->num_rows === 0)
            {
                echo 'Brak obserwowanych ogłoszeń';
            }
            else
            {
                ?>
                <table class="table table-hover">
                    <tbody>
                        <thead>
                        <tr>
                            <th>Marka</th>
                            <th>Model</th>
                            <th>Rok</th>
                            <th>Cena</th>
                            <th>Opcje</th>
                        </tr>
                        </thead>
                    <?php
                $modal = 0;
            while($wrow = mysqli_fetch_array($wlist, MYSQLI_ASSOC))
            {   
                $marka = $wrow['marka'];
                $model = $wrow['model'];
                $idcar = $wrow['id_car'];
                $idsur = $wrow['id_user'];
                $m = mysqli_query($link, "SELECT r.id_kon, r.n_owner FROM rozmowa r, car c, user u WHERE r.id_car = c.id_car and r.id_user = u.id_user and r.id_car = '$idcar' and u.mail = '$login_session'");
                $rm = mysqli_fetch_row($m);
                $idkon = $rm['0'];
                ?>
                    
                    <tr data-toggle="tool" data-placement="left" title="<img src='res/<?php echo $wrow['foto']; ?>' width='160' height='90'/>">
                        <td onclick="window.location='auto.php?id=<?php echo $wrow['id_car']; ?>';"> <?php echo $wrow['marka']; ?> </td>
                        <td onclick="window.location='auto.php?id=<?php echo $wrow['id_car']; ?>';"> <?php echo $wrow['model']; ?> </td>
                        <td onclick="window.location='auto.php?id=<?php echo $wrow['id_car']; ?>';"> <?php echo $wrow['prod_date']; ?> </td>
                        <td onclick="window.location='auto.php?id=<?php echo $wrow['id_car']; ?>';"> <?php echo $wrow['price']; echo " PLN"; ?> </td>
                        <td> 
                            <?php
                            if($rm[0] != NULL)
                            {
                            ?>
                                <a href = "rozmowa.php?id=<?php echo $idkon; ?>" role="button" class="btn btn-primary" data-toggle='tooltip' title='Wiadomości'> <span class='glyphicon glyphicon-envelope <?php if($rm[1] == 1) echo "flashy"; ?>'></span> </a>
                            <?php
                            }
                            else
                            {
                            ?>
                                <button type="button" class="btn btn-warning" data-toggle='modal' data-target="#new_txt<?php echo $modal; ?>"> <span class='glyphicon glyphicon-envelope'></span> </button>
                                <div id="new_txt<?php echo $modal; ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h3> Nowa wiadomość </h3>
                                                <textarea class="form-control" style="resize: none; overflow: hidden;" name="nowe" id="nowe<?php echo $modal; ?>" cols="100" onkeyup="auto_grow(this)" maxlength="232" required></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <a href = "#" id="slink<?php echo $modal; ?>" onclick="sendlink(<?php echo $wrow['id_car']; echo ", "; echo $modal; ?>);" role="button" class="btn btn-danger">Wyślij</a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <a href = "rwatch.php?id=<?php echo $wrow['id_car']; ?>" role="button" class="btn btn-danger" data-toggle='tooltip' title='Przestań obserwować'> <span class='glyphicon glyphicon-remove'></span> </a>
                        </td>
                    </tr>
                    
                    <?php
                $modal++;
            }
            ?>
        </tbody>
        </table>
                <?php
            }
        ?>
    </div>
</body>
<script type="text/javascript">  
            $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
            });
        
            $('[data-toggle="tool"]').tooltip({
            animated: 'fade',
            html: true
            });

(function blink() { 
  $('.flashy').fadeOut(500).fadeIn(500, blink); 
})();

function sendlink(a, b)
{
    var txt = document.getElementById("nowe"+b).value;  
    var hrf="newtxt.php?ic="+a+"&idu=<?php echo $idsur; ?>&txt="+txt;
    document.getElementById("slink"+b).href=hrf;
}
</script>