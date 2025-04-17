<?php
session_start();
include '../assets/connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../assets/login_admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
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

    <div class="profile-detail-container">
        <?php
        session_start();
        if (isset($_SESSION['profile_icon'])) {
            $loggedInProfileIcon = $_SESSION['profile_icon'];
            echo '<img class="profile-icon" src="../images/profile/' . $loggedInProfileIcon . '" title="Profile">';
        }
        ?>
        <span class="profile-name">
            <?php
            if (isset($_SESSION['username'])) {
                $loggedInUsername = $_SESSION['username'];
                echo '<span>' . $loggedInUsername . '</span>';
            }
            session_abort();
            ?>
        </span>
    </div>

    <div class="sub">
        <ul>
            <?php
            include '../assets/connect.php';

            session_start();
            if (!isset($_SESSION['username'])) {
                header("Location: ../assets/login.php");
                exit;
            }

            if (isset($_SESSION['user_id'])) {
                $loggedInUserId = $_SESSION['user_id'];
            }

            $postsQuery = $conn->prepare("SELECT * FROM global_posts WHERE USER_ID = ? AND POST_STATUS = 'active' ORDER BY POSTED_AT DESC");
            $postsQuery->bind_param("i", $loggedInUserId);
            $postsQuery->execute();
            $result = $postsQuery->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $postedUserIconQuery = "SELECT PROFILE_ICON FROM user_accounts WHERE USERNAME = '" . $row["USERNAME"] . "'";
                    $iconResult = $conn->query($postedUserIconQuery);

                    if ($iconResult->num_rows > 0) {
                        $postedUserIcon = $iconResult->fetch_assoc()['PROFILE_ICON'];

                        echo '<li>';
                        echo '<a href="#">';
                        echo '<div class="post">';
                        echo '<i class="pin"></i>';
                        echo '<h2 class="to_whom">To: ' . htmlspecialchars($row["TO_WHOM"]) . '</h2>';
                        echo '<img class="post-icon" src="../images/profile/' . htmlspecialchars($postedUserIcon) . '" title="Profile Icon">';
                        echo '<p class="fromuser">' . htmlspecialchars($row["USERNAME"]) . '</p>';
                        echo '<p class="dateposted">' . date("F j, Y", strtotime($row["POSTED_AT"])) . '</p>';
                        echo '<p class="postmessage">' . htmlspecialchars($row["POST_CONTENT"]) . '</p>';
                        echo '<form method="post" action="update_post_admin.php">';
                        echo '<input type="hidden" name="POST_ID" value="' . $row["POST_ID"] . '">';
                        echo '<button type="submit" class="delete-button">Delete</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</a>';
                        echo '</li>';
                    }
                }
            } else {
                echo '<li>';
                echo '<a href="#">';
                echo '<div class="post">';
                echo '<p>No posts available.</p>';
                echo '</div>';
                echo '</a>';
                echo '</li>';
            }

            $conn->close();
            session_abort();
            ?>

            <form method="post" action="../assets/submitpost_handler.php">
                <input type="hidden" name="action" value="submit_post">
                <input type="hidden" name="to" value="<?php echo htmlspecialchars($loggedInUsername); ?>">
            </form>
        </ul>
    </div>
</body>

</html>