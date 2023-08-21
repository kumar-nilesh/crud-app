<?php
    $id = $_GET['id'];
    
    require('api/dbconfig.php');

    $query = "DELETE FROM users WHERE id = {$id}";

    $result = mysqli_query($conn,$query);

    header("Location: index.php");

    mysqli_close($conn);

?>