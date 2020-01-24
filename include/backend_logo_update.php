<?php
	include("../library/initialize.php");
	
	//file delete server info required to update if needed
	$base_directory = '../images/';
	
	if(isset($_REQUEST['update_logo']) && isset($_REQUEST['image']))
	{
		$link=$_REQUEST['image'];
		$file=$_FILES[$link];
		$image_name=photo_upload($file,0,100000,"jpg,gif,png,jpeg,bmp,heic",'../images',$path='');
		
		if($image!="1")
		{
			$mssg=makeThumbnails('../images/', $image_name, '' , '../images/', 375, 147); //width than height
			if($mssg=="done")
			{
				$stmt=$conn->prepare("select * from website_basic_info where id='1' ");
				$stmt->execute();
				$list=$stmt->fetchAll();
				//Deleting old image
				$old_image=$list[0]['backend_logo'];
				unlink($base_directory.$old_image);
				
				
				$stmt=$conn->prepare("update website_basic_info set
										backend_logo='$image_name'
										where id='1' ");
				$stmt->execute();
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