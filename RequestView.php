<?php
include 'database_connect.php' ;
$id_request=$_GET['id_request'];
$sql_select_request = "select * from request_appointement where id=$id_request";
$Result_request = mysqli_query($conn, $sql_select_request);
    while ($row_request = mysqli_fetch_object($Result_request))
     {
        $name=$row_request->pet;
        $service=$row_request->service;
        $day=$row_request->day; 
        $time=$row_request->time;
        $note=$row_request->note;
        
    }
?>


<!DOCTYPE html>
<html>
    <head>
 <meta charset="utf-8">
 <title> Happy Paws Clinic </title>
 <link rel ="stylesheet" href="css//RequestView_Style.css"> 
 
    </head>
    
    <?php include 'header.php' ?>

    <body class="body_dog_RequestView">
<!-- Title -->
		<h1 class="title_Request">
            Request Details
		</h1>
		
		
		<!-- Request Form Area -->
		<fieldset class="fieldset_dogRequestView" style="height: 470px;">

            <!-- Select a pet -->
            <p> <label class="labels">Pet:</label>
                <span class="requestDetails"> <?php echo $name ?> </span>
            </p> <br>  


            <!-- Select a service -->
            <p> <label class="labels">Service:</label>
                <span class="requestDetails"> <?php echo $service ?> </span>
            </p> <br>


             <!-- Select Date and Time -->
            
            <label class="labels">Date and Time:</label>
               <br>  <br>
            <p> <label class="dayChoices"><?php echo $day ?> <br> </label>
                <span class="requestDetails"><?php echo $time ?> </span> 
            </p>

             <br>

             <!-- note -->
             <p> <label class="labels">Note:</label> </p>
                <textfield id ="note" name = "note" rows="5" cols="40" class="requestDetails"><?php echo $note ?></textfield>
             <br>

             

     <?php 
   $user= $_SESSION['role'] ;
   if($user=='user'){

    echo ' <a href="UserRequests.php"> <button type = "button" id="backRequestView"> Back </button> </a> ';
   }

    else if($user=='admin'){
        echo '  <a href="Manager_Requests.php"> <button type = "button" id="backRequestView"> Back </button> </a>';
   }
        ?>

        
			 

        </fieldset>
		
            
        
    </body>
</html>