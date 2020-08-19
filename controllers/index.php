<?php
	include'views/header.html';
?>

<?php
	if($session['user_type']=='buyer'||$session['user_type']==''){
	include'views/buyer_main.html';
}
	if($session['user_type']=='seller'){
	include'views/seller_main.html';
}
	include'views/footer.html';
?>