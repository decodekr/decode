<?php
	$files = pageList('files','type like "%'.$param['type'].'%"','',12,10,$param['page'],'/admin/file/page/$page?type='.$param['type'].'&layer='.$param['layer']);
	include'views/admin/document.html';
	include'views/admin/header.html';
?>		
<style type="text/css">
#file_library .image{
	width:170px;
	height:170px;
	overflow:hidden;
	margin-right:5px;
	display:inline-block;
	vertical-align:middle;
}
#file_library .file{
	line-height:170px;
	text-align:center;
	background:#ddd;
}
#file_library .file i{
	font-size:50px;
	color:#999;
}
#file_library .image img{
	width:170px;
	height:170px;
	
}

#file_library{
	padding:0;
	overflow:hidden;
}
#file_library li{
	position:relative;
	width:170px;
	height:170px;
	margin:9px;
	float:left;
	list-style:none;
}
#file_library li .title{
	position:absolute;
	left:0;
	bottom:0;
	width:100%;
	box-sizing:border-box;
	padding:3px 6px;
	line-height:20px;
	text-align:center;
	color:#222;
	background:rgba(255,255,255,0.7);
}
</style>
<h2 id="contents_title">
	<i class="fa fa-leaf"></i>
	기본설정
</h2>
<div class="contents">
	<div class="container">
		<table class="table table-bordered" id="file_library_title">
		<thead>
			<tr>
				<td colspan="3">
				<a href="" class="btn btn-primary" style="position:relative">	<iframe src="/common/upload_file?callback=upload&path=/<?=date('Y')?>/<?=date('m')?>/<?=date('d')?>" frameborder="0" style="position:absolute;top:0;left:0;width:100%;height:100%;" scrolling="no"></iframe>파일 올리기</a>
			
				</td>
			</tr>
			<tr>
				<th>
					파일명
				</th>
				<th>
					파일 유형
				</th>
				<th>
					등록일
				</th>
			</tr>
		</thead>
			
		<tbody>

		</tbody>
		</table>
		
		<ul id="file_library">
			<?php
			foreach($files['list'] as $file){

	$icon ='file-o';
	if(indexOf($file['type'],'audio')!=-1){
		$icon = 'file-audio-o';
	}
	if(indexOf($file['type'],'video')!=-1){
		$icon = 'file-video-o';
	}
	if(indexOf($file['type'],'pdf')!=-1){
		$icon = 'file-pdf-o';
	}
	if(indexOf($file['type'],'xls')!=-1){
		$icon = 'file-excel-o';
	}
	if(indexOf($file['type'],'zip')!=-1){
		$icon = 'file-zip-o';
	}

		?>
		<li>
			<a href="">
		<?=attr(indexOf($file['type'],'image')!=-1,'<div class="image"><img src="/files/'.$file['path'].'"></div>')?>
		<?=attr(indexOf($file['type'],'image')==-1,'<div class="file"><i class="fa fa-'.$icon.'"></i></div>')?>
			
			
			<span class="title">
			<?=$file['name']?>
			</span>
			</a>
		

		</li>
		<?php
			}
		?>
		</ul>


		

		
		<div class="pagination">
		<?=$files['pagination']?>
		</div>
	</div>
</div>



			<script type="text/javascript">
function upload($fileInfo){
	var type = '';
	if($fileInfo.type.indexOf('image')!=-1){
		type  = '<div class="image"><img src="/files'+'/<?=date('Y')?>/<?=date('m')?>/<?=date('d')?>/'+$fileInfo.path+'"></div>';
	}
	else if($fileInfo.type.indexOf('audio')!=-1){
		type ='<div class="file"><i class="fa fa-file-audio-o"></i></div>';
	}
	else if($fileInfo.type.indexOf('video')!=-1){
		type ='<div class="file"><i class="fa fa-file-video-o"></i></div>';
	}
	else if($fileInfo.type.indexOf('pdf')!=-1){
		type ='<div class="file"><i class="fa fa-file-pdf-o"></i></div>';
	}
	else if($fileInfo.type.indexOf('xls')!=-1){
		type ='<div class="file"><i class="fa fa-file-excel-o"></i></div>';
	}
	else if($fileInfo.type.indexOf('zip')!=-1){
		type ='<div class="file"><i class="fa fa-file-zip-o"></i></div>';
	}
	else{
		type ='<div class="file"><i class="fa fa-file-o"></i></div>';
	}
	$('#file_library').prepend(' <li><a href="">'+type+'<span class="title">'+$fileInfo.name+'</span></a></li>');
	
	postRequest({
		url : '/common/upload_file?mode=data',
		data : {name : $fileInfo.name,type:$fileInfo.type,path :'/<?=date('Y')?>/<?=date('m')?>/<?=date('d')?>/'+$fileInfo.path},
		success : function($data){
		
		}
	});
}
			</script>
<?php
	if($param['layer']){
?>
<style type="text/css">

header,footer,#gnb,#lnb_wrap{
	display:none;
}
#contents_wrap{
	background:none;
}
#inner_contents{
	margin:0;
	padding:0;
	background:none;
}
</style>

<script type="text/javascript">
$('#file_library li a').click(function(){
	var image = $(this).find('img').attr('src');
	$(parent.document).find('#image_library_layer').fadeOut();
	parent.CKEDITOR.instances.contents.insertHtml('<img src="'+image+'">');
	return false;
});
</script>
<?php
			}
	include'views/admin/footer.html';
?>