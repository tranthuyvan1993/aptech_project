<?php
require_once('../database/database.php');
if (!empty($_POST)) {
	if(isset($_POST['action'])){
		$action=$_POST['action'];
		switch ($action) {
			case 'delete':
			echo "xóa";
			if (isset($_POST['id'])) {
				$id    = $_POST['id'];
				$query = 'delete from products where IDPRODUCTS= '.$id;
				
				// die();
				executeRe($query);
				// echo "đã xóa rồi nhé";
			}
			break;
		}
		echo $query;
	}
}
// if(isset($_POST['id'])){
// 	echo("xóa");
// 	$id=$_POST['id'];
// 	// require_once('dbdetail.php');
// 	$query = 'delete from category where id= '.$id;
// 	execute($query);
// 	echo "đã xóa rồi nhé";
// }
