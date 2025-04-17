<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

include 'connect.php';

// Fetch user record based on email
$stmt = $conn->prepare("SELECT * FROM user_accounts WHERE EMAIL = ? AND STATUS = 'active'");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $storedPassword = $row['PASSWORD']; // Password from DB (could be plain or hashed)

    // Check if the password is hashed or not
    if (password_verify($password, $storedPassword)) {
        // ✅ User authenticated with hashed password
    } elseif ($storedPassword === $password) {
        // 🚨 Plaintext password detected! Convert it to a hashed version now
        $hashedNewPassword = password_hash($password, PASSWORD_BCRYPT);

        // Update the database with the hashed password
        $updateStmt = $conn->prepare("UPDATE user_accounts SET PASSWORD = ? WHERE EMAIL = ?");
        $updateStmt->bind_param("ss", $hashedNewPassword, $email);
        $updateStmt->execute();
        $updateStmt->close();
    } else {
        $_SESSION['login_error'] = "Invalid email or password.";
        header("Location: ../content/signin.php");
        exit;
    }

    // Store session variables
    $_SESSION['user_email'] = $email;
    $_SESSION['username'] = $row['USERNAME']; 
    $_SESSION['user_id'] = $row['USER_ID'];
    $_SESSION['profile_icon'] = $row['PROFILE_ICON'];

    header("Location: ../content/homepage.php");
    exit;
} else {
    $_SESSION['login_error'] = "Invalid email or password.";
    header("Location: ../content/signin.php");
    exit;
}

$stmt->close();
$conn->close();
?>