<?php
 $conn = mysqli_connect('localhost','root','','mariata_homes');
  $id=$_GET['updateid'];
  $sql= "SELECT * FROM `users` WHERE id=$id";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

    $nname = $row['name'];
    $ndate = $row['date'];
    $nuser_email = $row['user_email'];
    $nuser_tel = $row['user_tel'];
    $nnextOfKinName = $row['nextOfKinName'];
    $nage = $row['age'];
    $nimage = $row['image'];
    $ntmpimage = $row['tmp_name'];
    $nupload_image = 'uploads/' . $nimage['name'];  // Adjust the path based on your project structure
    move_uploaded_file($ntmpimage, $nupload_image);
    $nillness = $row['illness'];
    $nrecommendedSource = $row['recommendedSource'];
    $nrecommendedSourceAddress = $row['recommendedSourceAddress'];

  if (isset($_POST['update-btn'])) {
    $nname = $_POST['name'];
    $ndate = $_POST['date'];
    $nuser_email = $_POST['user_email'];
    $nuser_tel = $_POST['user_tel'];
    $nnextOfKinName = $_POST['nextOfKinName'];
    $nage = $_POST['age'];
    $nimage = $_FILES['image'];
    $ntmpimage = $nimage['tmp_name'];
    $nupload_image = 'uploads/' . $nimage['name'];  // Adjust the path based on your project structure
    move_uploaded_file($ntmpimage, $nupload_image);
    $nillness = $_POST['illness'];
    $nrecommendedSource = $_POST['recommendedSource'];
    $nrecommendedSourceAddress = $_POST['recommendedSourceAddress'];
    $sql = "UPDATE `users` SET `name` = '$nname', `date_of_birth` = '$ndaate', `email` = 'nuser_email', `telephone` = '$nuser_tel', 
  `next_of_kin` = '$nnextOfKinName', `age` = '$nage', `passport_photo_path`='$nupload_image', `illness` = 'nillness', `recommendedSource`
  = 'nrecommendedSource', `recommendedSourceAddress` = 'nrecommendedSourceAddress' where id =$id";
  
  $result=mysqli_query($conn,$sql);
  if ($result){
     echo "Update created successfully";
    //header('location:bookinguserdisplay.php');

  }
  else{
    die(mysqli_error($con));
  }
}
?>


<!DOCTYPE html>

<html lang="en">
<head>
  <title>Update User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<br><br>
  
  <form action="" method="post" enctype = "multipart/form-data" >
  <div class="form-group">
      <label >Name:</label>
      <input type="text" class="form-control" value = "<?php echo $name;?>" placeholder="Name" name="user_name">
    </div>
   
	<div class="form-group">
  <label for="date">Date of birth:</label>
  <input type="date" class="form-control" value = "<?php echo $date_of_birth;?>"  name="date">
	</div>
	<div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" value = "<?php echo $email;?>" placeholder="Enter email" name="user_email">
    </div>
	<div class="form-group">
  <label for="tel">Telephone:</label>
  <input type="tel" class="form-control" value = "<?php echo $telephone;?>" placeholder="Enter No."name="user_tel">
</div>
<div class="form-group">
  <label for="nextOfKinName">Next of Kin Name:</label>
  <input type="text" class="form-control" value = "<?php echo $next_of_kin;?>" placeholder="Name" name="nextOfKinName">
</div>
<div class="form-group">
  <label for="age">Age:</label>
  <input type="number" class="form-control" value = "<?php echo $age;?>" placeholder="Enter Age" name="age" min="1">
</div>
<div class="form-group">
	<label>Image:</label>
	<input type="file" class = "form-control" placeholder="Name" name ="image">

	
	</div>
<div class="form-group">
  <label for="illness">Illness:</label>
  <input type="text" class="form-control" value = "<?php echo $illness;?>" placeholder="Enter illness" name="illness">
</div>
<div class="form-group">
  <label for="recommendedSource">Recommended Source:</label>
  <input type="text" class="form-control" value = "<?php echo $recommendedSource;?>" placeholder="Enter reccomended source" name="recommendedSource">
</div>
<div class="form-group">
  <label for="recommendedSourceAddress">Recommended Source Address:</label>
  <input type="text" class="form-control" value = "<?php echo $recommendedSourceAddress;?>"  placeholder="Enter address" name="recommendedSourceAddress">
</div>
    <input type="submit" name="insert-btn" class="btn btn-primary" />
  </form>
  <div>
    
  <button class="btn btn-warning"><a href ="update_user.php?updateid='.$id.'" class="text-light">Update</a></button>


  </div>
</body>
</html>