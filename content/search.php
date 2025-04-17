<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

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
    <!-- Sidebar -->
<nav>
        <ul>
            <a href="homepage.php">
                <li>
                    <div>
                        <img class="logo-icon" src="../images/tomato.png" title="Tometou">
                    </div>
                </li>
            </a>
            <a href="profile.php">
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
                        ?>
                    </div>
                </li>
            </a>
            <a href="games.php">
                <li>
                    <div>
                        <img class="icon" src="../images/nav/game.png" alt="Games">
                    </div>
                </li>
            </a>
            <a href="settings.php">
                <li>
                    <div>
                        <img class="icon" src="../images/nav/settings.png" title="Settings">
                    </div>
                </li>
            </a>
            <a href="terms.php">
                <li>
                    <div>
                        <img class="icon" src="../images/nav/terms.png" title="Terms & Conditions">
                    </div>
                </li>
            </a>
            <li>
                <div>
                    <a href="../assets/logout.php">
                        <img class="icon" src="../images/nav/logout.png">
                    </a>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Search bar -->
    <section id="search">
        <div class="container-input">
            <form action="search.php" method="GET">
                <input type="text" placeholder="Search for a name..." name="search" class="input">
                <button type="submit" hidden>
                </button>
                    <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1920 1920"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M790.588 1468.235c-373.722 0-677.647-303.924-677.647-677.647 0-373.722 303.925-677.647 677.647-677.647 373.723 0 677.647 303.925 677.647 677.647 0 373.723-303.924 677.647-677.647 677.647Zm596.781-160.715c120.396-138.692 193.807-319.285 193.807-516.932C1581.176 354.748 1226.428 0 790.588 0S0 354.748 0 790.588s354.748 790.588 790.588 790.588c197.647 0 378.24-73.411 516.932-193.807l516.028 516.142 79.963-79.963-516.142-516.028Z"
                            fill-rule="evenodd">
                        </path>
                    </svg>
            </form>
        </div>
    </section><br><br><br><br><br><br>

    <section id="posts">
        <div class="sub">
            <ul>
                <?php
                include '../assets/connect.php';

                if (isset($_SESSION['username'])) {
                    $loggedInUsername = $_SESSION['username'];
                }

                if (isset($_GET['search'])) {
                    $searchTerm = $_GET['search'];

                    // Retrieve records matching the search term from the global_posts table
                    $searchQuery = "SELECT * FROM global_posts WHERE TO_WHOM LIKE ? AND POST_STATUS = 'active' ORDER BY POSTED_AT DESC";
                    $stmt = $conn->prepare($searchQuery);
                    $searchTerm = '%' . $searchTerm . '%'; // Add wildcard characters to search for partial matches
                    $stmt->bind_param("s", $searchTerm);
                    $stmt->execute();
                    $result = $stmt->get_result();

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
                                echo '<img class="profile-icon" src="../images/profile/' . htmlspecialchars($postedUserIcon) . '" title="Profile Icon">';
                                echo '<p class="fromuser">' . htmlspecialchars($row["USERNAME"]) . '</p>';
                                echo '<p class="dateposted">' . date("F j, Y", strtotime($row["POSTED_AT"])) . '</p>';
                                echo '<p class="postmessage">' . htmlspecialchars($row["POST_CONTENT"]) . '</p>';
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

                    $stmt->close();
                    $conn->close();
                }
                ?>
            </ul>
        </div>
    </section>
</body>

</html>