<?php
require_once "../database/database.php";
if (!empty($_POST)) {
	$password = $username = $tel = '';
	if (isset($_POST['username'])) {
		$username = $_POST['username'];}
	if (isset($_POST['password'])) {
		$password = $_POST['password'];}
	if (isset($_POST['fullname'])) {
		$fullname = $_POST['fullname'];}
	if (isset($_POST['address'])) {
		$address = $_POST['address'];}
	if (isset($_POST['tel'])) {
		$tel = $_POST['tel'];}
	if ($_POST['password'] == $_POST['passwordCheck']) {
		$pass = password_hash($password, PASSWORD_DEFAULT);
		$query = "INSERT INTO users(USERNAME,PASSWORD,FULLNAME,ADDRESS,PHONENUMBER) value('$username','$pass','$fullname','$address','$tel')";
		executeRe($query);
		header('location: logincus.php');
	} else {
		echo "<script type='text/javascript'>alert('Vui lòng nhập khớp mật khẩu đê');</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body style="background-color: black">
    <div class="container" style="width: 500px; height: auto; background-color: #62B7D6;">
        <div>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a href="logincus.php" class="nav-link" >Login Form</a>
                </li>
                <li class="nav-item">
                    <a href="#" title="" title="" class="nav-link active">Register Form</a>
                </li>
            </ul>
        </div>
        <div>
            <h1 style="text-align: center">Register Page</h1>
        </div>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">User name: </label>
                <input type="text" class="form-control" id="username" placeholder="Enter User name" name="username" pattern=".{5,20}" title="5-20 characters" required>
            </div>
            <div class="form-group">
                <label for="password">Password: </label>
                <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password">Confirmed Password: </label>
                <input type="password" class="form-control" id="password" placeholder="Enter Password" name="passwordCheck" required>
            </div>
            <div class="form-group">
                <label for="fullname">Fullname: </label>
                <input type="text" class="form-control" id="fullname" placeholder="Enter fullname" name="fullname" required>
            </div>
            <div class="form-group">
                <label for="address">Address: </label>
                <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" required>
            </div>
            <div class="form-group">
                <label for="tel">Phone Number: </label>
                <input type="text" class="form-control" id="tel" placeholder="Enter Phonenumber" name="tel" pattern="[0-9]{10}" title="10 numbers" required>
            </div>
            <button style="margin-bottom: 10px" class="btn btn-success" type="submit">Register</button>
        </form>
    </div>
</body>
</html>
