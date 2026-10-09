<?php
include 'getfunction.php';
ckcookie();
if($GLOBALS["gcook"]==1)
{
  echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
  echo "<script>location.href='index.php'</script>";
  exit;
}
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0024)http://admin.518fax.net/ -->
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>用户登录</TITLE><LINK 
href="Common/User_Login.css" type=text/css rel=stylesheet>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<SCRIPT language=javascript>
		function onChgAuth()
		{
		  var imgsrc = document.getElementById("imgauthcode");
		  imgsrc.src = "authcode.php?rnd=" + Math.random();
		}
		function doLogin()
		{
		  if(!checkData()) return false;
		  checkLoginType();
		  document.getElementById("theform").submit();
		}
		function doEnterKey()
		{
		  if(event.keyCode == 13)
		  {
		    doLogin();
		  }
		}
		function checkLoginType()
		{
		  var acct = document.getElementById("account").value;
		  var emailRe = /\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
		  if(emailRe.test(acct)) {
		    document.getElementById("logintype").value = "email";
		  } else {
		    document.getElementById("logintype").value = "username";
		  }
		}
		function checkData()
		{
		  var acct = document.getElementById("account").value;
		  var pwd = document.getElementById("password").value;
		  var auth = document.getElementById("userauthcode").value;
		
		  if(acct.length < 1) {
		    alert("请输入用户名!");
			document.getElementById("account").focus();
			return false;
		  } else if(pwd.length < 1) {
		    alert("请输入密码!");
			document.getElementById("password").focus();
			return false;
		  } else if(auth.length < 1) {
		    alert("请输入验证码!");
			document.getElementById("userauthcode").focus();
			return false;
		  }
		  
		  return true;
		}
</SCRIPT>

<META content="MSHTML 6.00.6000.16809" name=GENERATOR></HEAD>
<BODY onkeypress=doEnterKey(); id=userlogin_body>
<FORM id=theform name=theform action=Action.php 
method=post><INPUT type=hidden value=login name=go> 
<DIV id=panSiteFactory>
<DIV id=siteFactoryLogin>
<DIV id=user_login>
<DL>
  <DD id=user_top>
  <UL>
    <LI class=user_top_l></LI>
    <LI class=user_top_c></LI>
    <LI class=user_top_r></LI></UL>
  <DD id=user_main>
  <UL>
    <LI class=user_main_l></LI>
    <LI class=user_main_c>
    <DIV class=user_main_box>
    <UL>
      <LI class=user_main_text>用户名： </LI>
      <LI class=user_main_input><INPUT class=TxtUserNameCssClass id=account 
      maxLength=20 name=username> </LI></UL>
    <UL>
      <LI class=user_main_text>密 码： </LI>
      <LI class=user_main_input><INPUT class=TxtPasswordCssClass id=password 
      type=password name=password>  </LI></UL>
</DIV></LI>
    <LI class=user_main_r><INPUT type="image" onclick="submit();" class=IbtnEnterCssClass id=IbtnEnter 
    style="BORDER-TOP-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-RIGHT-WIDTH: 0px" 
     src="Images/user_botton.gif" name=IbtnEnter> </LI></UL>
  <DD id=user_bottom>
</DD></DL></DIV></DIV></DIV></FORM></BODY></HTML>
