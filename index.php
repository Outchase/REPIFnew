<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>index.html</title>
    <meta charset="utf-8">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://use.typekit.net/qis4qci.css">
    <link rel="stylesheet" href="main.css">                     <!--Links css file to index page-->
    <script src="/Other/jquery.js"></script>                   <!--Links jquery file to index page-->
    <script>

        $(document).ready(function () {                     //When the document is ready execute the function below
            $("#login").on('click', function () {           //listens onclick event on Id login
                let email = $("#inputEmail").val();         //saves input value of selected Id into a variable
                let password = $("#inputPassword").val();
                if (email === "" || password === "") {      //check if one of the variable are empty
                    alert("Please insert a email or Password");     //display error message if the variable is empty
                } else {                                            //else executes ajax method
                    $.ajax({
                        url: "/backend/login.php",                  //Specifies the URL to send the request to
                        method: "POST",                             //chose request method
                        data: {login: 1, email: email, password: password},     //Specifies data to be sent to the server
                        success: function (data) {                              //execute function when request was a success
                            if (data === "") {                                  //checks if data is empty
                                $("#loginResponse").html("<p style='color: red; font-weight: bold '>Email or password is wrong!</p>"); //send message to the selected html id
                            } else {
                                location.reload();                          //reloads page
                            }
                        }
                    });
                }
            });

        });

        function logoutUser() {                              //execute function logout when user presses on navigation bar "Log Out"
            $.ajax({                                        //executes ajax method
                url: "/backend/logout.php",
                method: "POST",
                data: {logout: 1},
                success: function (data) {                  //execute function when request was a success
                    $("#output").load(data);                //load file to the div with Id output
                    location.reload();
                }
            });
        }
    </script>
</head>
<body>
<?php
if (isset($_SESSION["loggedIN"])){                      //check if Session is set
if ($_SESSION["technician"] === "1") {                  //check if logged user is a Technician
    include_once "./frontend/techNavigation.html";              //includes navigation html page
} else {
    include_once "./frontend/userNavigation.html";
}

?>
<section id="output" class="mainContent">
    <?php
    if ($_SESSION["technician"] === "1") {                      //check if logged user is a Technician
        if ($_GET['page'] === "UM") {                           //check if Get page has the value UM
            include_once "./frontend/UM.html";             //replace in div element with id output with User management page
        } else if ($_GET['page'] === "SM") {                   //check if Get page has the value SM
            include_once "./frontend/SM.html";           //replace in div output the content with Smartbox management page
        } else if ($_GET['page'] === "scriptPage") {                   //check if Get page has the value SM
            include_once "./frontend/scriptPage.html";           //replace in div output the content with Smartbox management page
        } else {
            include_once "./backend/welcome.php";
        }
    } else {
        if ($_GET['page'] === "SU") {
            include_once "./frontend/userSmartbox.html";    // includes web page for the user
        } else {
            include_once "./backend/welcome.php";
        }
    }
    } else {
        include_once "./frontend/login.html";           //includes login page when session is not set
    }
    ?>
</section>
<footer><h4>&copy Izmir Rexhepi 1TPIF2 2022</h4></footer>
</body>
</html>
