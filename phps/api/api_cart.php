<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/graciousgarments/phps/database/database.php';
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
case 'update_cart':
	updateCart();
	break;
case 'checkout':
	checkout();
	break;
}

function addToCart() {
	$IDPRODUCTS = getPost('IDPRODUCTS');
	// $num = getPost('num');

	if (!isset($_SESSION['cart'])) {
		$_SESSION['cart'] = [];
	}
	// var_dump($_SESSION['cart']);
	$isFind = false;
	for ($i = 0; $i < count($_SESSION['cart']); $i++) {
		if ($_SESSION['cart'][$i]['IDPRODUCTS'] == $IDPRODUCTS) {
			$_SESSION['cart'][$i]['num'] += $num;
			$isFind = true;
			break;
		}
	}

	if (!$isFind) {
		$sql = "select p.*, b.BRAND_NAME as BRAND_NAME from products p and brands b where p.IDBRAND = b.IDBRAND and IDPRODUCTS = $IDPRODUCTS";
		echo $sql;die();
		$product = executeCart($sql, true);
		// $product['num'] = $num;
		$_SESSION['cart'][] = $product;
	}
}
function updateCart() {
	$id = getPost('IDPRODUCTS');
	$num = getPost('num');

	if (!isset($_SESSION['cart'])) {
		$_SESSION['cart'] = [];
	}

	for ($i = 0; $i < count($_SESSION['cart']); $i++) {
		if ($_SESSION['cart'][$i]['IDPRODUCTS'] == $id) {
			$_SESSION['cart'][$i]['num'] = $num;
			if ($num <= 0) {
				array_splice($_SESSION['cart'], $i, 1);
			}
			break;
		}
	}
}