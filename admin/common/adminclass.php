<?php
class  Admin {
public static function countData($tbl,$data,$fld) {
global $db;
$tbl="tbl_".$tbl;
$query = "SELECT count(*) count from $tbl where 1=1";
if(count($data) > 0){
foreach($data as $key=>$val):
$query .=" and $key='$val'";
endforeach;
}
if(count($fld) > 0){
foreach($fld as $key=>$val):
$query .=" and $key != '$val'";
endforeach;
}
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetch();
$stmt->closeCursor();
return $result['count'];
}

public static function getAll($tbl,$data,$fld,$ord,$group='') {
global $db;
$tbl="tbl_".$tbl;
$query = "SELECT * from $tbl where 1=1";
if(count($data) > 0){
foreach($data as $key=>$val):
$query .=" and $key='$val'";
endforeach;
}
if(count($fld) > 0){
foreach($fld as $key=>$val):
$query .=" and $key != '$val'";
endforeach;
}
if(isset($group) && ($group !='')){
$query .=" group by $group";
}
if(count($ord) > 0){
foreach($ord as $key=>$val):
$query .=" order by $key $val";
endforeach;
}
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();
$stmt->closeCursor();
return $result;
}
public static function getSingle($tbl,$data,$fld) {
global $db;
$tbl="tbl_".$tbl;
$query = "SELECT * from $tbl where 1=1";
if(count($data) > 0){
foreach($data as $key=>$val):
$query .=" and $key='$val'";
endforeach;
}
if(count($fld) > 0){
foreach($fld as $key=>$val):
$query .=" and $key != '$val'";
endforeach;
}
$query .=" limit 1";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetch();
$stmt->closeCursor();
return $result;	
}

public static function update($tbl,$data,$fld){
global $db;
$tbl="tbl_".$tbl;
$query = "update $tbl set";
$a=1;
if(count($data) > 0){
foreach($data as $key=>$val):
$query .=" $key='".mysql_real_escape_string($val)."'";
if(($a < count($data)) && (count($data) > 1)){
$query .=",";
}
$a++;
endforeach;
}
if(count($fld) > 0){
$query .=" where 1=1";
foreach($fld as $key=>$val):
$query .=" and $key='".$val."'";
endforeach;
}

$stmt = $db->prepare($query);
$stmt->execute();
$result=$stmt->rowCount();
$stmt->closeCursor();
return $result;
} 
public static function insert($tbl,$data){
global $db;
$tbl="tbl_".$tbl;
$query = "insert into $tbl set";
$a=1;
if(count($data) > 0){
foreach($data as $key=>$val):
$query .=" $key='".mysql_real_escape_string($val)."'";
if(($a < count($data)) && (count($data) > 1)){
$query .=",";
}
$a++;
endforeach;
}

$stmt = $db->prepare($query);
$stmt->execute();
$result=$stmt->rowCount();
$stmt->closeCursor();
$id=$db->lastInsertId();
return $id;
}

public static function countMultipleData($tbl,$f1,$f1v) {
global $db;
$query = "SELECT count(*) count from $tbl where $f1 in(" . implode(",", $f1v) . ")";		$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetch();
$stmt->closeCursor();
return $result['count'];
}
public static function deleteAll($tbl, $f1, $f1v){
global $db;	
$tbl="tbl_".$tbl;	
$query = "DELETE FROM $tbl WHERE $f1 in(" . implode(",", $f1v) . ")";
$stmt = $db->prepare($query);		
$stmt->execute();		
$result=$stmt->rowCount();		
$stmt->closeCursor();		
return $result;	
}
public static function singleDelete($tbl,$data,$fld){
global $db;
$tbl="tbl_".$tbl;
$query = "DELETE FROM $tbl";
if(count($data) > 0){
$query .=" where 1=1";
foreach($data as $key=>$val):
$query .=" and $key='".$val."'";
endforeach;
}
if(count($fld) > 0){
foreach($fld as $key=>$val):
$query .=" and $key != '$val'";
endforeach;
}
$stmt = $db->prepare($query);
$stmt->execute();
$result=$stmt->rowCount();
$stmt->closeCursor();
return $result;
}


public static function countDataBySearch($tbl,$data,$fld,$field,$search='',$group='') {
	global $db;
	$tbl="tbl_".$tbl;
	$query = "SELECT count(*) count from $tbl where 1=1";
	if(count($data) > 0){
		foreach($data as $key=>$val):
			$query .=" and $key='$val'";
		endforeach;
	}
	if(count($fld) > 0){
		foreach($fld as $key=>$val):
			$query .=" and $key != '$val'";
		endforeach;
	}
	if((count($field) > 0) && ($search !='')){
		$query .=" and (";
		for($a=0;$a<count($field);$a++){
			$query .=" $field[$a] like '%".$search."%'";
			if($a < (count($field)-1)){
				$query .=" or";
			}
		}
		$query .=")";
	}
	if(isset($group) && ($group !='')){
		$query .=" group by $group";
	}
	$stmt = $db->prepare($query);
	$stmt->execute();
	$result = $stmt->fetch();
	$stmt->closeCursor();
	return $result['count'];
}

public function getDataForPagination($tbl,$data,$fld,$field,$search,$ord,$group,$start,$per_page){
	global $db;
	$tbl="tbl_".$tbl;
	$query = "SELECT * from $tbl where 1=1";
	if(count($data) > 0){
		foreach($data as $key=>$val):
			$query .=" and $key='$val'";
		endforeach;
	}
	if(count($fld) > 0){
		foreach($fld as $key=>$val):
			$query .=" and $key != '$val'";
		endforeach;
	}
	if((count($field) > 0) && ($search !='')){
		$query .=" and (";
		for($a=0;$a<count($field);$a++){
			$query .=" $field[$a] like '%".$search."%'";
			if($a < (count($field)-1)){
				$query .=" or";
			}
		}
		$query .=")";
	}
	if(isset($group) && ($group !='')){
		$query .=" group by $group";
	}
	if(count($ord) > 0){
		foreach($ord as $key=>$val):
			$query .=" order by $key $val";
		endforeach;
	}
	$query .=" LIMIT $start, $per_page";
	$stmt = $db->prepare($query);
	$stmt->execute();
	$result = $stmt->fetchAll();
	$stmt->closeCursor();
	return $result;
}

public static function getExport($tbl,$data,$fld,$field,$search,$group){	
	global $db;
	$tbl="tbl_".$tbl;
	$query = "SELECT * from $tbl where 1=1";
	if(count($data) > 0){
		foreach($data as $key=>$val):
			$query .=" and $key='$val'";
		endforeach;
	}
	if(count($fld) > 0){
		foreach($fld as $key=>$val):
			$query .=" and $key != '$val'";
		endforeach;
	}
	if((count($field) > 0) && ($search !='')){
		$query .=" and (";
		for($a=0;$a<count($field);$a++){
			$query .=" $field[$a] like '%".$search."%'";
			if($a < (count($field)-1)){
				$query .=" or";
			}
		}
		$query .=")";
	}
	if(isset($group) && ($group !='')){
		$query .=" group by $group";
	}
	$stmt = $db->prepare($query);
	$stmt->execute();
	$result = $stmt->fetchAll();
	$stmt->closeCursor();
	return $result;
}
	public static function getCurrentSegmentCount($tbl,$designation='',$state='',$city='',$industry_category='',$product_category='',$regions='',$source='') {
		global $db;
		$tbl="tbl_".$tbl;
		$query = "SELECT count(*) count from $tbl where 1=1";
		if($designation!=''){
			$query .=" and designation_1='$designation'";
		}
		if($state!=''){
			$query .=" or state='$state'";
		}
		if($city!=''){
			$query .=" or city='$city'";
		}
		if($industry_category!=''){
			$query .=" or industry_category='$industry_category'";
		}
		if($product_category!=''){
			$query .=" or product_category='$product_category'";
		}
		if($region!=''){
			$query .=" or region='$region'";
		}
		if($regions!=''){
			$query .=" or region='$regions'";
		}
		if($source!=''){
			$query .=" or info_source='$source'";
		}
		$query .=" and segment_status='open' and segment='0' and caller_id='0' and  	segment_create_date=''";
		$stmt = $db->prepare($query);
		$stmt->execute();
		$result = $stmt->fetch();
		$stmt->closeCursor();
		return $result['count'];
	}
	public static function getAllCurrentSegment($tbl,$designation='',$state='',$city='',$industry_category='',$product_category='',$regions='',$source='') {
		global $db;
		$tbl="tbl_".$tbl;
		$query = "SELECT * from $tbl where 1=1";
		if($designation!=''){
			$query .=" and designation_1='$designation'";
		}
		if($state!=''){
			$query .=" or state='$state'";
		}
		if($city!=''){
			$query .=" or city='$city'";
		}
		if($industry_category!=''){
			$query .=" or industry_category='$industry_category'";
		}
		if($product_category!=''){
			$query .=" or product_category='$product_category'";
		}
		if($region!=''){
			$query .=" or region='$region'";
		}
		if($regions!=''){
			$query .=" or region='$regions'";
		}
		if($source!=''){
			$query .=" or info_source='$source'";
		}
		$query .=" and segment_status='open' and segment='0' and caller_id='0' and  	segment_create_date=''";
		$stmt = $db->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$stmt->closeCursor();
		return $result;
	}
	public static function countContactDataBySearch($tbl,$data,$fld,$field,$search='',$group='',$user_type='',$user_id=''){
		global $db;
		$tbl="tbl_".$tbl;
		$query = "SELECT count(*) count from $tbl where 1=1";
		if(isset($user_type) && ($user_type!='') && isset($user_id) && ($user_id!='')){
			if($user_type==1){
				
			}elseif($user_type==2){
				$query .=" and supervisor_id='$user_id'";
			}elseif($user_type==3){
				$query .=" and team_leader_id='$user_id'";
			}elseif($user_type==4){
				$query .=" and caller_id='$user_id'";
			}
		}
		if(count($data) > 0){
			foreach($data as $key=>$val):
				$query .=" and $key='$val'";
			endforeach;
		}
		if(count($fld) > 0){
			foreach($fld as $key=>$val):
				$query .=" and $key != '$val'";
			endforeach;
		}
		if((count($field) > 0) && ($search !='')){
			$query .=" and (";
			for($a=0;$a<count($field);$a++){
				$query .=" $field[$a] like '%".$search."%'";
				if($a < (count($field)-1)){
					$query .=" or";
				}
			}
			$query .=")";
		}
		if(isset($group) && ($group !='')){
			$query .=" group by $group";
		}
		$stmt = $db->prepare($query);
		$stmt->execute();
		$result = $stmt->fetch();
		$stmt->closeCursor();
		return $result['count'];
	}
	public function getContactsDataForPagination($tbl,$data,$fld,$field,$search,$ord,$group,$start,$per_page,$user_type='',$user_id=''){
		global $db;
		$tbl="tbl_".$tbl;
		$query = "SELECT * from $tbl where 1=1";
		if(isset($user_type) && ($user_type!='') && isset($user_id) && ($user_id!='')){
			if($user_type==1){
				
			}elseif($user_type==2){
				$query .=" and supervisor_id='$user_id'";
			}elseif($user_type==3){
				$query .=" and team_leader_id='$user_id'";
			}elseif($user_type==4){
				$query .=" and caller_id='$user_id'";
			}
		}
		if(count($data) > 0){
			foreach($data as $key=>$val):
				$query .=" and $key='$val'";
			endforeach;
		}
		if(count($fld) > 0){
			foreach($fld as $key=>$val):
				$query .=" and $key != '$val'";
			endforeach;
		}
		if((count($field) > 0) && ($search !='')){
			$query .=" and (";
			for($a=0;$a<count($field);$a++){
				$query .=" $field[$a] like '%".$search."%'";
				if($a < (count($field)-1)){
					$query .=" or";
				}
			}
			$query .=")";
		}
		if(isset($group) && ($group !='')){
			$query .=" group by $group";
		}
		if(count($ord) > 0){
			foreach($ord as $key=>$val):
				$query .=" order by $key $val";
			endforeach;
		}
		$query .=" LIMIT $start, $per_page";
		
		$stmt = $db->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$stmt->closeCursor();
		return $result;
	}
	public static function getContactsExport($tbl,$data,$fld,$field,$search,$group,$user_type='',$user_id=''){	
		global $db;
		$tbl="tbl_".$tbl;
		$query = "SELECT * from $tbl where 1=1";
		if(isset($user_type) && ($user_type!='') && isset($user_id) && ($user_id!='')){
			if($user_type==1){
				
			}elseif($user_type==2){
				$query .=" and supervisor_id='$user_id'";
			}elseif($user_type==3){
				$query .=" and team_leader_id='$user_id'";
			}elseif($user_type==4){
				$query .=" and caller_id='$user_id'";
			}
		}
		if(count($data) > 0){
			foreach($data as $key=>$val):
				$query .=" and $key='$val'";
			endforeach;
		}
		if(count($fld) > 0){
			foreach($fld as $key=>$val):
				$query .=" and $key != '$val'";
			endforeach;
		}
		if((count($field) > 0) && ($search !='')){
			$query .=" and (";
			for($a=0;$a<count($field);$a++){
				$query .=" $field[$a] like '%".$search."%'";
				if($a < (count($field)-1)){
					$query .=" or";
				}
			}
			$query .=")";
		}
		if(isset($group) && ($group !='')){
			$query .=" group by $group";
		}
		$stmt = $db->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$stmt->closeCursor();
		return $result;
	}
}


?>

