<?php
	//DB Connection update required for a new hosting
	include("../library/initialize.php");
	
	//file delete server info required to update if needed
	$base_directory = '../images/customer/';
	
	if(isset($_REQUEST['update_profile']) && isset($_REQUEST['image']) && isset($_REQUEST['customer_id']))
	{
		$customer_id=trim($_REQUEST['customer_id']);
		
		$ffff=0;
		
		$stmt=$conn->prepare("select * from customer order by customer_id asc ");
		$stmt->execute();
		$list=$stmt->fetchAll();
		foreach($list as $row)
		{
			if(sha1($row['customer_id'])==$customer_id)
			{
				$customer_id=$row['customer_id'];
				$old_image=$row['image'];
				$ffff=1;
				break;
			}
		}
		
		if($ffff==1)
		{
			$first_name=trim($_REQUEST['first_name']);
			$last_name=trim($_REQUEST['last_name']);
			$mobile=trim($_REQUEST['mobile']);
			$telephone=trim($_REQUEST['telephone']);
			$email=trim($_REQUEST['email']);
			$password=trim($_REQUEST['password']);
			$address=trim($_REQUEST['address']);
			$post_code=trim($_REQUEST['post_code']);
			
			
			//Retriving Image
			$link=$_REQUEST['image'];
			$file=$_FILES[$link];
			$image_name=photo_upload($file,0,100000,"jpg,gif,png,jpeg,bmp,heic",'../images/customer',$path='');
			
			
			//Check Image Error here & also compress it********
			if($image!="1")
			{
				$mssg=makeThumbnails('../images/customer/', $image_name, '' , '../images/customer/', 800, 800); //width than height
				if($mssg=="done")
				{
					//Deleting old image
					unlink($base_directory.$old_image);
					
					//Update finally
					if($password=="")//Password not given
					{
						
						$stmt=$conn->prepare("update customer set 
								first_name=:first_name,
								last_name=:last_name,
								mobile=:mobile,
								telephone=:telephone,
								email=:email,
								image='$image_name',
								address=:address,
								post_code=:post_code
								where customer_id='$customer_id'
						");
						$stmt->execute(array('first_name'=>$first_name, 'last_name'=>$last_name, 'mobile'=>$mobile, 'telephone'=>$telephone, 'email'=>$email, 'address'=>$address, 'post_code'=>$post_code ));
						
						echo "Ok";
					}
					else //Password given
					{
						$password=sha1($password);
						
						
						$stmt=$conn->prepare("update customer set 
								first_name=:first_name,
								last_name=:last_name,
								mobile=:mobile,
								telephone=:telephone,
								email=:email,
								image='$image_name',
								password='$password',
								address=:address,
								post_code=:post_code
								where customer_id='$customer_id'
						");
						$stmt->execute(array('first_name'=>$first_name, 'last_name'=>$last_name, 'mobile'=>$mobile, 'telephone'=>$telephone, 'email'=>$email, 'address'=>$address, 'post_code'=>$post_code ));
						
						echo "Ok";
					}
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
		else
		{
			echo "Error";
		}
	}
	
	
	if(isset($_REQUEST['update_profile_text']) && isset($_REQUEST['customer_id']))
	{
		$customer_id=trim($_REQUEST['customer_id']);
		
		$ffff=0;
		
		$stmt=$conn->prepare("select * from customer order by customer_id asc ");
		$stmt->execute();
		$list=$stmt->fetchAll();
		foreach($list as $row)
		{
			if(sha1($row['customer_id'])==$customer_id)
			{
				$customer_id=$row['customer_id'];
				$old_image=$row['image'];
				$ffff=1;
				break;
			}
		}
		
		if($ffff==1)
		{
			$first_name=trim($_REQUEST['first_name']);
			$last_name=trim($_REQUEST['last_name']);
			$mobile=trim($_REQUEST['mobile']);
			$telephone=trim($_REQUEST['telephone']);
			$email=trim($_REQUEST['email']);
			$password=trim($_REQUEST['password']);
			$address=trim($_REQUEST['address']);
			$post_code=trim($_REQUEST['post_code']);
			
			//Update finally
			if($password=="")//Password not given
			{
				
				$stmt=$conn->prepare("update customer set 
						first_name=:first_name,
						last_name=:last_name,
						mobile=:mobile,
						telephone=:telephone,
						email=:email,
						address=:address,
						post_code=:post_code
						where customer_id='$customer_id'
				");
				$stmt->execute(array('first_name'=>$first_name, 'last_name'=>$last_name, 'mobile'=>$mobile, 'telephone'=>$telephone, 'email'=>$email, 'address'=>$address, 'post_code'=>$post_code ));
				
				
				echo "Ok";
			}
			else //Password given
			{
				$password=sha1($password);
				
				$stmt=$conn->prepare("update customer set 
						first_name=:first_name,
						last_name=:last_name,
						mobile=:mobile,
						telephone=:telephone,
						email=:email,
						password='$password',
						address=:address,
						post_code=:post_code
						where customer_id='$customer_id'
				");
				$stmt->execute(array('first_name'=>$first_name, 'last_name'=>$last_name, 'mobile'=>$mobile, 'telephone'=>$telephone, 'email'=>$email, 'address'=>$address, 'post_code'=>$post_code ));
						
				
				echo "Ok";
			}
		}
		else
		{
			echo "Error";
		}
	
	}
	

?>