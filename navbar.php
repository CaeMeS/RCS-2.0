    <script>
        $(function() {          
        $('#nav-wrapper').height($("#nav").height());
        $('#nav').affix({
        offset: { top: $('#nav').offset().top }
        });
        });
    </script>
<?php
    function GetNavbar($cl, $lg)
    { 
       echo "<div class='container-fluid' style='height:80px'>
                <h1> <img src='res/RCS.png' style='width:50px;height:50px;'> </h1>
            </div>
            <nav class='navbar navbar-inverse' data-spy='affix' data-offset-top='75'>
                <div class='navbar-header'>
                    <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>                        
                    </button>
                    <li> <a class='navbar-brand' style='color:#0088cc' href='index.php'><span class='glyphicon glyphicon-home'></span> </a> </li>             
                </div>
                <div class='collapse navbar-collapse' id='myNavbar'>
                    <ul class='nav navbar-nav' >";
                    if($lg != 0) 
                        echo "<li class='dodaj' style='background-color: #0088cc;'><a href='dodaj.php' style='color: white;'>+ Dodaj ogłoszenie</a></li>";
                    if($lg == 2)
                    {
                        echo "<li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#' style='color: white;'>+ Dodaj artykuł</a>";
                        echo "<ul class='dropdown-menu'>";
                        include("DBconn.php");
                        $qz = mysqli_query($link, "select id_cat, name from category");
                        while($row = mysqli_fetch_array($qz))
                        {
                            echo "<li><a href='addtext.php?type=".$row['name']."'>".$row['name']."</a></li>";
                        }
                        echo "</ul>
                        </li>";
                    }
                    if($cl == 1) 
                        echo "<li class='active'><a href='auta.php'>Ogłoszenia</a></li>"; 
                    else
                        echo "<li><a href='auta.php'>Ogłoszenia</a></li>";
                    if($cl == 2) 
                        echo "<li class='active'><a href='artykuly.php'>Artykuły</a></li>"; 
                    else
                        echo "<li><a href='artykuly.php'>Artykuły</a></li>";
                    echo "</ul>";
                    if($cl == 1 || $cl == 2)
                        echo "<form class='navbar-form navbar-left' action='' method='post'>
                                <div class='input-group'>
                                    <input type='text' class='form-control' data-toggle='tooltip' title='Podaj słowa kluczowe oddzielone spacją' placeholder='Szukaj...' name='search' required>
                                </div>
                                <button type='submit' class='btn btn-default'><span class='glyphicon glyphicon-search'></span></button>
                                </form>";
                    if($lg == 0)   
                        echo "<ul class='nav navbar-nav navbar-right'>
                        <li><a href='stworzkonto.php'><span class='glyphicon glyphicon-plus'></span> Stwórz konto</a></li>
                        <li><a href='zaloguj.php'><span class='glyphicon glyphicon-log-in'></span> Zaloguj się</a></li>
                    </ul>";
                    if($lg != 0)   
                        echo "<ul class='nav navbar-nav navbar-right'>
                        <li><a href='konto.php'><span class='glyphicon glyphicon-user'></span> Moje konto</a></li>
                        <li><a href='wyloguj.php'><span class='glyphicon glyphicon-log-out'></span> Wyloguj się</a></li>
                    </ul>";   
                echo "</div>
            </nav>";
    }
    