<?php
	//Session Initialize for Cart
	session_start();
	if(!isset($_SESSION['cart_item']) or !isset($_SESSION['cart_item_quantity']) or !isset($_SESSION['cart_coupon'])) {
	   $_SESSION['cart_item'] = array();
	   $_SESSION['cart_item_quantity'] = array();
	   $_SESSION['cart_coupon']=0;
	   //testing figure
	   /*
	   $_SESSION['cart_item'][]=2;
	   $_SESSION['cart_item_quantity'][2]=10;
	   
	   $_SESSION['cart_item'][]=3;
	   $_SESSION['cart_item_quantity'][3]=10;
	   
	   $_SESSION['cart_item'][]=4;
	   $_SESSION['cart_item_quantity'][4]=10;
	   // */
	}
	
	//Time and Date Function
	function get_time()
	{
		$offset=6*60*60; //GMT +6.
	    $dateFormat="h:i a";
	    $post_time=gmdate($dateFormat, time()+$offset);
		return $post_time;
	}
	
	function get_date()
	{
		$offset=6*60*60; //GMT +6.
		$dateFormat="d M Y";
		$post_date=gmdate($dateFormat, time()+$offset);
		return $post_date;
	}
	
	function get_coupon_date()
	{
		$offset=6*60*60; //GMT +6.
		$dateFormat="Y-m-d";
		$post_date=gmdate($dateFormat, time()+$offset);
		return $post_date;
	}
	
	//Email Function change with related information
	
	function sent_mail($to,$subject,$msg)
	{
        
        $headers[]= 'Reply-To: '.$website_title.' <'.$website_email.'>';
        $headers[]= 'Return-Path: '.$website_title.' <'.$website_email.'>';
        $headers[]= 'From: '.$website_title.' <'.$website_email.'>'; 
        $headers[] = 'Cc: '.$website_email.'';
        $headers[]= 'Organization: '.$website_title.'';
        $headers[]= 'MIME-Version: 1.0';
        $headers[]= 'Content-type: text/html; charset=iso-8859-1';
        $headers[]= 'X-Priority: 3';
        $headers[]= 'X-Mailer: PHP'. phpversion();
        
        
		mail($to, $subject, $msg, implode("\r\n", $headers));
	}
	
	function sent_mail_personal($to,$from,$name,$subject,$msg)
	{
        //$name of from person and $from wmail of from person
        $headers[]= 'Reply-To: '.$name.' <'.$from.'>';
        $headers[]= 'Return-Path: '.$name.' <'.$from.'>';
        $headers[]= 'From: '.$name.' <'.$from.'>'; 
        //$headers[] = 'Cc: '.$from.'';
        //$headers[]= 'Organization: '.$name.'';
        $headers[]= 'MIME-Version: 1.0';
        $headers[]= 'Content-type: text/html; charset=iso-8859-1';
        $headers[]= 'X-Priority: 3';
        $headers[]= 'X-Mailer: PHP'. phpversion();
        
        
		mail($to, $subject, $msg, implode("\r\n", $headers));
	}
	
	//Image Upload function
	function photo_upload($file,$i,$max_foto_size,$photo_extention,$folder_name,$path='')
	{
			if($file['tmp_name']=="")
			{
				return "1";
			}
			if($file['tmp_name']!="")
			{
					$p=$file['name'];
					$pos=strrpos($p,".");
					$ph=strtolower(substr($p,$pos+1,strlen($p)-$pos));
					$im_size =  round($file['size']/1024,2);

					if($im_size > $max_foto_size)
					   {
							//echo "Image is Too Large";
							return "1";
					   }
					$photo_extention = explode(",",$photo_extention);
					if(!in_array($ph,$photo_extention ))
					   {
							//echo "Upload Correct Image";

							return "1";
					   }
			}
					$ran=date(time());
					$c=$ran.rand(1,10000);
					$ran.=$c.".".$ph;



					if(isset($file['tmp_name']) && is_uploaded_file($file['tmp_name']))
					{
						$ff = $folder_name."/".$ran;
						move_uploaded_file($file['tmp_name'], $ff );
						chmod($ff, 0777);
					}
		   return  $ran;
	}
	
	//Image Resize function
	function makeThumbnails($updir, $img, $id, $dir, $sz1, $sz2)
    {
		$thumbnail_width = $sz1;
		$thumbnail_height = $sz2;
		$thumb_beforeword = "";
		$arr_image_details = getimagesize("$updir" . $id . '' . "$img"); // pass id to thumb name
		$original_width = $arr_image_details[0];
		$original_height = $arr_image_details[1];
		if ($original_width > $original_height) {
			$new_width = $thumbnail_width;
			$new_height = intval($original_height * $new_width / $original_width);
		} else {
			$new_height = $thumbnail_height;
			$new_width = intval($original_width * $new_height / $original_height);
		}
		$dest_x = intval(($thumbnail_width - $new_width) / 2);
		$dest_y = intval(($thumbnail_height - $new_height) / 2);
		if ($arr_image_details[2] == IMAGETYPE_GIF) {
			$imgt = "ImageGIF";
			$imgcreatefrom = "ImageCreateFromGIF";
		}
		if ($arr_image_details[2] == IMAGETYPE_JPEG) {
			$imgt = "ImageJPEG";
			$imgcreatefrom = "ImageCreateFromJPEG";
		}
		if ($arr_image_details[2] == IMAGETYPE_PNG) {
			$imgt = "ImagePNG";
			$imgcreatefrom = "ImageCreateFromPNG";
		}
		if ($imgt) {
			$old_image = $imgcreatefrom("$updir" . $id . '' . "$img");
			$new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
			imagecopyresized($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
			$imgt($new_image, $dir . $id . '' . "$thumb_beforeword" . "$img");
			return 'done';
		}
		else
		{
			return 'error';
		}
	}
	
	//DB Connection
		$servername = "sql213.byethost.com";
		$username = "b4_21751845";
		$password = "veechiuvatesting";
		$database= "b4_21751845_online_restaurant";
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
			
			//Disabled Emulated prepare statements and use real prepare statements
			$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "Connected successfully";
			
			$statement = $conn->prepare("select * from website_basic_info order by id asc ");
			$statement->execute();
			$data_array = $statement->fetchAll();
	
			
		}
		catch(PDOException $e)
		{
			//echo "Connection failed: " . $e->getMessage();
		}
		
		

	//Website Initial Information
		$website_title=$data_array[0]['title'];
		$website_url=$data_array[0]['url'];
		$website_email=$data_array[0]['email'];
		$website_logo=$data_array[0]['website_logo'];
		$backend_image=$data_array[0]['backend_logo'];
		$telephone=$data_array[0]['telephone'];
		$contact_us_msg=$data_array[0]['contact_us_message'];
		$contact_us_address=$data_array[0]['contact_us_address'];
		$contact_us_phone=$data_array[0]['contact_us_phone'];
		$contact_us_email=$data_array[0]['contact_us_email'];
		$contact_us_lat=$data_array[0]['map_lat'];
		$contact_us_lng=$data_array[0]['map_lng'];
		$map_zoom=$data_array[0]['map_zoom'];
		
		
	//Developer Info
		$copyright_title=$data_array[0]['copyright_title'];
		$developer_logo=$data_array[0]['developer_logo'];
		$developer_title=$data_array[0]['developer_title'];
		$developer_link=$data_array[0]['developer_url'];
		
	
	//Linking with other sides
	$facebook_link=$data_array[0]['facebook_link'];
	$instagram_link=$data_array[0]['instagram_link'];
	$snapchat_link=$data_array[0]['snapchat_link'];
	$pinterest_link=$data_array[0]['pinterest_link'];
	$twitter_link=$data_array[0]['twitter_link'];
	$linkedin_link=$data_array[0]['linkedin_link'];
	
	
?>
<!-- Developer: -->
<!-- Mir Lutfur Rahman -->
<!-- 6th Batch, CSE, NEUB -->
<!-- Powered By: <?php echo $developer_title; ?>  -->  