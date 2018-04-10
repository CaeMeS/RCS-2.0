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
    $q = mysqli_query($link, "select city, phone, post from user where mail = '$login_session'");
    $row = mysqli_fetch_row($q);


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
        $photo = round(microtime(true)) . '.' . end($temp);
        move_uploaded_file($file_tmp,"res/".$photo);
        chmod("res/".$file_name, 0777);
        chown("res/".$file_name, root);
                              
        $marka = mysqli_real_escape_string($link, $_POST['marka']);
        $model = mysqli_real_escape_string($link, $_POST['model']);
        $x1 = mysqli_query($link, "select id_m from car_make where name = '$marka'");
        $y1 = mysqli_fetch_row($x1);
        $x2 = mysqli_query($link, "select id_mm from car_model where name = '$model'");
        $y2 = mysqli_fetch_row($x2);
        $x3 = mysqli_query($link, "select id_user from user where mail = '$login_session'");
        $y3 = mysqli_fetch_row($x3);
        
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
        $foto = $photo;

            $qo=mysqli_query($link, "insert into options (prod_date, id_pal, mileage, netto, price, negotiable, country, damaged, oc, reg, vat, leasing, engine, bHP, id_gearbox, id_drive, color, id_type, status, opis, firstowner, aso, noacc, foto, postcode, city, phone) values ('$rok', '$y5[0]', '$przebieg', '$netto', '$price', '$negotiable', '$country', '$damaged', '$OC', '$reg', '$vat', '$leasing', '$engine', '$moc', '$y6[0]', '$y7[0]', '$color', '$y4[0]', '$stan', '$opis', '$owner', '$ASO', '$noacc', '$foto', '$postcode', '$city', '$phone');");
            $optid = mysqli_insert_id($link);
            $qi=mysqli_query($link, "insert into car (id_user, id_option, id_m, id_mm) values ('$y3[0]', '$optid', '$y1[0]', '$y2[0]');");
            $idcar = mysqli_insert_id($link);
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
            if (strlen (mysqli_error($link)) > 0) 
                {
                    echo mysqli_error($link);
                } 
                else
                {            
                    header("location: auta.php");
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
    <title> Dodawanie ogłoszenia </title>
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
        <h2> <b> Dodaj nowe ogłoszenie</b></h2>
    </div>
    <form enctype="multipart/form-data" action="" method="post">
    <div class="container margins col-sm-6 col-sm-offset-3" style="background-color: #f2f2f2;">
        <hr>     
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" style="white-space: nowrap;" for="marka">Marka</label>
                        <select class="form-control" name="marka" id="marka" required>
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
                        <label class="col-sm-12" style="white-space: nowrap;" for="model">Model</label>
                        <select class='form-control' name='model' id='model' disabled required>
                            <option value='' disabled selected>Model</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" style="white-space: nowrap;" for="status">Stan</label>
                        <select class='form-control' id='status' name='status' required>
                            <option value="" disabled selected></option>
                            <option value="1">Nowe</option>
                            <option value="0">Używane</option>
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
                        <select class="form-control" id="typ" name="typ" required>
                        <option value="" disabled selected></option>
                        <?php
                        $q4 = mysqli_query($link, "select typename from type");
                        while($row4 = mysqli_fetch_array($q4))
                        {
                            echo "<option value='".$row4['typename']."'> ".$row4['typename']." </option>";
                        }
                        ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" style="white-space: nowrap;" for="damaged">Uszkodzony</label>
                        <select class='form-control' id='damaged' name='damaged' required>
                            <option value="" disabled selected></option>
                            <option value="1">Tak</option>
                            <option value="0">Nie</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" style="white-space: nowrap;" for="rok">Rok produkcji</label>
                        <input type="number" class="form-control" id="rok" name="rok" required maxlength=4>
                    </div>
                </div>
            </div> <br> <br>
            <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="paliwo" style="white-space: nowrap;">Paliwo</label>
                        <select class="form-control" id="paliwo" name="paliwo" required>
                        <option value="" disabled selected></option>
                        <?php
                        $q3 = mysqli_query($link, "select type from fuel");
                        while($row3 = mysqli_fetch_array($q3))
                        {
                            echo "<option value='".$row3['type']."'> ".$row3['type']." </option>";
                        }
                        ?>
                        </select> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" style="white-space: nowrap;" for="gearbox">Skrzynia biegów</label>
                        <select class="form-control" id="gearbox" name="gearbox" required>
                        <option value="" disabled selected></option>
                        <?php
                        $q5 = mysqli_query($link, "select type from gearbox");
                        while($row5 = mysqli_fetch_array($q5))
                        {
                            echo "<option value='".$row5['type']."'> ".$row5['type']." </option>";
                        }
                        ?>
                        </select> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="przebieg" style="white-space: nowrap;">Przebieg - km</label>
                        <input type="number" class="form-control" id="przebieg" name="przebieg" required maxlength=10>
                    </div>
                </div> 
            </div> <br> <br>
            <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" style="white-space: nowrap;" for="drive">Napęd</label>
                        <select class="form-control" id="drive" name="drive" required>
                        <option value="" disabled selected></option>
                        <?php
                        $q6 = mysqli_query($link, "select type from drive");
                        while($row6 = mysqli_fetch_array($q6))
                        {
                            echo "<option value='".$row6['type']."'> ".$row6['type']." </option>";
                        }
                        ?>
                        </select> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="engine" style="white-space: nowrap;">Poj. silnika - cm³</label>
                        <input type="number" class="form-control" id="engine" name="engine" required maxlength=5>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="moc" style="white-space: nowrap;">Moc silnika - KM</label>
                        <input type="number" class="form-control" id="moc" name="moc" required maxlength=5>
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
                        <input type="number" class="form-control" id="price" name="price" required maxlength=10> 
                    </div>
                    <div class="col-sm-4">
                        <label class="form-check-label" style="white-space: nowrap;">
                            <input type="checkbox" class="form-check-input" name="netto"> Cena netto
                        </label> <br>
                        <label class="form-check-label" style="white-space: nowrap;">
                            <input type="checkbox" class="form-check-input" name="negotiable"> Do negocjacji
                        </label> <br>
                        <label class="form-check-label" style="white-space: nowrap;">
                            <input type="checkbox" class="form-check-input" name="reg"> Zarejestrowany
                        </label>
                    </div>
                    <div class="col-sm-4">
                        <label class="form-check-label" style="white-space: nowrap;">
                            <input type="checkbox" class="form-check-input" name="vat"> Faktura VAT
                        </label> <br>
                        <label class="form-check-label" style="white-space: nowrap;">
                            <input type="checkbox" class="form-check-input" name="leasing"> Leasing
                        </label> <br>
                        <label class="form-check-label" style="white-space: nowrap;">
                            <input type="checkbox" class="form-check-input" name="OC"> Ubezpieczony
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
                        <input type="text" class="form-control" id="color" name="color" required maxlength=20> 
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="country" style="white-space: nowrap;">Kraj pochodzenia</label>
                        <input type="text" class="form-control" id="country" name="country" required maxlength=20> 
                    </div>
                    <div class="col-sm-4">
                        <label class="form-check-label" style="white-space: nowrap;">
                            <input type="checkbox" class="form-check-input" name="owner"> Pierwszy właściciel
                        </label> <br>
                        <label class="form-check-label" style="white-space: nowrap;">
                            <input type="checkbox" class="form-check-input" name="ASO"> Serwisowany w ASO
                        </label> <br>
                        <label class="form-check-label" style="white-space: nowrap;">
                            <input type="checkbox" class="form-check-input" name="noacc"> Bezwypadkowy
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
                    <textarea class="form-control" style="resize: none;" name="opis" id="opis" cols="100" rows="10" maxlength="4096" required></textarea>
                    <hr>
                </div>
                <hr>
                
            </div>   
    </div>
    <div class="container col-sm-6 col-sm-offset-3" style="background-color: #f2f2f2; margin-top:20px;">
        <hr>
            <div class="form-group">
                <div class="col-sm-12">
                    <h3 style="text-align: center"> Dodaj zdjęcię główne</h3> <br>
                </div>
                <div style="text-align: center">                   
                    <input class="inputfile" name="file" type="file" id="file" required onchange="preview_image(event)">
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
    <div class="container col-sm-6 col-sm-offset-3" style="background-color: #f2f2f2; margin-top:20px;">
        <hr>
            <br>
            <div class="form-group">
                <div class="row col-sm-12">
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="city" style="white-space: nowrap;">Miasto</label>
                        <input type="text" class="form-control" id="city" name="city" required value="<?php echo htmlspecialchars($row[0]); ?>"  maxlength=30>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="post" style="white-space: nowrap;">Kod pocztowy</label>
                        <input type="text" class="form-control" id="postcode" name="postcode" required value="<?php echo htmlspecialchars($row[2]); ?>" maxlength=10>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-12" for="moc" style="white-space: nowrap;">Telefon</label>
                        <input type="number" class="form-control" id="phone" name="phone" required value="<?php echo htmlspecialchars($row[1]); ?>"  maxlength=10>
                        <hr>
                    </div>
                </div> 
            </div>   
    </div> <br>
    <div class="container col-sm-6 col-sm-offset-3" style="margin-top:20px;">
        <div class="form-group col-sm-3 pull-right">
            <button type="submit" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-check"></span>  Dodaj</button>
        </div>
    </div>
    </form>
</body>