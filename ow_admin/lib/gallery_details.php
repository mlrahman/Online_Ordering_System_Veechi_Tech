<?php
	if(!isset($_SESSION['admin_email']) || !isset($_SESSION['admin_password']) || !isset($_SESSION['admin_id']) || $_SESSION['admin_password']=='' || $_SESSION['admin_email']=='' || $_SESSION['admin_id']=='')
	{
		header("Location: index.php");
	}
?>
			<div id="gallery_image_delete_notification" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
				<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Congratulation. Gallery image deleted successfully.</p>
			</div>
			<script>
			
				function stop_gallery_image_delete_notification()
				{
					document.getElementById('gallery_image_delete_notification').style.display='none';
				}
			
			</script>
			
			<?php
				if(isset($_SESSION['gallery_image_deleted_successful']))
				{
					echo "<script>document.getElementById('gallery_image_delete_notification').style.display='block';setTimeout(stop_gallery_image_delete_notification,1500);</script>";
					unset($_SESSION['gallery_image_deleted_successful']);
				}

				if(isset($_REQUEST['confirmed_delete_gallery_image']))
				{
					$gallery_image_id=trim($_REQUEST['gallery_image_id']);
					try
					{
						$stmt=$conn->prepare("select * from gallery where image_id=:gallery_image_id ");
						$stmt->execute(array('gallery_image_id'=>$gallery_image_id));
						$list=$stmt->fetchAll();
						$image_name=$list[0]['image'];
						$base_directory = '../images/gallery/';
						//Deleting old image
						unlink($base_directory.$image_name);
						$stmt=$conn->prepare("delete from gallery where image_id=:gallery_image_id ");
						$stmt->execute(array('gallery_image_id'=>$gallery_image_id));
					}
					catch(PDOException $e)
					{
						echo "Error: ".$e->getMessage();
					}
					$_SESSION['gallery_image_deleted_successful']='YES';
					header("Location: ow_index.php#gallery");
					
				}
			?>
			
			<!-- Confirm Modal -->
			<div id="delete_gallery_image_confirm" class="w3-modal">
				<div class="w3-modal-content w3-card-4 w3-animate-zoom">
					<header class="w3-container w3-flat-midnight-blue"> 
						<span onclick="document.getElementById('delete_gallery_image_confirm').style.display='none'" class="w3-button w3-flat-midnight-blue w3-xlarge w3-bold w3-display-topright">&times;</span>
						<h2 class="w3-bold" style="font-family: 'Comic Sans MS', cursive, sans-serif;">Confirmation</h2>
					</header>

					<div id="Tokyo" class="w3-container city">
						<p class="w3-bold w3-large">Are you sure to delete the gallery image?</p><br>
					</div>

					<div class="w3-container w3-light-grey w3-padding w3-right-align">
						<?php 
							if(isset($_REQUEST['delete_gallery_image'])){
								$gallery_image_id=trim($_REQUEST['gallery_image_key']);
					
						?>
								<a href="ow_index.php?confirmed_delete_gallery_image=YES&gallery_image_id=<?php echo $gallery_image_id; ?>" class="w3-button w3-green w3-border w3-round w3-margin-right">Yes</a>
						<?php } ?>
						<button class="w3-button w3-round w3-red w3-border" onclick="document.getElementById('delete_gallery_image_confirm').style.display='none'">No</button>
					</div>
				</div>
			</div>
			
			<!-- gallery_image Delete -->
			<?php
				if(isset($_REQUEST['delete_gallery_image']))
				{
					echo '<script>document.getElementById("delete_gallery_image_confirm").style.display="block";</script>';
				}
			?>
			
			
			<!-- Home gallery_images Add modal -->
			<div id="add_gallery_images" class="w3-modal" style="z-index:99999999;">
				<div class="w3-modal-content w3-card-4 w3-animate-zoom w3-padding" style="max-width:500px;font-family:Arial;">
					
					<div class="w3-container"><br>
						<span id="gallery_image_close" onclick="document.getElementById('gallery_image_select_congrats').style.display='none';document.getElementById('gallery_image_select_msg').style.display='none';document.getElementById('gallery_image_selectedFile').value='';document.getElementById('gallery_image_caption').value='';document.getElementById('temp_gallery_image').style.display='none';document.getElementById('add_gallery_image').style.display='block';document.getElementById('gallery_image_progress').style.display='none';document.getElementById('gallery_image_upload_btn').style.display='block';document.getElementById('add_gallery_images').style.display='none';document.getElementById('gallery_image_image_up').style.display='none';document.getElementById('gallery_image_invalid_image_msg').style.display='none';document.getElementById('gallery_image').src='../images/gallery/default.png';" class="w3-button w3-large w3-transparent w3-display-topright" title="Close Modal"><i class="fa fa-close"></i></span>
						<h2 class="w3-xlarge w3-bold w3-left-align" style="font-family:Arial;">Add Image</h2>
					</div>
					
					<div class="w3-cell-row">
					  <div class="w3-cell w3-center">
						<img id="gallery_image" class="w3-round w3-topbar w3-bottombar w3-leftbar w3-rightbar" src="../images/gallery/default.png" style="width:250px;height:140px;">
					  </div>
					</div>  
					
					<p id="gallery_image_invalid_image_msg" style="display:none;" class="w3-center w3-text-red w3-bold">Sorry Invalid Image Selected !!!</p>
					<p id="gallery_image_select_msg" style="display:none;" class="w3-center w3-text-red w3-bold">Please select an image !!!</p>
					<p id="gallery_image_select_congrats" style="display:none;" class="w3-center w3-text-green w3-bold">Congrats!! Image added successfully</p>
					
					<form class="w3-margin-bottom">
						<div class="w3-cell-row w3-border w3-padding w3-margin-top">
							<div id="gallery_image_upload_btn" class="w3-cell w3-border w3-small-padding w3-center w3-button w3-red" onclick="document.getElementById('gallery_image_selectedFile').click();" style="opacity:0.9;">
								<input class="w3-input" id="gallery_image_selectedFile" style="display: none;"  onclick="document.getElementById('gallery_image_image_up').style.display='block';document.getElementById('gallery_image_select_congrats').style.display='none';" type="file"/>
								<i class="fa fa-image"></i> Select Image (1295x398) Pixels
							</div>
							<div id="gallery_image_progress" class="w3-light-grey w3-round-xlarge w3-border w3-margin-top w3-margin-bottom" style="display:none;">
								<div class="w3-container w3-blue w3-round-xlarge w3-text-white w3-bold" id="gallery_image_progress_id" style="width:0%;">0%</div>
							</div>
						</div>
						<p id="gallery_image_image_up" class="w3-tiny w3-text-red w3-bold w3-margin-left" style="display:none;margin-top:0px;">* Upload image with ( 1295 x 398 ) pixels for best performance.</p>
						
						<input class="w3-input w3-border" type="text" placeholder="Enter Image Caption"  maxlength="50"  id="gallery_image_caption" style="margin:8px 0px 0px 0px;">
							
						<button class="w3-button w3-block w3-green w3-padding w3-margin-bottom" style="margin:8px 0px 0px 0px;" id="add_gallery_image" onclick="add_new_gallery_image()"><i class="fa fa-save"></i> Add New Image</button>
						<button class="w3-button w3-block w3-green w3-padding w3-margin-bottom" style="margin:8px 0px 0px 0px;display:none;" id="temp_gallery_image"><i class="fa fa-refresh w3-spin"></i> Please Wait ...</button>
					</form>
					
				</div>
			</div>
			
			<script>
			
			function update_all_gallery_image_container()
				{
					location.reload();
				}
			
			function add_new_gallery_image()
				{
					//Image info
					var caption=document.getElementById('gallery_image_caption').value.trim();
					
					var image=document.getElementById('gallery_image_selectedFile').files[0];
					var image2=document.getElementById('gallery_image_selectedFile').value;
					
					var fd_image=new FormData();
					var link='gallery_image_selectedFile';
					fd_image.append(link, image);
					
					if(image2=="")
					{
						document.getElementById('gallery_image_select_msg').style.display='block';
						
						document.getElementById('gallery_image_select_congrats').style.display='none';
					
					}
					else if(image2!="" && file_validate(image2)==false) //Image file extention not write
					{
						document.getElementById('gallery_image_select_congrats').style.display='none';
						
						document.getElementById('gallery_image_select_msg').style.display='none';
						document.getElementById('gallery_image_upload_btn').style.display='block';
						document.getElementById('gallery_image_progress').style.display='none';
						document.getElementById('add_gallery_image').style.display='block';
						document.getElementById('temp_gallery_image').style.display='none';
						
						document.getElementById('gallery_image_invalid_image_msg').style.display='block';
					
					}
					else
					{
						document.getElementById('gallery_image_select_congrats').style.display='none';
						
						document.getElementById('gallery_image_select_msg').style.display='none';
						document.getElementById('gallery_image_close').style.display='none';
						document.getElementById('gallery_image_invalid_image_msg').style.display='none';
					
						document.getElementById('gallery_image_upload_btn').style.display='none';
						document.getElementById('gallery_image_progress').style.display='block';
						document.getElementById('add_gallery_image').style.display='none';
						document.getElementById('temp_gallery_image').style.display='block';
						
						
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
								$("#gallery_image").fadeIn("fast").attr('src',tmppath);
								
								
								
								document.getElementById('gallery_image_select_congrats').style.display='block';
								
								document.getElementById('gallery_image_select_msg').style.display='none';
								document.getElementById('gallery_image_invalid_image_msg').style.display='none';
								
								document.getElementById('gallery_image_close').style.display='block';
								
								document.getElementById('gallery_image_upload_btn').style.display='block';
								document.getElementById('gallery_image_progress').style.display='none';
								document.getElementById('add_gallery_image').style.display='block';
								document.getElementById('temp_gallery_image').style.display='none';
						
								//Update gallery_image container table
								setTimeout(update_all_gallery_image_container,500);
							}
							else
							{
								document.getElementById('gallery_image_select_msg').style.display='none';
								document.getElementById('gallery_image_upload_btn').style.display='block';
								document.getElementById('gallery_image_progress').style.display='none';
								document.getElementById('add_gallery_image').style.display='block';
								
								document.getElementById('gallery_image_close').style.display='block';
								
								document.getElementById('temp_gallery_image').style.display='none';
								
								document.getElementById('gallery_image_invalid_image_msg').style.display='block';
					
							}
							
						}};
						xhttp1.upload.onprogress = function(e) {
							if (e.lengthComputable) {
							  var percentComplete = Math.round((e.loaded / e.total) * 100);
							  percentComplete=percentComplete.toFixed(2);
							  if(percentComplete==100)
							  {
								 document.getElementById('gallery_image_progress_id').style.width=percentComplete+'%';
								 document.getElementById('gallery_image_progress_id').innerHTML= percentComplete+'%';
							  }
							  else
							  {
								 document.getElementById('gallery_image_progress_id').style.width=percentComplete+'%';
								 document.getElementById('gallery_image_progress_id').innerHTML= percentComplete+'%';
							  }
							}
						};
						xhttp1.open("POST", "../include/add_new_gallery_image.php?update_logo=yes&image="+link+"&caption="+caption, true);
						xhttp1.send(fd_image);
						
						
					}
				}
			
			
			</script>
			
			

			<!-- Gallery Image Container -->
			<div class="w3-container" style="margin-top:80px" id="gallery">
				<h1 class="w3-jumbo w3-new-text-color" style="font-family: 'Comic Sans MS', cursive, sans-serif;"><b>Gallery</b></h1>
				<hr style="width:50px;border:5px solid black;" class="w3-round">
				<p> This option is used for <font color="red">update gallery images</font> of <?php echo $website_title; ?>.</p>
				<div class="w3-container" style="padding:0px;margin:0px 0px 10px 0px;width:100%;max-width:700px;">
					<button class="w3-button w3-green w3-round w3-padding-small w3-right w3-small" onclick="document.getElementById('add_gallery_images').style.display='block';"><i class="fa fa-file-picture-o"></i> Add Image</button>
				</div>
				<div class="w3-container w3-light-gray w3-leftbar w3-rightbar w3-bottombar w3-topbar" style="height:400px;overflow:auto;width:100%;max-width:700px;padding: 4px 6px;">
					<?php
						$sl=0;
						try
						{
							$stmt=$conn->prepare("select * from gallery order by image_id asc ");
							$stmt->execute();
							$list=$stmt->fetchAll();
							foreach($list as $row)
							{
								$sl++;
					?>
								<div class="w3-card-4 w3-hover-grayscale w3-display-container" style="display: inline-block;width:150px;white-space: normal;height:130px;padding:3px;margin:5px;">
									<img src="../images/gallery/<?php echo $row['image'];?>" alt="<?php echo $row['caption'];?>" title="<?php echo $row['caption']; ?>" style="max-width:100%;height:100px;<?php if($row['status']=='active'){ echo 'border: 1px solid green;'; } else{ echo 'border: 1px solid red;'; }  ?>">
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
										<i onclick="document.getElementById('gallery_image_editor<?php echo $row['image_id']; ?>').style.display='block';" class="fa fa-edit w3-bold w3-medium w3-text-green w3-hover-white" style="cursor:pointer;margin-right:7px;margin-top:5px;" Title="Edit Image"> Edit</i>
										<a href="ow_index.php?delete_gallery_image=YES&gallery_image_key=<?php echo $row['image_id']; ?>" ><i class="fa fa-close w3-bold w3-medium w3-text-red w3-hover-white" style="cursor:pointer;" Title="Delete Image"> Delete</i></a>
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
							echo '<p style="color:red;padding-top:120px;text-align:center;">No image added yet</p>';
					?>
				
				</div>
			</div>
			
			
			<!-- Creating edit modal for slide -->
			<?php
				try
				{
					$stmt=$conn->prepare("select * from gallery order by image_id asc ");
					$stmt->execute();
					$list=$stmt->fetchAll();
					foreach($list as $row)
					{
			?>
						<div id="gallery_image_editor<?php echo $row['image_id']; ?>" class="w3-modal" style="z-index:99999999;">
							<div class="w3-modal-content w3-card-4 w3-animate-zoom w3-padding" style="max-width:500px;font-family:Arial;">
								
								<div class="w3-container"><br>
									<span id="editor_gallery_image_close<?php echo $row['image_id']; ?>" onclick="document.getElementById('editor_gallery_image_up<?php echo $row['image_id']; ?>').style.display='none';document.getElementById('editor_temp_gallery_image<?php echo $row['image_id']; ?>').style.display='none';document.getElementById('editor_add_gallery_image<?php echo $row['image_id']; ?>').style.display='block';document.getElementById('editor_gallery_image_upload_btn<?php echo $row['image_id']; ?>').style.display='block';document.getElementById('editor_gallery_image_progress<?php echo $row['image_id']; ?>').style.display='none';document.getElementById('editor_home_invalid_gallery_image_msg<?php echo $row['image_id']; ?>').style.display='none';document.getElementById('editor_gallery_image_select_msg<?php echo $row['image_id']; ?>').style.display='none';document.getElementById('editor_gallery_image_select_congrats<?php echo $row['image_id']; ?>').style.display='none';document.getElementById('gallery_image_editor<?php echo $row['image_id']; ?>').style.display='none';" class="w3-button w3-large w3-transparent w3-display-topright" title="Close Modal"><i class="fa fa-close"></i></span>
									<h2 class="w3-xlarge w3-bold w3-left-align" style="font-family:Arial;">Edit Image</h2>
								</div>
								
								<div class="w3-cell-row">
								  <div class="w3-cell w3-center">
									<img id="editor_home_gallery_image<?php echo $row['image_id']; ?>" class="w3-round w3-topbar w3-bottombar w3-leftbar w3-rightbar" src="../images/gallery/<?php echo $row['image']; ?>" style="width:250px;height:140px;">
								  </div>
								</div>  
								
								<p id="editor_home_invalid_gallery_image_msg<?php echo $row['image_id']; ?>" style="display:none;" class="w3-center w3-text-red w3-bold">Sorry Invalid Image Selected !!!</p>
								<p id="editor_gallery_image_select_msg<?php echo $row['image_id']; ?>" style="display:none;" class="w3-center w3-text-red w3-bold">Please select an image !!!</p>
								<p id="editor_gallery_image_select_congrats<?php echo $row['image_id']; ?>" style="display:none;" class="w3-center w3-text-green w3-bold">Congrats!! Gallery image updated successfully</p>
								
								<form class="w3-margin-bottom">
									<div class="w3-cell-row w3-border w3-padding w3-margin-top">
										<div id="editor_gallery_image_upload_btn<?php echo $row['image_id']; ?>" class="w3-cell w3-border w3-small-padding w3-center w3-button w3-red" onclick="document.getElementById('editor_gallery_image_selectedFile<?php echo $row['image_id']; ?>').click();" style="opacity:0.9;">
											<input class="w3-input" id="editor_gallery_image_selectedFile<?php echo $row['image_id']; ?>" style="display: none;"  onclick="document.getElementById('editor_gallery_image_up<?php echo $row['image_id']; ?>').style.display='block';document.getElementById('editor_gallery_image_select_congrats<?php echo $row['image_id']; ?>').style.display='none';" type="file"/>
											<i class="fa fa-image"></i> Select Image (1295x398) Pixels
										</div>
										<div id="editor_gallery_image_progress<?php echo $row['image_id']; ?>" class="w3-light-grey w3-round-xlarge w3-border w3-margin-top w3-margin-bottom" style="display:none;">
											<div class="w3-container w3-blue w3-round-xlarge w3-text-white w3-bold" id="editor_gallery_image_progress_id<?php echo $row['image_id']; ?>" style="width:0%;">0%</div>
										</div>
									</div>
									<p id="editor_gallery_image_up<?php echo $row['image_id']; ?>" class="w3-tiny w3-text-red w3-bold w3-margin-left" style="display:none;margin-top:0px;">* Upload image for change with ( 1295 x 398 ) pixels for best performance.</p>
									
									<input class="w3-input w3-border" type="text" placeholder="Enter Image Caption"  maxlength="50"  id="editor_gallery_image_caption<?php echo $row['image_id']; ?>" value="<?php echo $row['caption']; ?>" style="margin:8px 0px 0px 0px;">
									
									<div class="w3-row" style="margin:8px 0px 0px 0px;padding:0px;">
										<div class="w3-col" style="width:40%;">
											<input id="editor_gallery_image_status_value<?php echo $row['image_id']; ?>" class="w3-input w3-border w3-center <?php $status=$row['status']; if($status=='active'){ echo 'w3-green'; } else { echo 'w3-red'; }  ?>" type="text" value="<?php $status=$row['status']; if($status=='active'){ echo 'Active'; } else{ echo 'Inactive'; } ?>" disabled>
										</div>
										<div class="w3-col" style="margin-left:2%;width:58%;">
											<select id='editor_gallery_image_status<?php echo $row['image_id']; ?>' class="w3-input w3-border">
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
									
									<button class="w3-button w3-block w3-green w3-padding w3-margin-bottom" style="margin:8px 0px 0px 0px;" id="editor_add_gallery_image<?php echo $row['image_id']; ?>" onclick="update_gallery_image(<?php echo $row['image_id']; ?>)"><i class="fa fa-save"></i> Update Image</button>
									<button class="w3-button w3-block w3-green w3-padding w3-margin-bottom" style="margin:8px 0px 0px 0px;display:none;" id="editor_temp_gallery_image<?php echo $row['image_id']; ?>"><i class="fa fa-refresh w3-spin"></i> Please Wait ...</button>
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
				function update_gallery_image(id)
				{
					//Image info
					var caption=document.getElementById('editor_gallery_image_caption'+id).value.trim();
					var status=document.getElementById('editor_gallery_image_status'+id).value.trim();
					
					var image=document.getElementById('editor_gallery_image_selectedFile'+id).files[0];
					var image2=document.getElementById('editor_gallery_image_selectedFile'+id).value;
					
					var fd_image=new FormData();
					var link='editor_gallery_image_selectedFile'+id;
					fd_image.append(link, image);
					
					if(image2!="" && file_validate(image2)==false) //Image file extention not write
					{
						document.getElementById('editor_gallery_image_select_congrats'+id).style.display='none';
						
						document.getElementById('editor_gallery_image_select_msg'+id).style.display='none';
						document.getElementById('editor_gallery_image_upload_btn'+id).style.display='block';
						document.getElementById('editor_gallery_image_progress'+id).style.display='none';
						document.getElementById('editor_add_gallery_image'+id).style.display='block';
						document.getElementById('editor_temp_gallery_image'+id).style.display='none';
						
						document.getElementById('editor_home_invalid_gallery_image_msg'+id).style.display='block';
					
					}
					else
					{
						document.getElementById('editor_gallery_image_select_congrats'+id).style.display='none';
						
						document.getElementById('editor_gallery_image_select_msg'+id).style.display='none';
						document.getElementById('editor_gallery_image_close'+id).style.display='none';
						document.getElementById('editor_home_invalid_gallery_image_msg'+id).style.display='none';
					
						document.getElementById('editor_gallery_image_upload_btn'+id).style.display='none';
						document.getElementById('editor_gallery_image_progress'+id).style.display='block';
						document.getElementById('editor_add_gallery_image'+id).style.display='none';
						document.getElementById('editor_temp_gallery_image'+id).style.display='block';
						
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
									$("#editor_home_gallery_image"+id).fadeIn("fast").attr('src',tmppath);
								}
								
								
								if(status=='active')
								{
									document.getElementById('editor_gallery_image_status_value'+id).classList.remove("w3-red");
									document.getElementById('editor_gallery_image_status_value'+id).classList.add("w3-green");
									document.getElementById('editor_gallery_image_status_value'+id).value='Active';
								}
								else
								{
									document.getElementById('editor_gallery_image_status_value'+id).classList.remove("w3-green");
									document.getElementById('editor_gallery_image_status_value'+id).classList.add("w3-red");
									document.getElementById('editor_gallery_image_status_value'+id).value='Inctive';
								}
								
								
								document.getElementById('editor_gallery_image_select_congrats'+id).style.display='block';
								
								document.getElementById('editor_gallery_image_select_msg'+id).style.display='none';
								document.getElementById('editor_home_invalid_gallery_image_msg'+id).style.display='none';
								
								document.getElementById('editor_gallery_image_close'+id).style.display='block';
								
								document.getElementById('editor_gallery_image_upload_btn'+id).style.display='block';
								document.getElementById('editor_gallery_image_progress'+id).style.display='none';
								document.getElementById('editor_add_gallery_image'+id).style.display='block';
								document.getElementById('editor_temp_gallery_image'+id).style.display='none';
								
								
								//Update slide container table
								setTimeout(update_all_gallery_image_container,500);
							}
							else
							{
								document.getElementById('editor_gallery_image_select_msg'+id).style.display='none';
								document.getElementById('editor_gallery_image_upload_btn'+id).style.display='block';
								document.getElementById('editor_gallery_image_progress'+id).style.display='none';
								document.getElementById('editor_add_gallery_image'+id).style.display='block';
								
								document.getElementById('editor_gallery_image_close'+id).style.display='block';
								
								document.getElementById('editor_temp_gallery_image'+id).style.display='none';
								
								document.getElementById('editor_home_invalid_gallery_image_msg'+id).style.display='block';
					
							}
							
						}};
						
						xhttp1.upload.onprogress = function(e) {
							if (e.lengthComputable) {
							  var percentComplete = Math.round((e.loaded / e.total) * 100);
							  percentComplete=percentComplete.toFixed(2);
							  if(percentComplete==100)
							  {
								 document.getElementById('editor_gallery_image_progress_id'+id).style.width=percentComplete+'%';
								 document.getElementById('editor_gallery_image_progress_id'+id).innerHTML= percentComplete+'%';
							  }
							  else
							  {
								 document.getElementById('editor_gallery_image_progress_id'+id).style.width=percentComplete+'%';
								 document.getElementById('editor_gallery_image_progress_id'+id).innerHTML= percentComplete+'%';
							  }
							}
						};
						//Testing purpose
						var state="YES";
						if(image2=="")
						{
							state="NO";
						}
						
						
						xhttp1.open("POST", "../include/edit_gallery_image.php?update_logo=yes&image="+link+"&caption="+caption+"&image_id="+id+"&state="+state+"&status="+status, true);
						xhttp1.send(fd_image);
						
						
					}
					
				}
			</script>
			
			