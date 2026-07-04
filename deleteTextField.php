<?php
require("dbconnect.php");
$id = $_POST["idemployee"];
$sql = "DELETE FROM employee WHERE id = $id";
$result = mysqli_query($con, $sql);

if ($result) {
    echo "Delete Success";
    header("Location: index.php");
    exit;
} else {
    echo "Delete Fail";
}
?>