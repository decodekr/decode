<?php
	include'views/admin/document.html';
	include'views/admin/header.html';
?>
<h2 id="contents_title">
<i class="fa fa-bar-chart-o"></i>
	접속자 통계
</h2>
<?php
	loadPlugin('statistics');
?>

<?php
	include'views/admin/footer.html';
