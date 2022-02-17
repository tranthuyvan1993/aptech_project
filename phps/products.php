<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/graciousgarments/phps/database/database.php';
    // session_start();
    // if (isset($_GET['slsp'])) {
    //  $shownum = $_GET['slsp'];
    //  // echo $shownum;
    // }
    
    $sql = 'select count(IDPRODUCTS) as number from products';
    $result = executeResult($sql);

    if ($result != null && count($result) > 0) {
        $number = $result[0]['number'];
        // echo "<br>"; -- làm này để xuống dòng nhé.
        // echo $number;
    }

    if ($result <= 0) {
        echo '<li class="page-item"><a class="page-link" href="?page=1">Last</a></li>';
    }
    $page = ceil($number / 20);
    // $page = $number/8;

    //đoạn này là: nếu có số page trên get thì nó sẽ thể hiện trang hiện tại bằng số page đó
    if (isset($_GET['page'])) {
        $currentPage = $_GET['page']; //nếu không có câu này thì lúc nào nó cũng mặc định page là 1. vì nó k nhảy trang hiện tại đâu;
        if ($currentPage <= 0) {
            header('location: ?page=1');
        }
    } else {
        $currentPage = 1;
    }

    $index = ($currentPage - 1) * 20;
    if (isset($_GET['search']) && $_GET['search'] != '') {
        // echo "Tìm kiếm";
        $shownum = $_GET['slsp'];
        $search = $_GET['search'];
        $query = 'select * from products where PRODUCT_NAME like "%' . $search . '%"';
    } else {
        $query = 'select p.updated_at as updated_at, b.IDBRAND as IDBRAND,b.BRAND_NAME as BRAND_NAME, p.PRODUCT_NAME as PRODUCT_NAME, IDPRODUCTS, p.PRICE, p.IMG as IMG from products p, brands b where p.IDBRAND = b.IDBRAND order by updated_at desc limit ' . $index . ', 20';
    }

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
                        <a href="phps/showproducts.php?id=' . $product['IDPRODUCTS'] . '"><img src="images/products/' . $product['IMG'] . '" alt=""></a>
                    </div>
                    <div class="product-card__text-area">
                        <div class="product-name" title="' . $product['PRODUCT_NAME'] . '">
                            <a href="phps/showproducts.php?id=' . $product['IDPRODUCTS'] . '">' . strtoupper($product['PRODUCT_NAME']) . '</a>
                        </div>
                        <div class="product-brand">
                            <a href="phps/catalogy/showbrands.php?id=' . $product['IDBRAND'] . '">' . strtoupper($product['BRAND_NAME']) . '</a>
                        </div>
                        <div class="product-price">
                            <span>' . $formatnum1 . ' VND</span>
                        </div>
                    </div>
                    <div class="product-card__action-area">
                        <button class="product-card__button">
                            <span>Buy now</span>
                            <img class="icon" src="icons/wallet_20_regular.svg">
                        </button>
                        <button class="product-card__button" onclick="addCart(' . $product['IDPRODUCTS'] . ',1)">
                            <span>Add to cart</span>
                            <img class="icon" src="icons/cart_20_regular.svg">
                        </button>
                    </div>
                </div>
            </div>
        ';
        if ($i % 4 == 0) {
            echo '</div>';
        }
    }

    require_once $_SERVER['DOCUMENT_ROOT'] . '/graciousgarments/phps/database/database.php';
?>
<script type="text/javascript">
    function addCart(IDPRODUCTS, num){
    console.log(IDPRODUCTS + "," + num)
    $.post('phps/mvc/api.php',{
      'action': 'cart',
      'IDPRODUCTS': IDPRODUCTS,
      'num': num
    }, function(data){
      location.reload()
    })
  }
</script>