<?php  
require_once "database_connect.php"; 
	session_start();
		if (isset($_POST['add_appoitements'])) 
        {
        
        $day=$_POST['day'];
    // $filename = $_FILES["uploadfile"]["name"];
    // $tempname = $_FILES["uploadfile"]["tmp_name"];    
    //     $folder = "images/".$filename;
		$time=$_POST['time'];
		$time_Available=$_POST['time_Available'];
		$time=$time.$time_Available;
		$Service=$_POST['Service'];
	

		$query="INSERT INTO appaintments_available(day, time, services, status)
     VALUES ('$day','$time','$Service', 'Available')";

        // Creation validation !!
		if ($conn->query($query) === TRUE) {
        $last_id = $conn->insert_id;
        //echo "New record created successfully. Last inserted ID is: " . $last_id;
        } else {
         //echo "Error: " . $query . "<br>" . $conn->error;
        }

// $con->close();
        }
		
?>



<?php include 'header.php' ?>
	<!DOCTYPE html>
	<html>
<style>
	.body_add_available {
    position: relative;
	background-image: url(image//bg.png);
    background-size: 1500px 900px;
    display: flex;
}

.editApp {
    text-decoration: none;
}

.editApp:hover {
    color: red;
}

.editApp visited {
    color: red;
}

ol li {
    list-style: none;
}


.title_add_available {
   background-color: rgb(4, 73, 138);
color: white;
position: relative;
text-align: center;
border-radius: 100px;
padding: 10px 49px;
font-size: 35px;
margin-right: 390px;
margin-left: 394px;
margin-top: 15px;
width: 41%;
}


.sub_Available_Appoitments {
text-align: left;
font-family: "Times New Roman", "Serif";
color: white;
background-color: gray;
border-radius: 5px;
margin-top: 30px;
margin-right: 1000px;
margin-left: 430px;
padding: 7px;
padding-left: 20px;
font-size: 21px;
width: 260px;
margin-bottom: 15px;
}


.button:hover {
    background-image: url(image//animals.jpg);
    color: white;
}
.button_sub:hover {
    background-image: url(image//animals.jpg);
    color: white;
}

.editApp:visited {
    color: rgb(4, 73, 138);
}

.editApp {
    text-decoration: none;
}

hr {
    margin: 15px 50px;
}

.border1 {
    border-style: solid;
    border-radius: 50px;
    border-color: transparent;
    padding-top: 10px;
    margin-left: 430px;
    margin-right: 300px;
    width: 550px;
	height: 390px;
    margin-bottom: 15px;
}

.sub_ditals {
    text-align: left;
    font-family: "Times New Roman", "Serif";
    color: white;
    border-radius: 5px;
    margin-top: 80px;
    margin-right: 70px;
    margin-left: 70px;
    padding: 5px;
    padding-bottom: 10px;
    font-size: 18px;
}
.button_sub {
    background-color: transparent;
    text-align: center;
    font-weight: bold;
    color: #04498A;
    border-style: solid;
    border-color: rgb(4, 73, 138);
    border-radius: 30px;
    padding: 10px 80px;
    font-family: 'Times New Roman', Times, serif;
    font-size: 120%;
}
.button {
    background-color: transparent;
    text-align: center;
    font-weight: bold;
    color: #04498A;
    border-style: solid;
    border-color: rgb(4, 73, 138);
    margin-left: 30px ;    
    border-radius: 30px;
    padding: 10px 80px;
    font-family: 'Times New Roman', Times, serif;
    font-size: 120%;
}


.table{  
  margin-left: 30%;
    background-color: white;
    width: 540px;
    /* height: 90px; */
    padding: 20px;
    border-radius: 35px;
        margin-bottom: 20px;
}
a {
    text-decoration: none;
    color: rgb(4, 73, 138);

}

</style>
    


	<body class="body_add_available" >
		<!--     End of Header     -->
        
		<h1 class="title_add_available"> Available Appoitments : </h1>
		<br>
		
		<span class="sub_Available_Appoitments" > Available Appoitments :</span>
        <br>
        <ul>
        <table class="table" cellpadding="10">
								<tr class="table-tr-head table-three text-white">
									<th></th>
									<th></th>
								</tr>
        <?php					
	    $query="SELECT id, day, time, services FROM appaintments_available where status='Available'";
        $result=mysqli_query($conn,$query);
        while ($row=mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . date('D', strtotime($row['day'])).' [ '.date('F', strtotime($row['day'])).'-'. date('d', strtotime($row['day'])). 
    ' ]  At : '. $row['time']." \t ,  For : \t [ ".$row['services']. " ]" . "</td>";
    echo"<td width='170'><a class='btn btn-primary' href=Edit_Appointment.php?appoit_id=".$row['id'].">{ Edit -\t </a> <a class='btn btn-danger' href=delete.php?appoit_id=".$row['id']."> \t Delete }

    </a></td>";
      echo "</tr>";
		
        }
   ?>
        </table>
        </ul>
	

		<div class="border1" style="background-image: url(image//borderBG.png);">
			<span class="sub_ditals" style="border-radius: 100px; margin-left: 20px; background-color: white; color: gray;">
			Add new Available Appoitment : &nbsp;&nbsp;</span>

			<br><br>
			<br><br>
		<form method="post" action="Add_Available_Appoitments.php">
			<label><span class="sub_ditals">&nbsp;&nbsp; Day Avalible:&nbsp;&nbsp;
  			<input type = date name="day"  required> </label> </span>

			<br> <hr><br>

			<label><span class="sub_ditals">&nbsp;&nbsp; Time: &nbsp;&nbsp; 

  			<input type="number" name="time" min="1" max="12" style="margin-left:15px;" required >

  			<span style="font-family: Courier New , Monospace ;">
  			<lable><input type="radio" value="am" name="time_Available" required>am</lable>
  			<lable><input type="radio" value="pm" name="time_Available" required>pm</lable>
  			</span>
  			<br><br><hr>


  			
  				  <!-- Select a service -->
					<p> <label class="labels" style="margin-left: 90px;">Service:</label>
						<select name = "Service"  required>
							<?php
								
	 $query="SELECT id, name FROM services";
        $result=mysqli_query($conn,$query);
        while ($row=mysqli_fetch_array($result)) {
            echo "<option value=".$row['name'] . ">" . $row['name'] . "</option>";
        }
   ?>
						</select>
					</p> <br><br>
		

      <span ><a href="Home.php"><button type="button" class = "button"  >Back</button></a></span>
      <span ><button type="submit" class = "button_sub" name="add_appoitements">Add</button></span>
		
		</div>
		
		</form>


	</body>
	</html>