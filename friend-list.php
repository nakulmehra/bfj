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
<link rel="stylesheet" type="text/css" href="css/skin.css" />
<link rel="stylesheet" href="css/dropincontentbox.css" />
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
<?php 
//error_reporting(0);
session_start();
if(!isset($_SESSION['User']) && empty($_SESSION['User'])){ ?>
	<div id="dropbox" style="top: -8px!important;">
		<a href="javascript:void(0)"><img src="images/TBS-Creative-Login.jpg" id="facebook" alt="" /></a>
	</div>
<?php  }else{ ?>
	<script>
		checked = false;
		function checkedAll () {
		if (checked == false){checked = true}else{checked = false}
		for (var i = 0; i < document.getElementById('friendFrm').elements.length; i++) {
		document.getElementById('friendFrm').elements[i].checked = checked;}}
		FB.init({ appId: '611403968912012',status:true,cookie:true,xfbml:true });
		function sendRequest(user_id,user_name,user_email){
			var chkss2 = document.getElementsByName('inviteFrnds[]');
			var checkCountss2 = 0;
			var article='';
			var invite_friend_name='';
			for (var i = 0; i < chkss2.length; i++){
				if (chkss2[i].checked){
					var friend_name=chkss2[i].value+"_name";
					checkCountss2++;
					if(article ==''){
						article=chkss2[i].value;
						invite_friend_name=document.getElementById(friend_name).value;
					}else{
						article=article+','+chkss2[i].value;
						invite_friend_name=invite_friend_name+','+document.getElementById(friend_name).value;
					}
				}
			}
			if(checkCountss2 > 0){
				$.ajax({
					type: "POST",
					url: "friend_class.php",
					data: "user_id="+user_id+"&user_name="+user_name+"&user_email="+user_email+"&article="+article+"&invite_friend_name="+invite_friend_name+"&type=addprofiledetails",
					success: function(msg){
						FB.ui({ method:'apprequests',to:article,message:'Hi, I have invited you to join me in the The Body Shop Biggest Fan Jeetaga Contest. You too can stand a chance to win a Gift Voucher for Rs. 5,000/-',data:'tracking information for the user' });
						window.location='thanks.php';
						return false;
						
					}
				});
			}else{
				alert('No friend select');
			}
		}
	</script>
	<form method='post' action='' name='friendFrm' id='friendFrm'>
	
		<?php
			$facebook = new Facebook(array('appId'=>$appID,'secret'=>$appSecret,'cookies'=>'true'));
			$user_profile = $facebook->api('/me');
			$access_token = $facebook->getAccessToken();
			
			$friends = $facebook->api(array(
				"method"    => "fql.query",
				"query"     => "SELECT uid,name FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me())"
			));
			echo "<div class='selectall'>";
			echo "<p>";
			echo "<input type=\"checkbox\" onclick=\"checkedAll()\" />&nbsp;&nbsp;Select All";
			echo "</p>";
			//echo "<li>";
			//echo "Profile Photo";
			//echo "</li>";
			//echo "<li>";
			//echo "Name";
			//echo "</li>";
			echo "</div>";
			echo "<div class='req_freind'>";
			foreach($friends as $friend){
				$count_invite_user_id=0;
				$profile_pic =  "http://graph.facebook.com/".$friend['uid']."/picture";
				$name=$friend['uid']."_name";
				/*
				$qry="select * from tbl_invite_friend where user_id='".$user_profile['id']."' and invite_user_id='".$friend['uid']."'";
				$result=mysql_query($qry);
				$count_invite_user_id=mysql_num_rows($result);*/
				
				echo "<ul>";
				echo "<li>";
					echo "<input type='checkbox' name='inviteFrnds[]' value='".$friend['uid']."'>";
					echo "<input type='hidden' name='".$name."' id='".$name."' value='".$friend['name']."'>";
				echo "</li>";
				echo "<li>";
					echo "<img src='".$profile_pic."' >";
				echo "</li>";
				echo "<li>";
					echo "&nbsp;".$friend['name'];
				echo "</li>";
				echo "</ul>";
			}
			echo "<ul>";
			echo "<li>";
			echo "<input class='snd_invite' type='button' name='requestBtn' value='Send Invite' onclick=\"return sendRequest('".$user_profile['id']."','".$user_profile['name']."','".$user_profile['email']."')\" ></li>";
			echo "<li>&nbsp;</li>";
			echo "</ul>";
			
		?>
	</div>
	</form>
<? } ?>
</body>
</html>