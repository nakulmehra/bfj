<?php
	$errorMsg ="";
	session_start();
	if(isset($_POST['subBtn'])){
		$username=setPasswrd($_POST['user_login']);
		$password=setPasswrd($_POST['user_pass']);
		$chk=Admin::countData('admin',array('username'=>$username,'password'=>$password),array());
		if($username==""){
			$errorMsg="Enter user name to proceed";
		}elseif($password==""){
			$errorMsg="Enter password to proceed";
		}elseif($chk < 1){
			$errorMsg="Invalid username or password";
		}else{
			$user = Admin::getSingle('admin',array('username'=>$username,'password'=>$password),array());
			$_SESSION['login']= '1';
			$_SESSION['username']= $_POST['user_login'];
			$_SESSION['userId'] = $user['id'];
			$_SESSION['email'] = $user['email'];
			$_SESSION['fullname'] = $user['name'];
			echo '<script>window.location="home.php"</script>';
		}
	
	}
	if(isset($_POST['forgetPassBtn'])){
		$checkmail=Admin::countData('admin',array(),array());
		if($_POST['username']==""){
			$errorMsg="Enter username to proceed";
		}elseif($_POST['email']==''){
			$errorMsg="Enter email to proceed";
		}elseif($checkmail < 1){
			$errorMsg="Sorry, You have given worong entery";
		}else{
			$userinfo=Admin::getUserInfo(md5($_POST['username']),$_POST['email']);
			$subject = 'Forgot Password';
			$to=$userinfo['email'];
			   $message = '
			   <html>
				<body>
				 <p>Dear '.$userinfo['name'].',</p>
				  <p>Please find your login details</p>
					<table>
						<tr>
						   <td>Username is =  <strong>'.$userinfo['username'].'</strong>
						   </td>
					  </tr>
					 <tr>
						   <td>Password is =  <strong>'.$userinfo['password'].'</strong>
						   </td>
					  </tr>
					  <tr>
						  <td><br />Thanks,<br/>
							Shiso Bright Team<br/>
						 </td>
					 </tr>
				 </table>
			  </body>
			</html>';
			$headers    =     'MIME-Version: 1.0' . "\r\n";
			$headers   .=    'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers   .=    "From: Shiso Bright<dasarath@vizz.in>";
			$mail = mail($to,$subject,$message,$headers);
			if($mail){
				$errorMsg="Password has send on your email";
			}
		}
	}
?>