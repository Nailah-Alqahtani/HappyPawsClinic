<?php 
  error_reporting(0); 
	session_start();
  $user_id= $_SESSION['id'];
$req_id=$_GET['updaterequest'];
require_once "database_connect.php";
// $service_name=$_POST['id_service'];
// echo $service_name;
		if (isset($_POST['update_request'])) 
        {
      
        $pet=$_POST['pet'];
   
		 $service=$_POST['service'];
		 $note=$_POST['note'];
		// $time=$time.$time_Available;
		$id_appoointement=$_POST['app_id'];
		// $day=$_POST['day'];
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
        break;
        }
        }

$query="UPDATE request_appointement
SET pet='$pet',service='$service',day='$da',time='$tim',note='$note',status='waiting'
 WHERE id=$req_id";
 $run=mysqli_query($conn, $query);
 if ($run) {
   echo '<script>alert("Request Edited");
   </script>';
}
 else {
  echo '<script>alert("Request Is Not Edited")</script>';
 }

        }
		
?>
<!DOCTYPE html>
<html>

    <head>

 <meta charset="utf-8">
 <title> Happy Paws Clinic </title>
 <link rel ="stylesheet" href="css//UpdateRequestForm_Style.css"> 

<script>
	function	select_service(){
   var select =  document.getElementById('ser');
var value = select.options[select.selectedIndex].value;

// alert(value);
console.log(value);
  document.getElementById('id_service').value=value;
  document.getElementById('id_service').submit;

  var xmlhttp;
           
           if (window.XMLHttpRequest)
               xmlhttp = new XMLHttpRequest();
           else
               xmlhttp = new ActiveXobject(" Microsoft.XMLHTTP");
           xmlhttp.onreadystatechange = function() {
               if (xmlhttp.readyState == 4 & xmlhttp.status == 200) 
               document.getElementById("dat").innerHTML = xmlhttp.responseText;
           }
           xmlhttp.open("GET", "get_time_service.php?value=" + value, true);
           xmlhttp.send();

   }
   function select(){
   var select =  document.getElementById('dat');
var value = select.options[select.selectedIndex].value;

// alert(value);
console.log(value);
  document.getElementById('id').value=value;
   }
    </script>


   
    </head>

    <body style= "background-image:url(image/design.png);">
<?php   include 'header.php'; ?>
     
        <!-------------------------->
		
		
		<!-- Title -->
		<h1 class="title">
		Request an Appointment
		</h1>
	
		<!-- Request Form Area -->
    <form method="post" action="#">
      <!-- fieldset_requestEdit -->
		<fieldset class="" style= "background-image:url(image//fieldset2.png);">

            <!-- Select a pet -->
            <p> <label class="labels">Pet:</label>
                <select name ="pet" required>
                 <?php


$query_request="SELECT * FROM request_appointement where id=$req_id";
        $result_request=mysqli_query($conn,$query_request);
        while ($row_request=mysqli_fetch_array($result_request)) 
        {
            $name_pets=$row_request['pet'];
            $name_service=$row_request['service'];
            $dayrequest=$row_request['day'];
            $note=$row_request['note'];
        }
   



							
	 $query="SELECT id, name FROM pets where user_id=$user_id";
        $result=mysqli_query($conn,$query);
        while ($row=mysqli_fetch_array($result)) {
          if($row['name']==$name_pets){
            echo "<option value=".$row['name'] . " selected>" . $row['name'] . "</option>";
          }
          else
          echo "<option value=".$row['name'] . ">" . $row['name'] . "</option>";
          }
   ?>
                   
                </select>
            </p> <br><hr><br> 


            <!-- Select a service -->
            <p> <label class="labels">Service:</label>
                <select name = "service" id="ser" required onchange="select_service()">
                <?php
						
        /*$query="SELECT id,day, time,services FROM appaintments_available where status='Available'";
        $result=mysqli_query($conn,$query);
        while ($row=mysqli_fetch_array($result)) {
            if($row['services']==$name_service){
 echo "<option value=".$row['services'] . " selected>" . $row['services'] . "</option>";
            }else
            echo "<option value=".$row['services'] . " >" . $row['services'] . "</option>";
        } */
        $query="SELECT name FROM services";
$result=mysqli_query($conn,$query);
while ($row=mysqli_fetch_array($result)) {
  if($row['name']==$name_service){
    echo "<option value=".$row['name'] . " selected>" . $row['name'] . "</option>";
               }else
               echo "<option value=".$row['name'] . " >" . $row['name'] . "</option>";}
   
   ?>
											
                  
                </select>
            </p> <br><hr><br> 
<p> <label class="labels">Available Dates and Times:</label>
<br>
<input type="hidden"  name="app_id" id="id" value="0">
<input type="hidden"  name="id_service" id="id_service" value="0">
                <select name = "date" id="dat"  onchange="select()" >
                
                <?php
		
 $query="SELECT id,day, time,services FROM appaintments_available where status='Available' and services = '$name_service'";
        $result=mysqli_query($conn,$query);
        while ($row=mysqli_fetch_array($result)) {
              if($row['day']==$dayrequest){
            echo "<option value=".$row['id']." selected>" . date('D', strtotime($row['day'])).'['.date('F', strtotime($row['day'])).'-'. date('d', strtotime($row['day'])). ']'. $row['time']."</option>";
        }else
        echo "<option value=".$row['id'].">" . date('D', strtotime($row['day'])).'['.date('F', strtotime($row['day'])).'-'. date('d', strtotime($row['day'])). ']'. $row['time']."</option>";
      } 
   ?>
                </select>
                <br><br><hr><br> 

             <!-- note -->
             <p> <label class="labels">Note:</label> </p>
                <textarea id ="note" name = "note" rows="5" cols="40"><?php echo $note; ?></textarea>
             <br>
               <input type = "submit" id="submit" value = "Update"  name="update_request" style="bottom: 30px;">
               <a href="UserRequests.php"> <button type = "button" id="bac_requset"  style="bottom: 75px;"> Back </button> </a>


             
        </fieldset>
      </form>
		
		
            
        
    </body>
   
    
</html>