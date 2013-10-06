<?php
	require 'config.php';

	if(isset($_POST['type']) && ($_POST['type']=='addprofiledetails')){
		$dt=date('Y-m-d');
		$user_id=$_POST['user_id'];
		$user_name=$_POST['user_name'];
		$user_email=$_POST['user_email'];
		$invite_user_id=array();
		$invite_user_name=array();
		$invite_user_id=explode(',',$_POST['article']);
		$invite_user_name=explode(',',$_POST['invite_friend_name']);
		for($a=0; $a < count($invite_user_id); $a++){
			$qry="select * from tbl_invite_friend where user_id='".$user_id."' and invite_user_id='".$invite_user_id[$a]."'";
			$result=mysql_query($qry);
			$count_invite_user_id=mysql_num_rows($result);
			
			if($count_invite_user_id==0){
				mysql_query("insert into tbl_invite_friend set
				user_id='".$user_id."',
				user_name='".$user_name."',
				user_email='".$user_email."',
				invite_user_id='".$invite_user_id[$a]."',
				invite_user_name='".$invite_user_name[$a]."',
				date_created='$dt'");
			}
		}
	}

?>
