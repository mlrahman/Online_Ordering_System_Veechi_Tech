//Scroll Back To Top
window.onscroll = function() {scrollFunction()};

//<!-- Detect wheather offer click or not -->
var order_online_active=0;
 
var flag_offer=0;

function scrollFunction() {
	
	w3_close();
	if(order_online_active==1)
		scrollFunction3();
	
	if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
		document.getElementById("scroll_btn").style.display = "block";
	} else {
		document.getElementById("scroll_btn").style.display = "none";
	}
	
	//Show menu of foods in mobile top
	if(flag_offer==0 && order_online_active==1) //Offer not clicket yet
	{
		if (document.body.scrollTop > 172 || document.documentElement.scrollTop > 172) {
			document.getElementById("scroll_menu_show").style.display = "block";
			scrollFunction2();
		} else {
			document.getElementById("scroll_menu_show").style.display = "none";
			food_menu_close();
		}
	}
}





