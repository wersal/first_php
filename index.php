<?
error_reporting(E_ALL);
session_start();
include_once "libka/libka3.php";
include_once "libka/2libka3.php";
date_default_timezone_set('Europe/Kiev');

foreach($_REQUEST as $key => $value) {
	if(isset($$key)) unset($$key);
}
if (get_magic_quotes_gpc()) {
	$_GET = array_map('stripslashes', $_GET);
	$_POST = array_map('stripslashes', $_POST);
	$_COOKIE = array_map('stripslashes', $_COOKIE);
	$_SESSION = array_map('stripslashes', $_SESSION);
	$_SERVER = array_map('stripslashes', $_SERVER);
}
ini_set("magic_quotes_gpc","0");
ini_set("magic_quotes_runtime","0");
ini_set('display_errors','On');
ini_set("output_buffering","On");

$nowtime=time();
//print_r($_SESSION);
//print_r("_______");
//print_r($_COOKIE);
//print_r("_______");
//print_r(md5("Гість"));
//print_r("_______");
//print_r(md5("Користувачі"));

$lng="ua";

global $error_list;
$error_list=array();
global $msg_list;
$msg_list=array();

$statist = new Initing($_SERVER,$_COOKIE,$_SESSION);

//ініціалізація

$statist2=$statist->try_init($nowtime);


print_r($statist2);
if($statist2==false){
	$statist->un_ses();
	$statist->un_cook();
	echo '<meta http-equiv="content-type" content="text/html; charset=UTF-8" />';
	echo '<h1>Сталась помилка - перезавантажте сторінку!</h1>';
	echo '<h1>Произошла ошибка - перезагрузите страницу!</h1>';
	echo '<h1>There was error  - reload the page!</h1>';
}
$routing = new Get_inform($_GET,$_POST);
$routing2=$routing->select_data($statist2);
print_r("___________");
print_r($routing2);
//if($statist2==="no_data") {
//$statist3=$statist->reg_guest();
//}
//print_r($statist3);
//print_r($error_list);
$temp=mysql_fetch_assoc(mysql_query("SELECT * from path WHERE path_name='{$routing2['path_name']}'"));
$disloc=$temp["disloc-".$lng];
$dislocation=$temp["dislocation-".$lng];
$content=$temp["full_path"];
if(!empty($statist2['last_act'])) {
	$last_act=$statist2['last_act'];
}
else {
	$last_act=$nowtime;
}
$aaa=mysql_query("SELECT menu_".$lng.", path_name from path");
//print_r($aaa);
$i=mysql_num_rows($aaa);
for($i; $i>0; $i--) {
	$menu_name['']=;
}
print_r($i);

include "path/index.html";
?>
