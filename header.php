<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
if (session_status() == PHP_SESSION_ACTIVE) {
if( isset($_SESSION['role']) && !empty($_SESSION['role']) ) {
// $session = $_SESSION['user_session']; //line 10
}}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name = "description" content=" Happy Paws Clinic"/>
    <!-- <link rel ="stylesheet" href="css//Add_Service.css"> -->
<link rel ="stylesheet" href="css//style.css">
<!-- <link rel ="stylesheet" href="css//header.css"> -->
<style>
 /* a:hover {
        background-color: rgb(5, 73, 138) !important;
        text-transform: uppercase;
    } */
      .navbar {
        overflow: hidden;
        background-color: #708090;
        width: 100%;
    }
    
    .navbar a {
        float: right;
        font-size: 16px;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        margin: 23px;
        border-radius: 10px;
    }
    
    .dropdown {
        float: right;
        overflow: hidden;
        margin: 23px;
        border-radius: 10px;
    }
    .dropdown .dropbtn {
        font-size: 16px;
        border: none;
        outline: none;
        color: white;
        padding: 14px 16px;
        background-color: #708090;
     
        font-family: "Times New Roman-Serif";
    }
    .navbar a:hover,
    .dropdown:hover .dropbtn {
        background-color: rgb(4, 73, 138);
        color:white;
        text-transform: unset;
    }
    
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: white;
        min-width: 160px;
        z-index: 1;
    }
    
    .dropdown-content a {
        float: none;
        color: rgb(4, 73, 138);
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
    }
    
    .dropdown-content a:hover {
        background-color: #ddd;
    }
    
    .dropdown:hover .dropdown-content {
        display: block;
    }
    
    .logo-home2 img {
        position: absolute;
        margin-top: 0px;
        margin-left: 10px;
    }</style>


    </head>    
    <body >

    <div class ="logo-home2" >
         <img src ="image//Logo.png"  width="170" > 
</div>

<div class="navbar">
<?php if (isset($_SESSION['id'])){
  $id= $_SESSION['id'] ;
   if($id!=0){
   echo '<a href="logout.php">Logout</a>';
   }
   else{
   header('Location:login.php');
   echo '<a href="login.php">Login</a>';
   }
}
 ?>
      

 <a href="user_manager_profile.php">My profile</a>
  <div class="dropdown">
    <button class="dropbtn">Contact Us 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="mailto:HappyPaws.ContactClinic@gmail.com">email</a>
      <a href="tel:+966 537 005 794">phone</a>
    
    </div>
  </div> 
 
  <div class="dropdown">
  
    <button class="dropbtn">E-services 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
    <?php 
  if (isset($_SESSION['role'])) {
   $user= $_SESSION['role'] ;
   if($user=='user'){
   echo '<a href="new_pet.php">Add a new pet</a>';
   echo ' <a href="List_Of_Pets.php">View my pets</a>';
   echo ' <a href="RequestForm.php"> Add Request</a>';
   echo ' <a href="UserRequests.php">Appointments Requests</a>';
   echo ' <a href="appointments.php">My appointment</a>';
   
  //  
   }
    if($user=='admin'){
     echo ' <a href="Add_Service.php">Add New Service</a>';
        echo ' <a href="Add_Available_Appoitments.php">Add avaliable appointment </a>';
   echo '<a href="Manager_Requests.php">View appointment Requests </a>';
   echo ' <a href="appointment_admin.php">Appointments</a>';
   }
   }else {
    header('Location:login.php');
   }
  
  
  ?>
      <!-- <a href="new_pet.php">Add a new pet</a> -->
      <!-- <a href="List_Of_Pets.php">View my pets</a> -->
      <!-- <a href="Manager_Requests.php">View appointment Requests </a> -->
      <!-- <a href="Add_Available_Appoitments.php">add avaliable appointment </a> -->
      <!-- <a href="DogRequestEdit.php">Requests an appointment </a> -->
	  <!-- <a href="appointments.php">appointments</a> -->

    </div>
  </div> 
    <a href="about_us_maneger(view).php">About Us</a>
	 <a href ="Home.php">Home</a>
	  
	
   
</div>


    </body>
    </html>