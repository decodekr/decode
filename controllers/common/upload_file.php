<?php
	if($param['mode']=='data'){
		insertItem('files',$param);
		exit;
	}
	$image = uploadFile($_FILES['image'],'/files'.$param['path']);

?>
<!doctype html>
<html lang="ko">
 <head>
<script type="text/javascript" src="/scripts/jquery.js"></script>
  <title>Upload Image</title>
  <style type="text/css">
  *{
	padding:0;
	margin:0;
  }
  input[type="file"]{
	font-size:200px;
	opacity:0;
	filter:alpha(opacity=0);
	cursor:pointer !important;
  }
  </style>
  <script type="text/javascript">
  $(function(){
	  <?php
	  if($_FILES['image']['name']){
if($param['callback']!=''){

	?>
		


  parent.<?=$param['callback']?>({name : '<?=$image['name']?>',path : '<?=$image['path']?>',type : '<?=$image['type']?>'});
	    <?php
}
	  }
			  ?>
	$('#image').change(function(){
		$('form').submit();
	});
  });
  </script>
 </head>
 <body>
 <form action="" method="Post" enctype="multipart/form-data">
 <input type="file" name="image" id="image">
 </form>

 </body>
</html>
