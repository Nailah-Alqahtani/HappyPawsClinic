
<?php 
error_reporting(0);
include 'database_connect.php';

$id_request=$_GET['id_request'];

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


$sql_select_users = "select  review.comment, review.rate ,owner.email from review 
 INNER JOIN owner ON  review.user_id = owner.id  where request_id=$id_request";
$Result_users = mysqli_query($conn, $sql_select_users);
if(mysqli_num_rows($Result_users)>0){
    while ($row_user = mysqli_fetch_object($Result_users))
     {
        $comment_view=$row_user->comment;   
        $rate=$row_user->rate;  
        $email=$row_user->email; 
     }
    }    
    else { $comment_view="There is No Comment ";
    $rate="0";
    $email="#";
    }
?>



        <h1> Pet Owner Review </h1>


<form method="post" action="#"></form>
<label id="comment"> Comment:<br>
<textarea name = "comment"   rows="5" cols="20" required ><?php echo $comment_view; ?> </textarea>
</label>
<br>
<label id="rate1"> given Rate :<?php echo $rate; ?> !
</label>


<br><br>
<a href="mailto:<?php echo $email ?>">
<input class = "buttoncontact" type="submit"  name="send_comment" 
value="Contact Customer via email"></input>
</a>
<!-- <a href="appointment_admin.php"> <button type = "button" id="back"> Back </button> </a> -->
<a href="appointment_admin.php"> <button type = "button" id="backrev"> Back </button> </a>

</form>
    </body>
</html>