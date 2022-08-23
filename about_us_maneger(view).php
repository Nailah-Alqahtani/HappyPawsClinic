
<?php
include 'header.php';
include 'database_connect.php';
?>
<!DOCTYPE html>
<html>
<head>
<title> Happy Paws Clinic </title>
<meta name = "description" content="Happy Paws Clinic "/>

<style>
  /* .title_page {
    width:400px;
    text-align: center;
    font-size: 45px;
} */
.button_edit {
  background-color: transparent;
  margin: 20px 500px 0 200px;
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
  width: 150px;}
  .button_edit:hover{
    background-image: url(image/animals.jpg);
color:white;
  }
.img_about {
    width: 300px;
    height: 300px;
    margin-left: 336px;
}
.column{
    float: center;
    /* width: 33.33%; */
    /* padding: 15px; */
    padding-top: 20px;
    border-radius: 3%;
    padding-bottom: 50PX;
    padding-left: 10PX;
    left: 100px;
    position: center;
    /*'.$row['location'].'*/
}
</style>
</head>
<body class="about-us-body" style=" overflow-x: hidden;">


<fieldset class ="box-out2"  style="overflow:auto">
<div>
<div class="about-des2">
<h1 class="title_page" >About Us </h1>
<p  style="margin: 20;"> <?php


             $query="select * from about where id=1 ";
                $run=mysqli_query($conn,$query);
		while ($row=mysqli_fetch_array($run)) {
    echo  $row['about_us'];
    echo   '<div class="location-des">
<h1 class="title_page" >Our Location</h1>
<br><p > <iframe src="'.$row['location'].'" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> </br></br></p>
</div>';
$image = $row['image'];
    }
        ?>   
</p>

</div>



</div>


<div class="column">
    <img src="images//<?php echo $image ?>" alt="Treatment" class="img_about">
  </div>

<p>
<?php
if (isset($_SESSION['role'])) {
   $user= $_SESSION['role'] ;
   if($user=='admin'){
   echo '<a   href="about_us_manager(edit).php"> <button class="button_edit" type="button"> Edit</button></a>';
  
   }
   }
   ?>
 
 
 
 <br><br><br>

</fieldset>
</body>
</html>