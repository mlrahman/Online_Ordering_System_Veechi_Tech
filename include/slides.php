<?php
	try
	{
		$stmt = $conn->prepare("select * from home_slides where status='active' order by slide_id asc ");
		$stmt->execute();
		$list = $stmt->fetchAll(); 
		foreach($list as $row)
		{
?>

			<div style="margin:-27px 0px 0px 0px;padding:0px;" class="w3-container w3-display-container mySlides w3-animate-zoom">
			  <img src="images/slides/<?php echo $row['image']; ?>" alt="<?php echo $row['caption']; ?>" title="<?php echo $row['caption']; ?>" class="w3-image" style="width:100%;max-height:400px;">
			  <?php
				if($row['caption']!="")
				{
			  ?>
				  <div class="w3-display-bottomleft w3-medium w3-container w3-padding-small w3-black w3-border w3-border-white w3-margin">
					<?php echo $row['caption']; ?>
				  </div>
			  <?php
			    }
			  ?>
			  </div>

<?php
		}
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
?>

<button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
<button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>


<script>


var myIndex = 0;
var x = document.getElementsByClassName("mySlides");
var z;

carousel();

function plusDivs(n) {
  clearTimeout(z);
  for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";  
    }
  myIndex--;
  myIndex=myIndex+n;
  if (myIndex >= x.length) {myIndex = 0}    
  else if(myIndex<0) {myIndex=x.length-1}
  x[myIndex].style.display = "block";
  carousel();
}

function carousel() {
    var i;
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";  
    }
    if (myIndex >= x.length) {myIndex = 0}    
    x[myIndex].style.display = "block";
	myIndex++;
    z=setTimeout(carousel, 4000);    
}


</script>