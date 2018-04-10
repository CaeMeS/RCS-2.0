<?php
    include("DBconn.php");
    include("navbar.php");
    include("verify.php");
    $type = mysqli_real_escape_string($link , $_GET['type']);
    $q = mysqli_query($link, "select id_cat from category where name = '$type'");
    $rq = mysqli_fetch_row($q);
    $pro = 0;
    if(!isset($_SESSION['user_mail']) && $spc == 0)
    {
        header("Location: index.php");
    }
    else
       $pro = 1;

if($_SERVER["REQUEST_METHOD"] == "POST")
{        
    if(isset($_FILES['file']))
    {
        $errors= array();
        $file_name = $_FILES['file']['name'];
        $file_size =$_FILES['file']['size'];
        $file_tmp =$_FILES['file']['tmp_name'];
        $file_type=$_FILES['file']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));     
        $extensions= array("jpeg","jpg","png");      
        if(in_array($file_ext,$extensions)=== false)
        {
            $errors[]="Można dodać jedynie pliki JPG, JPEG, i PNG";
        }    
        if($file_size > 5242880)
        {
            $errors[]='Rozmiar musi być mniejszy niż 5MB';
        }    
        if(empty($errors)==true)
        {
            $temp = explode(".", $_FILES["file"]["name"]);
            $photo = round(microtime(true)) . $id_user . '.' . end($temp);
            move_uploaded_file($file_tmp,"res/".$photo);
            chmod("res/".$file_name, 0777);
            chown("res/".$file_name, root);
            $foto = $photo;
     
            $tytul = mysqli_real_escape_string($link, $_POST['title']);
            $intro = mysqli_real_escape_string($link, $_POST['intro']);
            $article = mysqli_real_escape_string($link, $_POST['article']);
            if($type == 'CarBattle' || $type == 'Test' || $type == 'Porada')
            {
                $marka1 = mysqli_real_escape_string($link, $_POST['marka1']);
                $model1 = mysqli_real_escape_string($link, $_POST['model1']);
                $x1 = mysqli_query($link, "select id_m from car_make where name = '$marka1'");
                $y1 = mysqli_fetch_row($x1);
                $x2 = mysqli_query($link, "select id_mm from car_model where name = '$model1'");
                $y2 = mysqli_fetch_row($x2);
                if($type == 'Porada')
                {
                    $rokod = mysqli_real_escape_string($link, $_POST['rokod']);
                    $rokdo = mysqli_real_escape_string($link, $_POST['rokdo']);
                }
            }
            if($type == 'Test' || $type == 'CarBattle')
            {
                $silnik1 = mysqli_real_escape_string($link, $_POST['silnik1']);
                $poj1 = mysqli_real_escape_string($link, $_POST['poj1']);
                $moc1 = mysqli_real_escape_string($link, $_POST['bhp1']);
                $acc1 = mysqli_real_escape_string($link, $_POST['acc1']);
                $vmax1 = mysqli_real_escape_string($link, $_POST['vmax1']);
                $spalanie1 = mysqli_real_escape_string($link, $_POST['spalanie1']);
                $skrzynia1 = mysqli_real_escape_string($link, $_POST['skrzynia1']);
                $naped1 = mysqli_real_escape_string($link, $_POST['naped1']);
                $cena1 = mysqli_real_escape_string($link, $_POST['cena1']);
                $rok1 = mysqli_real_escape_string($link, $_POST['rok1']);
            }
            if($type == 'CarBattle')
            {
                $silnik2 = mysqli_real_escape_string($link, $_POST['silnik2']);
                $poj2 = mysqli_real_escape_string($link, $_POST['poj2']);
                $moc2 = mysqli_real_escape_string($link, $_POST['bhp2']);
                $acc2 = mysqli_real_escape_string($link, $_POST['acc2']);
                $vmax2 = mysqli_real_escape_string($link, $_POST['vmax2']);
                $spalanie2 = mysqli_real_escape_string($link, $_POST['spalanie2']);
                $skrzynia2 = mysqli_real_escape_string($link, $_POST['skrzynia2']);
                $naped2 = mysqli_real_escape_string($link, $_POST['naped2']);
                $cena2 = mysqli_real_escape_string($link, $_POST['cena2']);
                $marka2 = mysqli_real_escape_string($link, $_POST['marka2']);
                $model2 = mysqli_real_escape_string($link, $_POST['model2']);
                $x3 = mysqli_query($link, "select id_m from car_make where name = '$marka2'");
                $y3 = mysqli_fetch_row($x3);
                $x4 = mysqli_query($link, "select id_mm from car_model where name = '$model2'");
                $y4 = mysqli_fetch_row($x4);
                $rok2 = mysqli_real_escape_string($link, $_POST['rok2']);
            }
            $x5 = mysqli_query($link, "select id_user from user where mail = '$login_session'");
            $y5 = mysqli_fetch_row($x5);
            
            if($type == 'News' || $type == 'Historia')
            {
                $i1=mysqli_query($link, "insert into article (topic, intro, article, id_user, id_cat, foto) values ('$tytul', '$intro', '$article', '$y5[0]', '$rq[0]', '$foto');");
                $idart = mysqli_insert_id($link);
            }
            if($type == 'Porada')
            {
                $i2=mysqli_query($link, "insert into auto_art (id_m, id_mm, rok, rokdo) values ('$y1[0]', '$y2[0]', '$rokod', '$rokdo');");
                $i2_id = mysqli_insert_id($link);
                $i3=mysqli_query($link, "insert into article (topic, intro, article, id_user, id_cat, foto, id_auto1) values ('$tytul', '$intro', '$article', '$y5[0]', '$rq[0]', '$foto', '$i2_id');");
                $idart = mysqli_insert_id($link);
            }
            if($type == 'Test' || $type == 'CarBattle')
            {
                $i4=mysqli_query($link, "insert into auto_art (id_m, id_mm, rok, silnik, poj, moc, acc, vmax, spalanie, gears, naped, cena) values ('$y1[0]', '$y2[0]', '$rok1', '$silnik1', '$poj1', '$moc1', '$acc1', '$vmax1', '$spalanie1', '$skrzynia1', '$naped1', '$cena1');");
                $i4_id = mysqli_insert_id($link);
                if($type == 'CarBattle')
                {
                    $i5=mysqli_query($link, "insert into auto_art (id_m, id_mm, rok, silnik, poj, moc, acc, vmax, spalanie, gears, naped, cena) values ('$y3[0]', '$y4[0]', '$rok2', '$silnik2', '$poj2', '$moc2', '$acc2', '$vmax2', '$spalanie2', '$skrzynia2', '$naped2', '$cena2');");
                    $i5_id = mysqli_insert_id($link);
                    $i6=mysqli_query($link, "insert into article (topic, intro, article, id_user, id_cat, foto, id_auto1, id_auto2) values ('$tytul', '$intro', '$article', '$y5[0]', '$rq[0]', '$foto', '$i4_id', '$i5_id');");
                    $idart = mysqli_insert_id($link);
                }
                else
                {
                    $i7=mysqli_query($link, "insert into article (topic, intro, article, id_user, id_cat, foto, id_auto1) values ('$tytul', '$intro', '$article', '$y5[0]', '$rq[0]', '$foto', '$i4_id');");
                    $idart = mysqli_insert_id($link);
                }   
            }
            $inc = 0;
            foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name)
            {
                $err= array();
                $files_name = $_FILES['files']['name'][$key];
                $files_size =$_FILES['files']['size'][$key];
                $files_tmp = $_FILES['files']['tmp_name'][$key];
                $files_type = $_FILES['files']['type'][$key];
                $files_ext = strtolower(end(explode('.',$_FILES['files']['name'][$key])));
                $extensions = array("jpeg","jpg","png");    
                if(in_array($files_ext,$extensions)=== false)
                {
                    $err[]="Można dodać jedynie pliki JPG, JPEG, i PNG";
                }    
                if($files_size > 5242880)
                {
                    $err[]='Rozmiar musi być mniejszy niż 5MB';
                }   
                if(empty($err)==true)
                {
                    $tmp = explode(".", $_FILES["files"]["name"][$key]);
                    $fotka = round(microtime(true)) . $id_user . $inc . '.' . end($tmp);
                    move_uploaded_file($files_tmp,"res/".$fotka);
                    chmod("res/".$files_name, 0777);
                    chown("res/".$files_name, root);
                    $i0=mysqli_query($link, "insert into fotki (name, id_art) values ('$fotka', '$idart');");
                }
                else
                {
                    print_r($errors);
                }
                $inc++;
            }
            if (strlen (mysqli_error($link)) > 0) 
            {
                echo mysqli_error($link);
            } 
            else
            {            
                header("location: artykuly.php");
            }
        }
        else
        {
            print_r($errors);
        }
    }
}
        
?>

<!DOCTYPE html>
<head lang="en">
    <title> Dodawanie artykułu </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" integrity="sha384-o9KO9jVK1Q4ybtHgJCCHfgQrTRNlkT6SL3j/qMuBMlDw3MmFrgrOHCOaIMJWGgK5" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
        #previmg
        {
            max-width:300px;
            align-content: center;
        }
        .btn:hover
        {
            background-color: #00cccc;
            border-color: #00cccc;
        }
        .inputfile 
        {
	       width: 0.1px;
	       height: 0.1px;
	       opacity: 0;
	       overflow: hidden;
	       position: absolute;
	       z-index: -1;
        }
        .inputfile + .lbl
        {
            font-size: 1.25em;
            font-weight: 700;
            color: white;
            background-color: #0088cc;
            display: inline-block;
            cursor: pointer;
            padding: 5px;
        }
        .tx 
        {
            resize: none;
            overflow: hidden;
            min-height: 100px;
            max-height: 3000px;               
        }
    </style>
    </head>
<body>
    <?php 
        GetNavbar(0, $pro + $spc);
    ?>
    <div style="text-align: center">
        <h2> <b> Dodaj nowy artykuł </b></h2>
    </div>
    <form enctype="multipart/form-data" action="" method="post">
    <div class="container col-sm-6 col-sm-offset-3" style="background-color: #f2f2f2; margin-top:20px;">
        <hr>
            <div class="form-group">
                <div class="col-sm-12">
                    <label class="col-sm-12" for="title" style="white-space: nowrap;">Tytuł</label>
                    <input type="text" class="form-control" name="title" id="title" maxlength="100" required>
                    <hr>
                </div>
                <hr>   
            </div>   
    </div>
    <div class="container col-sm-6 col-sm-offset-3" style="background-color: #f2f2f2; margin-top:20px;">
        <hr>
            <div class="form-group">
                <div class="col-sm-12">
                    <label class="col-sm-12" for="intro" style="white-space: nowrap;">Wstęp</label>
                    <textarea class="form-control" style="resize: none; overflow: hidden;" name="intro" id="intro" cols="100" rows="1" onkeyup="auto_grow(this)" maxlength="350" required></textarea>
                    <hr>
                </div>
                <hr>
            </div>   
    </div>
    <div class="container col-sm-6 col-sm-offset-3" style="background-color: #f2f2f2; margin-top:20px;">
        <hr>
            <div class="form-group">
                <div class="col-sm-12">
                    <label class="col-sm-12" for="article" style="white-space: nowrap;">Treść</label>
                    <textarea class="form-control" style="resize: none;" name="article" id="article" cols="100" rows="10" maxlength="20000" required></textarea>
                    <hr>
                </div>
                <hr>
            </div>   
    </div>
    <?php
    if($type == 'Test' || $type == 'CarBattle' || $type == 'Porada')
    {
    ?>
    <div class="container margins col-sm-6 col-sm-offset-3" style="background-color: #f2f2f2;">
        <hr>
        <?php
        if($type == 'CarBattle')
        {
        ?>
            <label class="col-sm-12" style="white-space: nowrap; text-align: center;">Pojazd nr 1</label> <br>
        <?php
        }
        ?>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" style="white-space: nowrap;" for="marka1">Marka</label>
                        <select class="form-control" name="marka1" id="marka1" required>
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
                    <div class="col-sm-4">
                        <label class="col-sm-12" style="white-space: nowrap;" for="model1">Model</label>
                        <select class='form-control' name='model1' id='model1' disabled required>
                            <option value='' disabled selected>Model</option>
                        </select>
                    </div>
                    <?php
                    if($type == 'Porada')
                    {
                    ?>
                    <div class="col-sm-2">
                        <label class="col-sm-12" for="rokod" style="white-space: nowrap;">Rok od</label>
                        <input type="number" class="form-control" id="rokod" name="rokod" required maxlength=4>
                        <hr>
                    </div>
                    <div class="col-sm-2">
                        <label class="col-sm-12" for="rokdo" style="white-space: nowrap;">Rok do</label>
                        <input type="number" class="form-control" id="rokdo" name="rokdo" required maxlength=4>
                        <hr>
                    </div> <br>
                    <?php
                    }
                    else
                    {
                    ?>   
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="rok1" style="white-space: nowrap;">Rok</label>
                        <input type="number" class="form-control" id="rok1" name="rok1" required maxlength=4>
                        <hr>
                    </div> <br>
                    <?php    
                    }
                    ?>
                </div> 
            </div>
    </div>
    <?php
    }
        if($type == 'Test' || $type == 'CarBattle')
        {
        ?>
            <div class="container col-sm-6 col-sm-offset-3" style="background-color: #f2f2f2; margin-top:20px;">
            <hr>
                <label class="col-sm-12" style="white-space: nowrap; text-align: center;">Dane techniczne <?php if($type == 'CarBattle') echo " - pojazd 1"; ?></label> <br>
            <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="silnik1" style="white-space: nowrap;">Silnik</label>
                        <input type="text" class="form-control" id="silnik1" name="silnik1" required maxlength=20> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="poj1" style="white-space: nowrap;">Pojemność</label>
                        <input type="number" class="form-control" id="poj1" name="poj1" required maxlength=4> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="bhp1" style="white-space: nowrap;">Moc silnika</label>
                        <input type="number" class="form-control" id="bhp1" name="bhp1" required maxlength=4> 
                    </div> <br>
                </div> 
            </div>  <br> <br> 
            <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="acc1" style="white-space: nowrap;">Przyspieszenie</label>
                        <input type="number" class="form-control" id="acc1" name="acc1" required maxlength=3> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="vmax1" style="white-space: nowrap;">V-max</label>
                        <input type="number" class="form-control" id="vmax1" name="vmax1" required maxlength=3> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="spalanie1" style="white-space: nowrap;">Spalanie</label>
                        <input type="number" class="form-control" id="spalanie1" name="spalanie1" required maxlength=5> 
                    </div> <br>
                </div> 
            </div>  <br> <br>
            <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="skrzynia1" style="white-space: nowrap;">Skrzynia biegów</label>
                        <input type="text" class="form-control" id="skrzynia1" name="skrzynia1" required maxlength=20> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="naped1" style="white-space: nowrap;">Napęd</label>
                        <input type="text" class="form-control" id="naped1" name="naped1" required maxlength=20> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="cena1" style="white-space: nowrap;">Cena</label>
                        <input type="number" class="form-control" id="cena1" name="cena1" required maxlength=11>
                        <hr>
                    </div> <br>
                </div> 
            </div>
            </div>
        <?php
        }
        if($type == 'CarBattle')
        {
        ?> 
        <div class="container margins col-sm-6 col-sm-offset-3" style="background-color: #f2f2f2;">
        <hr> 
            <label class="col-sm-12" style="white-space: nowrap; text-align: center;">Pojazd nr 2</label> <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" style="white-space: nowrap;" for="marka2">Marka</label>
                        <select class="form-control" name="marka2" id="marka2" required>
                        <option value="" disabled selected>Marka</option>
                        <?php
                        $q2 = mysqli_query($link, "select id_m, name from car_make order by name");
                        while($row2 = mysqli_fetch_array($q2))
                        {
                            echo "<option value='".$row2['name']."'> ".$row2['name']." </option>";
                        }
                        ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" style="white-space: nowrap;" for="model2">Model</label>
                        <select class='form-control' name='model2' id='model2' disabled required>
                            <option value='' disabled selected>Model</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="rok2" style="white-space: nowrap;">Rok</label>
                        <input type="number" class="form-control" id="rok2" name="rok2" required maxlength=4>
                        <hr>
                    </div> <br>
                </div> 
            </div>
        </div>
        <?php    
        }
        if($type == 'CarBattle')
        {
        ?>
            <div class="container col-sm-6 col-sm-offset-3" style="background-color: #f2f2f2; margin-top:20px;">
            <hr>
                <label class="col-sm-12" style="white-space: nowrap; text-align: center;">Dane techniczne - pojazd 2</label> <br>
            <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="silnik2" style="white-space: nowrap;">Silnik</label>
                        <input type="text" class="form-control" id="silnik2" name="silnik2" required maxlength=20> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="poj2" style="white-space: nowrap;">Pojemność silnika</label>
                        <input type="number" class="form-control" id="poj2" name="poj2" required maxlength=4> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="bhp2" style="white-space: nowrap;">Moc silnika</label>
                        <input type="number" class="form-control" id="bhp2" name="bhp2" required maxlength=4> 
                    </div> <br>
                </div> 
            </div>  <br> <br> 
            <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="acc2" style="white-space: nowrap;">Przyspieszenie</label>
                        <input type="number" class="form-control" id="acc2" name="acc2" required maxlength=3> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="vmax2" style="white-space: nowrap;">V-max</label>
                        <input type="number" class="form-control" id="vmax2" name="vmax2" required maxlength=3> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="spalanie2" style="white-space: nowrap;">Spalanie</label>
                        <input type="number" class="form-control" id="spalanie2" name="spalanie2" required maxlength=3> 
                    </div> <br>
                </div> 
            </div>  <br> <br>
            <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="skrzynia2" style="white-space: nowrap;">Skrzynia biegów</label>
                        <input type="text" class="form-control" id="skrzynia2" name="skrzynia2" required maxlength=20> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="naped2" style="white-space: nowrap;">Napęd</label>
                        <input type="text" class="form-control" id="naped2" name="naped2" required maxlength=20> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="cena2" style="white-space: nowrap;">Cena</label>
                        <input type="number" class="form-control" id="cena2" name="cena2" required maxlength=11>
                        <hr>
                    </div> <br>
                </div> 
            </div>
            </div>
        <?php
        }
        ?>
    <div class="container col-sm-6 col-sm-offset-3" style="background-color: #f2f2f2; margin-top:20px;">
        <hr>
            <div class="form-group">
                <div class="col-sm-12">
                    <h3 style="text-align: center"> Dodaj zdjęcie główne</h3> <br>
                </div>
                <div style="text-align: center">                   
                    <input class="inputfile" name="file" type="file" id="file" onchange="preview_image(event)">
                    <label class="lbl" for="file"> <span class='glyphicon glyphicon-cloud-upload'></span> Wybierz</label> <br>
                </div>
                <div style="text-align: center">                   
                    <img id="previmg"/> <br>
                </div>
                <div class="col-sm-12">
                    <h3 style="text-align: center"> Dodaj zdjęcia dodatkowe</h3> <br>
                </div>
                <div style="text-align: center">                   
                    <input class="inputfile" name="files[]" type="file" id="files" multiple>
                    <label class="lbl" for="files"> <span class='glyphicon glyphicon-cloud-upload'></span> Wybierz</label> <br>
                </div>
                <hr>
            </div>   
    </div>
    <div class="container col-sm-6 col-sm-offset-3" style="margin-top:20px;">
        <div class="form-group col-sm-3 pull-right">
            <button type="submit" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-check"></span>  Dodaj</button>
        </div>
    </div>
    </form>
</body>
<script type="text/javascript">
function preview_image(event) 
{
    var reader = new FileReader();
    reader.onload = function()
{
    var output = document.getElementById('previmg');
    output.src = reader.result;
}
    reader.readAsDataURL(event.target.files[0]);
}
    
$(function() {
                $('#marka1').change(function() {
                    var car = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "selectmodel.php",
                        data: 'choosen=' + car,
                        success: function(giveit) {
                            $('#model1').html(giveit);
                            $("#model1").prop('disabled', false);
                        }
                    });
                });
            });
    
$(function() {
                $('#marka2').change(function() {
                    var car = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "selectmodel.php",
                        data: 'choosen=' + car,
                        success: function(giveit) {
                            $('#model2').html(giveit);
                            $("#model2").prop('disabled', false);
                        }
                    });
                });
            });
</script>