<?php
session_start();
include '../assets/connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../assets/login_admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title> Edit Landing Details </title>
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
    <div>
        <br><br>
        <center>
            <h1 id="edittitle">EDIT LANDING PAGE</h1>
        </center><br>
    </div>
    <center>
        <div class="terms-about-container">
            <form method="post" action="../assets/landingCrud_handler.php" class="landing-form">
                <div class="landing-container">
                    <?php
                    include '../assets/connect.php';

                    $about = "SELECT ABOUT FROM landing_crud ORDER BY CRUD_ID DESC LIMIT 1";
                    $mysqli = new mysqli('localhost', 'wptgpbcm_tometou', 'tmt123', 'wptgpbcm_tometou');
                    $result = $mysqli->query($about);
                    $placeholder = "Default placeholder text"; // Default placeholder text
                    
                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $placeholder = htmlspecialchars($row['ABOUT']);
                    }
                    ?>
                    <div class="landing-about">
                        <label><p class="about-label">ABOUT</p></label><br>
                        <textarea type="text" name="about" id="about" placeholder="<?php echo $placeholder; ?>" required><?php echo $placeholder; ?></textarea>
                        <br><br>
                    </div>
                    <?php
                    include '../assets/connect.php';

                    $term = "SELECT TERMS FROM landing_crud ORDER BY CRUD_ID DESC LIMIT 1";
                    $mysqli = new mysqli('localhost', 'wptgpbcm_tometou', 'tmt123', 'wptgpbcm_tometou');
                    $result = $mysqli->query($term);
                    $placeholder = "Default placeholder text"; // Default placeholder text
                    
                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $placeholder = htmlspecialchars($row['TERMS']);
                    }
                    ?>
                    <div class="landing-terms">
                        <label><p class="about-label">TERMS</p></label><br>
                        <textarea type="text" name="terms" id="terms" placeholder="<?php echo $placeholder; ?>" required><?php echo $placeholder; ?></textarea>
                        <br><br>
                    </div>
                </div>
                <input type="submit" name="submit" id="submitbutton1" value="UPDATE">
            </form>
        </div>
    </center>
</body>

</html>