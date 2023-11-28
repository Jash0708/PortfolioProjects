<!DOCTYPE html>
<html>
<head>
    <title>Simple PHP Page</title>
    <style>
        .navbar {
            background-color: #f0f0f0;
            padding: 10px;
        }

        .navbar a {
            margin: 0 10px;
            text-decoration: none;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .image {
            display: block;
            margin: 10px auto;
        }
		.image {
    display: inline-block;
}
		 .container h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="#">Home</a>
        <a href="index.php">Admin</a>
        <a href="add_user.php">User Form</a>
		<a href="view_user_home.php">View User Form</a>
    </div>

    <div class="container">
        <h1>Mariata Homes</h1>

        <img src="Capture.jpg" alt="Image 1" class="image">
        <img src="image2.jpg" alt="Image 2" class="image">
        <img src="image3.jpg" alt="Image 3" class="image">
    </div>
</body>
</html>
