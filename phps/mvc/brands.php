<?php
require_once './database/database.php';
$index = 1;
$query = 'select * from brands';
$catalogylist = executeResult($query);

if ($catalogylist != null && count($catalogylist) > 0) {
	foreach ($catalogylist as $catalist) {
		echo '<tr>
    <td><a href="../project1/catalogy/showbrands.php?id=' . $catalist['IDBRAND'] . '" class="nav-link">' . strtoupper($catalist['BRAND_NAME']) . '</a></td>
    <td><a href="../project1/catalogy/showbrands.php?id=' . $catalist['IDBRAND'] . '" class="nav-link"><img src="' . $catalist['IMG'] . '" style="width:100px"></a></td>
    </tr>';
	}
}
?>