<?php
include '../assets/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        $action = $_POST["submit"];

        if ($action == "Add Developer") {
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $fb = $_POST["fb"];
            $ig = $_POST["ig"];
            $gm = $_POST["gm"];

            $targetDir = "../uploads/";

            $targetFile = $targetDir . basename($_FILES["photo"]["name"]);

            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
                echo "File uploaded successfully.";
            } else {
                echo "Error uploading file.";
            }

            $photo = $_FILES["photo"]["name"];

            $query = "INSERT INTO developers (photo, name, surname, fb, ig, gm) VALUES ('$photo', '$name', '$surname', '$fb', '$ig', '$gm')";
            $conn->query($query);

            header("Location: ../admin/developersCrud.php");
        } elseif ($action == "Update Developer") {
            $developerId = $_POST["developer_id"];
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $fb = $_POST["fb"];
            $ig = $_POST["ig"];
            $gm = $_POST["gm"];

            if ($_FILES["photo"]["name"] != "") {
                $targetDir = "../uploads/";
                $targetFile = $targetDir . basename($_FILES["photo"]["name"]);

                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
                    echo "File uploaded successfully.";
                } else {
                    echo "Error uploading file.";
                }

                $photo = $_FILES["photo"]["name"];

                $query = "UPDATE developers SET photo='$photo', name='$name', surname='$surname', fb='$fb', ig='$ig', gm='$gm' WHERE id=$developerId";
            } else {
                $query = "UPDATE developers SET name='$name', surname='$surname', fb='$fb', ig='$ig', gm='$gm' WHERE id=$developerId";
            }

            $conn->query($query);

            header("Location: ../admin/developersCrud.php");
        } elseif ($action == "Delete Developer") {
            $developerId = $_POST["developer_id"];

            $query = "DELETE FROM developers WHERE id=$developerId";
            $conn->query($query);

            header("Location: ../admin/developersCrud.php");
        }
    }
}

$conn->close();
?>