<?php
include '../assets/connect.php';


?>

<!DOCTYPE html>
<html>

<head>
    <title> Terms and Conditions </title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="shortcut icon" type="image/x-icon" href="../images/tomato.png" />
    <style>
        #terms_crud {
            text-align: center;
        }

        .texttitle {
            font-family: "Press Start 2P";
            padding-top: 2em;
        }

        .hometext {
            display: inline-block;
            width: 50%;
            text-align: justify;
        }

        .hometext {
            border-radius: 5px;
            border: 2px solid black;
            box-shadow: 4px 4px black;
            margin: 5px auto 30px auto;
            padding: 1.3em 3em;
            font-size: 17px;
            font-family: sans-serif;
            letter-spacing: 2.5px;
            font-weight: 500;
            color: #000000;
            background-color: #ffffff;
            transition: all 0.3s ease 0s;
            cursor: pointer;
            outline: none;
        }

        .termsToHomepage_btn {
            border-radius: 5px;
            padding-top: 2em;
            border: 2px solid black;
            box-shadow: 4px 4px black;
            font-family: 'Press Start 2P', sans-serif;
            font-size: 12px;
            font-weight: 700;
            color: #000000;
            background: #e47e78;
            padding: 13px 30px;
            text-decoration: none;
        }

        .termsToHomepage_btn:hover {
            background-color: #bb5b5b;
            color: rgb(0, 0, 0);
            transition: 0.3s;
        }
    </style>
</head>

<body>
    
    <section id="terms_crud">
        <div>
            <span>
                <center>
                    <h2 class="texttitle">Terms & Conditions</h2>
                </center>
            </span>
            <br>
            <span>
                <?php

                $query = "SELECT TERMS FROM landing_crud ORDER BY CRUD_ID DESC LIMIT 1";

                $result = $conn->query($query);
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $term = $row["TERMS"];
                        echo '<div class="hometext">' . $term . '</div>';
                    }
                    $result->free();
                } else {
                    echo "Error: " . $conn->error;
                }

                $conn->close();
                ?>
            </span>

            <center><a href="javascript:window. history. back();" class="termsToHomepage_btn">I agree</a></center>
        </div><br><br>
        </div>
    </section>
</body>

</html>