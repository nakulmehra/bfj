function postLogin(){ 
	if(document.forms['loginFrm']['user_login'].value==""){
		document.forms['loginFrm']['user_login'].style.borderColor="red";
		document.forms['loginFrm']['user_login'].focus();
		document.getElementById('loginmsg').innerHTML="Enter user name to proceed";
		return false;
	}
	if(document.forms['loginFrm']['user_pass'].value==""){
		document.forms['loginFrm']['user_pass'].style.borderColor="red";
		document.forms['loginFrm']['user_pass'].focus();
		document.getElementById('loginmsg').innerHTML="Enter password to proceed";
		return false;
	}
	return true;
}
function postforgetPassWd() {
	var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	var email = document.forms['forgetPasswdFrm']['email'].value;
	if(document.forms['forgetPasswdFrm']['username'].value==""){
		document.forms['forgetPasswdFrm']['username'].style.borderColor="red";
		document.forms['forgetPasswdFrm']['username'].focus();
		document.getElementById('errormsg').innerHTML="Enter user name to proceed";
		return false;
	}
	if(document.forms['forgetPasswdFrm']['email'].value==""){
		document.forms['forgetPasswdFrm']['email'].style.borderColor="red";
		document.forms['forgetPasswdFrm']['email'].focus();
		document.getElementById('errormsg').innerHTML="Enter email to proceed";
		return false;
	}
	if( !regex.test(email)){
		document.getElementById('errormsg').innerHTML="Invalid email";
		document.forms['forgetPasswdFrm']['email'].focus();
		return false;
	}
	return true;
}
function postPasswdChange(){
	if(document.forms['passfrm']['oldpsswd'].value==""){
		document.forms['passfrm']['oldpsswd'].style.borderColor="red";
		document.forms['passfrm']['oldpsswd'].focus();
		document.getElementById('errormsg').innerHTML="Enter old password to proceed";
		return false;
	}
	if(document.forms['passfrm']['newpasswd'].value==""){
		document.forms['passfrm']['newpasswd'].style.borderColor="red";
		document.forms['passfrm']['newpasswd'].focus();
		document.getElementById('errormsg').innerHTML="Enter new password to proceed";
		return false;
	}
	if(document.forms['passfrm']['conpasswd'].value==""){
		document.forms['passfrm']['conpasswd'].style.borderColor="red";
		document.forms['passfrm']['conpasswd'].focus();
		document.getElementById('errormsg').innerHTML="Enter confirm password to proceed";
		return false;
	}
	if(document.forms['passfrm']['newpasswd'].value != document.forms['passfrm']['conpasswd'].value){
		document.forms['passfrm']['conpasswd'].style.borderColor="red";
		document.forms['passfrm']['conpasswd'].focus();
		document.getElementById('errormsg').innerHTML="Password donot match";
		return false;
	}
	return true;
}
