<?php
require_once '../database/database.php';
session_start();
$admin = (isset($_SESSION['admin'])) ? $_SESSION['admin'] : [];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Products Store</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>
<body>
	<div class="container">
		<div>
			<ul class="nav nav-pills">
				<li class="nav-item">
					<a href="../catalogy/" title="" class="nav-link ">Catalogy Management</a>
				</li>
				<li class="nav-item">
					<a href="#" title="" class="nav-link active">Products Management</a>
				</li>
				<li class="nav-item">
					<?php if (isset($admin['FULLNAME'])) {?>
						<a href="#" title="" title="" class="nav-link">Welcome Admin: <?php echo $admin['FULLNAME']; ?></a>
					</li>
					<li class="nav-item">
						<a href="../admin/logoutadmin.php" class="nav-link">Logout</a>
					</li>
				<?php }
?>
			</ul>
		</div>
		<div class="jumbotron text-center" style="padding: 50px 30px; height: 200px;">
			<h1>Products Management</h1>
			<p>Hope you have a wonderful shopping time!</p>
		</div>
		<a href='input.php' title=""><button class="btn btn-outline-primary">Add product</button></a>
		<form class="" method="POST" action="">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Index</th>
						<th style="width: 15%">Product</th>
						<th style="width: 10%">Title</th>
						<th style="width: 10%">Price</th>
						<th style="width: 10%">Area</th>
						<th style="width: 10%">ID</th>
						<th>created_at</th>
						<th>updated_at</th>
						<th style="width: 15%">Function</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php
$index = 1;
$query = "SELECT IDPRODUCTS id, p.PRODUCT_NAME, p.IMG, p.PRICE, p.created_at, p.updated_at, b.BRAND_NAME BRAND_NAME FROM brands b, products p WHERE b.IDBRAND=p.IDBRAND order by p.updated_at desc";
$productlist = executeResult($query);

if ($productlist != null && count($productlist) > 0) {
	foreach ($productlist as $prolist) {
		$num1 = $prolist['PRICE'];
		$formatnum1 = number_format($num1, 0, ',', '.');
		echo '<tr>
								<td>' . $index++ . '</td>
								<td><img src="img/' . $prolist['IMG'] . '" style="width: 150px"></td>
								<td>' . $prolist['PRODUCT_NAME'] . '</td>
								<td>' . $formatnum1 . ' VND</td>
								<td>' . $prolist['BRAND_NAME'] . '</td>
								<td>' . $prolist['id'] . '</td>
								<td>' . $prolist['created_at'] . '</td>
								<td>' . $prolist['updated_at'] . '</td>
								<td><a style="color: white" href="input.php?id=' . $prolist['id'] . '" class="btn btn-warning">Edit</a>
								<button class="btn btn-danger" onclick="deleted(' . $prolist['id'] . ')">Delete</button></td>
								</tr>
								';
	}
} else {
	echo ("chưa có dữ liệu");
}

?>
					</tr>
				</tbody>
			</table>
		</form>
		<script type="text/javascript">
			function deleted(id){
				option = confirm('Bạn có muốn xóa không?')
				if (!option) {
					return;
				}
				$.post('deletestd.php',{
					'id'    :id,
					'action':'delete',

					//action để có thể thực hiện với các chức năng khác
				}, function(data){
					alert('đã xóa rồi nhé');
					location.reload();
				})
				console.log(id);
			}
		</script>
	</body>
	</html>