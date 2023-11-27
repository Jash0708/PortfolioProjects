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
  <p>The .table-bordered class adds borders on all sides of the table and the cells:</p>            
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

// Check for image upload
if (isset($_FILES['passport_photo'])) {
    // Upload the image
    $target_dir = "uploads/"; // Replace with your upload directory path
    $target_file = $target_dir . basename($_FILES["passport_photo"]["name"]);
    $image_path = "C:\Users\jashp"; // Initialize image path variable

    if (move_uploaded_file($_FILES["passport_photo"]["tmp_name"], $target_file)) {
        $image_path = $target_file; // Update image path with uploaded file location
    } else {
        echo "Failed to upload image.";
    }
}

// Fetch user data
$select = "Select * FROM users";
$run = mysqli_query($conn, $select);

// Display user data with image
while ($row_user = mysqli_fetch_array($run)) {
    $user_id = $row_user['user_id'];
    $name = $row_user['name'];
    $date_of_birth = $row_user['date_of_birth'];
    $email = $row_user['email'];
    $telephone = $row_user['telephone'];
    $next_of_kin = $row_user['next_of_kin'];
    $age = $row_user['age'];
    $passport_photo_path = $row_user['passport_photo_path']; // Retrieved from database
    $illness = $row_user['illness'];
    $recommendedSource = $row_user['recommendedSource'];
    $recommendedSourceAddress = $row_user['recommendedSourceAddress'];

    echo "<tr>";
    echo "<td>" . $user_id . "</td>";
    echo "<td>" . $name . "</td>";
    echo "<td>" . $date_of_birth . "</td>";
    echo "<td>" . $email . "</td>";
    echo "<td>" . $telephone . "</td>";
    echo "<td>" . $next_of_kin . "</td>";
    echo "<td>" . $age . "</td>";

    // Display image if uploaded
    if ($passport_photo_path) {
        echo "<td><img src='" . $passport_photo_path . "' height='70px'></td>";
    } else {
        echo "<td>No image uploaded</td>";
    }

    echo "<td>" . $illness . "</td>";
    echo "<td>" . $recommendedSource . "</td>";
    echo "<td>" . $recommendedSourceAddress . "</td>";
    echo "</tr>";
}

mysqli_close($conn);
?>
	 
     
    </tbody>
  </table>
</div>

</body>
</html>
