function loading_show(){
	$('#loading').html("<img src='images/ajax-loader.gif'/>&nbsp;&nbsp;please wait...").fadeIn('fast');
}
function loading_hide(){
	$('#loading').html("").fadeOut('fast');
}
$(document).ready(function(){
	function loadData(page){
		loading_show();
		$.ajax({
			type: "POST",
			url: "classes/home-class.php",
			data: "page="+page,
			success: function(msg){
				$("#container").ajaxComplete(function(event,request,settings){
					loading_hide();
					$("#container").html(msg);
				});
			}
		});
	}
	loadData(1);
});
function getSearchValue(e){
	var key=e.keyCode || e.which;
	if (key==13 || e=='srch'){ 
		if(document.getElementById("searchval").value==''){
			document.getElementById('searchval').focus();
			document.getElementById('searchval').style.borderColor='red';
			return false;
		}else{ 
			loading_show();
			var searchval=document.getElementById("searchval").value;
			page=1;
			$.ajax({
				type: "POST",
				url: "classes/user-class.php",
				data: "page="+page+"&searchval="+searchval,
				success: function(msg){
					$("#container").ajaxComplete(function(event,request,settings){
						loading_hide();
						$("#container").html(msg);
						document.getElementById("searchval").value=searchval;
					});
				}
			});
		}
	}
}
function goToViewAll(){
	loading_show();
	page=1;
	$.ajax({
		type: "POST",
		url: "classes/user-class.php",
		data: "page="+page,
		success: function(msg){
			$("#container").ajaxComplete(function(event,request,settings){
				loading_hide();
				$("#container").html(msg);
			});
		}
	});
}
function goToUp(field, orderby,div_name){
	loading_show();
	page=1;
	$.ajax({
		type: "POST",
		url: "classes/user-class.php",
		data: "page="+page+"&field="+field+"&orderby="+orderby,
		success: function(msg){
			$("#container").ajaxComplete(function(event,request,settings){
				loading_hide();
				$("#container").html(msg);
				if(orderby=='asc'){ 
					document.getElementById(div_name).innerHTML="<img src='images/down-arrow.png' onclick=\"goToUp('"+field+"','desc','"+div_name+"')\">";
				}
				if(orderby=='desc'){ 
					document.getElementById(div_name).innerHTML="<img src='images/up-arrow.png' onclick=\"goToUp('"+field+"','asc','"+div_name+"')\">";
				}
			});
		}
	});
}

function changeStatus(ptr){
	loading_show();
	$.ajax({
		type: "POST",
		url: "classes/user-class.php",
		data: "id="+ptr+"&type=changeStatus",
		success: function(msg){	
			page=1;
			$.ajax({
				type: "POST",
				url: "classes/user-class.php",
				data: "page="+page,
				success: function(msg){
					$("#container").ajaxComplete(function(event,request,settings){
						loading_hide();
						$("#container").html(msg);
					});
				}
			});
		}
	})
}

function deleteSingle(id){
	var r=confirm('Do You Want to Delete?');
	if(r){
		loading_show();
		$.ajax({
			type: "POST",
			url: "classes/home-class.php",
			data: "id="+id+"&type=deletesingle",
			success: function(msg){	
				if(msg ==1){
					page=1;
					$.ajax({
						type: "POST",
						url: "classes/home-class.php",
						data: "page="+page,
						success: function(msg){
							$("#container").ajaxComplete(function(event,request,settings){
								loading_hide();
								$("#container").html(msg);
							});
						}
					});
				}
			}
		});
	}
}
function deleteAll(){
	var r=confirm("Do You Want to Delete?");
	if(r){
		var chkss2 = document.getElementsByName('check_all[]');
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
		if(checkCountss2==0){
			alert('Select one record to delete.');
		}else{ 
			loading_show();
			$.ajax({
				type: "POST",
				url: "classes/home-class.php",
				data: "id="+article+"&type=deleteAll",
				success: function(msg){	
					if(msg==1){
						alert('Select one record to delete.');
					}else if(msg==2){
						page=1;
						$.ajax({
							type: "POST",
							url: "classes/home-class.php",
							data: "page="+page,
							success: function(msg){
								$("#container").ajaxComplete(function(event,request,settings){
									loading_hide();
									$("#container").html(msg);
								});
							}
						});
					}
				}
			});
		}
	}
}

function goToNumberPage(){
	var page = parseInt($('.goto').val());
	var no_of_pages = parseInt($('.total').attr('a'));
	if(page != 0 && page <= no_of_pages){
		loading_show();
		$.ajax({
			type: "POST",
			url: "classes/user-class.php",
			data: "page="+page,
			success: function(msg){
				$("#container").ajaxComplete(function(event,request,settings){
					loading_hide();
					$("#container").html(msg);
				});
			}
		});
	}else{
		alert('Enter a PAGE between 1 and '+no_of_pages);
		$('.goto').val("").focus();
		return false;
	}
}
function changePage(page){
	loadData(page);
	function loadData(page){
		loading_show();
		$.ajax({
			type: "POST",
			url: "classes/user-class.php",
			data: "page="+page,
			success: function(msg){
				$("#container").ajaxComplete(function(event,request,settings){
					loading_hide();
					$("#container").html(msg);
				});
			}
		});
	}
}



function addUser(edit,e){
	var key=e.keyCode || e.which;
	if(key==13 || e=='adduser'){
		if((edit!='') && edit==1){
			var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var email = document.getElementById('email').value;
			if(document.getElementById('user_name').value==""){
				document.getElementById('pageOverlay').style.display='block';
				document.getElementById('itemWrapper').style.display='block';
				document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a valid username to proceed.</td></tr></table>";
				document.getElementById('user_name').style.backgroundColor='#FF9966';
				document.getElementById('user_name').focus();
				return false;
			}else if(document.getElementById('name').value==""){
				document.getElementById('pageOverlay').style.display='block';
				document.getElementById('itemWrapper').style.display='block';
				document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a valid name to proceed.</td></tr></table>";
				document.getElementById('name').style.backgroundColor='#FF9966';
				document.getElementById('name').focus();
			}else if((!regex.test(email)) || (document.getElementById('email').value=="")){
				document.getElementById('pageOverlay').style.display='block';
				document.getElementById('itemWrapper').style.display='block';
				document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a valid Email Address to proceed.</td></tr></table>";
				document.getElementById('email').style.backgroundColor='#FF9966';
				document.getElementById('email').focus();
				return false;
			}else if((document.getElementById('mobile').value=="") || (document.getElementById('mobile').value < 1) || (document.getElementById('mobile').value.length < 10)){
				document.getElementById('pageOverlay').style.display='block';
				document.getElementById('itemWrapper').style.display='block';
				document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a valid Mobile Number to proceed.</td></tr></table>";
				document.getElementById('mobile').style.backgroundColor='#FF9966';
				document.getElementById('mobile').focus();
			}else if(document.getElementById('user_pass').value==""){
				document.getElementById('pageOverlay').style.display='block';
				document.getElementById('itemWrapper').style.display='block';
				document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a valid password to proceed.</td></tr></table>";
				document.getElementById('user_pass').style.backgroundColor='#FF9966';
				document.getElementById('user_pass').focus();
			}else{
				document.getElementById('loadingdiv').style.display='block';
				var user_name=document.getElementById('user_name').value;
				var name=document.getElementById('name').value;
				var email=document.getElementById('email').value;
				var mobile=document.getElementById('mobile').value;
				var user_pass=document.getElementById('user_pass').value;
				var user_type='';
				var supervisior='';
				var team_leader='';
				
				$.ajax({
					type: "POST",
					url: "classes/user-class.php",
					data: "edit="+edit+"&user_name="+user_name+"&name="+name+"&email="+email+"&mobile="+mobile+"&user_pass="+user_pass+"&user_type="+user_type+"&supervisior="+supervisior+"&team_leader="+team_leader+"&type=addUserSub",
					success: function(msg){
						document.getElementById('loadingdiv').style.display='none';
						if(msg==1){
							document.getElementById('pageOverlay').style.display='block';
							document.getElementById('itemWrapper').style.display='block';
							document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a valid username to proceed.</td></tr></table>";
						}else if(msg==2){
							document.getElementById('pageOverlay').style.display='block';
							document.getElementById('itemWrapper').style.display='block';
							document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Email already sumbitted.</td></tr></table>";
						}else if(msg==3){
							document.getElementById('pageOverlay').style.display='block';
							document.getElementById('itemWrapper').style.display='block';
							document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a name.</td></tr></table>";
						}else if(msg==4){
							document.getElementById('pageOverlay').style.display='block';
							document.getElementById('itemWrapper').style.display='block';
							document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a valid Mobile Number.</td></tr></table>";
						}else if(msg==5){
							document.getElementById('pageOverlay').style.display='block';
							document.getElementById('itemWrapper').style.display='block';
							document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a password.</td></tr></table>";
						}else if(msg==6){
							document.getElementById('user_type').style.borderColor="red";
							document.getElementById('user_type').focus();					
						}else if(msg==7){
									window.location='view_user.php';
						}else if(msg==8){
									alert('Error found to submit your details.');
						}else if(msg==9){
							document.getElementById('pageOverlay').style.display='block';
							document.getElementById('itemWrapper').style.display='block';
							document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a supervisor name to proceed.</td></tr></table>";
						}else if(msg==10){
							document.getElementById('pageOverlay').style.display='block';
							document.getElementById('itemWrapper').style.display='block';
							document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a teamleader name to proceed.</td></tr></table>";
						}else if(msg==11){
							document.getElementById('pageOverlay').style.display='block';
							document.getElementById('itemWrapper').style.display='block';
							document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a valid email address to procedd.</td></tr></table>";
						}
					}
				})
			
			}
		}else{
			var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var email = document.getElementById('email').value;
			if(document.getElementById('user_name').value==""){
				document.getElementById('pageOverlay').style.display='block';
				document.getElementById('itemWrapper').style.display='block';
				document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a valid username to proceed.</td></tr></table>";
				document.getElementById('user_name').style.backgroundColor='#FF9966';
				document.getElementById('user_name').focus();
				return false;
			}else if(document.getElementById('name').value==""){
				document.getElementById('pageOverlay').style.display='block';
				document.getElementById('itemWrapper').style.display='block';
				document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a valid name to proceed.</td></tr></table>";
				document.getElementById('name').style.backgroundColor='#FF9966';
				document.getElementById('name').focus();
			}else if((!regex.test(email)) || (document.getElementById('email').value=="")){
				document.getElementById('pageOverlay').style.display='block';
				document.getElementById('itemWrapper').style.display='block';
				document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a valid Email Address to proceed.</td></tr></table>";
				document.getElementById('email').style.backgroundColor='#FF9966';
				document.getElementById('email').focus();
				return false;
			}else if((document.getElementById('mobile').value=="") || (document.getElementById('mobile').value < 1) || (document.getElementById('mobile').value.length < 10)){
				document.getElementById('pageOverlay').style.display='block';
				document.getElementById('itemWrapper').style.display='block';
				document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a valid Mobile Number to proceed.</td></tr></table>";
				document.getElementById('mobile').style.backgroundColor='#FF9966';
				document.getElementById('mobile').focus();
			}else if(document.getElementById('user_pass').value==""){
				document.getElementById('pageOverlay').style.display='block';
				document.getElementById('itemWrapper').style.display='block';
				document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a valid password to proceed.</td></tr></table>";
				document.getElementById('user_pass').style.backgroundColor='#FF9966';
				document.getElementById('user_pass').focus();
			}else if((document.getElementById('user_type').value=="")){
				document.getElementById('pageOverlay').style.display='block';
				document.getElementById('itemWrapper').style.display='block';
				document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Choose a valid user type to proceed.</td></tr></table>";
				document.getElementById('user_type').style.borderColor="red";
				document.getElementById('user_type').focus();
				return false;
			}else if((document.getElementById('user_type').value==3) && (document.getElementById('supervisior').value=='') && (document.getElementById('supervisior')!=undefined)){
				document.getElementById('pageOverlay').style.display='block';
				document.getElementById('itemWrapper').style.display='block';
				document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Select a valid supervisor to proceed.</td></tr></table>";
				document.getElementById('supervisior').style.borderColor="red";
				document.getElementById('supervisior').focus();
				return false;	
			}else if((document.getElementById('team_leader')!=undefined) && (document.getElementById('user_type').value==4) && (document.getElementById('team_leader').value=='')){
				document.getElementById('pageOverlay').style.display='block';
				document.getElementById('itemWrapper').style.display='block';
				document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Select a valid team leader to proceed.</td></tr></table>";
				document.getElementById('team_leader').style.borderColor="red";
				document.getElementById('team_leader').focus();
				return false;	
			}else if((document.getElementById('supervisior')!=undefined) && (document.getElementById('user_type').value==4) && (document.getElementById('supervisior').value=='')){
				document.getElementById('pageOverlay').style.display='block';
				document.getElementById('itemWrapper').style.display='block';
				document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Select a valid supervisor to proceed.</td></tr></table>";
				document.getElementById('supervisior').style.borderColor="red";
				document.getElementById('supervisior').focus();
				return false;
			}else{ 
			
				document.getElementById('loadingdiv').style.display='block';
				var user_name=document.getElementById('user_name').value;
				var name=document.getElementById('name').value;
				var email=document.getElementById('email').value;
				var mobile=document.getElementById('mobile').value;
				var user_pass=document.getElementById('user_pass').value;
				var user_type=document.getElementById('user_type').value;
				var supervisior='';
				var team_leader='';
				if((document.getElementById('user_type').value==3) && (document.getElementById('supervisior').value!='') && (document.getElementById('supervisior')!=undefined)){
					supervisior=document.getElementById('supervisior').value;
				}
				if((document.getElementById('user_type').value==4) && (document.getElementById('team_leader').value!='') && (document.getElementById('team_leader')!=undefined)){
					team_leader=document.getElementById('team_leader').value;
				}
				if((document.getElementById('user_type').value==4) && (document.getElementById('supervisior').value!='') && (document.getElementById('supervisior')!=undefined)){
					supervisior=document.getElementById('supervisior').value;
				}
				
				$.ajax({
					type: "POST",
					url: "classes/user-class.php",
					data: "edit="+edit+"&user_name="+user_name+"&name="+name+"&email="+email+"&mobile="+mobile+"&user_pass="+user_pass+"&user_type="+user_type+"&supervisior="+supervisior+"&team_leader="+team_leader+"&type=addUserSub",
					success: function(msg){
						document.getElementById('loadingdiv').style.display='none';
						if(msg==1){
							document.getElementById('pageOverlay').style.display='block';
							document.getElementById('itemWrapper').style.display='block';
							document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a valid username to proceed.</td></tr></table>";
						}else if(msg==2){
							document.getElementById('pageOverlay').style.display='block';
							document.getElementById('itemWrapper').style.display='block';
							document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Email already sumbitted.</td></tr></table>";
						}else if(msg==3){
							document.getElementById('pageOverlay').style.display='block';
							document.getElementById('itemWrapper').style.display='block';
							document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a name.</td></tr></table>";
						}else if(msg==4){
							document.getElementById('pageOverlay').style.display='block';
							document.getElementById('itemWrapper').style.display='block';
							document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a valid Mobile Number.</td></tr></table>";
						}else if(msg==5){
							document.getElementById('pageOverlay').style.display='block';
							document.getElementById('itemWrapper').style.display='block';
							document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a password.</td></tr></table>";
						}else if(msg==6){
							document.getElementById('user_type').style.borderColor="red";
							document.getElementById('user_type').focus();					
						}else if(msg==7){
									window.location='view_user.php';
						}else if(msg==8){
									alert('Error found to submit your details.');
						}else if(msg==9){
							document.getElementById('pageOverlay').style.display='block';
							document.getElementById('itemWrapper').style.display='block';
							document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a supervisor name to proceed.</td></tr></table>";
						}else if(msg==10){
							document.getElementById('pageOverlay').style.display='block';
							document.getElementById('itemWrapper').style.display='block';
							document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a teamleader name to proceed.</td></tr></table>";
						}else if(msg==11){
							document.getElementById('pageOverlay').style.display='block';
							document.getElementById('itemWrapper').style.display='block';
							document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'>Please enter a valid email address to procedd.</td></tr></table>";
						}
					}
				})
			}
		}
	}
} 


function changePassword(){
document.getElementById('pageOverlay').style.display='block';
document.getElementById('itemWrapper').style.display='block';
document.getElementById('itemOverlay').innerHTML="<table width='100%'><tr><td align='center' colspan='2' ><a href=\"\" onClick=\"kill('');return false;\" style='float: right;'><img src='images/cross_sticker.png' width='30' height='20'></a></td></tr><tr><td colspan='2'><tr><td>old password</td><td><input type=\"text\" name=\"old_passsord\" id=\"old_passsord\" /></td></tr><tr><td></td><td></td></tr></table>";

}

function getUserType(ptr){
	if((ptr!='') && (ptr !=2)){
		$.ajax({
			type: "POST",
			url: "classes/user-class.php",
			data: "user_type="+ptr+"&type=getusertype&user_name=abc",
			success: function(msg){
				document.getElementById('ajax-user-type').innerHTML=msg;
			}
		});
	}else{
		document.getElementById('ajax-user-type').innerHTML="";
	}

}
function getTeamLeader(ptr){
	if(ptr!=''){
		$.ajax({
			type: "POST",
			url: "classes/user-class.php",
			data: "teamleader_id="+ptr+"&type=getTeamLeader",
			success: function(msg){
				document.getElementById('ajax-user-type').innerHTML=msg;
			}
		});
	}
}
