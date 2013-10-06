<?php 
	session_start();
	require 'config.php';
	if(isset($_SESSION['User']) && !empty($_SESSION['User'])){
	session_destroy();
	//header('Location: '.$base_url);	
	echo '<script>window.location="http://test.vizzmedia.com/facebookapp/bfj/"</script>';
}

?>