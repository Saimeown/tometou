<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="shortcut icon" type="image/x-icon" href="../images/tomato.png" />
    <title>Tometou</title>
    <script>
        function redirectTo() {
            var email = document.getElementById('email').value;

            if (email.endsWith('@tometou.admin')) {
                // Redirect to homepage_admin.php
                document.getElementById('login').action = '../assets/login_admin.php';
            } else if (email.endsWith('.com')) {
                // Redirect to homepage.php
                document.getElementById('login').action = '../assets/login.php';
            }

            return true;
        }

    </script>
</head>

<body>
    <section id="navbar">
        <div class="nav">
            <span><a class="icon" href="../tometou.php"><img class="iconimg" src="../images/tomato.png"></a></span>
            <span><a href="../tometou.php#developers">CONTACT</a></span>
            <span><a href="../tometou.php#terms">TERMS</a></span>
            <span><a href="../tometou.php#about">ABOUT</a></span>
        </div>
    </section>

    <br><br>
    <center>
        <h1 class="hometitle">SIGN IN</h1>
    </center><br>
    <div class="login">
        <form id="login" method="post" onsubmit="return redirectTo()">
            <!--        <label><b>EMAIL</b></label><br> -->
            <input type="email" name="email" id="email" placeholder="Email" required>
            <br><br>
            <!--        <label><b>PASSWORD</b></label><br> -->
            <input type="password" name="password" id="password" placeholder="Password" required>
            <br> <br>
            <!--    <div id="gSignInWrapper">
                <span class="label">Continue with</span>
                <div id="customBtn" class="customGPlusSignIn">
                    <span class="icon"></span>
                    <span class="buttonText">Google</span>
                </div><br><br><br>
            </div>-->
            <div>
                <input type="submit" name="submit" id="submit" value="LOG IN">
            </div><br><br>
            <center>
                <div>
                    <span class="label">Don't have an account yet? <a href="register.php" class="textLink">Create
                            one.</a>
                    </span>
                </div>
                
            </center><br>
            <?php
            if (isset($_SESSION['login_error'])) {
                echo '<div id="alertBanner" style="display: block; border-radius: 10px; background-color: #c93a3a; margin-top: 1em; width: 310px; font-size: 12px; text-align: center; font-family: Montserrat; color: white;">' . $_SESSION['login_error'] . '</div>';
                unset($_SESSION['login_error']);
            }
            ?>
            <?php
            if (isset($_SESSION['login_error'])) {
                echo '<div id="alertBanner" style="display: block; border-radius: 10px; background-color: #c93a3a; margin-top: 1em; width: 310px; font-size: 12px; text-align: center; font-family: Montserrat; color: white;">' . $_SESSION['login_error'] . '</div>';
                unset($_SESSION['login_error']);
            }
            ?>
        </form>
    </div>
</body>

</html>