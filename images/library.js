var library = {};

library.domainname = {
    "focalprice": "http://www.fpvok.com/",
    "members": "http://www.fpvok.com/",
    "shopping": "http://www.fpvok.com/",
    "search": "http://www.fpvok.com/"
}

library.validate = {
    isEmail: function (value) {
        var emailReg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
        return emailReg.test(value);
    },
    isDecimal: function (value) {
        var decimalReg = /(^[-+]?[1-9]\d*(\.\d+)?$)|(^[-+]?[0]{1}\.\d+$)/;
        return decimalReg.test(value);
    },
    isInt: function (value) {
        var intReg = /^\d+$/;
        return intReg.test(value);
    },
    isPositiveInt: function (value) {
        var intReg = /^(0|([-+]?[1-9]{1}\d*))$/;
        return intReg.test(value);
    },
    isURL: function (value) {
        var urlReg = /^((http|https)?:\/\/)?[^\/\.]+?\..+\w$/i;
        return urlReg.test(value);
    }
};

library.querystring = {
    get: function (name) {
        ///<summary>获取指定名称QueryString的�&#65533;</summary>
        ///<param name="name">QueryString名称</param>
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]); return null;
    }
};

library.cookie = {

    get: function (cookiename) {
        var regexPattern = cookiename + "=(.*?)(;|$)";
        var regex = new RegExp(regexPattern);
        if (regex.test(document.cookie)) {
            var value = regex.exec(document.cookie)[1];
            if (value != null && value.replace(/\s/, "") != "")
                return unescape(value);
        }
        return "";
    },
    set: function (cookiename, value, expires, path, domain, secure) {
        ///<summary>设置Cookie</summary>
        ///<param name="cookiename">要设置的Cookie的名�&#65533;</param>
        ///<param name="value">要设置的Cookie的�&#65533;</param>
        ///<param name="expires">要设置的Cookie的过期时�&#65533;</param>
        ///<param name="path">要设置的Cookie的路�&#65533;</param>
        ///<param name="domain">要设置的Cookie的域</param>
        ///<param name="secure">是否禁止JavaScript获取设置的这个Cookie</param>

        if (path == null)
            path = "/";

        if (domain == null)
            domain = ".focalprice.com";

        if (secure == null)
            secure = false;

        document.cookie = cookiename + "=" + escape(value) +
   ((expires == null) ? "" : ("; expires=" + expires.toGMTString())) +
   ((path == "") ? "" : ("; path=" + path)) +
   ((domain == "") ? "" : ("; domain=" + domain)) +
   ((secure == true) ? "; secure" : "");
    },
    urlDecode: function (cookievalue) {
        if ((cookievalue == null) || (cookievalue == ""))
            return "";
        else
            return cookievalue.replace(/\+/g, " ");
    }

};

library.wishes =
{
    add: function (url, sku) {
        if (library.mini.isSignin()) {
            library.wishes.add_core(sku);
        }
        else {
            library.mini.signin(url);
        }
    },
    add_core: function (sku) {
        var wishUrl = library.domainname.members + "addWish/" + sku + "?callback=?";

        $.getJSON(wishUrl, function (data) {
            var dia = window.parent.art.dialog.get("dia_signin");

            if (data.result == true) {
                var ok;
                if (dia != null && dia != undefined) {
                    ok = "<div class=\"add_to_cardTips h100\">"
                           + "<p class=\"f18 c00 lh35\"><em>1</em> " + window.parent.focalPriceTip.wishlist[0].add_sucess + "</p>"
                           + "<p class=\"pt20\" style=\"padding-left:15px;\"><a href=\"" + window.parent.library.domainname.members + "Wishlist\">" + window.parent.focalPriceTip.wishlist[0].ViewText + " &gt;&gt;</a><p>"
                           + "<p class=\"pt20 f11 alignR\">" + window.parent.focalPriceTip.common[0].CloseDivTips + "</p>"
                           + "</div>";
                }
                else {
                    ok = "<div class=\"add_to_cardTips h100\">"
                         + "<p class=\"f18 c00 lh35\"><em>1</em> " + focalPriceTip.wishlist[0].add_sucess + "</p>"
                         + "<p class=\"pt20\" style=\"padding-left:15px;\"><a href=\"" + library.domainname.members + "Wishlist\">" + focalPriceTip.wishlist[0].ViewText + " &gt;&gt;</a><p>"
                         + "<p class=\"pt20 f11 alignR\">" + focalPriceTip.common[0].CloseDivTips + "</p>"
                         + "</div>";
                }

                if (dia != null && dia != undefined)
                    window.parent.library.dialog.showDialog("", ok);
                else
                    library.dialog.showDialog("", ok);
            }
            else {
                if (data.errorCode == 0) {
                    alert("error");
                }
                else if (data.errorCode == -1) {
                    var exist;
                    if (dia != null && dia != undefined) {
                        exist = "<div class=\"success_Tips h100\">"
                                + "<p class=\"f18 c00 lh35\">" + window.parent.focalPriceTip.wishlist[0].added + "</p>"
                                + "<p class=\"pt20\" style=\"padding-left:15px;\"><a href=\"" + window.parent.library.domainname.members + "Wishlist\">" + window.parent.focalPriceTip.wishlist[0].ViewText + " &gt;&gt;</a><p>"
                                + "<p class=\"pt20 f11 alignR\">" + window.parent.focalPriceTip.common[0].CloseDivTips + "</p>"
                                + "</div>";
                    }
                    else {
                        exist = "<div class=\"success_Tips h100\">"
                              + "<p class=\"f18 c00 lh35\">" + focalPriceTip.wishlist[0].added + "</p>"
                              + "<p class=\"pt20\" style=\"padding-left:15px;\"><a href=\"" + library.domainname.members + "Wishlist\">" + focalPriceTip.wishlist[0].ViewText + " &gt;&gt;</a><p>"
                              + "<p class=\"pt20 f11 alignR\">" + focalPriceTip.common[0].CloseDivTips + "</p>"
                              + "</div>";
                    }
                    if (dia != null && dia != undefined)
                        window.parent.library.dialog.showDialog("", exist);
                    else
                        library.dialog.showDialog("", exist);
                }
            }
            if (dia != null && dia != undefined)
                window.parent.art.dialog.get("dia_signin").close();
        });
    }
};


library.mini = new function () {
    var isLogin = function () {
        var memberid = library.cookie.get("Focalprice_MemberID");
        if (memberid != "") {
            return true;
        }
        return false;
    };

    var isFocal = function () {
        var provider = library.cookie.get("MemberProvider");
        var isfocal = library.cookie.get("Member_IsFocal");
        if (provider == "FOCALPRICE" && isfocal == "true") {
            return true;
        }
        return false;
    }

    var login = function (refer) {
        if (art.dialog.get("dia_signin") != undefined) {
            return false;
        }

        if (library.mini.isSignin()) {
            $.getJSON(refer, function (data) {
                if (data.result == true)
                    art.dialog.close("dia_signin");
            });
        }
        else {
            art.dialog.open(library.domainname.members + "mini/login?refer=" + encodeURIComponent(refer), {
                title: "Sign In or Register",
                id: "dia_signin",
                width: 668,
                height: 350,
                lock: true
            });
        }
    };

    this.signin = login;
    this.isSignin = isLogin;
    this.isFocalMember = isFocal;
};

library.dialog = new function () {
    var nofollow = function (title, contents) {
        art.dialog({
            skin: 'chrome',
            title: title,
            width: 386,
            height: 115,
            time: 5,
            content: contents
        });
    };

    var follow = function (title, contents, followId) {
        art.dialog({
            skin: 'chrome',
            title: title,
            width: 386,
            height: 135,
            time: 5,
            follow: followId,
            content: contents
        });
    };

    var show = function (id, title, content) {
        art.dialog({
            skin: 'chrome',
            id: id,
            title: title,
            content: content
        });
    };

    var closedia = function (id) {
        art.dialog.get(id).close();
    };
    this.alertDialog = show;
    this.showDialog = function (title, contents, followId) {
        if (followId == null)
            nofollow(title, contents);
        else
            follow(title, contents, followId);
    };
    this.close = closedia;
};

library.errorreport = new function () {
    var create = function (url) {
        if (art.dialog.get("dialog_errorreport") != undefined) {
            return false;
        }
        art.dialog.load(url + "?callback=library.errorreport.callback", {
            id: "dialog_errorreport",
            title: focalPriceTip.errorReport[0].reportTitle
        });
    };
    this.add = create;
    this.callback = function () {
        library.dialog.close("dialog_errorreport");
    };
};

library.pricematch = new function () {
    var create = function (url, callback) {
        if (art.dialog.get("dialog_pricematch") != undefined) {
            return false;
        }
        art.dialog.load(url + "?callback=library.pricematch.callback", {
            id: "dialog_pricematch",
            title: focalPriceTip.Products[0].priceMatchTitle
        });
    };
    this.add = create;
    this.callback = function () {
        library.dialog.close("dialog_pricematch");
    };
};

library.digg = new function () {
    var create = function (sku, success, failed) {
        __diggSuccessCallback = success;
        __diggFailedCallback = failed;

        $.post("/Digg", { sku: sku }, function (data) {
            if (data != null) {
                if (data.result == true) {
                    __diggSuccessCallback();
                }
                else {
                    __diggFailedCallback();
                }
            }
        });
    }

    this.add = create;
};

library.question = new function () {
    this.create = function (sku) {
        art.dialog.load(library.domainname.focalprice + "Question/" + sku + "?callback=library.question.callback", {
            lock: true,
            id: "dialog_question",
            title: focalPriceTip.Products[0].askQuestionTitle
        });
    };

    this.add = function (url, sku) {
        if (library.mini.isSignin()) {
            library.question.create(sku);
        }
        else {
            library.mini.signin(url);
        }
    };
    this.callback = function () {
        if (art.dialog.get("dialog_question") != null && art.dialog.get("dialog_question") != undefined)
            library.dialog.close("dialog_question");
    };
};

library.vote = new function () {
    var voteYes = function (reviewid, success, failed) {
        __yesSuccessCallBack = success;
        __yesFailedCallBack = failed;

        $.post("/ReviewVote", { ReviewTextID: reviewid, postType: "good" }, function (data) {
            if (data != null) {
                if (data.result == true) {
                    __yesSuccessCallBack();
                }
                else {
                    __yesFailedCallBack();
                }
            }
        });
    };
    var voteNo = function (reviewid, success, failed) {
        __noSuccessCallBack = success;
        __noFailedCallBack = failed;
        $.post("/ReviewVote", { ReviewTextID: reviewid, postType: "bad" }, function (data) {
            if (data != null) {
                if (data.result == true) {
                    __noSuccessCallBack();
                }
                else {
                    __noFailedCallBack();
                }
            }
        });
    };
    this.yes = voteYes;
    this.no = voteNo;
};

library.shoppingcart = new function () {
    var create = function (sku) {
        var shoppingurl = library.domainname.shopping + "cart/add?productId=" + sku;
        window.location.href = shoppingurl;
    };
    var createAjax = function (sku, successCallback, failedCallback) {
        __createSuccessCallback = successCallback;
        __createFailedCallback = failedCallback;


        var shoppingurl = library.domainname.shopping + "cart/ajaxadd?productId=" + sku;
        $.get(shoppingurl, function (data) {
            if (data.result == true) {

                var result = "<div class=\"add_to_cardTips\">"
                 + "<p class=\"f18 c00 lh35\"><em>" + data.SuccessAddedQuantity + "</em> " + focalPriceTip.ShoppingCart[0].addcart + "</p>"
                 + "<p class=\"pt20 f11 alignR\">" + focalPriceTip.common[0].CloseDivTips + "</p>"
                 + "</div>";
                __createSuccessCallback();
                library.dialog.showDialog("Tips", result, null);

            }
            else {
                __createFailedCallback();
            }
        });
    };
    var cancel = function (sku, callback) {
        __deleteCallback = callback;

        var cartCookie = library.cookie.get("ShoppingCart");
        var products = cartCookie.split(',');
        var result = new Array();
        var index = 0;
        $.each(products, function (i, value) {
            if (value != null && value != "") {
                var productId = value;
                if (value.indexOf("*") > 0) {
                    productId = value.split('*')[0];
                }
                if (productId != sku) {
                    result[index] = value;
                }
                index++;
            }
        });
        var shoppingcart = "";
        $.each(result, function (i, value) {
            if (value != null && value != "") {
                if (shoppingcart == "") {
                    shoppingcart = value;
                }
                else {
                    shoppingcart += "," + value;
                }
            }
        });
        library.cookie.set("ShoppingCart", shoppingcart);

        __deleteCallback();
    };
    var current = function () {
        var shoppingcart = library.cookie.get("ShoppingCart");
        var quantity = 0;

        if (shoppingcart != "") {
            var products = shoppingcart.split(',');
            $.each(products, function (index, value) {
                if (value != null && value != "") {
                    if (value.indexOf("*") > 0) {
                        var count = value.split("*")[1];
                        quantity += parseInt(count);
                    }
                    else {
                        quantity += 1;
                    }
                }
            });
        }

        return quantity;
    };

    this.add = function (sku, successCallback, failedCallback) {
        if (successCallback == null || failedCallback == null) {
            create(sku);
        }
        else {
            createAjax(sku, successCallback, failedCallback);
        }
    };
    this.remove = cancel;
    this.total = current;
};

library.currency = {
    choose: function (url, currencycode) {
        $.post(url, { "currencyCode": currencycode }, function () {
            window.location.href = window.location.pathname;
        });
    }
};

Date.prototype.addDays = function (days) {
    ///<summary>增加指定天数</summary>
    var date = new Date(this.toString());
    date.setDate(this.getDate() + days);
    return date;
}

Date.prototype.addMonths = function (months) {
    ///<summary>增加指定月数</summary>
    var date = new Date(this.toString());
    date.setMonth(this.getMonth() + months);
    return date;
}


var source = library.querystring.get("Source");
if (source != null) {
    library.cookie.set("Source", library.querystring.get("Source"), new Date().addDays(90));
}