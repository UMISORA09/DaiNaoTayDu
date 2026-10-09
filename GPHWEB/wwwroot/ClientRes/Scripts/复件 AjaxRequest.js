/// <reference path="Common.js" />
/// <reference path="Ipt.js" />
var PayUrl = "/Pay.php";
function Register() {
    if (blurNameStyle() && blurPassStyle() && blurPass1Style()) {
        var uName = $.trim($("#u_name").val());
        var uPas = $.trim($("#u_pas").val());
        var uPas1 = $.trim($("#u_pas1").val());
        DoAjax("/AjaxRequest/AccountHandler.php", { Action: "Register", uName: uName, uPas: uPas, Sid: GetParasValue("Sid") }, function (msg) {
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
        //if (msg == "1") {
        //    ShowModalAndRedirect(FormatMsg("用户退出系统成功。", "green"), "/UserCenter/Login.php");
		if (msg.indexOf("成功") > 0) {
                ShowModalAndRedirect(FormatMsg(msg, "green"), "/UserCenter/Login.php");
        } else {
            ShowModal(FormatMsg("网络繁忙，11请稍后再试。", "red"));
        }
    });
}

function ChangePass() {
    if (blurOPassStyle && blurPassStyle() && blurPass1Style()) {
        var oPas = $.trim($("#o_pas").val());
        var uPas = $.trim($("#u_pas").val());
        DoAjax("/AjaxRequest/AccountHandler.ashx", { Action: "ChangePass", oPas: oPas, uPas: uPas }, function (msg) {
            HideLoading();
            if (msg.indexOf("成功") > 0) {
                ShowModalAndRedirect(FormatMsg(msg, "green"), "/UserCenter/Login.aspx");
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
        DoAjax("/AjaxRequest/AccountHandler.ashx", { Action: "SecurityEmail", uMail: uMail }, function (msg) {
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
        DoAjax("/AjaxRequest/AccountHandler.ashx", { Action: "BackPass", uName: uName, uPas: uPas, sCode: sCode }, function (msg) {
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
    DoAjax("/AjaxRequest/AccountHandler.ashx", { Action: "SpreadTran" }, function (msg) {
        HideLoading();
        if (msg.indexOf("成功") > 0) {
            ShowModal(FormatMsg(msg, "green"));
        } else {
            ShowModal(FormatMsg(msg, "red"));
        }
    });
}
function GetYuanBaoFromUser() {
    DoAjax("/AjaxRequest/AccountHandler.ashx", { Action: "GetYuanBaoFromUser" }, function (msg) {
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
    DoAjax("/AjaxRequest/PlayInfoHandeler.ashx", { Action: "FreeRwardCash", oId: oid }, function (msg) {
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
    DoAjax("/AjaxRequest/PlayInfoHandeler.ashx", { Action: "FreeRwardGold", oId: oid }, function (msg) {
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
    DoAjax("/AjaxRequest/PlayInfoHandeler.ashx", { Action: "RwardLevelGold", oId: oid }, function (msg) {
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
    DoAjax("/AjaxRequest/PlayInfoHandeler.ashx", { Action: "RoleBuyExp", oId: oid, buyType: buyType }, function (msg) {
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
    DoAjax("/AjaxRequest/PetInfoHandeler.ashx", { Action: "PetBuyExp", rOid: rOid, pOid: pOid, buyType: buyType }, function (msg) {
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
    DoAjax("/AjaxRequest/PetInfoHandeler.ashx", { Action: "PetRebirth", rOid: rOid, pOid: pOid }, function (msg) {
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
    DoAjax("/AjaxRequest/MallShopHandler.ashx", { Action: "BuyMallItem", ItemId: itemId }, function (msg) {
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

