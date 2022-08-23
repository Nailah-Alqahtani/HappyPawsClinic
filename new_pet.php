<?php  
	session_start();
require_once "database_connect.php";
//if( $_SESSION['loginuser']!=null){
$user_id=$_SESSION['id'];
//$user_id= "select id from owner where email= '$_SESSION['loginuser']'  ";
//$user_id=mysqli_query($conn,$query);

//}
		if (isset($_POST['add_pets'])) 
        {
   
        $Pet_name=$_POST['pet_name'];
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
        $folder = "images/".$filename;
		$pet_gender=$_POST['pet_gender'];
		$stats=$_POST['stats'];
		$Breed=$_POST['Breed'];
		$vacc_list=$_POST['vacc_list'];
		$medical_history=$_POST['medical_history'];
		$date_of_birth=$_POST['date_of_birth'];

		$query="INSERT INTO pets( name, date_of_birth, gender, user_id, breed, spayed, vacci_list, medical_history, image)
     VALUES ('$Pet_name','$date_of_birth','$pet_gender',$user_id,'$Breed','$stats','$vacc_list','$medical_history','$filename')";
		if ($conn->query($query) === TRUE) 
        $last_id = $conn->insert_id;
        header("Location: List_Of_Pets.php");
    // echo "successfully";
    //   echo "New record created successfully. Last inserted ID is: " . $last_id;
    } else {
  //echo "Error: " . $query . "<br>" . $conn->error;
    }
 
		
?>
<!DOCTYPE html>
<html>
<head>
	<title>Happy Paws Clinic</title>
	<link rel ="stylesheet" href="css//add_pet.css">
</head>
<style>
    
#file {
    display: none;
}

.profile-lable {
    background-color: gray;
    border-radius: 150px;
    overflow: hidden;
    border-style: solid;
    border-color: rgb(4, 73, 138);
    border-width: 10px;
    width: 140px;
    position: r;
    top: 210px;
    right: 600px;
    margin-left: 600px;
    margin-top: 20px;
}

.change-lable_Add_Photo {
    position: absolute;
    color: rgb(4, 27, 78);
    top: 375px;
    left: 630px;
    padding: 5px 10px;
    border-radius: 50px;
    z-index: 3;
    font-size: 15px;
    cursor: pointer;
    font-weight: 700;
    background-color: #708090;
    margin: 10px;
}


/* ____________________________________________________________ */

.body_add_pet {
    position: relative;
    background-image: url("image//bg.png");
    background-size: cover;
    background-size: 1500px 1000px;
    background-repeat: repeat-y;
}

.title_add_new_pet {
    background-color: rgb(4, 73, 138);
    color: white;
    position: relative;
    text-align: center;
    border-radius: 100px;
    padding: 10px 50px;
    font-size: 35px;
    margin-right: 390px;
    margin-left: 360px;
    margin-top:30px;
}


div.pg6 {
    border-style: solid;
    border-radius: 50px;
    border-color: transparent;
    padding: 30px 80px;
    margin-left: 350px;
    margin-right: 360px;
    background-image: url(image//borderBG.png);
    margin-bottom: 15px;
}

.sub {
    font-family: "Times New Roman", "Serif";
    font-size: 21px;
    text-align: left;
    color: white;
    border-radius: 5px;
    margin-top: 70px;
    margin-bottom: 100px;
    padding: 7px;
    padding-bottom: 10px;
    font-size: 21px;
    margin-right: 10px;
}

.sub2 {
    font-family: "Courier New", "Monospace";
    font-size: 16px;
}

.button {
    background-color: transparent;
    text-align: center;
    font-weight: bold;
    color: #04498A;
    margin-right: 10px;
    margin-left: 40px;
    border-style: solid;
    border-color: rgb(4, 73, 138);
    border-radius: 30px;
    padding: 10px 80px;
    font-family: 'Times New Roman', Times, serif;
    font-size: 125%;

    }


.button:hover {
    background-image: url(image//animals.jpg);
    color: white;
}


.profile-photo {
    background-color: gray;
    border-radius: 150px;
    overflow: hidden;
    border-style: solid;
    border-color: rgb(4, 73, 138);
    border-width: 10px;
    width: 140px;
    position: r;
    top: 170px;
    right: 630px;
    margin-left: 640px;
    margin-bottom: 30px;
}
.profile-photo {
    background-color: gray;
    border-radius: 150px;
    overflow: hidden;
    border-style: solid;
    border-color: rgb(4, 73, 138);
    border-width: 10px;
    width: 140px;
    position: r;
    top: 210px;
    right: 600px;
    margin-left: 600px;
    margin-top: 20px;
}

img.profile-photo {
    margin-left: 43%;
}

</style>

<?php include 'header.php' ?>

<body class="body_add_pet">


		<!-- ********************* Header end ********************* -->
    <h1 class="title_add_new_pet">Add a new Pet :</h1>

      <br><br>
 <form method="post" action="new_pet.php" enctype="multipart/form-data">
 <div> <input type="file" name="uploadfile" id="file" accept="image/*"  required onchange="readURL(this)">  
            <label for="file" class="change-lable_Add_Photo">Add Photo</label></div>
            <div>
                <img src="image//profile.png" class="profile-photo " id="img" style='height:150px;'> 
            </div>
  <div id="page6_border" class="pg6">
         <!--profile photo - allow user to upload photo -->
               <!-- <div> <input type="file" name="file" id="file" accept="image/*" required>  
            <label for="file" class="change-lable_Add_Photo">Add Photo</label></div>
            <div>
                <img src="image//profile.png" class="profile-photo"> 
            </div> -->

	<input type="hidden" name="recipient" value="deitel@deitel">
	<input type="hidden" name="subject" value="Add pet">
	<input type="hidden" name="redirect" value="main.html">

   <label> <span class="sub"> Pets name:
  	<input  type="text" name="pet_name"size = "40" required> </span></label> 
  	
  	<br><br><hr>

  	<label><span class="sub">Pets date of birth: 
  	<input type = date name="date_of_birth"   required></span></label> 

  	<br><br><hr>

	<span class="sub">Pets Gender :
  	
  	<label><span class="sub2">Female </span>
  	<input name="pet_gender" type ="radio" value = "F" required></label>
  	<label> <span class="sub2">Male </span>
  	<input name="pet_gender" type ="radio" value = "M" required></label></span>

  	<br><br><hr>

  	<label><span class="sub">Breed: &nbsp;&nbsp;
  	<input name="Breed" type="text" name="breed"size = "25" required> 
    </span></label> 

  	<br><br><hr>
    <!--
	<span class="sub"> add your pets photo : &nbsp;&nbsp;
  	 <input type="file" name="pet_photo" accept="image" required />
	</span>

  	<br><br><br>  -->

	<!--this form from:  https://stackoverflow.com/questions/13350781/how-to-allow-users-to-add-image-for-their-profile -->
    
	<span class="sub">	Is your pet spayed/neutered? : &nbsp;&nbsp;
  	<label><span class="sub2">Yes </span>
  	<input name="stats" type ="radio" value = "yes" required></label>
  	<label><span class="sub2">No </span>
  	<input name="stats" type ="radio" value = "no" required></label>
  	</span>

  	<br><br><hr>

  	<label><span class="sub">vaccinations list : </span><br>
  		<textarea name="vacc_list" rows = 3 cols = 40> this field is optional
  		</textarea>
  	</label>

  	<br><hr>

  	<label><span class="sub">Pets medical history :</span><br>
  		<textarea name="medical_history" rows = 3 cols = 40>this field is optional</textarea>
  	</label><br><br>

    <span ><a href="Home.php"><button type="button" class = "button"  >Back</button></a></span>
    <span ><button type="submit" class = "button" onclick="warning()" name="add_pets"> Add </button></span>




</div>
</form>

    <br><br>
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
  function warning(){
    var pic_value = document.getElementById("file").value ;
    if(pic_value == "")
        alert("Please enter an image");
  }
  </script>

</body>
</html>