<?php
	ob_start();
	error_reporting(0);
	include("common/config.php");
	include("common/functions.php");
	include("common/adminclass.php");
	include("classes/login.class.php"); 
	echo setPasswrd('admin');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin</title>

<!--<link href='http://fonts.googleapis.com/css?family=Quattrocento+Sans' rel='stylesheet' type='text/css'>-->
<link rel="stylesheet" href="css/index.style.css">
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/shisobright.js"></script>
<script>

$(document).ready(function() {	
	//select all the a tag with name equal to modal
	$('a[name=modal]').click(function(e) {
		//Cancel the link behavior
		e.preventDefault();
		//Get the A tag
		var id = $(this).attr('href');
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",1);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 
	
	});
	
	//if close button is clicked
	$('.window .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});			
	
});

</script>
</head>

<body>
<div id="contatiner">
	<div id="boxes">
		<!-- Start of Login Dialog -->  
		<div id="dialog1" class="window">
		<form name="forgetPasswdFrm" id="forgetPasswdFrm" method="post" action="" onsubmit="return postforgetPassWd();">
			<div class="row"><span id="errormsg"></span>
				<div class="label">User Name<b class="req">*</b></div>
				<div>
					<input class="input1" type="text" name="username" id="username" />
				</div>
				<div class="label">Email<b class="req">*</b></div>
				<div>
					<input class="input1" type="text" name="email" id="email" />
				</div>
				 <div class="row">
					<div class="label" >&nbsp;</div>
					<div style="padding-top:15px;">
						<input class="submit" type="submit" value="Submit" name="forgetPassBtn" />
					</div>
				</div>
			</div>
		</form>
		</div>
		<!-- End of Login Dialog -->  
		<!-- End of Sticky Note -->
		<!-- Mask to cover the whole screen -->
		  <div id="mask"></div>
	</div>
	<div id="contatiner1">
	<div id="logo">
	  <div align="center"><img src="images/logo.png" alt="shisobright" /></div>
	</div>
	<!-- MENU START -->
	<div id="menu1"></div>
	<div class="form">
		<div class="login">
		<div style="float:left; padding-left:28px;"><img src="images/Login.png" alt="admin" width="64" height="64" align="left" /></div>
		<div class="text"><h1>Welcome to Login Panel</h1></div>
		</div><span id="loginmsg" class="loginmsg" ></span>
			<form action="" method="post" style="padding:0px; margin:8px auto 0px auto; width:500px;" name="loginFrm" id="loginFrm" onsubmit="return postLogin();">
				<div class="row">
					<div class="label">Enter User Name<b class="req">*</b></div>
					<div class="input_box">
						<input class="input1" type="text" name="user_login" id="user_login" />
					</div>
				</div>
				<div class="row">
					<div class="label">Enter Password<b class="req">*</b></div>
					<div class="input_box">
						<input class="input1" type="password" name="user_pass" id="user_pass" />
					</div>
				</div>
				<div class="row">
					<div class="label">&nbsp;</div>
					<div>
						<input class="submit" type="submit" value="Login" name="subBtn" id="subBtn" />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="#dialog1" name="modal" style="color:#000000; text-decoration:none; font-size:13px;">Forgot Password?</a>
					</div>
				</div>
			</form>
	  </div>
	<div id="footer1">
	</div>
	</div>
	<div class="cls"></div>
	<div class="text"> <p align="center">© Copyright 2012 Shiso Bright | Designed by <a href="http://www.vizzmedia.com" target="_blank">Vizz Media</a></p>
	</div>
</div>
	<?php if(@$errorMsg != "") { ?>
	<script language="javascript">
		function hideEr() {
			document.getElementById('errorBlock').style.display = 'none';
		}
	</script>
	<script language="javascript">
		(function($){
			$(document).ready(function() {
				$("[AutoHide]").each(function() {
					if (!isNaN($(this).attr("AutoHide"))) {
						eval("setTimeout(function() {jQuery('#" + this.id + "').hide();}, " + parseInt($(this).attr('AutoHide')) * 800 + ");");
					}
				}); 
			});
		})(jQuery);
	</script>
	<div id="errorBlock" AutoHide="5" class="errorBlockCF" ondblclick="javascript: document.getElementById('errorBlock').style.display = 'none';">
	  <div class="errorBlockCFMsg"><?= @$errorMsg; ?></div>
	  <div class="errorBlockCFBtn"><a href="javascript: void(0);" onclick="javascript: hideEr();"><strong>CLOSE</strong></a>&nbsp;&nbsp;&nbsp;</div>
	  <br clear="all" />
	</div>
	<?php } ?>
</body>
</html>


