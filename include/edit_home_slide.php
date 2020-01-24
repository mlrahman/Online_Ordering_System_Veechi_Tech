<?php
	include("../library/initialize.php");
	
	if(isset($_REQUEST['update_logo']) && isset($_REQUEST['status']) && isset($_REQUEST['state']) && isset($_REQUEST['image']) && isset($_REQUEST['slide_id']) && isset($_REQUEST['caption']))
	{
		$link=$_REQUEST['image'];
		$caption=trim($_REQUEST['caption']);
		$state=trim($_REQUEST['state']);
		$status=trim($_REQUEST['status']);
		$slide_id=trim($_REQUEST['slide_id']);
		if($state=="NO")
		{
			$stmt=$conn->prepare("update home_slides set caption=:caption, status=:status where slide_id=:slide_id ");
			$stmt->execute(array('caption'=>$caption, 'slide_id'=>$slide_id, 'status'=>$status));
			echo "Ok";
		}
		else
		{
		
			$file=$_FILES[$link];
			$image_name=photo_upload($file,0,100000,"jpg,gif,png,jpeg,bmp,heic",'../images/slides',$path='');
			
			if($image!="1")
			{
				$mssg=makeThumbnails('../images/slides/', $image_name, '' , '../images/slides/', 1400, 600); //width than height
				if($mssg=="done")
				{
					$stmt=$conn->prepare("select * from home_slides where slide_id=:slide_id ");
					$stmt->execute(array('slide_id'=>$slide_id));
					$list=$stmt->fetchAll();
					$old_image=$list[0]['image'];
					$base_directory = '../images/slides/';
					//Deleting old image
					unlink($base_directory.$old_image);
				
				
					$stmt=$conn->prepare("update home_slides set image=:image_name, caption=:caption, status=:status where slide_id=:slide_id ");
					$stmt->execute(array('image_name'=>$image_name, 'caption'=>$caption, 'slide_id'=>$slide_id, 'status'=>$status));
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