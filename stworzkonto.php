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
    <title> Kreator konta </title>
    <meta charset=iso-8859-2>
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
        .bggreen
        {
            background-color: #00cccc;
            color: white;
        }
        .btn:hover
        {
            background-color: #00cccc;
        }
        .navbar-inverse .navbar-brand .glyphicon:hover
        {
            color: #00cccc;
        }
    </style>
    <script>
        function checkpasslen()
        {
            var p = document.getElementById('password').value;
            if(p.length < 7 && p.length > 0)
            {
                alert("Hasło musi być dłuższe niż 6 znaków!");
                setTimeout("document.getElementById('password').focus()", 0);	
            }
            if(p.length > 6)
                $("#cpassword").prop('disabled', false);
        }   
    </script>
    <script>
        function checkpass()
        {
            var p = document.getElementById('password').value;
            var c = document.getElementById('cpassword').value;
            if(p != c)
            {
                alert("Hasła się nie zgadzają")
				document.getElementById('cpassword').value = "";							
            }               
        }
    </script>
    <script>
        function check()
        {          
            $("#loaderIcon").show();
	           jQuery.ajax({
	           url: "checkdata.php",
	           data:'mail='+$("#mail").val(),
	           type: "POST",
	           success:function(data)
                {
                    $("#user-availability-status").html(data);
	           },
	           error:function (){}
	           });                  
        }
    </script>
</head>
<body>
    <?php 
        GetNavbar(0, 0);
    ?>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $error = false;
    $query = "SELECT mail FROM user WHERE mail='$_POST[mail]'";
    $result = mysqli_query($link, $query);
    $count = mysqli_num_rows($result);
    if($count!=0)
    {
        $error = true;
?>
            <div class="text-center">
                    <h3 style="color: red"> <?php echo "Istnieje już konto, dla podanego adresu e-mail\r\n" . "<br>" . PHP_EOL; ?> </h3>
            </div>
<?php      
    }   
    if($error == false)
    {
        $mail = mysqli_real_escape_string($link , $_POST['mail']);
        $name = mysqli_real_escape_string($link, $_POST['name']);
        $city = mysqli_real_escape_string($link , $_POST['city']);
        $post = mysqli_real_escape_string($link , $_POST['post']);
        $phone = mysqli_real_escape_string($link , $_POST['phone']);
        $password = mysqli_real_escape_string($link , $_POST['password']);
        $salt = uniqid(mt_rand(), true);
		$pass = sha1(sha1($password) . sha1($salt));
        $q=mysqli_query($link, "insert into user (mail, password, salt, name, city, post, phone) values ('$mail', '$pass', '$salt', '$name', '$city', '$post', '$phone');");
        if(!$q) 
        {
            ?>
            <script>
            alert("Błąd przy dodawaniu użytkownika");
            </script>
            <?php
        } 
        else
        {   
            ?>
            <script>
            window.location.href = "utworzone.php";
            </script>
            <?php
        }	 
    }    
}
?>
            
<div class="row">
    <div class="col-sm-12">
                <h2 style="color: #1a1a1a; text-align: center;"><b>Tworzenie nowego konta</b></h2>
            </div>
    <div class="container margins col-sm-4 col-sm-offset-2 col-xs-10 col-xs-offset-1" style="background-color: #f2f2f2;">
        <hr>
        <form class="form-horizontal" method=post action="">
            <div class="form-group">
                <label class="control-label col-sm-2 col-sm-offset-1" style="white-space: nowrap;" for="mail">E-mail:</label>
                <div class="col-sm-7">
                    <input type="email" class="form-control" id="mail" name="mail" required maxlength=30 onblur="check()"> 
                </div>
                <div class="col-sm-1">
                    <span id="user-availability-status"></span>
                </div>
                <hr>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2 col-sm-offset-1" for="name">Imię:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="name" name="name" required maxlength=20>
                </div>
                <hr>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2 col-sm-offset-1" for="city">Miasto:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="city" name="city" required maxlength=30>
                </div>
                <hr>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2 col-sm-offset-1" for="post">Kod pocztowy:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="post" name="post" required maxlength=10>
                </div>
                <hr>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2 col-sm-offset-1" for="phone">Telefon:</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="phone" name="phone" required maxlength=10>
                </div>
                <hr>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2 col-sm-offset-1" for="password">Hasło:</label>
                <div class="col-sm-7">          
                    <input type="password" class="form-control" id="password" placeholder="min. 6 znaków" name="password" required maxlength=20 pattern=".{0}|.{6,}" required onblur="checkpasslen()">
                </div>
                <hr>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2 col-sm-offset-1" for="cpassword">Powtórz hasło:</label>
                <div class="col-sm-7">          
                    <input type="password" class="form-control" id="cpassword" name="cpassword" required onblur="checkpass()" disabled>
                </div>
                <hr>
            </div>
            <div class="form-group">        
                <div class="col-sm-offset-3 col-sm-2">
                    <button type="submit" class="btn btn-primary">Zatwierdź</button>
                </div>
                <hr>
            </div>
        </form>
    </div>
    <br> <br> <br>
    <div class="container margins col-sm-6">
        <div class="panel panel-default col-sm-8 col-sm-offset-1 col-xs-12">
            <div style="text-align: center">
                <h1 style="color: #1a1a1a"><b>Stwórz konto, aby:</b></h1>
            </div> <br>  
            <h2><span class='glyphicon glyphicon-asterisk' style='color:#00cccc; font-size: 30px'></span> Wystawiać ogłoszenia</h2>
            <h2><span class='glyphicon glyphicon-asterisk' style='color:#00cccc; font-size: 30px'></span> Wysyłać wiadomości do sprzedających</h2>
            <h2><span class='glyphicon glyphicon-asterisk' style='color:#00cccc; font-size: 30px'></span> Dodawać ogłoszenia do obserwowanch</h2>
            <h2><span class='glyphicon glyphicon-asterisk' style='color:#00cccc; font-size: 30px'></span> Komentować artykuły</h2>
            <div style="text-align: center">
                <h1>... a to szystko całkowicie za darmo!</h1>
            </div>
        </div>
    </div>
</div>
</body>