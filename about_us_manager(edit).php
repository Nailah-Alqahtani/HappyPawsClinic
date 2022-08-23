

<?php
include 'header.php';
include 'database_connect.php';
 if (isset($_POST['submit'])) {  
  
       $filename= $_FILES["uploadfile"]["name"];
           $tempname=$_FILES["uploadfile"]["tmp_name"];    
            $folder = "images/".$filename;
      $abou = $_POST["aboutus"];
       $location = $_POST["location"];
            
                if($filename!=null){
                 $query="
                           UPDATE about SET about_us='$abou',location='$location',image='$filename' WHERE id=1";
                }
                else{
                $query="
                   UPDATE about SET about_us='$abou',location='$location' WHERE id=1";
                
                }
                	$run=mysqli_query($conn, $query);
 		                    if ($run) {
 		                    	echo '<script>alert("Changes successfully saved");
		                    	 </script>';
                          //  header('location :about_us_maneger(view).php');
                           header('Location:about_us_maneger(view).php');
                      
		                    }
 		                    else {
			                    echo '<script>alert("Changes has not saved ")</script>';
 		                    }
                                  if (move_uploaded_file($tempname, $folder))  {
                                      // echo "Image uploaded successfully";
                                     }else{
                                 // echo  "Failed to upload image";
                             } 
 
 }

?>
<!DOCTYPE html>
<html>
<head>

<meta charset = "utf-8">
<title> Happy Paws Clinic </title>
<meta name = "description" content="Happy Paws Clinic"/>
<link rel ="stylesheet" href="css//style.css">

</head>
<style>

.about_body {
	width:100% !important ;
	min-height:70vw !important;
	background:	#B0E0E6 !important;

	
}
.about_edit_button{
margin: 39px 415px -4px 200px !important;
text-align: center !important;
font-weight: bold !important;
color: #04498A !important;
border-style: solid !important;
border-color: #708090 !important;
border-radius: 30px !important;
padding: 10px !important;
font-family: 'Times New Roman', Times, serif;
font-size: 100%;
position: relative;
top: 164%;
right: 200px;
cursor: pointer;
width: 150px;
	
}
.about_edit_button:hover{
  background-image: url(image/animals.jpg);
color:white;
}
.choose_file{	margin: -6px 499px 4px 206px;
margin: -6px 228px 4px 206px;
text-align: center;
font-weight: bold;
color: #04498A;
border-style: solid;
border-color: #708090;
border-radius: 30px;
padding: 10px;
font-family: 'Times New Roman', Times, serif;
font-size: 48%;
position: relative;
top: 170%;
right: 0px;
cursor: pointer;}

.choose_file:hover{
background-image: url(image/animals.jpg);
color:white;}


.about_edit_button:hover{
background-image: url(image/animals.jpg);
color:white !important;}

.about_back_button{
margin: 15px 414px 9px 205px;
text-align: center;
font-weight: bold;
color: #04498A;
border-style: solid;
border-color: #708090;
border-radius: 30px;
padding: 10px;
font-family: 'Times New Roman', Times, serif;
font-size: 44%;
position: relative;
top: -9%;
right: 202px;
cursor: pointer;
width: 149px;

	
}
.about_back_button:hover{
background-image: url(image/animals.jpg);
color: white;}

.about_us_edit_header{
font-family:"Times New Roman", Times, serif;
	 color:rgb(4,73,138);	
	  font-size:15px;
	
	
}
.box_fieldset{
width: 1000px;
background-image:url(about1.png);
/* height:600px; */
background-size:cover;
background-color:white;
margin:auto;
margin-top: 100px;
 border-radius:3%;
 font-family:'Times New Roman', Times, serif;
}
.box_fieldset h1{
	font-family:"Times New Roman", Times, serif;
	 color:rgb(4,73,138);
	 text-align:center;
	 font-size: 45px;
}
.box_fieldset p{
	 font-family:"Times New Roman", Times, serif;
	 color:GrayText;
	 text-align:center;
	font-size: 18px;

}.image_about{
height: 300px;
margin: 24px;}
</style>
<body class="about_body" style=" overflow-x: hidden;">
<fieldset class ="box_fieldset"  style="overflow:auto">
<div>
<?php
        $query="select * from about where id=1 ";
                $run=mysqli_query($conn,$query);
		while ($row=mysqli_fetch_array($run)) {
    $about= $row['about_us'];
    $image=$row['image'];
    $location=$row['location'];
    }
    ?>
<form method ="Post" action ="#"  enctype="multipart/form-data">
<p ><label><h1 class="about_us_edit_header">About Us<h1><br>
<textarea  class ="about_us_textarea" name ="aboutus" value="" rows="15" cols="75"> <?php    echo  $about;?>
</textarea></label></p>
 
 


<p ><label><h1 class="about_us_ourlocation">Our Location<h1>
<br>
<textarea  class ="about_us_textarea" name ="location" value=""
rows="5" cols="70"><?php    echo  $location;?></textarea></label></p>
     <img src="images/<?php echo $image;?>" alt="Treatment" id="img" class="image_about" style="width:50% width: 50%;height: 300px;">
<div class="">

  </div>
   <?php  

// ?>
  <label for="file" class="choose_file" >Change Photo</label>
  <input type="file" class=""   accept="image/*" id="file" name="uploadfile" accept="image/*" onchange="readURL(this)" style="display:none;">
  

<p ><input  class="about_edit_button" type="submit" name ="submit" value="Update"></p>
<a   href="about_us_maneger(view).php"> <button class="about_back_button" type="button"> Back</button></a>
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
</fieldset>

</body>

</html>

