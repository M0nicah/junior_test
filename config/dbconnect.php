<?php
    $conn = mysqli_connect("localhost", "test", "test12345", "junior_test");

    // checking database connection

    if (!$conn) {
        echo 'Connection error' . mysqli_connect_error();
    }

    

?>