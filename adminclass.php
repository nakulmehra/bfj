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

}


?>

