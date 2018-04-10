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
    $sel = mysqli_query($link, "select id_option from car where id_car = '$id'");
    $rsel = mysqli_fetch_row($sel);
    $sql=mysqli_query($link, "update options set views = views + 1 where id_option = '$rsel[0]'");
    $getcar = mysqli_query($link, "SELECT date(c.date_add) as data, m.name as marka, mm.name as model, o.prod_date, p.type as paliwo, o.mileage, o.netto, o.price, o.negotiable, o.country, o.damaged, o.oc, o.reg, o.vat, o.leasing, o.engine, o.bHP, g.type as gears, o.status, o.foto, d.type, t.typename, o.color, o.opis, o.firstowner, o.aso, o.noacc, o.postcode, o.city, o.phone, u.mail, o.id_option, o.views FROM car c, car_make m, car_model mm, fuel p, gearbox g, options o, drive d, type t, user u WHERE c.id_option = o.id_option and p.id_pal = o.id_pal and c.id_m = m.id_m and c.id_mm = mm.id_mm and o.id_gearbox = g.id_gearbox and o.id_drive = d.id_drive and o.id_type = t.id_type and u.id_user = c.id_user and c.id_car = $id");
    $row = mysqli_fetch_row($getcar);
    $kon = mysqli_query($link, "SELECT count(r.id_kon), r.n_owner FROM rozmowa r, car c WHERE c.id_car = r.id_car and r.id_car = '$id'");
    $rkon = mysqli_fetch_row($kon);
    $damaged;
    if($row['10'] == '0')
        $damaged = "Nie";
    else
        $damaged = "Tak";
    $stan;
    if($row['18'] == '0')
        $stan = "Używany";
    else
        $stan = "Nowy";
    $oc;
    if($row['11'] == '0')
        $oc = "Nie";
    else
        $oc = "Tak";
    $reg;
    if($row['12'] == '0')
        $reg = "NIe";
    else
        $reg = "Tak";
    $fo;
    if($row['24'] == '0')
        $fo = "NIe";
    else
        $fo = "Tak";
    $aso;
    if($row['25'] == '0')
        $aso = "NIe";
    else
        $aso = "Tak";
    $noa;
    if($row['26'] == '0')
        $noa = "NIe";
    else
        $noa = "Tak";
    $marka = $row['1'];
    $model = $row['2'];
    $rok = $row['3'];
    $pic = mysqli_query($link, "select name from fotki where id_car = '$id'");
    $select = mysqli_query($link, "SELECT a.id_text, a.topic, a.foto FROM article a, auto_art aa, car_make m, car_model mm WHERE m.id_m = aa.id_m and mm.id_mm = aa.id_mm and (aa.id_opt = a.id_auto1 or aa.id_opt = a.id_auto2) and m.name = '$marka' and mm.name = '$model' and if(a.id_cat = 4, aa.rok <= $rok and aa.rokdo >= $rok, aa.rok >= ($rok - 2) and aa.rok <= ($rok +2)) order by a.data");
?>
<!DOCTYPE html>
<head lang="en">
    <title> RCS/<?php echo $row['1'];  echo " "; echo $row['2'];?> </title>
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
        .slider-size
        {
            height: 40%;
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
        .btn:hover
        {
            background-color: #00cccc;
            border-color: #00cccc;
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
        @media (max-width: 768px) 
        {
            .one 
            {
                text-align: center;
            }
        }
        @media (min-width: 768px) 
        {
            .one 
            {
                text-align: right;
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
    <div class="col-sm-12 margins">
       
        <div class="col-sm-5 col-sm-offset-2 carousel slide" id="myCarousel" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <a target="_blank" href="res/<?php echo $row['19']; ?>"> <div style="background:url(res/<?php echo $row['19']; ?>) center center; background-size:cover;" class="slider-size"> </div> </a>
                    </div>
                    <?php
                    while($rpp = mysqli_fetch_array($pic, MYSQLI_ASSOC))
                    { 
                    ?>
                        <div class="item">
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
        <div class="col-sm-4 one">
            <p style="font-size: 50px"> <?php echo $row['1'];  echo " "; echo $row['2'];?> </p>
            <h1 style="color: red;"> <?php echo $row['7']; echo " PLN" ?> </h1>
            <?php
                if($row['6'] == '0')
                {
                    ?>
                    <h4> <?php echo "Brutto"; ?> </h4>
                    <?php
                }
                else
                {
                    ?>
                    <h4> <?php echo "Netto"; ?> </h4>
                    <?php
                }
                if($row['8'] == '1')
                {
                    ?>
                    <h4> <?php echo "Do negocjacji"; ?> </h4>
                    <?php
                }
                if($row['13'] == '1')
                {
                    ?>
                    <h4> <?php echo "Faktura VAT"; ?> </h4>
                    <?php
                }
                if($row['14'] == '1')
                {
                    ?>
                    <h4> <?php echo "Możliwy leasing"; ?> </h4>
                    <?php
                }
            ?>  
             <hr>
            <?php
            if($pro == 0)
            {
            ?>
                <button type="button" class="btn btn-primary btn-lg" style="width: 220px;"> <?php echo "Tel. "; echo $row['29']; ?> </button> <br> <br>
                <a target="_blank" href="https://www.google.pl/maps/place/<?php if($row['27'] != null){ echo $row['27']; echo'+'; } echo $row['28']; ?>" role="button" class="btn btn-primary btn-lg" style="width: 220px;"> <?php echo "Pokaż na mapie "; ?> <span class="glyphicon glyphicon-map-marker"></span> </a> <br> <br>
                <button data-toggle='tooltip' title='Musisz być zalogowany' type="button" class="btn btn-primary btn-lg" style="width: 220px;"> <?php echo "Zostaw wiadomość  "; ?> <span class="glyphicon glyphicon-envelope"></span> </button> <br> <br>
                <button data-toggle='tooltip' title='Musisz być zalogowany' type="button" class="btn btn-primary btn-lg" style="width: 220px;"> <?php echo "Do obserwowanych "; ?> <span class="glyphicon glyphicon-star-empty"></span> </button> <br>
                
            <?php
            }
            else if($row['30'] == $login_session)
            {
                if($rkon[0] != 0)
                {
                ?>
                    <button type="button" class="btn btn-primary btn-lg" style="width: 220px;" data-toggle='modal' data-target="#show_kon"> <?php echo "Wiadomości  "; ?> <span class='glyphicon glyphicon-envelope <?php if($rkon[1] == 1) echo "flashy"; ?>'></span>  </button> <br> <br>
                    <div id="show_kon" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                <?php
                                    $u = mysqli_query($link, "SELECT id_user FROM user WHERE mail = '$login_session'");
                                    $ru = mysqli_fetch_row($u);
                                    $idusr = $ru[0];
                                    $w = mysqli_query($link, "SELECT r.id_kon, u.name, count(w.id_wia) as ile, max(w.data) as dd, r.n_buyer FROM user u, wiadomosc w, rozmowa r WHERE r.id_kon = w.id_kon and r.id_user = u.id_user and r.id_car = '$id' order by dd desc");
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
                                        $name = $rw['name'];
                                        $ile = $rw['ile'];
                                        $dd = $rw['dd'];
                                        $new = $rw['nowe'];
                                        ?>
                                        <tr onclick="window.location='rozmowa.php?id=<?php echo $rw['id_kon']; ?>';">
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
                    <button type="button" class="btn btn-primary btn-lg" data-toggle='tooltip' title='Brak wiadomości' style="width: 220px;"> <?php echo "Wiadomości  "; ?> <span class="glyphicon glyphicon-envelope"></span> </button> <br> <br>
                    <?php
                }
                ?>
                <a href="edytuj.php?id=<?php echo $row['31']; ?>" role="button" class="btn btn-primary btn-lg" style="width: 220px;"> <?php echo "Edytuj  "; ?> <span class="glyphicon glyphicon-cog"></span> </a> <br> <br>
                <a href="usun.php?id=<?php echo $row['31']; ?>" role="button" class="btn btn-primary btn-lg" style="width: 220px;"> <?php echo "Usuń  "; ?> <span class="glyphicon glyphicon-trash"></span> </a> <br>
            <?php
            }
            else if($row['30'] != $login_session)
            {
            ?>
                <button type="button" class="btn btn-primary btn-lg" style="width: 220px;"> <?php echo "Tel. "; echo $row['29']; ?> </button> <br> <br>
                <a target="_blank" href="https://www.google.pl/maps/place/<?php if($row['27'] != null){ echo $row['27']; echo'+'; } echo $row['28']; ?>" role="button" class="btn btn-primary btn-lg" style="width: 220px;"> <?php echo "Pokaż na mapie "; ?> <span class="glyphicon glyphicon-map-marker"></span> </a> <br> <br>
                <?php
                $m = mysqli_query($link, "SELECT r.id_kon, r.n_owner FROM rozmowa r, car c, user u WHERE r.id_car = c.id_car and r.id_user = u.id_user and r.id_car = '$id' and u.mail = '$login_session'");
                $rm = mysqli_fetch_row($m);
                $idkon = $rm['0'];
                if($rm[0] != NULL)
                {
                ?>
                    <a href="rozmowa.php?id=<?php echo $idkon; ?>" role="button" class="btn btn-primary btn-lg" style="width: 220px;"> <?php echo "Wiadomości  "; ?> <span class="glyphicon glyphicon-envelope"></span> </a> <br> <br>
                <?php
                }
                else
                {
                ?>
                    <button type="button" class="btn btn-primary btn-lg" style="width: 220px;" data-toggle='modal' data-target="#new_txt"> <?php echo "Wyślij wiadomość  "; ?> <span class='glyphicon glyphicon-envelope'></span> </button> <br> <br>
                    <div id="new_txt" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h3> Nowa wiadomość </h3>
                                    <textarea class="form-control" style="resize: none; overflow: hidden;" name="nowe" id="nowe" cols="100" onkeyup="auto_grow(this)" maxlength="232" required></textarea>
                                </div>
                                <div class="modal-footer">
                                    <a href = "#" id="slink" onclick="sendlink(<?php echo $id; ?>);" role="button" class="btn btn-danger">Wyślij</a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                $checkwatch = mysqli_query($link, "SELECT w.id_user FROM watchlist w, user u WHERE u.id_user = w.id_user and u.mail = '$login_session' and w.id_car = '$id'");
                if($checkwatch->num_rows === 0)
                {
                    ?>
                    <a href="watchlist.php?id=<?php echo $id; ?>" role="button" class="btn btn-primary btn-lg" style="width: 220px;"> <?php echo "Do obserwowanych "; ?> <span class="glyphicon glyphicon-star-empty"></span> </a> <br>
                    <?php
                }
                else
                {
                    ?>
                    <button type="button" class="btn btn-primary btn-lg" style="width: 220px;"> <?php echo "Obserwujesz "; ?> <span class="glyphicon glyphicon-star"></span> </button> <br>
                    <?php
                }
            }       
            ?>
        </div>
    </div> <br> <br>
    <div class="container col-sm-10 col-sm-offset-1" style="background-color: #f2f2f2; margin-top:30px; ">
        
        <div>
        <h4 class="col-sm-2 col-sm-offset-2" style="white-space: nowrap;"> <b> Typ: </b> <?php echo $row['21']; ?> </h4>
        <h4 class="col-sm-2 col-sm-offset-3" style="white-space: nowrap;"> <b> Stan: </b> <?php echo $stan; ?> </h4>
        <h4 class="col-sm-2 col-sm-offset-2" style="white-space: nowrap;"> <b> Rok produkcji: </b> <?php echo $row['3']; ?> </h4>
        <h4 class="col-sm-2 col-sm-offset-3" style="white-space: nowrap;"> <b> Kraj pochodzenia: </b> <?php echo $row['9']; ?> </h4>
        <h4 class="col-sm-2 col-sm-offset-2" style="white-space: nowrap;"> <b> Przebieg: </b> <?php echo $row['5']; ?> km </h4>
        <h4 class="col-sm-2 col-sm-offset-3" style="white-space: nowrap;"> <b> Uszkodzony: </b> <?php echo $damaged; ?> </h4>
        <h4 class="col-sm-2 col-sm-offset-2" style="white-space: nowrap;"> <b> Rodzaj paliwa: </b> <?php echo $row['4']; ?> </h4>
        <h4 class="col-sm-2 col-sm-offset-3" style="white-space: nowrap;"> <b> Skrzynia biegów: </b> <?php echo $row['17']; ?> </h4>
        <h4 class="col-sm-2 col-sm-offset-2" style="white-space: nowrap;"> <b> Pojemność silnika: </b> <?php echo $row['15']; ?> cm³ </h4>
        <h4 class="col-sm-2 col-sm-offset-3" style="white-space: nowrap;"> <b> Moc: </b> <?php echo $row['16']; ?> KM </h4>
        <h4 class="col-sm-2 col-sm-offset-2" style="white-space: nowrap;"> <b> Napęd: </b> <?php echo $row['20']; ?> </h4>
        <h4 class="col-sm-2 col-sm-offset-3" style="white-space: nowrap;"> <b> Kolor: </b> <?php echo $row['22']; ?> </h4>
        <h4 class="col-sm-2 col-sm-offset-2" style="white-space: nowrap;"> <b> Ubezpieczony: </b> <?php echo $oc; ?> </h4>
        <h4 class="col-sm-2 col-sm-offset-3" style="white-space: nowrap;"> <b> Zarejestrowany: </b> <?php echo $reg; ?> </h4>
        <h4 class="col-sm-2 col-sm-offset-2" style="white-space: nowrap;"> <b> Pierwszy właściciel: </b> <?php echo $fo; ?> </h4>
        <h4 class="col-sm-2 col-sm-offset-3" style="white-space: nowrap;"> <b> Serwisowany w ASO: </b> <?php echo $aso; ?> </h4>
        <h4 class="col-sm-2 col-sm-offset-2" style="white-space: nowrap;"> <b> Bezwypadkowy: </b> <?php echo $noa; ?> </h4>
        <h4 class="col-sm-2 col-sm-offset-3" style="white-space: nowrap;"> <b> Data dodania: </b> <?php echo $row['0']; ?> </h4>
        <h4 class="col-sm-2 col-sm-offset-2" style="white-space: nowrap;"> <b> Miasto: </b> <?php echo $row['28']; ?> </h4>
        <h4 class="col-sm-2 col-sm-offset-3" style="white-space: nowrap;"> <b> Wyświetleń: </b> <?php echo $row['32']; ?> </h4>
            <hr>
        </div>
    </div>
    <div class="col-sm-7 col-sm-offset-1" style=" margin-top:30px;">
        <h2 class="col-sm-offset-1"> Opis pojazdu </h2>
        <h3 style="white-space: pre-wrap;"> <?php echo $row['23']; ?> </h3>
    </div>
    <?php
    $i = 0;
        if($select->num_rows === 0){}
        else
        {
        ?>
            <div class="col-sm-8 col-sm-offset-1 col-sx-12">
                <br>
                <h2 class="col-sm-offset-1"> Powiązane artykuły </h2> <br>
                <?php
                while(($rselect = mysqli_fetch_array($select, MYSQLI_ASSOC)) && $i < 5)
                {
                ?>  
                    <div class="gallery" data-toggle="tooltip" title="<?php echo $rselect['topic']; ?>">
                        <a target="_blank" href="text.php?id=<?php echo $rselect['id_text']; ?>"> <img src="res/<?php echo $rselect['foto']; ?>" alt="Car Photo"> </a>
                        <div class="desc">
                            <p style="width:150px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"> <?php echo $rselect['topic']; ?> </p>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
                if($select->num_rows > 5)
                {
                ?>
                    <div class="gallery">
                        <a target="_blank" href="artykuly.php?marka=<?php echo $marka; ?>&model=<?php echo $model; ?>&rok=<?php echo $rok; ?>"> <img src="res/pluss.png" alt="Show More"> </a>
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
        ?>
    <br> <br>
</body>
<script>
(function blink() { 
  $('.flashy').fadeOut(500).fadeIn(500, blink); 
})();
    $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
            });
    
function sendlink(a)
{
    var txt = document.getElementById("nowe").value;  
    var hrf="newtxt.php?ic="+a+"&idu=<?php echo $id_user; ?>&txt="+txt+"&f=y";
    document.getElementById("slink").href=hrf;
}
</script>