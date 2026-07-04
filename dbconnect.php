<?php
try {
    // 2. Attempt to connect
    $con = mysqli_connect("localhost", "root", "", "mydata");

} catch (mysqli_sql_exception $e) {
    // 3. Catch the specific error (e.g., database doesn't exist)
    die("Connection failed: " . $e->getMessage());
}



?>
