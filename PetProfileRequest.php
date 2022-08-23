<?php
 include 'header.php';
include 'database_connect.php' ;
?>


<?php  

$id_user=$_GET["id_user"];
$nam=$_GET["pet"];
$sql_select_pets = "select * from pets where user_id='$id_user' and name='$nam'";
$Result_select = mysqli_query($conn, $sql_select_pets);
    while ($row_pets = mysqli_fetch_object($Result_select))
     {
        $name=$row_pets->name;
        $breed=$row_pets->breed;
        $gender=$row_pets->gender; 
        $spayed=$row_pets->spayed;
        $vacci_list=$row_pets->vacci_list;
        $medical_history=$row_pets->medical_history;
        $photo=$row_pets->image;
     }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title> Pet's Profile </title>
        <link rel ="stylesheet" href="css//PetProfileRequest_Style.css"> 
        


    </head>
  
    <body style="background-image: url(image//design.png);">
    
        <h1 id="title">Pet's Profile</h1>        
            
        <div>
          <img src="image//<?php echo $photo ?>" class="profile-photo" style="margin-top: 30px; margin-left: 630px"> 
      </div>
    
      <fieldset class="fieldset_Profile" style="background-image: url(image//fieldset2.png);">
        <p> <label class="labels"> Name: 
           <span class="profileDetails"><?php echo $name; ?>

           </span> 
              </label></p>  <br> 

         <p> <label class="labels"> Breed: 
            <span class="profileDetails"><?php echo $breed; ?>
            </span> 
                </label></p> <br> 

      <label class="labels">Pets Gender :
          <span class="profileDetails"><?php echo $gender; ?>

    </span><br> 
      </label><br>

      <label class="labels">Is your pet spayed/neutered? :
          <span class="profileDetails"><?php echo $spayed; ?>
        </span><br> 
      </label><br>

        <label class="labels">vaccinations list :
             <span class="profileDetails"><?php echo $vacci_list; ?></span>
            <br> 
        </label><br>

        <label class="labels">
            Pets medical history :
                <span class="profileDetails"> <?php echo $medical_history; ?></span><br> 
        </label><br>


        
   <?php 
   $user= $_SESSION['role'] ;
   if($user=='user'){

    echo '  <a href="UserRequests.php"> 
       <button type = "button" id="back">Back</button> </a>';
   }

    else if($user=='admin'){
        echo '  <a href="Manager_Requests.php"> 
        <button type = "button" id="back">Back</button> </a>';
   }
        ?>

</fieldset>
    </body>
</html>