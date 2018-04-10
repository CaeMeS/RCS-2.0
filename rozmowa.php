<?php
    include("DBconn.php");
    include("navbar.php");
    include("verify.php");
    $id = mysqli_real_escape_string($link , $_GET['id']);
    $pro = 0;
    $od = mysqli_query($link, "SELECT u.mail FROM user u, rozmowa r WHERE u.id_user = r.id_user and r.id_kon = '$id'");
    $rod = mysqli_fetch_row($od);
    $do = mysqli_query($link, "SELECT u.mail, u.name FROM user u, car c, rozmowa r WHERE u.id_user = c.id_user and r.id_car = c.id_car and r.id_kon = '$id'");
    $rdo = mysqli_fetch_row($do);
    if(!isset($_SESSION['user_mail']))
    {
        header("Location: index.php");
    }
    else if($login_session != $rod['0'] && $login_session != $rdo['0'])
        header("Location: index.php");
    else
       $pro = 1;
    if($login_session == $rdo['0'])
    {
        $owner = 0;
        $nn=mysqli_query($link, "UPDATE rozmowa SET n_buyer = 0 WHERE id_kon = '$id'");
    }
    else 
    {
        $owner = 1;
        $n=mysqli_query($link, "UPDATE rozmowa SET n_owner = 0 WHERE id_kon = '$id'");
    }
    if($_SERVER["REQUEST_METHOD"] == "POST")
    { 
        $kom = mysqli_real_escape_string($link, $_POST['nowe']);
        $qi=mysqli_query($link, "insert into wiadomosc (tresc, kto, id_kon) values ('$kom', '$owner', '$id');");
        if(strlen (mysqli_error($link)) > 0) 
            echo mysqli_error($link);
        else 
        {
            if($owner == 0)
                $nn1=mysqli_query($link, "UPDATE rozmowa SET n_owner = 1 WHERE id_kon = '$id'");
            if($owner == 1)
                $n1=mysqli_query($link, "UPDATE rozmowa SET n_buyer = 1 WHERE id_kon = '$id'");
            header("location: rozmowa.php?id=$id");
        }       
    }	
?>
<!DOCTYPE html>
<head lang="en">
    <title> Wiadomości </title>
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
    </style>
    
</head>
<body>
    <?php 
        GetNavbar(0, $pro + $spc);
        $k = mysqli_query($link, "SELECT u.name, w.data, w.tresc, w.kto FROM wiadomosc w, rozmowa r, user u WHERE w.id_kon = r.id_kon and r.id_user = u.id_user and r.id_kon = '$id' order by w.data desc");
        $a = mysqli_query($link, "SELECT m.name, mm.name, o.foto FROM rozmowa r, car c, car_make m, car_model mm, options o WHERE r.id_car = c.id_car and c.id_m = m.id_m and c.id_mm = mm.id_mm and c.id_option = o.id_option and r.id_kon = '$id'");
        $ra = mysqli_fetch_row($a);
        $marka = $ra['0'];
        $model = $ra['1'];
    
    ?>
    <div style="text-align: center">
        <h2 data-toggle="tool" data-placement="bottom" title="<img src='res/<?php echo $ra['2']; ?>' width='160' height='90'/>"> <b> Rozmowa o <i> <?php echo "$marka $model"; ?> </i> </b></h2>
    </div>
    <form enctype="multipart/form-data" action="" method="post">
    <div class="col-sm-6 col-sm-offset-3" style=" margin-top:50px;">
        <label class="col-sm-12" for="nowe" style="white-space: nowrap;">Nowa wiadomość</label>
        <textarea class="form-control" style="resize: none; overflow: hidden;" name="nowe" id="nowe" cols="100" onkeyup="auto_grow(this)" maxlength="232" required></textarea> <br>
        <button type="submit" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-check"></span>  Dodaj</button> <br> <br>
    <?php
        while($rk = mysqli_fetch_array($k, MYSQLI_ASSOC))
        {
            if($owner == 0)
            {
                if($rk['kto'] == 0)
                {
                ?>    
                    <div class="col-sm-4 col-sm-offset-8">
                        <h4 style="text-align: right;"> <b> Moje  </b> <?php echo " "; echo $rk['data']; ?> </h4>
                        <h2 style="text-align: right; word-wrap: break-word;"> <?php echo $rk['tresc']; ?> </h2> <hr> <br>
                    </div>
                <?php
                }
                else
                {
                ?>
                    <div class="col-sm-7">
                        <h4> <b> <?php echo $rk['name']; ?>  </b> <?php echo " "; echo $rk['data']; ?> </h4>
                        <h2 style="word-wrap: break-word;"> <?php echo $rk['tresc']; ?> </h2> <hr> <br>
                    </div>
                <?php
                }
            }
            else
            {
                if($rk['kto'] == 0)
                {
                ?>    
                    <div class="col-sm-4 col-sm-offset-8">
                        <h4 style="text-align: right;"> <b> <?php echo $rdo['1']; ?> </b> <?php echo " "; echo $rk['data']; ?> </h4>
                        <h2 style="text-align: right; word-wrap: break-word;"> <?php echo $rk['tresc']; ?> </h2> <hr> <br>
                    </div>
                <?php
                }
                else
                {
                ?>
                    <div class="col-sm-7">
                        <h4> <b> Moje </b> <?php echo " "; echo $rk['data']; ?> </h4>
                        <h2 style="word-wrap: break-word;"> <?php echo $rk['tresc']; ?> </h2> <hr> <br>
                    </div>
                <?php
                }
            }
        }
        ?>
    </div>
    </form>
</body>
<script type="text/javascript">  
            $('[data-toggle="tool"]').tooltip({
            animated: 'fade',
            html: true
            });
</script>