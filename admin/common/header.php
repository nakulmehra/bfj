
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shiso Bright</title>

<link href="css/styles.css" rel="stylesheet" type="text/css" />

		<style type="text/css">	.undefined{display:none!important;}	</style>	
	</head>

<body>
<div id="contatiner">
    <!-- START HEADER -->
    <div id="header">
        <!-- START LOGO -->
        <div id="logo">
          <a href="#"><img SRC="images/logo.png" alt="Your Logo" width="350" height="33" border="0" /></a> </div>
        <!-- END LOGO -->
        <div id="settings"><a href="settings_feature.php"><img src="images/Settings.png" width="36" height="36" border="0" /></a></div>
        <!-- START PANEL -->
        <div id="panel">
        <!-- dynamic login name-->
		<p>&nbsp;&nbsp;Welcome  <strong><?= ucwords($_SESSION['fullname']) ?></strong>| <a href="logout.php"><strong>Logout</strong></a></p> 
		<!-- dynamic login name-->
        </div>
        <!-- END PANEL -->
    </div>
    <!-- END HEADER -->	