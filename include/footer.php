			<!-- Footer -->
			<footer class="w3-center w3-black w3-padding-16">
			  <!-- Social link -->
			  <div class="w3-xlarge w3-section">
				<?php
					if($facebook_link!="")
					{
						echo '<a style="margin: 0px 4px;" href="'.$facebook_link.'" target="_blank" title="Follow us on Facebbok" ><i class="fa fa-facebook-official w3-hover-opacity"></i></a>';
					}
					if($instagram_link!="")
					{
						echo '<a style="margin: 0px 4px;" href="'.$instagram_link.'" target="_blank" title="Follow us on Instagram" ><i class="fa fa-instagram w3-hover-opacity"></i></a>';
					}
					if($snapchat_link!="")
					{
						echo '<a style="margin: 0px 4px;" href="'.$snapchat_link.'" target="_blank" title="Follow us on Snapchat" ><i class="fa fa-snapchat w3-hover-opacity"></i></a>';
					}
					if($pinterest_link!="")
					{
						echo '<a style="margin: 0px 4px;" href="'.$pinterest_link.'" target="_blank" title="Follow us on Pinterest" ><i class="fa fa-pinterest-p w3-hover-opacity"></i></a>';
					}
					if($twitter_link!="")
					{
						echo '<a style="margin: 0px 4px;" href="'.$twitter_link.'" target="_blank" title="Follow us on Twitter" ><i class="fa fa-twitter w3-hover-opacity"></i></a>';
					}
					if($linkedin_link!="")
					{
						echo '<a style="margin: 0px 4px;" href="'.$linkedin_link.'" target="_blank" title="Follow us on Linkedin" ><i class="fa fa-linkedin w3-hover-opacity"></i></a>';
					}
				?>
			  </div>
			  
			  <p>Copyright &copy <?php echo Date("Y").' '.$copyright_title; ?></p>
			  <p>Website Developed By <a href="<?php echo $developer_link; ?>" target="_blank"><img class="w3-image" style="width:20%;max-width:80px;" src="images/system/<?php echo $developer_logo; ?>"  alt="<?php echo $developer_title; ?>" title="<?php echo $developer_title; ?>"></a></p>
			</footer>
		</div>
	</body>
</html>