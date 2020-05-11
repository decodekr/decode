<?php
	unset($_SESSION['login']);
	unset($_SESSION['id'] );
	unset($_SESSION['name'] );
	unset($_SESSION['is_admin'] );
	unset($_SESSION['grade'] );
	getBack('/admin/login');
?>