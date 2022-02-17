<?php
if ($currentPage-4>=1) {
  echo '<li class="page-item"><a class="page-link" href="?page=1">First</a></li>';
}
if ($currentPage>1) {
  echo '<li class="page-item"><a class="page-link" href="?page='.($currentPage-1).'">Previous</a></li>';
}
for ($i=1; $i<=$page; $i++) { 
  if ($i!=$currentPage) {
    if ($i>=$currentPage-3 && $i<=$currentPage+3)
    {
      echo '<br/>';
      echo '<li class="page-item"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
    }
  }else{
    echo '<strong><li class="page-item"><a style="color: red" class="page-link">'.$i.'</a></li></strong>';
  }
}
if ($currentPage<$page) {
  echo '<li class="page-item"><a class="page-link" href="?page='.($currentPage+1).'">Next</a></li>';
}
if ($page-$currentPage>=4) {
  echo '<li class="page-item"><a class="page-link" href="?page='.$page.'">Last</a></li>';
}
?>