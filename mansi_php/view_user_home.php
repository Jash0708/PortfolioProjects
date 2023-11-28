<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<br><br>
<div class="container">
  <h2>View Users</h2>
  <?php
	 $conn = mysqli_connect('localhost', 'root', '', 'mariata_homes');
	 if(isset($_GET['del'])){
		  $del_id = $_GET['del'];
	$delete = "DELETE FROM users WHERE user_id = '$del_id'";
	$run_delete = mysqli_query($conn, $delete);
		if($run_delete === true){
			echo "Record has been deleted";
			
		}else{
			echo "Failed, Try Again";
		}
	 }
  
  ?>
         
  <table class="table table-bordered">
    <thead>
      <tr>
		<th>ID</th>
        <th>Name</th>
        <th>Date</th>
        <th>Email</th>
		<th>Telephone</th>
		<th>Next Of Kin</th>
		<th>Age</th>
		<th>Image</th>
		<th>Illness</th>
		<th>Recommended Source</th>
		<th>Recommended Source Address</th>
		
      </tr>
    </thead>
    <tbody>
	 <?php 
	 $conn = mysqli_connect('localhost', 'root', '', 'mariata_homes');
	 $select = "Select * FROM users";
	 $run = mysqli_query($conn, $select);
	 while($row_user = mysqli_fetch_array($run)){
		 $user_id = $row_user['user_id'];
		 $name = $row_user['name'];
		 $date_of_birth = $row_user['date_of_birth'];
		 $email = $row_user['email'];
		 $telephone = $row_user['telephone'];
		 $next_of_kin = $row_user['next_of_kin'];
		 $passport_photo_path = $row_user['passport_photo_path'];
		 $age = $row_user['age'];
		
		 $illness = $row_user['illness'];
		 $recommendedSource = $row_user['recommendedSource'];
		 $recommendedSourceAddress = $row_user['recommendedSourceAddress'];
	 
	 
	 
	 
	 
	  
	 ?>
	  
      <tr>
        <td><?php echo $user_id;?></td>
        <td><?php echo $name; ?></td>
        <td><?php echo $date_of_birth; ?></td>
		<td><?php echo $email; ?></td>
		<td><?php echo $telephone; ?></td>
		<td><?php echo $next_of_kin; ?></td>
		<td><?php echo $age; ?></td>
		<td><img src="upload/<?php echo $passport_photo_path; ?>" height = "70px"</td>
		<td><?php echo $illness; ?></td>
		<td><?php echo $recommendedSource; ?></td>
		<td><?php echo $recommendedSourceAddress; ?></td>
		
		
      </tr>
	 <?php } ?>
	 
     
    </tbody>
  </table>
</div>

</body>
</html>
