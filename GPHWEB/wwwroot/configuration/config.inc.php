<?php
$WebTitle='《大闹天宫》';
$weburl='http://127.0.0.1:8089/';   //推广地址
$tgyuanbao='5000';         //每个IP获得元宝数
$db_type='mysql';
$db_charset='utf8';
$db_host='127.0.0.1:3306';
$db_username='root';
$db_password='123456';
$database='web';
$database2='dntg';
$lv='30';   //推广到达等级
$kg='1';   //游戏是否开启，1：开启，0：没有开启
$msg='游戏维护！'; //提示语
$maxnum="5";   //单个IP最大注册次数
$qq='  Www.lyzwlkj.vip  '; //客服QQ、YY等
$chongzhi='http://127.0.0.1:8008/'; //服务端接收充值地址
$wxyb='200';//无限元宝充值累计金额设置（元）
$wxybcount='3000000';//每次领取无限元宝数量

//////////////////////////////////////////////////////////////////////////////////
session_start();
$tgurl="";
if(empty($tgurl)) $url_this = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
else $url_this =$tgurl;
$conn = @mysql_connect("$db_host","$db_username","$db_password") or die ("数据库连接出错，请联系管理员 ".$qq."。");
@mysql_select_db("$database",$conn) or die ("数据库表不存在或者未连接。请联系管理员 。");
mysql_query("set names UTF8"); //使用文件编码，防止出错
function getIP()
{
if(!empty($_SERVER["HTTP_CLIENT_IP"]))
   $ip = $_SERVER["HTTP_CLIENT_IP"];
else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
   $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
else if(!empty($_SERVER["REMOTE_ADDR"]))
   $ip = $_SERVER["REMOTE_ADDR"];
else
   $ip = "无法获取！";
return $ip;
}

function passport_encrypt($txt, $key) { 
srand((double)microtime() * 1000000); 
$encrypt_key = md5(rand(0, 32000)); 
$ctr = 0; 
$tmp = ''; 
for($i = 0;$i < strlen($txt); $i++) { 
$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr; 
$tmp .= $encrypt_key[$ctr].($txt[$i] ^ $encrypt_key[$ctr++]); 
} 
return base64_encode(passport_key($tmp, $key)); 
} 

function passport_decrypt($txt, $key) { 
$txt = passport_key(base64_decode($txt), $key); 
$tmp = ''; 
for($i = 0;$i < strlen($txt); $i++) { 
$md5 = $txt[$i]; 
$tmp .= $txt[++$i] ^ $md5; 
} 
return $tmp; 
} 

function passport_key($txt, $encrypt_key) { 
$encrypt_key = md5($encrypt_key); 
$ctr = 0; 
$tmp = ''; 
for($i = 0; $i < strlen($txt); $i++) { 
$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr; 
$tmp .= $txt[$i] ^ $encrypt_key[$ctr++]; 
} 
return $tmp; 
}

function sysmd5($str,$key='',$type='sha1'){
	$key =  $key ?  $key : '702042941817d99ec8625d4deea81043';
	//return $key;
	return hash ( $type, $str.$key );
} 
?>

