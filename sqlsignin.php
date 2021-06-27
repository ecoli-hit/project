<?php
    $password = sha1($password);
    $dbc = mysqli_connect("127.0.0.1","root","eOBd3UZneX1aMy1C","ueserinfo")
            or die ("connected error");
    $query = "INSERT INTO `signin`(`username`, `secretword`, `stuNum`) VALUES ('$username','$password','$stuNum')";
    $result = mysqli_query($dbc,$query)
            or die ("quering error");
    mysqli_close($dbc);
?>