
<?php
require_once "database_connect.php"; 

if (isset($_GET['appoit_id'])) {
		$appoit_id=$_GET['appoit_id'];
$query="select * from appaintments_available where id='$appoit_id'";
$run=mysqli_query($conn,$query);
		while ($row=mysqli_fetch_array($run)) {
		$service=$row['services'];
		$da=$row['day'];
		if(strlen($row['time'])==4){
		$tim= substr($row['time'],0,2);
			$tim2=substr($row['time'],2,2);
			 } 
			 else{
			 $tim= substr($row['time'],0,1);
			 $tim2=substr($row['time'],1,2);}
}
}



if(isset($_POST['update_appo'])){
 echo $id=$_POST["id"];
        echo  $Eday=$_POST["Eday"];
          echo $time=$_POST["time"];
 		  echo $time_Available=$_POST["time_Available"];
		   $time=$time.$time_Available;
 		 echo $Service=$_POST["Service"];
          
 		  $que="UPDATE appaintments_available SET 
		  day='$Eday',time='$time',services='$Service'  WHERE id=$id";

 		$ru=mysqli_query($conn, $que);

 		if ($ru) {
 			//echo '<script>alert("تم التعديل بنجاح");	</script>'; //Delete
             header("Location: Add_Available_Appoitments.php"); // important !!
		}
 		else { //Delete
			//echo '<script>alert("لم يتم التعديل")</script>';
 		}

}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Happy Paws Clinic</title>
	<link rel ="stylesheet" href="css/edit_appot.css">
	<style>
		.button_edit{
    background-color: transparent;
    margin-left: 90px;
    margin-right: 20px;
    text-align: center;
    font-weight: bold;
    color: #04498A;
    border-style: solid;
    border-color: rgb(4,73,138);
    border-radius: 30px;
    padding: 10px 75px;
    font-family: 'Times New Roman', Times, serif;
    font-size: 130%;
	}

	.button_edit:hover {
		background-image: url(image//animals.jpg);
    color: white;
		}
		.button_edit:visited{
			text-decoration: none;
		}

	</style>
</head>
<body  style="background-image:url(image//bg.png)">
	
<?php include 'header.php' ?>
	


		<h1 style="    margin-bottom: 30px;
    margin-top: 36px;"> Edit Avalibale Appointment</h1>

			<div class="border1" style="background-image:url(image//borderBG.png) ;    height: 335px;">
			<span class="sub2" style="border-radius: 100px; margin-left: 20px; background-color: white; color: gray;">
			&nbsp;&nbsp; Edit Appoitment : &nbsp;&nbsp;</span>

			<br><br><br>
		<form action="edit_appointment.php" method="post">
<input type= "hidden" name="id" size="20" maxlength="25" value="<?php echo $id_app= $_GET["appoit_id"]; ?>" required>
			<label><span class="sub2">&nbsp;&nbsp; Day Avalible:&nbsp;&nbsp;
  			<input type = date  id="Eday" name = "Eday" required value="<?php echo $da ?>">  </span></label>

			<br><br> <br>

			<label><span class="sub2">&nbsp;&nbsp; Time &nbsp;&nbsp; 

  			<input type="number" name="time" min="1" max="12" style="margin-left:15px;" required  id="Etime" value="<?php echo $tim  ?>">

  			<span style="font-family: Courier New , Monospace ;">
  			<lable><input type="radio" value="am" name="time_Available"  id="E-am" required  <?php if($tim2=='am') echo 'checked'; ?>>am</lable>
  			<lable><input type="radio" value="pm" name="time_Available" required <?php if($tim2=='pm') echo 'checked'; ?>>pm</lable>
  			</span>
  			<br><br>



  			<label><span class="sub2" >&nbsp;&nbsp; Service &nbsp;&nbsp; 
  				
  				<input type="text" name="Service" id="E-services" value="<?php echo $service  ?>"></span></label>


  			</span>
  		</label> 

  		
		
  			<br><br>

      <span >
      	    <span ><a href="Add_Available_Appoitments.php"><button type="button" class = "button_edit"  >Back</button></a></span>

      	<input type="submit" class = "button_edit" name="update_appo" value="Update"> </input>
			<br>
      </span>
			<br>
			
		</form>
		</div>
		



<!-- <script src="edit_appot.js"></script> -->
<!-- <?php ?> -->
</body>
</html>