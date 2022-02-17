<?php
session_start();
require_once '../database/database.php';
function fixSqlInject($sql) {
	$sql = str_replace('\\', '\\\\', $sql);
	$sql = str_replace('\'', '\\\'', $sql);
	return $sql;
}
function getPost($key) {
	$value = '';
	if (isset($_POST[$key])) {
		$value = $_POST[$key];
		$value = fixSqlInject($value);
	}
	return trim($value);
}
$action = getPost('action');
switch ($action) {
case 'cart':
	addToCart();
	break;
}
function addToCart() {
	$id = getPost('IDPRODUCTS');
	$num = getPost('num');

	if (!isset($_SESSION['cart'])) {
		$_SESSION['cart'] = [];
	}
	// var_dump($_SESSION['cart']);
	$isFind = false;
	for ($i = 0; $i < count($_SESSION['cart']); $i++) {
		if ($_SESSION['cart'][$i]['IDPRODUCTS'] == $id) {
			$_SESSION['cart'][$i]['num'] += $num;
			$isFind = true;
			break;
		}
	}

	if (!$isFind) {
		// $query = "select products.*, brands.BRAND_NAME as BRAND_NAME from products left join brands on products.IDBRAND = brands.IDBRAND where products.IDPRODUCTS = $id";
		$query = 'select p.IMG as IMG, b.IDBRAND as IDBRAND,b.BRAND_NAME as BRAND_NAME, p.PRODUCT_NAME as PRODUCT_NAME, p.IDPRODUCTS as IDPRODUCTS, p.PRICE as PRICE, p.IMG as IMG from products p, brands b where p.IDBRAND = b.IDBRAND and IDPRODUCTS= ' . $id;
		$result = executeCart($query, true);
		// var_dump($result);die();
		$result['num'] = $num;
		$_SESSION['cart'][] = $result;
	}
	// $id = getPost('IDPRODUCTS');
	// $num = getPost('num');
	// if (!isset($_SESSION['cart'])) {
	// 	$_SESSION['cart'] = [];
	// }
	// $isFind = false;
	// for ($i = 0; $i < count($_SESSION['cart']); $i++) {
	// 	if ($_SESSION['cart'][$i]['IDPRODUCTS'] == $id) {
	// 		$_SESSION['cart'][$i]['num'] += $num;
	// 		$isFind = true;
	// 		break;
	// 	}
	// }
	// if (!$isFind) {
	// 	// $query = 'select * from products where IDPRODUCTS=' . $id;
	// 	// $query = "select products.*, b.BRAND_NAME as BRAND_NAME from products p left join brands b on p.IDBRAND = B.IDBRAND where IDPRODUCTS = $id"
	// 	$query = 'select p.IMG as IMG, b.IDBRAND as IDBRAND,b.BRAND_NAME as BRAND_NAME, p.PRODUCT_NAME as PRODUCT_NAME, p.IDPRODUCTS as IDPRODUCTS, p.PRICE as PRICE, p.IMG as IMG from products p, brands b where p.IDBRAND = b.IDBRAND and IDPRODUCTS= ' . $id;
	// 	$result = executeResult($query);
	// 	$result['num'] = $num;
	// 	$_SESSION['cart'][] = $result;
	// }
	// // var_dump($_SESSION['cart']);

}
?>