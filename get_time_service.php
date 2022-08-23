<?php
include 'database_connect.php';

$valu = $_GET['value'];
$va = mysqli_real_escape_string($conn, $valu);

$sql = "SELECT id,day, time,services FROM appaintments_available where services='$va' and status='Available'";
$Result = mysqli_query($conn, $sql);
if (mysqli_num_rows($Result) > 0) {
      echo'<option value="">select Dates and Times:</option>';
    while ($row = mysqli_fetch_object($Result)) {
        // echo "<option value=" . $row->Dep_No . ">" . $row->Dep_Name . "</option>";
         echo "<option value=".$row->id . ">" . date('D', strtotime($row->day)).'['.date('F', strtotime($row->day)).'-'. date('d', strtotime($row->day)). ']'. $row->time."</option>";
    }
    // echo "</select>";
}
