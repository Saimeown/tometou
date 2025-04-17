<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <title>Tometou</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="../images/tomato.png" />
    <script src="https://apis.google.com/js/api:client.js"></script>
    <script type="text/javascript" src="../assets/tometou.js"></script>
</head>
<body>
<section id="navbar">
            <div class="nav">
            <span><a class="icon" href="../tometou.php"><img class="iconimg" src="../images/tomato.png" ></a></span>
            <span><a href="../tometou.php#developers">CONTACT</a></span>
            <span><a href="../tometou.php#terms">TERMS</a></span>
            <span><a href="../tometou.php#about">ABOUT</a></span>
            </div>
        </section>

    <br><br>
    <center><h1 class="hometitle">REGISTER</h1></center><br>    
    <div class="login">
        <form id="login" method="post" action="../assets/connectdb.php">  
    <!--        <label><b>EMAIL</b></label><br> -->
            <input type="email" name="email" id="email" placeholder="Email" required>    
            <br><br>
    <!--        <label><b>PASSWORD</b></label><br> -->
            <input type="password" name="password" id="password" placeholder="Password" required>    
            <br><br>
            <input type="submit" name="submit" id="submit" value="REGISTER">      
            <div id="alertBanner" style="display: none; border-radius: 10px; background-color: #c93a3a; margin-top: 1em; width: 310px; font-size: 12px; text-align: center; font-family: Montserrat; color: white;"></div> 
            <br><br>
        <!--
         <div id="gSignInWrapper">
                <span class="label"> Register with</span>&nbsp
                <div id="customBtn" class="customGPlusSignIn">
                    <span class="icon"></span> 
                    <span class="buttonText">Google</span>
                </div>
                <div class="or"><label><br>or</label></div><br>
            </div>  -->
            <center><a href="guest.php"><div class="guestbtn">
                LOGIN AS GUEST
            </div></a><br>
            <div>
                <span class="label">Already have an account? <a href="signin.php" class="textLink">Login here.</a> </span>
            </div></center>
            <script>startApp();</script> 
<script>
    document.getElementById("login").addEventListener("submit", function (e) {
        e.preventDefault();
        var form = this;
        var formData = new FormData(form);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../assets/connectdb.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText;
                if (response.trim() === "Email already exists. Please use a different email.") {
                    document.getElementById("alertBanner").textContent = response.trim();
                    document.getElementById("alertBanner").style.display = "block";
                } else {
                    document.getElementById("alertBanner").textContent = ""; 
                    document.getElementById("alertBanner").style.display = "none"; 
                    // Registration was successful, you can redirect or show a success message here.
                    window.location.href = 'signin.php';
                }
            }
        };
        xhr.send(formData);
    });
</script>  
            </form>  
    </div>
</body>
</html>