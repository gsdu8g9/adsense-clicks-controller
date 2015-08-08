<script language="javascript">
/* Author: Atiq Samtia
Version: 1.1
Updated:07-08-2015
Copyright: Falcons Web developers
URL: http://falconspk.net
Demo:  http://atiqsamtia.com/click-control/
Description: By Using this script you can Prevent your visitors to multiple click on your Ads.
in this version Your visitors can only click one time per day on the ad.
How to use: Add tha Script at the top of your page and than add  
<body onload="checkCookie(2)">    WHERE 2 is number of total clicks allowed daily.
and in your html add your ad like this 
<div id="blockMe"> Your Ad Code Here </div>
Pricing: This Script is free of Cost for Personal use . This canot be sold.
*/
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script src="http://malsup.github.io/jquery.blockUI.js"></script>
<script src="http://malsup.github.com/chili-1.7.pack.js"></script>
<script>
function falcons_adclick_setcookie(c_name, value, exdays) {
	var exdate = new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
	document.cookie = c_name + "=" + c_value;
}

function falcons_adclick_getCookie(c_name) {
	var c_value = document.cookie;
	var c_start = c_value.indexOf(" " + c_name + "=");
	if (c_start == -1) {
		c_start = c_value.indexOf(c_name + "=");
	}
	if (c_start == -1) {
		c_value = null;
	} else {
		c_start = c_value.indexOf("=", c_start) + 1;
		var c_end = c_value.indexOf(";", c_start);
		if (c_end == -1) {
			c_end = c_value.length;
		}
		c_value = unescape(c_value.substring(c_start, c_end));
	}
	return c_value;
}

function falcons_adclick_load(falcons_adclick_page, falcons_adclick_allowed) {
	falcons_adclick_page_name = "falcons_adclick_count_" + falcons_adclick_page;
	var falcons_adclick_count = falcons_adclick_getCookie(falcons_adclick_page_name);
	if (falcons_adclick_count != null && falcons_adclick_count >= falcons_adclick_allowed) {
		$('.falcons_adclick_ad').block({
			message: '<b>Clicked</b>',
			css: {
				border: '2px solid #a00'
			}
		});
	}
	$(function() {
		$(".falcons_adclick_ad").click(function(e) {
			var falcons_adclick_count_ = falcons_adclick_getCookie(falcons_adclick_page_name);
			var tosave = 1;
			if (falcons_adclick_count_) {
				tosave = parseInt(falcons_adclick_count_, 10) + 1;
			}
			falcons_adclick_setcookie(falcons_adclick_page_name, tosave, 1);
			falcons_adclick_load(falcons_adclick_page, falcons_adclick_allowed);
		});
	})
}
</script>
