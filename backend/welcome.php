<?php
$email= $_SESSION["email"];
?>
<h2>Welcome page</h2>
<div id=userInfo>
<p>User: <?php echo $email ?></p><button type="button" onclick="changePassword('<?php echo $email ?>')">Change password</button>
</div>
<script>
    function changePassword(email){         //display form to change current logged users password
        let form= "<label>Password: </label><input id='inputOldPassword' type='password' placeholder='Enter recent Password here'><br>" +
            "<label>New password: </label><input id='inputNewPassword' type='password' placeholder='Enter new Password here'><br>" +
            "<label>Retype new password: </label><input id='inputReNewPassword' type='password' placeholder='Retype new Password here'><br>" +
            "<button type='button' onclick=confirmChangePassword('"+email+"')>confirm</button><button type='button' onclick='cancelChangePassword()'>cancel</button>";
       $("#userInfo").html(form);
    }

    function cancelChangePassword(){        //reloads page when cancel button is pressed
      location.reload();
    }

    function confirmChangePassword(email){      //changes current password to the new password if statement is true
        let recPw = String($("#inputOldPassword").val());
        let newPw= String($("#inputNewPassword").val());
        let reNewPw= String($("#inputReNewPassword").val());
        if (recPw.length >3 && newPw.length > 3 && newPw === reNewPw){  //checks that the new password is longer than 3 and if retyped password is equal to the new password
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