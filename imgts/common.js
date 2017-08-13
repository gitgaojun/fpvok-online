$(function ()
{
  //通知
  var notices = 'New version of FocalPrice went online on Oct 12, 2011. Let\'s celebrate!\
				 The website is working fine but we are still resolving a few minor bugs.Click \
				 <a class="cf50ulin" href="http://forums.focalprice.com/showtopic-32188.aspx">here</a>\
				  to leave your feedback. Thank you!',
		notices = '<p><span>' + notices + '</span></p><a class="close" href="javascript:void(0);"></a>';
  /*$("#topmenu").before('<div class="topNotice" id="transforDomainClose" style="z-index:300">' + notices + '</div>');
  $(".close").live("click", function(){
  $("#transforDomainClose").hide();	
  });
  */
/*  $.getJSON('http://promotion.focalprice.com/promotionservices/QueryDateTimeJSonP?jsoncallback=?', function (data)
  {
    var nowTime = data.Date;
    nowTime = nowTime.replace("-", "/").replace("-", "/"),
			    nowTime = new Date(nowTime);
    var year = nowTime.getFullYear(),
				month = nowTime.getMonth() + 1,
				day = nowTime.getDate(),
				endTime = year + "/" + month + "/" + day + " " + "23:59:59",

				endTime = new Date(endTime);
    var leftsecond = parseInt(endTime.getTime() - nowTime.getTime());
   // new leftTime('', '', '', '', document.getElementById('leftTime'), leftsecond, function () { });
  });*/
  //$("form").submit(function () { $(this).find("input[type=submit]").attr("disabled", "disabled"); $(this).find("input[type=submit]").addClass("disable"); });
  //模拟select
  $('.selectPanelList').hide();
  $(".selectPanel").bind("click", function ()
  {
    $(".selectPanelList").toggle();
    $(this).children().find('li').hover(function () { $(this).addClass('selecthover') }, function () { $(this).removeClass('selecthover') });
  });
  $('ul.selectPanelList li').click(function ()
  {
    $(this).parents('li').find('span').html($(this).html());
    $(this).parents('.selectPanel').find('ul').addClass("hide");
    var selectId = $(this).attr("id");
    if (selectId == null)
    {
      $("#categoryid").val("");
    }
    else
    {
      $("#categoryid").val(selectId);
    }
  });
  $(document).bind('click',
		function (e)
		{
		  var clickme = $(e.target);
		  if (!clickme.parents().hasClass("selectPanelWarp"))
		    $(".selectPanelList").hide();
		});
  //导航栏下拉
  $(".siginin").hover(function ()
  {
    $(this).addClass("useractive");
    $(this).children(".siginin_menu").show();

  }, function ()
  {
    $(this).removeClass("useractive");
    $(this).children(".siginin_menu").hide();
  });
  $(".account, .language, .currency").hover(function ()
  {
    $(this).children(".selMenu").addClass("active");
    $(this).children(".down_men").show();
  }, function ()
  {
    $(this).children(".selMenu").removeClass("active");
    $(this).children(".down_men").hide();
  });
  $(".litem").hover(function ()
  {
    $(this).addClass("hoverClass");
    $(this).children(".subitem").show();
  }, function ()
  {
    $(this).removeClass("hoverClass");
    $(this).children(".subitem").hide();
  });
  //deals
  var timeTip;
  $("#dealMenuPanle, #dealMenu").hover(
		function ()
		{
		  clearTimeout(timeTip);
		  $("#dealMenuPanle").show();
		},
		function ()
		{
		  timeTip = setTimeout(function ()
		  {
		    $("#dealMenuPanle").hide();
		  }, 200)
		});
  //Recently
  var scrtime;
  $("#revieweditems_box").hover(function ()
  {
    clearInterval(scrtime);
  }, function ()
  {
    scrtime = setInterval(function ()
    {
      var $ul = $("#revieweditems_box .revieweditems_m"),
				liHeight = $ul.find("li:last").height();
      $ul.animate({ marginTop: liHeight + 1 + "px" }, 500, function ()
      {
        $ul.find("li:last").prependTo($ul)
        $ul.find("li:first").hide();
        $ul.css({ marginTop: 0 });
        $ul.find("li:first").fadeIn(1000);
      })
    }, 3000);
  }).trigger("mouseleave");
  //Daily Deals
  var length = Math.round(Number($("#dailydeals_items .itembox").length) / 2);
  if (length > 1)
  {
    for (var i = 1; i < length + 1; i++)
    {
      $("#dailydeals_pages").append('<li>' + i + '</li>');
    }
  }
  $("#dailydeals_pages li").eq(0).addClass("active");
  $("#dailydeals_pages li").click(function ()
  {
    $(this).addClass("active").siblings().removeClass("active");
    var index = $("#dailydeals_pages li").index(this) * 2;
    $("#dailydeals_items > .itembox").eq(index).show().siblings().hide(); ;
    $("#dailydeals_items > .itembox").eq(index + 1).show();
  })
  //continue shopping
  $(".continueshopping_m").hover(function ()
  {
    if ($(this).find(".itembox").length > 2)
    {
      $(this).children(".continue_pages").children(".continue_prev").fadeIn();
      $(this).children(".continue_pages").children(".continue_next").fadeIn();
    }
  }, function ()
  {
    $(this).children(".continue_pages").children(".continue_prev").fadeOut();
    $(this).children(".continue_pages").children(".continue_next").fadeOut();
  });
/*  $.ScroolPro({
    wrap: ".continueshopping_m",
    preBtn: ".continue_prev",
    nextBtn: ".continue_next",
    content: ".continue_warp",
    listwrap: ".continue",
    listcon: ".itembox",
    page: 1,
    i: 2
  });*/
})

//清除文本框内容
function clearDefaultText(el, message)
{
  var obj = el;
  if (typeof (e1) == "string")
    obj = document.getElementById(id);
  if (obj.value == message)
  {
    obj.value = "";
    obj.style.color = "#ccc";
  }
  obj.onblur = function ()
  {
    if (obj.value == "")
    {
      obj.value = message;
      obj.style.color = "#ccc";
    }
  }
  obj.style.color = "#000";
}