<?php
session_start();
require_once "database_connect.php";
if (isset($_POST['submit']))
{
       $email = $_POST['email'];
       $pass= $_POST['password'];
       $phone= $_POST['PhoneNo'];
       $fname= $_POST['Firstname'];
       $lname= $_POST['Lastname'];
       $gender = $_POST['gender'];

       $img = $_FILES['ProfilePic']['tmp_name'];
       $image = addslashes(file_get_contents($img));

   $query = "SELECT * FROM owner WHERE email = '$email' ";
   $query2 = "SELECT * FROM manager WHERE email = '$email' ";
   
   $result=mysqli_query($conn,$query);
   $result2=mysqli_query($conn,$query2);

   if (mysqli_num_rows($result)>0 || mysqli_num_rows($result2)>0)
   {
       $_SESSION['error'] = "This email is already exist, try another one!";
       header("Location: signup.php?");
       mysqli_close($conn);
       exit;

   }
  


   $query="INSERT INTO `owner` ( `email`, `pass` , `phone` , `first` , `last` , `gender` , `image`) VALUES ( '$email', '$pass' , '$phone' , '$fname' , '$lname' , '$gender' , '$image')";
   if (mysqli_query($conn, $query)) {
    $query3 = "SELECT * FROM owner WHERE email = '$email' ";
    $result3=mysqli_query($conn,$query3);
    $row = mysqli_fetch_row($result3);
    $_SESSION['loginuser']=$email;
    $_SESSION['id']=$row[0];
    $_SESSION['role']='user';
    mysqli_close($conn);
    header('Location:Home.php');
        
       
   } else {
       echo "Error: ".mysqli_error($conn);
}

}
?>
<!DOCTYPE html>
<html>
<head>
<title>Happy Paws Clinic</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
<style>

.mainSIGN {
background-color: white;
border-top: 10px solid rgb(4, 73, 138);
  border-bottom: 10px solid rgb(4, 73, 138);
  width: 400px;  
 overflow: hidden; 
 text-align: center;
 margin: auto ;
 margin-top: 17px; 
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
  #logo{ position: relative;
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
  .chk{
    position: relative;
    cursor: pointer;
    font-size: 13px;
    
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

#photo{
  position: relative;
    height: 100px;
    width: 120px;
    text-align: center;
}

#file{
    display: none;
}

#upload{
    height: 40px;
    width: 100%;
    position: absolute;
    margin-left: -50px;
      
    text-align: center;
    background: #708090;
    color: wheat;
    line-height: 30px;
    font-family: sans-serif;
    font-size: 10px;
    cursor: pointer;
    display: none;
    
}
.error{
  color: red;
  font-size: 12px;
  font-family: sans-serif;
}

</style>

</head>
<body><div class="mainSIGN">
<form action="signup.php" method="post" name="form" onsubmit="return validateInput();" enctype="multipart/form-data">
  
    <img src="image/logo.png" width="260" height="130" id="logo"> 
    <p style="color: #708090; font-family: 'Courier New', Courier, monospace; font-size: medium; margin-top: -10px; margin-bottom: 10px;"><b>Pawsitively Great Care</b></p>
   
    <h2 style="margin-top: 20px;">WELCOME!</h2>
    
    <div class="profile-pic-div">
      <img src="image/profile.png" id="photo">
      <input type="file" id="file" accept="image/*" name="ProfilePic">
      <br>
      <label for="file" id="uploadBtn"><div style=" font-weight: 600; font-size: 12px; cursor: pointer; ">Choose Profile Photo</div></label>
    </div> 
    
<input class="form"  type ="text" placeholder="Enter Email" size= "40" maxlength="30" name="email" id="email" required  >
<div class="icon"><i class="fas fa-mail-bulk"></i></div>
<div class="error" id="emailError"></div>

  
  <?php  /* $error= " http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
     if(strpos($error , "error=email")==true){
     echo "<span class='error'> This email is already exist try another one!</span>"; 
    }*/
     if(isset($_SESSION['error'])){
       echo "<span class='error'>".($_SESSION['error'])."</span>";
       unset($_SESSION['error']);
     }
   

     ?>
<br>
    
  <input class="form"  type ="password" id="pass" placeholder="Enter Password" size= "40" maxlength="8" name="password"   required>
  <div class="icon"><i class="fas fa-lock"></i></div>
  <div class="eye"><i class="far fa-eye" id="togglePassword" style=" cursor: pointer;"></i></div>
  <div class="error" id="passError"></div>
  <br>
  
  <input class="form" type ="text" id="phone" placeholder="Enter Phone Number" size= "40" maxlength="10" name="PhoneNo" required>
  <div class="icon"><i class="fas fa-phone"></i></div>
  <div class="error" id="PhoneError"></div>
  <br>  
  
  <input class="form"  type ="text" id="fname" placeholder="Enter First Name" size= "40" maxlength="30" name="Firstname"  required>
  <div class="icon"><i class="fas fa-user"></i></div>
  <div class="error" id="fnameError"></div>
   <br>  
   
   <input class="form" type ="text" id="lname" placeholder="Enter Last Name" size= "40" maxlength="30" name="Lastname"   required>
   <div class="icon"><i class="fas fa-user"></i></div>  
   <div class="error" id="lnameError"></div>
   
   <p> <b>Gender</b>:
     <label>
  <input class="chk" id="gender" name ="gender" type ="radio"value= "Male" required >
   Male</label>
      <label> 
  <input class="chk" id="gender" name ="gender" type ="radio"value= "Female" required>
   Female</label>
   </p>
   <div class="error" id="genderError"></div>
 
   <input class="btn" type="submit"  value="SignUp" name="submit">
<br>
</form>

<a href="login.php" > <button class="btn" style="margin-top: 2px;" >Back </button> <a></div>
<script src="Js-SignUp.js"></script>
</body>

</html>

