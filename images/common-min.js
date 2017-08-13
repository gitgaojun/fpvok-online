
/// <reference path="jquery-1.4.1.js" />
jQuery(function () {
    //切换货币
    var currencycode = library.cookie.get("Currency");
    if (currencycode == "") {
        currencycode = "USD";
    }
    jQuery("*[currencycode]").each(function () {
        if (!jQuery(this).hasClass("hide")) {
            jQuery(this).addClass("hide");
        }
        if (jQuery(this).attr("currencycode") == currencycode) {
            jQuery(this).removeClass("hide");
        }
    }); 
	if(jQuery(".proImg").length>0){
		jQuery(".proImg").find("img").lazyload();
	}
 
	jQuery("#list_sort").hover(function(){jQuery("#list_sort > a").addClass("active");jQuery("#list_sort .sortByMenu").show();},function(){jQuery("#list_sort > a").removeClass("active");jQuery("#list_sort .sortByMenu").hide();});
    //jQuery("form").submit(function () { jQuery(this).find("input[type=submit]").attr("disabled", "disabled"); jQuery(this).find("input[type=submit]").addClass("disable"); });
    //模拟select
    function FillSearchTopCategories(callback) {
        if (jQuery("#searchForm .selectPanelList").children().length > 1) { return; }
        $.getJSON("/AllTopCategories", function (jsonData) {
            var thisObj = jQuery("#searchForm .selectPanelList");
            var first = thisObj.children().first();
            $.each(jsonData, function (n, v) {
                var clone = first.clone();
                clone.attr("id", n);
                clone.html(v);
                thisObj.append(clone);
            });
            callback();
        });
    }
    function SearchTopCategoriesHover() {
        jQuery(".selectPanel").children().find('li').hover(function () { jQuery(this).addClass('selecthover') }, function () { jQuery(this).removeClass('selecthover') });
    }
    function SearchTopCategoriesChanged() {
        jQuery('ul.selectPanelList li').click(function () {
            jQuery(this).parents('li').find('span').html(jQuery(this).html());
            jQuery(this).parents('.selectPanel').find('ul').addClass("hide");
            var selectId = jQuery(this).attr("id").toString();
            if (selectId == null) {
                jQuery("#categoryid").val("");
            }
            else {
                jQuery("#categoryid").val(selectId);
            }
        });
    }
    jQuery('.selectPanelList').hide();
    jQuery(".selectPanel").click(function () {
        FillSearchTopCategories(function () {
            SearchTopCategoriesHover();
            SearchTopCategoriesChanged();
        });
        jQuery(".selectPanelList").toggle();
    });
    jQuery(document).bind('click',
		function (e) {
		    var clickme = jQuery(e.target);
		    if (!clickme.parents().hasClass("selectPanelWarp"))
		        jQuery(".selectPanelList").hide();
		});
    //导航
    jQuery(".siginin").hover(function () {
        jQuery(this).addClass("useractive");
        jQuery(this).children(".siginin_menu").show();

    }, function () {
        jQuery(this).removeClass("useractive");
        jQuery(this).children(".siginin_menu").hide();
    });
    jQuery(".account, .language, .currency").hover(function () {
        jQuery(this).children(".selMenu").addClass("active");
        jQuery(this).children(".down_men").show();
    }, function () {
        jQuery(this).children(".selMenu").removeClass("active");
        jQuery(this).children(".down_men").hide();
    });

    //导航栏下�?

    jQuery(".litem").hover(function () {
        jQuery(this).addClass("hoverClass");
        jQuery(this).children(".subitem").show();
    }, function () {
        jQuery(this).removeClass("hoverClass");
        jQuery(this).children(".subitem").hide();
    });

    //deals
    var timeTip;
    jQuery("#dealMenuPanle, #dealMenu").hover(
		function () {
		    clearTimeout(timeTip);
		    jQuery("#dealMenuPanle").show();
		},
		function () {
		    timeTip = setTimeout(function () {
		        jQuery("#dealMenuPanle").hide();
		    }, 200)
		});

    //Recently
    var scrtime;
    jQuery("#revieweditems_box").hover(function () {
        clearInterval(scrtime);
    }, function () {
        scrtime = setInterval(function () {
            var $ul = jQuery("#revieweditems_box .revieweditems_m"),
				liHeight = $ul.find("li:last").height();
            $ul.animate({ marginTop: liHeight + 1 + "px" }, 500, function () {
                $ul.find("li:last").prependTo($ul)
                $ul.find("li:first").hide();
                $ul.css({ marginTop: 0 });
                $ul.find("li:first").fadeIn(1000);
            })
        }, 3000);
    }).trigger("mouseleave");

    jQuery(".lbox_main_item:last-child").css("border-bottom", "none");
    jQuery('<div class="exclus_tips"><div class="exclus_text"></div></div>').appendTo('body');
    jQuery('.exclusTips').mouseover(function () {
        jQuery('.exclus_tips').css('visibility', 'visible');
        var el = this;
        if (el.title) { el.text = el.title; el.title = ''; }
        myText = el.text;
        jQuery('.exclus_text').html(myText);
    }).mousemove(function (e) {
        jQuery('.exclus_tips').css('top', e.pageY + 15);
        jQuery('.exclus_tips').css('left', e.pageX + 15);
    }).mouseout(function () {
        jQuery('.exclus_tips').css('visibility', 'hidden');
    });
	//推荐分类
	jQuery(".categories_pic div").hover(function() {
	jQuery(this).animate({"top": "-140px"}, 400, "swing");
	},function() {
		jQuery(this).stop(true,false).animate({"top": "0px"}, 400, "swing");
	});
	
})

