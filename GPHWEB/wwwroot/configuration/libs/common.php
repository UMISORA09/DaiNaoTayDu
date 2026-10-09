<?php
session_start();
$tgurl="";
if(empty($tgurl)) $url_this = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
else $url_this =$tgurl;
$conn = @mysql_connect("$db_host","$db_username","$db_password") or die ("数据库连接出错，请联系管理员 。");
@mysql_select_db("$accountdb",$conn) or die ("数据库表不存在或者未连接。请联系管理员 。");
mysql_query("set names UTF8"); //使用文件编码，防止出错

date_default_timezone_set('Asia/Shanghai');

function dbin($db,$table,$type) {
$dbin=mysql_query("INSERT INTO `$db`.`$table` $type");
return $dbin;
}

function dbst($db,$table,$type) {
$dbselect=mysql_query("SELECT * FROM `$db`.`$table` where $type");
$rowdbselect=mysql_fetch_array($dbselect);
return $rowdbselect;
}

function dbqy($db,$table,$type) {
$dbq=mysql_query("SELECT * FROM `$db`.`$table` $type");
while($rdb=mysql_fetch_array($dbq)){
$rdbq[]=$rdb;
}
return $rdbq;
}

function dbct($db,$table,$type) {
$dbqsun=mysql_query("SELECT count(id) FROM `$db`.`$table` $type");
$rdbsun=mysql_fetch_array($dbqsun);
return $rdbsun;
}

function dbdel($db,$table,$type) {
$dbdel=mysql_query("delete FROM `$db`.`$table` where $type");
return $rdel;
}


function dbup($db,$table,$type) {
$dbup=mysql_query("UPDATE `$db`.`$table` SET $type");
return $dbup;
}

function fjsxn($dbfjsxname) {
			switch($dbfjsxname){
					case 1:
						$fjsxname="[生命]";
						break;
					case 2:
						$fjsxname="[生命]";
						break;
					case 5:
						$fjsxname="[攻击]";
						break;
					case 6:
						$fjsxname="[攻击]";
						break;
					case 7:
						$fjsxname="[防御]";
						break;
					case 8:
						$fjsxname="[防御]";
						break;
					case 9:
						$fjsxname="[速度]";
						break;
					case 10:
						$fjsxname="[速度]";
						break;
					case 20:
						$fjsxname="[命中值]";
						break;
					case 21:
						$fjsxname="[闪避值]";
						break;
					case 22:
						$fjsxname="[暴击值]";
						break;
					case 23:
						$fjsxname="[反击值]";
						break;
					case 24:
						$fjsxname="[抗暴击值]";
						break;
					case 25:
						$fjsxname="[抗反击值]";
						break;					
				}
		return $fjsxname;			
}
/*  
function GetIP()
{
if(!empty($_SERVER["HTTP_CLIENT_IP"]))
   $cip = $_SERVER["HTTP_CLIENT_IP"];
else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
   $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
else if(!empty($_SERVER["REMOTE_ADDR"]))
   $cip = $_SERVER["REMOTE_ADDR"];
else
   $cip = "无法获取！";
return $cip;
}
*/
function GetIP() {
$ip = "无法识别";
if ($_SERVER["HTTP_X_FORWARDED_FOR"]) {
if ($_SERVER["HTTP_CLIENT_IP"]) {
$ip = $_SERVER["HTTP_CLIENT_IP"];
}else {
$ip = $_SERVER["REMOTE_ADDR"];
}
$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
}else {
if ($_SERVER["HTTP_CLIENT_IP"]) {
$ip = $_SERVER["HTTP_CLIENT_IP"];
}else {
$ip = $_SERVER["REMOTE_ADDR"];
}
}
return $ip;
}
$GetIP=GetIP();
$PR = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

//写日志文件
function writelog($uid,$oid,$itemid,$buyType,$price,$loggetIP,$HOSTURL,$logcontent)
{ 
if(empty($uid)) $uid=0;
if(empty($oid)) $oid=0;
if(empty($itemid)) $itemid=0;
if(empty($buyType)) $buyType=0;
if(empty($price)) $price=0;
if(empty($loggetIP)) $loggetIP=0;
if(empty($HOSTURL)) $HOSTURL=0;
if(empty($logcontent)) $logcontent=0;
$sql="(account_id,char_oid,itemid,buyType,price,ip,scriptname,logcontent) values ($uid,$oid,$itemid,$buyType,$price,'$loggetIP','$HOSTURL','$logcontent')";
//exit($sql);
dbin(account,managelog,$sql);
}

$type="logtime<date_sub(now(),interval 1 week)";
dbdel(account,managelog,$type);

//帐号ID TO 帐号
function uidname($userId)
{
$type="login_oid='$userId'";
$u=dbst(account,fiona_logins,$type);
return $u[login_name];
}
//角色ID TO 角色名
function oidname($roleId)
{
$type="char_oid='$roleId'";
$b=dbst(clunicode,char_body,$type);
$r=dbst(clunicode,char_data,$type);
$getname=str_replace("【".$b[fscs]."魔】","",str_replace("【".$b[fscs]."仙】","",$r[name]));
$getname=str_replace("【".$b[lhcs]."轮】","",str_replace("【".$b[zscs]."转】","",str_replace("【".$b[zfcs]."世】","",$getname)));
$getname=str_replace("【转生】","",str_replace("【转世】","",str_replace("【轮回】","",$getname)));
$getname=str_replace("【入圣】","",str_replace("【飞升】","",str_replace("【化神】","",$getname)));
$getname=str_replace("【入圣】","",str_replace("【飞升】","",str_replace("【坠魔】","",$getname)));
return $getname; 
}

//帮会ID TO 帮会名
function gidname($roleId)
{
$type="guild_id='$roleId'";
$r=dbst(clunicode,guild_data,$type);
if ($r)
{
return $r[name]; 
}else{
echo "没有加入帮派";
}
}

//装备宠物购买性质
function Getisbuy($isbuy)
{
	switch($isbuy){
		case 0:
			$buytype="普通装备";
			break;
		case 1:
			$buytype="水晶装备";
			break;
		case 2:
			$buytype="钻石装备";
			break;		
	}		
return $buytype; 
}
function Getchooseskill($skilloid)
{
	switch($skilloid){
		case 600:
			$buytype="怒火之魂";
			break;
		case 601:
			$buytype="青鸾之魂";
			break;
		case 602:
			$buytype="火牛之魂";
			break;	
		case 603:
			$buytype="火蛛之魂";
			break;	
		case 604:
			$buytype="暝黯之魂";
			break;	
		case 700:
			$buytype="树妖之魂";
			break;	
		case 701:
			$buytype="绿竹之魂";
			break;	
		case 702:
			$buytype="海妖之魂";
			break;	
		case 703:
			$buytype="山石之魂";
			break;
		case 704:
			$buytype="石仙之魂";
			break;
		default : $buytype="没有技能";		
	}		
return $buytype; 
}

function getshoptype($shoptype){
	switch($shoptype){
		case 1:
			$typeName = "法宝";
			break;
		case 2:
			$typeName = "装备";
			break;
		case 3:
			$typeName = "宠物";
			break;
		case 4:
			$typeName = "武器";
			break;
		case 5:
			$typeName = "其它";
			break;
		default : $typeName="没有技能";		
	}
return $typeName; 
}

function getbuytype($pricetype){
if($pricetype=='1' || $pricetype=='0') { $pricetypename1 = "水晶";}
if($pricetype=='0'){ $pricetypename2 = "/";}
if($pricetype=='2' || $pricetype=='0') { $pricetypename3 = "钻石";}
return $pricetypename1.$pricetypename2.$pricetypename3;
}

function getbuy($isbuy){
if($isbuy=='0') { $isbuyname = "否";}
if($isbuy=='1') { $isbuyname = "是";}
return $isbuyname;
}

function itemname($itemid)
{
$type="id='$itemid'";
$r=dbst(clunicode,webshop,$type);
if ($r)
{
return $r[name]; 
}else{
echo "你购买的不是商品";
}
}

function checkAble($able,$name){
if($able!=1) exit("<b>未开启".$name."功能</b>");
}

function checkRoleOnline($userId,$roleId,$onlineTime){
$type="account_oid='$userId' && char_oid='$roleId'";
$a=dbst(clunicode,char_data,$type);
$ot=$a[last_logout_time];
$nt=time();
$dt=$nt-$ot;
if($dt<$onlineTime) exit("<b>操作被终止:有以下几种可能。<br/>1：您的帐号没有下线。<br/>2：您的帐号在线不足一分钟。<br/>解决方法：如果您没下线，请下线在操作，如果您已经下线，请登陆游戏让角色在游戏中停留一分钟再下线重试。</b>");
}
//检查水晶钻石
function checkRoleGold($userId,$roleId,$buyprice,$buytype=0){
$type="login_oid='$userId'";
$u=dbst(account,fiona_logins,$type);
$userpoints = $u[points];
$userzuanshi = $u[zuanshi];
switch($buytype){
case 0 : 
	if($userpoints<$buyprice) 
	{
		if($userzuanshi<$buyprice) {
			exit("<b>钻石不足，请先充值！</b>");
		}
	}
break;
case 1:
if($userpoints<$buyprice) exit("<b>水晶不足，推广可以兑换水晶！</b>");
break;
case 2:
if($userzuanshi<$buyprice) exit("<b>钻石不足，请先充值！</b>");
break;
}
}
//扣水晶钻石
function BuyGold($userId,$roleId,$buyprice,$buytype=0){
$type="login_oid='$userId'";
$u=dbst(account,fiona_logins,$type);
$userpoints = $u[points];
$userzuanshi = $u[zuanshi];
switch($buytype){
	case 0 : 
		if($userpoints>=$buyprice) 
		{
		$type="points=points-$buyprice where login_oid='$userId'";
		}
		if($userzuanshi>=$buyprice) 
		{
		$type="zuanshi=zuanshi-$buyprice where login_oid='$userId'";
		}
		break;
	case 1:
		$type="points=points-$buyprice where login_oid='$userId'";
		break;
	case 2:
		$type="zuanshi=zuanshi-$buyprice where login_oid='$userId'";
		break;
}
$dbup=dbup(account,fiona_logins,$type);
if(!$dbup) exit("扣钻石/水晶失败！请联系管理员！");
}
?>