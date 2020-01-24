<?php
	if(!isset($_SESSION['admin_email']) || !isset($_SESSION['admin_password']) || !isset($_SESSION['admin_id']) || $_SESSION['admin_password']=='' || $_SESSION['admin_email']=='' || $_SESSION['admin_id']=='')
	{
		header("Location: index.php");
	}		
?>

			<div id="slide_delete_notification" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
				<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Congratulation. Home slide deleted successfully.</p>
			</div>
			<script>
			
				function stop_slide_delete_notification()
				{
					document.getElementById('slide_delete_notification').style.display='none';
				}
			
			</script>
			
			<?php
				if(isset($_SESSION['slide_deleted_successful']))
				{
					echo "<script>document.getElementById('slide_delete_notification').style.display='block';setTimeout(stop_slide_delete_notification,1500);</script>";
					unset($_SESSION['slide_deleted_successful']);
				}

				if(isset($_REQUEST['confirmed_delete_slide']))
				{
					$slide_id=trim($_REQUEST['slide_id']);
					try
					{
						$stmt=$conn->prepare("select * from home_slides where slide_id=:slide_id ");
						$stmt->execute(array('slide_id'=>$slide_id));
						$list=$stmt->fetchAll();
						$image_name=$list[0]['image'];
						$base_directory = '../images/slides/';
						//Deleting old image
						unlink($base_directory.$image_name);
						$stmt=$conn->prepare("delete from home_slides where slide_id=:slide_id ");
						$stmt->execute(array('slide_id'=>$slide_id));
					}
					catch(PDOException $e)
					{
						echo "Error: ".$e->getMessage();
					}
					$_SESSION['slide_deleted_successful']='YES';
					header("Location: ow_index.php#home_slides");
					
				}
			?>

			<!-- Confirm Modal -->
			<div id="delete_slide_confirm" class="w3-modal">
				<div class="w3-modal-content w3-card-4 w3-animate-zoom">
					<header class="w3-container w3-flat-midnight-blue"> 
						<span onclick="document.getElementById('delete_slide_confirm').style.display='none'" class="w3-button w3-flat-midnight-blue w3-xlarge w3-bold w3-display-topright">&times;</span>
						<h2 class="w3-bold" style="font-family: 'Comic Sans MS', cursive, sans-serif;">Confirmation</h2>
					</header>

					<div id="Tokyo" class="w3-container city">
						<p class="w3-bold w3-large">Are you sure to delete the home slide?</p><br>
					</div>

					<div class="w3-container w3-light-grey w3-padding w3-right-align">
						<?php 
							if(isset($_REQUEST['delete_slide'])){
								$slide_id=trim($_REQUEST['slide_key']);
					
						?>
								<a href="ow_index.php?confirmed_delete_slide=YES&slide_id=<?php echo $slide_id; ?>" class="w3-button w3-green w3-border w3-round w3-margin-right">Yes</a>
						<?php } ?>
						<button class="w3-button w3-round w3-red w3-border" onclick="document.getElementById('delete_slide_confirm').style.display='none'">No</button>
					</div>
				</div>
			</div>
			<!-- Slides Delete -->
			<?php
				if(isset($_REQUEST['delete_slide']))
				{
					echo '<script>document.getElementById("delete_slide_confirm").style.display="block";</script>';
				}
			?>


			<!-- Home Slides Add modal -->
			<div id="add_home_slides" class="w3-modal" style="z-index:99999999;">
				<div class="w3-modal-content w3-card-4 w3-animate-zoom w3-padding" style="max-width:500px;font-family:Arial;">
					
					<div class="w3-container"><br>
						<span id="slide_close" onclick="document.getElementById('home_select_congrats').style.display='none';document.getElementById('home_select_msg').style.display='none';document.getElementById('selectedFile1').value='';document.getElementById('slide_caption').value='';document.getElementById('temp_slide_image').style.display='none';document.getElementById('add_slide_image').style.display='block';document.getElementById('slide_progress').style.display='none';document.getElementById('slide_upload_btn').style.display='block';document.getElementById('add_home_slides').style.display='none';document.getElementById('image_up1').style.display='none';document.getElementById('home_invalid_image_msg').style.display='none';document.getElementById('home_slide_image').src='../images/slides/default.png';" class="w3-button w3-large w3-transparent w3-display-topright" title="Close Modal"><i class="fa fa-close"></i></span>
						<h2 class="w3-xlarge w3-bold w3-left-align" style="font-family:Arial;">Add Slide</h2>
					</div>
					
					<div class="w3-cell-row">
					  <div class="w3-cell w3-center">
						<img id="home_slide_image" class="w3-round w3-topbar w3-bottombar w3-leftbar w3-rightbar" src="../images/slides/default.png" style="width:250px;height:140px;">
					  </div>
					</div>  
					
					<p id="home_invalid_image_msg" style="display:none;" class="w3-center w3-text-red w3-bold">Sorry Invalid Image Selected !!!</p>
					<p id="home_select_msg" style="display:none;" class="w3-center w3-text-red w3-bold">Please select an image !!!</p>
					<p id="home_select_congrats" style="display:none;" class="w3-center w3-text-green w3-bold">Congrats!! Slide added successfully</p>
					
					<form class="w3-margin-bottom">
						<div class="w3-cell-row w3-border w3-padding w3-margin-top">
							<div id="slide_upload_btn" class="w3-cell w3-border w3-small-padding w3-center w3-button w3-red" onclick="document.getElementById('selectedFile1').click();" style="opacity:0.9;">
								<input class="w3-input" id="selectedFile1" style="display: none;"  onclick="document.getElementById('image_up1').style.display='block';document.getElementById('home_select_congrats').style.display='none';" type="file"/>
								<i class="fa fa-image"></i> Select Image (1295x398) Pixels
							</div>
							<div id="slide_progress" class="w3-light-grey w3-round-xlarge w3-border w3-margin-top w3-margin-bottom" style="display:none;">
								<div class="w3-container w3-blue w3-round-xlarge w3-text-white w3-bold" id="slide_progress_id" style="width:0%;">0%</div>
							</div>
						</div>
						<p id="image_up1" class="w3-tiny w3-text-red w3-bold w3-margin-left" style="display:none;margin-top:0px;">* Upload image with ( 1295 x 398 ) pixels for best performance.</p>
						
						<input class="w3-input w3-border" type="text" placeholder="Enter Slide Caption"  maxlength="50"  id="slide_caption" style="margin:8px 0px 0px 0px;">
							
						<button class="w3-button w3-block w3-green w3-padding w3-margin-bottom" style="margin:8px 0px 0px 0px;" id="add_slide_image" onclick="add_new_slide_image()"><i class="fa fa-save"></i> Add New Slide</button>
						<button class="w3-button w3-block w3-green w3-padding w3-margin-bottom" style="margin:8px 0px 0px 0px;display:none;" id="temp_slide_image"><i class="fa fa-refresh w3-spin"></i> Please Wait ...</button>
					</form>
					
				</div>
			</div>
			<script>
				//Profile Pic Validity Checking
				var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png", ".heic"];    
				function file_validate(dataaa) {
					
					var sFileName = dataaa;
					if (sFileName.length > 0) {
						var blnValid = false;
						for (var j = 0; j < _validFileExtensions.length; j++) {
							var sCurExtension = _validFileExtensions[j];
							if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
								blnValid = true;
								break;
							}
						}
						if (!blnValid) {
							 return false;
						}
					}
					return true;
				}
				
				function update_all_slides_container()
				{
					location.reload();
				}
				
			
				function add_new_slide_image()
				{
					//Image info
					var caption=document.getElementById('slide_caption').value.trim();
					
					var image=document.getElementById('selectedFile1').files[0];
					var image2=document.getElementById('selectedFile1').value;
					
					var fd_image=new FormData();
					var link='selectedFile1';
					fd_image.append(link, image);
					
					if(image2=="")
					{
						document.getElementById('home_select_msg').style.display='block';
						
						document.getElementById('home_select_congrats').style.display='none';
					
					}
					else if(image2!="" && file_validate(image2)==false) //Image file extention not write
					{
						document.getElementById('home_select_congrats').style.display='none';
						
						document.getElementById('home_select_msg').style.display='none';
						document.getElementById('slide_upload_btn').style.display='block';
						document.getElementById('slide_progress').style.display='none';
						document.getElementById('add_slide_image').style.display='block';
						document.getElementById('temp_slide_image').style.display='none';
						
						document.getElementById('home_invalid_image_msg').style.display='block';
					
					}
					else
					{
						document.getElementById('home_select_congrats').style.display='none';
						
						document.getElementById('home_select_msg').style.display='none';
						document.getElementById('slide_close').style.display='none';
						document.getElementById('home_invalid_image_msg').style.display='none';
					
						document.getElementById('slide_upload_btn').style.display='none';
						document.getElementById('slide_progress').style.display='block';
						document.getElementById('add_slide_image').style.display='none';
						document.getElementById('temp_slide_image').style.display='block';
						
						
						//Ajax for image upload
						var xhttp1 = new XMLHttpRequest();
						xhttp1.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							//retrive image_name
							var image_name=this.responseText.trim();
							image_name=image_name[image_name.length-2]+image_name[image_name.length-1];
							
							if(image_name=="Ok")
							{
								var tmppath = URL.createObjectURL(image);
								$("#home_slide_image").fadeIn("fast").attr('src',tmppath);
								
								
								
								document.getElementById('home_select_congrats').style.display='block';
								
								document.getElementById('home_select_msg').style.display='none';
								document.getElementById('home_invalid_image_msg').style.display='none';
								
								document.getElementById('slide_close').style.display='block';
								
								document.getElementById('slide_upload_btn').style.display='block';
								document.getElementById('slide_progress').style.display='none';
								document.getElementById('add_slide_image').style.display='block';
								document.getElementById('temp_slide_image').style.display='none';
						
								//Update slide container table
								setTimeout(update_all_slides_container,500);
							}
							else
							{
								document.getElementById('home_select_msg').style.display='none';
								document.getElementById('slide_upload_btn').style.display='block';
								document.getElementById('slide_progress').style.display='none';
								document.getElementById('add_slide_image').style.display='block';
								
								document.getElementById('slide_close').style.display='block';
								
								document.getElementById('temp_slide_image').style.display='none';
								
								document.getElementById('home_invalid_image_msg').style.display='block';
					
							}
							
						}};
						xhttp1.upload.onprogress = function(e) {
							if (e.lengthComputable) {
							  var percentComplete = Math.round((e.loaded / e.total) * 100);
							  percentComplete=percentComplete.toFixed(2);
							  if(percentComplete==100)
							  {
								 document.getElementById('slide_progress_id').style.width=percentComplete+'%';
								 document.getElementById('slide_progress_id').innerHTML= percentComplete+'%';
							  }
							  else
							  {
								 document.getElementById('slide_progress_id').style.width=percentComplete+'%';
								 document.getElementById('slide_progress_id').innerHTML= percentComplete+'%';
							  }
							}
						};
						xhttp1.open("POST", "../include/add_new_slide.php?update_logo=yes&image="+link+"&caption="+caption, true);
						xhttp1.send(fd_image);
						
						
					}
				}
			
			
			</script>
			
			
			
			<!-- Home Slides table -->
			<div class="w3-container" style="margin-top:80px" id="home_slides">
				<h1 class="w3-jumbo w3-new-text-color" style="font-family: 'Comic Sans MS', cursive, sans-serif;"><b>Home Slides</b></h1>
				<hr style="width:50px;border:5px solid black;" class="w3-round">
				<p> This option is used for <font color="red">update home page slides</font> of <?php echo $website_title; ?>.</p>
				<div class="w3-container" style="padding:0px;margin:0px 0px 10px 0px;width:100%;max-width:700px;">
					<button class="w3-button w3-green w3-round w3-padding-small w3-right w3-small" onclick="document.getElementById('add_home_slides').style.display='block';"><i class="fa fa-file-picture-o"></i> Add Slide</button>
				</div>
				<div id="home_slides_container" class="w3-container w3-light-gray w3-leftbar w3-rightbar w3-bottombar w3-topbar" style="height:400px;overflow:auto;width:100%;max-width:700px;padding: 4px 6px;">
					<?php
						$sl=0;
						try
						{
							$stmt=$conn->prepare("select * from home_slides order by slide_id asc ");
							$stmt->execute();
							$list=$stmt->fetchAll();
							foreach($list as $row)
							{
								$sl++;
					?>
								<div class="w3-card-4 w3-hover-grayscale w3-display-container" style="display: inline-block;width:150px;white-space: normal;height:130px;padding:3px;margin:5px;">
									<img src="../images/slides/<?php echo $row['image'];?>" alt="<?php echo $row['caption'];?>" title="<?php echo $row['caption']; ?>" style="max-width:100%;height:100px;<?php if($row['status']=='active'){ echo 'border: 1px solid green;'; } else{ echo 'border: 1px solid red;'; }  ?>">
									<?php
										if($row['caption']!=""){
									?>
										<div class="w3-display-topright w3-tiny w3-container w3-black w3-border w3-border-white" style="padding:0px 2px 0px 2px;margin:4px;">
											<?php echo $row['caption']; ?>
										</div>
									<?php
										}
									?>
									<div class="w3-container w3-center w3-small">
										<i onclick="document.getElementById('slide_editor<?php echo $row['slide_id']; ?>').style.display='block';" class="fa fa-edit w3-bold w3-medium w3-text-green w3-hover-white" style="cursor:pointer;margin-right:7px;margin-top:5px;" Title="Edit Slide"> Edit</i>
										<a href="ow_index.php?delete_slide=YES&slide_key=<?php echo $row['slide_id']; ?>" ><i class="fa fa-close w3-bold w3-medium w3-text-red w3-hover-white" style="cursor:pointer;" Title="Delete Slide"> Delete</i></a>
									</div>
								</div>
					<?php
							}
						}
						catch(PDOException $e)
						{
							echo "Error: ".$e->getMessage();
						}
						if($sl==0)
							echo '<p style="color:red;padding-top:120px;text-align:center;">No slide added yet</p>';
					?>
				
				</div>
			</div>

			<!-- Creating edit modal for slide -->
			<?php
				try
				{
					$stmt=$conn->prepare("select * from home_slides order by slide_id asc ");
					$stmt->execute();
					$list=$stmt->fetchAll();
					foreach($list as $row)
					{
			?>
						<div id="slide_editor<?php echo $row['slide_id']; ?>" class="w3-modal" style="z-index:99999999;">
							<div class="w3-modal-content w3-card-4 w3-animate-zoom w3-padding" style="max-width:500px;font-family:Arial;">
								
								<div class="w3-container"><br>
									<span id="editor_slide_close<?php echo $row['slide_id']; ?>" onclick="document.getElementById('editor_image_up<?php echo $row['slide_id']; ?>').style.display='none';document.getElementById('editor_temp_slide_image<?php echo $row['slide_id']; ?>').style.display='none';document.getElementById('editor_add_slide_image<?php echo $row['slide_id']; ?>').style.display='block';document.getElementById('editor_slide_upload_btn<?php echo $row['slide_id']; ?>').style.display='block';document.getElementById('editor_slide_progress<?php echo $row['slide_id']; ?>').style.display='none';document.getElementById('editor_home_invalid_image_msg<?php echo $row['slide_id']; ?>').style.display='none';document.getElementById('editor_home_select_msg<?php echo $row['slide_id']; ?>').style.display='none';document.getElementById('editor_home_select_congrats<?php echo $row['slide_id']; ?>').style.display='none';document.getElementById('slide_editor<?php echo $row['slide_id']; ?>').style.display='none';" class="w3-button w3-large w3-transparent w3-display-topright" title="Close Modal"><i class="fa fa-close"></i></span>
									<h2 class="w3-xlarge w3-bold w3-left-align" style="font-family:Arial;">Edit Slide</h2>
								</div>
								
								<div class="w3-cell-row">
								  <div class="w3-cell w3-center">
									<img id="editor_home_slide_image<?php echo $row['slide_id']; ?>" class="w3-round w3-topbar w3-bottombar w3-leftbar w3-rightbar" src="../images/slides/<?php echo $row['image']; ?>" style="width:250px;height:140px;">
								  </div>
								</div>  
								
								<p id="editor_home_invalid_image_msg<?php echo $row['slide_id']; ?>" style="display:none;" class="w3-center w3-text-red w3-bold">Sorry Invalid Image Selected !!!</p>
								<p id="editor_home_select_msg<?php echo $row['slide_id']; ?>" style="display:none;" class="w3-center w3-text-red w3-bold">Please select an image !!!</p>
								<p id="editor_home_select_congrats<?php echo $row['slide_id']; ?>" style="display:none;" class="w3-center w3-text-green w3-bold">Congrats!! Slide updated successfully</p>
								
								<form class="w3-margin-bottom">
									<div class="w3-cell-row w3-border w3-padding w3-margin-top">
										<div id="editor_slide_upload_btn<?php echo $row['slide_id']; ?>" class="w3-cell w3-border w3-small-padding w3-center w3-button w3-red" onclick="document.getElementById('editor_selectedFile<?php echo $row['slide_id']; ?>').click();" style="opacity:0.9;">
											<input class="w3-input" id="editor_selectedFile<?php echo $row['slide_id']; ?>" style="display: none;"  onclick="document.getElementById('editor_image_up<?php echo $row['slide_id']; ?>').style.display='block';document.getElementById('editor_home_select_congrats<?php echo $row['slide_id']; ?>').style.display='none';" type="file"/>
											<i class="fa fa-image"></i> Select Image (1295x398) Pixels
										</div>
										<div id="editor_slide_progress<?php echo $row['slide_id']; ?>" class="w3-light-grey w3-round-xlarge w3-border w3-margin-top w3-margin-bottom" style="display:none;">
											<div class="w3-container w3-blue w3-round-xlarge w3-text-white w3-bold" id="editor_slide_progress_id<?php echo $row['slide_id']; ?>" style="width:0%;">0%</div>
										</div>
									</div>
									<p id="editor_image_up<?php echo $row['slide_id']; ?>" class="w3-tiny w3-text-red w3-bold w3-margin-left" style="display:none;margin-top:0px;">* Upload image for change with ( 1295 x 398 ) pixels for best performance.</p>
									
									<input class="w3-input w3-border" type="text" placeholder="Enter Slide Caption"  maxlength="50"  id="editor_slide_caption<?php echo $row['slide_id']; ?>" value="<?php echo $row['caption']; ?>" style="margin:8px 0px 0px 0px;">
									
									<div class="w3-row" style="margin:8px 0px 0px 0px;padding:0px;">
										<div class="w3-col" style="width:40%;">
											<input id="editor_status_value<?php echo $row['slide_id']; ?>" class="w3-input w3-border w3-center <?php $status=$row['status']; if($status=='active'){ echo 'w3-green'; } else { echo 'w3-red'; }  ?>" type="text" value="<?php $status=$row['status']; if($status=='active'){ echo 'Active'; } else{ echo 'Inactive'; } ?>" disabled>
										</div>
										<div class="w3-col" style="margin-left:2%;width:58%;">
											<select id='editor_status<?php echo $row['slide_id']; ?>' class="w3-input w3-border">
												<?php 
													$status=$row['status'];
													echo '<option value="'.$status.'">Change ...</option>'; 
													if($status=='active')
													{
														echo '<option value="inactive">Inactive</option>';
													}
													else
													{
														echo '<option value="active">Active</option>';
													}
													
												?>
											</select>
										</div>
									</div>
									
									<button class="w3-button w3-block w3-green w3-padding w3-margin-bottom" style="margin:8px 0px 0px 0px;" id="editor_add_slide_image<?php echo $row['slide_id']; ?>" onclick="update_slide_image(<?php echo $row['slide_id']; ?>)"><i class="fa fa-save"></i> Update Slide</button>
									<button class="w3-button w3-block w3-green w3-padding w3-margin-bottom" style="margin:8px 0px 0px 0px;display:none;" id="editor_temp_slide_image<?php echo $row['slide_id']; ?>"><i class="fa fa-refresh w3-spin"></i> Please Wait ...</button>
								</form>
								
							</div>
						</div>
			<?php
					}
				}
				catch(PDOException $e)
				{
					echo "Error: ".$e->getMessage();
				}
			?>

			<script>
				function update_slide_image(id)
				{
					//Image info
					var caption=document.getElementById('editor_slide_caption'+id).value.trim();
					var status=document.getElementById('editor_status'+id).value.trim();
					
					var image=document.getElementById('editor_selectedFile'+id).files[0];
					var image2=document.getElementById('editor_selectedFile'+id).value;
					
					var fd_image=new FormData();
					var link='editor_selectedFile'+id;
					fd_image.append(link, image);
					
					if(image2!="" && file_validate(image2)==false) //Image file extention not write
					{
						document.getElementById('editor_home_select_congrats'+id).style.display='none';
						
						document.getElementById('editor_home_select_msg'+id).style.display='none';
						document.getElementById('editor_slide_upload_btn'+id).style.display='block';
						document.getElementById('editor_slide_progress'+id).style.display='none';
						document.getElementById('editor_add_slide_image'+id).style.display='block';
						document.getElementById('editor_temp_slide_image'+id).style.display='none';
						
						document.getElementById('editor_home_invalid_image_msg'+id).style.display='block';
					
					}
					else
					{
						document.getElementById('editor_home_select_congrats'+id).style.display='none';
						
						document.getElementById('editor_home_select_msg'+id).style.display='none';
						document.getElementById('editor_slide_close'+id).style.display='none';
						document.getElementById('editor_home_invalid_image_msg'+id).style.display='none';
					
						document.getElementById('editor_slide_upload_btn'+id).style.display='none';
						document.getElementById('editor_slide_progress'+id).style.display='block';
						document.getElementById('editor_add_slide_image'+id).style.display='none';
						document.getElementById('editor_temp_slide_image'+id).style.display='block';
						
						//Ajax for image upload
						var xhttp1 = new XMLHttpRequest();
						xhttp1.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							//retrive image_name
							var image_name=this.responseText.trim();
							image_name=image_name[image_name.length-2]+image_name[image_name.length-1];
							
							if(image_name=="Ok")
							{
								if(state=="YES"){
									var tmppath = URL.createObjectURL(image);
									$("#editor_home_slide_image"+id).fadeIn("fast").attr('src',tmppath);
								}
								
								
								if(status=='active')
								{
									document.getElementById('editor_status_value'+id).classList.remove("w3-red");
									document.getElementById('editor_status_value'+id).classList.add("w3-green");
									document.getElementById('editor_status_value'+id).value='Active';
								}
								else
								{
									document.getElementById('editor_status_value'+id).classList.remove("w3-green");
									document.getElementById('editor_status_value'+id).classList.add("w3-red");
									document.getElementById('editor_status_value'+id).value='Inctive';
								}
								
								
								document.getElementById('editor_home_select_congrats'+id).style.display='block';
								
								document.getElementById('editor_home_select_msg'+id).style.display='none';
								document.getElementById('editor_home_invalid_image_msg'+id).style.display='none';
								
								document.getElementById('editor_slide_close'+id).style.display='block';
								
								document.getElementById('editor_slide_upload_btn'+id).style.display='block';
								document.getElementById('editor_slide_progress'+id).style.display='none';
								document.getElementById('editor_add_slide_image'+id).style.display='block';
								document.getElementById('editor_temp_slide_image'+id).style.display='none';
								
								
								//Update slide container table
								setTimeout(update_all_slides_container,500);
							}
							else
							{
								document.getElementById('editor_home_select_msg'+id).style.display='none';
								document.getElementById('editor_slide_upload_btn'+id).style.display='block';
								document.getElementById('editor_slide_progress'+id).style.display='none';
								document.getElementById('editor_add_slide_image'+id).style.display='block';
								
								document.getElementById('editor_slide_close'+id).style.display='block';
								
								document.getElementById('editor_temp_slide_image'+id).style.display='none';
								
								document.getElementById('editor_home_invalid_image_msg'+id).style.display='block';
					
							}
							
						}};
						
						xhttp1.upload.onprogress = function(e) {
							if (e.lengthComputable) {
							  var percentComplete = Math.round((e.loaded / e.total) * 100);
							  percentComplete=percentComplete.toFixed(2);
							  if(percentComplete==100)
							  {
								 document.getElementById('editor_slide_progress_id'+id).style.width=percentComplete+'%';
								 document.getElementById('editor_slide_progress_id'+id).innerHTML= percentComplete+'%';
							  }
							  else
							  {
								 document.getElementById('editor_slide_progress_id'+id).style.width=percentComplete+'%';
								 document.getElementById('editor_slide_progress_id'+id).innerHTML= percentComplete+'%';
							  }
							}
						};
						//Testing purpose
						var state="YES";
						if(image2=="")
						{
							state="NO";
						}
						
						
						xhttp1.open("POST", "../include/edit_home_slide.php?update_logo=yes&image="+link+"&caption="+caption+"&slide_id="+id+"&state="+state+"&status="+status, true);
						xhttp1.send(fd_image);
						
						
					}
					
				}
			</script>