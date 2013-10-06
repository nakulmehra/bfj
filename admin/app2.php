<?php
	error_reporting(0);
	session_start();
	if($_SESSION['login']!='1')	{
		header("Location:index.php");
	}
	include("common/config.php");
	include("common/adminclass.php");
	include("classes/app2.class.php");
	include("common/header.php");
	include("common/menu.php");
?>
	<script language='JavaScript'>
		checked = false;
		function checkedAll () {
			if (checked == false){checked = true}else{checked = false}
			for (var i = 0; i < document.getElementById('maincontactfrm').elements.length; i++) {
				document.getElementById('maincontactfrm').elements[i].checked = checked;
			}
		}
    </script>
	<style type="text/css">
	.undefined{display:none!important;}
	</style>
    
	
	<div id="content">
	<div class="cls"></div>
	<div  id="tabs" style="background-color:#FFFFFF">
		<div id="tableDiv_Arrays" class="tableDiv" >
			<form action="" id="maincontactfrm" name="maincontactfrm" method="post" >
				<span style="margin-left: 17px;"><input type="submit" value="Export" id="expBtn" name="expBtn">
				<td><input type="submit" name="delall" id="delall" value="Delete"></td></span>
				
				<table  cellpadding="0" width="75%" cellspacing="0" id="box-table" summary="Employee Pay Sheet" class="FixedTables">
			<thead>
				<tr>
				<th align="center"><input class="check-all" type="checkbox" name="contactlistcheckbox" onclick='checkedAll();' /></th>
				<th align="center"><div style="width:120px;">Coupon Code </div></th>
				<th align="center"><div style="width:120px;">Name </div></th>
                <th align="center"><div style="width:107px;">Email</div> </th>
                <th align="center"><div style="width:110px;">Mobile</div></th>
                <th align="center"><div style="width:100px;">Date</div> </th>
                <th align="center"><div style="width:80px;">Action</div></th>
              </tr>
            </thead>
			<tbody>
			<?php if($countalldata > 0){ ?>
			<?php foreach($allContacts as $row) : ?>
              <tr>
				<td align="center"><input type="checkbox" name="chkarray[]" value="<?php echo $row['id'] ?>"></td>
				<td align="center"><?php echo $row['coupon_code'] ?></td>
                <td align="center"><?php echo $row['name'] ?></td>
                <td align="center"><?php echo $row['email'] ?></td>
                <td align="center"><?php echo $row['mobile'] ?></td>
                <td align="center"><?php echo date('d-m-Y', strtotime($row['date_created'])) ?></td>
                <td align="center">
					<a href="app2.php?delete=<?php echo $row['id'] ?>"  title="Delete">
						<img SRC="images/icons/cross.png" onclick="javascript: var r = confirm('Are You Sure Want to Delete?'); if (r==true){   } else  { return false;}"  alt="Delete" />
					</a>
				</td>
              </tr>
			<?php endforeach; ?>
			<?php }else{ ?>
				<tr>
					<td colspan="9" align="center">
						<strong>No Record Found...</strong>
					</td>
				</tr>
			<?php } ?>
            </tbody>
			<?php if($countalldata > 0){ ?>
			<tfoot>
				<tr>
					
					<td colspan="9">
						<div class="pagination" style="float:left; padding-top:10px;">
						<?php echo	genPagination($countalldata,$page,'app2.php?page=') ?>
						</div>
					</td>
				</tr>
			</tfoot>
			<?php } ?>
		</table>
  </form>
</div>
	<span class="clear"></span>
	</div>
	</div>
	
	<!-- END CONTEMT -->
	<?php include("common/footer.php") ?>

