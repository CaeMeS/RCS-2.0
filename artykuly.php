<?php
    include("DBconn.php");
    include("navbar.php");
    include("verify.php");
    $cat = mysqli_real_escape_string($link , $_GET['cat']);
    $m = mysqli_real_escape_string($link , $_GET['marka']);
    $mm = mysqli_real_escape_string($link , $_GET['model']);
    $rok = mysqli_real_escape_string($link , $_GET['rok']);
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
    <title> Artykuły </title>
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
        a:hover
        {
            text-decoration: none;
            color: #00cccc;
        }
        .btn:hover
        {
            background-color: #00cccc;
            border-color: #00cccc;
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
    <script>
        $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <?php 
        GetNavbar(2, $pro + $spc);
    ?>
    <div class="btn-group btn-group-justified">
        <a href="artykuly.php" class="btn btn-warning">Wszystkie</a>
        <a href="artykuly.php?cat=News" class="btn btn-primary<?php if($cat == 'News') echo ' active'; ?>">Newsy</a>
        <a href="artykuly.php?cat=Test" class="btn btn-primary<?php if($cat == 'Test') echo ' active'; ?>">Testy</a>
        <a href="artykuly.php?cat=CarBattle" class="btn btn-primary<?php if($cat == 'CarBattle') echo ' active'; ?>">CarBattle</a>
        <a href="artykuly.php?cat=Porada" class="btn btn-primary<?php if($cat == 'Porada') echo ' active'; ?>">Porady</a>
        <a href="artykuly.php?cat=Historia" class="btn btn-primary<?php if($cat == 'Historia') echo ' active'; ?>">Historia</a>
    </div>
    <?php
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $szukaj = mysqli_real_escape_string($link, $_POST['search']);
                $words = explode(' ', $szukaj);
                $art = "SELECT id_text, topic, intro, foto, name, date(data) as dd FROM article, category WHERE article.id_cat = category.id_cat";
                foreach ($words as $word)
                    $art .= ' and concat(topic,intro) LIKE "%' . $word . '%"';
                if($cat != NULL)
                    $art .= " and name = '$cat' ORDER BY data desc";
                else
                    $art .= ' ORDER BY data desc';
                ?>
 
                <h2 class="margins2" style="text-align: center"> Wyszukiwana fraza: <i> <?php echo htmlspecialchars("$szukaj "); ?> </i> </h2>
                <?php
            }
            else
            {
                $art = "SELECT a.id_text, a.topic, a.intro, a.foto, c.name, date(a.data) as dd FROM article a, category c";
                if($m != NULL && $mm != NULL && $rok != NULL)
                    $art .= ", auto_art aa, car_make m, car_model mm"; 
                $art .= " WHERE a.id_cat = c.id_cat";
                if($m != NULL && $mm != NULL && $rok != NULL)
                    $art .= " and aa.id_m = m.id_m and aa.id_mm = mm.id_mm and (aa.id_opt = a.id_auto1 or aa.id_opt = a.id_auto2) and m.name = '$m' and mm.name = '$mm' and if(a.id_cat = 4, aa.rok <= $rok and aa.rokdo >= $rok, aa.rok >= ($rok - 2) and aa.rok <= ($rok + 2))";
                if($cat != NULL)
                    $art .= " and c.name = '$cat' ORDER BY a.data desc";
                else
                    $art .= ' ORDER BY a.data desc';
            }
            $rart = mysqli_query($link, $art);
    
            if($rart->num_rows === 0)
            {
            ?>
                <h4 style="text-align: center"> Brak szukanych artykułów </h4> <br> <br>
                <a style="text-decoration: none" href = "artykuly.php" > <h4 style="text-align: center"> Pokaż wszystkie </h4> </a>
            <?php
            }
            while($row = mysqli_fetch_array($rart, MYSQLI_ASSOC))
            {
            $name = $row['name'];
            $data = $row['dd'];
            ?>
                <a style="text-decoration: none" href = "text.php?id=<?php echo $row['id_text']; ?>" > <div class="container margins col-sm-8 col-sm-offset-2 one" style="background-color: #f2f2f2;">
                    <div class="row">
                        <div class="col-sm-3">
                            <br>
                            <img class="img-responsive img-rounded ctr" src="res/<?php echo $row['foto']; ?>" alt="Article Photo" width="320" height="180">
                            <br>
                        </div>
                        <div class="col-sm-9">
                            <div class="col-sm-12">
                                <h3> <?php echo $row['topic']; ?> </h3>
                            </div>
                            <div class="col-sm-12" style="color: black;">
                                <h4> <i> <?php echo " $name"; echo " •"; echo " $data"; ?> </i> </h4> 
                            </div>
                            <div class="col-sm-12" style="color: black;">
                                <h4 style="white-space: pre-wrap;"> <?php echo $row['intro']; ?> </h4> 
                                <br>
                            </div>
                        </div>
                    </div>       
                </div>  </a>     
            <?php
            }
            ?>
</body>