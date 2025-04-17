<?php
include 'connect.php';

if (isset($_POST["POST_ID"])) {
    $post_id = $_POST["POST_ID"];

    $deletePostQuery = $conn->prepare("DELETE FROM global_posts WHERE POST_ID = ?");
    $deletePostQuery->bind_param("i", $post_id);

    if ($deletePostQuery->execute()) {
        /* none */
        $conn->close();
        // Add this line to refresh the page after deletion
        header("Location: ../content/profile.php");
    } else {
        echo "Error deleting post: " . $conn->error;
    }
    $conn->close();

} else {
    echo "Invalid request";
}



?>