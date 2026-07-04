<?php
require("dbconnect.php");
$mul_id = implode(",",$_POST["idcheckbox"]);
$sql = "DELETE FROM employee WHERE id in ($mul_id)";
$result = mysqli_query($con,$sql);

if ($result){
    echo "delete success";
    header("Location: index.php");
    exit;
}


?>