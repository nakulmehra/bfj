<?php
	error_reporting(0);
	session_start();
	$errorMsg ="";
	if($_SESSION['login']!='1')	{
		header("Location:index.php");
	}
	include("common/config.php");
	include("common/adminclass.php");
	include("common/header.php");
	include("common/menu.php");
	if(isset($_POST['passwdChngBtn'])){
		$chkId = Admin::checkuser(md5($_SESSION['username']),md5($_POST['oldpsswd']));
		if($_POST['oldpsswd']==""){
			$errorMsg="Enter old password cannont be blank";
		}elseif($_POST['newpasswd']==""){
			$errorMsg="New password cannot be blank";
		}elseif($chkId < 1){
			$errorMsg="Old password not found";
		}else{
			$qry = "update tbl_users set
				password = '".$_POST['newpasswd']."', 
				md5password = '".md5($_POST['newpasswd'])."'
				where md5username = '".md5($_SESSION['username'])."' and md5password = '".md5($_POST['oldpsswd'])."'";
			$id = mysql_query($qry);
			if($id){
				session_destroy();
				echo '<script>alert("Password changed sucessfully")</script>';
				echo '<script>window.location="index.php"</script>';
			}
		}
	}
	
?>
<style>
.fixedHead{ width:901px !important;}
.FixedTables{ width:900px!important;}
.tableDiv {hight:200px!important;}
.tableDiv table{ width:900px!important;}
.fixedTable{ height:210px!important; width:920px!important;}
.fixedFoot th{ height:29px; width:150px;}
.fixedFoot td{ height:29px; width:140px;}

</style>
<script>
//<![CDATA[
/* Table header Fix Script */
		$(document).ready(function() {
		
            sh_highlightDocument();

            $(".tableDiv").each(function() {
                var Id = $(this).get(0).id;
                var maintbheight = 300;  // change the hight acording to record searcher
                var maintbwidth = 918;

                $("#" + Id + " .FixedTables").fixedTable({
                    width: maintbwidth,
                    height: maintbheight,
                 // fixedColumns: 1,
                    classHeader: "fixedHead",
                 // classFooter: "fixedFoot",
                 // classColumn: "fixedColumn",
                    fixedColumnWidth: 0,
                    outerId: Id,
                 // Contentbackcolor: "#FFFFFF",
                 // Contenthovercolor: "#99CCFF",
                 // fixedColumnbackcolor:"#187BAF",
                 // fixedColumnhovercolor:"#99CCFF"
                });
            });
        });
	
	
	/* Tab menu script start */
		$(function() {
			$( "#tabs" ).tabs();
		});
		
		//]]>
	</script>
<!-- START CONTENT -->
<div id="content">
  <div class="h1">Settings </div>
  <div  id="tabs">
    <ul>
		<li class="ui-tabs-selected"><a href="#tabs-1">Password Setting</a></li>
    </ul>
    <div id="tabs-1">
      <!--PASSWORD CHANGE-->
      <form action="" name="passfrm" method="post" id="passfrm" onsubmit="return postPasswdChange();">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="2" id="errormsg" align="center"></td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<span class="style1">Old Password <b class="req" >*</b></span>
				</td>
				<td align="left" valign="top">
					<input name="oldpsswd" type="password" class="input1" id="oldpsswd" />
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<span class="style1">New Password <b class="req" >*</b> </span>
				</td>
				<td align="left" valign="top">
					<input name="newpasswd" type="password" class="input1" id="newpasswd" />
				</td>
			</tr>
			<tr>
				<td align="left" valign="top">
					<span class="style1">Confirm Password <b class="req" >*</b> </span>
				</td>
				<td align="left" valign="top">
					<input name="conpasswd" type="password" class="input1" id="conpasswd" />
				</td>
			</tr>
			<tr>
				<td align="left" valign="top" height="5"></td>
				<td align="left" valign="top" height="5"></td>
			</tr>
			<tr>
				<td align="left" valign="top">&nbsp;</td>
				<td align="left" valign="top">
					<input type="hidden" name="process" id="process" value="1">
					<input type="hidden" name="resubmitFormValuepass" id="resubmitFormValuepass" value="<?=$_SESSION["resubmitForm"]?>" />
					<input type="submit" class="submit" value="Submit" name="passwdChngBtn" id="passwdChngBtn"/>
					<input name="reset" type="reset" class="submit" value="Reset" />
				</td>
			</tr>
        </table>
      </form>
    </div>
    <div class="cls"></div>
  </div>
</div>
<!-- END CONTEMT -->
<?php include("common/footer.php") ?>
