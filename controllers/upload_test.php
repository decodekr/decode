<?php

	if($param['has_data']==1){

		print_x(uploadFile($_FILES['test'],'/files/test'));
			exit;
}

?>

<form action="" method="post" enctype="multipart/form-data">
<input type="file" name="test" />
<input type="hidden" name="has_data" value="1" />
<input type="submit" />
</form>