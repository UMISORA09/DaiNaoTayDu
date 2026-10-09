/// <reference path="Common.js" />
/// <reference path="Ipt.js" />
var PayUrl = "/GameCenter/Pay.htm";
function Register() {
    if (blurNameStyle() && blurPassStyle() && blurPass1Style()&&blurSCodeStyle()) {
        var uName = $.trim($("#u_name").val());
        var uPas = $.trim($("#u_pas").val());
        var uPas1 = $.trim($("#u_pas1").val());
		var sCode = $.trim($("#s_code").val());
        DoAjax("/AjaxRequest/AccountHandler.php", { Action: "Register", uName: uName, uPas: uPas,  sCode: sCode,Sid: GetParasValue("Sid") }, function (msg) {
            HideLoading(); //不管是否成功，都要Hide
            if (msg.indexOf("成功") > 0)
                ShowModalAndRedirect(FormatMsg(msg, "green"), "/UserCenter/");
            else
                ShowModal(FormatMsg(msg, "red"));
        });
    }
}

function Login() {
    if (blurNameStyle() && blurPassStyle()) {
        var uName = $.trim($("#u_name").val());
        var uPas = $.trim($("#u_pas").val());
        DoAjax("/AjaxRequest/AccountHandler.php", { Action: "Login", uName: uName, uPas: uPas }, function (msg) {
            HideLoading();
            if (msg.indexOf("成功") > 0) {
                ShowModalAndRedirect(FormatMsg(msg, "green"), "/UserCenter/");
            } else {
                ShowModal(FormatMsg(msg, "red"));
            }
        });
    }
}

function SignOut() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "SignOut" }, function (msg) {
        HideLoading();
		if (msg.indexOf("成功") > 0) {
                ShowModalAndRedirect(FormatMsg(msg, "green"), "/UserCenter/Login.php");
        } else {
            ShowModal(FormatMsg("网络繁忙，请稍后再试。", "red"));
        }
    });
}

function ChangePass() {
    if (blurOPassStyle && blurPassStyle() && blurPass1Style()) {
        var oPas = $.trim($("#o_pas").val());
        var uPas = $.trim($("#u_pas").val());
        DoAjax("/AjaxRequest/AccountHandler.php", { Action: "ChangePass", oPas: oPas, uPas: uPas }, function (msg) {
            HideLoading();
            if (msg.indexOf("成功") > 0) {
                ShowModalAndRedirect(FormatMsg(msg, "green"), "/UserCenter/Login.php");
            } else {
                ShowModal(FormatMsg(msg, "red"));
            }
        });
    }
}

function SecurityEmail() {
    if (blurUMailStyle() && blurRMailStyle()) {
        var uMail = $.trim($("#u_mail").val());
        var rMail = $.trim($("#r_mail").val());
        DoAjax("/AjaxRequest/AccountHandler.php", { Action: "SecurityEmail", uMail: uMail }, function (msg) {
            HideLoading();
            if (msg.indexOf("成功") > 0) {
                ShowModal(FormatMsg(msg, "green"));
            } else {
                ShowModal(FormatMsg(msg, "red"));
            }
        });
    }
}

function BackPass() {
    if (blurNameStyle() && blurPassStyle() && blurPass1Style() && blurSCodeStyle()) {
        var uName = $.trim($("#u_name").val());
        var uPas = $.trim($("#u_pas").val());
        var sCode = $.trim($("#s_code").val());
        DoAjax("/AjaxRequest/AccountHandler.php", { Action: "BackPass", uName: uName, uPas: uPas, sCode: sCode }, function (msg) {
            HideLoading();
            if (msg.indexOf("成功") > 0) {
                ShowModalAndRedirect(FormatMsg(msg, "green"), "/UserCenter/Login.aspx");
            } else {
                ShowModal(FormatMsg(msg, "red"));
            }
        });
    }
}

function SpreadTran() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "SpreadTran" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function Buy1() {
	var wpdm = $.trim($("#wpdm").val());
	var count = $.trim($("#count").val());
	var price = $.trim($("#price").val());
	var bind = $.trim($("#bind").val());
	var rarelevel = $.trim($("#rarelevel").val());
	var itemlevel = $.trim($("#itemlevel").val());
	var attributes = $.trim($("#attributes").val());
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "Buy",wpdm:wpdm,count:count,price:price,bind:bind,rarelevel:rarelevel,itemlevel:itemlevel,attributes:attributes}, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function Buy2() {
	var wpdm = $.trim($("#wpdm2").val());
	var count = $.trim($("#count2").val());
	var price = $.trim($("#price2").val());
	var bind = $.trim($("#bind2").val());
	var rarelevel = $.trim($("#rarelevel2").val());
	var itemlevel = $.trim($("#itemlevel2").val());
	var attributes = $.trim($("#attributes2").val());
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "Buy",wpdm:wpdm,count:count,price:price,bind:bind,rarelevel:rarelevel,itemlevel:itemlevel,attributes:attributes}, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function Buy3() {
	var wpdm = $.trim($("#wpdm3").val());
	var count = $.trim($("#count3").val());
	var price = $.trim($("#price3").val());
	var bind = $.trim($("#bind3").val());
	var rarelevel = $.trim($("#rarelevel3").val());
	var itemlevel = $.trim($("#itemlevel3").val());
	var attributes = $.trim($("#attributes3").val());
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "Buy",wpdm:wpdm,count:count,price:price,bind:bind,rarelevel:rarelevel,itemlevel:itemlevel,attributes:attributes}, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function Buy4() {
	var wpdm = $.trim($("#wpdm4").val());
	var count = $.trim($("#count4").val());
	var price = $.trim($("#price4").val());
	var bind = $.trim($("#bind44").val());
	var rarelevel = $.trim($("#rarelevel4").val());
	var itemlevel = $.trim($("#itemlevel4").val());
	var attributes = $.trim($("#attributes4").val());
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "Buy",wpdm:wpdm,count:count,price:price,bind:bind,rarelevel:rarelevel,itemlevel:itemlevel,attributes:attributes}, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function Buy5() {
	var wpdm = $.trim($("#wpdm5").val());
	var count = $.trim($("#count5").val());
	var price = $.trim($("#price5").val());
	var bind = $.trim($("#bind5").val());
	var rarelevel = $.trim($("#rarelevel5").val());
	var itemlevel = $.trim($("#itemlevel5").val());
	var attributes = $.trim($("#attributes5").val());
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "Buy",wpdm:wpdm,count:count,price:price,bind:bind,rarelevel:rarelevel,itemlevel:itemlevel,attributes:attributes}, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function Buy6() {
	var wpdm = $.trim($("#wpdm6").val());
	var count = $.trim($("#count6").val());
	var price = $.trim($("#price6").val());
	var bind = $.trim($("#bind6").val());
	var rarelevel = $.trim($("#rarelevel6").val());
	var itemlevel = $.trim($("#itemlevel6").val());
	var attributes = $.trim($("#attributes6").val());
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "Buy",wpdm:wpdm,count:count,price:price,bind:bind,rarelevel:rarelevel,itemlevel:itemlevel,attributes:attributes}, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function Buy7() {
	var wpdm = $.trim($("#wpdm7").val());
	var count = $.trim($("#count7").val());
	var price = $.trim($("#price7").val());
	var bind = $.trim($("#bind7").val());
	var rarelevel = $.trim($("#rarelevel7").val());
	var itemlevel = $.trim($("#itemlevel7").val());
	var attributes = $.trim($("#attributes7").val());
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "Buy",wpdm:wpdm,count:count,price:price,bind:bind,rarelevel:rarelevel,itemlevel:itemlevel,attributes:attributes}, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function Buy8() {
	var wpdm = $.trim($("#wpdm8").val());
	var count = $.trim($("#count8").val());
	var price = $.trim($("#price8").val());
	var bind = $.trim($("#bind8").val());
	var rarelevel = $.trim($("#rarelevel8").val());
	var itemlevel = $.trim($("#itemlevel8").val());
	var attributes = $.trim($("#attributes8").val());
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "Buy",wpdm:wpdm,count:count,price:price,bind:bind,rarelevel:rarelevel,itemlevel:itemlevel,attributes:attributes}, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function Buy9() {
	var wpdm = $.trim($("#wpdm9").val());
	var count = $.trim($("#count9").val());
	var price = $.trim($("#price9").val());
	var bind = $.trim($("#bind9").val());
	var rarelevel = $.trim($("#rarelevel9").val());
	var itemlevel = $.trim($("#itemlevel9").val());
	var attributes = $.trim($("#attributes9").val());
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "Buy",wpdm:wpdm,count:count,price:price,bind:bind,rarelevel:rarelevel,itemlevel:itemlevel,attributes:attributes}, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function Buy10() {
	var wpdm = $.trim($("#wpdm10").val());
	var count = $.trim($("#count10").val());
	var price = $.trim($("#price10").val());
	var bind = $.trim($("#bind10").val());
	var rarelevel = $.trim($("#rarelevel10").val());
	var itemlevel = $.trim($("#itemlevel10").val());
	var attributes = $.trim($("#attributes10").val());
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "Buy",wpdm:wpdm,count:count,price:price,bind:bind,rarelevel:rarelevel,itemlevel:itemlevel,attributes:attributes}, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function Buy11() {
	var wpdm = $.trim($("#wpdm11").val());
	var count = $.trim($("#count11").val());
	var price = $.trim($("#price11").val());
	var bind = $.trim($("#bind11").val());
	var rarelevel = $.trim($("#rarelevel11").val());
	var itemlevel = $.trim($("#itemlevel11").val());
	var attributes = $.trim($("#attributes11").val());
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "Buy",wpdm:wpdm,count:count,price:price,bind:bind,rarelevel:rarelevel,itemlevel:itemlevel,attributes:attributes}, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function Buy12() {
	var wpdm = $.trim($("#wpdm12").val());
	var count = $.trim($("#count12").val());
	var price = $.trim($("#price12").val());
	var bind = $.trim($("#bind12").val());
	var rarelevel = $.trim($("#rarelevel12").val());
	var itemlevel = $.trim($("#itemlevel12").val());
	var attributes = $.trim($("#attributes12").val());
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "Buy",wpdm:wpdm,count:count,price:price,bind:bind,rarelevel:rarelevel,itemlevel:itemlevel,attributes:attributes}, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function Buy13() {
	var wpdm = $.trim($("#wpdm13").val());
	var count = $.trim($("#count13").val());
	var price = $.trim($("#price13").val());
	var bind = $.trim($("#bind13").val());
	var rarelevel = $.trim($("#rarelevel13").val());
	var itemlevel = $.trim($("#itemlevel13").val());
	var attributes = $.trim($("#attributes13").val());
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "Buy",wpdm:wpdm,count:count,price:price,bind:bind,rarelevel:rarelevel,itemlevel:itemlevel,attributes:attributes}, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function Buy14() {
	var wpdm = $.trim($("#wpdm14").val());
	var count = $.trim($("#count14").val());
	var price = $.trim($("#price14").val());
	var bind = $.trim($("#bind14").val());
	var rarelevel = $.trim($("#rarelevel14").val());
	var itemlevel = $.trim($("#itemlevel14").val());
	var attributes = $.trim($("#attributes14").val());
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "Buy",wpdm:wpdm,count:count,price:price,bind:bind,rarelevel:rarelevel,itemlevel:itemlevel,attributes:attributes}, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function Buy15() {
	var wpdm = $.trim($("#wpdm15").val());
	var count = $.trim($("#count15").val());
	var price = $.trim($("#price15").val());
	var bind = $.trim($("#bind15").val());
	var rarelevel = $.trim($("#rarelevel15").val());
	var itemlevel = $.trim($("#itemlevel15").val());
	var attributes = $.trim($("#attributes15").val());
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "Buy",wpdm:wpdm,count:count,price:price,bind:bind,rarelevel:rarelevel,itemlevel:itemlevel,attributes:attributes}, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function Buy16() {
	var wpdm = $.trim($("#wpdm16").val());
	var count = $.trim($("#count16").val());
	var price = $.trim($("#price16").val());
	var bind = $.trim($("#bind16").val());
	var rarelevel = $.trim($("#rarelevel16").val());
	var itemlevel = $.trim($("#itemlevel16").val());
	var attributes = $.trim($("#attributes16").val());
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "Buy",wpdm:wpdm,count:count,price:price,bind:bind,rarelevel:rarelevel,itemlevel:itemlevel,attributes:attributes}, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function Buy17() {
	var wpdm = $.trim($("#wpdm17").val());
	var count = $.trim($("#count17").val());
	var price = $.trim($("#price17").val());
	var bind = $.trim($("#bind17").val());
	var rarelevel = $.trim($("#rarelevel17").val());
	var itemlevel = $.trim($("#itemlevel17").val());
	var attributes = $.trim($("#attributes17").val());
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "Buy",wpdm:wpdm,count:count,price:price,bind:bind,rarelevel:rarelevel,itemlevel:itemlevel,attributes:attributes}, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function Buy18() {
	var wpdm = $.trim($("#wpdm18").val());
	var count = $.trim($("#count18").val());
	var price = $.trim($("#price18").val());
	var bind = $.trim($("#bind18").val());
	var rarelevel = $.trim($("#rarelevel18").val());
	var itemlevel = $.trim($("#itemlevel18").val());
	var attributes = $.trim($("#attributes18").val());
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "Buy",wpdm:wpdm,count:count,price:price,bind:bind,rarelevel:rarelevel,itemlevel:itemlevel,attributes:attributes}, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function kahaozijiu() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "kahaozijiu" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function logingame() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "logingame" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function zhizunshangcheng() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "zhizunshangcheng" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function zhanshi() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "zhanshi" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function daoshi() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "yiqianwulibao" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function fashi() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "jiubailibao" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function yuyi() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "wubailibao" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function meili() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "sanbailibao" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function daoshiyuan() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "daoshiyuan" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function wushiyuan() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "wushiyuan" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function yibaiyuan() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "yibaiyuan" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function shiyuana() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "shiyuana" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function daoshiyuana() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "daoshiyuana" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function wushiyuana() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "wushiyuana" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function shiyuanwocao() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "shiyuanwocao" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function yibaiyuana() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "yibaiyuana" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function shiyuanaa() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "shiyuanaa" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function daoshiyuanaa() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "daoshiyuanaa" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function daoshiyuanaaa() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "daoshiyuanaaa" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function daoshiyuanbbb() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "daoshiyuanbbb" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function daoshiyuanccc() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "daoshiyuanccc" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function daoshiyuanddd() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "daoshiyuanddd" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function daoshiyuaneee() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "daoshiyuaneee" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function daoshiyuanfff() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "daoshiyuanfff" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function daoshiyuanggg() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "daoshiyuanggg" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function daoshiyuanhhh() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "daoshiyuanhhh" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function daoshiyuankkk() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "daoshiyuankkk" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function wushiyuanaa() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "wushiyuanaa" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function yibaiyuanaa() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "yibaiyuanaa" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function wuxianbangdingyuanbao() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "wuxianbangdingyuanbao" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function GetYuanBaoFromUser() {
    DoAjax("/AjaxRequest/AccountHandler.php", { Action: "GetYuanBaoFromUser" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
            $("#tabs").tabs("refresh");
        } else if (msg.indexOf("充值") > 0) {
            ShowModalAndOpenNewWindow(FormatMsg(msg, "red"), PayUrl);
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}

function FreeRwardCash(oid) {
    DoAjax("/AjaxRequest/PlayInfoHandeler.php", { Action: "FreeRwardCash", oId: oid }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
            $("#tabs").tabs("refresh");
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}

function FreeRwardGold(oid) {
    DoAjax("/AjaxRequest/PlayInfoHandeler.php", { Action: "FreeRwardGold", oId: oid }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
            $("#tabs").tabs("refresh");
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}

function RwardLevelGold(oid) {
    DoAjax("/AjaxRequest/PlayInfoHandeler.php", { Action: "RwardLevelGold", oId: oid }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
            $("#tabs").tabs("refresh");
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}

function RoleBuyExp(oid, buyType) {
    DoAjax("/AjaxRequest/PlayInfoHandeler.php", { Action: "RoleBuyExp", oId: oid, buyType: buyType }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
            $("#tabs").tabs("refresh");
        } else if (msg.indexOf("充值") > 0) {
            ShowModalAndOpenNewWindow(FormatMsg(msg, "red"), PayUrl);
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}

function PetBuyExp(rOid, pOid, buyType) {
    DoAjax("/AjaxRequest/PetInfoHandeler.php", { Action: "PetBuyExp", rOid: rOid, pOid: pOid, buyType: buyType }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
            $("#tabs").tabs("refresh");

        } else if (msg.indexOf("充值") > 0) {
            ShowModalAndOpenNewWindow(FormatMsg(msg, "red"), PayUrl);
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}

function PetRebirth(rOid, pOid) {
    DoAjax("/AjaxRequest/PetInfoHandeler.php", { Action: "PetRebirth", rOid: rOid, pOid: pOid }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
            $("#tabs").tabs("refresh");

        } else if (msg.indexOf("充值") > 0) {
            ShowModalAndOpenNewWindow(FormatMsg(msg, "red"), PayUrl);
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}

function BuyMallItem(itemId) {
    DoAjax("/AjaxRequest/MallShopHandler.php", { Action: "BuyMallItem", ItemId: itemId }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else if (msg.indexOf("充值") > 0) {
            ShowModalAndOpenNewWindow(FormatMsg(msg, "red"), PayUrl);
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}

