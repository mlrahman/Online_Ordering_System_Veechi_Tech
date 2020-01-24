<?php
	include("../library/initialize.php");
	
	if(isset($_REQUEST['update_logo']) && isset($_REQUEST['status']) && isset($_REQUEST['state']) && isset($_REQUEST['image']) && isset($_REQUEST['image_id']) && isset($_REQUEST['caption']))
	{
		$link=$_REQUEST['image'];
		$caption=trim($_REQUEST['caption']);
		$state=trim($_REQUEST['state']);
		$status=trim($_REQUEST['status']);
		$image_id=trim($_REQUEST['image_id']);
		if($state=="NO")
		{
			$stmt=$conn->prepare("update gallery set caption=:caption, status=:status where image_id=:image_id ");
			$stmt->execute(array('caption'=>$caption, 'image_id'=>$image_id, 'status'=>$status));
			echo "Ok";
		}
		else
		{
		
			$file=$_FILES[$link];
			$image_name=photo_upload($file,0,100000,"jpg,gif,png,jpeg,bmp,heic",'../images/gallery',$path='');
			
			if($image!="1")
			{
				$mssg=makeThumbnails('../images/gallery/', $image_name, '' , '../images/gallery/', 1400, 800); //width than height
				if($mssg=="done")
				{
					$stmt=$conn->prepare("select * from gallery where image_id=:image_id ");
					$stmt->execute(array('image_id'=>$image_id));
					$list=$stmt->fetchAll();
					$old_image=$list[0]['image'];
					$base_directory = '../images/gallery/';
					//Deleting old image
					unlink($base_directory.$old_image);
				
				
					$stmt=$conn->prepare("update gallery set image=:image_name, caption=:caption, status=:status where image_id=:image_id ");
					$stmt->execute(array('image_name'=>$image_name, 'caption'=>$caption, 'image_id'=>$image_id, 'status'=>$status));
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
	}
?>