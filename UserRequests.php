<?php 
include 'database_connect.php';
if (isset($_POST['OK'])) {
    
    $id_request=$_POST['id_request'];
    $query1="update request_appointement
    set  status='accept' where id=$id_request";
 $run=mysqli_query($conn, $query1);
    if ($run) {
        echo "<script>alert('Request Accepted')</script>";
    }
    else{
        echo "<script>alert('Request Declined')</script>";
    }
}
if (isset($_POST['NO'])) {
    $id_request=$_POST['id_request'];
        $query="delete from request_appointement where id=$id_request";
    $run=mysqli_query($conn,$query);
    if ($run) {
        echo "<script>alert('Request Deleted')</script>";
    }
    else{
        echo "<script>alert('Request Is Not Deleted')</script>";
    }
}
?>
<!DOCTYPE html>
<html>

    <head>

 <meta charset="utf-8">
 <title> Happy Paws Clinic </title>
 <link rel ="stylesheet" href="css//UserRequests_Style.css">

    </head>

    <body>
<?php include 'header.php'?>
       	 	<!-- The header of the page -->

		
		
		<!-- Title -->
		<h1 class="title">
		Appointments Requests
		</h1>
		
		
		
		<!-- List of Requests -->
		<div class="List">
		<ul>
		
		     <?php
             $user_id=$_SESSION['id'];
 $sql_select_request= "SELECT request_appointement.id, request_appointement.pet,request_appointement.user_id,pets.image
FROM request_appointement
INNER JOIN pets ON  request_appointement.pet = pets.name and request_appointement.user_id=pets.user_id 
     where request_appointement.status='waiting' and request_appointement.user_id='$user_id' ;";
     
$Result_request = mysqli_query($conn, $sql_select_request);
$count=1;
    while ($row_request = mysqli_fetch_object($Result_request))
     {
        $name_pet=$row_request->pet;
        $id_=$row_request->id;
        $id_user=$row_request->user_id;
        $iamge=$row_request->image;
       

                echo '
                <form action="#" method="POST">
      <div >
      <li id="liDog" style="background-size: 150px; margin-top: 60px;background-image: url(images//'.$iamge.');"> '.$count.'-Appointment Request
      <div class="icon">
          <a  href="PetProfileRequest.php?id_user='.$id_user.'&pet='.$name_pet.'">
          <img src="image/paw.png" class="icons" width="30" height="30" alt="view profile"></a>
          <a  href="RequestView.php?id_request='.$id_.'">
          <img src="image/visit.png" class="icons" width="30" height="30" alt="view request"></a>
          
          <a href="UpdateRequestForm.php?updaterequest='.$id_.'"  style="text-decoration: none;">
       
    
          <img src="image/settingicon.png" class="icons" width="30" height="30" alt="edit Request">
          </a>
          <a href="delete.php?delete_request='.$id_.'" >
        
          <input type="hidden" name="id_request" value="'.$id_.'" hidden="hidden">
          <img src="image/delete.jpg" class="icons" width="30" height="30" alt="delete request">
     
          </a>
          </div>
      </li>
  </div>
  </form>
                ';
$count=$count+1;
            }
        ?>   
        
		
		</ul>
		</div>
		
		
            
        
    </body>
</html>