<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/graciousgarments/phps/database/database.php';
session_start();
$count = 0;
if (!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = [];
}
// var_dump($_SESSION['cart']);
foreach ($_SESSION['cart'] as $items) {
	$count += $items['num'];
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Products Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="../styles/index.css">
    <script type="module" src="https://unpkg.com/@fluentui/web-components"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="../scripts/index.js" defer></script>
    <title>Gracious Garments</title>
</head>

<body class="container" style="width: 1500px">
  <?php
  $id = '';
  if (isset($_GET['id'])) {
   $id = $_GET['id'];
	// $query = 'select * from products where IDPRODUCTS= ' . $id;
   $query = 'select p.DESC as `DESC`, p.IMG as IMG, b.IDBRAND as IDBRAND,b.BRAND_NAME as BRAND_NAME, p.PRODUCT_NAME as PRODUCT_NAME, IDPRODUCTS, p.PRICE as PRICE, p.IMG as IMG from products p, brands b where p.IDBRAND = b.IDBRAND and IDPRODUCTS= ' . $id;
	// echo $query;
	// die();
   $result = executeResult($query);
   if ($result) {
    foreach ($result as $product) {
			// var_dump($result);
     $num1 = $product['PRICE'];
			// $formatnum1 = number_format($num1, 2, ',', '.');
     $formatnum1 = number_format($num1, 0, ',', '.');
			//Số 0 là chữ số thập phân, dấu ',' ;là tách sau số thập phân==> 10.000,00
			// echo $formatnum;
     $name = $product['PRODUCT_NAME'];
     echo '<h2>' . $name . '</h2>';
     echo '<div>
     <img src="product/img/' . $product['IMG'] . '" width="150px"; height="160px">
     <p>Name: ' . strtoupper($product['PRODUCT_NAME']) . '</p><a href="catalogy/showbrands.php?id=' . $product['IDBRAND'] . '"><p>Brand: ' . strtoupper($product['BRAND_NAME'] ). '</p></a><p>Price: ' . $formatnum1 . ' VND </p>
     <p>Description: ' . $product['DESC'] . '</p>
     </div>';
   }
 }
}
// require_once '../showcart.php';

?>
<div style="display: flex;">
  <button class="btn btn-light" style="border: solid #e0dede 1px; border-radius: 0px;" onclick="addMoreCart(-1)">-</button>
  <input type="number" name="num" class="form-control" step="1" value="1" style="max-width: 90px;border: solid #e0dede 1px; border-radius: 0px;" onchange="fixCartNum()">
  <button class="btn btn-light" style="border: solid #e0dede 1px; border-radius: 0px;" onclick="addMoreCart(1)">+</button>
</div>
<button class="btn btn-success" style="margin-top: 20px; width: 50%; border-radius: 10px;" onclick="addCart(<?=$product['IDPRODUCTS']?>, $('[name=num]').val())">
  <i class="bi bi-cart-plus-fill"></i> THÊM VÀO GIỎ HÀNG
</button>
<span class="cart_icon" style="position: fixed; z-index: 999999; right: 0px; top: 45%;">
  <a class="" href="cartdetail.php">
    <?php require_once 'showcart.php'; ?>
    <div class="cart-count">
      <span><?=$count?></span>
    </div>                            
    <img class="cart-icon" src="../icons/cart_24_regular.svg">
    <span>Cart</span>
  </a>
</span>
<br/><br>
<button class="btn btn-warning"><a href="../index.php" title="" class="nav-link">Home</a></button>
<script type="text/javascript">
  function addMoreCart(delta){
    num = parseInt($('[name=num]').val())
    num += delta
    if(num<1) num=1;
    $('[name=num]').val(num)
  }
  function fixCartNum(){
    $('[name=num]').val(Math.abs($('[name=num]').val()))
  }
  function addCart(IDPRODUCTS, num){
    // console.log(IDPRODUCTS + "," + num)
    $.post('mvc/api.php',{
      'action': 'cart',
      'IDPRODUCTS': IDPRODUCTS,
      'num': num
    }, function(data){
      location.reload()
    })
  }
</script>
</body>

</html>