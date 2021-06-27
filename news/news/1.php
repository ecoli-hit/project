<!DOCTYPE html>
<html>
    <head>
        <title>
            <?php require_once("../conn.php");
                $dbc = mysqli_connect(HOST,USER,PASS,DBN)
                    or die ("connected error");
                $query = "SELECT * FROM `news` WHERE ID='$id'";
                $result = mysqli_query($dbc,$query)
                    or die ("quering error");
                    ?>
        </title>
        echo 111;
    </head>
</html>