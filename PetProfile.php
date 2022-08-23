
<?php 

include 'database_connect.php' ;
$id_pets=0;

if(isset($_GET["id_pets"])){
$id_pets=$_GET["id_pets"];

$sql_select_pets = "select * from pets where id=$id_pets";
$Result_select = mysqli_query($conn, $sql_select_pets);
    while ($row_pets = mysqli_fetch_object($Result_select))
     {
     $id_pet=$row_pets->id;
        $name=$row_pets->name;
        $breed=$row_pets->breed;
        $gender=$row_pets->gender; 
        $spayed=$row_pets->spayed;
        $vacci_list=$row_pets->vacci_list;
        $medical_history=$row_pets->medical_history;
        $photo=$row_pets->image;
        
     
     }
     }
 	if (isset($_POST['update_pets'])) {
 		
          $id=$_POST["id"];
           $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
        $folder = "images/".$filename;
          $name=$_POST["name"];
          $breed=$_POST["breed"];
 		 $pet_gender=$_POST["pet_gender"];
 		 $stats=$_POST["stats"];
          $vacci_list=$_POST["vacc_list_vaccinations_list"];
          $medical_history=$_POST["vacc_list_medical_history"];
          if($filename!=null){
          
           $query1="update pets
       
            set  name='$name',gender='$pet_gender',
            breed='$breed',spayed='$stats',vacci_list='$vacci_list',
            medical_history='$medical_history',image='$filename'  where id=$id";
          
          
          }
          else{
           $query1="update pets
       
            set  name='$name',gender='$pet_gender',
            breed='$breed',spayed='$stats',vacci_list='$vacci_list',
            medical_history='$medical_history'  where id=$id";
          
          }
/*
          echo $name;echo '\n';echo $age; echo '\n';echo  $breed ;echo '\n';
          echo $pet_gender;echo '\n';echo $stats;echo '\n'; echo $vacci_list;
          echo '\n';echo $medical_history;

*/

 		 

 		$run=mysqli_query($conn, $query1);
 		if ($run) {
 			echo '<script>alert("Edited Successfully");
			 </script>';
             header("Location: List_Of_Pets.php");
		}
 		else {
			echo '<script>alert("Error Editing")</script>';
        
    
 		}
         if (move_uploaded_file($tempname, $folder))  {
            // echo "Image uploaded successfully";
        }else{
            // echo  "Failed to upload image";
      }


 	}
?>


<?php include 'header.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title> Happy Paws Clinic </title>
    <link rel="stylesheet" href="css//help_profile.css">

  <style>
     .change-lable {
    position: absolute;
    left: 680px;
    z-index: -1;
    
  }
  #button:hover {
      background-image: url(image/animals.jpg); 
       color: white;
  } 
  #submit:hover {
      background-image: url(image/animals.jpg); 
       color: white;
  } 
    </style>
</head>

<?php  


?>


<body class="Pets_Profile" style="background-image: url(image/bg.png)" >
    <!-- ******************-->
    <h1 class="" style="font-family: 'Times New Roman', Times, serif;
    color: white;
    margin-top: 20px;
    text-align: center;
    border-radius: 50px;
    background-color: rgb(4, 73, 138);
    width: fit-content;
    padding: 10px 25px;
    margin-left: 44%; 
    margin-bottom: 10px;"> Pet's Profile </h1>

    <form action="PetProfile.php" method="post" enctype="multipart/form-data">
        <!--profile photo - allow user to upload photo -->
        <div> <input type="file" name="uploadfile" id="file" accept="image/png, image/jpeg"  onchange="readURL(this) " style="display: none;">
            <label for="file" class="change-lable" >Change Photo</label></div>
        <div>
            <img src="images//<?php echo $photo ?>" class="" id="img"  style="border-radius: 50%;

    overflow: hidden;
    border-style: solid;
    border-color: #708090;
    border-width: 10px;
    width: 141px;
    margin-left: 47%;
    height: 150px;">
        </div>


        <fieldset class="fieldset_Profile" style="background-image: url(image//fieldset2.png); ">


        <p> 
                <input type= "hidden" name="id" size="20" maxlength="25" value="<?php echo $ids= $_GET["id_pets"]; ?>" required>
                 </p>
            <p> <label> Name: 
                <input type= "text" name="name" size="20" maxlength="25" value="<?php echo $name; ?>" required>
                  </label></p>
           
            <p> <label> Breed: 
                 <input type= "text" name="breed" size="20" maxlength="25" value="<?php echo $breed; ?>" required>
                    </label></p>
            <span class="sub"><b>Pets Gender :</b>
  	
                      <label><span class="sub2">Female </span>
            <input name="pet_gender" type="radio" value="F" <?php if($gender=='F') echo 'checked'; ?> required></label>
            <label> <span class="sub2">Male </span>
                      <input name="pet_gender" type ="radio" value = "M"  <?php if($gender=='M') echo 'checked'; ?> required></label></span><br><br>

            <span class="sub"><b>	Is your pet spayed/neutered? : &nbsp;&nbsp;</b>
                      <label><span class="sub2">Yes </span>
            <input name="stats" type="radio" value="yes" <?php if($spayed=='yes') echo 'checked'; ?> required></label>
            <label><span class="sub2">No </span>
                      <input name="stats" type ="radio" value = "no" <?php if($spayed=='no') echo 'checked'; ?> required></label>
            </span><br><br>
            <label><span class="sub">vaccinations list : </span><br>
                        <textarea name="vacc_list_vaccinations_list" rows = 3 cols = 40> <?php  echo $vacci_list; ?> 
                        </textarea>
                      </label><br>
            <label><span class="sub">Pets medical history :</span><br>
                        <textarea name="vacc_list_medical_history" rows = 3 cols = 40><?php  echo $medical_history; ?> </textarea>
                      </label><br>
            <br>
            <input type="submit" id="submit" value="Update" name="update_pets">
            <!-- <a href="List_Of_Pets.php">  -->
            <button type="button" id="button" onclick="location.href='List_Of_Pets.php'"> Back </button> 
            <!-- </a> -->
        </fieldset>
      
    </form>
     <script>
  function readURL(input) {
    if (input.files && input.files[0]) {
    
      var reader = new FileReader();
      reader.onload = function (e) { 
        document.querySelector("#img").setAttribute("src",e.target.result);
      };

      reader.readAsDataURL(input.files[0]); 
    }
  }
  </script>
     
</body>

</html>