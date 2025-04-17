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
            <h1 id="edittitle">EDIT DEVELOPERS SECTION</h1>
        </center><br>
    </div>
    <center>
        <section id="edit-team">
            <div class="terms-about-container">
                <form method="post" action="../assets/developersCrud_handler.php" class="developers-form"
                    enctype="multipart/form-data">
                    <table>
                        <tr>
                            <th class="edit-th"><label for="photo">Choose a Photo:</label></th>
                        </tr>
                        <tr>
                            <td class="edit-td">
                                <input type="file" name="photo" id="photo" accept="image/*">
                            <td>
                        </tr>
                        <tr>
                            <th class="edit-th">
                                Information
                            </th>
                        </tr>
                        <tr>
                            <td class="edit-td">
                                <table>
                                    <tr>
                                        <td class="text-input">First Name: </td>
                                        <td class="edit-td">

                                            <input class="edit-input" type="text" name="name"
                                                placeholder="Enter First Name">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-input">Last Name: </td>
                                        <td class="edit-td">

                                            <input class="edit-input" type="text" name="surname"
                                                placeholder="Developer Surname">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th class="edit-th">
                                Contact Details
                            </th>
                        </tr>
                        <tr>
                            <td class="edit-td">
                                <table>
                                    <tr>
                                        <td class="text-input">Facebook: </td>
                                        <td class="edit-td">
                                            <input class="edit-input" type="text" name="fb" placeholder="Facebook Link">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-input">Instagram: </td>
                                        <td class="edit-td">
                                            <input class="edit-input" type="text" name="ig"
                                                placeholder="Instagram Link">
                                        </td>
                                    <tr>
                                        <td class="text-input">Email: </td>
                                        <td class="edit-td">
                                            <input class="edit-input" type="text" name="gm" placeholder="Send Gmail">
                                        </td>
                                    </tr>
                                    
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th class="edit-th">
                                Add, Update, or Delete?
                            </th>
                        </tr>
                        <tr class="edit-td">
                            <td>
                                <input type="hidden" name="developer_id" value="">
                                <input class="save-icon" type="submit" name="submit" value="Add Developer">
                            </td>
                            <td>
                                <input class="save-icon" type="submit" name="submit" value="Update Developer">
                            </td>
                            <td>
                                <input class="delete-icon" type="submit" name="submit" value="Delete Developer">
                            </td>
                        </tr>
                        <tr>
                            <td class="edit-td">
                                <table>
                                    <tr>
                                        <td class="text-input">Enter Developer ID if you want to update or delete a
                                            member.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="edit-input" type="text" name="developer_id"
                                                placeholder="Developer ID">
                                        <td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </section><br>
    </center>
</body>

</html>