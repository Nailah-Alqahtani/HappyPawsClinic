<?php  
	session_start();
  $user_id= $_SESSION['id'];

require_once "database_connect.php";
// $service_name=$_POST['id_service'];
// echo $service_name;
		if (isset($_POST['add_request'])) 
        {
      
        $pet=$_POST['pet'];
   
		$service=$_POST['service'];
		$date=$_POST['date'];
  
		$note=$_POST['note'];
		$id_appoointement=$_POST['app_id'];
    $day;

    if($id_appoointement!=null){

	        
    }
     $q="SELECT id,day, time,services FROM appaintments_available";
     $result=mysqli_query($conn,$q);
     while ($row=mysqli_fetch_array($result)) {
     if($row['id']==$id_appoointement)
     {
     $da=$row['day'];
     $tim=$row['time'];
     break;}
  
        }

        
		$query="INSERT INTO request_appointement(pet, service, day, time, note, status,user_id)
     VALUES ('$pet','$service','$da','$tim','$note','waiting','$user_id')";
  
		if ($conn->query($query) === TRUE) {
      echo "<script> alert('Request Added Successfully');</script>";
  $last_id = $conn->insert_id;
  
} else {
  echo "<script> alert('Request Is Not Added');</script>";
  echo "Error: " . $query . "<br>" . $conn->error;
}


        }
		
?>
<!DOCTYPE html>
<html>

    <head>

 <meta charset="utf-8">
 <title> Happy Paws Clinic </title>
 <link rel ="stylesheet" href="css/RequestForm_Style.css"> 

 <script>


const times = [];
	function	select_service(){
   var select =  document.getElementById('servi');
var value = select.options[select.selectedIndex].value;

// alert(value);
console.log(value);
  document.getElementById('id_service').value=value;
  // document.getElementById('id_service').submit;
  var xmlhttp;
           
            if (window.XMLHttpRequest)
                xmlhttp = new XMLHttpRequest();
            else
                xmlhttp = new ActiveXobject(" Microsoft.XMLHTTP");
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 & xmlhttp.status == 200) 
                document.getElementById("dat_time").innerHTML = xmlhttp.responseText;
            }
            xmlhttp.open("GET", "get_time_service.php?value=" + value, true);
            xmlhttp.send();
   }
   function select(){
   var select =  document.getElementById('dat_time');
var value = select.options[select.selectedIndex].value;
// alert(value);
console.log(value);
  document.getElementById('id').value=value;

   }

    </script>
    
    </head>

    <body style= "background-image:url(image/design.png);">

<?php   include 'header.php'; ?>
    
		
		<!-- Title -->
		<h1 class="title">
		Request an Appointment
		</h1>
	
		<!-- Request Form Area -->
    <form method="post" action="RequestForm.php">
      <!-- fieldset_requestEdit -->
		<fieldset class="" style= "background-image:url(image/fieldset2.png);">

            <!-- Select a pet -->
            <p> <label class="labels">Pet:</label>
                <select name ="pet" required>
                <option value="">selects pet:</option> 
                 <?php
							
	 $query="SELECT id, name FROM pets where user_id=$user_id";
        $result=mysqli_query($conn,$query);
        while ($row=mysqli_fetch_array($result)) {
            echo "<option value=".$row['name'] . ">" . $row['name'] . "</option>";
        }
   ?>
                   
                </select>
            </p> <br> <hr> <br>
            <!-- Select a service -->
            <p> <label class="labels">Service:</label>
                <select name = "service" required id="servi"  onchange="select_service()" >
                 <option value="">selects Service:</option> 
                <?php
       $query="SELECT name FROM services";
       $result=mysqli_query($conn,$query);
       while ($row=mysqli_fetch_array($result)) {
       
       echo "<option value=".$row['name'] . ">" . $row['name'] . "</option>";}
   
   ?>
	   
                </select>
            </p> <br> <hr> <br>


<p> <label class="labels">Available Dates and Times:</label>
<br> <br>
<input type="hidden"  name="app_id" id="id" value="0">
<input type="hidden"  name="id_service" id="id_service" value="0">
                <select name ="date" required id="dat_time"  onchange="select()" >
                <option value="">select Dates and Times:</option> 
                <?php

   ?>      
                </select>


             </form> <br> <hr> <br>
             <!-- note -->
             <p> <label class="labels">Note:</label> </p>
             <br>
                <textarea id ="note" name = "note" rows="5" cols="40"> Write here any special notes to take them into account.</textarea>
             <br> <br> <br>
               <input type = "submit" id="submit" value = "Submit" name="add_request" >
               <a href="Home.php" id="link_id"> <button type = "button" id="bac_requset"> Cancel </button> </a>

        </fieldset>
      </form>
		
		
            
        
    </body>
   
    
</html>