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
?>
<!DOCTYPE html>
<head lang="en">
    <title> Ogłoszenia </title>
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
        .margins2
        {
            margin-top:100px;
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
        .btn:hover
        {
            background-color: #00cccc;
            border-color: #00cccc;
        }
        a:hover
        {
            text-decoration: none;
            color: #00cccc;
        }
        @media (max-width: 768px) 
        {
            .one 
            {
                text-align: center;
            }
            #fltrs 
            {
                display: none;
            }
            #fltrs_btn 
            {
                display: none;
            }
            img.ctr
            {
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
        }
    </style>
    <script>
        $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
        });
        $(function() {
                $('#marka').change(function() {
                    var car = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "selectmodel.php",
                        data: 'choosen=' + car,
                        success: function(giveit) {
                            $('#model').html(giveit);
                            $("#model").prop('disabled', false);
                        }
                    });
                });
            });
    </script>
</head>
<body>
    <?php 
        GetNavbar(1, $pro + $spc); 
            $marka = mysqli_real_escape_string($link , $_GET['marka']);
            $model = mysqli_real_escape_string($link , $_GET['model']);
            $rokod = mysqli_real_escape_string($link , $_GET['rok_od']);
            $rokdo = mysqli_real_escape_string($link , $_GET['rok_do']);
            $cenaod = mysqli_real_escape_string($link , $_GET['cena_od']);
            $cenado = mysqli_real_escape_string($link , $_GET['cena_do']);
            $stan = mysqli_real_escape_string($link , $_GET['stan']);
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                if(isset($_POST['search']))
                {
                    $szukaj = mysqli_real_escape_string($link, $_POST['search']);
                    $words = explode(' ', $szukaj);
                    $cars = "SELECT c.id_car, m.name as marka, mm.name as model, o.prod_date, p.type as paliwo, o.mileage, o.netto, o.price, o.vat, o.engine, o.bHP, g.type as gears, o.status, o.foto, d.type, t.typename, o.color, o.city FROM car c, car_make m, car_model mm, fuel p, gearbox g, options o, drive d, type t WHERE c.id_option = o.id_option and p.id_pal = o.id_pal and c.id_m = m.id_m and c.id_mm = mm.id_mm and o.id_gearbox = g.id_gearbox and o.id_drive = d.id_drive and o.id_type = t.id_type";
                    foreach ($words as $word)
                        $cars .= ' AND concat(m.name,mm.name,p.type,o.prod_date,g.type,o.status,d.type,t.typename,o.color,o.city) LIKE "%' . $word . '%"';
                    ?>
                    <h2 class="margins2" style="text-align: center"> Wyszukiwana fraza: <i> <?php echo htmlspecialchars("$szukaj "); ?> </i> </h2>
                    <?php
                }
                else
                {
                    $cars = "select c.id_car, m.name as marka, mm.name as model, o.prod_date, p.type as paliwo, o.mileage, o.netto, o.price, o.vat, o.engine, o.bHP, g.type as gears, o.status, o.foto, o.damaged, t.typename, d.type, o.leasing from car c, car_make m, car_model mm, fuel p, gearbox g, options o, type t, drive d where c.id_option = o.id_option and p.id_pal = o.id_pal and c.id_m = m.id_m and c.id_mm = mm.id_mm and o.id_gearbox = g.id_gearbox and o.id_type = t.id_type and o.id_drive = d.id_drive";
                    if(isset($_POST['marka']))
                    {
                        $marka = mysqli_real_escape_string($link , $_POST['marka']);
                        $cars .= " and m.name = '$marka'";
                    }
                    if(isset($_POST['model']))
                    {
                        $model = mysqli_real_escape_string($link , $_POST['model']);
                        $cars .= " and mm.name = '$model'";
                    }
                    if($_POST['rok_od'] != null)
                    {
                        $rokod = mysqli_real_escape_string($link , $_POST['rok_od']);
                        $cars .= " and o.prod_date >= $rokod";
                    }
                    if($_POST['rok_do'] != null)
                    {
                        $rokdo = mysqli_real_escape_string($link , $_POST['rok_do']);
                        $cars .= " and o.prod_date <= $rokdo";
                    }
                    if($_POST['cena_od'] != null)
                    {
                        $cenaod = mysqli_real_escape_string($link , $_POST['cena_od']);
                        $cars .= " and o.price >= $cenaod";
                    }
                    if($_POST['cena_do'] != null)
                    {
                        $cenado = mysqli_real_escape_string($link , $_POST['cena_do']);
                        $cars .= " and o.price <= $cenado";
                    }
                    if(isset($_POST['stan']))
                    {
                        $stan = mysqli_real_escape_string($link , $_POST['stan']);
                        if($stan == 'new')
                            $cars .= " and o.status = 1";
                        if($stan == 'old')
                            $cars .= " and o.status = 0";
                    }
                    if(isset($_POST['damaged']))
                    {
                        $dmg = mysqli_real_escape_string($link , $_POST['damaged']);
                        $cars .= " and o.damaged = $dmg";
                    }
                    if(isset($_POST['typ']))
                    {
                        $type = mysqli_real_escape_string($link , $_POST['typ']);
                        $cars .= " and t.typename = '$type'";
                    }
                    if(isset($_POST['paliwo']))
                    {
                        $pal = mysqli_real_escape_string($link , $_POST['paliwo']);
                        $cars .= " and p.type = '$pal'";
                    }
                    if(isset($_POST['gearbox']))
                    {
                        $gb = mysqli_real_escape_string($link , $_POST['gearbox']);
                        $cars .= " and g.type = '$gb'";
                    }
                    if(isset($_POST['drive']))
                    {
                        $drv = mysqli_real_escape_string($link , $_POST['drive']);
                        $cars .= " and d.type = '$drv'";
                    }
                    if($_POST['engineod'] != null)
                    {
                        $eng1 = mysqli_real_escape_string($link , $_POST['engineod']);
                        $cars .= " and o.engine >= $eng1";
                    }
                    if($_POST['enginedo'] != null)
                    {
                        $eng2 = mysqli_real_escape_string($link , $_POST['enginedo']);
                        $cars .= " and o.engine <= $eng2";
                    }
                    if($_POST['mocod'] != null)
                    {
                        $mc1 = mysqli_real_escape_string($link , $_POST['mocod']);
                        $cars .= " and o.bHP >= $mc1";
                    }
                    if($_POST['mocdo'] != null)
                    {
                        $mc2 = mysqli_real_escape_string($link , $_POST['mocdo']);
                        $cars .= " and o.bHP <= $mc2";
                    }
                    $cars .= " order by c.date_add desc";
                }
            }
            else if($marka != null || $model != null || $rokod != null || $rokdo != null || $cenaod != null || $cenado != null || $stan != null)
            {
                $cars = "select c.id_car, m.name as marka, mm.name as model, o.prod_date, p.type as paliwo, o.mileage, o.netto, o.price, o.vat, o.engine, o.bHP, g.type as gears, o.status, o.foto from car c, car_make m, car_model mm, fuel p, gearbox g, options o where c.id_option = o.id_option and p.id_pal = o.id_pal and c.id_m = m.id_m and c.id_mm = mm.id_mm and o.id_gearbox = g.id_gearbox";
                if($marka != null && $marka != '0')
                    $cars = $cars . " and m.name = '$marka'";
                if($model != null && $model != '0')
                    $cars = $cars . " and mm.name = '$model'";
                if($rokod != null && $rokod != '0')
                    $cars = $cars . " and o.prod_date >= $rokod";
                if($rokdo != null && $rokdo != '0')
                    $cars = $cars . " and o.prod_date <= $rokdo";
                if($cenaod != null && $cenaod != '0')
                    $cars = $cars . " and o.price >= $cenaod";
                if($cenado != null && $cenado != '0')
                    $cars = $cars . " and o.price <= $cenado";
                if($stan == 'new')
                    $cars = $cars . " and o.status = 1";
                if($stan == 'old')
                    $cars = $cars . " and o.status = 0";
                $cars = $cars . " order by c.date_add desc";
            }
            else
            {
                $cars = "select c.id_car, m.name as marka, mm.name as model, o.prod_date, p.type as paliwo, o.mileage, o.netto, o.price, o.vat, o.engine, o.bHP, g.type as gears, o.status, o.foto from car c, car_make m, car_model mm, fuel p, gearbox g, options o where c.id_option = o.id_option and p.id_pal = o.id_pal and c.id_m = m.id_m and c.id_mm = mm.id_mm and o.id_gearbox = g.id_gearbox order by c.date_add desc";
            }
            $result = mysqli_query($link, $cars);
            if($result->num_rows === 0)
            {
            ?>
                <h4 class="margins2" style="text-align: center"> Brak szukanych ogłoszeń </h4> <br> <br>
                <a style="text-decoration: none" href = "auta.php" > <h4 style="text-align: center"> Pokaż wszystkie </h4> </a>
            <?php
            }
            ?>
    <button type="button" id="fltrs_btn" class="btn btn-primary margins col-sm-10 col-sm-offset-1 col-xs-12" data-toggle="collapse" data-target="#fltrs">Pokaż opcje wyszukiwania</button>
    <form enctype="multipart/form-data" action="" method="post">
    <div id="fltrs" class="collapse col-sm-10 col-sm-offset-1" style="background-color: #f2f2f2;">
        <br>
        <div class="form-group col-sm-3">
            <select class="form-control" name="marka" id="marka">
                <option value="" disabled selected>Marka</option>
                <?php
                $q1 = mysqli_query($link, "select id_m, name from car_make order by name");
                while($row1 = mysqli_fetch_array($q1))
                {
                    echo "<option value='".$row1['name']."'> ".$row1['name']." </option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group col-sm-3">
            <select class='form-control' name='model' id='model' disabled>
                <option value='' disabled selected>Model</option>
            </select>
        </div>
        <div class="form-group col-sm-3">
            <input type="number" class="form-control" name="rok_od" placeholder="Rok(od)"> 
        </div>
        <div class="form-group col-sm-3">
            <input type="number" class="form-control" name="rok_do" placeholder="Rok(do)"> 
        </div>
        <div class="form-group col-sm-3">
            <input type="number" class="form-control" name="cena_od" placeholder="Cena(od)"> 
        </div>
        <div class="form-group col-sm-3">
            <input type="number" class="form-control" name="cena_do" placeholder="Cena(do)"> 
        </div>
        <div class="form-group col-sm-3">
            <select class='form-control' id='stan' name='stan'>
                <option value="" disabled selected> Stan </option>
                <option value="all">Wszystkie</option>
                <option value="new">Nowe</option>
                <option value="old">Używane</option>
            </select>     
        </div>
        <div class="form-group col-sm-3">
            <select class='form-control' id='damaged' name='damaged'>
                <option value="" disabled selected> Uszkodzone </option>
                <option value="1">Tak</option>
                <option value="0">Nie</option>
            </select>
        </div>
        <div class="form-group col-sm-3">
            <select class="form-control" id="typ" name="typ">
                <option value="" disabled selected>Typ</option>
                <?php
                $q4 = mysqli_query($link, "select typename from type");
                while($row4 = mysqli_fetch_array($q4))
                {
                    echo "<option value='".$row4['typename']."'> ".$row4['typename']." </option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group col-sm-3">
            <select class="form-control" id="paliwo" name="paliwo">
                <option value="" disabled selected>Paliwo</option>
                <?php
                $q3 = mysqli_query($link, "select type from fuel");
                while($row3 = mysqli_fetch_array($q3))
                {
                    echo "<option value='".$row3['type']."'> ".$row3['type']." </option>";
                }
                ?>
            </select> 
        </div>
        <div class="form-group col-sm-3">
            <select class="form-control" id="gearbox" name="gearbox">
                <option value="" disabled selected>Skrzynia biegów</option>
                <?php
                $q5 = mysqli_query($link, "select type from gearbox");
                while($row5 = mysqli_fetch_array($q5))
                {
                    echo "<option value='".$row5['type']."'> ".$row5['type']." </option>";
                }
                ?>
            </select> 
        </div>
        <div class="form-group col-sm-3">
            <select class="form-control" id="drive" name="drive">
                <option value="" disabled selected>Napęd</option>
                <?php
                $q6 = mysqli_query($link, "select type from drive");
                while($row6 = mysqli_fetch_array($q6))
                {
                    echo "<option value='".$row6['type']."'> ".$row6['type']." </option>";
                }
                ?>
            </select> 
        </div>
        <div class="form-group col-sm-3">
            <input type="number" class="form-control" id="engineod" name="engineod" placeholder="Poj. silnika(od)" maxlength=5>
        </div>
        <div class="form-group col-sm-3">
            <input type="number" class="form-control" id="enginedo" name="enginedo" placeholder="Poj. silnika(do)" maxlength=5>
        </div>
        <div class="form-group col-sm-3">
            <input type="number" class="form-control" id="mocod" name="mocod" placeholder="Moc silnika(od)" maxlength=5>
        </div>
        <div class="form-group col-sm-3">
            <input type="number" class="form-control" id="mocdo" name="mocdo" placeholder="Moc silnika(do)" maxlength=5>
        </div>
        <div class="form-group col-sm-12">
            <button type="submit" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-search"></span> Szukaj</button>
        </div>
    </div>
    </form> 
            <?php
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            {    
                $id = $row['id_car'];
                $mm = $row['model'];
                $mil = $row['mileage'];
                $rok = $row['prod_date'];
                $pal = $row['paliwo'];
                $gear = $row['gears'];
                $engine = $row['engine'];
                $bHP = $row['bHP'];
                $cena = $row['price'];
                if($row['status'] == 1)
                    $sta = 'Nowy';
                else
                    $sta = 'Używany';
                if($row['netto'] == 1)
                    $net = 'Netto';
                else
                    $net = 'Brutto';
            ?>
                <a style="text-decoration: none" href = "auto.php?id=<?php echo $row['id_car']; ?>" > <div class="container margins col-sm-8 col-sm-offset-2 one" style="background-color: #f2f2f2; white-space: nowrap;">
                    <div class="row">
                        <div class="col-sm-3">
                            <br>
                            <img class="img-responsive img-rounded ctr" src="res/<?php echo $row['foto']; ?>" alt="Car Photo" width="320" height="180">
                        </div>
                        <div class="col-sm-9">
                            <div class="col-sm-8">
                                <h3> <?php echo $row['marka']; echo " $mm"; ?> </h3>
                            </div>
                            <div class="col-sm-8" style="color: black;">
                                <h4> <?php echo " $sta"; echo " •"; echo " $rok"; echo " •"; echo " $mil Km"; ?> </h4> 
                            </div>
                            <div class="col-sm-8" style="color: black;">
                                <h4> <?php echo " $pal"; echo " •"; echo " $gear"; echo " •"; echo " $engine cm³"; echo " •"; echo " $bHP KM"; ?> </h4> 
                            </div>
                            <div class="col-sm-12"  style="color: black;">
                                <h2> <?php echo "  $cena PLN"; ?> <span> <?php echo " $net"; if($row['vat'] == 1){ echo " •"; echo " Faktura VAT";} ?> </span> </h2> 
                                <hr>
                            </div>
                        </div>
                    </div>       
                </div>  </a>      
            <?php
            }
            ?>
</body>