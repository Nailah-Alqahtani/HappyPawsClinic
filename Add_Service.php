
<?php 
require_once "database_connect.php"; 

	if (isset($_POST['add_service'])) {

		$name=$_POST['service_name'];
     $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
        $folder = "images/".$filename;
		$Description=$_POST['Description'];
		$service_Price=$_POST['service_Price'];
	
		$query="INSERT INTO services(name,descr, price,image)
     VALUES ('$name','$Description','$service_Price','$filename')";
     	$run=mysqli_query($conn,$query);
        // Creation validation !!
     	if ($run) {
			//echo "record created successfully";
		}
		else{
		//echo "Error: " . $query . "<br>" . $conn->error;
		}
    
	}
?>
<?php
    include 'header.php'
    ?>
    <head>
    <link rel ="stylesheet" href="css//Add_Service.css">
    </head>
    <style>
        
 .body_add_service {
     position: relative;
     background-image: url("image//bg.png");
     background-repeat: repeat-y;
     background-color: powderblue;
     background-size: 1500px 905px;
 }
 
 .solid {
    border-radius: 50px;
    border-color: transparent;
    margin-top: 20px;
    padding: 30px 60px;
    margin-left: 400px;
    margin-right: 360px;
    background-image: url(image//borderBG.png);
    height: 400px;
    margin-bottom: 20px;
 }
 
 .add_new_service {
     background-color: rgb(4, 73, 138);
     color: white;
     text-align: center;
     border-radius: 100px;
     padding: 10px;
     font-size: 35px;
     font-family: "Times New Roman", "Serif";
     margin-left: 430px;
     margin-right: 400px;
     margin-top: 30px;
     margin-bottom: -10px;
 }
 
 .sub_service {
     color: white;
     border-radius: 5px;
     margin-top: 200px;
     margin-bottom: 100px;
     margin-right: 10px;
     font-size: 21px;
     padding: 7px;
 }
 
 .button_submit {
     background-color: transparent;
     margin-top: 30px;
     margin-left: 40px;
     text-align: center;
     font-weight: bold;
     color: #04498A;
     border-style: solid;
     border-color: rgb(4, 73, 138);
     border-radius: 30px;
     padding: 10px 80px;
     font-family: 'Times New Roman', Times, serif;
     font-size: 140%;
 }
 
 .button_submit:hover {
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
    width: 150px;
    position: relative;
    top: 13px;
    right: 112px;
    margin-left: 750px;
    margin-bottom: 30px;
    margin-top: 10px;
 }
 
 .lable_add_photo {
    position: absolute;
    color: rgb(4, 27, 78);
    top: 340px;
    left: 655px;
    padding: 5px 10px;
    border-radius: 50px;
    z-index: 3;
    font-size: 15px;
    cursor: pointer;
    font-weight: 700;
    background-color: #708090;
    margin: 14px;
 }

    </style>
<body class="body_add_service">

  <!--       ********************* End of header   *********************   -->

    <h1 class="add_new_service">Add A New Service: </h1>
    <br>

      <!-- <form action="Add_Service.php" method="post" enctype="multipart/form-data"> -->
                <!--profile photo - allow user to upload photo -->
               <!-- <div> <input type="file" name="uploadfile" id="file" accept="image/*" required onchange="readURL(this)">  
            <label for="file" class="change-lable_add_photo">Add Photo</label></div>
            <div>
                <img src="image//service.png" class="profile-photo" id="img" style='height:150px;'> 
            </div>
          </form> -->

  
    <form method="post" action="Add_Service.php" enctype="multipart/form-data">
      
    <div> <input type="file" name="uploadfile" id="file" accept="image/*" required onchange="readURL(this)">  
            <label for="file" class="lable_add_photo">Add Photo</label></div>
            <div>
                <img src="image//service.png" class="profile-photo" id="img" style='height:150px;'> 
            </div>

        <div class="solid">
		   <label ><span class="sub">&nbsp;&nbsp; service name: 
  	   <input type="text" name="service_name"size = "35" required> </label> 
       <br>
    
     <br><hr>

      <label> <br> <span class="sub">&nbsp;&nbsp; Description :&nbsp;&nbsp;</span><br>
  		<textarea name="Description" rows = 5 cols = 40  style="margin-left:20px; " required>
      </textarea>
  	</label>

       <br><br><hr><br>

    <label><span class="sub_service">&nbsp;&nbsp; service Price: &nbsp;&nbsp;
  	<input type="number" name="service_Price" min="10" max="500" required>  </span></label><br>
   
       <br>
      <!-- <span ><a href="home-manager.html"> -->
      <span ><a href="Home.php"><button type="button" class = "button_submit"  >Back</button></a></span>
      <button type="submit" class = "button_submit" onclick="warning()" name="add_service">Add</button>
    <!-- </a> -->
        </div> 
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
  function warning(){
    var pic_value = document.getElementById("file").value ;
    if(pic_value == "")
        alert("Please enter an image");
    else
        alert("Service added successfully!");
  }
  </script>

</body>
</html>