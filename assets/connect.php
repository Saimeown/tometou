<?php
$conn = new mysqli('localhost', 'root', '', 'wptgpbcm_tometou');
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }
?>