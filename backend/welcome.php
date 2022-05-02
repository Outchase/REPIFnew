<?php
$email = $_SESSION["email"];
?>
<div class="welcomeContainer">
    <h2>Welcome!</h2>
    <div id=userInfo>
        <p>User: <?php echo $email ?></p>
        <button type="button" class="normalBtn" onclick="changePassword('<?php echo $email ?>')">Change password</button>
    </div>
</div>
<script>
    function changePassword(email) {         //display form to change current logged users password
        let form = "<div class='pwForm'><label>Password: <input id='inputOldPassword' type='password'></label><br>" +
            "<label>New password: <input id='inputNewPassword' type='password'></label><br>" +
            "<label>Retype new password: <input id='inputReNewPassword' type='password' ></label><br></div>" +
            "<div class='formButton'><button class='normalBtn' type='button' onclick=confirmChangePassword('" + email + "')>Confirm</button><button class='normalBtn' type='button' onclick='cancelChangePassword()'>Cancel</button>";
        $("#userInfo").html(form);
    }

    function cancelChangePassword() {        //reloads page when cancel button is pressed
        location.reload();
    }

    function confirmChangePassword(email) {      //changes current password to the new password if statement is true
        let recPw = String($("#inputOldPassword").val());
        let newPw = String($("#inputNewPassword").val());
        let reNewPw = String($("#inputReNewPassword").val());
        if (recPw.length > 3 && newPw.length > 3 && newPw === reNewPw) {  //checks that the new password is longer than 3 and if retyped password is equal to the new password
            $.ajax({
                url: "/backend/changePassword.php",     //makes post request to the url
                method: "POST",
                data: {changePw: 1, recPw: recPw, newPw: newPw, email: email},
                success: function (data) {      //on success display message and executes logout function ( force the user to log in again)
                    alert(data);
                    logoutUser();
                }
            });
        } else {
            alert("Invalid Value");
        }

    }

</script>