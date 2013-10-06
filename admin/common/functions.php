<?php
function comp_days_system_user_date($dt){
$datetime1 = new DateTime($dt);
$datetime2 = new DateTime();
$interval = $datetime2->diff($datetime1);
return $interval->format('%R%a');
/*-1=user date less then current date,-0=same,+=user date greater then current date*/
}
function check_days_between_two_dates($startdate,$enddate,$type){
$timestamp_start = strtotime($startdate);
$timestamp_end = strtotime($enddate);
$difference = abs($timestamp_end - $timestamp_start);
if($type=='1'){
$days = floor($difference/(60*60*24));
return $days;
}elseif($type == '2'){
$months = floor($difference/(60*60*24*30));
return $months;
}elseif($type=='3'){
$years = floor($difference/(60*60*24*365));
return $years;
}
}
function check_two_dates($firstdate,$seconddate){
$first = strtotime($firstdate);
$second = strtotime($seconddate);
if ($first < $second) {return 1;
}elseif($first > $second){return -1;
}else{
return 0;
}}
function check_mobile_validity($phoneNumber){
if(preg_match('/^\d{10}$/',$phoneNumber)) {$phoneNumber = '0' . $phoneNumber;
return true;
}else {return false;
}}
function check_email_validity($email) {
$regexp = "/^[^0-9_.-][A-z0-9_.]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/";
if(preg_match($regexp,$email)){
return true;
}else{
return false;
}}
function check_username_validity($username){
return preg_match('/^[A-Z0-9]{2,20}$/i', $username);
}
function check_url_validity($url){
$len=strlen($url);
if ($len < 10)
return 0;
if((substr($url, 0, 7) != 'http://') && (substr($url, 0, 8) != 'https://'))
return 0;
$pos=strpos($url, '.');
if (($pos) && ($pos<$len-1)){
return 1;
}else{
return 0;
}
}
function unformatMoney($str) {
return preg_replace("/[,\s]/", "", preg_replace("/^[0]{1,20}/", "", $str));
}
function traceObject(&$expression) {
echo("<pre>");
print_r($expression);
echo("</pre>");
}
function decodeFloat($number, $decimals = 2) {
$number = str_replace(",", "", $number);
if ($number == "") {
return $number;
} else {$number = number_format($number, $decimals);
return $number;
}}
function moneyFormat($str, $precision=0) {
$str = "" . $str;
$str = sprintf("%.4f", unformatMoney($str));
if (!$str || strlen($str) <= 3)
return null;$precisionstr = "";
if (strpos($str, ".")) {
$M = explode(".", $str);
$str = $M[0];
$prclen = strlen($M[1]);
$precisionstr = $M[1] . "00000000";
if ($precision)$precisionstr = substr($precisionstr, 0, $precision);
else $precisionstr="";
}$str = unformatMoney($str);
$tmp = "";$tmpcount = 0;
$hsep = true;
$prev = 0;
for ($prev = strlen($str) - 1;
$prev >= 0;
$prev--) {
$tmp.=$str[$prev];
$tmpcount++;
if ($hsep && $tmpcount == 3 && $prev) {
$tmp.=",";
$hsep = false;$tmpcount = 0;
} else if (!$hsep && $tmpcount == 2 && $prev) {
$tmp.=",";
$tmpcount = 0;
}}
$str = "";
for ($prev = strlen($tmp) - 1;
$prev >= 0;
$prev--)$str.=$tmp[$prev];
return $str . ($precisionstr ? "." . $precisionstr : "");
}
function val($i){
if (($i == '') || ($i == NULL) || (!(is_numeric($i))) ||  (trim($i)==''))
return 0 ;
else return $i ;
}
function htmlSafeStr($str){
return trim(htmlentities($str, ENT_QUOTES, "UTF-8"));
}
function encrypt($string, $key = 'random') {
$result = '';
for($i=0; $i<strlen($string); $i++) {
$char = substr($string, $i, 1);
$keychar = substr($key, ($i % strlen($key))-1, 1);
$char = chr(ord($char)+ord($keychar));
$result.=$char;
}
return base64_encode($result);
}
function decrypt($string, $key = 'random') {
$result = '';
$string = base64_decode($string);
for($i=0; $i<strlen($string); $i++) {
$char = substr($string, $i, 1);
$keychar = substr($key, ($i % strlen($key))-1, 1);
$char = chr(ord($char)-ord($keychar));
$result.=$char;
}
return $result;
}
function setPasswrd($pass){
$response = encrypt($pass, "sahoo123");
return $response;
}
function getPasswrd($pass){
$response = decrypt($pass, "sahoo123");
return $response;
}
function generate_code($chars){
$r='';
for($i=0;$i<=($chars-1);$i++){
$r0 = rand(0,1);
$r1 = rand(0,2);
if($r0==0){$r .= chr(rand(ord('A'),ord('Z')));
}
elseif($r0==1){ $r .= rand(0,9);
}
if($r1==0){
$r = strtolower($r);
}
}
return $r;
}
function randomPassword() {
$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
$pass = array();
$alphaLength = strlen($alphabet) - 1;
for ($i = 0; $i < 8; $i++) {
$n = rand(0, $alphaLength);
$pass[] = $alphabet[$n];
}
return implode($pass);
}
function randomCode() {
$alphabet = "123456789";
$pass = array();
$alphaLength = strlen($alphabet) - 1;
for ($i = 0; $i < 8; $i++) {
$n = rand(0, $alphaLength);
$pass[] = $alphabet[$n];
}
return implode($pass);
}
function couponCode() {
$alphabet = "12345";
$pass = array(); 
$alphaLength = strlen($alphabet) - 1; 
for ($i = 0; $i < 5; $i++) {
$n = rand(0, $alphaLength);
$pass[] = $alphabet[$n];
}
return implode($pass);
}
function getFileExtension($str) {
$i = strrpos($str,".");
if (!$i) {
return "";
}
$l = strlen($str) - $i;
$ext = substr($str,$i+1,$l);
return $ext;
}
/*uploadFileToServer($_FILES["frmfile"], $uploaddir, $makeunique, "500", "gif,jpeg,jpg");*/
function uploadFileToServer($uploadedFile, $uploaddir, $makeunique, $allowedSizeKB, $allowedExt){
$uploadedFileName = $uploadedFile["name"];
$uploadedFileTempName = $uploadedFile["tmp_name"];
$uploadedFileSize = $uploadedFile["size"];
$isDeleted = 0;
if($allowedSizeKB > 0) {$maxFileSizeAllowed = $allowedSizeKB * 1024;
} else {
$maxFileSizeAllowed = 500*1024;
}$errorcomment = "";
$final_filename = "";
$pext = getFileExtension($uploadedFileName);
$pext = strtolower($pext);
if (!is_uploaded_file($uploadedFileTempName)) {
$errorcomment = $errorcomment.'Error in Uploading File ['.str_replace("\\", "\\\\", $uploadedFileTempName).']. Please try again.';
$isDeleted = 1;
}
if (is_uploaded_file($uploadedFileTempName)) {
$isExt = 1;
if($allowedExt != "") {
$fileFormat = explode(",", $allowedExt);
for($cnt=0;
$cnt < count($fileFormat);
$cnt++) {
if (($pext == $fileFormat[$cnt])) {
$isExt = 0;
}}}else {$isExt = 0;
}if($isExt == 1) {$errorcomment = 'File Extension Unknown.';
$errorcomment = $errorcomment.'Please upload only ' . $allowedExt . ' Extensions.';	$errorcomment = $errorcomment.' The file [' . $uploadedFile["name"] . '] you uploaded had the extension: '.$pext.'';
if (is_file($uploadedFileTempName)) {
$isDeleted = 1;
}}}
if ($isDeleted == 0) {if($uploadedFileSize > $maxFileSizeAllowed) {
$errorcomment = $errorcomment.'The file [' . $uploadedFile["name"] . '] you uploaded is too big. Allowed Size: ' . $maxFileSizeAllowed . ' bytes. Uploaded File Size: ' . $uploadedFileSize . ' bytes.';
$isDeleted = 1;
}}
if ($isDeleted == 0) {
$final_filename = str_replace(" ", "_", $uploadedFileName);
if(strtolower($makeunique) == "") {
$final_filename = date("YmdHis") . $pext;
}else {
$final_filename = $makeunique;
}}
$newfile = $uploaddir . $final_filename;
if ($isDeleted == 0) {
if (!move_uploaded_file($uploadedFileTempName, $newfile)) {
$errorcomment = $errorcomment.'Error in Uploading File [' . $uploadedFile["name"] . ']. Please try again.';
}}
if ($isDeleted == 1) {
@unlink($uploadedFileTempName);
}
return $final_filename . "|" . $errorcomment;
}
function getBrowser(){
$u_agent = $_SERVER['HTTP_USER_AGENT'];
$bname = 'Unknown';
$platform = 'Unknown';
$version= "";
if (preg_match('/linux/i', $u_agent)) {
$platform = 'linux';
}elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
$platform = 'mac';
}elseif (preg_match('/windows|win32/i', $u_agent)) {
$platform = 'windows';
}
if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
$bname = 'Internet Explorer';
$ub = "MSIE";
}elseif(preg_match('/Firefox/i',$u_agent)){
$bname = 'Mozilla Firefox';
$ub = "Firefox";
}elseif(preg_match('/Chrome/i',$u_agent)){
$bname = 'Google Chrome';
$ub = "Chrome";
}elseif(preg_match('/Safari/i',$u_agent)){
$bname = 'Apple Safari';
$ub = "Safari";
}elseif(preg_match('/Opera/i',$u_agent)){
$bname = 'Opera';
$ub = "Opera";
}elseif(preg_match('/Netscape/i',$u_agent)){
$bname = 'Netscape';
$ub = "Netscape";
}
$known = array('Version', $ub, 'other');
$pattern = '#(?' . join('|', $known) . ')[/ ]+(?[0-9.|a-zA-Z.]*)#';
if (!preg_match_all($pattern, $u_agent, $matches)) {
}
$i = count($matches['browser']);
if ($i != 1) {
if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
$version= $matches['version'][0];
}else {
$version= $matches['version'][1];
}
}else {
$version= $matches['version'][0];
}
if ($version==null || $version=="") {
$version="?";
}
return array('userAgent' => $u_agent,'name'=> $bname,'version'=> $version,        'platform'=>$platform,'pattern'=>$pattern);
}
function curPageURL() {
$pageURL = 'http';
if ($_SERVER["HTTPS"] == "on") {
$pageURL .= "s";
} $pageURL .= "://";
if ($_SERVER["SERVER_PORT"] != "80") {
$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; }else {$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
} return $pageURL;
}
function do_sms($mobile,$name){/*********SMS START HERE**********************/
$message=str_replace(' ', '+', $name);
$c = '91'.$mobile;$url = "http://www.vizz.in/sendsmsv2.asp";
$data = array("user"=>"mobipik","password" => "537772625","sender"=>"Internet",	"sendercdma"=>"919860609000","PhoneNumber"=> $c,"track" =>'1',"text" => $message,);$fields = '';
foreach($data as $key => $value):
$fields .= $key . '=' . $value . '&';
endforeach;
rtrim($fields, '&');
$fields = substr_replace($fields,"",-1);
$post = curl_init();
curl_setopt($post,CURLOPT_URL, $url);
curl_setopt($post, CURLOPT_POST, count($data));
curl_setopt($post, CURLOPT_POSTFIELDS,$fields);
curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($post);
curl_close($post);
return $result;
/**********SMS CLOSE HERE*******************/
}

?>