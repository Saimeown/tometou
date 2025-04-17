<?php
include '../assets/connect.php';

function generateRandomUsername($length = 7)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $username = '';

    for ($i = 0; $i < $length; $i++) {
        $randomIndex = rand(0, strlen($characters) - 1);
        $username .= $characters[$randomIndex];
    }

    return $username;
}

session_start();

if (isset($_SESSION['username'])) {
    $loggedInUserId = $_SESSION['user_id'];
    $loggedInUsername = $_SESSION['username'];
    $loggedInProfileIcon = $_SESSION['profile_icon'] ?? '';
} else {
    header("Location: ../assets/login.php");
    exit;
}

$profileIconQuery = $conn->prepare("SELECT PROFILE_ICON FROM user_accounts WHERE USER_ID = ?");
$profileIconQuery->bind_param("i", $loggedInUserId);
$profileIconQuery->execute();
$profileIconQuery->bind_result($currentProfileIcon);
$profileIconQuery->fetch();
$profileIconQuery->close();

$_SESSION['profile_icon'] = $currentProfileIcon;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/setting.css">
    <link rel="shortcut icon" type="image/x-icon" href="../images/tomato.png" />
    <script src="https://apis.google.com/js/api:client.js"></script>
    <script type="text/javascript" src="../assets/home.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css" />
    <title>Tometou</title>
    <!---- dark mode ----->
    <script>
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');

            const isDarkModeEnabled = document.body.classList.contains('dark-mode');
            <?php $_SESSION['dark_mode'] = "' + isDarkModeEnabled + '"; ?>;
        }
    </script>
    <script src="https://code.iconify.design/1/1.0.4/iconify.min.js">   </script>
</head>

<body>
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
    <div>
        <h1 class="texttitle">
            SETTINGS
        </h1>
    </div>
    <center>
        <section id="setting">
            <div>
                <table>
                    <tr>
                        <th class="user_th"> BACKGROUND </th>
                    </tr>
                    <tr>
                        <td class="user_td">
                            <!-- <button id="dark-mode-toggle" onclick="toggleDarkMode()">Toggle Dark/Light Mode</button> -->
                            <label class="toggle-wrapper">
                                <input class='toggle-checkbox' type='checkbox' id='darkModeToggle'
                                    onclick="toggleDarkMode()"></input>
                                <div for='darkModeToggle' class='toggle-slot'>
                                    <div class='sun-icon-wrapper'>
                                        <div class="iconify sun-icon" data-icon="feather-sun" data-inline="false"></div>
                                    </div>
                                    <div class='toggle-button'></div>
                                    <div class='moon-icon-wrapper'>
                                        <div class="iconify moon-icon" data-icon="feather-moon" data-inline="false">
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th class="user_th"> PROFILE </th>
                    </tr>
                    <tr>
                        <td class="user_td">
                            <div id="profile-icon-container">
                                <span id="profile-icon">
                                    <img class="current-icon" src="../images/profile/<?php echo $currentProfileIcon; ?>"
                                        title="Profile Icon">
                                </span>
                                <select id="profile-icon-dropdown" style="width: 200px;">
                                    <?php
                                    for ($i = 1; $i <= 16; $i++) {
                                        $imageName = $i . '.png';
                                        $imagePath = '../images/profile/' . $imageName;
                                        ?>
                                        <option data-img_src="<?php echo $imagePath; ?>">
                                            <?php echo $i . '.png'; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <button class="save-icon" onclick="saveProfileIcon()">Save</button>
                            </div>

                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.js"></script>

                            <script type="text/javascript">
                                function custom_template(obj) {
                                    var data = $(obj.element).data();
                                    var text = $(obj.element).text();
                                    if (data && data['img_src']) {
                                        img_src = data['img_src'];
                                        template = $("<div style='display: flex; align-items: center;'><img src=\"" + img_src + "\" style=\"width:30%;height:30%;\"/><p style=\"font-weight: 100;font-size:10pt;margin-left: 1em;color: black;\">" + text + "</p></div>");
                                        return template;
                                    }
                                }

                                var options = {
                                    'templateSelection': custom_template,
                                    'templateResult': custom_template,
                                }

                                $('#profile-icon-dropdown').select2(options).next('.select2-container').find('.select2-selection--single').css({
                                    'height': '60px', // set your desired height
                                    'width': '190px',  // set your desired width
                                    'margin-left': '1em',
                                });
                            </script>

                        </td>
                    </tr>
                    <tr>
                        <th class="user_th"> USERNAME </th>
                    </tr>
                    <tr>
                        <td class="user_td">
                            <div id="random-username">
                                <?php
                                if (isset($_SESSION['username'])) {
                                    $loggedInUsername = $_SESSION['username'];
                                    echo '<p class="current-username">' . $loggedInUsername . '</p>';
                                }
                                ?>
                                <button id="generate-username" onclick="generateRandomUsername()">
                                    Generate
                                </button>

                                <button class="save-icon" onclick="saveUsername()">
                                    Save
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="user_th"> PASSWORD </th>
                    </tr>
                    <tr>
                        <td class="user_td">
                            <?php
                            if (isset($_SESSION['user_id'])) {
                                $loggedInUserId = $_SESSION['user_id'];
                            }
                            ?>
                            <form method="POST" action="../assets/change_pass.php">
                                <input type="hidden" name="user_id" value="<?php echo $loggedInUserId; ?>">
                                <table>
                                    <tr>
                                        <td class="text-pass">Enter your existing password:</td>
                                        <td><input class="inputpass" type="password" name="currentPassword"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-pass">Enter your new password:</td>
                                        <td><input class="inputpass" type="password" name="newPassword"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-pass">Re-enter your new password:</td>
                                        <td><input class="inputpass" type="password" name="confirmNewPassword"></td>
                                    </tr>
                                </table>
                                <p><input class="save-icon" type="submit" value="Update Password">
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </section>
    </center>
    <script>
        function toggleDarkMode() {
            const body = document.body;
            body.classList.toggle('dark-mode');

            const isDarkModeEnabled = body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', isDarkModeEnabled);
        }

        document.addEventListener('DOMContentLoaded', function () {
            const darkModeEnabled = localStorage.getItem('darkMode') === 'true';
            document.body.classList.toggle('dark-mode', darkModeEnabled);
            document.getElementById('darkModeToggle').checked = darkModeEnabled;
        });
    </script>
    <script>
        document.getElementById("generate-username").addEventListener("click", function () {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../assets/generate_random_username.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var newRandomUsername = xhr.responseText;
                    document.querySelector('.current-username').textContent = newRandomUsername;
                }
            };
            xhr.send();
        });

        function saveUsername() {
            var usernameToSave = document.querySelector('.current-username').textContent.trim();
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../assets/save_username.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = xhr.responseText;
                    alert(response);
                    document.querySelector('.username').textContent = usernameToSave;
                    document.querySelector('.current_username').textContent = usernameToSave;
                }
            };
            xhr.send("username=" + usernameToSave);
        }


        function saveProfileIcon() {
            var selectedProfileIcon = document.getElementById("profile-icon-dropdown").value;
            var updatedImageUrl = "../images/profile/" + selectedProfileIcon;

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../assets/save_profile_icon.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = xhr.responseText;
                    alert(response);

                    // Update the image source directly
                    document.getElementById("profile-icon").querySelector('.current-icon').src = updatedImageUrl;
                }
            };
            xhr.send("profile_icon=" + selectedProfileIcon);
        }

    </script>
</body>

</html>