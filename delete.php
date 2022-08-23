<?php 
require_once "database_connect.php"; 
	if (isset($_GET['appoit_id'])) {
		$appoit_id=$_GET['appoit_id'];
		$query3="delete from appaintments_available where id='$appoit_id'";
		$run3=mysqli_query($conn,$query3);
		if ($run3) {
			header('Location: Add_Available_Appoitments.php');
		}
		else{
			echo "Record not deleted";
		}
	}
	if (isset($_GET['id_pets'])) {
    $pets_id=$_GET['id_pets'];
        $query="delete from pets where id=$pets_id";
    $run=mysqli_query($conn,$query);
    if ($run) {
        echo "<script>alert('Deleted')</script>";
		header('Location: List_Of_Pets.php');
    }
    else{
        echo "<script>alert('Not Deleted')</script>";
    }
	}

		if (isset($_GET['delete_request'])) {
	 $id_request=$_GET['delete_request'];
        $query="delete from request_appointement where id=$id_request";
    $run=mysqli_query($conn,$query);
    if ($run) {
        echo "<script>alert('Deleted')</script>";
		header('Location: UserRequests.php');
    }
    else{
        echo "<script>alert('Not Deleted')</script>";
    }
		}

?>