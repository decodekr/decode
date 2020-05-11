<?php
	loadPlugin('contact_form');
include'views/document.html';
include'views/header.html';
?>
	<form action="" method="post">
		<input type="hidden" name="has_data"  value="1"/>
		<input type="text" name="name">
		<input type="text" name="age">
		<input type="submit" />
	</form>
<?php
include'views/footer.html';
	?>
