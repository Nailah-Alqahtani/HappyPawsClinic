<!DOCTYPE html>
<html>
    <head>
 <meta charset="utf-8">
 <title>  Happy Paws Clinic </title>
 <link rel="stylesheet" href="css/appointements-design.css">
 
    </head>

    <?php include 'header.php';
    include 'database_connect.php'; ?>

    <body class="body_appointements" style="background-image: url(image//design19.png); ">
    
            <h1 class="title_appointements">
                Appointments
            </h1>


 

            <?php 
            $date_no= date("Y-m-d"); 
            $user_i=$_SESSION['id'];
  echo '
  <h2 >
 Upcoming 
 </h2>';
								$sql_request_appointement = "select * from request_appointement where day>'$date_no' and user_id='$user_i'";
						$Result_request_appointement = mysqli_query($conn, $sql_request_appointement);
  $upcom_app=1;
							while ($row_request_appointement = mysqli_fetch_object($Result_request_appointement))

							 {
                                 if($row_request_appointement->status=="accept")
                                 {
                                     echo '
                                   
                                            <ul>
                                                <div> 
                                                    <li>
                                                    <details>
                                                        <summary> Appointment:'.$upcom_app.' </summary>            
                                                    <ul>
                                                       <li>Date : '.$row_request_appointement->day.'</li> 
                                                        <li>Time :'.$row_request_appointement->time.'</li>
                                                        <li>Pet nama :'.$row_request_appointement->pet.'</li>
                                                        <li>Service:'.$row_request_appointement->service.'</li>
                                                    </ul>
                                                    </details>
                                                    </li>
                                                </div>
                                            </ul>';
                                            $upcom_app=$upcom_app+1;
                                 }
                                 
						     }
echo '
<h2>
Prevoius 
</h2> ';
                             $sql_request_appointement = "select * from request_appointement where day<'$date_no' and user_id='$user_i'";
                             $Result_request_appointement = mysqli_query($conn, $sql_request_appointement);
      $prev_app=1;
                                 while ($row_request_appointement = mysqli_fetch_object($Result_request_appointement))
    
                                  {
                                  
                             if($row_request_appointement->status=="accept")
                             {
                                
                                echo '
                               
                                   <ul>
                                   <div>
                                       <li>
                                           <details>
                                                       <summary> Appointment:'.$prev_app.'
                                               <a href="review.php?id_request='.$row_request_appointement->id.'&share=user" target="_blank" class="r-icon1" title="go review your last appointement"> 
                                                   <img src="image//review.png" alt="review icon" height="30" width="30"></a>
                                               </summary>
                                               <ul>
                                                   <li>Date : '.$row_request_appointement->day.'</li> 
                                                        <li>Time :'.$row_request_appointement->time.'</li>
                                                        <li>Pet nama :'.$row_request_appointement->pet.'</li>
                                                        <li>Service:'.$row_request_appointement->service.'</li>
                                               </ul>
                                       </details>
                                   </li>
                                      </div> 
                                      
                                   </ul>
                                                        ';
                                                        $prev_app=$prev_app+1;
                             }
                            }

                   
                   ?>

</body>
</html>
<!-- 
