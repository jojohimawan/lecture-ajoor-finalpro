<?php
    $conn_string = "host=localhost port=5432 dbname=digital_marketplace user=postgres password=admin";
    $conn = pg_connect($conn_string);

    if(!$conn) {
        die("Failed to connect: " . pg_connection_status($conn));
    }
?>