<?php
        // if (isset($_GET['slsp'])) {
        //  $shownum = $_GET['slsp'];
        //  // echo $shownum;
        // }
        $sql = 'select count(IDPRODUCTS) as number from products';
        $result = executeResult($sql);
        if ($result!=null && count($result)>0) {
          $number = $result[0]['number'];
          // echo "<br>"; -- làm này để xuống dòng nhé.
          // echo $number;
        }       
        if ($result<=0){
          echo '<li class="page-item"><a class="page-link" href="?page=1">Last</a></li>';
        }
        $page = ceil($number/6);
        // $page = $number/8;
        //đoạn này là: nếu có số page trên get thì nó sẽ thể hiện trang hiện tại bằng số page đó
        if (isset($_GET['page'])) {
          $currentPage=$_GET['page'];//nếu không có câu này thì lúc nào nó cũng mặc định page là 1. vì nó k nhảy trang hiện tại đâu;
          if($currentPage<=0){
            header('location: ?page=1');
          }
        }
        else{
          $currentPage = 1;
        }
        $index = ($currentPage-1)*6;
        if (isset($_GET['search']) && $_GET['search']!='') {
          // echo "Tìm kiếm";
          $shownum = $_GET['slsp'];
          $search=$_GET['search'];
          $query = 'select * from products where PRODUCT_NAME like "%'.$search.'%"';
        } else{
          $query = 'select b.IDBRAND as IDBRAND,b.BRAND_NAME as BRAND_NAME, p.PRODUCT_NAME as PRODUCT_NAME, IDPRODUCTS, p.PRICE, p.IMG as IMG from products p, brands b where p.IDBRAND = b.IDBRAND limit '.$index.', 6';
        }
        $result = executeResult($query);

        foreach ($result as $sanpham) {
          $num1=$sanpham['PRICE'];
          // $formatnum1 = number_format($num1, 2, ',', '.'); 
          $formatnum1 = number_format($num1, 0, ',', '.'); 
          //Số 0 là chữ số thập phân, dấu ',' ;là tách sau số thập phân==> 10.000,00
          // echo $formatnum;
          echo '<div class=""><a href="../project1/product/showproducts.php?id='.$sanpham['IDPRODUCTS'].'" class="nav-link"><img src="../project1/product/img/'.$sanpham['IMG'].'" width="170px"; height="160px"></a>
          <a href="../project1/product/showproducts.php?id='.$sanpham['IDPRODUCTS'].'" class="nav-link">Product Name: '.$sanpham['PRODUCT_NAME'].'</a>
          <a href="../project1/catalogy/showbrands.php?id='.$sanpham['IDBRAND'].'" class="nav-link">Brand: '.$sanpham['BRAND_NAME'].'</a>
          <a href="#" class="nav-link"> Price: '.$formatnum1.' VND</a><p><button class="btn btn-success" onclick="addCart('.$sanpham['IDPRODUCTS'].', 1)" style="width: 50%; border-radius: 0px;"><i class="bi bi-cart-plus-fill"></i> Thêm giỏ hàng</button></p>
          </div>';
          // echo '<div class="col-md-3">
          // <img src="'.$sanpham['thumbnail'].'" width="100%">
          // <p>'.$sanpham['title'].'</p> <p>'number_format(.$sanpham['price'].)'<del><br>'.$sanpham['discount'].'</del></p>
          // </div>';
        }
        // $result = mysqli_query($conn,$query);
        // var_dump($result);
        // while ($row = mysqli_fetch_array($result,1)){
        //  $list[]=$row;
        //  echo '<div class="col-md-3">
        //  <img src="'.$row['thumbnail'].'" width="100%">
        //  <p>'.$row['title'].'</p> <p>'.$row['price'].'<del><br>'.$row['discount'].'</del></p>
        //  </div>';
        // }
        ?>
<script type="text/javascript">
    function addCart(productId) {
      console.log(productId + "," +num)
    $.post('../api/api_cart.php', {
      'action': 'cart',
      'IDPRODUCTS': productId,
      // 'num': num
    }, function(data) {
      location.reload()
    })
  }
</script>