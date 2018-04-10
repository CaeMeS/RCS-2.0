<?php
    include("DBconn.php");
    include("navbar.php");
    include("verify.php");
    $pro;
    if(!isset($_SESSION['user_mail']))
    {
        $pro = 0;
    }
    else
       $pro = 1;

    $id = mysqli_real_escape_string($link , $_GET['id']);
    $sql=mysqli_query($link, "update article set views = views + 1 where id_text = '$id'");
    $u = mysqli_query($link, "select id_user from user where mail = '$login_session'");
    $ru = mysqli_fetch_row($u);
    $idu = $ru['0'];
    $q = mysqli_query($link, "select c.name from category c, article a where a.id_cat = c.id_cat and id_text = '$id'");
    $r = mysqli_fetch_row($q);
    $q1 = mysqli_query($link, "SELECT date(a.data), a.topic, a.intro, a.article, u.name, a.foto FROM article a, user u WHERE a.id_user = u.id_user and a.id_text = $id");
    $r1 = mysqli_fetch_row($q1);
    if($r['0'] == 'Test' || $r['0'] == 'CarBattle')
    {
        $q2 = mysqli_query($link, "SELECT aa.silnik, aa.poj, aa.moc, aa.acc, aa.vmax, aa.spalanie, aa.gears, aa.naped, aa.cena, aa.rok, m.name, mm.name FROM article a, auto_art aa, car_make m, car_model mm WHERE a.id_auto1 = aa.id_opt and aa.id_m = m.id_m and aa.id_mm = mm.id_mm and a.id_text = $id");
        $r2 = mysqli_fetch_row($q2);
        $marka = $r2['10'];
        $model = $r2['11'];
        $rok = $r2['9'];
        $a2 = mysqli_query($link, "SELECT c.id_car, o.price, o.prod_date, o.foto, m.name as marka, mm.name as model FROM car c, car_make m, car_model mm, options o WHERE m.id_m = c.id_m and mm.id_mm = c.id_mm and c.id_option = o.id_option and m.name = '$marka' and mm.name = '$model' and o.prod_date >= ($rok - 2) and o.prod_date <= ($rok + 2) order by c.date_add");
    }
    if($r['0'] == 'CarBattle')
    {
        $q3 = mysqli_query($link, "SELECT aa.silnik, aa.poj, aa.moc, aa.acc, aa.vmax, aa.spalanie, aa.gears, aa.naped, aa.cena, aa.rok, m.name, mm.name FROM article a, auto_art aa, car_make m, car_model mm WHERE a.id_auto2 = aa.id_opt and aa.id_m = m.id_m and aa.id_mm = mm.id_mm and a.id_text = $id");
        $r3 = mysqli_fetch_row($q3);
        $marka = $r3['10'];
        $model = $r3['11'];
        $rok = $r3['9'];
        $a3 = mysqli_query($link, "SELECT c.id_car, o.price, o.prod_date, o.foto, m.name as marka, mm.name as model FROM car c, car_make m, car_model mm, options o WHERE m.id_m = c.id_m and mm.id_mm = c.id_mm and c.id_option = o.id_option and m.name = '$marka' and mm.name = '$model' and o.prod_date >= ($rok - 2) and o.prod_date <= ($rok + 2) order by c.date_add");
    }
    if($r['0'] == 'Porada')
    {
        $q4 = mysqli_query($link, "SELECT aa.rok, aa.rokdo, m.name as marka, mm.name as model FROM article a, auto_art aa, car_make m, car_model mm WHERE a.id_auto1 = aa.id_opt and aa.id_m = m.id_m and aa.id_mm = mm.id_mm and a.id_text = $id");
        $r4 = mysqli_fetch_row($q4);
        $marka = $r4['2'];
        $model = $r4['3'];
        $rokod = $r4['0'];
        $rokdo = $r4['1'];
        $a4 = mysqli_query($link, "SELECT c.id_car, o.price, o.prod_date, o.foto, m.name as marka, mm.name as model FROM car c, car_make m, car_model mm, options o WHERE m.id_m = c.id_m and mm.id_mm = c.id_mm and c.id_option = o.id_option and m.name = '$marka' and mm.name = '$model' and o.prod_date >= $rokod and o.prod_date <= $rokdo order by c.date_add");
    }
    $select = mysqli_query($link, "select u.name, c.comment, c.date, c.id_com, c.id_user from comment c, user u, article a where c.id_user = u.id_user and a.id_text = c.id_article and c.id_article = '$id' order by c.date desc");
    $picb = mysqli_query($link, "select name from fotki where id_art = '$id'");
    $pics = mysqli_query($link, "select name from fotki where id_art = '$id'");

?>
<!DOCTYPE html>
<head lang="en">
    <title> RCS/<?php echo $r1['1'];?> </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" integrity="sha384-o9KO9jVK1Q4ybtHgJCCHfgQrTRNlkT6SL3j/qMuBMlDw3MmFrgrOHCOaIMJWGgK5" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
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
            margin-top:50px;
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
        h2 span 
        { 
            font-size:15px; 
        }
        .item img 
        {
            margin: auto;
            width: auto;
            height: 400px;
        }
        div.gallery 
        {
            margin: 5px;
            border: 1px solid #ccc;
            float: left;
            width: 180px;
        }
        div.gallery:hover 
        {
            border: 1px solid #777;
        }
        div.gallery img 
        {
            width: 100%;
            height: 10%;
        }
        div.desc 
        {
            padding: 15px;
            text-align: center;
        }
        .btn:hover
        {
            background-color: #00cccc;
            border-color: #00cccc;
        }
        a:hover
        {
            color: #00cccc;
            border-color: #00cccc;
        }
        .slider-size
        {
            height: 30%;
        }
        @media (max-width: 768px) 
        {
            .one 
            {
                text-align: center;
            }
            #bigscreen 
            {
                display: none;
            }
        }
        @media (min-width: 768px) 
        {
            .one 
            {
                text-align: right;
            }
            #smallscreen 
            {
                display: none;
            }
        }
    </style>
    <script type="text/javascript">  
        $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <?php 
        GetNavbar(0, $pro + $spc);
    ?>
    <div class="col-sm-11 margins">
        <div class="col-sm-11 col-sm-offset-1">
            <h1 style='color:#0088cc'> <b> <?php echo $r1['1']; ?> </b> </h1>
            <h4> <i> <?php echo $r['0']; echo " •"; echo " dodane: "; echo $r1['0']; echo " •"; echo " autor: "; echo $r1['4'];?> </i></h4> <hr>
        </div>
        <div class="col-sm-11 col-sm-offset-1"> 
            <h3> <b> <?php echo $r1['2']; ?> </b></h3> <br>
        </div>
    </div>
    <div id="bigscreen" class="row">
        <div class="col-sm-7 col-sm-offset-1">
            <div class="col-sm-8 col-sm-offset-1">
                <a target="_blank" href="res/<?php echo $r1['5']; ?>"> <img class="img-responsive col-sm-12" src="res/<?php echo $r1['5']; ?>" alt="Article Photo" width="1152" height="648"> </a>
            </div>
            <div class="col-sm-12"> 
                <br>
                <h3> <?php echo $r1['3']; ?> </h3>
            </div>
        </div>
        <div class="col-sm-4">
        <?php
            while($rp = mysqli_fetch_array($picb, MYSQLI_ASSOC))
            { 
            ?>
                <a target="_blank" href="res/<?php echo $rp['name']; ?>"> <img class="img-responsive" style="margin: 0 auto;" src="res/<?php echo $rp['name']; ?>" alt="Article Photo" width="300" height="200"> </a> <br>               
            <?php
            }
            ?>
        </div> <br> <br>
    </div> 
    <div id="smallscreen" class="col-sm-8 col-sm-offset-1">
            <div class="col-sm-6 col-sm-offset-1 carousel slide" id="myCarousel" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active res">
                        <a target="_blank" href="res/<?php echo $r1['5']; ?>"> <div style="background:url(res/<?php echo $r1['5']; ?>) center center; background-size:cover;" class="slider-size"> </div> </a>
                    </div>
                    <?php
                    while($rpp = mysqli_fetch_array($pics, MYSQLI_ASSOC))
                    { 
                    ?>
                        <div class="item res">
                            <a target="_blank" href="res/<?php echo $rpp['name']; ?>"> <div style="background:url(res/<?php echo $rpp['name']; ?>) center center; background-size:cover;" class="slider-size"> </div> </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <a class="left carousel-control" href="javascript:void(0)" data-slide="prev" data-target="#myCarousel">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Poprzednie</span>
                </a>
                <a class="right carousel-control" href="javascript:void(0)" data-slide="next" data-target="#myCarousel">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Następne</span>
                </a>
            </div>
            <div class="col-sm-11"> 
                <br>
                <h3> <?php echo $r1['3']; ?> </h3>
            </div> <br> <br>
        </div>
    <?php
    if($r['0'] == 'Test')
    {
    ?>
    <div class="container col-sm-6 col-sm-offset-2" style="background-color: #f2f2f2; margin-top:30px; ">
        <div>
            <h2 class="col-sm-offset-1"> Dane techniczne </h2>
            <table class="table table-hover">
                <tbody>
                    <thead>
                        <tr>
                            <th>Silnik</th>
                            <th>Poj. silnika</th>
                            <th>Moc silnika</th>
                        </tr>
                    </thead>
                        <tr>
                            <td> <?php echo $r2['0']; ?> </td>
                            <td> <?php echo $r2['1']; echo " cm³"; ?> </td>
                            <td> <?php echo $r2['2']; echo " KM"; ?> </td>
                        </tr>
                    <thead>
                        <tr>
                            <th>Przyspieszenie 0/100</th>
                            <th>Prędkość max.</th>
                            <th>Spalanie</th>
                        </tr>
                    </thead>
                        <tr>
                            <td> <?php echo $r2['3']; echo " s"; ?> </td>
                            <td> <?php echo $r2['4']; echo " km/h"; ?> </td>
                            <td> <?php echo $r2['5']; echo " l/100"; ?> </td>
                        </tr>
                    <thead>
                        <tr>
                            <th>Skrzynia biegów</th>
                            <th>Napęd</th>
                            <th>Cena</th>
                        </tr>
                    </thead>
                        <tr>
                            <td> <?php echo $r2['6']; ?> </td>
                            <td> <?php echo $r2['7']; ?> </td>
                            <td> <?php echo $r2['8']; echo " zł"; ?> </td>
                        </tr>
                </tbody>
            </table>
            <hr>
        </div>
    </div>
    <?php
    }
    ?>
    <?php
    if($r['0'] == 'CarBattle')
    {
    ?>
    <div class="container col-sm-6 col-sm-offset-2" style="background-color: #f2f2f2; margin-top:30px; ">
        <div>
            <h2 class="col-sm-offset-1"> Porównanie </h2>
            <table class="table table-hover">
                <tbody>
                    <thead>
                        <tr>
                            <th> </th>
                            <th> <?php echo $r2['10']; echo " "; echo $r2['11']; ?> </th>
                            <th> <?php echo $r3['10']; echo " "; echo $r3['11']; ?> </th>
                        </tr>
                    </thead>
                        <tr>
                            <td> <b> Silnik </b> </td>
                            <td> <?php echo $r2['0']; ?> </td>
                            <td> <?php echo $r3['0']; ?> </td>
                        </tr>
                        <tr>
                            <td> <b> Poj. silnika </b> </td>
                            <td> <?php echo $r2['1']; echo " cm³"; ?> </td>
                            <td> <?php echo $r3['1']; echo " cm³"; ?> </td>
                        </tr>
                        <tr>
                            <td> <b> Moc silnika </b> </td>
                            <td> <?php echo $r2['2']; echo " KM"; ?> </td>
                            <td> <?php echo $r3['2']; echo " KM"; ?> </td>
                        </tr>
                        <tr>
                            <td> <b> Przyspieszenie </b> </td>
                            <td> <?php echo $r2['3']; echo " s"; ?> </td>
                            <td> <?php echo $r3['3']; echo " s"; ?> </td>
                        </tr>
                        <tr>
                            <td> <b> Prędkość max. </b> </td>
                            <td> <?php echo $r2['4']; echo " km/h"; ?> </td>
                            <td> <?php echo $r3['4']; echo " km/h"; ?> </td>
                        </tr>
                        <tr>
                            <td> <b> Spalanie </b> </td>
                            <td> <?php echo $r2['5']; echo " l/100"; ?> </td>
                            <td> <?php echo $r3['5']; echo " l/100"; ?> </td>
                        </tr>
                        <tr>
                            <td> <b> Skrzynia biegów </b> </td>
                            <td> <?php echo $r2['6']; ?> </td>
                            <td> <?php echo $r3['6']; ?> </td>
                        </tr>
                        <tr>
                            <td> <b> Napęd </b> </td>
                            <td> <?php echo $r2['7']; ?> </td>
                            <td> <?php echo $r3['7']; ?> </td>
                        </tr>
                        <tr>
                            <td> <b> Cena </b> </td>
                            <td> <?php echo $r2['8']; echo " zł"; ?> </td>
                            <td> <?php echo $r3['8']; echo " zł"; ?> </td>
                        </tr>
                </tbody>
            </table>
            <hr>
        </div>
    </div>
    <?php
    }
    if($r['0'] == 'Test' || $r['0'] == 'CarBattle')
    {
        $i = 0;
        if($a2->num_rows === 0){}
        else
        {
        ?>
            <div class="col-sm-8 col-sm-offset-1 col-sx-12">
                <br>
                <h2 class="col-sm-offset-1"> Powiązane ogłoszenia <?php if($r['0'] == 'CarBattle'){ echo " dla "; echo $r2['10']; echo " "; echo $r2['11']; } ?> </h2> <br>
                <?php
                while(($ra2 = mysqli_fetch_array($a2, MYSQLI_ASSOC)) && $i < 5)
                {
                ?>  
                    <div class="gallery">
                        <a target="_blank" href="auto.php?id=<?php echo $ra2['id_car']; ?>"> <img src="res/<?php echo $ra2['foto']; ?>" alt="Car Photo"> </a>
                        <div class="desc" style="white-space: nowrap;">
                            <?php echo $ra2['marka']; echo " "; echo $ra2['model']; echo " • "; echo $ra2['prod_date']; echo "<br>"; echo $ra2['price']; echo "zł";?>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
                if($a2->num_rows > 5)
                {
                ?>
                    <div class="gallery">
                        <a target="_blank" href="auta.php?marka=<?php echo $r2['10']; ?>&model=<?php echo $r2['11']; ?>&rok_od=<?php echo $r2['9'] - 2; ?>&rok_do=<?php echo $r2['9'] + 2; ?>&cena_od=0&cena_do=0&stan=0"> <img src="res/pluss.png" alt="Show More"> </a>
                        <div class="desc" style="white-space: nowrap;">
                            Pokaż <br> wszystkie
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php
        }
    }
    if($r['0'] == 'Porada')
    {
        $i = 0;
        if($a4->num_rows === 0){}
        else
        {
        ?>
            <div class="col-sm-8 col-sm-offset-1">
                <br>
                <h2 class="col-sm-offset-1"> Powiązane ogłoszenia </h2> <br>
                <?php
                while(($ra4 = mysqli_fetch_array($a4, MYSQLI_ASSOC)) && $i < 5)
                {
                ?>  
                    <div class="gallery">
                        <a target="_blank" href="auto.php?id=<?php echo $ra4['id_car']; ?>"> <img src="res/<?php echo $ra4['foto']; ?>" alt="Car Photo"> </a>
                        <div class="desc" style="white-space: nowrap;">
                            <?php echo $ra4['marka']; echo " "; echo $ra4['model']; echo " • "; echo $ra4['prod_date']; echo "<br>"; echo $ra4['price']; echo "zł";?>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
                if($a4->num_rows > 5)
                {
                ?>
                    <div class="gallery">
                        <a target="_blank" href="auta.php?marka=<?php echo $r4['2']; ?>&model=<?php echo $r4['3']; ?>&rok_od=<?php echo $r4['0']; ?>&rok_do=<?php echo $r4['1']; ?>&cena_od=0&cena_do=0&stan=0"> <img src="res/pluss.png" alt="Show More"> </a>
                        <div class="desc" style="white-space: nowrap;">
                            Pokaż <br> wszystkie                    
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php
        }
    }
    if($r['0'] == 'CarBattle')
    {
        $i = 0;
        if($a3->num_rows === 0){}
        else
        {
        ?>
            <div class="col-sm-8 col-sm-offset-1 col-xs-12">
                <br>
                <h2 class="col-sm-offset-1"> Powiązane ogłoszenia dla <?php echo $r3['10']; echo " "; echo $r3['11']; ?> </h2> <br>
                <?php
                while(($ra3 = mysqli_fetch_array($a3, MYSQLI_ASSOC)) && $i < 5)
                {
                ?>  
                    <div class="gallery">
                        <a target="_blank" href="auto.php?id=<?php echo $ra3['id_car']; ?>"> <img src="res/<?php echo $ra3['foto']; ?>" alt="Car Photo"> </a>
                        <div class="desc" style="white-space: nowrap;">
                            <?php echo $ra3['marka']; echo " "; echo $ra3['model']; echo " • "; echo $ra3['prod_date']; echo "<br>"; echo $ra3['price']; echo "zł";?>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
                if($a3->num_rows > 5)
                {
                ?>
                    <div class="gallery">
                        <a target="_blank" href="auta.php?marka=<?php echo $r3['10']; ?>&model=<?php echo $r3['11']; ?>&rok_od=<?php echo $r3['9'] - 2; ?>&rok_do=<?php echo $r3['9'] + 2; ?>&cena_od=0&cena_do=0&stan=0"> <img src="res/pluss.png" alt="Show More"> </a>
                        <div class="desc" style="white-space: nowrap;">
                            Pokaż <br> wszystkie                    
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php
        }
    }
    
    if($pro == 1)
    {
    ?>
    <form enctype="multipart/form-data" action="" method="post" onsubmit="return post();">
        <div class="col-sm-8 col-sm-offset-1 col-xs-12"> 
            <div class="col-sm-8">
                <hr>
                 <br> <br>
                <label class="col-sm-12" for="comm" style="white-space: nowrap;">Napisz komentarz</label>
                <div class="row">
                <textarea class="form-control" style="resize: none; overflow: hidden;" name="comm" id="comm" maxlength="250" required></textarea> <br>
                <button type="submit" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-check"></span>  Dodaj</button>
                </div>
            </div>
        </div>
    </form>
    <?php
    }
    else if($pro == 0)
    {
    ?>
        <div class="col-sm-8 col-sm-offset-1 col-xs-12"> 
            <h2 class="col-sm-offset-1"> Komentarze </h2> <br>
        </div>
    <?php
    }
    ?>
    <div class="col-sm-8 col-sm-offset-1 col-xs-12" id="comments">
        <br> <br>
        <?php
        if($select->num_rows === 0)
        {
        ?>
            <p id="h001" class="col-sm-offset-1"> Brak komentarzy </p>
        <?php
        }
        else
        {
            while($row = mysqli_fetch_array($select, MYSQLI_ASSOC))
            { 
                $cid = $row['id_com'];
            ?>
                <div class="col-sm-8 clo-sm-offset-2">
                    <p> <i> <?php echo $row['name']; echo " • "; echo $row['date']; if($row['id_user'] == $idu) { echo " • "; echo '<a style="text-decoration: none" href="dltcomm.php?id=' . $cid . '&txt=' . $id . '">Usuń</a>'; } ?> </i> </p>
                    <h4 style="word-wrap: break-word"> <?php echo $row['comment']; ?> </h4>
                    <hr>
                </div>
            <?php
            }
        }
        ?>
    </div>
</body>
<script>
(function blink() { 
  $('.flashy').fadeOut(500).fadeIn(500, blink); 
})();
function post()
{
  var comment = document.getElementById("comm").value;
  var idu = <?php echo json_encode("$idu", JSON_HEX_TAG); ?>;
  var ida = <?php echo json_encode("$id", JSON_HEX_TAG); ?>;
  if(comment)
  {
    $.ajax
    ({
      type: 'post',
      url: 'comm.php',
      data: 
      {
         user_comm:comment,
	     user_id:idu,
         id_art:ida
      },
      success: function (response) 
      {
	    document.getElementById("comments").innerHTML=response+document.getElementById("comments").innerHTML;
        $("p:contains('Brak')").hide();
        document.getElementById("comm").value = "";
      }
    });
  }
  
  return false;
}
</script>