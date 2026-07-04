<?php
require("dbconnect.php");

$id = $_GET["idemp"];
$sql = "DELETE FROM employee WHERE id = $id";
$result = mysqli_query($con,$sql);
if ($result){
    echo "delete success";
    header("Location: index.php");
    exit;
}

?>
