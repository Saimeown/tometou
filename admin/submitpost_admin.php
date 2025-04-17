<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <link rel="shortcut icon" type="image/x-icon" href="../images/tomato.png" />
    <script src="https://apis.google.com/js/api:client.js"></script>
    <script type="text/javascript" src="../assets/home.js"></script>
    <title>Tometou</title>
        <!---- dark mode ----->
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            var darkModeEnabled = localStorage.getItem('darkMode') === 'true';
            document.body.classList.toggle('dark-mode', darkModeEnabled);
        });
    </script>
</head>

<body>
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

    <br><br><h1 class="texttitle">SPILL YOUR SAUCE</h1><br>
    <div class="notes">
        <ul>
            <li>
                <a href="#">
                    <?php
                   

                   // Check if the user is logged in 
                   if (!isset($_SESSION['username'])) {
                       // Handle the case where the user is not logged in, e.g., redirect to the login page.
                       header("Location: ../assets/login_admin.php");
                       exit;
                   }
                   
                   // Rest of your HTML code
                    ?>
                    <form method="post" action="submitpost_handler_admin.php">
                        <input type="hidden" name="action" value="submit_post">
                        <input type="hidden" name="to" value="<?php echo htmlspecialchars($loggedInUsername); ?>">
                        <h2>To: <input type="text" name="to"></h2>
                        <textarea rows="20" cols="30" maxlength="200" placeholder="Say Something" name="message"></textarea>
                        <input type="submit" name="submit" id="submit" value="Submit Post">
                    </form>
                </a>
            </li>
        </ul>
    </div>
</body>

</html>