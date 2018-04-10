<?php
    include("DBconn.php");
    include("navbar.php");
    session_start();
    if(isset($_SESSION['user_mail'])) 
    {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<head lang="en">
    <title> Gratulacje! </title>
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
        .bgaqua
        {
            background-color: #00cccc;
            color: white;
        }
        .clear
        {
            clear:both;
        }
        .lks:link
        {
            text-decoration: none;
            font-size: 180%
        }
        .lks:hover
        {
            text-decoration: none;
            color: #00cccc;
        }
        .navbar-inverse .navbar-brand .glyphicon:hover
        {
            color: #00cccc;
        }
    </style>
</head>
<body>
    <?php 
        GetNavbar(0, 0);
    ?>
    <div class="container margins" style="background-color: #bbff99; text-align:center">
        <hr>
        <div class="col-sm-12">
            <span class='glyphicon glyphicon-ok-sign' style='color:#55ff00; font-size: 150px'></span>
            <hr>
        </div>
        <div class="col-sm-12">
            <h1><b> Twoje konto zostało utworzone </b></h1> <br>
        </div>
        <div class="col-sm-12">
            <a  class="lks" href="zaloguj.php"><b> Zaloguj się </b></a>
        </div> 
        <div class="col-sm-12">
            <br><p style="font-size: 180%"> lub </p>
        </div>
        <div class="col-sm-12">
            <a  class="lks" href="index.php"><b> Wróć na stronę główną </b></a>
            <hr>
        </div>
    </div>
</body>