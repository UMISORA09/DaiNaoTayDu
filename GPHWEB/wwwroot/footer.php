<div class="footer">

    <div class="footer_con">
     <div id="阿泽源码网"> 
	 <a href="https://www.lyzwlkj.vip">阿泽源码网</a>
	 <div>
        建议使用IE7及以上版本浏览器，以达到最佳体验效果</div>

</div>

<script type="text/javascript">

    $(function () {

        $(".nav ul li[class!='orange']").each(function () {

            if (window.location.href.toLowerCase().indexOf($(this).children("a").attr("href").toLowerCase()) > 0 ||

            window.location.href.toLowerCase() == $(this).children("a").attr("href").toLowerCase()) {

                $("div.nav ul li").removeClass("select");

                $(this).addClass("select");

            }

        })

    })

</script>