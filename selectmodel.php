
<?php
    include("DBconn.php");

    $ccar = mysqli_real_escape_string($link , $_POST['choosen']);
    $q2 = mysqli_query($link, "SELECT cm.name FROM car_model cm, car_make c WHERE c.id_m = cm.id_m and c.name = '$ccar' order by name");  
    $r = " 
            <option value='' disabled selected>Model</option>
    ";
    while($row2 = mysqli_fetch_array($q2))
    {
        $r = $r . "<option value='".$row2['name']."'> ".$row2['name']." </option>";
    }
    echo $r;
?>