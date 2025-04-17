<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])) {
    if ($_POST["action"] == "submit_post") {
        $loggedInUsername = $_SESSION['username'];
        $loggedInUserId = $_SESSION['user_id'];

        $to = $_POST["to"];
        $message = $_POST["message"];
        
        $postedAt = date("Y-m-d H:i:s");

        include 'connect.php';

        $stmt = $conn->prepare("INSERT INTO global_posts (USER_ID, USERNAME, TO_WHOM, POST_CONTENT, POSTED_AT) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $loggedInUserId, $loggedInUsername, $to, $message, $postedAt);

        if ($stmt->execute()) {
            header("Location: ../content/homepage.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
} else {
}
?>
