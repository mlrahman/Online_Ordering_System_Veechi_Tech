<?php
	include("../library/initialize.php");
	
	if(isset($_REQUEST['update_logo']) && isset($_REQUEST['image']) && isset($_REQUEST['caption']))
	{
		$link=$_REQUEST['image'];
		$caption=trim($_REQUEST['caption']);
		$file=$_FILES[$link];
		$image_name=photo_upload($file,0,100000,"jpg,gif,png,jpeg,bmp,heic",'../images/slides',$path='');
		
		if($image!="1")
		{
			$mssg=makeThumbnails('../images/slides/', $image_name, '' , '../images/slides/', 1400, 600); //width than height
			if($mssg=="done")
			{
				$stmt=$conn->prepare("insert into home_slides(image,caption,status) values('$image_name',?,'active') ");
				$stmt->execute([$caption]);
				echo "Ok";
			}
			else
			{
				echo "Error";
			}
		}
		else
		{
			echo "Error";
		}
	}
?>