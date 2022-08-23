<?php 
session_start();
require_once "database_connect.php";

    if(isset($_POST["btn_login"]))
    {
        $email=$_POST["email"];
        $password=$_POST["password"];

        $query="select * from owner where email='$email' and pass='$password' ";
        $query2="select * from manager where email='$email' and password='$password' ";

        $result=mysqli_query($conn,$query);
        $result2=mysqli_query($conn,$query2);
        
        if (mysqli_num_rows($result)>0) {
 
            $row = mysqli_fetch_row($result);
            $_SESSION['loginuser']=$email;
            $_SESSION['id']=$row[0];
            $_SESSION['role']='user';
            mysqli_close($conn);
            header('Location:Home.php');
                
            
        }

        else if (mysqli_num_rows($result2)>0) {
            $row = mysqli_fetch_row($result2);
            $_SESSION['loginadmin']=$email;
            $_SESSION['id']=$row[0];
            $_SESSION['role']='admin';
            mysqli_close($conn);
            header('Location:Home.php');
           


        }
        
        else {
            mysqli_close($conn);
            header("Location: login.php?error=Wrong");
        }
    }
?>
<!DOCTYPE html>
<html>

<head>
    <title>Happy Paws Clinic</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <style>
 .main {
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
    position: relative;
      background-size: cover;
  font-family: 'Times New Roman', Times, serif;
  color: rgb(4, 73, 138);
  }
  img{ position: relative;
  padding: 0%;
margin-top: -30px ;}
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
transition: 0.3s;
cursor: pointer; }

.btn:hover{
background-image: url(image/button.jpg);
color: white;}
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
 
  a{   
    text-decoration:none;
    line-height:20px;
    color: #708090;
  }
  a:hover
      {  
        color:powderblue;
      }
      .active{
        color:#fff;
        background:#26e0d0;
        border-radius:4px;
      }
      .icon{
  position: absolute;
  margin-top: -13px; margin-left: 2px;
transform: translateY(-50%);
  color: #708090;
}
.eye{
  position: absolute;
  margin-top: -13px; margin-left: 28%;
transform: translateY(-50%);
  color: #708090;
}
.error{
  color: red;
  font-size: 13px;
  font-family: sans-serif;
}
    </style>
</head>

<body >
    <form action="login.php" method="post">
        <div class="main">
            <img src="image/logo.png" width="260" height="130">
            <p style="color: #708090; font-family: 'Courier New', Courier, monospace; font-size: medium; margin-top: -10px; margin-bottom: 10px;"><b>Pawsitively Great Care</b></p>
            <br>

            <h2 style="margin-top: 20px;">WELCOME!</h2>


  
<input class="form" name ="email" type ="text" placeholder="Enter Email" size= "40" maxlength="30"  required >
<div class="icon"><i class="fas fa-mail-bulk"></i></div>
<br>
<input class="form" name ="password" placeholder="Enter Password" id="pass" type ="password" size= "40" maxlength="8" required>
<div class="icon"><i class="fas fa-lock"></i></div>
<div class="eye"><i class="far fa-eye" id="togglePassword" style=" cursor: pointer;"></i></div>

<br>
<?php 
   $error= " http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   if(strpos($error , "error=Wrong")==true){
   echo "<p class='error'> Wrong email/password, try again!</p>";
   
  }
?>
<br>
<input class="btn" type="submit" value="Login"  name="btn_login">

<p> forgot your password?<a href ="forgot-password.php"> Yes </a> </P>

<p> New user? <a href ="signUp.php"> Signup </a> </P> 
  </div>
  </form>
  <script >
 const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#pass');

togglePassword.addEventListener('click', function (e) {
  // toggle the type attribute
  const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
  password.setAttribute('type', type);
  // toggle the eye slash icon
  this.classList.toggle('fa-eye-slash');
});
  </script>
</body>
</html>