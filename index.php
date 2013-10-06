<?php
	require 'config.php';
	require 'lib/facebook/facebook.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BFJ</title>

<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/thickbox.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/skin.css" />
<link rel="stylesheet" href="css/dropincontentbox.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/dropincontentbox.js">

/***********************************************
* Drop In Content Box (c) Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/

</script>

<script>

var dropinbox1=new dropincontentbox({
	source:'#dropbox', //#id of DIV to show if defined inline, or [#id, path_to_box_content_file] if defined in external file
	cssclass:'dropinbox standardshadow', //arbitrary class(es) to add to the drop in box to style it
	showduration:5000 //disappear after x seconds?
})
</script>

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/oauthpopup.js"></script>
<script type="text/javascript" src="js/thickbox.js"></script>

<script src="http://connect.facebook.net/en_US/all.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#facebook').click(function(e){
				$.oauthpopup({
					path: 'login.php',
					width:600,
					height:300,
					callback: function(){
						window.location.reload();
					}
				});
				e.preventDefault();
			});
		});
		
	</script>
	
</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php /*?><?php 
error_reporting(0);
session_start();
if(!isset($_SESSION['User']) && empty($_SESSION['User'])){ ?>
	<div id="dropbox" style="top: -8px!important;">
		<a href="javascript:void(0)"><img src="images/TBS-Creative-Login.jpg" id="facebook" alt="" /></a>
	</div>
<?php  }else{ ?>
	
	<table border='0' cellpadding='0' cellspacing='0' width='100%' style='margin-top:10px;' >
		<tr>
			<td align='center' ><a href="friend-list.php?keepThis=true&TB_iframe=true&height=500&width=845" title="view" class="thickbox">Invite your friend</a></td>
			<td align='center' ><a href="logout.php">Logout</a></td>
		</tr>
		
	</table>
<? } ?><?php */?>

<?php 
error_reporting(0);
session_start();
if(!isset($_SESSION['User']) && empty($_SESSION['User'])){ ?>
<div style="width:800px; height:600px; margin:0 auto; background:url(images/home1.jpg) no-repeat; padding: 0">
<div style="bottom: 120px;
    height: 29px;
    left: 46%;
    margin: 0 auto;
    position: absolute;
    width: 123px;
    z-index: 100;">
	<div id="dropbox">
		<a href="javascript:void(0)"><img src="images/startnow.png" id="facebook"/></a>
	</div>
	</div>
</div>
<?php  }else{ ?>
<div style="width:800px; height:600px; margin:0 auto; background:url(images/home1.jpg) no-repeat; padding: 0">
<div style="bottom: 120px;
    height: 29px;
    left: 43%;
    margin: 0 auto;
    position: absolute;
    width: 123px;
    z-index: 100;">
	<a href="friend-list.php?keepThis=true&TB_iframe=true&height=400&width=600" title="view" class="thickbox"><img src="images/select-freind.png" /></a>
	</div>
	<div style="bottom: 80px;
    height: 29px;
    left: 56%;
    margin: 0 auto;
    position: absolute;
    width: 123px;
    z-index: 100;">
	<a href="logout.php"><img src="images/logout.png" /></a>
	</div>
</div>
<? } ?>


</body>
</html>