<?php
include '../assets/connect.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['POST_ID'])) {
    $postIdToUpdate = $_POST['POST_ID'];
    if (isset($_SESSION['user_id'])) {
        $loggedInUserId = $_SESSION['user_id'];

        $updateStatusQuery = $conn->prepare("UPDATE global_posts SET POST_STATUS = 'inactive' WHERE POST_ID = ? AND USER_ID = ?");
        $updateStatusQuery->bind_param("ii", $postIdToUpdate, $loggedInUserId);

        if ($updateStatusQuery->execute()) {
            header("Location: profile_admin.php");
            exit;
        } else {
            echo "Error updating post status: " . $conn->error;
        }
    }
}

$conn->close();
?>
