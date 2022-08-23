<!DOCTYPE html> 
<html>

<head>

    <title> Happy Paws Clinic </title>
    <meta name="description" content="Happy Paws Clinic" />
    <!-- <link rel="stylesheet" href="css//style.css"> -->
    <style>
    .change_pass{
    text-decoration: none;}
  
    .user_profile{
        width: 50%;
    background-color: white;
    border-radius: 40px;
    margin: auto;
    margin-top: 100px;
    padding: 30px; font-family: 'Times New Roman', Times, serif;}
    .img_profile {
    width: 20%;
    /* margin: auto; */
    margin-left: 40%;
    border-radius: 50%;
    border: 1px solid;
    font-weight: bold;
}
.input{ 
    width: auto;
    margin: 0 auto;
     margin-left: 16%;
        font-weight: bold;}
    
.input input{
      width: 260px;}
.select_image {
    margin: auto;
    margin-left: 42%;
}.button_profile{
    background-color: transparent;
    margin: 20px 498px -40px 440px;
    text-align: center;
    font-weight: bold;
    color: #04498A;
    border-style: solid;
    border-color: #708090;
    border-radius: 30px;
    padding: 10px;
    font-family: 'Times New Roman', Times, serif;
    font-size: 100%;
    position: relative;
    top: 15%;
    right: 200px;
    cursor: pointer;
    width: 150px;}
    .button_profile:hover{
        background-image: url(image/animals.jpg);
color:white;
    }
    a:hover{
    text-decoration: unset;background-color: unset;}
    .Pass-body {
    width: 100%;
    min-height: 60vw;
    background-color: #B0E0E6;
}
</style>
</head>
<?php
error_reporting(0);
include 'header.php';
include 'database_connect.php';
$id = $_SESSION['id'];

if (isset($_POST['delete'])) {
    // $id_user=$_POST['id'];
    $query = "delete from owner where id=$id";
    $run = mysqli_query($conn, $query);
    if ($run) {
        echo '<script>

window.location="login.php";

</script>';
        session_destroy();
        // header('Location:login.php');

        echo "<script>alert('Account deleted')</script>";
    } else {
        echo "<script>alert('Account not deleted')</script>";
    }
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

    if (isset($_POST['update_data'])) {
        if (isset($_SESSION['role'])) {
            $user = $_SESSION['role'];
            if ($user == 'user') {
               /* $filename = $_FILES['uploadfile']['name'];
                $tempname = $_FILES['uploadfile']['tmp_name'];
                $folder = 'images/'.$filename;*/

                $img = $_FILES['uploadfile']['tmp_name'];
       $filename = addslashes(file_get_contents($img));

                $first = $_POST['first'];
                $last = $_POST['last'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $gender = $_POST['gender'];
                // start validate
                if (empty($_POST['first'])) {
                    echo "<script>alert('name required');</script>";

                    return false;
                } else {
                    $first = test_input($_POST['first']);
                    // check if name only contains letters
                    if (!preg_match("/^[a-zA-Z-' ]*$/", $first)) {
                        echo "<script>alert('First Name Only letters and white space allowed');</script>";

                        echo '<script>window.location="user_manager_profile.php";</script>';

                        return false;
                    }
                }
                if (empty($_POST['last'])) {
                    echo "<script>alert('name required');</script>";

                    return false;
                } else {
                    $last = test_input($_POST['last']);
                    if (!preg_match("/^[a-zA-Z-' ]*$/", $last)) {
                        echo "<script>alert(' Last Name Only letters and white space allowed');</script>";

                        echo '<script>window.location="user_manager_profile.php";</script>';

                        return false;
                    }
                }
                if (empty($_POST['email'])) {
                    echo "<script>alert('email required');</script>";

                    return false;
                } else {
                    $email = test_input($_POST['email']);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo "<script>alert('You have entered an invalid email address!');</script>";
                        echo '<script>window.location="user_manager_profile.php";</script>';

                        return false;
                    }
                }
                if (empty($_POST['phone'])) {
                    echo "<script>alert('phone required');</script>";

                    return false;
                } else {
                    $phone = test_input($_POST['phone']);
                    if (strlen($phone) != 10) {
                        echo "<script>alert('You have entered an invalid Phone Number!');</script>";
                        //    $nameErr = "Only letters and white space allowed";
                        echo '<script>window.location="user_manager_profile.php";</script>';

                        return false;
                    }
                }

                //   end validate
                $sql_select = "select * from owner where email='$email' and id !='$id' ";
                $sql_select2 = "select * from manager where email='$email' and id !='$id'";
                $Result_email = mysqli_query($conn, $sql_select);
                $Result_email2 = mysqli_query($conn, $sql_select2);
                if (mysqli_num_rows($Result_email) > 0 || mysqli_num_rows($Result_email2) > 0) {
                    while ($row_user = mysqli_fetch_object($Result_email)) {
                        echo '<script>alert(" Email already exist")</script>';
                    }
                } else {
                    if ($filename != null) {
                        $query = "
                            UPDATE owner
                          SET first='$first',phone='$phone',
                          last='$last',
                            gender='$gender',email='$email',image='$filename'WHERE id=$id";
                    // echo '<script>alert("  '.$filename.'")</script>';
                    } else {
                        $query = "
                            UPDATE owner
                              SET first='$first',phone='$phone',
                            last='$last',
                             gender='$gender',email='$email' WHERE id=$id
                            ";
                    }
                    $run = mysqli_query($conn, $query);
                    if ($run) {
                        echo '<script>alert("Changes successfully saved");
		                    	 </script>';
                    //   header("Location: List_Of_Pets.php");
                    } else {
                        echo '<script>alert("Changes has not saved")</script>';
                    }
                    if (move_uploaded_file($tempname, $folder)) {
                        // echo "Image uploaded successfully";
                    } else {
                        // echo  "Failed to upload image";
                    }
                }
            }
        }
        if (isset($_SESSION['role'])) {
            $user = $_SESSION['role'];
            if ($user == 'admin') {
                $email = $_POST['email'];
                if (empty($_POST['email'])) {
                    echo "<script>alert('email required');</script>";

                    return false;
                } else {
                    $email = test_input($_POST['email']);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo "<script>alert('You have entered an invalid email address!');</script>";
                        echo '<script>window.location="user_manager_profile.php";</script>';

                        return false;
                    }
                }
                $sql_select = "select * from owner where email='$email' ";
                $sql_select2 = "select * from manager where email='$email'";
                $Result_email = mysqli_query($conn, $sql_select);
                $Result_email2 = mysqli_query($conn, $sql_select2);
                if (mysqli_num_rows($Result_email) > 0 || mysqli_num_rows($Result_email2) > 0) {
                    while ($row_user = mysqli_fetch_object($Result_email)) {
                        echo '<script>alert(" Email already exist, try another one!")</script>';
                        echo'<script> location.replace("user_manager_profile.php"); </script>';
                        //  header('Location:Change_pass_for_manager.php');
                        return;
                    }
                } else {
                    $query = " UPDATE manager SET email='$email' WHERE id=$id";
                }
                $run = mysqli_query($conn, $query);
                if ($run) {
                    echo '<script>alert("Changes has been successfully saved");
		                    	 </script>';
                } else {
                    echo '<script>alert("Changes has not saved")</script>';
                }
            }
        }
    }
?>
<body class="Pass-body" style=" overflow-x: hidden; background-image: url(image/design.png);   background-size: cover; ">
    <?php
$sql_select_users = "select * from owner where id=$id";
$Result_users = mysqli_query($conn, $sql_select_users);
if (mysqli_num_rows($Result_users) > 0) {
    $row = mysqli_fetch_row($Result_users);
        $email=$row[1];
        $phone=$row[3];
        $first_name = $row[4];
        $last_name = $row[5];
        $gender = $row[6];
        $photo = $row[7];
        $zero="0";
    
}

$sql_select_users2 = "select * from manager where id=$id";
$Result_users2 = mysqli_query($conn, $sql_select_users2);
if (mysqli_num_rows($Result_users2) > 0) {
    $row = mysqli_fetch_row($Result_users2);
        $email2=$row[1];
      
        
    
}


?>
    <form name="form_profile" action="user_manager_profile.php" method="POST" enctype="multipart/form-data" onsubmit="return  validateForm()">
        <!-- <fieldset class="manage2" style="overflow:auto"> -->
            <div class="user_profile">
                <!-- <img src="images//<?php echo $photo; ?>" alt="Forest" style="width:20%" id ="img" class="img_profile"><br><br>
  
                 <br><br> -->
                <?php
 if (isset($_SESSION['role'])) {
     $user = $_SESSION['role'];
     if ($user == 'user') {

        if($photo!=""){
            echo'<img src="data:image/jpeg;base64,'.base64_encode($photo).'" alt="Forest" style="width:20%" id ="img" class="img_profile"><br><br>
            <label for="file" class="select_image">Select image</label><br>
            <input type="file" class="select-user" id="file" name="uploadfile" accept="image/*" onchange="readURL(this)">';}
   
        else{
            echo'<img src="image/user profile.png" alt="Forest" style="width:20%" id ="img" class="img_profile"><br><br>
            <label for="file" class="select_image">Select image</label><br>
            <input type="file" class="select-user" id="file" name="uploadfile" accept="image/*" onchange="readURL(this)">';}
                            
         echo ' <br>  <p class="input"><label>First Name:
                <input id ="ShiftRight-First-Name2" name="first" type ="text" value="'.$first_name.'" size="20" maxlength="15">
                </label></p>';
         echo '  <br>
                <p class="input"><label>Last Name:
                <input id ="ShiftRight-last-Name2" name="last"  type ="text" value="'.$last_name.'" placeholder"" size="20" maxlength="15">
                </label></p>
                <br>';
         echo '  <p  class="input"><label>Gender   : 
                <input id ="ShiftRight-gender2" name="gender" type ="text"  value="'.$gender.'" size="20" maxlength="7" style="margin-left: 18px;">
                </label></p>
                <br>';
         echo '   <p  class="input"><label>Email:
                <input id ="ShiftRight-email2" name="email" type ="email" value="'.$email.'" style="margin-left: 30px;">
                </label></p>
                <br>';
         echo ' <p  class="input"><label>Phone   : 
                <input id ="ShiftRight-phone2" type ="number" name="phone" value="'.$zero.$phone.'" size="20" maxlength="10"  style="margin-left: 23px;">
                </label></p>';
     }
     if ($user == 'admin') {
         echo '   <p  class="input" ><label>Email:
        <input id ="ShiftRight-email2" name="email" type ="text" value="'.$email2.' " >
        </label></p>
                <br>';
     }
 }

                ?>
                <br>

               
                <button class="button_profile" type="button" onclick="location.href='Change_pass_user_manger.php?id_user=<?php echo $id; ?>'"> Change Password</button>
               
                </p>

                <p>
                <input class="button_profile" type = "submit"  name ="update_data" value = "Update">
             </p>  
                <?php
                if (isset($_SESSION['role'])) {
                    $user = $_SESSION['role'];
                    if ($user == 'user') {
                        echo '  <p><input class="button_profile"  

      " type="submit" name="delete" value="Delete My Account"> </p>';
                    }
                }

                ?>
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
  </script>
</body>

</html> 