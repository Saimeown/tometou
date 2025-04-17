<?php
include 'connect.php';

if (isset($_GET['USER_ID'])) {
    $userId = $_GET['USER_ID'];
    
    // Retrieve the current status
    $query = "SELECT STATUS FROM user_accounts WHERE USER_ID = $userId";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $currentStatus = $row['STATUS'];

        // Toggle the status
        $newStatus = ($currentStatus === 'active') ? 'inactive' : 'active';

        // Update the status in the database
        $updateQuery = "UPDATE user_accounts SET STATUS = '$newStatus' WHERE USER_ID = $userId";
        if ($conn->query($updateQuery)) {
            // Status updated successfully
            header("Location: ../tometou.php"); 
            exit;
        } else {
            echo "Error updating status: " . $conn->error;
        }
    }
}
header("Location: ../tometou.php");
exit;
?>