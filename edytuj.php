<?php
    include("DBconn.php");
    include("navbar.php");
    include("verify.php");
    $id = mysqli_real_escape_string($link , $_GET['id']);
    $q = mysqli_query($link, "SELECT u.mail FROM user u, car c WHERE u.id_user = c.id_user and c.id_option = '$id'");
    $row = mysqli_fetch_row($q);  
    $qca = mysqli_query($link, "SELECT id_car FROM car WHERE id_option = '$id'");
    $rqca = mysqli_fetch_row($qca);
    $idcar = $rqca['0'];
    $pro = 0;
    if(!isset($_SESSION['user_mail']) || $login_session != $row['0'])
    {
        header("Location: index.php");
    }
    else
       $pro = 1;
    $q2 = mysqli_query($link, "SELECT m.name as marka, mm.name as model, o.status, t.typename, o.damaged, o.prod_date, p.type as paliwo, g.type as gears, o.mileage, d.type as drive, o.engine, o.bHP, o.price, o.netto, o.negotiable, o.reg, o.vat, o.leasing, o.oc, o.color, o.country, o.firstowner, o.aso, o.noacc, o.opis, o.foto, o.city, o.postcode, o.phone FROM car c, car_make m, car_model mm, options o, drive d, fuel p, type t, gearbox g WHERE c.id_option = o.id_option and p.id_pal = o.id_pal and c.id_m = m.id_m and c.id_mm = mm.id_mm and o.id_gearbox = g.id_gearbox and o.id_drive = d.id_drive and o.id_type = t.id_type and c.id_option = '$id'");
    $r = mysqli_fetch_row($q2);

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $foto = $r['25'];
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
        $photo = round(microtime(true)) . '.' . end($temp);
        move_uploaded_file($file_tmp,"res/".$photo);
        chmod("res/".$file_name, 0777);
        chown("res/".$file_name, root);
        $foto = $photo;
        }}
        
        
        $stan = mysqli_real_escape_string($link, $_POST['status']);
        $typ = mysqli_real_escape_string($link, $_POST['typ']);
        $x4 = mysqli_query($link, "select id_type from type where typename = '$typ'");
        $y4 = mysqli_fetch_row($x4);     
        $damaged = mysqli_real_escape_string($link, $_POST['damaged']);
        $rok = mysqli_real_escape_string($link, $_POST['rok']);
        $paliwo = mysqli_real_escape_string($link, $_POST['paliwo']);
        $x5 = mysqli_query($link, "select id_pal from fuel where type = '$paliwo'");
        $y5 = mysqli_fetch_row($x5);       
        $gearbox = mysqli_real_escape_string($link, $_POST['gearbox']);
        $x6 = mysqli_query($link, "select id_gearbox from gearbox where type = '$gearbox'");
        $y6 = mysqli_fetch_row($x6);       
        $przebieg = mysqli_real_escape_string($link, $_POST['przebieg']);
        $drive = mysqli_real_escape_string($link, $_POST['drive']);
        $x7 = mysqli_query($link, "select id_drive from drive where type = '$drive'");
        $y7 = mysqli_fetch_row($x7);     
        $engine = mysqli_real_escape_string($link, $_POST['engine']);
        $moc = mysqli_real_escape_string($link, $_POST['moc']);
        $price = mysqli_real_escape_string($link, $_POST['price']);
        $opis = mysqli_real_escape_string($link, $_POST['opis']);
        if(isset($_POST['netto']))
            $netto = 1;
        else
            $netto = 0;
        if(isset($_POST['negotiable']))
            $negotiable = 1;
        else
            $negotiable = 0;
        if(isset($_POST['reg']))
            $reg = 1;
        else
            $reg = 0;
        if(isset($_POST['vat']))
            $vat = 1;
        else
            $vat = 0;
        if(isset($_POST['leasing']))
            $leasing = 1;
        else
            $leasing = 0;
        if(isset($_POST['OC']))
            $OC = 1;
        else
            $OC = 0;
        $color = mysqli_real_escape_string($link, $_POST['color']);
        $country = mysqli_real_escape_string($link, $_POST['country']);
        if(isset($_POST['owner']))
            $owner = 1;
        else
            $owner = 0;
        if(isset($_POST['ASO']))
            $ASO = 1;
        else
            $ASO = 0;
        if(isset($_POST['noacc']))
            $noacc = 1;
        else
            $noacc = 0;
        $postcode = mysqli_real_escape_string($link, $_POST['postcode']);
        $city = mysqli_real_escape_string($link, $_POST['city']);
        $phone = mysqli_real_escape_string($link, $_POST['phone']);
        
        $qo=mysqli_query($link, "UPDATE options SET prod_date = '$rok', id_pal = '$y5[0]', mileage = '$przebieg', netto = '$netto', price = '$price', negotiable = '$negotiable', country = '$country', damaged = '$damaged', oc = '$OC', reg = '$reg', vat = '$vat', leasing = '$leasing', engine = '$engine', bHP = '$moc', id_gearbox = '$y6[0]', id_drive = '$y7[0]', color = '$color', id_type = '$y4[0]', status = '$stan', opis = '$opis', firstowner = '$owner', aso = '$ASO', noacc = '$noacc', foto = '$foto', postcode = '$postcode', city = '$city', phone = '$phone' WHERE id_option = '$id'");
        if(isset($_FILES['files']))
        {
            $dphotos = mysqli_query($link, "DELETE FROM fotki WHERE id_car = '$idcar'");
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
                    $i0=mysqli_query($link, "insert into fotki (name, id_car) values ('$fotka', '$idcar');");
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
    else
    {
        print_r($errors);
    }
?>
<!DOCTYPE html>
<head lang="en">
    <title> Edycja ogłoszenia </title>
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
        
        function auto_grow(element) 
        {
            element.style.height = "5px";
            element.style.height = (element.scrollHeight)+"px";
        }

    </script>
</head>
<body>
    <?php 
        GetNavbar(0, $pro + $spc);
    ?>
    <div style="text-align: center">
        <h2> <b> Edytuj ogłoszenie</b></h2>
    </div>
    <form enctype="multipart/form-data" action="" method="post">
    <div class="container margins col-sm-6 col-sm-offset-3" style="background-color: #f2f2f2;">
        <hr>     
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" style="white-space: nowrap;" for="marka">Marka</label>
                        <input type="text" class="form-control" id="marka" name="marka" value="<?php echo $r['0']; ?>" disabled>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" style="white-space: nowrap;" for="model">Model</label>
                        <input type="text" class="form-control" id="model" name="model" value="<?php echo $r['1']; ?>" disabled>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" style="white-space: nowrap;" for="status">Stan</label>
                        <select class='form-control' id='status' name='status'>
                            <option value="1" <?php if($r['1'] == 1) echo "selected"; ?> >Nowe</option>
                            <option value="0" <?php if($r['1'] == 0) echo "selected"; ?> >Używane</option>
                        </select>
                        <hr>
                    </div>
                </div> 
            </div>
    </div>
    <div class="container col-sm-6 col-sm-offset-3" style="background-color: #f2f2f2; margin-top:20px;">
        <hr>
            <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" style="white-space: nowrap;" for="typ">Typ pojazdu</label>
                        <select class="form-control" id="typ" name="typ">
                        <?php
                        $q4 = mysqli_query($link, "select typename from type");
                        while($row4 = mysqli_fetch_array($q4))
                        {
                            $a = "";
                            if($row4['typename'] == $r['3'])
                                $a = " selected ";
                            echo "<option value='".$row4['typename']."'".$a."> ".$row4['typename']." </option>";
                        }
                        ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" style="white-space: nowrap;" for="damaged">Uszkodzony</label>
                        <select class='form-control' id='damaged' name='damaged'>
                            <option value="1" <?php if($r['4'] == 1) echo "selected"; ?> >Tak</option>
                            <option value="0" <?php if($r['4'] == 0) echo "selected"; ?> >Nie</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" style="white-space: nowrap;" for="rok">Rok produkcji</label>
                        <input type="number" class="form-control" id="rok" name="rok" required maxlength=4 value="<?php echo $r['5']; ?>">
                    </div>
                </div>
            </div> <br> <br>
            <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="paliwo" style="white-space: nowrap;">Paliwo</label>
                        <select class="form-control" id="paliwo" name="paliwo">
                        <?php
                        $q3 = mysqli_query($link, "select type from fuel");
                        while($row3 = mysqli_fetch_array($q3))
                        {
                            $b = "";
                            if($row3['type'] == $r['6'])
                                $b = " selected ";
                            echo "<option value='".$row3['type']."'".$b."> ".$row3['type']." </option>";
                        }
                        ?>
                        </select> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" style="white-space: nowrap;" for="gearbox">Skrzynia biegów</label>
                        <select class="form-control" id="gearbox" name="gearbox">
                        <?php
                        $q5 = mysqli_query($link, "select type from gearbox");
                        while($row5 = mysqli_fetch_array($q5))
                        {
                            $c = "";
                            if($row5['type'] == $r['7'])
                                $c = " selected ";
                            echo "<option value='".$row5['type']."'".$c."> ".$row5['type']." </option>";
                        }
                        ?>
                        </select> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="przebieg" style="white-space: nowrap;">Przebieg - km</label>
                        <input type="number" class="form-control" id="przebieg" name="przebieg" required maxlength=10 value="<?php echo $r['8']; ?>">
                    </div>
                </div> 
            </div> <br> <br>
            <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" style="white-space: nowrap;" for="drive">Napęd</label>
                        <select class="form-control" id="drive" name="drive">
                        <option value="" disabled selected></option>
                        <?php
                        $q6 = mysqli_query($link, "select type from drive");
                        while($row6 = mysqli_fetch_array($q6))
                        {
                            $d = "";
                            if($row6['type'] == $r['9'])
                                $d = " selected ";
                            echo "<option value='".$row6['type']."'".$d."> ".$row6['type']." </option>";
                        }
                        ?>
                        </select> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="engine" style="white-space: nowrap;">Poj. silnika - cm3</label>
                        <input type="number" class="form-control" id="engine" name="engine" required maxlength=5 value="<?php echo $r['10']; ?>">
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="moc" style="white-space: nowrap;">Moc silnika - KM</label>
                        <input type="number" class="form-control" id="moc" name="moc" required maxlength=5 value="<?php echo $r['11']; ?>">
                        <hr>
                    </div> <br>
                </div> 
            </div>   
    </div>
    <div class="container col-sm-6 col-sm-offset-3" style="background-color: #f2f2f2; margin-top:20px;">
        <hr>
            <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="price" style="white-space: nowrap;">Cena - zł</label>
                        <input type="number" class="form-control" id="price" name="price" required maxlength=10 value="<?php echo $r['12']; ?>"> 
                    </div>
                    <div class="col-sm-4">
                        <label class="form-check-label" style="white-space: nowrap;">
                            <input type="checkbox" class="form-check-input" name="netto" <?php if($r['13'] == 1) echo "checked"; ?> > Cena netto
                        </label> <br>
                        <label class="form-check-label" style="white-space: nowrap;">
                            <input type="checkbox" class="form-check-input" name="negotiable" <?php if($r['14'] == 1) echo "checked"; ?> > Do negocjacji
                        </label> <br>
                        <label class="form-check-label" style="white-space: nowrap;">
                            <input type="checkbox" class="form-check-input" name="reg" <?php if($r['15'] == 1) echo "checked"; ?> > Zarejestrowany
                        </label>
                    </div>
                    <div class="col-sm-4">
                        <label class="form-check-label" style="white-space: nowrap;">
                            <input type="checkbox" class="form-check-input" name="vat" <?php if($r['16'] == 1) echo "checked"; ?> > Faktura VAT
                        </label> <br>
                        <label class="form-check-label" style="white-space: nowrap;">
                            <input type="checkbox" class="form-check-input" name="leasing" <?php if($r['17'] == 1) echo "checked"; ?> > Leasing
                        </label> <br>
                        <label class="form-check-label" style="white-space: nowrap;">
                            <input type="checkbox" class="form-check-input" name="OC" <?php if($r['18'] == 1) echo "checked"; ?> > Ubezpieczony
                        </label>
                        <hr>
                    </div> <br>
                </div> 
            </div>   
    </div>
    <div class="container col-sm-6 col-sm-offset-3" style="background-color: #f2f2f2; margin-top:20px;">
        <hr>
            <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="color" style="white-space: nowrap;">Kolor</label>
                        <input type="text" class="form-control" id="color" name="color" required maxlength=20 value="<?php echo $r['19']; ?>"> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="country" style="white-space: nowrap;">Kraj pochodzenia</label>
                        <input type="text" class="form-control" id="country" name="country" required maxlength=20 value="<?php echo $r['20']; ?>"> 
                    </div>
                    <div class="col-sm-4">
                        <label class="form-check-label" style="white-space: nowrap;">
                            <input type="checkbox" class="form-check-input" name="owner" <?php if($r['21'] == 1) echo "checked"; ?> > Pierwszy właściciel
                        </label> <br>
                        <label class="form-check-label" style="white-space: nowrap;">
                            <input type="checkbox" class="form-check-input" name="ASO" <?php if($r['22'] == 1) echo "checked"; ?> > Serwisowany w ASO
                        </label> <br>
                        <label class="form-check-label" style="white-space: nowrap;">
                            <input type="checkbox" class="form-check-input" name="noacc" <?php if($r['23'] == 1) echo "checked"; ?> > Bezwypadkowy
                        </label>
                        <hr>
                    </div> <br>
                </div> 
            </div>   
    </div>
    <div class="container col-sm-6 col-sm-offset-3" style="background-color: #f2f2f2; margin-top:20px;">
        <hr>
            <div class="form-group">
                <div class="col-sm-12">
                    <label class="col-sm-12" for="desc" style="white-space: nowrap;">Opis</label>
                    <textarea class="form-control" style="resize: none; overflow: hidden;" name="opis" id="opis" cols="100" onkeyup="auto_grow(this)" maxlength="4096"> <?php echo $r['24']; ?> </textarea>
                    <hr>
                </div>
                <hr>
                
            </div>   
    </div>
    <div class="container col-sm-6 col-sm-offset-3" style="background-color: #f2f2f2; margin-top:20px;">
        <hr>
            <div class="form-group">
                <div class="col-sm-12">
                    <h3 style="text-align: center"> Zdjęcie główne</h3> <br>
                </div>
                <div style="text-align: center">                   
                    <input class="inputfile" name="file" type="file" id="file" onchange="preview_image(event)">
                    <label class="lbl" for="file"> <span class='glyphicon glyphicon-cloud-upload'></span> Wybierz główne</label> <br>
                </div>
                <div style="text-align: center">
                    <img id="previmg" src="res/<?php echo $r['25']; ?>" /> <br>
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
    <div class="container col-sm-6 col-sm-offset-3" style="background-color: #f2f2f2; margin-top:20px;">
        <hr>
            <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="city" style="white-space: nowrap;">Miasto</label>
                        <input type="text" class="form-control" id="city" name="city" required value="<?php echo $r['26']; ?>" maxlength=30>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="post" style="white-space: nowrap;">Kod pocztowy</label>
                        <input type="text" class="form-control" id="postcode" name="postcode" required maxlength=10 value="<?php echo $r['27']; ?>">
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="moc" style="white-space: nowrap;">Telefon</label>
                        <input type="number" class="form-control" id="phone" name="phone" required value="<?php echo $r['28']; ?>" maxlength=10>
                        <hr>
                    </div>
                </div> 
            </div>   
    </div> <br>
    <div class="container col-sm-6 col-sm-offset-3" style="margin-top:20px;">
        <div class="form-group col-sm-3 pull-right">
            <button type="submit" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-check"></span>  Zapisz</button>
        </div>
    </div>
    </form>
</body>