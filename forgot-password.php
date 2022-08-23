<?php
session_start();
require_once "database_connect.php";
if(isset($_POST['reset'])){
        $email =$_POST['email'];
        $check_email = "SELECT * FROM owner WHERE email='$email'"; 
        $check_email2 = "SELECT * FROM manager WHERE email='$email'";
        $run_sql = mysqli_query($conn, $check_email);
        $run_sql2 = mysqli_query($conn, $check_email2);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(9999999, 1111111);
            $new = "P".$code;
            $insert_code = "UPDATE owner SET pass = '$new' WHERE email = '$email'";
            $run_query =  mysqli_query($conn, $insert_code);
            if($run_query){
                $subject = 'New Password';
                $message = 'Your new password code is: '.$new;
                $sender = "From: HappyPaws <HappyPaws.ContactClinic@gmail.com>\r\n";
                $to= $email;
                mail($to, $subject, $message, $sender);
                header('location:login.php');
                   
                }}
                else if(mysqli_num_rows($run_sql2) > 0){
                    $code2 = rand(9999999, 1111111);
                    $new2 = "P".$code2;
                    $insert_code2 = "UPDATE manager SET password = '$new2' WHERE email = '$email'";
                    $run_query2 =  mysqli_query($conn, $insert_code2);
                    if($run_query2){
                        $subject = "New Password";
                        $message = 'Your new password code is: '.$new2;
                        $sender = "From: HappyPaws <HappyPaws.ContactClinic@gmail.com>\r\n";
                        $to= $email;
                        mail($to, $subject, $message, $sender);
                        header('location:login.php');
                           
                        }}
                        else 
                        header("Location: forgot-password.php?error=Wrong");
                        mysqli_close($conn);

                    }
    ?>
<!DOCTYPE html>
<html>
<head>
<title>Happy Paws Clinic</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
<style> .mainRESET {
  background-color: white;
  border-top: 10px solid rgb(4, 73, 138);
    border-bottom: 10px solid rgb(4, 73, 138);
    width: 400px;  
   overflow: hidden; 
   text-align: center;
   margin: auto ;
   margin-top: 85px; 

  padding: 45px;
  padding-bottom: -20px; 
  padding-right: 80px;
    box-shadow: 1px 1px 108.8px 1px rgb(99, 108, 138);
   border-radius: 15px ;
  }
    Body 
    {
      background-image: url(image/design.png);
      background-size: cover;
    font-family: 'Times New Roman', Times, serif;
    color: rgb(4, 73, 138);
    }
    .logo{ position: relative;
    padding: 0%;
  margin-top: -30px ;}

.form{ 
      position: relative;   
  border: 0;
  outline-color: #0b4b8b;
  box-shadow: none;
 display: block;
  border-bottom: 1px solid rgb(4, 73, 138);
  width: 100%;
  height: 30px;
  font-family: 'Times New Roman', Times, serif;
  font-size: medium;
  font-weight: 500;
  padding-left: 25px;
  transition: all 0.3s ease;
  padding-bottom: -20px;
 margin-bottom: auto;
  
  }
  .icon{
  position: absolute;
  margin-top: -13px; margin-left: 2px;
transform: translateY(-50%);
  color: #708090;
}
.btn{

    position: relative;
    border:0;
    color: rgb(4, 73, 138) ;
    border-radius: 100px;
    width: 340px;
    height: 49px;
    font-size: 20px;
    font-family: 'Times New Roman', Times, serif;
    top: 79%;
    margin-bottom: 1.5px;
    
    cursor: pointer; }



.btn:hover{
background-image: url(image/button.jpg);
color: white;}
.error{
  color: red;
  font-size: 13px;
  font-family: sans-serif;
}

  </style>
</head>
<body>
  <div class="mainRESET"> 
 <form action="forgot-password.php" method="post">

    <img class="logo" src="image/logo.png" width="260" height="130"> 
    <p style="color: #708090; font-family: 'Courier New', Courier, monospace; font-size: medium; margin-top: -10px; margin-bottom: 10px;"><b>Pawsitively Great Care</b></p>
    <br>
<h2>Forgot your password? </h2>
  <p style="color: #708090; font-family: 'Courier New', Courier, monospace; font-size: small; font-weight: 600;">No worries, Enter your email address and we'll send you a new password which you can change it later   </p>
    
    <br><br>
    <input class="form" name ="email" type ="text" placeholder="Enter Email" size= "40" maxlength="30"  required >
    <div class="icon"><i class="fas fa-mail-bulk"></i></div>
    <?php 
     $error= " http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
     if(strpos($error , "error=Wrong")==true){
     echo "<p class='error'> Wrong email, try again!</p>";
     
    }
  ?>

  <br>

  <input class="btn" type="submit" name="reset" value="Send Email"> 
  <br>
  </form>

  <a href="login.php" > <button class="btn">Back </button> <a></div>
</body>
</html>
