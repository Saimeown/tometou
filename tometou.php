<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/tometou.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/tomato.png" />
    <script type="text/javascript" src="js/tometou.js"></script>
    <title>Tometou</title>
</head>

<body>
    <section id="navbar">
        <div class="nav">
            <span><a class="icon" href="#main"><img class="iconimg" src="images/tomato.png"></a></span>
            <span><a href="#developers">CONTACT</a></span>
            <span><a href="content/terms.php">TERMS</a></span>
            <span><a href="#about">ABOUT</a></span>
        </div>
    </section>
    <section id="main">
        <div>
            <img src="images/sky1.png" id="bg">
            <!--    <img src="images/paperplane-2.png" id="plane"> -->
            <center>
                <div class="envelope-wrapper">
                    <img src="images/backenvelope1.png" id="back">
                    <img src="images/frontenvelope1.png" id="front">
                </div>
                <h2 id="title">TOMETOU</h2>
            </center>
        </div>
        <script>
            let bg = document.getElementById("bg");
            /*    let plane = document.getElementById("plane"); */
            let back = document.getElementById("back");
            let front = document.getElementById("front");
            let title = document.getElementById("title");

            window.addEventListener('scroll', function () {
                var value = window.scrollY;

                bg.style.top = value * 0 + 'px';
                /*     plane.style.left = value * 1 + 'px'; */
                back.style.top = value * 0.2 + 'px';
                front.style.top = value * 0.2 + 'px';
                title.style.top = value * 0.55 + 'px';
            })

        </script>
    </section>
    <section id="login">
        <div class="button-container">
            <center>
                <span><a href="content/signin.php"><button class="homebutton">SIGN IN</button></a></span>
                <span><a href="content/register.php"><button class="homebutton">REGISTER</button></a></span>
            </center>
        </div>
    </section>
    <section id="notes">
        <div>
            <p class="nextpage"></p>
            <h2 class="texttitle">SHARE YOUR THOUGHTS ANONYMOUSLY</h2>
            <center>
                <div class="notewrapper">
                    <span><img src="images/sample/1.png" class="imgnotes" alt="A sample letter"></span>
                    <span><img src="images/sample/3.png" class="imgnotes2" alt="A sample letter"></span>
                    <span><img src="images/sample/2.png" class="imgnotes" alt="A sample letter"></span>
                </div>
            </center>
            <span>
                <p class="nextpage"></p>
            </span>
        </div>
    </section>
    <section id="about">
        <div>
            <span>
                <h2 class="texttitle">To me, to you.</h2>
            </span>
            <img src="images/sample/notes.png" class="letter" alt="A letter to someone."><br>
            <span>
                <?php
                include 'assets/connect.php';

                $query = "SELECT ABOUT FROM landing_crud ORDER BY CRUD_ID DESC LIMIT 1";

                $result = $conn->query($query);

                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $abou = $row["ABOUT"];
                        echo '<div class="hometext">' . $abou . '</div>';
                    }

                    $result->free();
                } else {
                    echo "Error: " . $conn->error;
                }

                $conn->close();

                ?>
            </span>
            <span>
                <p class="nextpage"></p>
            </span>
            <span>
                <p class="nextpage"></p>
            </span>
        </div><br><br>
        </div>
    </section>
    <section id="developers">
        <div>
            <span>
                <h2 class="texttitle2">CONTACT US</h2>
            </span>
        </div><br><br>
        <div class="team-section">
            <?php
        
            $query = "SELECT * FROM developers";
            $mysqli = new mysqli('localhost', 'root', '', 'wptgpbcm_tometou');

            if ($result = $mysqli->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    $photo = $row["photo"];
                    $name = $row["name"];
                    $surname = $row["surname"];
                    $fb = $row["fb"];
                    $ig = $row["ig"];
                    $gm = $row["gm"];

                    echo '<div class="team-member">';
                    echo '<img src="uploads/' . $photo . '" alt="Team Member">';
                    echo '<h3>' . $name . '</h3>';
                    echo '<p class="surname">' . $surname . '</p>';
                    echo '<a href="' . $fb . '" class="fa fa-facebook" target="_blank"></a>';
                    echo '<a href="' . $ig . '" class="fa fa-instagram" target="_blank"></a>';
                    echo '<a href="' . $gm . '" class="fa fa-google" target="_blank"></a>';
                
                    echo '</div>';
                }

                $result->free();
            }

            $mysqli->close();
            ?>
        </div><br><br><br><br><br><br><br><br><br><br><br>
    </section>
    <!--
    <section id="contact">
        <div>
            <span>
                <h2 class="texttitle2">CONTACT US</h2>
            </span>
        </div><br><br>

    </section>
    -->
</body>

</html>