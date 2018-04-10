<?php
    include("DBconn.php");
    include("navbar.php");
    include("verify.php");
    $id = mysqli_real_escape_string($link , $_GET['id']);
    $t = mysqli_query($link, "select c.name from category c, article a where a.id_cat = c.id_cat and a.id_text = '$id'");
    $rt = mysqli_fetch_row($t);
    $type = $rt['0'];
    $q = mysqli_query($link, "select id_cat from category where name = '$type'");
    $rq = mysqli_fetch_row($q);
    $u = mysqli_query($link, "SELECT id_user FROM article WHERE id_text = '$id'");
    $ru = mysqli_fetch_row($u);
    $pro = 0;
    if((!isset($_SESSION['user_mail']) && $spc == 0) || $id_user != $ru['0'])
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
            $ifp=mysqli_query($link, "update article set foto = '$foto' where id_text = '$id'");
        }
        else
        {
            print_r($errors);
        }
    }
        
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
            
            $i1=mysqli_query($link, "update article set topic = '$tytul', intro = '$intro', article = '$article', foto = '$foto' where id_text = '$id'");

            if($type == 'Porada')
            {
                $aa = mysqli_query($link, "select id_auto1 from article where id_text = '$id'");
                $raa = mysqli_fetch_row($aa);
                $idaa = $raa['0'];
                $i2=mysqli_query($link, "update auto_art set rok = '$rokod', rokdo = '$rokdo' where id_opt = '$idaa'");
            }
            if($type == 'Test' || $type == 'CarBattle')
            {
                $aa1 = mysqli_query($link, "select id_auto1 from article where id_text = '$id'");
                $raa1 = mysqli_fetch_row($aa1);
                $idaa = $raa1['0'];
                $i3=mysqli_query($link, "update auto_art set rok = '$rok1', silnik = '$silnik1', poj = '$poj1', moc = '$moc1', acc = '$acc1', vmax = '$vmax1', spalanie = '$spalanie1', gears = '$skrzynia1', naped = '$naped1', cena = '$cena1' where id_opt = '$idaa'");
                if($type == 'CarBattle')
                {
                    $aa2 = mysqli_query($link, "select id_auto2 from article where id_text = '$id'");
                    $raa2 = mysqli_fetch_row($aa2);
                    $idaa2 = $raa2['0'];
                    $i4=mysqli_query($link, "update auto_art set rok = '$rok2', silnik = '$silnik2', poj = '$poj2', moc = '$moc2', acc = '$acc2', vmax = '$vmax2', spalanie = '$spalanie2', gears = '$skrzynia2', naped = '$naped2', cena = '$cena2' where id_opt = '$idaa2'");
                } 
            }
            if(isset($_FILES['files']))
            {
                $dphotos = mysqli_query($link, "DELETE FROM fotki WHERE id_art = '$id'");
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
                        $i0=mysqli_query($link, "insert into fotki (name, id_art) values ('$fotka', '$id');");
                    }
                    else
                    {
                        print_r($errors);
                    }
                    $inc++;
                }
            }
            if (strlen (mysqli_error($link)) > 0) 
            {
                echo mysqli_error($link);
            } 
            else
            {            
                header("location: konto.php");
            }
        }    
?>

<!DOCTYPE html>
<head lang="en">
    <title> Edycja artykułu </title>
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
    $e = mysqli_query($link, "select topic, intro, article, foto from article where id_text = '$id'");
    $re = mysqli_fetch_row($e);
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
                    <input type="text" class="form-control" name="title" id="title" maxlength="100" value="<?php echo $re['0']; ?>" required>
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
                    <textarea class="form-control" style="resize: none; overflow: hidden;" name="intro" id="intro" cols="100" rows="1" onkeyup="auto_grow(this)" maxlength="350" required> <?php echo $re['1']; ?> </textarea>
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
                    <textarea class="form-control" style="resize: none;" name="article" id="article" cols="100" rows="10" maxlength="20000" required> <?php echo $re['2']; ?> </textarea>
                    <hr>
                </div>
                <hr>
            </div>   
    </div>
    <?php
    if($type == 'Test' || $type == 'CarBattle' || $type == 'Porada')
    {
    $e1 = mysqli_query($link, "select m.name, mm.name, aa.rok from article a, auto_art aa, car_make m, car_model mm where aa.id_m = m.id_m and aa.id_mm = mm.id_mm and aa.id_opt = a.id_auto1 and a.id_text = '$id'");
    $re1 = mysqli_fetch_row($e1);
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
                        <input type="text" class="form-control" id="marka1" name="marka1" value="<?php echo $re1['0']; ?>" disabled>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" style="white-space: nowrap;" for="model1">Model</label>
                        <input type="text" class="form-control" id="model1" name="model1" value="<?php echo $re1['1']; ?>" disabled>
                    </div>
                    <?php
                    if($type == 'Porada')
                    {
                    $e2 = mysqli_query($link, "select aa.rokdo from article a, auto_art aa where aa.id_opt = a.id_auto1 and a.id_text = '$id'");
                    $re2 = mysqli_fetch_row($e2);   
                    ?>
                    <div class="col-sm-2">
                        <label class="col-sm-12" for="rokod" style="white-space: nowrap;">Rok od</label>
                        <input type="number" class="form-control" id="rokod" name="rokod" value="<?php echo $re1['2']; ?>" required maxlength=4>
                        <hr>
                    </div>
                    <div class="col-sm-2">
                        <label class="col-sm-12" for="rokdo" style="white-space: nowrap;">Rok do</label>
                        <input type="number" class="form-control" id="rokdo" name="rokdo" value="<?php echo $re21['1']; ?>" required maxlength=4>
                        <hr>
                    </div> <br>
                    <?php
                    }
                    else
                    {
                    ?>   
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="rok1" style="white-space: nowrap;">Rok</label>
                        <input type="number" class="form-control" id="rok1" name="rok1" value="<?php echo $re1['2']; ?>" required maxlength=4>
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
        $e3 = mysqli_query($link, "select aa.silnik, aa.poj, aa.moc, aa.acc, aa.vmax, aa.spalanie, aa.gears, aa.naped, aa.cena from article a, auto_art aa where aa.id_opt = a.id_auto1 and a.id_text = '$id'");
        $re3 = mysqli_fetch_row($e3);
        ?>
            <div class="container col-sm-6 col-sm-offset-3" style="background-color: #f2f2f2; margin-top:20px;">
            <hr>
                <label class="col-sm-12" style="white-space: nowrap; text-align: center;">Dane techniczne <?php if($type == 'CarBattle') echo " - pojazd 1"; ?></label> <br>
            <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="silnik1" style="white-space: nowrap;">Silnik</label>
                        <input type="text" class="form-control" id="silnik1" name="silnik1" value="<?php echo $re3['0']; ?>" required maxlength=20> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="poj1" style="white-space: nowrap;">Pojemność</label>
                        <input type="number" class="form-control" id="poj1" name="poj1" value="<?php echo $re3['1']; ?>" required maxlength=4> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="bhp1" style="white-space: nowrap;">Moc silnika</label>
                        <input type="number" class="form-control" id="bhp1" name="bhp1"value="<?php echo $re3['2']; ?>" required maxlength=4> 
                    </div> <br>
                </div> 
            </div>  <br> <br> 
            <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="acc1" style="white-space: nowrap;">Przyspieszenie</label>
                        <input type="number" class="form-control" id="acc1" name="acc1" value="<?php echo $re3['3']; ?>" required maxlength=3> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="vmax1" style="white-space: nowrap;">V-max</label>
                        <input type="number" class="form-control" id="vmax1" name="vmax1" value="<?php echo $re3['4']; ?>" required maxlength=3> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="spalanie1" style="white-space: nowrap;">Spalanie</label>
                        <input type="number" class="form-control" id="spalanie1" name="spalanie1" value="<?php echo $re3['5']; ?>" required maxlength=5> 
                    </div> <br>
                </div> 
            </div>  <br> <br>
            <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="skrzynia1" style="white-space: nowrap;">Skrzynia biegów</label>
                        <input type="text" class="form-control" id="skrzynia1" name="skrzynia1" value="<?php echo $re3['6']; ?>" required maxlength=20> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="naped1" style="white-space: nowrap;">Napęd</label>
                        <input type="text" class="form-control" id="naped1" name="naped1" value="<?php echo $re3['7']; ?>" required maxlength=20> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="cena1" style="white-space: nowrap;">Cena</label>
                        <input type="number" class="form-control" id="cena1" name="cena1" value="<?php echo $re3['8']; ?>" required maxlength=11>
                        <hr>
                    </div> <br>
                </div> 
            </div>
            </div>
        <?php
        }
        if($type == 'CarBattle')
        {
        $e4 = mysqli_query($link, "select m.name, mm.name, aa.rok from article a, auto_art aa, car_make m, car_model mm where aa.id_m = m.id_m and aa.id_mm = mm.id_mm and aa.id_opt = a.id_auto2 and a.id_text = '$id'");
        $re4 = mysqli_fetch_row($e4);
        ?> 
        <div class="container margins col-sm-6 col-sm-offset-3" style="background-color: #f2f2f2;">
        <hr> 
            <label class="col-sm-12" style="white-space: nowrap; text-align: center;">Pojazd nr 2</label> <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" style="white-space: nowrap;" for="marka2">Marka</label>
                        <input type="text" class="form-control" id="marka2" name="marka2" value="<?php echo $re4['0']; ?>" disabled>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" style="white-space: nowrap;" for="model2">Model</label>
                        <input type="text" class="form-control" id="model2" name="model2" value="<?php echo $re4['1']; ?>" disabled>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="rok2" style="white-space: nowrap;">Rok</label>
                        <input type="number" class="form-control" id="rok2" name="rok2" value="<?php echo $re4['2']; ?>" required maxlength=4>
                        <hr>
                    </div> <br>
                </div> 
            </div>
        </div>
        <?php    
        }
        if($type == 'CarBattle')
        {
        $e5 = mysqli_query($link, "select aa.silnik, aa.poj, aa.moc, aa.acc, aa.vmax, aa.spalanie, aa.gears, aa.naped, aa.cena from article a, auto_art aa where aa.id_opt = a.id_auto2 and a.id_text = '$id'");
        $re5 = mysqli_fetch_row($e5);
        ?>
            <div class="container col-sm-6 col-sm-offset-3" style="background-color: #f2f2f2; margin-top:20px;">
            <hr>
                <label class="col-sm-12" style="white-space: nowrap; text-align: center;">Dane techniczne - pojazd 2</label> <br>
            <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="silnik2" style="white-space: nowrap;">Silnik</label>
                        <input type="text" class="form-control" id="silnik2" name="silnik2" value="<?php echo $re5['0']; ?>" required maxlength=20> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="poj2" style="white-space: nowrap;">Pojemność silnika</label>
                        <input type="number" class="form-control" id="poj2" name="poj2" value="<?php echo $re5['1']; ?>" required maxlength=4> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="bhp2" style="white-space: nowrap;">Moc silnika</label>
                        <input type="number" class="form-control" id="bhp2" name="bhp2" value="<?php echo $re5['2']; ?>" required maxlength=4> 
                    </div> <br>
                </div> 
            </div>  <br> <br> 
            <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="acc2" style="white-space: nowrap;">Przyspieszenie</label>
                        <input type="number" class="form-control" id="acc2" name="acc2" value="<?php echo $re5['3']; ?>" required maxlength=3> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="vmax2" style="white-space: nowrap;">V-max</label>
                        <input type="number" class="form-control" id="vmax2" name="vmax2" value="<?php echo $re5['4']; ?>" required maxlength=3> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="spalanie2" style="white-space: nowrap;">Spalanie</label>
                        <input type="number" class="form-control" id="spalanie2" name="spalanie2" value="<?php echo $re5['5']; ?>" required maxlength=3> 
                    </div> <br>
                </div> 
            </div>  <br> <br>
            <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="skrzynia2" style="white-space: nowrap;">Skrzynia biegów</label>
                        <input type="text" class="form-control" id="skrzynia2" name="skrzynia2" value="<?php echo $re5['6']; ?>" required maxlength=20> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="naped2" style="white-space: nowrap;">Napęd</label>
                        <input type="text" class="form-control" id="naped2" name="naped2" value="<?php echo $re5['7']; ?>" required maxlength=20> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="cena2" style="white-space: nowrap;">Cena</label>
                        <input type="number" class="form-control" id="cena2" name="cena2" value="<?php echo $re5['8']; ?>" required maxlength=11>
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
                    <img id="previmg" src="res/<?php echo $re['3']; ?>"/> <br> 
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
            <button type="submit" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-check"></span>  Zapisz</button>
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
    
</script>