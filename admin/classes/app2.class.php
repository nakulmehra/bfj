<?php
	ob_start();
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page = 1;
	}
	$countalldata=Admin::countAllData('tbl_apptwo');
	$allContacts = Admin::getAllData($page,'tbl_apptwo');
	
	if(isset($_GET['delete'])){ 
		Admin::singleDelete($_GET['delete'],'tbl_apptwo');
		$errorMsg = "Record Deleted sucessfully.";
		echo '<script>window.location="app2.php"</script>';
	}
	if(isset($_POST['delall'])){ 
		if(!isset($_POST["chkarray"])){
			echo '<script>alert("No record select to delete")</script>';
		}else{
			for($a=0; $a < count($_POST["chkarray"]); $a++){
				Admin::singleDelete($_POST["chkarray"][$a],'tbl_apptwo');
			}
			echo '<script>window.location="app2.php"</script>';
		}
	}
	if(isset($_POST['expBtn'])){ 
		$expdata = Admin::getAllDataExp('tbl_apptwo');
		$coloumn="First_name,Last_name,Birthday,Hometown,Location,Gender,Email,Comment,Employer,Position,Type,Date<br/>";
		foreach($expdata as $row):
			$output .= '"'.$row['first_name'].'","'.$row['last_name'].'","'.$row['birthday'].'","'.$row['hometown'].'","'.$row['location'].'","'.$row['gender'].'","'.$row['email'].'","'.$row['comment'].'","'.$row['employer'].'","'.$row['position'].'","'.$row['btn_type'].'","'.date("d-m-Y",strtotime($row[' 	date_created'])).'"'."\n";
			$orno ++;
		endforeach;
		$output = $coloumn . $output;
		ob_clean();
		header("Pragma: public");
		header("Expires: 0"); 
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
		header("Cache-Control: private",false);
		header("Content-Description: File Transfer");
		header("Content-Type: application/force-download"); 
		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=shisobright" . date("Y-m-d-H-i-s"). ".csv;" ); 
		header("Content-Transfer-Encoding: binary");
		echo $output;
		exit();
	}
	
	
	function genPagination($total,$current_page,$url) {
		$total_pages = ceil($total/10);
		if($total_pages>1)	{
			if ( $current_page <= 0 || $current_page > $total_pages ){
				$current_page = 1;
			}
			$start_page = ceil($current_page/10);
			$page = (($start_page-1)*10)+1;
			if($current_page!=1){
				printf("<a href='$url&page=1'>First</a>");
				printf("<a href='$url%d'> Previous</a>",$current_page-1);
			}else{
			 printf("<span>First</span>");
			 printf("<span>Previous</span>");
			}
			if($current_page >10){
				printf( "<a href='$url%d'>...</a> \n" , ($page-1));
			}
			   printf(" ");
			for($i = $page;$i<=$page+9; $i++){    
				if ($i < 1)
					continue;
				if ( $i > $total_pages )
					break;
				if ( $i != $current_page ) {
					printf( "<a href='$url%1\$d'>%1\$d</a> \n" , $i);
				} else {
					printf("<strong>%1\$d</strong>\n",$i);
				}   
			}
			printf(" ");
			if($page+9<$total_pages){
				printf( "<a href='$url%d'>...</a> \n" , ($i));
			}
			if($current_page!=$total_pages)	{
				printf("<a href='$url%d'>Next </a>",$current_page+1);
				printf("<a href='$url$total_pages'>Last</a>");
			}else{
			  printf("<span>Next</span>");
			  printf("<span>Last</span>");
			}
		}
	}
?>