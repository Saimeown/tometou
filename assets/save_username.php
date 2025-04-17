<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    if (isset($_SESSION['user_id'])) {
        $loggedInUserId = $_SESSION['user_id'];

        $newUsername = isset($_POST['username']) ? $_POST['username'] : '';

        $updateQuery = "UPDATE user_accounts SET USERNAME = ? WHERE USER_ID = ?";
        $stmt = $conn->prepare($updateQuery);

        if ($stmt) {
            $stmt->bind_param('si', $newUsername, $loggedInUserId);

            if ($stmt->execute()) {
                $_SESSION['username'] = $newUsername;
                $updatePostsQuery = "UPDATE global_posts SET USERNAME = ? WHERE USER_ID = ?";
                $stmtPosts = $conn->prepare($updatePostsQuery);

                if ($stmtPosts) {
                    $stmtPosts->bind_param('si', $newUsername, $loggedInUserId);

                    if ($stmtPosts->execute()) {
                        echo "Username updated successfully!";
                    } else {
                        echo "Error updating posts!";
                    }

                    $stmtPosts->close();
                }

                $stmt->close();
            } else {
                echo "Error saving username!";
            }
        } else {
            echo "Error preparing statement!";
        }
    } else {
        echo "User not logged in!";
    }

    session_write_close();
} else {
    echo "Invalid request method!";
}
?>
