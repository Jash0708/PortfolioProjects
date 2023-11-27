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
  <h2>Add New User</h2>
  <form action="" method="post" enctype = "multipart/form-data" >
  <div class="form-group">
      <label >Name:</label>
      <input type="text" class="form-control"  placeholder="Name" name="user_name">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control"  placeholder="Enter password" name="user_pswd">
    </div>
	<div class="form-group">
  <label for="date">Date:</label>
  <input type="date" class="form-control"  name="date">
	</div>
	<div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" " placeholder="Enter email" name="user_email">
    </div>
	<div class="form-group">
  <label for="tel">Telephone:</label>
  <input type="tel" class="form-control"  placeholder="Enter No."name="user_tel">
</div>
<div class="form-group">
  <label for="nextOfKinName">Next of Kin Name:</label>
  <input type="text" class="form-control" placeholder="Name" name="nextOfKinName">
</div>
<div class="form-group">
  <label for="age">Age:</label>
  <input type="number" class="form-control" placeholder="Enter Age" name="age" min="1">
</div>
<div class="form-group">
	<label>Image:</label>
	<input type="file" class = "form-control" placeholder="Name" name ="image">

	
	</div>
<div class="form-group">
  <label for="illness">Illness:</label>
  <input type="text" class="form-control"  placeholder="Enter illness" name="illness">
</div>
<div class="form-group">
  <label for="recommendedSource">Recommended Source:</label>
  <input type="text" class="form-control"  placeholder="Enter reccomended source" name="recommendedSource">
</div>
<div class="form-group">
  <label for="recommendedSourceAddress">Recommended Source Address:</label>
  <input type="text" class="form-control"  placeholder="Enter address" name="recommendedSourceAddress">
</div>
    <input type="submit" name="insert-btn" class="btn btn-primary" />
  </form>
  
 <?php
 $conn = mysqli_connect('localhost','root','','mariata_homes');

 // if(mysqli_connect_errno()){
     // echo "Connection fail";
 // } else {
    // echo "connection OK";
 // }; #Making sure that connection is established

	  // if(isset($_POST['insert-btn'])){



	   // $user_name = $_POST['user_name'];
	   // $user_pswd = $_POST['user_pswd'];
	   // $date = $_POST['date'];
	   // $user_email = $_POST['user_email'];
	   // $user_tel = $_POST['user_tel'];
	   // $nextOfKinName = $_POST['nextOfKinName'];
	   // $age = $_POST['age'];
	   // $image = $_FILES['user_image']['name'];
	   // $tmp_name = $_FILES['user_image']['tmp_name'];
	   // $illness = $_POST['illness'];
	   // $recommendedSource = $_POST['recommendedSource'];
	   // $recommendedSourceAddress = $_POST['recommendedSourceAddress'];
	 
	   // $insert = "INSERT INTO users(name, date_of_birth, email, telephone, next_of_kin, age, user_image, illness, recommendedSource, recommendedSourceAddress)
	   // VALUES('$user_name','$date','$user_email','$user_tel','$nextOfKinName','$age','$illness', '$image' '$recommendedSource', '$recommendedSourceAddress')";
	 
	   // $run_insert = mysqli_query($conn,$insert);
	   // if($run_insert === true){
		    // echo "Data has been Inserted";
			// move_uploaded_file(tmp_name,"upload/image");
	    // }else{
		    // echo "Failed,try again";
	    // }
	 

	
	  // }
	 
	 
	 // $conn = mysqli_connect('localhost', 'root', '', 'mariata_homes');

// if (mysqli_connect_errno()) {
    // echo "Connection fail";
// } else {
    // // echo "connection OK";
// }

// if (isset($_POST['insert-btn'])) {
    // $user_name = $_POST['user_name'];
    // $user_pswd = $_POST['user_pswd'];
    // $date = $_POST['date'];
    // $user_email = $_POST['user_email'];
    // $user_tel = $_POST['user_tel'];
    // $nextOfKinName = $_POST['nextOfKinName'];
    // $age = $_POST['age'];
    // $image = $_FILES['user_image']['name'];
	// $tmp_name = $_FILES['user_image']['tmp_name'];
    // $illness = $_POST['illness'];
    // $recommendedSource = $_POST['recommendedSource'];
    // $recommendedSourceAddress = $_POST['recommendedSourceAddress'];

    // // Use placeholders in the SQL query and prepare the statement
    // $insert = "INSERT INTO users(name, date_of_birth, email, telephone, next_of_kin, age, image, illness, recommendedSource, recommendedSourceAddress)
               // VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // $stmt = mysqli_prepare($conn, $insert);

    // // Bind parameters
    // mysqli_stmt_bind_param($stmt, "sssssssss", $user_name, $date, $user_email, $user_tel, $nextOfKinName, $age, $image, $illness, $recommendedSource, $recommendedSourceAddress);

    // // Execute the statement
    // $run_insert = mysqli_stmt_execute($stmt);

    // if ($run_insert === true) {
        // echo "Data has been Inserted";
		// move_uploaded_file(	$tmp_name, upload/$image);
    // } else {
        // echo "Failed, try again";
    // }
// }


// $conn = mysqli_connect('localhost', 'root', '', 'mariata_homes');

// if (mysqli_connect_errno()) {
    // echo "Connection fail";
// } else {
    // // Connection established

    // if (isset($_POST['insert-btn'])) {
        // $user_name = $_POST['user_name'];
        // $user_pswd = $_POST['user_pswd'];
        // $date = $_POST['date'];
        // $user_email = $_POST['user_email'];
        // $user_tel = $_POST['user_tel'];
        // $next_of_kin_name = $_POST['nextOfKinName'];
        // $age = $_POST['age'];

        // // Check if image was uploaded
        // if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] === 0) {
            // $image = $_FILES['user_image']['name'];
            // $tmp_name = $_FILES['user_image']['tmp_name'];

            // // Move the uploaded image to the uploads directory
            // $target_dir = "uploads/";
            // $target_file = $target_dir . $image;

            // if (move_uploaded_file($tmp_name, $target_file)) {
                // // Image uploaded successfully
            // } else {
                // // Image upload failed
                // echo "Failed to upload image.";
            // }
        // } else {
            // $image = null; // No image uploaded
        // }

        // $illness = $_POST['illness'];
        // $recommendedSource = $_POST['recommendedSource'];
        // $recommendedSourceAddress = $_POST['recommendedSourceAddress'];

        // // Prepare and execute SQL query
        // $insert = "INSERT INTO users(name, date_of_birth, email, telephone, next_of_kin, age, passport_photo_path, illness, recommendedSource, recommendedSourceAddress)
            // VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // $stmt = mysqli_prepare($conn, $insert);
        // mysqli_stmt_bind_param($stmt, "ssssssssss", $user_name, $date, $user_email, $user_tel, $next_of_kin_name, $age, $image, $illness, $recommendedSource, $recommendedSourceAddress);

        // if (mysqli_stmt_execute($stmt)) {
            // echo "Data has been inserted.";
        // } else {
            // echo "Failed to insert data: " . mysqli_error($conn);
        // }

        // mysqli_stmt_close($stmt);
    // }
// }


if (isset($_POST['insert-btn'])) {

    $user_name = $_POST['user_name'];
    $user_pswd = $_POST['user_pswd'];
    $date = $_POST['date'];
    $user_email = $_POST['user_email'];
    $user_tel = $_POST['user_tel'];
    $nextOfKinName = $_POST['nextOfKinName'];
    $age = $_POST['age'];
	$image = $_FILES['image'];
	$tmpimage = $image['tmp_name'];
	$upload_image = ''.$image['name'];
	move_uploaded_file($tmpimage,$upload_image);

    // Check if image was uploaded
    // if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] === 0) {
        // $image = $_FILES['user_image']['name'];
        // $tmp_name = $_FILES['user_image']['tmp_name'];

        // // Move the uploaded image to the uploads directory
        // $target_dir = "upload/";
        // $target_file = $target_dir . $image;

        // if (move_uploaded_file($tmp_name, $target_file)) {
            // // Image uploaded successfully
        // } else {
            // // Image upload failed
            // echo "Failed to upload image.";
        // }
    // } else {
        // $image = null; // No image uploaded
    // }

    $illness = $_POST['illness'];
    $recommendedSource = $_POST['recommendedSource'];
    $recommendedSourceAddress = $_POST['recommendedSourceAddress'];

    // Prepare and execute SQL query
    $insert = "INSERT INTO users(name, date_of_birth, email, telephone, next_of_kin, age, passport_photo_path, illness, recommendedSource, recommendedSourceAddress)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $insert);
    mysqli_stmt_bind_param($stmt, "ssssssssss", $user_name, $date, $user_email, $user_tel, $nextOfKinName, $age, $upload_image, $illness, $recommendedSource, $recommendedSourceAddress);

    if (mysqli_stmt_execute($stmt)) {
        echo "Data has been inserted.";
    } else {
        echo "Failed to insert data: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}


?>


	 
	 
	 
	 
	 
	 


</div>

</body>
</html>
