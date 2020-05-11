<?php
	include'views/admin/document.html';
	include'views/admin/header.html';

?>		



<div class="portlet-title">
	<div class="caption">
		<i class="fa fa-user font-green-sharp"></i>
		<span class="caption-subject font-green-sharp bold uppercase">참여자 관리</span>
	</div>

</div>
<div class="portlet-body">
	<?php
		loadPlugin('contact_form');
	?>
</div>



			

<?php
	include'views/admin/footer.html';
?>