<?php
error_reporting(0);
session_start();
include('../common/config.php');
include('../common/functions.php');
include("../common/adminclass.php");

if($_POST['page']){
	$page = $_POST['page'];
	$cur_page = $page;
	$page -= 1;
	$per_page = 20;
	$previous_btn = true;
	$next_btn = true;
	$first_btn = true;
	$last_btn = true;
	$start = $page * $per_page;
	$search='';
	$field='';
	$orderby='';

	if(isset($_POST['searchval']) && ($_POST['searchval'] !='') && (!isset($_POST['field'])) && (!isset($_POST['orderby']))){
		$search=$_POST['searchval'];
		$count=Admin::countDataBySearch('invite_friend',array(),array(),array('user_name','user_email'),$search,'user_id');
		$alldata=Admin::getDataForPagination('invite_friend',array(),array(),array('user_name','user_email'),$search,array('id'=>'desc'),'user_id',$start,$per_page);
		
	}elseif(isset($_POST['field']) && isset($_POST['orderby']) && ($_POST['field']!='') && ($_POST['orderby']!='') && (!isset($_POST['searchval']))){
		$field=$_POST['field'];
		$orderby=$_POST['orderby'];
		$count=Admin::countDataBySearch('invite_friend',array(),array(),array(),'','user_id');
		$alldata=Admin::getDataForPagination('invite_friend',array(),array(),array(),'',array($field=>$orderby),'user_id',$start,$per_page);
		
	}elseif(isset($_POST['searchval']) && ($_POST['searchval'] !='') && (isset($_POST['field'])) && (isset($_POST['orderby']))){
		$field=$_POST['field'];
		$orderby=$_POST['orderby'];
		$search=$_POST['searchval'];
		$count=Admin::countDataBySearch('invite_friend',array(),array(),array('user_name','user_email'),$search,'');
		$alldata=Admin::getDataForPagination('invite_friend',array(),array(),array('user_name','user_email'),$search,array($field=>$orderby),'',$start,$per_page);

	}else{
		$count=Admin::countDataBySearch('invite_friend',array(),array(),array(),'','user_id');
		$alldata=Admin::getDataForPagination('invite_friend',array(),array(),array(),'',array('id'=>'desc'),'user_id',$start,$per_page);
		
	}

	$msg='';
    $msg .="<div class=\"search\">";
    $msg .="<table border=\"0\" align=\"right\" cellpadding=\"0\" cellspacing=\"0\">";
    $msg .="<tr>";         
    $msg .="<td><input name=\"searchval\" type=\"text\" class=\"input\" id=\"searchval\" style=\"width:150px;height:22px;\" onkeypress=\"getSearchValue(event)\"/></td>";
	
    $msg .="<td><input name=\"search\" type=\"button\" id=\"search\" class=\"button\" value=\"Search\" onclick=\"getSearchValue('srch')\"/></td>";
	
	$msg .="<td><input name=\"export\" type=\"button\" id=\"export\" class=\"button\" value=\"Export\" onclick=\"getExport('user')\"/></td>";
	
	$msg .="<td><input name=\"addnew\" type=\"button\" id=\"addnew\" class=\"button\" value=\"Add New\" onclick=\"{window.location='add_user.php'}\" /></td>";
	
	$msg .="<td><input name=\"\" type=\"button\" id=\"\" class=\"button\" value=\"View All\" onclick=\"goToViewAll()\"/></td>";
    $msg .="</tr>";
    $msg .="</table>";
    $msg .="</div>";
	
	
	$msg .="<div class=\"cls\"></div>";
    $msg .="<div id=\"tabs\" style=\"width:900px; overflow:auto;\">";   	
	
    $msg .=" <div style=\"font-size:10px; color:red; float:right;\">Total : <strong>".$count."</strong> Found.</div>";
	$msg .="<form name='userFrm' id='userFrm' method='post' action='' >";
	$msg .="<div class=\"cls\"></div>";
	$msg .="<table border=\"0\" id=\"table\" cellspacing=\"2\" style=\"border: #CCC solid 1px;\" cellpadding=\"0\" align=\"center\"  width=\"100%\">";
	$msg .="<tr>";
	$msg .="<th><input type=\"checkbox\" onclick=\"checkedAll()\" /></th>";
	
	$msg .="<th>Name";
	$msg .="&nbsp;&nbsp;<span id='orderby_user_name_div'><img src='images/up-arrow.png' onclick=\"goToUp('user_name','asc','orderby_user_name_div')\"></span>";
	$msg .="</th>";
	
	$msg .="<th>Email";
	$msg .="&nbsp;&nbsp;<span id='orderby_name_div'><img src='images/up-arrow.png' onclick=\"goToUp('user_email','asc','orderby_name_div')\"></span>";
	$msg .="</th>";		
	$msg .="<th>No of Invites</th>";
	$msg .="<th>Action</th>";
	$msg .="</tr>";
	foreach($alldata as $row){
		$count_invite=Admin::countData('invite_friend',array('user_id'=>$row['user_id']),array());
		$msg .="<td align=\"center\">";
		$msg .="<input name=\"check_all[]\" type=\"checkbox\" value='".$row['id']."' />";
		
		$msg .="</td>";
		
		$msg .="<td align=\"center\" >".ucwords($row['user_name'])."</td>";
		
		$msg .="<td align=\"center\" >".$row['user_email']."</td>";
		
		$msg .="<td align=\"center\" >".$count_invite;
		
		$msg .="</td>";
		
		$msg .="<td align=\"center\" >";
		
		$msg .="<a href='javascript:void(0)' onclick=\"deleteSingle(".$row['id'].")\" class=\"table-icon delete\" title=\"Delete\" ></a>";
		
		$msg .="</td>";
		$msg .="</tr>"; 
	}
	if($count==0){
		$msg .="<tr><td align='center' colspan='11'>No Record Found...</td></tr>";
	}
	$msg .="<tr><td align='center'>&nbsp;</td></tr>";
	$msg .="<tr>";
	$msg .="<td align='center' >";
	$msg .="<input type='button' value='Delete All'; onclick=\"deleteAll()\">";
	$msg .="</td>";
	$msg .="<td colspan='13'>&nbsp;</td>";
	$msg .="</tr>";
	$msg .="</table>";
	$msg .="</form>";
	$msg .="</div>";
	$msg = "<div class='data' id='data'>" . $msg . "</div>";
	
	/****Content for Data***/
    	
/* ------------ */

$no_of_paginations = ceil($count / $per_page);
/* ---------------Calculating the starting and endign values for the loop-------- */
if ($cur_page >= 7) {
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;
    }
} else {
    $start_loop = 1;
    if ($no_of_paginations > 7)
        $end_loop = 7;
    else
        $end_loop = $no_of_paginations;
}
/* ---------------------------------------- */
	$msg .= "<div class='pagination'><ul>";
	/*FOR ENABLING THE FIRST BUTTON*/
	if ($first_btn && $cur_page > 1) {
		$msg .= "<li p='1' class='active' onClick='changePage(1)' >First</li>";
	} else if ($first_btn) {
		$msg .= "<li p='1' class='inactive'>First</li>";
	}

	/*FOR ENABLING THE PREVIOUS BUTTON*/
	if ($previous_btn && $cur_page > 1) {
		$pre = $cur_page - 1;
		$msg .= "<li p='$pre' class='active' onClick='changePage({$pre})'>Previous</li>";
	} else if ($previous_btn) {
		$msg .= "<li class='inactive'>Previous</li>";
	}
	for ($i = $start_loop; $i <= $end_loop; $i++) {
		if ($cur_page == $i)
			$msg .= "<li p='$i' style='color:#fff;background-color:#006699;' class='active' onClick='changePage({$i})' >{$i}</li>";
		else
			$msg .= "<li p='$i' class='active' onClick='changePage({$i})' >{$i}</li>";
	}

	/*TO ENABLE THE NEXT BUTTON*/
	if ($next_btn && $cur_page < $no_of_paginations) {
		$nex = $cur_page + 1;
		$msg .= "<li p='$nex' class='active' onClick='changePage({$nex})' >Next</li>";
	} else if ($next_btn) {
		$msg .= "<li class='inactive'>Next</li>";
	}

	/*TO ENABLE THE END BUTTON*/
	if ($last_btn && $cur_page < $no_of_paginations) {
		$msg .= "<li p='$no_of_paginations' class='active' onClick='changePage({$no_of_paginations})' >Last</li>";
	} else if ($last_btn) {
		$msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
	}
	$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;' /><input type='button' id='go_btn' class='go_button' value='Go' onClick='goToNumberPage()'/>";
	$total_string = "<span class='total' a='$no_of_paginations'>Page <b>".$cur_page. "</b> of <b>$no_of_paginations</b></span>";
	$msg = $msg."</ul>".$goto.$total_string."</div>";
	/*Content for pagination*/
	echo $msg;
	exit;
}
/**********end here*************/
if(isset($_POST['id']) && isset($_POST['type']) && $_POST['type']=='deletesingle'){
	Admin::singleDelete('invite_friend',array('id'=>$_POST['id']),array());
	echo '1';
	exit;
}
if(isset($_POST['type']) && ($_POST['type']=='deleteAll')){
	if($_POST['id']==''){
		echo 1;
		exit;
	}else{
		$id=explode(',',$_POST['id']);
		Admin::deleteAll('invite_friend','id',$id);
		echo 2;
		exit;
	}
}



?>
