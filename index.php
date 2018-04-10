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

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $str = "location: auta.php?";
        if(isset($_POST['marka']))
        {
            $marka = mysqli_real_escape_string($link, $_POST['marka']);
            $str = $str . "marka=$marka&";
        }
        if(isset($_POST['model']))
        {
            $model = mysqli_real_escape_string($link, $_POST['model']);
            $str = $str . "model=$model&";
        }
        if($_POST['rok_od'] != null)
        {
            $rokod = mysqli_real_escape_string($link, $_POST['rok_od']);
            $str = $str . "rok_od=$rokod&";
        }
        if($_POST['rok_do'] != null)
        {
            $rokdo = mysqli_real_escape_string($link, $_POST['rok_do']);
            $str = $str . "rok_do=$rokdo&";
        }
        if($_POST['cena_od'] != null)
        {
            $cenaod = mysqli_real_escape_string($link, $_POST['cena_od']);
            $str = $str . "cena_od=$cenaod&";
        }
        if($_POST['cena_do'] != null)
        {
            $cenado = mysqli_real_escape_string($link, $_POST['cena_do']);
            $str = $str . "cena_do=$cenado&";
        }
        $stan = mysqli_real_escape_string($link, $_POST['stan']);
        $str = $str . "stan=$stan";
        header($str);
    }
?>
<!DOCTYPE html>
<head lang="en">
    <title> RCS </title>
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
            margin-top:60px;
        }
        .margins2
        {
            margin-top:40px;
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
        .form-group .bootstrap-select.form-control 
        {
            z-index: inherit;
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
        @media (min-width: 768px) 
        {
            #marka, #model 
            {
                width: 195px;
            }
        }
        @media (max-width: 768px) 
        {
            .one 
            {
                text-align: center;
            }
            img.ctr
            {
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
        }
    </style>
    <script type="text/javascript">
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
        GetNavbar(0, $pro + $spc);
    ?>
    <div style="background-color: #f2f2f2;">
        <hr>
    <form enctype="multipart/form-data" action="" method="post">
    <div class="col-sm-3 col-sm-offset-1 margins">
    <div class="form-group">
        <label class="col-sm-12" for="marka">Marka i model</label>
    </div>
    <div class="form-inline col-sm-12">
        <div class="form-group">
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
        <div class="form-group">
            <select class='form-control' name='model' id='model' disabled>
                <option value='' disabled selected>Model</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-12" for="rok">Rok produkcji</label> <br>
    </div>
    <div class="form-group">
        <div class="form-inline col-sm-12">
            <input type="number" class="form-control" name="rok_od" placeholder="Od"> 
            <input type="number" class="form-control" name="rok_do" placeholder="Do">
        </div>
    </div> 
    <div class="form-group">
        <label class="col-sm-12" for="cena">Cena</label> <br>
    </div>
    <div class="form-group">
        <div class="form-inline col-sm-12">
            <input type="number" class="form-control" name="cena_od" placeholder="Od"> 
            <input type="number" class="form-control" name="cena_do" placeholder="Do">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-12" for="stan">Stan</label> <br>
    </div>
    <div class="form-group col-sm-12" data-toggle="buttons">
        <label class="btn btn-primary active">
            <input type="radio" name="stan" value="all" autocomplete="off" checked> Wszystkie </label>
        <label class="btn btn-primary">
            <input type="radio" name="stan" value="new" autocomplete="off"> Nowe </label>
        <label class="btn btn-primary">
            <input type="radio" name="stan" value="old" autocomplete="off"> Używane </label>
    </div>
    <div class="form-group col-sm-12">
        <button type="submit" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-search"></span> Szukaj</button>
    </div>
    </div>
    </form>
    <div class="col-sm-5 col-sm-offset-1 col-xs-12 margins2">
    <?php
        $sel1 = mysqli_query($link, "SELECT a.id_text, a.topic, a.foto, c.name FROM article a, category c WHERE a.id_cat = c.id_cat order by a.data desc");
        $i = 0;
        if($sel1->num_rows === 0){}
        else
        {
        ?>
            <h2 class="col-sm-offset-1"> Najnowsze artykuły </h2> <br>
            <?php
            while(($rsel1 = mysqli_fetch_array($sel1, MYSQLI_ASSOC)) && $i < 3)
            {
            ?>  
                <a style="text-decoration: none" href = "text.php?id=<?php echo $rsel1['id_text']; ?>" > <div class="col-sm-4">
                    <img class="img-responsive img-rounded ctr" src="res/<?php echo $rsel1['foto']; ?>" alt="Article Photo" width="320" height="180"> <br>
                    <h4 class="one"> <b> <?php echo $rsel1['topic']; ?> </b> </h4>
                    <hr>
                </div> </a>    
                <?php
                $i++;
            }
        }
    ?>
    </div>
    <div class="clear"></div>
        <hr>
    </div>
    <div class="col-sm-10 col-sm-offset-1 col-xs-12 margins2">
        <?php
        $sel2 = mysqli_query($link, "SELECT c.id_car, m.name as marka, mm.name as model, o.foto, f.type, o.prod_date, o.price FROM car c, car_make m, car_model mm, fuel f, options o WHERE c.id_m = m.id_m and c.id_mm = mm.id_mm and c.id_option = o.id_option and f.id_pal = o.id_pal order by c.date_add desc");
        $j = 0;
        if($sel2->num_rows === 0){}
        else
        {
        ?>
            <h2 class="col-sm-offset-1"> Najnowsze ogłoszenia </h2> <br>
            <?php
            while(($rsel2 = mysqli_fetch_array($sel2, MYSQLI_ASSOC)) && $j < 6)
            {
            $marka = $rsel2['marka'];
            $model = $rsel2['model'];
            ?>  
                <a style="text-decoration: none" href = "auto.php?id=<?php echo $rsel2['id_car']; ?>" > <div class="col-sm-2">
                    <img class="img-responsive img-rounded ctr" src="res/<?php echo $rsel2['foto']; ?>" alt="Article Photo" width="320" height="180">
                    <h4 class="one"> <b> <?php echo $marka; echo " "; echo $model; ?> </b> </h4>
                    <p class="one"> <b> <?php echo $rsel2['type']; echo " • "; echo $rsel2['prod_date']; echo " • "; echo $rsel2['price']; echo " zł"; ?> </b> </p>
                    <hr>
                </div> </a>    
                <?php
                $j++;
            }
        }
    ?>
    </div>
    

</body>