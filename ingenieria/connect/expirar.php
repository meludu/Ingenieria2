<?php
	session_start();
	if (isset($_SESSION['estado']) && $_SESSION['estado'] == "online") {
		$now = time();  // $now tiene el tiempo de ahora.
		if ($now > $_SESSION['expire']) {
			unset($_SESSION['estado']);
			unset($_SESSION['id']);
			unset($_SESSION['user']);
			unset($_SESSION['start']);
			unset($_SESSION['expire']);
			unset($_SESSION['tieneFoto']);
			session_destroy();
		}
	}
?>