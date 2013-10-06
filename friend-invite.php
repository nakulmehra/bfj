<?php
	require 'config.php';
	require 'lib/facebook/facebook.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BFJ</title>

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
		$(document).ready(function () {
            $("img.image-selector").click(function () {
				$("img.image-selector").css({"border": ""});
               $(this).css({"border": "#28a8d2 3px solid"});
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
error_reporting(0);
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
		
		function sendRequest(user_id,user_name){
			var chkss2 = document.getElementsByName('inviteFrnds[]');
			var checkCountss2 = 0;
			var article='';
			for (var i = 0; i < chkss2.length; i++){
				if (chkss2[i].checked){
					checkCountss2++;
					if(article ==''){
						article=chkss2[i].value;
					}else{
						article=article+','+chkss2[i].value;
					}
				}
			}
			if(checkCountss2 > 0){
				FB.ui({ method:'apprequests',to:article,message:'You message here site.',data:'tracking information for the user' });
				return false;
			}else{
				alert('No friend select');
			}
		}
	</script>
	<table border='0' cellpadding='0' cellspacing='0' width='100%' style='margin-top:10px;' >
		<tr>
			<td align='center' >Invite your friend</td>
		</tr>
		<tr>
			<td>
				<?php
					$facebook = new Facebook(array('appId'=>$appID,'secret'=>$appSecret,'cookies'=>'true'));
					$user_profile = $facebook->api('/me');
					$access_token = $facebook->getAccessToken();
					
					print_r($user_profile);
					$friends = $facebook->api(array(
						"method"    => "fql.query",
						"query"     => "SELECT uid,name FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = me())"
					));
					echo "<form method='post' action='' name='friendFrm' id='friendFrm'>";
					echo "<ul>";
					echo "<input type=\"checkbox\" onclick=\"checkedAll()\" />";
					foreach($friends as $friend){
						$profile_pic =  "http://graph.facebook.com/".$friend['uid']."/picture";
						echo "<li>";
							echo "<input type='checkbox' name='inviteFrnds[]' value='".$friend['uid']."' >";
							echo "<img src='".$profile_pic."' >";
							echo "&nbsp;".$friend['name'];
						echo "</li>";
					}
					echo "<li><input type='button' name='requestBtn' value='Send Invite' onclick=\"return sendRequest('".$user_profile['id']."','".$user_profile['name']."')\" ></li>";
					echo "</ul>";
					echo "</form>";
				?>
			</td>
		</tr>
	</table>
<? } ?>
</body>
</html>