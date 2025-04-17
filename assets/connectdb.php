<?php
$email = $_POST['email'];
$password = $_POST['password'];

/* --------------------------------- REGISTER/SIGN UP ----------------------------------------------- */
include 'connect.php';

$checkEmailQuery = "SELECT COUNT(*) AS email_count FROM user_accounts WHERE EMAIL = ?";
$stmtCheckEmail = $conn->prepare($checkEmailQuery);
$stmtCheckEmail->bind_param("s", $email);
$stmtCheckEmail->execute();
$result = $stmtCheckEmail->get_result();
$emailCount = $result->fetch_assoc()['email_count'];

if ($emailCount > 0) {
    echo "Email already exists. Please use a different email.";
} else {
    // Generate random username
    function generateRandomUsername($length = 7) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $username = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = rand(0, strlen($characters) - 1);
            $username .= $characters[$randomIndex];
        }
        return $username;
    }

    $randomUsername = generateRandomUsername();

    // ✅ Hash the password using Bcrypt before storing it
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO user_accounts (`USERNAME`, `EMAIL`, `PASSWORD`) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $randomUsername, $email, $hashedPassword);

    if ($stmt->execute()) {
        session_start();
        $_SESSION['username'] = $randomUsername;
        session_write_close();

        header("Location: ../content/signin.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>