<?php  
require_once $_SERVER['DOCUMENT_ROOT'] . '/graciousgarments/phps/database/database.php';
$query = 'select * from products order by PRODUCT_NAME';
    // echo $query;
    // die();
$result = executeResult($query);
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
    <form action="" method="get" accept-charset="utf-8">
        <div class="row" style="margin-top: 50px">
            <div class="col-5">
                <select class="form-control" id="id1" name="id1">
                    <?php foreach ($result as $item) : ?>
                        <option value="<?= $item['IDPRODUCTS'] ?>"><?= $item['PRODUCT_NAME'] ?></option>
                        <?php  
                        $idcompare1=$_SESSION['idcompare1'];
                        ?> 
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-5">
                <select class="form-control" id="id2" name="id2">
                    <?php foreach ($result as $item) : ?>
                        <option value="<?= $item['IDPRODUCTS']?>"><?= $item['PRODUCT_NAME'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

        </div>

        <button type="submit" name="submit" class="btn btn-success">Compare</button>
    </form>
<?php  
    if (isset($_GET['submit'])) {
    $id1= $_GET['id1'];
    $id2= $_GET['id2'];
    $query2 = "select p.DESC as `DESC`, p.IMG as IMG, b.IDBRAND as IDBRAND,b.BRAND_NAME as BRAND_NAME, p.PRODUCT_NAME as PRODUCT_NAME, IDPRODUCTS, p.PRICE as PRICE, p.IMG as IMG from products p, brands b where p.IDBRAND = b.IDBRAND and (IDPRODUCTS='$id1' or IDPRODUCTS='$id2')";
    // echo $query2; die();
    $result = executeResult($query2);
    foreach ($result as $sanpham) {
            // var_dump($result);
        $num1 = $sanpham['PRICE'];
            // $formatnum1 = number_format($num1, 2, ',', '.');
        $formatnum1 = number_format($num1, 0, ',', '.');
            //Số 0 là chữ số thập phân, dấu ',' ;là tách sau số thập phân==> 10.000,00
            // echo $formatnum;
        $name = $sanpham['PRODUCT_NAME'];
        echo '<div class="product-tiles__col">
                <div class="product-card">
                    <div class="product-card__text-area">
                        <div class="product-card__thumbnail">
                        <a href="phps/showproducts.php?id=' . $sanpham['IDPRODUCTS'] . '"><img src="product/img/' . $sanpham['IMG'] . '" alt=""></a>
                    </div>
                        <div class="product-name" title="' . $sanpham['PRODUCT_NAME'] . '">Name: 
                            <a href="phps/showproducts.php?id=' . $sanpham['IDPRODUCTS'] . '">' . strtoupper($sanpham['PRODUCT_NAME']) . '</a>
                        </div>
                        <div class="product-brand">Brand: 
                            <a href="phps/catalogy/showbrands.php?id=' . $sanpham['IDBRAND'] . '">' . strtoupper($sanpham['BRAND_NAME']) . '</a>
                        </div>

                        <div class="product-brand">
                            <a href="phps/catalogy/showbrands.php?id=' . $sanpham['IDBRAND'] . '">' .($sanpham['DESC']) . '</a>
                        </div>
                        <div class="product-price">
                            <span>' . $formatnum1 . ' VND</span>
                        </div>
                    </div>
                </div>
            </div>';
        // echo '<h2>' . $name . '</h2>';
//         echo '<table>
//     <tbody>
//         <td>' . $sanpham['PRODUCT_NAME'] . '</td>
//         <td>' . $sanpham['DESC'] . '</td>
//         <td>' . $sanpham['BRAND_NAME'] . '</td>
//     </tbody>
// </table>';
        // echo '<div>
        // <img src="product/img/' . $sanpham['IMG'] . '" width="150px"; height="160px">
        // <p>Name: ' . $sanpham['PRODUCT_NAME'] . '</p><p>Name: ' . $sanpham['BRAND_NAME'] . '</p><p>Price: ' . $formatnum1 . ' VND </p>
        // <p>Description: ' . $sanpham['DESC'] . '</p>
        // </div>';
    }
    // $query3 = "select p.DESC as `DESC`, p.IMG as IMG, b.IDBRAND as IDBRAND,b.BRAND_NAME as BRAND_NAME, p.PRODUCT_NAME as PRODUCT_NAME, IDPRODUCTS, p.PRICE as PRICE, p.IMG as IMG from products p, brands b where p.IDBRAND = b.IDBRAND and IDPRODUCTS='$id2'";
    // // echo $query2; die();
    // $result3 = executeResult($query3);
    // foreach ($result3 as $sanpham) {
    //         // var_dump($result);
    //     $num1 = $sanpham['PRICE'];
    //         // $formatnum1 = number_format($num1, 2, ',', '.');
    //     $formatnum1 = number_format($num1, 0, ',', '.');
    //         //Số 0 là chữ số thập phân, dấu ',' ;là tách sau số thập phân==> 10.000,00
    //         // echo $formatnum;
    //     $name = $sanpham['PRODUCT_NAME'];
    //     echo '<h2>' . $name . '</h2>';
    //     echo '<div>
    //     <img src="product/img/' . $sanpham['IMG'] . '" width="150px"; height="160px">
    //     <p>Name: ' . $sanpham['PRODUCT_NAME'] . '</p><p>Name: ' . $sanpham['BRAND_NAME'] . '</p><p>Price: ' . $formatnum1 . ' VND </p>
    //     <p>Description: ' . $sanpham['DESC'] . '</p>
    //     </div>';
    // }

}
?>
<table>
    <tbody>
        <td></td>
        <td></td>
        <td></td>
    </tbody>
</table>
</body>