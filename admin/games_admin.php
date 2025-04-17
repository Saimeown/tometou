<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/game.css">
    <link rel="shortcut icon" type="image/x-icon" href="../images/tomato.png" />
    <script src="https://apis.google.com/js/api:client.js"></script>
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
                        session_start();
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

    <section id="tetris">
        <div id="tetris">
            <div id="info">
                <div id="next_shape">asdfasdf</div>
                <p id="level">Level: <span></span></p>
                <p id="lines">Lines: <span></span></p>
                <p id="score">Score: <span></span></p>
                <p id="time">Time: <span></span></p>
                <button id="restart-btn">Restart</button>
            </div>
            <div id="canvas"></div>
            <div id="arrow-buttons">
                <div class="arrow-row">
                    <button id="up-btn">&#8593;</button>
                </div>
                <div class="arrow-row">
                    <button id="left-btn">&#8592;</button>
                    <button id="down-btn">&#8595;</button>
                    <button id="right-btn">&#8594;</button>
                </div>
            </div>
            <script type="text/javascript" src="../assets/game.js"></script>
            <form id="gameForm" method="post" action="../assets/insert_game_data.php">
                <input type="hidden" name="score" id="scoreField" value="">
                <input type="hidden" name="level" id="levelField" value="">
            </form>
    </section>                  
</body>

</html>