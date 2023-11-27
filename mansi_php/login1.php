<?php
	include("connection.php");
	if(isset($_POST['submit'])){
		$username = $_POST['user'];
		$password = $_POST['pass'];
		
		$sql = "select * from admins where email = '$username' and password = '$password'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);
		 if($count==1){
			 header("Location:view_user_php");
		 }
		 else{
			 echo '<script>
				window.location.href = "index.php";
				alert("Login Failed. Invalid username or password!!!")
			</script>';
			
		 }
	}
?>