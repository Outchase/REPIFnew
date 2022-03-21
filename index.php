<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>index.html</title>
    <meta charset="utf-8">
    <script src="/Other/jquery.js"></script>
    <script>

        $(document).ready(function () {
            $("#login").on('click', function () {
                let email = $("#inputEmail").val();
                let password = $("#inputPassword").val();
                if (email === "" || password === "") {
                    alert("Please insert a email or Password");
                } else {
                    $.ajax({
                        url: "/backend/login.php",
                        method: "POST",
                        data: {login: 1, email: email, password: password},
                        success: function (data) {
                            if (data === "") {
                                $("#response").html("Email or password is wrong!");
                            } else {
                                $("#output").load(data);
                                location.reload();
                            }
                        }
                    });
                }
            });
            $("#logout").on('click', function () {
                $.ajax({
                    url: "/backend/logout.php",
                    method: "POST",
                    data: {logout: 1},
                    success: function (data) {
                        $("#output").load(data);
                        location.reload();
                    }
                });
            });
        });
    </script>
</head>
<body>
<?php
if (isset($_SESSION["loggedIN"])){
include_once "./frontend/navigation.html"; ?>
<div id="output">
    <?php

    if ($_GET['page'] === "UM") {
            include_once "./frontend/UM.html";
    }else if ($_GET['page'] === "SM") {
            include_once "./frontend/SM.html";
    } else {
        include_once "./frontend/welcome.html";
    }
} else {
        include_once "./frontend/login.html";
}
    ?>
</div>
<h3>Footer</h3>
</body>
</html>
