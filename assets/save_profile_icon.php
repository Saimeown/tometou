<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    if (isset($_SESSION['user_id'])) {
        $loggedInUserId = $_SESSION['user_id'];

        $newProfileIcon = isset($_POST['profile_icon']) ? $_POST['profile_icon'] : '';

        $updateQuery = "UPDATE user_accounts SET PROFILE_ICON = ? WHERE USER_ID = ?";
        $stmt = $conn->prepare($updateQuery);

        if ($stmt) {
            $stmt->bind_param('si', $newProfileIcon, $loggedInUserId);

            if ($stmt->execute()) {
                echo "Profile icon updated successfully!";
            } else {
                echo "Error updating profile icon!";
            }

            $stmt->close();
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
