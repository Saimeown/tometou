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
</head>

<body>
    <!------------SEARCH BAR-------------->
    <section id="search">
        <div class="container-input">
            <form method="GET" action="guest_search.php">
                <input type="text" placeholder="Search for a name..." name="search" class="input">
                    <button type="submit" hidden>    
                    </button>
                    <svg fill="#000000" width="20px" height="20px" viewBox="0 0 1920 1920"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M790.588 1468.235c-373.722 0-677.647-303.924-677.647-677.647 0-373.722 303.925-677.647 677.647-677.647 373.723 0 677.647 303.925 677.647 677.647 0 373.723-303.924 677.647-677.647 677.647Zm596.781-160.715c120.396-138.692 193.807-319.285 193.807-516.932C1581.176 354.748 1226.428 0 790.588 0S0 354.748 0 790.588s354.748 790.588 790.588 790.588c197.647 0 378.24-73.411 516.932-193.807l516.028 516.142 79.963-79.963-516.142-516.028Z"
                            fill-rule="evenodd"></path>
                    </svg>
            </form>
        </div>
    </section><br><br><br><br><br>
    <!-------------FOR SUBMISSION--------------->
    <!--
    <section id="submitpost">
        <div><br><br><br>
            <span><a href="submitpost.php"><button class="submitbutton">SPILL YOUR SAUCE</button></a></span>
        </div>
    </section><br><br><br>
-->
    <!-----------ALL SUBMISSIONS-------------->
    <section id="posts">
        <div class="sub">
            <ul>
                <?php
                include '../assets/connect.php';

                $postsQuery = "SELECT * FROM global_posts WHERE POST_STATUS = 'active' ORDER BY POSTED_AT DESC";
                $result = $conn->query($postsQuery);

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

                $conn->close();
                ?>
                <!--
                <form method="post" action="submitpost_handler.php">
                    <input type="hidden" name="action" value="submit_post">
                    <input type="hidden" name="to" value="<?php echo htmlspecialchars($loggedInUsername); ?>">
                </form>
            -->
            </ul>
        </div>
    </section>
</body>

</html>