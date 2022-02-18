<?php
    require_once '../database/database.php';
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
    <title>Brands Page - <?=$name?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="../../images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="../../styles/index.css">
        <script type="module" src="https://unpkg.com/@fluentui/web-components"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="../../scripts/index.js" defer></script>
        <title>Gracious Garments</title>
<body>
	<span class="cart_icon" style="position: fixed; z-index: 999999; right: 0px; top: 45%;">
        <a class="" href="../cartdetail.php">
            <?php require_once '../showcart.php'; ?>
            <div class="cart-count">
            <span><?=$count?></span>
            </div>                            
            <img class="cart-icon" src="../../icons/cart_24_regular.svg">
            <span>Cart</span>
        </a>
    </span>
  	<?php
		$id = '';
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$query = 'select * from brands where IDBRAND= ' . $id;
			$catalogylist = executeResult($query);
			if ($catalogylist != null && count($catalogylist) > 0) {
				foreach ($catalogylist as $catalist) {
					echo '<h2>' . strtoupper($catalist['BRAND_NAME'] ). '</h2> </br>' .$catalist['BRAND_DESC']. '';
				}
			}
			$query = 'select p.IDPRODUCTS as IDPRODUCTS,p.PRICE as PRICE, p.IMG as IMG, p.PRODUCT_NAME as PRODUCT_NAME from products p, brands b where b.IDBRAND=p.IDBRAND and b.IDBRAND= ' . $id;
			// echo $query;
			// die();
			$result = executeResult($query);

			foreach ($result as $product) {
				$num1 = $product['PRICE'];
				// $formatnum1 = number_format($num1, 2, ',', '.');
				$formatnum1 = number_format($num1, 0, ',', '.');
				//Số 0 là chữ số thập phân, dấu ',' ;là tách sau số thập phân==> 10.000,00
				// echo $formatnum;
				echo '
                <div class="col-md-3">
                    <a href="../showproducts.php?id=' . $product['IDPRODUCTS'] . '">
                    <img src="../product/img/' . $product['IMG'] . '" width="150px"; height="160px"> </a>
                    <a href="../showproducts.php?id=' . $product['IDPRODUCTS'] . '">
                    <p>' . $product['PRODUCT_NAME'] . '</p></a><p>' . $formatnum1 . ' VND<del>
                </div>';
				// echo '<div class="col-md-3">
				// <img src="'.$product['thumbnail'].'" width="100%">
				// <p>'.$sanpham['title'].'</p> <p>'number_format(.$sanpham['price'].)'<del><br>'.$sanpham['discount'].'</del></p>
				// </div>';
			}
		}
	?>
    <a href="../index.php" title="" class="nav-link">Home</a>
</body>
</html>