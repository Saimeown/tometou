<?php
include '../assets/connect.php';
$query = "select * from user_accounts";
$result = $conn->query($query);

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../assets/login_admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Tometou</title>
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <link rel="shortcut icon" type="image/x-icon" href="../images/tomato.png" />
    <!---- dark mode ----->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var darkModeEnabled = localStorage.getItem('darkMode') === 'true';
            document.body.classList.toggle('dark-mode', darkModeEnabled);
        });
    </script>
</head>

<body>
    <header>
        <nav>
        <ul>
            <a href="homepage_admin.php">
                <li>
                    <div>
                        <img class="logo-icon" src="../images/tomato.png" title="Tometou">
                    </div>
                </li>
            </a>
            <a href="profile_admin.php">
                <li>
                    <div>
                        <?php
         
                        if (isset($_SESSION['profile_icon'])) {
                            $loggedInProfileIcon = $_SESSION['profile_icon'];
                            echo '<img class="icon" src="../images/profile/' . $loggedInProfileIcon . '" title="Profile Icon">';
                        } else {
                            echo '<img class="icon" src="../images/profile/1.png">';
                        }
                        ?>
                        <?php

                        if (isset($_SESSION['username'])) {
                            $loggedInUsername = $_SESSION['username'];
                            echo '<span class="username">' . $loggedInUsername . '</span>';
                        }
                        session_abort();
                        ?>
                    </div>
                </li>
            </a>
            <a href="games_admin.php">
                <li>
                    <div>
                        <img class="icon" src="../images/nav/game.png" alt="Games">
                    </div>
                </li>
            </a>
            <a href="settings_admin.php">
                <li>
                    <div>
                        <img class="icon" src="../images/nav/settings.png" title="Settings">
                    </div>
                </li>
            </a>
            <a href="terms_admin.php">
                <li>
                    <div>
                        <img class="icon" src="../images/nav/terms.png" title="Terms & Conditions">
                    </div>
                </li>
            </a>
            <li>
                <div>
                    <a href="useraccounts.php" class="btn_useraccounts">
                        <img class="icon" src="../images/nav/edituser.png" title="Edit User Accounts">
                    </a>
                </div>
            </li>
            <li>
                <div>
                    <a href="landingCrud.php" class="btn_useraccounts">
                        <img class="icon" src="../images/nav/landingcrud.png" title="Edit About and Terms & Conditions">
                    </a>
                </div>
            </li>
            <li>
                <div>
                    <a href="developersCrud.php" class="btn_useraccounts">
                        <img class="icon" src="../images/nav/team.png" title="Edit Our Team">
                    </a>
                </div>
            </li>
            <li>
                <div>
                    <a href="../assets/logout.php">
                        <img class="icon" src="../images/nav/logout.png">
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    </header>
    <div>
        <br><br><br><br>
        <center>
            <h1 class="texttitle">USER ACCOUNTS</h1>
        </center><br>
        <center>
            <table class="user_table">
                <tr>
                    <th class="user_th"> USER ID </th>
                    <th class="user_th"> USERNAME </th>
                    <th class="user_th"> EMAIL </th>
                    <!--<th class="user_th"> PASSWORD </th>-->
                    <th class="user_th"> CREATED AT </th>
                    <th class="user_th"> STATUS </th>
                </tr>

                <?php
                $query = "SELECT * FROM user_accounts ";
                $result = mysqli_query($conn, $query);

                while ($rows = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr class="user_tr">
                        <td class="user_th">
                            <?php echo $rows['USER_ID']; ?>
                        </td>
                        <td class="user_td">
                            <?php echo $rows['USERNAME']; ?>
                        </td>
                        <td class="user_td">
                            <?php echo $rows['EMAIL']; ?>
                        </td><!--
                        <td class="user_td">
                            <?php echo $rows['PASSWORD']; ?>
                        </td>-->
                        <td class="user_td">
                            <?php echo $rows['CREATED_AT']; ?>
                        </td>
                        <td class="user_td">
                            <a href="../assets/update_status.php?USER_ID=<?php echo $rows['USER_ID']; ?>">
                                <label class="switch">
                                    <input type="checkbox" <?php echo $rows['STATUS'] === 'active' ? 'checked' : ''; ?> onclick="toggleStatus(<?php echo $rows['USER_ID']; ?>)">
                                    <span class="slider"></span>
                                </label>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>

            </table>
        </center>
        <div>
        <script>
            function toggleStatus(userId) {
            var checkbox = event.target;
            var newStatus = checkbox.checked ? 'active' : 'inactive';

            // Send an AJAX request to update the status
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../assets/update_status.php?USER_ID=" + userId + "&newStatus=" + newStatus, true);
            xhr.send();
        }
        </script>
</body>

</html>