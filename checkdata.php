<script>  
        $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
<?php
include("DBconn.php");
if(!empty($_POST["mail"])) {
  $result = mysqli_query($link, "SELECT count(*) FROM USER WHERE mail='" . $_POST["mail"] . "'");
  $row = mysqli_fetch_row($result);
  $user_count = $row[0];
  if($user_count>0) {
      echo "<span class='glyphicon glyphicon-ban-circle' style='color:red; font-size: 30px' data-toggle='tooltip' title='Nazwa niedostępna'></span>";
  }else{
      echo "<span class='glyphicon glyphicon-ok' style='color:green; font-size: 30px;' data-toggle='tooltip' title='Nazwa dostępna'></span>";
  }
}
?>