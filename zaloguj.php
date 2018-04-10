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
    <title> Logowanie </title>
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
            margin-top: 100px;
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
            font-size: 170%
        }
        .lks:hover
        {
            text-decoration: none;
            color: #00cccc;
        }
        .btn:hover
        {
            background-color: #00cccc;
            border-color: #00cccc;
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
    <div class="container margins" style="background-color: #f2f2f2;">
        <div class="row">
            <div class="col-sm-12">
                <h2 style="color: #1a1a1a; text-align: center;"><b>Zaloguj się</b></h2> <br>
            </div>
        <hr>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $mail = mysqli_real_escape_string($link,$_POST['mail']);
        $password = mysqli_real_escape_string($link, stripslashes($_POST['password']));
	    $qu = "SELECT salt FROM USER WHERE mail = '$mail' ";
        $res = mysqli_query($link, $qu);
        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
        $pass = sha1(sha1($password) . sha1($row['salt']));	
        $sql = "SELECT id_user FROM USER WHERE mail = '$mail' and password = '$pass'";
        $result = mysqli_query($link,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if($count == 1) 
        {
            $_SESSION['user_mail'] = $mail;
            header("location: index.php");            
        }
        else
        {
            echo $row['salt'];
            ?>
            <h4 align="center" style="color: red"> Dane nie są poprawne </h4> <hr>
            <?php
        }
    }
    ?>
            <div class="col-sm-5 cols-sm-offset-3">
                <form class="form-horizontal" method=post action="">
                    <div class="form-group">
                        <label class="control-label col-sm-2 col-sm-offset-2" style="white-space: nowrap;" for="mail">E-mail:</label>
                        <div class="col-sm-7">
                            <input type="email" class="form-control" id="mail" name="mail" required maxlength=30> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2 col-sm-offset-2" for="paassowrd">Hasło:</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control" id="password" name="password" required maxlength=20> 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-1">
                            <button class="btn btn-primary" type="submit" class="btn btn-default">Zaloguj</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="form-group col-sm-6 col-sm-offset-1">
                <a  class="lks" href="stworzkonto.php"><b> Nie masz konta? </b></a>
            </div>
            <div class="form-group col-sm-6 col-sm-offset-1">
                <a  class="lks" href="reminder.php"><b> Nie możesz się zalogować? </b></a>
            </div>
        <hr>
        </div>
    </div>
</body>