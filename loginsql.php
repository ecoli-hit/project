<?php
    $dbc = mysqli_connect("127.0.0.1","root","eOBd3UZneX1aMy1C","userinfo")
            or die ("connected error");
    $query = "SELECT * FROM `signin` WHERE username='$username' AND secretword='$password'";
    $result = mysqli_query($dbc,$query)
            or die ("quering error");
    $row = mysqli_num_rows($result);
    mysqli_close($dbc);
?>