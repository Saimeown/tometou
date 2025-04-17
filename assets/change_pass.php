<?php
session_start();
include 'connect.php';

$userid = $_SESSION['user_id'];
$currentPassword = isset($_POST['currentPassword']) ? trim($_POST['currentPassword']) : '';
$newPassword = isset($_POST['newPassword']) ? trim($_POST['newPassword']) : '';
$confirmNewPassword = isset($_POST['confirmNewPassword']) ? trim($_POST['confirmNewPassword']) : '';

// Check if passwords are empty
if (empty($currentPassword) || empty($newPassword) || empty($confirmNewPassword)) {
    die("One or more password fields are empty!");
}

// Retrieve stored password from database
$stmt = $conn->prepare("SELECT PASSWORD FROM user_accounts WHERE USER_ID = ?");
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $storedPassword = $row['PASSWORD'];

    // Check if the stored password is hashed
    if (password_verify($currentPassword, $storedPassword) || $currentPassword === $storedPassword) {
        // Password is correct; proceed with updating

        if ($newPassword === $confirmNewPassword) {
            // Hash new password
            $hashedNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            
            $updateStmt = $conn->prepare("UPDATE user_accounts SET PASSWORD = ? WHERE USER_ID = ?");
            $updateStmt->bind_param("si", $hashedNewPassword, $userid);
            
            if ($updateStmt->execute()) {
                echo "Password updated successfully.";
            } else {
                echo "Error updating password: " . $conn->error;
            }
            
            $updateStmt->close();
        } else {
            echo "Passwords do not match.";
        }
    } else {
        echo "You entered an incorrect password.";
    }
} else {
    echo "User not found.";
}

$stmt->close();
$conn->close();
?>