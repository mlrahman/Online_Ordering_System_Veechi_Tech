<?php
	try
	{
		$stmt = $conn->prepare("select * from gallery where status='active' order by image_id asc ");
		$stmt->execute();
		$list = $stmt->fetchAll(); 
		$ii=1;
		foreach($list as $row)
		{
?>

			<div onclick="document.getElementById('gallery_image<?php echo $ii; ?>').style.display='block';document.getElementById('gallery_modal').style.display='block';set_id(<?php echo $ii; $ii++; ?>);" class="w3-card-4 w3-hover-grayscale" style="display: inline-block;width:250px;white-space: normal;height:200px;padding:3px;margin:5px;cursor:pointer;">
				<img src="images/gallery/<?php echo $row['image'];?>" alt="<?php echo $row['caption'];?>" title="<?php echo $row['caption']; ?>" style="width:240px;height:140px;">
				<div class="w3-container w3-center">
				  <p class="w3-medium"><?php echo $row['caption']; ?></p>
				</div>
			</div>


<?php
		}
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
?>

<script>

//var g1=document.getElementById("gallery1").offsetWidth;
var g2=document.getElementById("gallery2").offsetWidth;
var g3=document.getElementById("gallery3").scrollWidth;
//console.log(g1);
//console.log(g2);
//console.log(g3);

var st=g2;
var en=g3;
var diff=en-st;
var zz;
var xx=0; 

var fl=0,fl2=0;

gallery_scroll();

function gallery_scroll()
{
	if(xx+5<=diff && fl==0)
	{
		xx=xx+5;
		document.getElementById("gallery3").scrollLeft=xx;
	}
	else
		fl=1;
	
	if(xx-5>=0 && fl==1)
	{
		xx=xx-5;
		document.getElementById("gallery3").scrollLeft=xx;
	}
	else
		fl=0;
		
	zz=setTimeout(gallery_scroll, 200);
}

function start_slide()
{
	if(fl2==1)
	{
		gallery_scroll();
		fl2=0;
	}
}

function stop_slide()
{
	if(fl2==0)
	{
		fl2=1;
		clearTimeout(zz);
	}
}

</script>


<!-- Gallery Image Modal -->
<div id="gallery_modal" class="w3-modal" style="z-index:99999999;">
	<div class="w3-modal-content w3-card-4 w3-animate-zoom w3-padding" style="max-width:500px;font-family:Arial;">
		
		<div class="w3-container"><br>
			<span onclick="document.getElementById('gallery_modal').style.display='none';close_gallery_image();" class="w3-button w3-large w3-transparent w3-display-topright" title="Close Modal"><i class="fa fa-close"></i></span>
			<h2 class="w3-xlarge w3-bold w3-left-align" style="font-family:Arial;">Gallery Image</h2>
		</div>
		<?php
		try
		{
			$stmt = $conn->prepare("select * from gallery where status='active' order by image_id asc ");
			$stmt->execute();
			$list = $stmt->fetchAll(); 
			$ii=1;
			foreach($list as $row)
			{
		?>
				<div class="w3-container" id="gallery_image<?php echo $ii; ?>" style="margin:0;padding:0;display:none;">
					<!-- Image Container -->
					<div class="w3-display-container w3-round w3-border w3-margin-bottom w3-padding" style="height:auto;max-height:300px;vertical-align:middle;">
						<div class="w3-display-container w3-round gallery_slides">
						  <img src="images/gallery/<?php echo $row['image'];?>" style="width:100%;max-height:290px;">
						</div>
					</div>
					<!-- Change option -->
					<button class="w3-button w3-display-left w3-black w3-border w3-round" onclick="gallery_plusDivs(<?php echo $ii; ?>,-1)" style="margin-left:18px;">&#10094;</button>
					<button class="w3-button w3-display-right w3-black w3-border w3-round" onclick="gallery_plusDivs(<?php echo $ii; $ii++; ?>,1)" style="margin-right:18px;">&#10095;</button>
					<!-- caption Container -->
					<div class="w3-container w3-border w3-medium w3-center w3-bold w3-padding w3-round" style="height:auto;max-height:50px;">
						<?php echo $row['caption'];?>
					</div>
					<p class="w3-right-align w3-bold w3-margin-bottom w3-small w3-text-blue" style="margin-top:0px;"><a href="images/gallery/<?php echo $row['image'];?>" target="_blank">Download</a></p>
				</div>
		<?php
			}
		}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		?>
	</div>
</div>
<script>
	
	var close_id;
	function set_id(id)
	{
		close_id=id;
	}
	
	function close_gallery_image()
	{
		document.getElementById('gallery_image'+close_id).style.display='none';
	}
	
	function gallery_plusDivs(val,n)
	{
		var x = document.getElementsByClassName("gallery_slides"),i;
		ss=parseInt(val)+parseInt(n);
		//console.log(ss); current position
		//console.log(x.length); total images
		if(ss>x.length) ss=1;
		else if(ss<1) ss=x.length;
		for (i = 1; i <= x.length; i++) {
			document.getElementById('gallery_image'+i).style.display = "none";
		}
		document.getElementById('gallery_image'+ss).style.display = "block";
		close_id=ss;
	}
	
	
</script>
