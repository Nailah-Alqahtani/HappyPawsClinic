
<?php
include 'header.php';
include 'database_connect.php';
$user_id = $_SESSION['id'];
if (isset($_GET['id_user'])) {
    $user_id = $_GET['id_user'];
}
    if (isset($_POST['update_password'])) {
        if (isset($_SESSION['role'])) {
            $user = $_SESSION['role'];
            if ($user == 'user') {
        $sql_select_users = "select * from owner where id=$user_id";
        $Result_users = mysqli_query($conn, $sql_select_users);
        if (mysqli_num_rows($Result_users) > 0) {
            $row = mysqli_fetch_row($Result_users);
                $password = $row[2];
            }
        
        $password_new = $_POST['password_new'];
        $password_Confirm = $_POST['password_Confirm'];
        $password_prev = $_POST['password_prev'];

        if (!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{8}$/", $password_new)) {
            echo "<script>alert('Password must be at least 8 characters long and must contain 1 letter at least');</script>";
            //    $nameErr = "Only letters and white space allowed";
            echo '<script>window.location="Change_pass_user_manger.php";</script>';

            return false;
        }
        if ($password_prev == $password) {
            if ($password_new == $password_Confirm) {
                $query1 = "update owner set  pass='$password_new'  where id=$user_id";

                $run = mysqli_query($conn, $query1);
                if ($run) {
                    echo '<script>alert("Changes successfully saved");
			     </script>';
                } else {
                    echo '<script>alert("Changes has not saved")</script>';
                }
            } else {
                echo '<script>alert("Passwords do NOT match");</script>';
            }
        } else {
            echo '<script>alert("The previous password is not correct")</script>';
        }}
        else if ($user == 'admin') {
            $sql_select_users = "select * from manager where id=$user_id";
            $Result_users = mysqli_query($conn, $sql_select_users);
            if (mysqli_num_rows($Result_users) > 0) {
                $row = mysqli_fetch_row($Result_users);
                    $password = $row[2];
                }
            
            $password_new = $_POST['password_new'];
            $password_Confirm = $_POST['password_Confirm'];
            $password_prev = $_POST['password_prev'];
    
            if (!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{8}$/", $password_new)) {
                echo "<script>alert('Password must be at least 8 characters long and must contain 1 letter at least');</script>";
                //    $nameErr = "Only letters and white space allowed";
                echo '<script>window.location="Change_pass_user_manger.php";</script>';
    
                return false;
            }
            if ($password_prev == $password) {
                if ($password_new == $password_Confirm) {
                    $query1 = "update manager set  password='$password_new'  where id=$user_id";
    
                    $run = mysqli_query($conn, $query1);
                    if ($run) {
                        echo '<script>alert("Changes successfully saved");
                     </script>';
                    } else {
                        echo '<script>alert("Changes has not saved")</script>';
                    }
                } else {
                    echo '<script>alert("Passwords do NOT match");</script>';
                }
            } else {
                echo '<script>alert("The previous password is not correct")</script>';
            }}
    
    }}



?>


<!DOCTYPE html>
<html>
<head>

<meta charset = "utf-8">
<title> Happy Paws Clinic</title>
<meta name = "description" content=" Happy Paws Clinic"/>
<style>

.edit_pssword_form {
      width: 47%;
    margin-left: 25%;
    background-color: white;
    padding: 30px;
    margin-top: 100px;
    border-radius: 40px;
    padding-left: 12%
}
.input{ 
      width: auto;
    margin: 0 auto;
    margin-left: -10%;
    font-weight: bold;}
    .input input{
      width: 230px;}
      .button_change_pass {
    background-color: transparent;
    margin: 22px 500px 0 275px;
    text-align: center;
    font-weight: bold;
    color: #04498A;
    border-style: solid;
    border-color: #708090;
    border-radius: 30px;
    padding: 10px;
    font-family: 'Times New Roman', Times, serif;
    font-size: 100%;
    position: relative;
    top: 15%;
    right: 200px;
    cursor: pointer;
    width: 150px;
}




#back_update_pass {
    background-color: transparent;
    margin: 20px 500px 0 275px;
    text-align: center;
    font-weight: bold;
    color: #04498A;
    border-style: solid;
    border-color: #708090;
    border-radius: 30px;
    padding: 10px;
    font-family: 'Times New Roman', Times, serif;
    font-size: 100%;
    position: relative;
    top: 15%;
    right: 200px;
    cursor: pointer;
    width: 150px;
}
.back_update_pass:hover{
    background-image: url(image/animals.jpg);
color:white !important;
}

.button_change_pass:hover{
    background-image: url(image/animals.jpg);
color:white;
}

.Pass-body {
    width: 100%;
    min-height: 60vw;
    background-color: #B0E0E6;
}
    </style>
</head>



<?php

?>

<body class="Pass-body" style=" overflow-x: hidden; background-image: url(image/design.png);   background-size: cover;">

 <form action="#" method="POST" class="edit_pssword_form">
<div>
<p class="input"><label>Previous Password:
<input id ="ShiftRight-pass2" type ="text" value=""  name="password_prev" size="20" maxlength="8" required>
</label></p>
<br>
<p class="input"><label>New Password:
<input id ="ShiftRight-pass2" type ="password" name="password_new" size="20" maxlength="8" required style="margin-left: 28px;">
</label></p>

<br>
<p  class="input"><label >Confirm Password:
<input id ="ShiftRight-pass2" type ="password" name="password_Confirm"  size="20" maxlength="8" required>
</label></p>
<br>


<p ><input class="button_change_pass" type = "submit"  name ="update_password" value = "Change"> </p>
  <button id="back_update_pass"  class="back_update_pass" type="button" onclick="location.href='user_manager_profile.php'"> Back</button>

<br>

</div>

</form>
</body>
</html>