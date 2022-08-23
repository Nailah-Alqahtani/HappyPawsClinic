
<?php 

include 'database_connect.php';
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
$id_request=$_GET['id_request'];
$user_id=$_SESSION['id'];
if (isset($_POST['send_comment'])) {     
 		 
	$comment=$_POST['comment'];
	$option=$_POST['option'];
$retrive="select * from review where request_id='$id_request'";
$already=mysqli_query($conn,$retrive);
if(! mysqli_num_rows($already)>0){
$query="INSERT INTO review (user_id,request_id,comment,rate)
     VALUES ($user_id,$id_request,'$comment',$option);";
	 	$result=mysqli_query($conn,$query);
		 if($result)
		 {
			echo "<script>
			alert('Thank You For Your Review');</script>";
		 }
		 else 
		 echo "<script>
		alert('Error Reviwing');</script>";
        }
        else 
        echo "<script>
		alert('You Already reviewed this appointment');</script>";

}
?>

</html><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title> Happy Paws Clinic </title>
        <link rel="stylesheet" href="css//review-design.css">
       
    </head>
    <body class="body_appointements" style="background-image:url(image//design6.png);">
    

    <?php  


// $sql_select_users = "select * from review where id=$id_request";
// $Result_users = mysqli_query($conn, $sql_select_users);
// if(mysqli_num_rows($Result_users)>0){
//     while ($row_user = mysqli_fetch_object($Result_users))
//      {
//         $comment_view=$row_user->comment;   
//      }
//     }    
?>



        <h1 id="title">Review Your Previous appointment </h1>
<p> please provide us with details about how was your previous appointment and help us improve!</p>

<form method="post" action="#">
<label id="comment"> Comment:<br>
<textarea name = "comment"   rows="5" cols="20" required ></textarea>
</label>
<br>
<label id="rate"> Rate us out of 10 !
</label>
<select name = rate onclick="get_option(this.value)">
<option selected value="Rate"> Rate</option>
<option value="10">10</option>
    <option value="9">9</option>
    <option value="8">8</option>
    <option value="7">7</option>
    <option value="6">6</option>
    <option value="5">5</option>
    <option value="4">4</option>
    <option value="3">3</option>
    <option value="2">2</option>
    <option value="1">1</option>
</select>
<input type="text" name="option" id="option_select" hidden="hidden">

<script>
	function get_option(val)
	{
		document.getElementById("option_select").value=val;
	}
</script>

<br><br>
<input class = "submit" type="submit"  name="send_comment" 
value="Save"></input>

<a href="appointments.php"> <button type = "button" id="back"> Back </button> </a>

</form>
    </body>
</html>