<?php
include 'connect.php';


function generateRandomUsername($length = 7)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $username = '';

    for ($i = 0; $i < $length; $i++) {
        $randomIndex = rand(0, strlen($characters) - 1);
        $username .= $characters[$randomIndex];
    }

    return $username;
}

// Generate a new random username
$newRandomUsername = generateRandomUsername();

// Send the new random username as the response
echo $newRandomUsername;
?>
