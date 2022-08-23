
<?php 
include 'database_connect.php';
session_start();
$user_id=$_SESSION['id'];
if (isset($_POST['delete'])) {
    
    $pets_id=$_POST['id'];
        $query="delete from pets where id=$pets_id";
    $run=mysqli_query($conn,$query);
    if ($run) {
        echo "<script>alert('1 Pet Deleted')</script>";
    }
    else{
        echo "<script>alert('No pets Deleted')</script>";
    }
}
?>
<!DOCTYPE html>
<!--view list of users pets page-->
<html>
    <head>
        <meta charset="utf-8">
        <title> Happy Paws Clinic  </title>
        <link rel="stylesheet" href="css//list-of-pets-P10.css">
      
    </head>


<?php
 include 'header.php';
?>

    <body class="body_mypets" style=" background-image: url(image//design12.png);">
        <!-- ******************************************** this code in the first lines **********************-->

     <!-- ******************-->
        <h1 class="span_my_pets" ><span >My Pets</span> </h1>
        <div>

        <ul>

<?php  

//  <button type = "submit"  name="delete"><input type="hidden" name="id" value="'.$row_pets->id.'" hidden="hidden"></button> 
								$sql_pets = "select * from pets where user_id=$user_id";
						$Result_pets = mysqli_query($conn, $sql_pets);
                        if (mysqli_num_rows($Result_pets)>0) {
							while ($row_pets = mysqli_fetch_object($Result_pets))

							 {
                              //    <img  src ="images//'.$row_pets->image.'"  class = "icons" width="100" height="100" alt="manage pet profile"  >
                                 echo ' <form action="#" method="POST"> <div>
                                 
                                 <li class="li_my_pets"> '.$row_pets->name.'
                                      <a href="PetProfile.php?id_pets='.$row_pets->id.'">
                                   
                                          <img  src ="image//settingicon.png"  class = "icons" width="20" height="20" alt="manage pet profile"  >
                                      </a> 
                                       <a href="delete.php?id_pets='.$row_pets->id.'">
                                  
                                          <img  src ="image//delete.jpg"  class = "icons" width="20" height="20" alt="manage pet profile"  >
                                      </a> 
                                     
                              
                          </li> 
                      </div></form>';

						}
                    }
                        else
                        { echo '<div>
                            <li class="li_my_pets"> No pets Added Yet..
                                
                     </li> 
                 </div>';          
                        }
                   ?>
        </ul>
        </div>



    </body>
</html>