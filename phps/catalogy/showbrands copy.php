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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="../../styles/index.css">
    <script type="module" src="https://unpkg.com/@fluentui/web-components"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="../../scripts/index.js" defer></script>
    <title>Gracious Garments</title>
<body>
    <div id="header" class="header-area"> <!--header/navigation bar-->
        <header>
            <div id="navbar" class="navbar">
                <a class="navbar__logo-container" href="../../index.php">
                    <div class="navbar__logo">
                        <img src="../../images/ggLogo.png" alt="">
                        <div class="navbar__title">
                            <span class="primary-color__text">Gracious</span> <span class="secondary-color__text">Garments</span>
                        </div>
                    </div>
                </a>
                <div class="navbar__link-container">
                    <nav class="navbar__page-section">
                        <a class="navbar__link navbar__link--is-active" href="../../index.php">
                            <span>Home</span>
                        </a>
                        <a id="brandButton" class="navbar__link" onclick="toggleBrandMenu();">
                            <span>Brands</span>
                        </a>
                        <a class="navbar__link" href="../../contacts.html">
                            <span>Contacts</span>
                        </a>
                    </nav>
                    <nav class="navbar__user-section">
                        <?php if (isset($user['FULLNAME'])) {?>
                        <a id="customerProfileButton" href="#" class="navbar__link" title="<?php echo $user['FULLNAME']; ?>">
                            <span><?php echo $user['FULLNAME']; ?></span>
                        </a>
                        <a class="navbar__link" href="../../phps/customer/logoutcus.php">
                            <span>Logout</span>
                        </a>
                        <?php } else {?>
                        <a class="navbar__link" href="../../phps/customer/logincus.php">
                            <span>Login</span>
                        </a>
                        <a class="navbar__link" href="../../phps/customer/registercus.php">
                            <span>Register</span>
                        </a>
                        <?php }?>
                        <a class="navbar__link cart-area" href="../../phps/cartdetail.php">
                            <?php require_once '../../phps/showcart.php'; ?>
                            <div class="cart-count">
                                <span><?=$count?></span>
                            </div>                            
                            <img class="cart-icon" src="../../icons/cart_24_regular.svg">
                            <span>Cart</span>
                        </a>
                    </nav>
                </div>
            </div>
        </header>
    </div>
    <section id="brandMenuContainer" class="brand-menu-container"> <!--brand menu-->
        <div id="brandMenu" class="brand-menu acrylic__light">
            <?php require_once '../../phps/brands.php';?>
            <div class="brand-menu__close-button__container">
                <button id="brandMenuCloseButton" class="brand-menu__close-button" onclick="closeBrandMenu();">
                    <img src="../../icons/dismiss_32_regular.svg">
                </button>
            </div>
        </div>
    </section>
    <section class="product-tiles"> <!--products-->
        <?php
            $id = '';
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $query = 'select * from brands where IDBRAND= ' . $id;
                $catalogylist = executeResult($query);
                if ($catalogylist != null && count($catalogylist) > 0) {
                    foreach ($catalogylist as $catalist) {
                    echo '
                    <div class="product-tiles__row">
                        <div class="brand-page__brand-title">
                            <span>' . strtoupper($catalist['BRAND_NAME'] ). '</span>
                        </div>
                        <div class="brand-page__brand-description">
                            <span>' .$catalist['BRAND_DESC']. '</span>
                        </div>
                    </div>';
                    }
                }
                $query = 'select p.IDPRODUCTS as IDPRODUCTS,p.PRICE as PRICE, p.IMG as IMG, p.PRODUCT_NAME as PRODUCT_NAME from products p, brands b where b.IDBRAND=p.IDBRAND and b.IDBRAND= ' . $id;
                // echo $query;
                // die();
                $result = executeResult($query);
                
                $i = 0;
                foreach ($result as $product) {
                    $num1 = $product['PRICE'];
                    // $formatnum1 = number_format($num1, 2, ',', '.');
                    $formatnum1 = number_format($num1, 0, ',', '.');
                    //Số 0 là chữ số thập phân, dấu ',' ;là tách sau số thập phân==> 10.000,00
                    // echo $formatnum;
                    if ($i % 4 == 0) {
                        echo '<div class="product-tiles__row">';
                    }
                    $i++;
                    echo '
                    <div class="product-tiles__col">
                        <div class="product-card">
                            <div class="product-card__thumbnail">
                                <a href="phps/showproducts.php?id=' . $product['IDPRODUCTS'] . '"><img src="../../images/products/' . $product['IMG'] . '" alt=""></a>
                            </div>
                            <div class="product-card__text-area">
                                <div class="product-name" title="' . $product['PRODUCT_NAME'] . '">
                                    <a href="../../phps/showproducts.php?id=' . $product['IDPRODUCTS'] . '">' . strtoupper($product['PRODUCT_NAME']) . '</a>
                                </div>
                                <div class="product-price">
                                    <span>' . $formatnum1 . ' VND</span>
                                </div>
                            </div>
                            <div class="product-card__action-area">
                                <button class="product-card__button">
                                    <span>Buy now</span>
                                    <img class="icon" src="../../icons/wallet_20_regular.svg">
                                </button>
                                <button class="product-card__button" onclick="addCart(' . $product['IDPRODUCTS'] . ',1)">
                                    <span>Add to cart</span>
                                    <img class="icon" src="../../icons/cart_20_regular.svg">
                                </button>
                            </div>
                        </div>
                    </div>';
                    if ($i % 4 == 0) {
                        echo '</div>';
                    }
                }
            }
        ?>
    </section>
    <script type="text/javascript">
        function addCart(IDPRODUCTS, num){
            $.post('../../phps/mvc/api.php',{
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