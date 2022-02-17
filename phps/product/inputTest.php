<?php
require_once('../database/database.php');
// $fullname = $age = $address = '';
$proname = $proprice = $proimg= $idbrand =$prodesc='';
$uploadOk = 1;
if (!empty($_POST)) {
	if (isset($_POST['submit'])) {
		
		$img=basename($_FILES['anh']['name']);
		echo "ten anh: " .$img;
		$target_dir = "img/";
		$target_file = $target_dir.$img;
		move_uploaded_file($_FILES["anh"]["tmp_name"], $target_file);
	}
	$query = "insert into img(ten) value('$img')";
	// echo $query;
	// die();
	if (executeRe($query)) {
		echo"<script type='text/javascript'>alert('Thêm dữ liệu thành công');</script>";
	}else{
		echo"<script type='text/javascript'>alert('Không thêm được ảnh";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>PHP 1</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>
<body>
	<div class="jumbotron text-center" style="height: 200px">
		<h1>ADD/EDIT PRODUCTS</h1>
	</div>
	<div class="container" margin="50px">
		
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="namecata">IMG: </label>
				<input type="file" class="form-control" id="anh" placeholder="Enter img" name="anh" required>
				<img src="<?=$proimg?>" style="max-width: 200px" id="imgChange">
			</div>
			<button class="btn btn-success" type="submit" name="submit">Submit</button>
			<a href="index.php" title="" ><button class="btn btn-success" type="button">HOME</button></a>
		</form>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Index</th>
					<th style="width: 70%">Product</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php
					$index = 1;
					$query = "SELECT * from img";
					$productlist = executeResult($query);
					echo $query;
					if ($productlist!=null && count($productlist)>0) {
						foreach ($productlist as $prolist) {
							echo '<tr>
							src="/images/html5.gif"
							<td>'.$index++.'</td>
							<td><img src="img/'.$prolist['ten'].'" style="width: 150px"></td>
							';
								// <td><img url(img/'.$prolist['ten'].') style="width: 150px"></td>
								// ';
						}
					}else echo("chưa có dữ liệu");
					?>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>
