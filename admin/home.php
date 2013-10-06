<?php
	error_reporting(0);
	session_start();
	if($_SESSION['login']!='1')	{
		header("Location:index.php");
	}
	include("common/header.php");
	include("common/menu.php");
?>
<script type='text/javascript' src='js/home.js' ></script>
<script language='JavaScript'>
	checked = false;
	function checkedAll () {
		if (checked == false){checked = true}else{checked = false}
		for (var i = 0; i < document.getElementById('userFrm').elements.length; i++) {
			document.getElementById('userFrm').elements[i].checked = checked;
		}
	}
</script>
<style type="text/css">
.undefined{display:none!important;}
</style>


<div id="content">
<div class="cls"></div>
	<div id="loading"></div>
	<div id="container">
	<div class="pagination"></div>
	</div>
</div>
	
<!-- END CONTEMT -->
<?php include("common/footer.php") ?>

