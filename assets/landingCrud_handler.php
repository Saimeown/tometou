<?php
include 'connect.php';
$about = $_POST['about'];
$terms = $_POST['terms'];

    $stmt = $conn->prepare("INSERT INTO landing_crud (ABOUT, TERMS) VALUES (?, ?)");
    $stmt->bind_param("ss", $about, $terms);

    if ($stmt->execute()) {
        header("Location: ../tometou.php#terms");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

?>