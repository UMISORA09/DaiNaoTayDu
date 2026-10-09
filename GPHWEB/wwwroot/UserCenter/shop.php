<!DOCTYPE html>
<?php 
  include_once "../Configuration/config.inc.php";
  if(!$_SESSION['accountName']) exit("<script> alert('请登陆后使用！');location.href='Login.php';</script>");
?> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $WebTitle; ?>-物品商城</title>
<link rel=stylesheet type=text/css href="/ClientRes/Styles/reset.css">

<link href="/ClientRes/Styles/BasicStyle.css?_v=634979371913162195" type="text/css" rel="stylesheet" />
<link href="/ClientRes/Styles/Login.css?_v=634979244165265481" type="text/css" rel="stylesheet" />
<link href="/ClientRes/Styles/jmodal.css?_v=634979244164935253" type="text/css" rel="stylesheet" />
<link href="/ClientRes/Styles/loading.css?_v=634979244165185438" type="text/css" rel="stylesheet" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript" charset="UTF-8"></script>
 <!--如果google CDN不正常，就从本地获取JQ库。--> 
<script>!window.jQuery && document.write('<script src="/ClientRes/Scripts/jquery.min.js"><\/script>');</script>
<script src="/ClientRes/Scripts/Ipt.js?_v=634979244161733134" type="text/javascript" charset="UTF-8"></script>
<script src="/ClientRes/Scripts/jmodal.js?_v=634979244161903250" type="text/javascript" charset="UTF-8"></script>
<script src="/ClientRes/Scripts/loading.js?_v=634979244164224791" type="text/javascript" charset="UTF-8"></script>
<script src="/ClientRes/Scripts/Common.js?_v=634979706622125062" type="text/javascript" charset="UTF-8"></script>
<script src="/ClientRes/Scripts/AjaxRequest.js?_v=634979244161282816" type="text/javascript" charset="UTF-8"></script></head>
<?php 
require '../TempLate/PublicTop.html';//引用模板 

?> 
<div class="center clearfix mt10">
        <div class="c_main">
<div id=center class=whitebg>
<div id="lighttip" style="margin-bottom: 10px; font-weight: bold; line-height: 25px;
            padding: 5px; color: rgb(255, 255, 255); background-color: rgb(255, 0, 0);" class="lighttip">
在购买之前，请确认您选择的角色已经下线且包裹有空余位置，否则造成任何损失，概不负责。<BR>小提示：商城物品逐步添加，请大家多提宝贵意见，如果物品不在背包查看仓库！ 
</div>
 <ul class=itemlist>  
 <li class=item_shop>
  <div class=itemInfo>
  <div class=itemimg><a class="imgbox" title="1" href="javascript:void(0)" rel="lightbox">
              <img border="0"  src="/items/jyd.png" width=66 height=64/> 
  </a></div>
  <div style="COLOR: #8b8d8e; FONT-WEIGHT: bold" class=itemtypename><B>[★★购买前须注意★★]</B> </div>
  <div style="COLOR: #f60; FONT-WEIGHT: bold" class=itemname>背包位置要留<B>足够多</B></div>
<div class=itemkucun><B>首先游戏整理背包</B> </div>
  <div class=itemprice><B>购买时必须下线</B></div>  
  <div class=itemkucun><B>购买前看清物品</B></div>
  <div class=itemmark><B>购买前看清购买的属性 </B></div>
  <div class=itembtn style="margin-top:7px;"><a class=viewbutton onclick="javascript:void(0);" href="javascript:void(0);">最后确认购买</a> </div></div></li>
  				
<li class=item_shop>
  <div class=itemInfo>
  <div class=itemimg>
  <a class="imgbox" title="1" href="javascript:void(0)" rel="lightbox">
  <img border="0"  src="/items/jyd.png" width=66 height=64/> 
  </a>
  </div>
  <div style="COLOR: #8b8d8e; FONT-WEIGHT: bold" class=itemtypename>[物品] </div>
  <div style="COLOR: #f60; FONT-WEIGHT: bold" class=itemname>极品经验丹</div>
  <div class=itemkucun><B>每个增加人物两百万经验</B></div>
<div class=itemprice>售价:<B>30000积分</B></div>  
  <div class=itemkucun>状态:<B>永久有效</B> </div>
  <div class=itemmark>单次购买每组99个</div>
  <!--物品代码-->
  <input type="hidden" id="wpdm" value="exppill_004">
  <!--数量-->
  <input type="hidden" id="count" value="99">
  <!--价格-->
  <input type="hidden" id="price" value="30000">
  <!--是否绑定-->
  <input type="hidden" id="bind" value="1">
  <!--物品的稀有等级-->
  <input type="hidden" id="rarelevel" value="4">
  <!--物品等级-->
  <input type="hidden" id="itemlevel" value="1">
  <!--物品附加属性-->
  <input type="hidden" id="attributes" value="null">
  <div class=itembtn style="margin-top:10px;"><a class="viewbutton" href="javascript:void(0)" onclick="Buy1()">购买物品</a></div></div>
</li>
	
<li class=item_shop>
  <div class=itemInfo>
  <div class=itemimg>
  <a class="imgbox" title="1" href="javascript:void(0)" rel="lightbox">
  <img border="0"  src="/items/jyd.png" width=66 height=64/> 
  </a>
  </div>
  <div style="COLOR: #8b8d8e; FONT-WEIGHT: bold" class=itemtypename>[物品] </div>
  <div style="COLOR: #f60; FONT-WEIGHT: bold" class=itemname>龙魂</div>
  <div class=itemkucun><B>坐骑进阶时可以使用</B></div>
<div class=itemprice>售价:<B>200000积分</B></div>  
  <div class=itemkucun>状态:<B>永久有效</B> </div>
  <div class=itemmark>单次购买每组99个</div>
  <!--物品代码-->
  <input type="hidden" id="wpdm7" value="zuoqishuxing2">
  <!--数量-->
  <input type="hidden" id="count7" value="99">
  <!--价格-->
  <input type="hidden" id="price7" value="200000">
  <!--是否绑定-->
  <input type="hidden" id="bind7" value="1">
  <!--物品的稀有等级-->
  <input type="hidden" id="rarelevel7" value="4">
  <!--物品等级-->
  <input type="hidden" id="itemlevel7" value="1">
  <!--物品附加属性-->
  <input type="hidden" id="attributes7" value="null">
  <div class=itembtn style="margin-top:10px;"><a class="viewbutton" href="javascript:void(0)" onclick="Buy7()">购买物品</a></div></div>
</li>
	
<li class=item_shop>
  <div class=itemInfo>
  <div class=itemimg>
  <a class="imgbox" title="1" href="javascript:void(0)" rel="lightbox">
  <img border="0"  src="/items/jyd.png" width=66 height=64/> 
  </a>
  </div>
  <div style="COLOR: #8b8d8e; FONT-WEIGHT: bold" class=itemtypename>[物品] </div>
  <div style="COLOR: #f60; FONT-WEIGHT: bold" class=itemname>龙灵</div>
  <div class=itemkucun><B>坐骑进阶时可以使用</B></div>
<div class=itemprice>售价:<B>200000积分</B></div>  
  <div class=itemkucun>状态:<B>永久有效</B> </div>
  <div class=itemmark>单次购买每组99个</div>
  <!--物品代码-->
  <input type="hidden" id="wpdm8" value="zuoqishuxing3">
  <!--数量-->
  <input type="hidden" id="count8" value="99">
  <!--价格-->
  <input type="hidden" id="price8" value="200000">
  <!--是否绑定-->
  <input type="hidden" id="bind8" value="1">
  <!--物品的稀有等级-->
  <input type="hidden" id="rarelevel8" value="4">
  <!--物品等级-->
  <input type="hidden" id="itemlevel8" value="1">
  <!--物品附加属性-->
  <input type="hidden" id="attributes8" value="null">
  <div class=itembtn style="margin-top:10px;"><a class="viewbutton" href="javascript:void(0)" onclick="Buy8()">购买物品</a></div></div>
</li>

<li class=item_shop>
  <div class=itemInfo>
  <div class=itemimg>
  <a class="imgbox" title="1" href="javascript:void(0)" rel="lightbox">
  <img border="0"  src="/items/jyd.png" width=66 height=64/> 
  </a>
  </div>
  <div style="COLOR: #8b8d8e; FONT-WEIGHT: bold" class=itemtypename>[物品] </div>
  <div style="COLOR: #f60; FONT-WEIGHT: bold" class=itemname>玉石</div>
  <div class=itemkucun><B>换购稀有物品</B></div>
<div class=itemprice>售价:<B>200000积分</B></div>  
  <div class=itemkucun>状态:<B>永久有效</B> </div>
  <div class=itemmark>单次购买每组99个</div>
  <!--物品代码-->
  <input type="hidden" id="wpdm10" value="yushi">
  <!--数量-->
  <input type="hidden" id="count10" value="99">
  <!--价格-->
  <input type="hidden" id="price10" value="200000">
  <!--是否绑定-->
  <input type="hidden" id="bind10" value="1">
  <!--物品的稀有等级-->
  <input type="hidden" id="rarelevel10" value="4">
  <!--物品等级-->
  <input type="hidden" id="itemlevel10" value="1">
  <!--物品附加属性-->
  <input type="hidden" id="attributes10" value="null">
  <div class=itembtn style="margin-top:10px;"><a class="viewbutton" href="javascript:void(0)" onclick="Buy10()">购买物品</a></div></div>
</li>
	
<li class=item_shop>
  <div class=itemInfo>
  <div class=itemimg>
  <a class="imgbox" title="1" href="javascript:void(0)" rel="lightbox">
  <img border="0"  src="/items/jyd.png" width=66 height=64/> 
  </a>
  </div>
  <div style="COLOR: #8b8d8e; FONT-WEIGHT: bold" class=itemtypename>[物品] </div>
  <div style="COLOR: #f60; FONT-WEIGHT: bold" class=itemname>兵灵</div>
  <div class=itemkucun><B>骑兵进阶用品</B></div>
<div class=itemprice>售价:<B>200000积分</B></div>  
  <div class=itemkucun>状态:<B>永久有效</B> </div>
  <div class=itemmark>单次购买每组60个</div>
  <!--物品代码-->
  <input type="hidden" id="wpdm12" value="bingling">
  <!--数量-->
  <input type="hidden" id="count12" value="60">
  <!--价格-->
  <input type="hidden" id="price12" value="200000">
  <!--是否绑定-->
  <input type="hidden" id="bind12" value="1">
  <!--物品的稀有等级-->
  <input type="hidden" id="rarelevel12" value="4">
  <!--物品等级-->
  <input type="hidden" id="itemlevel2" value="1">
  <!--物品附加属性-->
  <input type="hidden" id="attributes12" value="null">
  <div class=itembtn style="margin-top:10px;"><a class="viewbutton" href="javascript:void(0)" onclick="Buy12()">购买物品</a></div></div>
</li>

<li class=item_shop>
  <div class=itemInfo>
  <div class=itemimg>
  <a class="imgbox" title="1" href="javascript:void(0)" rel="lightbox">
  <img border="0"  src="/items/jyd.png" width=66 height=64/> 
  </a>
  </div>
  <div style="COLOR: #8b8d8e; FONT-WEIGHT: bold" class=itemtypename>[物品] </div>
  <div style="COLOR: #f60; FONT-WEIGHT: bold" class=itemname>完美宝石精华</div>
  <div class=itemkucun><B>激活装备完美宝石属性</B></div>
<div class=itemprice>售价:<B>200000积分</B></div>  
  <div class=itemkucun>状态:<B>永久有效</B> </div>
  <div class=itemmark>单次购买每组99个</div>
  <!--物品代码-->
  <input type="hidden" id="wpdm9" value="bsclbig">
  <!--数量-->
  <input type="hidden" id="count9" value="99">
  <!--价格-->
  <input type="hidden" id="price9" value="200000">
  <!--是否绑定-->
  <input type="hidden" id="bind9" value="1">
  <!--物品的稀有等级-->
  <input type="hidden" id="rarelevel9" value="4">
  <!--物品等级-->
  <input type="hidden" id="itemlevel9" value="1">
  <!--物品附加属性-->
  <input type="hidden" id="attributes9" value="null">
  <div class=itembtn style="margin-top:10px;"><a class="viewbutton" href="javascript:void(0)" onclick="Buy9()">购买物品</a></div></div>
</li>

<li class=item_shop>
  <div class=itemInfo>
  <div class=itemimg>
  <a class="imgbox" title="1" href="javascript:void(0)" rel="lightbox">
  <img border="0"  src="/items/jyd.png" width=66 height=64/> 
  </a>
  </div>
  <div style="COLOR: #8b8d8e; FONT-WEIGHT: bold" class=itemtypename>[物品] </div>
  <div style="COLOR: #f60; FONT-WEIGHT: bold" class=itemname>铜钱卡（巨型）</div>
  <div class=itemkucun><B>使用后获得4万点铜钱</B></div>
<div class=itemprice>售价:<B>0积分</B></div>  
  <div class=itemkucun>状态:<B>永久有效</B> </div>
  <div class=itemmark>单次购买每组999个</div>
  <!--物品代码-->
  <input type="hidden" id="wpdm18" value="tongqian004">
  <!--数量-->
  <input type="hidden" id="count18" value="999">
  <!--价格-->
  <input type="hidden" id="price18" value="0">
  <!--是否绑定-->
  <input type="hidden" id="bind18" value="1">
  <!--物品的稀有等级-->
  <input type="hidden" id="rarelevel18" value="4">
  <!--物品等级-->
  <input type="hidden" id="itemlevel18" value="1">
  <!--物品附加属性-->
  <input type="hidden" id="attributes18" value="null">
  <div class=itembtn style="margin-top:10px;"><a class="viewbutton" href="javascript:void(0)" onclick="Buy18()">购买物品</a></div></div>
</li>	 

<li class=item_shop>
  <div class=itemInfo>
  <div class=itemimg>
  <a class="imgbox" title="1" href="javascript:void(0)" rel="lightbox">
  <img border="0"  src="/items/jyd.png" width=66 height=64/> 
  </a>
  </div>
  <div style="COLOR: #8b8d8e; FONT-WEIGHT: bold" class=itemtypename>[物品] </div>
  <div style="COLOR: #f60; FONT-WEIGHT: bold" class=itemname>十倍收益丹</div>
  <div class=itemkucun><B>杀怪打坐真气收益翻10倍</B></div>
<div class=itemprice>售价:<B>0积分</B></div>  
  <div class=itemkucun>状态:<B>永久有效</B> </div>
  <div class=itemmark>单次购买每组1个</div>
  <!--物品代码-->
  <input type="hidden" id="wpdm2" value="expfold_010">
  <!--数量-->
  <input type="hidden" id="count2" value="1">
  <!--价格-->
  <input type="hidden" id="price2" value="0">
  <!--是否绑定-->
  <input type="hidden" id="bind2" value="1">
  <!--物品的稀有等级-->
  <input type="hidden" id="rarelevel2" value="4">
  <!--物品等级-->
  <input type="hidden" id="itemlevel2" value="1">
  <!--物品附加属性-->
  <input type="hidden" id="attributes2" value="null">
  <div class=itembtn style="margin-top:10px;"><a class="viewbutton" href="javascript:void(0)" onclick="Buy2()">购买物品</a></div></div>
</li>

<li class=item_shop>
  <div class=itemInfo>
  <div class=itemimg>
  <a class="imgbox" title="1" href="javascript:void(0)" rel="lightbox">
  <img border="0"  src="/items/jyd.png" width=66 height=64/> 
  </a>
  </div>
  <div style="COLOR: #8b8d8e; FONT-WEIGHT: bold" class=itemtypename>[物品] </div>
  <div style="COLOR: #f60; FONT-WEIGHT: bold" class=itemname>武魂</div>
  <div class=itemkucun><B>转生用品</B></div>
<div class=itemprice>售价:<B>0积分</B></div>  
  <div class=itemkucun>状态:<B>永久有效</B> </div>
  <div class=itemmark>单次购买每组60个</div>
  <!--物品代码-->
  <input type="hidden" id="wpdm11" value="wuhun">
  <!--数量-->
  <input type="hidden" id="count11" value="60">
  <!--价格-->
  <input type="hidden" id="price11" value="0">
  <!--是否绑定-->
  <input type="hidden" id="bind11" value="1">
  <!--物品的稀有等级-->
  <input type="hidden" id="rarelevel11" value="4">
  <!--物品等级-->
  <input type="hidden" id="itemlevel11" value="1">
  <!--物品附加属性-->
  <input type="hidden" id="attributes11" value="null">
  <div class=itembtn style="margin-top:10px;"><a class="viewbutton" href="javascript:void(0)" onclick="Buy11()">购买物品</a></div></div>
</li>

<li class=item_shop>
  <div class=itemInfo>
  <div class=itemimg>
  <a class="imgbox" title="1" href="javascript:void(0)" rel="lightbox">
  <img border="0"  src="/items/jyd.png" width=66 height=64/> 
  </a>
  </div>
  <div style="COLOR: #8b8d8e; FONT-WEIGHT: bold" class=itemtypename>[物品] </div>
  <div style="COLOR: #f60; FONT-WEIGHT: bold" class=itemname>青龙令</div>
  <div class=itemkucun><B>用于公会发展</B></div>
<div class=itemprice>售价:<B>0积分</B></div>  
  <div class=itemkucun>状态:<B>永久有效</B> </div>
  <div class=itemmark>单次购买每组10个</div>
  <!--物品代码-->
  <input type="hidden" id="wpdm3" value="lingql">
  <!--数量-->
  <input type="hidden" id="count3" value="10">
  <!--价格-->
  <input type="hidden" id="price3" value="0">
  <!--是否绑定-->
  <input type="hidden" id="bind3" value="1">
  <!--物品的稀有等级-->
  <input type="hidden" id="rarelevel3" value="4">
  <!--物品等级-->
  <input type="hidden" id="itemlevel3" value="1">
  <!--物品附加属性-->
  <input type="hidden" id="attributes3" value="null">
  <div class=itembtn style="margin-top:10px;"><a class="viewbutton" href="javascript:void(0)" onclick="Buy3()">购买物品</a></div></div>
</li>

<li class=item_shop>
  <div class=itemInfo>
  <div class=itemimg>
  <a class="imgbox" title="1" href="javascript:void(0)" rel="lightbox">
  <img border="0"  src="/items/jyd.png" width=66 height=64/> 
  </a>
  </div>
  <div style="COLOR: #8b8d8e; FONT-WEIGHT: bold" class=itemtypename>[物品] </div>
  <div style="COLOR: #f60; FONT-WEIGHT: bold" class=itemname>白虎令</div>
  <div class=itemkucun><B>用于公会发展</B></div>
<div class=itemprice>售价:<B>0积分</B></div>  
  <div class=itemkucun>状态:<B>永久有效</B> </div>
  <div class=itemmark>单次购买每组10个</div>
  <!--物品代码-->
  <input type="hidden" id="wpdm4" value="lingbh">
  <!--数量-->
  <input type="hidden" id="count4" value="10">
  <!--价格-->
  <input type="hidden" id="price4" value="0">
  <!--是否绑定-->
  <input type="hidden" id="bind4" value="1">
  <!--物品的稀有等级-->
  <input type="hidden" id="rarelevel4" value="4">
  <!--物品等级-->
  <input type="hidden" id="itemlevel4" value="1">
  <!--物品附加属性-->
  <input type="hidden" id="attributes4" value="null">
  <div class=itembtn style="margin-top:10px;"><a class="viewbutton" href="javascript:void(0)" onclick="Buy4()">购买物品</a></div></div>
</li>

<li class=item_shop>
  <div class=itemInfo>
  <div class=itemimg>
  <a class="imgbox" title="1" href="javascript:void(0)" rel="lightbox">
  <img border="0"  src="/items/jyd.png" width=66 height=64/> 
  </a>
  </div>
  <div style="COLOR: #8b8d8e; FONT-WEIGHT: bold" class=itemtypename>[物品] </div>
  <div style="COLOR: #f60; FONT-WEIGHT: bold" class=itemname>朱雀令</div>
  <div class=itemkucun><B>用于公会发展</B></div>
<div class=itemprice>售价:<B>0积分</B></div>  
  <div class=itemkucun>状态:<B>永久有效</B> </div>
  <div class=itemmark>单次购买每组10个</div>
  <!--物品代码-->
  <input type="hidden" id="wpdm5" value="lingzq">
  <!--数量-->
  <input type="hidden" id="count5" value="10">
  <!--价格-->
  <input type="hidden" id="price5" value="0">
  <!--是否绑定-->
  <input type="hidden" id="bind5" value="1">
  <!--物品的稀有等级-->
  <input type="hidden" id="rarelevel5" value="4">
  <!--物品等级-->
  <input type="hidden" id="itemlevel5" value="1">
  <!--物品附加属性-->
  <input type="hidden" id="attributes5" value="null">
  <div class=itembtn style="margin-top:10px;"><a class="viewbutton" href="javascript:void(0)" onclick="Buy5()">购买物品</a></div></div>
</li>

<li class=item_shop>
  <div class=itemInfo>
  <div class=itemimg>
  <a class="imgbox" title="1" href="javascript:void(0)" rel="lightbox">
  <img border="0"  src="/items/jyd.png" width=66 height=64/> 
  </a>
  </div>
  <div style="COLOR: #8b8d8e; FONT-WEIGHT: bold" class=itemtypename>[物品] </div>
  <div style="COLOR: #f60; FONT-WEIGHT: bold" class=itemname>玄武令</div>
  <div class=itemkucun><B>用于公会发展</B></div>
<div class=itemprice>售价:<B>0积分</B></div>  
  <div class=itemkucun>状态:<B>永久有效</B> </div>
  <div class=itemmark>单次购买每组10个</div>
  <!--物品代码-->
  <input type="hidden" id="wpdm6" value="lingxw">
  <!--数量-->
  <input type="hidden" id="count6" value="10">
  <!--价格-->
  <input type="hidden" id="price6" value="0">
  <!--是否绑定-->
  <input type="hidden" id="bind6" value="1">
  <!--物品的稀有等级-->
  <input type="hidden" id="rarelevel6" value="4">
  <!--物品等级-->
  <input type="hidden" id="itemlevel6" value="1">
  <!--物品附加属性-->
  <input type="hidden" id="attributes6" value="null">
  <div class=itembtn style="margin-top:10px;"><a class="viewbutton" href="javascript:void(0)" onclick="Buy6()">购买物品</a></div></div>
</li>
			

<li class=item_shop>
  <div class=itemInfo>
  <div class=itemimg>
  <a class="imgbox" title="1" href="javascript:void(0)" rel="lightbox">
  <img border="0"  src="/items/jyd.png" width=66 height=64/> 
  </a>
  </div>
  <div style="COLOR: #8b8d8e; FONT-WEIGHT: bold" class=itemtypename>[技能] </div>
  <div style="COLOR: #f60; FONT-WEIGHT: bold" class=itemname>抵抗震撼</div>
  <div class=itemkucun><B>技能书籍</B></div>
<div class=itemprice>售价:<B>0积分</B></div>  
  <div class=itemkucun>状态:<B>永久有效</B> </div>
  <div class=itemmark>单次购买每组1个</div>
  <!--物品代码-->
  <input type="hidden" id="wpdm13" value="kangxing16">
  <!--数量-->
  <input type="hidden" id="count13" value="1">
  <!--价格-->
  <input type="hidden" id="price13" value="0">
  <!--是否绑定-->
  <input type="hidden" id="bind13" value="1">
  <!--物品的稀有等级-->
  <input type="hidden" id="rarelevel13" value="4">
  <!--物品等级-->
  <input type="hidden" id="itemlevel13" value="1">
  <!--物品附加属性-->
  <input type="hidden" id="attributes13" value="null">
  <div class=itembtn style="margin-top:10px;"><a class="viewbutton" href="javascript:void(0)" onclick="Buy13()">购买物品</a></div></div>
</li>

<li class=item_shop>
  <div class=itemInfo>
  <div class=itemimg>
  <a class="imgbox" title="1" href="javascript:void(0)" rel="lightbox">
  <img border="0"  src="/items/jyd.png" width=66 height=64/> 
  </a>
  </div>
  <div style="COLOR: #8b8d8e; FONT-WEIGHT: bold" class=itemtypename>[技能] </div>
  <div style="COLOR: #f60; FONT-WEIGHT: bold" class=itemname>抵抗焚烧</div>
  <div class=itemkucun><B>技能书籍</B></div>
<div class=itemprice>售价:<B>0积分</B></div>  
  <div class=itemkucun>状态:<B>永久有效</B> </div>
  <div class=itemmark>单次购买每组1个</div>
  <!--物品代码-->
  <input type="hidden" id="wpdm14" value="kangxing15">
  <!--数量-->
  <input type="hidden" id="count14" value="1">
  <!--价格-->
  <input type="hidden" id="price14" value="0">
  <!--是否绑定-->
  <input type="hidden" id="bind14" value="1">
  <!--物品的稀有等级-->
  <input type="hidden" id="rarelevel14" value="4">
  <!--物品等级-->
  <input type="hidden" id="itemlevel14" value="1">
  <!--物品附加属性-->
  <input type="hidden" id="attributes14" value="null">
  <div class=itembtn style="margin-top:10px;"><a class="viewbutton" href="javascript:void(0)" onclick="Buy14()">购买物品</a></div></div>
</li>
	
<li class=item_shop>
  <div class=itemInfo>
  <div class=itemimg>
  <a class="imgbox" title="1" href="javascript:void(0)" rel="lightbox">
  <img border="0"  src="/items/jyd.png" width=66 height=64/> 
  </a>
  </div>
  <div style="COLOR: #8b8d8e; FONT-WEIGHT: bold" class=itemtypename>[技能] </div>
  <div style="COLOR: #f60; FONT-WEIGHT: bold" class=itemname>抵抗灼烧</div>
  <div class=itemkucun><B>技能书籍</B></div>
<div class=itemprice>售价:<B>0积分</B></div>  
  <div class=itemkucun>状态:<B>永久有效</B> </div>
  <div class=itemmark>单次购买每组1个</div>
  <!--物品代码-->
  <input type="hidden" id="wpdm15" value="kangxing8">
  <!--数量-->
  <input type="hidden" id="count15" value="1">
  <!--价格-->
  <input type="hidden" id="price15" value="0">
  <!--是否绑定-->
  <input type="hidden" id="bind15" value="1">
  <!--物品的稀有等级-->
  <input type="hidden" id="rarelevel15" value="4">
  <!--物品等级-->
  <input type="hidden" id="itemlevel15" value="1">
  <!--物品附加属性-->
  <input type="hidden" id="attributes15" value="null">
  <div class=itembtn style="margin-top:10px;"><a class="viewbutton" href="javascript:void(0)" onclick="Buy15()">购买物品</a></div></div>
</li>
	
<li class=item_shop>
  <div class=itemInfo>
  <div class=itemimg>
  <a class="imgbox" title="1" href="javascript:void(0)" rel="lightbox">
  <img border="0"  src="/items/jyd.png" width=66 height=64/> 
  </a>
  </div>
  <div style="COLOR: #8b8d8e; FONT-WEIGHT: bold" class=itemtypename>[技能] </div>
  <div style="COLOR: #f60; FONT-WEIGHT: bold" class=itemname>抵抗穿心</div>
  <div class=itemkucun><B>技能书籍</B></div>
<div class=itemprice>售价:<B>0积分</B></div>  
  <div class=itemkucun>状态:<B>永久有效</B> </div>
  <div class=itemmark>单次购买每组1个</div>
  <!--物品代码-->
  <input type="hidden" id="wpdm16" value="kangxing7">
  <!--数量-->
  <input type="hidden" id="count16" value="1">
  <!--价格-->
  <input type="hidden" id="price16" value="0">
  <!--是否绑定-->
  <input type="hidden" id="bind16" value="1">
  <!--物品的稀有等级-->
  <input type="hidden" id="rarelevel16" value="4">
  <!--物品等级-->
  <input type="hidden" id="itemlevel16" value="1">
  <!--物品附加属性-->
  <input type="hidden" id="attributes16" value="null">
  <div class=itembtn style="margin-top:10px;"><a class="viewbutton" href="javascript:void(0)" onclick="Buy16()">购买物品</a></div></div>
</li>
	
<li class=item_shop>
  <div class=itemInfo>
  <div class=itemimg>
  <a class="imgbox" title="1" href="javascript:void(0)" rel="lightbox">
  <img border="0"  src="/items/jyd.png" width=66 height=64/> 
  </a>
  </div>
  <div style="COLOR: #8b8d8e; FONT-WEIGHT: bold" class=itemtypename>[技能] </div>
  <div style="COLOR: #f60; FONT-WEIGHT: bold" class=itemname>抵抗混乱</div>
  <div class=itemkucun><B>技能书籍</B></div>
<div class=itemprice>售价:<B>0积分</B></div>  
  <div class=itemkucun>状态:<B>永久有效</B> </div>
  <div class=itemmark>单次购买每组1个</div>
  <!--物品代码-->
  <input type="hidden" id="wpdm17" value="kangxing5">
  <!--数量-->
  <input type="hidden" id="count17" value="1">
  <!--价格-->
  <input type="hidden" id="price17" value="0">
  <!--是否绑定-->
  <input type="hidden" id="bind17" value="1">
  <!--物品的稀有等级-->
  <input type="hidden" id="rarelevel17" value="4">
  <!--物品等级-->
  <input type="hidden" id="itemlevel17" value="1">
  <!--物品附加属性-->
  <input type="hidden" id="attributes17" value="null">
  <div class=itembtn style="margin-top:10px;"><a class="viewbutton" href="javascript:void(0)" onclick="Buy17()">购买物品</a></div></div>
</li>




</ul>
<br/>

</div>

﻿</div></div>

<?php 
require '../TempLate/PublicButtom.html';//引用模板 
?> 
</html>
