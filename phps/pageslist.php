<?php
	require_once ($_SERVER['DOCUMENT_ROOT'] . '/graciousgarments/phps/database/database.php');
	if ($currentPage - 4 >= 1) {
		echo '
			<div class="page-item">
				<a class="page-link" href="?page=1">First</a>
			</div>';
	}
	if ($currentPage > 1) {
		echo '
			<div class="page-item">
				<a class="page-link" href="?page=' . ($currentPage - 1) . '">Previous</a>
			</div>';
	}
	for ($i = 1; $i <= $page; $i++) {
		if ($i != $currentPage) {
			if ($i >= $currentPage - 3 && $i <= $currentPage + 3) {
				echo '
					<div class="page-item">
						<a class="page-link" href="?page=' . $i . '">' . $i . '</a>
					</div>';
			}
		} else {
			echo '
				<div class="page-item page__is-active">
					<a class="page-link">' . $i . '</a>
				</div>';
		}
	}
	if ($currentPage < $page) {
		echo '
			<div class="page-item">
				<a class="page-link" href="?page=' . ($currentPage + 1) . '">Next</a>
			</div>';
	}
	if ($page - $currentPage >= 4) {
		echo '
			<div class="page-item">
				<a class="page-link" href="?page=' . $page . '">Last</a>
			</div>';
	}
?>