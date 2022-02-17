<?php
// require_once 'product/index.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Trang Chủ - Shop Thời Trang</title>
	<link rel="shortcut icon" href="https://t004.gokisoft.com/uploads/2021/07/1-s-1637-ico-web.jpg">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
</head>
<div class="container" style="margin-top: 20px; margin-bottom: 20px;">
	<div class="row">
		<table class="table table-bordered">
			<tr>
				<th>STT</th>
				<th>Image</th>
				<th>Tittle</th>
				<th>Brand</th>
				<th>Price</th>
				<th>Number</th>
				<th>Total Amount</th>
				<th></th>
			</tr>
<?php
if (!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = [];
}
$index = 0;
echo "<br/>";
foreach ($_SESSION['cart'] as $item) {
	// var_dump($item);
	echo '<tr>
			<td>' . (++$index) . '</td>
			<td><img src="product/img/' . $item['IMG'] . '" alt="" style="height: 100px; width: 90px"/></td>
			<td>' . $item['PRODUCT_NAME'] . '</td>
			<td>' . $item['BRAND_NAME'] . '</td>
			<td>' . number_format($item['PRICE']) . ' VND</td>
			<td style="display: flex"><button class="btn btn-light" style="border: solid #e0dede 1px; border-radius: 0px;" onclick="addMoreCart(' . $item['IDPRODUCTS'] . ', -1)">-</button>
				<input type="number" id="num_' . $item['IDPRODUCTS'] . '" value="' . $item['num'] . '" class="form-control" style="width: 90px; border-radius: 0px" onchange="fixCartNum(' . $item['IDPRODUCTS'] . ')"/>
				<button class="btn btn-light" style="border: solid #e0dede 1px; border-radius: 0px;" onclick="addMoreCart(' . $item['IDPRODUCTS'] . ', 1)">+</button>
			</td>
			<td>' . number_format($item['PRICE'] * $item['num']) . ' VND</td>
			<td><button class="btn btn-danger" onclick="updateCart(' . $item['IDPRODUCTS'] . ', 0)">Xoá</button></td>
		</tr>';
}
?>
<script type="text/javascript">
	function addMoreCart(IDPRODUCTS, delta) {
		num = parseInt($('#num_' + IDPRODUCTS).val())
		// console.log(IDPRODUCTS + "," + num)
		num += delta
		$('#num_' + IDPRODUCTS).val(num)

		updateCart(IDPRODUCTS, num)
	}

	function fixCartNum(IDPRODUCTS) {
		$('#num_' + IDPRODUCTS).val(Math.abs($('#num_' + IDPRODUCTS).val()))

		updateCart(IDPRODUCTS, $('#num_' + IDPRODUCTS).val())
	}
	function updateCart(IDPRODUCTS, num) {
		$.post('http://localhost/graciousgarments/phps/api/api_cart.php', {
			'action': 'update_cart',
			'IDPRODUCTS': IDPRODUCTS,
			'num': num
		}, function(data) {
			location.reload()
		})
	}
</script>