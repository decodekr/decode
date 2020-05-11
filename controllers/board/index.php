<?php

include'models/board.php';

	include'views/'.$mobilePath.'document.html';
	include'views/'.$mobilePath.'header.html';
	include $board['view_template'];	
	include'views/'.$mobilePath.'footer.html';
?>