var isondiv = 0;
var isondiv2 = 0;
var isondiv3=0;
var webType="";
var siteImageS3Url = "/Templates/Site61/Dino/images/";
var w3c=(document.getElementById)? true: false;
var agt=navigator.userAgent.toLowerCase();
var ie = ((agt.indexOf("msie") != -1) && (agt.indexOf("opera") == -1) && (agt.indexOf("omniweb") == -1));
var jsMainSiteUrl = "http://www.dinodirect.com/";
if(window.location.href.indexOf("dinotest.com") >0){
	jsMainSiteUrl = "http://www.dinotest.com/";
}
function IeTrueBody(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body;
}
function GetScrollTop(){
 return ie ? IeTrueBody().scrollTop : window.pageYOffset;
}
if(window.ActiveXObject)
{
	webType="IE";	
}
else
{
	webType="";	
}
function changeCurrency(str)
{
	SetCookie("_currency",str,24*7);
	var c2 = document.getElementById("Currency2");
	c2.innerHTML = '<iframe src="'+jsMainSiteUrl+'Changecurrency.cfm?cur=' + str + '"></iframe>';
}
	
function getOffset(obj) {
    var offset = {offsetLeft: 0, offsetTop: 0};
    while (obj) {
        offset.offsetLeft += obj.offsetLeft;
        offset.offsetTop += obj.offsetTop;
        obj = obj.offsetParent;
    }
    return offset;
}

function showCurrency(num)
{
	var showCur = document.getElementById("currencyshow");
	var pros = document.getElementById("imgshow");
	oRect = getOffset(pros);
	
    if (showCur.parentNode != null) {
	    oRect1 = getOffset(showCur.parentNode);
        oRect.offsetLeft = oRect.offsetLeft - oRect1.offsetLeft;
    }
	xpos = oRect.offsetLeft - 117;
	ypos = oRect.offsetTop + 16;
	showCur.style.left = xpos.toString() +'px';
	showCur.style.top = ypos.toString() +'px';
	showCur.style.zIndex = 1000;
	if(showCur.style.display == "none")
	{
		showCur.style.display = "";
	}
	else
	{
		showCur.style.display = "none";
	}
}

function showCurrencyNew(num)
{
	var showCur = document.getElementById("currencyshow");
	if(showCur.style.display == "none")
	{
		showCur.style.display = "";
		document.getElementById('curPopup').className='bt_popup';
	}
	else
	{
		showCur.style.display = "none";
		document.getElementById('curPopup').className='bt_pop';
	}
}

function showLanguageCurrency()
{
	var showCur = document.getElementById("currencyshowLanguage");
	var pros = document.getElementById("imgshowlanguage");
	oRect = getOffset(pros);
	
    if (showCur.parentNode != null) {
	    oRect1 = getOffset(showCur.parentNode);
        oRect.offsetLeft = oRect.offsetLeft - oRect1.offsetLeft;
    }
	xpos = oRect.offsetLeft - 117;
	ypos = oRect.offsetTop + 16;
	showCur.style.left = xpos.toString() +'px';
	showCur.style.top = ypos.toString() +'px';
	showCur.style.zIndex = 1000;
	if(showCur.style.display == "none")
	{
		showCur.style.display = "";
	}
	else
	{
		showCur.style.display = "none";
	}
}

function showLanguageCurrencyNew()
{
	var showCur = document.getElementById("currencyshowLanguage");
//	var pros = document.getElementById("imgshowlanguage");
//	oRect = getOffset(pros);
//	
//    if (showCur.parentNode != null) {
//	    oRect1 = getOffset(showCur.parentNode);
//        oRect.offsetLeft = oRect.offsetLeft - oRect1.offsetLeft;
//    }
//	xpos = oRect.offsetLeft - 117;
//	ypos = oRect.offsetTop + 16;
//	showCur.style.left = xpos.toString() +'px';
//	showCur.style.top = ypos.toString() +'px';

	if(showCur.style.display == "none")
	{
		showCur.style.display = "";
		document.getElementById('lanPopup').className='bt_popup';
	}
	else
	{
		showCur.style.display = "none";
		document.getElementById('lanPopup').className='bt_pop';
	}
}


function showCurrency2(num,mtop)
{
	var showCur = document.getElementById("currencyshow2");
	var pros = document.getElementById("imgshow2");
	oRect = getOffset(pros);
	
    if (showCur.parentNode != null) {
	    oRect1 = getOffset(showCur.parentNode);
        oRect.offsetLeft = oRect.offsetLeft - oRect1.offsetLeft;
    }
	xpos = oRect.offsetLeft ;
	xpos = xpos+14;
	if(typeof(mtop)!="undefined"){
		ypos = oRect.offsetTop + mtop;
	}else{
		ypos = oRect.offsetTop + 25;
	}
	showCur.style.left = xpos.toString() +'px';
	showCur.style.top = ypos.toString() +'px';
	showCur.style.zIndex = 1000;
	if(showCur.style.display == "none")
	{
		showCur.style.display = "";
	}
	else
	{
		showCur.style.display = "none";
	}
}

function showCurrency3(num)
{
	var showCur = document.getElementById("currencyshow3");
	var pros = document.getElementById("imgshow3");
	oRect = getOffset(pros);
	
    if (showCur.parentNode != null) {
	    oRect1 = getOffset(showCur.parentNode);
    }
	xpos = oRect.offsetLeft;
	ypos = oRect.offsetTop + 30;
	showCur.style.left = xpos.toString() +'px';
	showCur.style.top = ypos.toString() +'px';
	showCur.style.zIndex = 1000;
	if(showCur.style.display == "none")
	{
		showCur.style.display = "";
	}
	else
	{
		showCur.style.display = "none";
	}
}

function showthiscur()
{
	isondiv = 1;
}
function showthiscur2()
{
	isondiv2 = 1;
}
function showthiscur3()
{
	isondiv3 = 1;
}

function changeCurr(str)
{
	var curr = document.getElementById("curr");
	window.location = "/Shoppingcart/?cur=" + str;
}

function closecurdiv()
{
	isondiv = 0;
	setTimeout(closedivwhenmoveout, 250);
}

function closecurdiv2()
{
	isondiv2 = 0;
	setTimeout(closedivwhenmoveout2, 250);
}
function closecurdiv3()
{
	isondiv3 = 0;
	setTimeout(closedivwhenmoveout3, 250);
}

function closedivwhenmoveout()
{
	var showCur = document.getElementById("currencyshow");

	var showCur3 = document.getElementById("div_MyAccount");
	var showCur4 = document.getElementById("div_MyCommunity");
	if(isondiv == 0){
		showCur.style.display = "none";
		document.getElementById('curPopup').className='bt_pop';
		showCur3.style.display = "none";
		document.getElementById('accPopup').className='bt_pop bt_popup_long';
		showCur4.style.display = "none";
		document.getElementById('accPopup2').className='bt_pop bt_popup_long';
	}
}

function closedivwhenmoveout2()
{
	var showCur = document.getElementById("currencyshow2");
	if(isondiv2 == 0)
		showCur.style.display = "none";
}

function closedivwhenmoveout3()
{
	var showCur = document.getElementById("currencyshow3");
	if(isondiv3 == 0)
		showCur.style.display = "none";
}


function AdAnalyticsRecord(urlparam)
{
	var urlparam=urlparam.replace(new RegExp("-","gi"),"|");
	if(typeof(jsMainSiteUrl) !="undefined"){
		var AdAnalyticsHTTP = jsMainSiteUrl + "task/AdAnalytics.cfm";
	}else{
		var AdAnalyticsHTTP = "http://www.dinodirect.com/task/AdAnalytics.cfm";
	}
	AdAnalyticsHTTP = AdAnalyticsHTTP + "?AdAnalytics="+urlparam;
	var ins=urlparam.split("|");
	if(ins.length>=5 && ins[3]!=1){
		var urlcode = ReadCookie("urlcode");
		var cilckcookiekey="ClickAdAnalytics"+ins[2];
		if(urlcode==""){
			SetCookie("urlcode",new Date().getTime(),24);
			urlcode = ReadCookie("urlcode");
		}
		AdAnalyticsHTTP = AdAnalyticsHTTP + "&urlcode="+urlcode;
		if(ins[3]==2){
			if(ins[0]>0){
				var ckv=ins[0]+"|"+ins[1]+"|"+ins[2]+"|3|"+ins[4];
				SetCookie("AdAnalytics",ckv,24);
			}
			if(ReadCookie(cilckcookiekey)==""){
				SetCookie(cilckcookiekey,ins[2],24);
				document.writeln("<script src=\""+AdAnalyticsHTTP+"\"></script>");
			}
		}else{
			document.writeln("<script src=\""+AdAnalyticsHTTP+"\"></script>");
		}
	}
}

function EDMRecord(EmailMarketingHTTP,OrderAmt){
	var edmhid = ReadCookie("EDM_hid");
	var edmuserid = ReadCookie("EDM_userID");
	if(edmhid!="" && edmuserid!=""){
		document.writeln('<div style="display: none;"><iframe id="Iframe_EDM" name="Iframe_EDM"></iframe></div>');
		document.writeln('<form name="Form_EDM" id="Form_EDM" method="post" target="Iframe_EDM" action="'+EmailMarketingHTTP+'SendEmail/readclicktimes.cfm">');
		document.writeln('<input type="hidden" name="edm_hid" id="edm_hid" value="'+edmhid+'" />');
		document.writeln('<input type="hidden" name="edm_userid" id="edm_userid" value="'+edmuserid+'" />');
		document.writeln('<input type="hidden" name="edm_Sales" id="edm_Sales" value="'+OrderAmt+'" />');
		document.writeln('<input type="hidden" name="type" id="type" value="PayMyOrder" />');
		document.writeln('</form>');
		try
		{
			var TempForm_EDM = document.getElementById("Form_EDM");
			TempForm_EDM.submit();
		}
		catch(e)
		{
		}
	}
}

function ShowLeftLongbanner(cf_pics,cf_links,cf_texts)
{
	var focus_width=165; 
	var focus_height=400;
	var text_height=0;
	var swf_height = focus_height+text_height;
	var pics=cf_pics;
	var links=cf_links;
	var texts=cf_texts;
	document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="'+ focus_width +'" height="'+ swf_height +'">');
	document.write('<param name="allowScriptAccess" value="sameDomain"><param name="movie" value="/images/ad.swf"> <param name="quality" value="high"><param name="bgcolor" value="#CCCCCC">');
	
	document.write('<param name="menu" value="false"><param name=wmode value="opaque">');
	document.write('<param name="FlashVars" value="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'">');
	
	document.write('<embed src="/images/ad.swf" wmode="opaque" FlashVars="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'" menu="false" bgcolor="#ffffff" quality="high" width="'+ focus_width +'" height="'+ swf_height +'" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />');
	document.write('</object>');	
}

function affid_getParam(s_affidString){
	affid_id = window.location.href.toLowerCase().split("/");
	iRandom = Math.floor(Math.random()*100+1);
	for(var i = 0; i < affid_id.length; i++) {
		if(affid_id[i].substring(0,s_affidString.length)==s_affidString){
			affid_id = affid_id[i].split("-");
			affid_id = affid_id[1].split(".")[0];
			if(affid_id && isNaN(affid_id)==false){
				SetCookie("AFFILIATELINKID",affid_id,2160);
			}
		}
	}
}
function getUrlArgs() {
    var args = new Object( );
    var query = window.location.search.substring(1);     // Get query string
	query = decodeURIComponent(query.toLowerCase());
	var affid_urlLink_p = decodeURIComponent(window.location.href.toLowerCase());
	if(affid_urlLink_p.indexOf('~p.')>0){
		if(affid_urlLink_p.indexOf('.com/~p.')>0){
		affid_urlLink_p = affid_urlLink_p.replace(".com/~p.",".com/?p=");
		affid_urlLink_p = affid_urlLink_p.replace("~p.","&p=");
		}else{
		affid_urlLink_p = affid_urlLink_p.replace("~p.","?p=");
		}
		query = affid_urlLink_p.substring(affid_urlLink_p.indexOf('?')+1);
		query = query.replace("?","&");
	}
	query = query.replace("~p=","p=");
	if(query.indexOf('=')==-1){query = query + "=1";}
    var pairs = query.split("&");                 // Break at ampersand
    for(var i = 0; i < pairs.length; i++) {
        var pos = pairs[i].indexOf('=');          // Look for "name=value"
        if (pos == -1) continue;                  // If not found, skip
        var argname = pairs[i].substring(0,pos);  // Extract the name
        var value = pairs[i].substring(pos+1);    // Extract the value
        value = decodeURIComponent(value);        // Decode it, if needed
        args[argname] = value;                    // Store as a property
    }
    return args;                                  // Return the object
}


function trim(s){return rtrim(ltrim(s));}
function ltrim(s){if(s){return s.replace( /^\s*/, "");}else{return "";}} 
function rtrim(s){if(s){return s.replace( /\s*$/, "");}else{return "";}}

function getOffset(obj) {
    var offset = {offsetLeft: 0, offsetTop: 0};
    while (obj) {
        offset.offsetLeft += obj.offsetLeft;
        offset.offsetTop += obj.offsetTop;
        obj = obj.offsetParent;
    }
    return offset;
}

function OpenMyAccount(ShowType)
{
	var MyAccount = document.getElementById("div_MyAccount");
	var pros = document.getElementById("A_MyAccount");
	oRect = getOffset(pros);
	
    if (MyAccount.parentNode != null) {
	    oRect1 = getOffset(MyAccount.parentNode);
        oRect.offsetLeft = oRect.offsetLeft - oRect1.offsetLeft;
    }
	xpos = oRect.offsetLeft - 90;
	ypos = oRect.offsetTop + 16;
	MyAccount.style.left = xpos.toString() +'px';
	MyAccount.style.top = ypos.toString() +'px';
	MyAccount.style.zIndex = 1000;
	if(MyAccount.style.display == "none")
	{
		MyAccount.style.display = "";
	}
	else
	{
		MyAccount.style.display = "none";
	}
}

function OpenCommunityNew(ShowType)
{
	
	jQuery(".bt_popup_p3").hide();
	document.getElementById('accPopup').className='bt_pop bt_popup_long';
	var MyAccount = document.getElementById("div_MyCommunity");
//	var pros = document.getElementById("A_MyAccount");
//	oRect = getOffset(pros);
//	
//    if (MyAccount.parentNode != null) {
//	    oRect1 = getOffset(MyAccount.parentNode);
//        oRect.offsetLeft = oRect.offsetLeft - oRect1.offsetLeft;
//    }
//	xpos = oRect.offsetLeft - 90;
//	ypos = oRect.offsetTop + 16;
//	MyAccount.style.left = xpos.toString() +'px';
//	MyAccount.style.top = ypos.toString() +'px';
	MyAccount.style.display = "";
	document.getElementById('accPopup2').className='bt_popup bt_popup_long';
}

function OpenMyAccountNew(ShowType)
{
	
	jQuery(".bt_popup_p3").hide();
	document.getElementById('accPopup2').className='bt_pop bt_popup_long';
	var MyAccount = document.getElementById("div_MyAccount");
//	var pros = document.getElementById("A_MyAccount");
//	oRect = getOffset(pros);
//	
//    if (MyAccount.parentNode != null) {
//	    oRect1 = getOffset(MyAccount.parentNode);
//        oRect.offsetLeft = oRect.offsetLeft - oRect1.offsetLeft;
//    }
//	xpos = oRect.offsetLeft - 90;
//	ypos = oRect.offsetTop + 16;
//	MyAccount.style.left = xpos.toString() +'px';
//	MyAccount.style.top = ypos.toString() +'px';
	MyAccount.style.display = "";
	document.getElementById('accPopup').className='bt_popup bt_popup_long';
}

function CloseMyAccount()
{
	var MyAccount = document.getElementById("div_MyAccount");
	MyAccount.style.display = "none";
}

function ReadCookie(name){      
  var cookieValue='';      
  var search=name+'=';      
  if(document.cookie.length>0){      
    offset=document.cookie.indexOf(search);      
    if (offset!=-1){      
      offset+=search.length;      
      end=document.cookie.indexOf(';', offset);      
      if (end == -1) end=document.cookie.length;      
      cookieValue = unescape(document.cookie.substring(offset,end))      
    }      
  }      
  return cookieValue;      
}      
     
function SetCookie(name,value,hours){      
  var expire = "";  
  path="/";   
  if(hours != null){      
    expire = new Date((new Date()).getTime() + hours * 3600000);      
    expire = "; expires=" + expire.toGMTString();      
  } 
  var SiteName = "dinodirect.com";
  if(window.location.href.indexOf("dinotest.com") >0){
   SiteName = "dinotest.com";
  }
  if(name.toLowerCase()=="affiliatelinkid"){
	  var affidck = ReadCookie(name);
	  if(affidck>0 && affidck!=value){
		  document.cookie = "AFFILIATELINKNEXTID" + "=" + escape(value) + expire + ((path == null) ? "" : (";domain="+SiteName+"; path=" + path));
	  }else{
		  document.cookie = name + "=" + escape(value) + expire + ((path == null) ? "" : (";domain="+SiteName+"; path=" + path));
		  document.cookie = "AFFILIATELINKNEXTID" + "=" + escape(value) + expire + ((path == null) ? "" : (";domain="+SiteName+"; path=" + path));
	  }
  }else{
	  document.cookie = name + "=" + escape(value) + expire + ((path == null) ? "" : (";domain="+SiteName+"; path=" + path)); 
  }
}

function CheckBottomForm()
{
	var orderId = document.getElementById('bottomSeOrderId').value;
	orderId = trim(orderId.toLowerCase());
	orderIdArray = orderId.split("-");
	var str = 'Invalid Order No.';
	if(orderId == "")
	{
		document.getElementById('BottomErrorMsg').innerHTML = str;
		return false;
	}
	if(orderIdArray.length != 2)
	{
		document.getElementById('BottomErrorMsg').innerHTML = str;
		return false;	
	}
	if(orderIdArray[0] == "")
	{
		document.getElementById('BottomErrorMsg').innerHTML = str;
		return false;
	}
	if(orderIdArray[1].search('dd') == -1 || orderIdArray[1].substring(parseInt(orderIdArray[1].length - 2),parseInt(orderIdArray[1].length)) != 'dd' || orderIdArray[1].length != 2)
	{
		document.getElementById('BottomErrorMsg').innerHTML = str;
		return false;
	}
	document.getElementById('BottomErrorMsg').innerHTML = '';
	return true;
}

/*****************************/


var DealDate = function(sDate,eDate,showobj,showtype,showindex){
	this.startDailyDeal=sDate;
	this.endDailyDeal=eDate;
	this.timeobj=showobj;
	this.timetype=showtype;
	if(showindex){
		this.showindex = showindex;
	}
};
DealDate.prototype.loopDailyDeal = 1;
DealDate.prototype.show_timeDailyDeal = function(){
	var _self = this;
	if (this.endDailyDeal <= this.startDailyDeal && this.timetype != 4) {return;}
	var alltimeDailyDeal = parseInt((this.endDailyDeal - this.startDailyDeal) / 1000) - this.loopDailyDeal;
	var isCs = 0;
	if(alltimeDailyDeal < 0){
		alltimeDailyDeal = alltimeDailyDeal + 86400;
		isCs = 1;
	}
	var dDailyDeal = parseInt(alltimeDailyDeal / 86400);
	var hDailyDeal = parseInt((alltimeDailyDeal - dDailyDeal*86400) / 3600);
	var h2DailyDeal = parseInt((alltimeDailyDeal) / 3600);
	var mDailyDeal = parseInt((alltimeDailyDeal - dDailyDeal*86400 - hDailyDeal*3600) / 60);
	var sDailyDeal = parseInt(alltimeDailyDeal - dDailyDeal*86400 - hDailyDeal*3600 - mDailyDeal*60);
	this.loopDailyDeal ++;
	if(this.timetype==1){
		this.timeobj.innerHTML = this.format_numberDailyDeal(h2DailyDeal) + "<span class='delimiter'>:</span>" + this.format_numberDailyDeal(mDailyDeal) + "<span class='delimiter'>:</span>" + this.format_numberDailyDeal(sDailyDeal);
	}else if(this.timetype==2){
		this.timeobj[0].innerHTML = this.format_numberDailyDeal(h2DailyDeal);
		this.timeobj[1].innerHTML = this.format_numberDailyDeal(mDailyDeal);
		this.timeobj[2].innerHTML = this.format_numberDailyDeal(sDailyDeal);
	}else if(this.timetype==3){
		this.timeobj[0].innerHTML = dDailyDeal;
		this.timeobj[1].innerHTML = this.format_numberDailyDeal(hDailyDeal);
		this.timeobj[2].innerHTML = this.format_numberDailyDeal(mDailyDeal);
		this.timeobj[3].innerHTML = this.format_numberDailyDeal(sDailyDeal);	
	}else if(this.timetype==4){
		if(dDailyDeal>0){
			hDailyDeal = hDailyDeal + dDailyDeal*24;
		}
		isStop = 0;
		if((hDailyDeal==0 && mDailyDeal==0 && sDailyDeal==0) || isCs==1){
			isStop = 1;
		}
		hDailyDeal = this.format_numberDailyDeal(hDailyDeal)+"";
		mDailyDeal = this.format_numberDailyDeal(mDailyDeal)+"";
		sDailyDeal = this.format_numberDailyDeal(sDailyDeal)+"";
		if(this.timeobj[0]){
			this.timeobj[0].innerHTML = hDailyDeal.substring(0,1);
			this.timeobj[1].innerHTML = hDailyDeal.substring(2,1);
			this.timeobj[2].innerHTML = mDailyDeal.substring(0,1);
			this.timeobj[3].innerHTML = mDailyDeal.substring(2,1);
			this.timeobj[4].innerHTML = sDailyDeal.substring(0,1);
			this.timeobj[5].innerHTML = sDailyDeal.substring(2,1);
		}else{
			return;	
		}
		if(isStop==1){
			if(document.getElementById("dailydeal_li_"+this.showindex)){
				var ddliobj = document.getElementById("dailydeal_li_"+this.showindex);
				if(document.getElementById("Spare"+SpareRow)){
					var SpareHtml = document.getElementById("Spare"+SpareRow).innerHTML;
					document.getElementById("Spare"+SpareRow).innerHTML = "";
					ddliobj.innerHTML = SpareHtml;
					checkDailyDealRunAny(SpareRow);
					SpareRow = SpareRow + 1;
					return;
				}
			}else if(document.getElementById("dailydeal_main"+this.showindex)){
				var ddliobj = document.getElementById("dailydeal_main"+this.showindex);
				if(document.getElementById("Spare_main2")){
					var SpareHtml = document.getElementById("Spare_main2").innerHTML;
					document.getElementById("Spare_main2").innerHTML = "";
					ddliobj.innerHTML = SpareHtml;
					checkDailyDealRunAny(2);
					return;
				}
			}
		}
	}
	window.setTimeout(function(){_self.show_timeDailyDeal();},1000);

};
DealDate.prototype.format_numberDailyDeal = function(n){if (n < 10) {return "0" + n;}else{return n;}};


var Surveycookiekey="Surveycookie";
var Showkey="showPhone";
function OpenOnlineSurvey(){
	window.open('/Online Survey.cfm','_bank','height=220,width=570,top=350,left=350,toolbar=no,menubar=no,scrollbar=no,resizable=no,location=no,status=no');
	SetCookie(Surveycookiekey,1,720);
}
function setShowPhone(){
	SetCookie(Showkey,1,720);
}

if(ReadCookie(Surveycookiekey)!=1 && ReadCookie(Showkey)==1){
	window.onload=function(){
		window.onunload=OpenOnlineSurvey;
	};
}

function addCart(url,pid,cur,kid){
	if(pid==0){
		if(cur==''){
			window.top.location.href = url+"Shoppingcart/";
		}else{
			window.top.location.href = url+"Shoppingcart/"+cur;
		}
	}else{
		try{
			pageTracker._trackEvent('Shopcart', 'Add to Cart', kid, 1);
		}catch(e){}	
		window.top.location.href = url+"Shoppingcart/ProductID-"+pid+cur+".html";
	}
}

function checkLanguage(tid,url){
	var paramurl = url.replace(":","%3A");
	paramurl = paramurl.replace(/[/]/g,"%2F");
	paramurl = paramurl.replace("?","%3F");
	paramurl = paramurl.replace(/[&]/g,"%26");
	var ggstr = "http://translate.google.com/translate";
	// set locale 
	var localeStr = "en";
	var localeStrTemp = "en";
	if(tid==1){
		localeStr = "en";
		//window.top.location.href = url;
	}else if(tid==2){
		localeStr = "de";
		//window.top.location.href = ggstr+"?hl=de&sl=en&tl=de&u="+paramurl;
	}else if(tid==3){
		localeStr = "fr";
		//window.top.location.href = ggstr+"?hl=fr&sl=en&tl=fr&u="+paramurl;
	}else if(tid==4){
		localeStr = "nl";
//		window.top.location.href = ggstr+"?hl=nl&sl=en&tl=nl&u="+paramurl;
	}else if(tid==5){
		localeStr = "ru";
		localeStrTemp = "ru";
//		window.top.location.href = ggstr+"?hl=ru&sl=en&tl=ru&u="+paramurl;
	}else if(tid==6){
		localeStr = "es";
//		window.top.location.href = ggstr+"?hl=es&sl=en&tl=es&u="+paramurl;
	}else if(tid==7){
		localeStr = "it";
//		window.top.location.href = ggstr+"?hl=it&sl=en&tl=it&u="+paramurl;
	}else if(tid==8){
		localeStr = "pt";
		localeStrTemp = "pt";
//		window.top.location.href = ggstr+"?hl=pt&sl=en&tl=pt&u="+paramurl;
	}
	//alert(localeStr);
	SetCookie("CLOCALE",localeStrTemp,24);
	//alert(ReadCookie("CLOCALE"));
	if (tid == 1) {
		window.top.location.href = url;
	} else {
		window.top.location.href = ggstr+"?hl="+localeStr+"&sl=en&tl="+localeStr+"&u="+paramurl;
	}
}

// 购物车切换语言 create by wangwenzhou at 2011-3-14
function checkLanguageForCart(tid,url) {
	var localeStr = "en";
	switch(tid){
		case 2:localeStr = "de";break;
		case 3:localeStr = "fr";break;
		case 4:localeStr = "nl";break;
		case 5:localeStr = "ru";break;
		case 6:localeStr = "es";break;
		case 7:localeStr = "it";break;
		case 8:localeStr = "pt";break;
		case 1:
		default:localeStr = "en";break;
	}
	SetCookie("CLOCALE",localeStr,24);
	//alert(ReadCookie("CLOCALE"));
	window.top.location.href = url;
}

function checkWholesaleAccount(no){
	for(var i=1;i<=6;i++){
		if(document.getElementById("AccountOpen"+i)){
			if(i==no){
				document.getElementById("AccountOpen"+i).className="current";
				document.getElementById("ShowOpen"+i).style.display="";
			}else{
				document.getElementById("AccountOpen"+i).className="click";
				document.getElementById("ShowOpen"+i).style.display="none";
			}
		}
	}
}
function importStaticfiles(path,type){
	var s,i;
	if(type=="js"){
		s=document.createElement("script");
		s.type="text/javascript";s.src=path;
	}
	if(document.getElementById("cartCountjsarea")){
		document.getElementById("cartCountjsarea").appendChild(s);
	}
}



var affid_urlLink = decodeURIComponent(window.location.href.toLowerCase());
var urlLink = window.location.href;

var refurllink = document.referrer;

if(ReadCookie("WREFROM")==""){
	SetCookie("WREFROM"," ",2160);
}

if(refurllink!="" && refurllink.indexOf(".dinodirect.com")==-1){
	SetCookie("WREFROM",refurllink,2160);
}
if(affid_urlLink.indexOf("?d=")>0 || affid_urlLink.indexOf("&d=")>0){
	var Aindex = affid_urlLink.indexOf("?d=");
	if(Aindex==-1){
		Aindex = affid_urlLink.indexOf("&d=");
	}
	Aindex = Aindex+3;
	for(var i=1;i<=affid_urlLink.length-Aindex;i++){
		var thisvar = affid_urlLink.substring(Aindex+i-1,Aindex+i);
		if(thisvar=="&"){
			i=i-1;
			break;	
		}
	}
	var urld = urlLink.substring(Aindex,Aindex+i);
	if(!isNaN(urld)){
		SetCookie("WREFROM",urlLink,2160);
	}
}


if(affid_urlLink.indexOf("affid=")>0){
	affid_id = getUrlArgs()["affid"];
	if(affid_id && isNaN(affid_id)==false){SetCookie("AFFILIATELINKID",affid_id,2160);}
}
if(affid_urlLink.indexOf("s=")>0){
	affid_id = getUrlArgs()["s"];
	if(affid_id && isNaN(affid_id)==false){SetCookie("AFFILIATELINKID",affid_id,2160);}
}
if(affid_urlLink.indexOf("?d=")>0 || affid_urlLink.indexOf("&d=")>0){
	SetCookie("AFFILIATELINKID",398,2160);
	SetCookie("AFFILIATELINKNEXTID",398,2160);
}
if(affid_urlLink.indexOf("?sid=")>0 || affid_urlLink.indexOf("&sid=")>0){
	var Aindex = affid_urlLink.indexOf("?sid=");
	if(Aindex==-1){
		Aindex = affid_urlLink.indexOf("&sid=");
	}
	Aindex = Aindex+5;
	for(var i=1;i<=affid_urlLink.length-Aindex;i++){
		var thisvar = affid_urlLink.substring(Aindex+i-1,Aindex+i);
		if(thisvar=="&"){
			i=i-1;
			break;	
		}
	}
	var GoogleSessionID = urlLink.substring(Aindex,Aindex+i);
	if(GoogleSessionID.toLowerCase().indexOf("gan_")>=0){
		SetCookie("GoogleSessionID",GoogleSessionID,2160);
	}
}
if(affid_urlLink.indexOf("?kwid=")>0 || affid_urlLink.indexOf("&kwid=")>0){
	var Aindex = affid_urlLink.indexOf("?kwid=");
	if(Aindex==-1){
		Aindex = affid_urlLink.indexOf("&kwid=");
	}
	Aindex = Aindex+6;
	for(var i=1;i<=affid_urlLink.length-Aindex;i++){
		var thisvar = affid_urlLink.substring(Aindex+i-1,Aindex+i);
		if(thisvar=="&"){
			i=i-1;
			break;	
		}
	}
	var adsageID = urlLink.substring(Aindex,Aindex+i);
	if(adsageID!=""){
		SetCookie("adsageID",adsageID,2160);
	}
}
//<!-- 联盟渠道Google Affiliate Network新增追踪代码 获取clickid 2011-10-10 Du Zixin  -->
if(affid_urlLink.indexOf("?clickid=")>0 || affid_urlLink.indexOf("&clickid=")>0){
	var Aindex = affid_urlLink.indexOf("?clickid=");
	if(Aindex==-1){
		Aindex = affid_urlLink.indexOf("&clickid=");
	}
	Aindex = Aindex+9;
	for(var i=1;i<=affid_urlLink.length-Aindex;i++){
		var thisvar = affid_urlLink.substring(Aindex+i-1,Aindex+i);
		if(thisvar=="&"){
			i=i-1;
			break;	
		}
	}
	var adsageID = urlLink.substring(Aindex,Aindex+i);
	if(adsageID!=""){
		SetCookie("clickid",adsageID,2160);
	}
}



var AID="";
var PID="";
if(affid_urlLink.indexOf("?aid=")>0 || affid_urlLink.indexOf("&aid=")>0){
	var Aindex = affid_urlLink.indexOf("?aid=");
	if(Aindex==-1){
		Aindex = affid_urlLink.indexOf("&aid=");
	}
	Aindex = Aindex+5;
	for(var i=1;i<=affid_urlLink.length-Aindex;i++){
		var thisvar = affid_urlLink.substring(Aindex+i-1,Aindex+i);
		if(thisvar=="&"){
			i=i-1;
			break;	
		}
	}
	AID = urlLink.substring(Aindex,Aindex+i);
}
if(affid_urlLink.indexOf("?pid=")>0 || affid_urlLink.indexOf("&pid=")>0){
	var Aindex = affid_urlLink.indexOf("?pid=");
	if(Aindex==-1){
		Aindex = affid_urlLink.indexOf("&pid=");
	}
	Aindex = Aindex+5;
	for(var i=1;i<=affid_urlLink.length-Aindex;i++){
		var thisvar = affid_urlLink.substring(Aindex+i-1,Aindex+i);
		if(thisvar=="&"){
			i=i-1;
			break;	
		}
	}
	PID = urlLink.substring(Aindex,Aindex+i);
}

if((affid_urlLink.indexOf("?edm_hid=")>0 || affid_urlLink.indexOf("&edm_hid=")>0) && (affid_urlLink.indexOf("?edm_userid=")>0 || affid_urlLink.indexOf("&edm_userid=")>0)){
	var Aindex = affid_urlLink.indexOf("?edm_hid=");
	if(Aindex==-1){
		Aindex = affid_urlLink.indexOf("&edm_hid=");
	}
	Aindex = Aindex+9;
	for(var i=1;i<=affid_urlLink.length-Aindex;i++){
		var thisvar = affid_urlLink.substring(Aindex+i-1,Aindex+i);
		if(thisvar=="&"){
			i=i-1;
			break;	
		}
	}
	var EDM_hid = urlLink.substring(Aindex,Aindex+i);

	var Aindex = affid_urlLink.indexOf("?edm_userid=");
	if(Aindex==-1){
		Aindex = affid_urlLink.indexOf("&edm_userid=");
	}
	Aindex = Aindex+12;
	for(var i=1;i<=affid_urlLink.length-Aindex;i++){
		var thisvar = affid_urlLink.substring(Aindex+i-1,Aindex+i);
		if(thisvar=="&"){
			i=i-1;
			break;	
		}
	}
	var EDM_userID = urlLink.substring(Aindex,Aindex+i);
	
	SetCookie("EDM_hid",EDM_hid,2160);
	SetCookie("EDM_userID",EDM_userID,2160);
}

if(affid_urlLink.indexOf("?id=")>0 || affid_urlLink.indexOf("&id=")>0){
	var Aindex = affid_urlLink.indexOf("?id=");
	if(Aindex==-1){
		Aindex = affid_urlLink.indexOf("&id=");
	}
	Aindex = Aindex+4;
	for(var i=1;i<=affid_urlLink.length-Aindex;i++){
		var thisvar = affid_urlLink.substring(Aindex+i-1,Aindex+i);
		if(thisvar=="&"){
			i=i-1;
			break;	
		}
	}
	var ID = urlLink.substring(Aindex,Aindex+i);
	var idary = ID.split(".");
	if(idary.length==4){
        var SeriesID = idary[0];
        var GroupID = idary[1];
        var AdvertisementID = idary[2];
        var KeywordsID = idary[3];
		if(!isNaN(SeriesID) && !isNaN(GroupID) && !isNaN(AdvertisementID) && !isNaN(KeywordsID)){
			SetCookie("SeriesID",SeriesID,2160);
			SetCookie("GroupID",GroupID,2160);
			SetCookie("AdvertisementID",AdvertisementID,2160);
			SetCookie("KeywordsID",KeywordsID,2160);
		}
	}
}

if(affid_urlLink.indexOf("?resource=affid-")>0 || affid_urlLink.indexOf("&resource=affid-")>0){
	var Aindex = affid_urlLink.indexOf("?resource=affid-");
	if(Aindex==-1){
		Aindex = affid_urlLink.indexOf("&resource=affid-");
	}
	Aindex = Aindex+16;
	for(var i=1;i<=affid_urlLink.length-Aindex;i++){
		var thisvar = affid_urlLink.substring(Aindex+i-1,Aindex+i);
		if(isNaN(thisvar)){
			i=i-1;
			break;	
		}
	}
	var affid = affid_urlLink.substring(Aindex,Aindex+i);
	if(!isNaN(affid) && affid!=''){
		SetCookie("AFFILIATELINKID",affid,2160);
	}
}
if(affid_urlLink.indexOf("?resource=s-")>0 || affid_urlLink.indexOf("&resource=s-")>0){
	var Aindex = affid_urlLink.indexOf("?resource=s-");
	if(Aindex==-1){
		Aindex = affid_urlLink.indexOf("&resource=s-");
	}
	Aindex = Aindex+12;
	for(var i=1;i<=affid_urlLink.length-Aindex;i++){
		var thisvar = affid_urlLink.substring(Aindex+i-1,Aindex+i);
		if(isNaN(thisvar)){
			i=i-1;
			break;	
		}
	}
	var affid = affid_urlLink.substring(Aindex,Aindex+i);
	if(!isNaN(affid) && affid!=''){
		SetCookie("AFFILIATELINKID",affid,2160);
	}
}

var ref_affid = 0;
var siteid = 0;
if(affid_urlLink.indexOf("?ref=affid-")>0 || affid_urlLink.indexOf("&ref=affid-")>0){
	var Aindex = affid_urlLink.indexOf("?ref=affid-");
	if(Aindex==-1){
		Aindex = affid_urlLink.indexOf("&ref=affid-");
	}
	Aindex = Aindex+11;
	for(var i=1;i<=affid_urlLink.length-Aindex;i++){
		var thisvar = affid_urlLink.substring(Aindex+i-1,Aindex+i);
		if(isNaN(thisvar)){
			i=i-1;
			break;	
		}
	}
	var affid = affid_urlLink.substring(Aindex,Aindex+i);
	if(!isNaN(affid) && affid!=''){
		SetCookie("AFFILIATELINKID",affid,2160);
		ref_affid = affid;
	}
}
if(affid_urlLink.indexOf("?ref=s-")>0 || affid_urlLink.indexOf("&ref=s-")>0){
	var Aindex = affid_urlLink.indexOf("?ref=s-");
	if(Aindex==-1){
		Aindex = affid_urlLink.indexOf("&ref=s-");
	}
	Aindex = Aindex+7;
	for(var i=1;i<=affid_urlLink.length-Aindex;i++){
		var thisvar = affid_urlLink.substring(Aindex+i-1,Aindex+i);
		if(isNaN(thisvar)){
			i=i-1;
			break;	
		}
	}
	var affid = affid_urlLink.substring(Aindex,Aindex+i);
	if(!isNaN(affid) && affid!=''){
		SetCookie("AFFILIATELINKID",affid,2160);
		ref_affid = affid;
	}
}

if((affid_urlLink.indexOf("?siteid=")>0 || affid_urlLink.indexOf("&siteid=")>0) && affid_urlLink.indexOf("&returnurl=")<=0 && affid_urlLink.indexOf("?returnurl=")<=0){
	var Aindex = affid_urlLink.indexOf("?siteid=");
	if(Aindex==-1){
		Aindex = affid_urlLink.indexOf("&siteid=");
	}
	Aindex = Aindex+8;
	for(var i=1;i<=affid_urlLink.length-Aindex;i++){
		var thisvar = affid_urlLink.substring(Aindex+i-1,Aindex+i);
		if(thisvar=='&'){
			i=i-1;
			break;	
		}
	}
	siteid = window.location.href.substring(Aindex,Aindex+i);
}

if((ref_affid==39 || ReadCookie("AFFILIATELINKID")==39) && AID!="" && PID!=""){
	SetCookie("AID",AID,2160);
	SetCookie("PID",PID,2160);
	if(affid_urlLink.indexOf("?sid=")>0 || affid_urlLink.indexOf("&sid=")>0){
		var Aindex = affid_urlLink.indexOf("?sid=");
		if(Aindex==-1){
			Aindex = affid_urlLink.indexOf("&sid=");
		}
		Aindex = Aindex+5;
		for(var i=1;i<=affid_urlLink.length-Aindex;i++){
			var thisvar = affid_urlLink.substring(Aindex+i-1,Aindex+i);
			if(thisvar=="&"){
				i=i-1;
				break;	
			}
		}
		var SID = urlLink.substring(Aindex,Aindex+i);
		SetCookie("SID",SID,2160);
	}
}

function setLs(){
	if(typeof(ThisServerTime)!="undefined"){
		if(ref_affid==41){
			SetCookie("LSSITEID",siteid,2160);
			SetCookie("LSENTERSITETIME",ThisServerTime,2160);
		}else if(ref_affid==138){
			SetCookie("LSUKSITEID",siteid,2160);
			SetCookie("LSUKENTERSITETIME",ThisServerTime,2160);
		}else if(ref_affid==151){
			SetCookie("LSCASITEID",siteid,2160);
			SetCookie("LSCAENTERSITETIME",ThisServerTime,2160);
		}
	}else{
		window.setTimeout(setLs,600);
	}
}

if(affid_urlLink.indexOf("affid-")>0){
	affid_getParam("affid-");
}
if(affid_urlLink.indexOf("s-")>0){
	affid_getParam("s-");
}
if(affid_urlLink.indexOf("~p.")>0 || affid_urlLink.indexOf("~p=")>0){
	affid_id = getUrlArgs()["p"];
	affid_id = parseInt(affid_id,16);
	if(affid_id && isNaN(affid_id)==false){SetCookie("AFFILIATELINKID",affid_id,2160);}
}
if(ReadCookie("WREFROM")=="" && document.referrer != ""){SetCookie("WREFROM",document.referrer,21600);}
// write shoppingcart items number to cookie
loadAjaxCartCount();
// when username in cookie
function linkdinopoint(){
	location.href=jsMainSiteUrl+"MyDinoPoints/?cur="+headstrCurrency;
}

// read cart count
var xmlHttpTmp = null;
function loadAjaxCartCount() {
	/*
	xmlHttpTmp = GetXmlHttpObject();
	if (xmlHttpTmp == null) {
		return;
	}
	
	xmlHttpTmp.onreadystatechange = setCartCountAjaxResponse;
	xmlHttpTmp.open("GET","/CartCountAjax.cfm",true);
	xmlHttpTmp.send(null);
	*/
	// cookie read
	jsCartCount = ReadCookie("DCARTCOUNT");
	if(jsCartCount==""){jsCartCount=0;}
	if(jsCartCount<0){jsCartCount=0;}
	var hCart = document.getElementById("headCart");
	if (hCart)
		hCart.innerHTML = "(" + jsCartCount + ")";
}

function setCartCountAjaxResponse() {
	if(xmlHttpTmp != null && xmlHttpTmp.readyState==4)
	{
		if(xmlHttpTmp.status == 200)
		{
			var jsCartCountTemp = xmlHttpTmp.responseText;
			var hCart = document.getElementById("headCart");
			if(jsCartCountTemp<0)jsCartCountTemp=0;
			if(jsCartCountTemp=="")jsCartCountTemp=0;
			hCart.innerHTML = "(" + jsCartCountTemp + ")";
		}
	}
}

function loadJSuserinfoNew(){
	if(getUrlArgs()["adanalytics"]){AdAnalyticsRecord(getUrlArgs()["adanalytics"]);}
	if((ref_affid==41 || ref_affid==138 || ref_affid==151) && siteid!=0){
		document.writeln("<script src=\""+jsMainSiteUrl+"js/getThisTime.cfm\"></script>");
		setLs();
	}
	if(ReadCookie("PCTKNO")==""){
		document.writeln("<script src=\""+jsMainSiteUrl+"js/setPCTKNO.cfm\"></script>");
	}
	if(typeof(iIndexMark)!="undefined"){
		var query = window.location.search.substring(1);
		// query = query.toLowerCase();
		if(query.length > 0){
			document.writeln("<script src=\""+jsMainSiteUrl+"API/CreateCookie.cfm?"+query+"\"></script>");
		}
		if(getUrlArgs()["recached"])
		{
			/* document.writeln("<script src=\"/API/CreateIndexToHTML.cfm?vericode=HJT9872LK23&"+query+"\"></script>"); */
		}else if(getUrlArgs()["cur"]){
			window.location.href='/currency-'+getUrlArgs()["cur"]+'.html';
		}
	}
	
	//jsCartCount = ReadCookie("DCARTCOUNT");
	var UserPoint = ReadCookie("USERPOINT");
	var trijsStrUserName = ReadCookie("USERNAME");
	var jsStrUserName = ReadCookie("USERNAME").split(" ")[0].substring(0,6);
	if(jsStrUserName !="")
	{
		jsStrUserName=jsStrUserName+"...";
	}
	if(jsStrUserName && jsStrUserName != ""){
		if(navigator.userAgent.toUpperCase().indexOf('MSIE')!=-1)
		{
			signUpUrl = "'"+jsMainSiteUrl+"ActionCom/Logout.cfm?cur="+headstrCurrency+"'";
			loginText= "Welcome!&nbsp;&nbsp;&nbsp;";
			htmltxt='';
			if(ReadCookie("IDINORSTATS")==1){
				//loginText= "<span style='vertical-align:-2px'>Welcome!&nbsp;&nbsp;</span>";
				//loginText = loginText + '<img src="/Templates/Site61/Dino/images/idinor/ma_ic_db_3_bt_sm1.gif" align="absmiddle">&nbsp;';
				//loginText = loginText + "<strong style='vertical-align:-2px'>"+jsStrUserName;
				//htmltxt='&nbsp;<span class="bt_top01_now" style="vertical-align:-2px"><a href="#" onclick="location.href='+signUpUrl+'">Logout</a></span>';
				loginText="Welcome!&nbsp;&nbsp;";
				loginText+="<img src=\"/Templates/Site61/Dino/images/idinor/ma_ic_db_3_bt_sm1.gif\">"
				loginText+=jsStrUserName;
				htmltxt="&nbsp;<span class=\"bt_top01_now\" style=\"vertical-align:-2px\"><a href=\"#\" onclick=\"location.href="+signUpUrl+"\">Logout</a></span>";

			}
			else
			{			
				loginText = loginText + "<strong>"+jsStrUserName;
				htmltxt='&nbsp;<span class="bt_top01_now"><a href="#" onclick="location.href='+signUpUrl+'">Logout</a></span>';

			}
	//		loginText= loginText+'&nbsp;(&nbsp;<strong class="Dino01">Dino</strong><strong class="Point02">Point</strong> : <a href="'+jsMainSiteUrl+"MyDinoPoints/?cur="+headstrCurrency+'" style="color:#0000CC;">'+UserPoint+'</a> )';
			loginText= loginText+'&nbsp;&nbsp;</strong>';

			document.getElementById("logout").innerHTML = htmltxt;
			SetCookie("_dino_s_userID",ReadCookie("USERID"),0.33);
			if(document.getElementById("inlogin")){
				document.getElementById("inlogin").style.display="block";	
				document.getElementById("nologin").style.display="none";	
				document.getElementById("loginuser").innerHTML = jsStrUserName;
			}
			if(document.getElementById("loginstatus")){
				if(ReadCookie("IDINORSTATS")==1){
					TriUrl = '"'+jsMainSiteUrl+'trialling-processing.html?cur='+headstrCurrency+'"';
					Trilogintxt = "<div class='tit12b'>Hi, "+trijsStrUserName+"</div><div class='idi_sign_3tit tit12'>Welcome to free sample center!</div><div class='idi_sign_2btn'><a href='#' onclick='location.href="+TriUrl+"'><img src='/Templates/Site61/Dino/images/idi_btn3.gif' /></a></div>";
					document.getElementById("loginstatus").innerHTML=Trilogintxt;
				}else{
					TriUrl = '"'+jsMainSiteUrl+'html/idinor.html?cur='+headstrCurrency+'"';
					Trilogintxt = "<div class='tit12b'>Hi, "+trijsStrUserName+"</div><div class='H_updown tit12'><a href='#' onclick='location.href="+TriUrl+"'>Click here</a> to see more privileges</div><div class='idi_sign_2btn'><a href='javasctipt:void(0);' onclick=\"ComDlg.dlg.show('JoinidinorVIPClub'); initloginstat();  return false;\"><img src='/Templates/Site61/Dino/images/idi_btn2.gif' /></a></div>";
					document.getElementById("loginstatus").innerHTML=Trilogintxt;	
				}
			}
		}
		else
		{
			signUpUrl = "'"+jsMainSiteUrl+"ActionCom/Logout.cfm?cur="+headstrCurrency+"'";
			loginText= "Welcome!&nbsp;&nbsp;&nbsp;";
			htmltxt='';
			if(ReadCookie("IDINORSTATS")==1){
				loginText= "<span style='vertical-align:-1px'>Welcome!&nbsp;&nbsp;&nbsp;</span>";
				loginText = loginText + '<img src="/Templates/Site61/Dino/images/idinor/ma_ic_db_3_bt_sm1.gif" align="absmiddle">&nbsp;';
				loginText = loginText + "<strong style='vertical-align:-1px'>"+jsStrUserName;
				htmltxt='&nbsp;<span class="bt_top01_now" style="vertical-align:-1px"><a href="#" onclick="location.href='+signUpUrl+'">Logout</a></span>';
			}
			else
			{
				loginText = loginText + "<strong>"+jsStrUserName;
				htmltxt='&nbsp;<span class="bt_top01_now"><a href="#" onclick="location.href='+signUpUrl+'">Logout</a></span>';

			}
	//		loginText= loginText+'&nbsp;(&nbsp;<strong class="Dino01">Dino</strong><strong class="Point02">Point</strong> : <a href="'+jsMainSiteUrl+"MyDinoPoints/?cur="+headstrCurrency+'" style="color:#0000CC;">'+UserPoint+'</a> )';
			loginText= loginText+'&nbsp;&nbsp;</strong>';

			document.getElementById("logout").innerHTML = htmltxt;
			SetCookie("_dino_s_userID",ReadCookie("USERID"),0.33);
			if(document.getElementById("inlogin")){
				document.getElementById("inlogin").style.display="block";	
				document.getElementById("nologin").style.display="none";	
				document.getElementById("loginuser").innerHTML = jsStrUserName;
			}
			if(document.getElementById("loginstatus")){
				if(ReadCookie("IDINORSTATS")==1){
					TriUrl = '"'+jsMainSiteUrl+'trialling-processing.html?cur='+headstrCurrency+'"';
					Trilogintxt = "<div class='tit12b'>Hi, "+trijsStrUserName+"</div><div class='idi_sign_3tit tit12'>Welcome to free sample center!</div><div class='idi_sign_2btn'><a href='#' onclick='location.href="+TriUrl+"'><img src='/Templates/Site61/Dino/images/idi_btn3.gif' /></a></div>";
					document.getElementById("loginstatus").innerHTML=Trilogintxt;
				}else{
					TriUrl = '"'+jsMainSiteUrl+'html/idinor.html?cur='+headstrCurrency+'"';
					Trilogintxt = "<div class='tit12b'>Hi, "+trijsStrUserName+"</div><div class='H_updown tit12'><a href='#' onclick='location.href="+TriUrl+"'>Click here</a> to see more privileges</div><div class='idi_sign_2btn'><a href='javasctipt:void(0);'  onclick=\"ComDlg.dlg.show('JoinidinorVIPClub'); initloginstat();  return false;\"><img src='/Templates/Site61/Dino/images/idi_btn2.gif' /></a></div>";
					document.getElementById("loginstatus").innerHTML=Trilogintxt;	
				}
			}
		}
	}else{
		signInUrl = "'"+jsMainSiteUrl+"UserLogin/?cur="+headstrCurrency;
		Urlr = window.location.href;
		paraString = Urlr.indexOf("returnUrl");
		if(paraString == -1){
			signInUrl +="&returnUrl="+encodeURIComponent(window.location.href)+"'";
		}else{
			signInUrl = "'"+Urlr+"'";
		}
		signUpUrl = "'"+jsMainSiteUrl+"Register/?cur="+headstrCurrency+"'";
		loginText = '<span class="bt_top01_now"><a href="##" onclick="location.href='+signInUrl+'" rel="nofollow" target="_self">';
		loginText = loginText + 'Sign In</a></span>&nbsp;or&nbsp;<span class="bt_top01_now"><a href="##" onclick="location.href='+signUpUrl+'" rel="nofollow" target="_self">New Customer?</a></span>&nbsp;';
		document.getElementById("logout").innerHTML = "";
		SetCookie("_dino_s_userID",0);
		if(document.getElementById("loginno")){
			document.getElementById("loginno").innerHTML='<input class="gB_btn_cc tit18" onclick="location.href='+signInUrl+'" type="button" value="Continue" />';
		}
		if(document.getElementById("loginouter")){
			document.getElementById("loginouter").innerHTML='STEP 1:<a href="##" onclick="location.href='+signInUrl+'" rel="nofollow" target="_self">Sign In </a> <span class="tit16">or </span> <a href="##" onclick="location.href='+signUpUrl+'" rel="nofollow" target="_self"> New Customer </a>';
		}
	}
	try {
		var hWelcome = document.getElementById("headWelcome");
		hWelcome.innerHTML = loginText;
		
		loadAjaxCartCount();
	} catch(e) {}
}
function loadJSuserinfo() {
	jsCartCount = ReadCookie("DCARTCOUNT");
	var UserPoint = ReadCookie("USERPOINT");
	var jsStrUserName = ReadCookie("USERNAME").split(" ")[0].substring(0,6);
	if(jsStrUserName !="")
	{
		jsStrUserName=jsStrUserName+"...";
	}
	if(jsStrUserName && jsStrUserName != ""){
		signUpUrl = "'"+jsMainSiteUrl+"ActionCom/Logout.cfm?cur="+headstrCurrency+"'";
		loginText= '<span style="float:left;">Welcome!&nbsp;</span><span class="login" style="float:left;">';
		if(ReadCookie("IDINORSTATS")==1){
			loginText = loginText + '<img src="/Templates/Site61/Dino/images/idinor/ma_ic_db_3_bt_sm1.gif" align="absmiddle">&nbsp;';
		}
		loginText = loginText + jsStrUserName;
		loginText= loginText+'&nbsp;(&nbsp;<strong class="Dino01">Dino</strong><strong class="Point02">Point</strong> : <a href="'+jsMainSiteUrl+"MyDinoPoints/?cur="+headstrCurrency+'" style="color:#0000CC;">'+UserPoint+'</a> )';
		loginText= loginText+'</span>';
		document.getElementById("logout").innerHTML = '&nbsp;<a href="#" onclick="location.href='+signUpUrl+'">Logout</a>';
		SetCookie("_dino_s_userID",ReadCookie("USERID"),0.33);
	}else{
		signInUrl = "'"+jsMainSiteUrl+"UserLogin/?cur="+headstrCurrency;
		signInUrl +="&returnUrl="+encodeURIComponent(window.location.href)+"'";
		signUpUrl = "'"+jsMainSiteUrl+"Register/?cur="+headstrCurrency+"'";
		loginText = '<span style="float:left;">Welcome!&nbsp;</span><span class="login" style="float:left;">';
		loginText = loginText + '&nbsp;<a href="#" onclick="location.href='+signInUrl+'" rel="nofollow" target="_self"><font style="color:#000000;">Sign In</font></a></span>&nbsp;';
		document.getElementById("logout").innerHTML = "";
		SetCookie("_dino_s_userID",0);
	}
	if(jsCartCount==""){jsCartCount=0;}
	try {
		var hWelcome = document.getElementById("headWelcome");
		var hCart = document.getElementById("headCart");
		hWelcome.innerHTML = loginText;
	if (jsCartCount<0){jsCartCount=0;}
	if (jsCartCount == 0){hCart.style.color = 'red';}else{hCart.style.color = 'green';}		
	if (jsCartCount > 1){hCart.innerHTML = "<span style='color: green; text-decoration:none'>(" + jsCartCount + " items)</span>";}
	else{hCart.innerHTML = "<span style='color: red; text-decoration:none'>(" + jsCartCount + " item)</span>";}
	} catch(e) {}
}

function listlen(strs,mit){
    var sums = 0; 
	for(i=0;i < strs.length;i++){
    	if(strs.charAt(i) == mit){
        	sums=sums+1;
        }
    }
    return sums;
}

function listtoarray(strs,mit){
	var arr = strs.split(mit);
    return arr;
}

function tofloat(f,dec){
	
	
	 return result=chgMoney(f);
	

	/*result=parseInt(f)+(dec==0?"":".")
    f-=parseInt(f);
    if(f==0){
    	for(j=0;j < dec;j++) result+='0';
    }else{
    if(f < 0.1){
    	for(k=0;k < dec;k++){ f*=10;
		if(k==0){result+='0';}else{
        result+=parseInt(Math.round(f));}}
    }else{toFixed
    	for(k=0;k < dec;k++) f*=10;
        result+=parseInt(Math.round(f));
		
    }
    }*/
    return result;
}

function chgMoney(money){
	money = parseFloat(money);
	var key = money.toString().split('.');
	if(typeof(key[1])=='undefined'){
		return key[0]+'.00';	
	}
	if(key[1].length>=3){
		key[1] = key[1].substring(0,3);	
	}
	var tmp1 = key[1].substring(0,2);
	var tmp2 = key[1].substring(2,3);
	var tmp3 = key[1].substring(0,1);
	if(tmp2>=5){
		if(parseInt(tmp3) == 0){tmp1 = parseInt(Number(tmp1))+1;if(tmp1<=9)tmp1='0'+tmp1;}
		else{tmp1 = parseInt(tmp1)+1;}
	}
	if(tmp1>99){
		key[0] = parseInt(key[0]) + 1;
		tmp1 = '00';
	}
	if(tmp1.length == 1){tmp1=tmp1+'0';}
	return key[0].toString() + '.' + tmp1.toString();
}

function tofloatjpy(f){
	if(f==""){
		result=0;
	}else{
		f=Number(f);
		result=f.toFixed(0);
	}
	result1=parseInt(result/10)*10;
	result2=result-result1;
    if(result2 <5){
		result=result1;
	}else{
		result=result1+10;
	}
  //  f1=Math.round(f/10)*10;
//    if((f-f1) < 5){
//    	result=f1;
//    }else{
//    	result=f1+10;
//    }
    return result;
}

function tofloatidr(f){
	if(f==""){
		result=0;
	}else{
		f=Number(f);
		result=f.toFixed(0);
	}

	result1=parseInt(f);
	result2=result-result1;
    if(result2 > 0){
		result=result1+1;
	}else{
		result=result1;
	}
    return result;
}

function GetHtml(imagehref,imagesrc,imagetitle,namehref,nametitle,nameshow,priceshow,priceshow1){
	var TempHtml="<div class='top_sb_list'><div class='top_sbl' id='imgshow'><a href= '" + imagehref + "'><img border='0' src='"+imagesrc+"' title='"+imagetitle+"'  onerror='ImageOnError(this);' /></a></div><div class='top_sbr tit11' style='margin-left:5px' id='productshow'><ul><li>"+"<a class='viewedPListA' href='"+namehref+"' title='"+nametitle +"'>"+nameshow+"</a></li><li class='pass_pri' style='text-decoration:line-through' id='"+priceshow+"'>"+priceshow+"</li><li class='red' style='font-weight:bold' id='"+priceshow1+"'>"+priceshow1+"</li></ul></div></div>";
    return TempHtml;
}
function productview(site_Image_Path,URLCurrency,curcurrency,DollarName,Symbol,curcur){
	var Delimiter = "@" ;
	if(ReadCookie("IV_ID") && ReadCookie("IV_PT")   && ReadCookie("IV_NAME") && ReadCookie("IV_PR") && ReadCookie("IV_FNAME") && ReadCookie("IV_CUR") 
		&& listlen(ReadCookie("IV_ID"), Delimiter) == listlen(ReadCookie("IV_CUR"), Delimiter) 
		&&	listlen(ReadCookie("IV_ID"), Delimiter) == listlen(ReadCookie("IV_FNAME"), Delimiter) 
		&&	listlen(ReadCookie("IV_ID"), Delimiter) == listlen(ReadCookie("IV_PR"), Delimiter)
		&&	listlen(ReadCookie("IV_ID"), Delimiter) == listlen(ReadCookie("IV_NAME"), Delimiter)
		&&	listlen(ReadCookie("IV_ID"), Delimiter) == listlen(ReadCookie("IV_PT"), Delimiter)
		&&	listlen(ReadCookie("IV_ID"), Delimiter) == listlen(ReadCookie("IV_OPR"), Delimiter))
		{var Array_ProductID = listtoarray(ReadCookie("IV_ID"), Delimiter);
		 var Array_ProductName = listtoarray(ReadCookie("IV_NAME"), Delimiter);
		 var Array_FileName = listtoarray(ReadCookie("IV_FNAME"), Delimiter);
		 var Array_SmallPhoto = listtoarray(ReadCookie("IV_PT"), Delimiter);
		 var Array_Currency = listtoarray(ReadCookie("IV_CUR"), Delimiter);
		 var Array_Price = listtoarray(ReadCookie("IV_PR"), Delimiter);
		 var Array_oldPrice = listtoarray(ReadCookie("IV_OPR"), Delimiter);
		 var ShowTheList = true;
	}else{
		 var ShowTheList = false;
	}
	var viewString = "";
	if(ShowTheList){
			for(i=0;i < Array_ProductID.length;i++){
				 imagehref_value = "/"+Array_FileName[i]+URLCurrency+".html";
				 imagesrc_value = site_Image_Path+Array_SmallPhoto[i].replace('small.','icon.');
				 imagetitle_value = Array_ProductName[i];
				 namehref_value = "/"+Array_FileName[i]+URLCurrency+".html";
				 nametitle_value = Array_ProductName[i];
				if (Array_ProductName[i].length > 8){
					 nameshow_value = Array_ProductName[i].substring(0,8)+"...";
				}else{
					 nameshow_value = Array_ProductName[i];
				}
				if(curcurrency == 'JPY'){
					if(Array_oldPrice[i] == Array_Price[i]){
						priceshow_value = getCurShow(curcurrency,DollarName+Symbol,tofloatjpy(Array_oldPrice[i]*curcur));
						priceshow_value1 = getCurShow(curcurrency,DollarName+Symbol,tofloatjpy(Array_oldPrice[i]*curcur*0.5));
					}else{
						priceshow_value = getCurShow(curcurrency,DollarName+Symbol,tofloatjpy(Array_oldPrice[i]*curcur));
						priceshow_value1 = getCurShow(curcurrency,DollarName+Symbol,tofloatjpy(Array_Price[i]*curcur));
					}
				}else if(curcurrency == 'IDR' || curcurrency == 'RUB'){
					if(Array_oldPrice[i] == Array_Price[i]){
						priceshow_value = getCurShow(curcurrency,DollarName+Symbol,tofloatidr(Array_oldPrice[i]*curcur));
						priceshow_value1 = getCurShow(curcurrency,DollarName+Symbol,tofloatidr(Array_oldPrice[i]*curcur*0.5));
					}else{
						priceshow_value = getCurShow(curcurrency,DollarName+Symbol,tofloatidr(Array_oldPrice[i]*curcur));
						priceshow_value1 = getCurShow(curcurrency,DollarName+Symbol,tofloatidr(Array_Price[i]*curcur));
					}
				}else{  
					if(Array_oldPrice[i] == Array_Price[i]){
						priceshow_value = getCurShow(curcurrency,DollarName+Symbol,tofloat(Array_oldPrice[i]*curcur,2));
						priceshow_value1 = getCurShow(curcurrency,DollarName+Symbol,tofloat(Array_oldPrice[i]*curcur*0.5,2));
					}else{
						priceshow_value = getCurShow(curcurrency,DollarName+Symbol,tofloat(Array_oldPrice[i]*curcur,2));
						priceshow_value1 = getCurShow(curcurrency,DollarName+Symbol,tofloat(Array_Price[i]*curcur,2));
					}
				 }
				 viewString = viewString + GetHtml(imagehref_value,imagesrc_value,imagetitle_value,namehref_value,nametitle_value,nameshow_value,priceshow_value,priceshow_value1); 	
			}
					viewString = "<div class='top_sb_box'><div class='top_selling_bar1'></div><div class='top_selling_bar3'></div><div class='top_selling_bar2 tit14b white'>Products I Viewed</div></div><div class='top_sbox'>"+viewString+"<a style='font-size:10px' href='http://www.dinodirect.com/Browsing-History.html'>>View or edit your browsing history</a><div class='autoHeight'></div></div><div class='autoHeight'></div>";
		}
	var htmlstring = viewString;
	GetProductIview(htmlstring);
}
function GetProductIview(htmlstring)
{
	try {
            if(document.getElementById("divLastIviewed"))
            {
            	document.getElementById("divLastIviewed").innerHTML = htmlstring;
            }   
        } catch(e) {}
}
var isMoveOutCust = 0;

function MoveOutCustom(){
	isMoveOutCust = 1;
	setTimeout(closeCustomerhelp,250);
}
function MoveOverCustom(){
	isMoveOutCust = 0;
}
function MoveOverCustomNew(){
	isMoveOutCust = 0;
	var isShow = document.getElementById('Customerhelpshow').style.display;
	if(isShow=='block'){
		document.getElementById('customerHelpButton').className='bt_cusSer_hover';	
	}
}
function MoveOutCustomNew(){
	isMoveOutCust = 1;
	setTimeout(closeCustomerhelpNew,250);
}
function showCustomerhelp(){
	editMarkClass(1);
	document.getElementById("Customerhelp").className = "help02_textbg_div";
	document.getElementById("Customerhelpshow").style.display = "block";
	isMoveOutCust = 0;
}

function showCustomerhelpNew(){
	document.getElementById("Customerhelpshow").style.display = "block";
	isMoveOutCust = 0;
}

function closeCustomerhelpNew(){
	if(isMoveOutCust==1){
		document.getElementById("Customerhelpshow").style.display = "none";
	}
}

function closeCustomerhelp(){
	if(isMoveOutCust==1){
		editMarkClass(0);
		document.getElementById("Customerhelp").className = "";
		document.getElementById("Customerhelpshow").style.display = "none";
	}
}

// when load product images error
function ImageOnError(obj, type, url) {
	if (obj.src.indexOf('gemsimage.lefux.com') == -1 && obj.src.indexOf('p.lefux.com') > 0) {
		obj.src=obj.src.replace('p.lefux.com/', 'gemsimage.lefux.com/hosting/');
	}
	else if(obj.src.indexOf('gemsimage.lefux.com') == -1 && obj.src.indexOf('d3f0jbia68uwkd.cloudfront.net') > 0)
	{
		obj.src=obj.src.replace('d3f0jbia68uwkd.cloudfront.net/', 'gemsimage.lefux.com/hosting/');
	}
	else if(obj.src.indexOf('gemsimage.lefux.com') == -1 && obj.src.indexOf('i.lefux.com') > 0){
		obj.src=obj.src.replace('i.lefux.com/', 'gemsimage.lefux.com/');
	}
	//else if(obj.src.indexOf('qdw.lefux.com') == -1 && obj.src.indexOf('gemsimage.lefux.com') > 0){
	//	obj.src=obj.src.replace('gemsimage.lefux.com/', 'qdw.lefux.com/images/');
	//}
	//if (obj.src.indexOf('gemsimage.lefux.com') == -1 && obj.src.indexOf('hosting.dinodirect.com') > 0) {obj.src=obj.src.replace('hosting.dinodirect.com', 'gemsimage.lefux.com');}
}
function ImageOnErrorQDW(obj, type, url){
	if(obj.src.indexOf('qdw.lefux.com') == -1 && obj.src.indexOf('i.lefux.com') > 0){
		obj.src=obj.src.replace('i.lefux.com/', 'qdw.lefux.com/images/');
	}
}
function ImageOnError2(obj, type, url) {if (obj.src.indexOf('gems.lefux.com') == -1 && obj.src.indexOf('hosting.dinodirect.com') > 0) {obj.src=obj.src.replace('hosting.dinodirect.com', 'gems.lefux.com');}}var ArrayImageError = [];function WriteImageError(){}function CreateLogFile(){} 
// more ways to shop switch
function moreshop(divcount, divid,m){for(var i = divcount ; i > 0; i --){var getdiv = document.getElementById(i);getdiv.style.display = 'none';if(i!=m){document.getElementById('ShopWays_'+i).className='select';document.getElementById('ShopWaysName_'+i).className='mv_title';}else{document.getElementById('ShopWays_'+m).className='selectedStyle';document.getElementById('ShopWaysName_'+m).className='mv_titleSelect';}}var getdivshow = document.getElementById(divid);getdivshow.style.display = '';}

function addCurrency(strLink){
    if(typeof(headstrCurrency) =="string" && headstrCurrency.toLowerCase() != "usd"){
        if(strLink.indexOf("www.dinodirect.com",0) >= 0){
            if(strLink.indexOf("?",0) > 0){
                strLink = strLink + "&cur="+headstrCurrency;
            }else{
                strLink = strLink + "?cur="+headstrCurrency;
            }
        }
    }
	window.location.href = strLink;
}

function getIdinorprice(tempProductID,tempProductPrice,disCountProductPrice,Discount_int,showtype,curcurrency,DollarName,Symbol,IsDiscountLoss5,IsDiscount,oriDisPrice,ThPrice,tempStockCount,floatprice){
	if(curcurrency == 'JPY' || curcurrency == 'IDR' || curcurrency == 'RUB'){
		priceshow_value = getCurShow(curcurrency,DollarName+Symbol,tempProductPrice);
		if(IsDiscount==1 && Discount_int>0){
			Discountpriceshow_value = getCurShow(curcurrency,DollarName+Symbol,oriDisPrice);
			if(floatprice&&floatprice!=0){
				Discountpriceshow_value = parseInt(oriDisPrice) + parseInt(floatprice);
				priceshow_value = getCurShow(curcurrency,DollarName+Symbol,parseInt(Discountpriceshow_value)*100/parseInt(Discount_int));
				Discountpriceshow_value = getCurShow(curcurrency,DollarName+Symbol,Discountpriceshow_value);
			}
		}else{
			Discountpriceshow_value=priceshow_value;
			if(floatprice&&floatprice!=0){
				Discountpriceshow_value = getCurShow(curcurrency,DollarName+Symbol,parseInt(tempProductPrice) + parseInt(floatprice));
				priceshow_value = Discountpriceshow_value;
			}
		}
		
	}else{        
		priceshow_value = getCurShow(curcurrency,DollarName+Symbol,parseFloat(tempProductPrice).toFixed(2));
		if(IsDiscount==1 && Discount_int>0){
			Discountpriceshow_value = getCurShow(curcurrency,DollarName+Symbol,parseFloat(oriDisPrice).toFixed(2));
			if(floatprice&&floatprice!=0){
				Discountpriceshow_value = parseFloat(parseFloat(oriDisPrice) + parseFloat(floatprice)).toFixed(2);
				priceshow_value = getCurShow(curcurrency,DollarName+Symbol,parseFloat(parseFloat(Discountpriceshow_value)*100/parseInt(Discount_int)).toFixed(2));
				Discountpriceshow_value = getCurShow(curcurrency,DollarName+Symbol,Discountpriceshow_value);
			}
		}else{
			Discountpriceshow_value=priceshow_value;
			if(floatprice&&floatprice!=0){
				Discountpriceshow_value = getCurShow(curcurrency,DollarName+Symbol,parseFloat(parseFloat(tempProductPrice) + parseFloat(floatprice)).toFixed(2));
				priceshow_value = Discountpriceshow_value;
			}
		}
	}
	var linkmsg='';
	if(ReadCookie("IDINORSTATS")==1){
		if(ReadCookie("ISIDINOBUYFO")==1){
			linkmsg = '';
		}else{
			linkmsg = '<br /><span class="s_price_login_4"><span style="width:15px; float:left;><a style="color:#0E66A6;  text-decoration:underline;" href="http://www.dinodirect.com/html/idinor.html?returnUrl='+location.href+'" target="_blank" onclick="return facebooklanding(1,1,12);"><img src="/Templates/Site61/Dino/images/s_price_login_4new.gif" style="margin-top:5px;"></a></span><span style="float:left; width:140px;"><a style="color:#0E66A6;  text-decoration:underline;" href="http://www.dinodirect.com/html/idinor.html?returnUrl='+location.href+'"  target="_blank" onclick="return facebooklanding(1,1,12);">You can get extra 5% off for the iDinor first order</a>';
		}
	}else{
		linkmsg = '<br /><span class="s_price_login_4"><span style="width:15px; float:left;"><a style="color:#0E66A6;  text-decoration:underline;" href="http://www.dinodirect.com/html/idinor.html?returnUrl='+location.href+'" target="_blank" onclick="return facebooklanding(1,1,12);"><img src="/Templates/Site61/Dino/images/s_price_login_4new.gif" style="margin-top:5px;"></a></span><span style="float:left; width:145px;"><a style="color:#0E66A6;  text-decoration:underline;" href="http://www.dinodirect.com/html/idinor.html?returnUrl='+location.href+'"  target="_blank" onclick="return facebooklanding(1,1,12);">Wanna get extra 5% off? Be an iDinor member Now</a></span></span>';
	}
	// if the product allow discount
	if(IsDiscountLoss5==0 || IsDiscountLoss5=="false"){
		Grid = "";
		if(IsDiscount==1 && Discount_int>0){
			Grid += '<div class="bt_dp_price"><span class="gray">'+priceshow_value+'</span></div>';
		}
		Grid += '<div><span class="tit16b red">'+ Discountpriceshow_value +'</span></div>';
		/*Grid += linkmsg;*/

		document.getElementById(tempProductID).innerHTML=Grid;
	}
	else{
	if(ReadCookie("IDINORSTATS")==1){
			if(curcurrency == 'JPY' || curcurrency == 'IDR' || curcurrency == 'RUB'){
				hdispriceshow_value = getCurShow(curcurrency,DollarName+Symbol,disCountProductPrice);
				hdispriceshow_off =getCurShow(curcurrency,DollarName+Symbol,(tempProductPrice-disCountProductPrice));
			}else{        
				hdispriceshow_value = getCurShow(curcurrency,DollarName+Symbol,parseFloat(disCountProductPrice).toFixed(2));
				hdispriceshow_off =getCurShow(curcurrency,DollarName+Symbol,parseFloat(tempProductPrice-disCountProductPrice).toFixed(2));
			}
			if(showtype == 1){
				Grid = "";
				Grid+='<div class="s_price_login">';
				Grid += '<div class="s_price_login_1" style="font-size:12px;">Original Price: <span style="font-size:12px;  font-weight:bold;text-decoration: line-through;">'+priceshow_value+'</span></div>';
				Grid +='<div class="s_price_login_2" style="font-size:12px; font-weight:normal;">My Price: <span style="font-size:16px;"><strong>'+hdispriceshow_value+'</strong></span></div>';
				Grid+='<div style="color:#CC6600;">You Save:'+hdispriceshow_off+'<br><strong>(50% OFF)</strong></div>';	
				Grid+=linkmsg;
				Grid+='<div class="autoHeight"></div></div><div class="autoaddheight"></div>';
				document.getElementById(tempProductID).innerHTML=Grid;	
			}
			/*
			else if(ReadCookie("ISIDINOBUYFO")==0)
			{
				if(curcurrency == 'JPY' || curcurrency == 'IDR' || curcurrency == 'RUB'){
					hdispriceshow_value = getCurShow(curcurrency,DollarName+Symbol,ThPrice);
					hdispriceshow_off = getCurShow(curcurrency,DollarName+Symbol,(tempProductPrice-ThPrice));
				}else{        
					hdispriceshow_value = getCurShow(curcurrency,DollarName+Symbol,parseFloat(ThPrice).toFixed(2));
					hdispriceshow_off = getCurShow(curcurrency,DollarName+Symbol,parseFloat(tempProductPrice-ThPrice).toFixed(2));
				}
				if(showtype == 1){
					Grid = "";
					Grid+='<div class="s_price_login">';
					Grid += '<div class="s_price_login_1" style="font-size:12px;">Original Price: <span style="text-decoration:line-through; font-size:12px;">'+priceshow_value+'</span></div>';
					Grid +='<div class="s_price_login_2" style="font-size:12px;">My Price: <span style="font-size:12px;">'+hdispriceshow_value+'</span></div>';
					Grid +='<div style="color:#CC6600;">You Save:'+hdispriceshow_off+'(61% off)</div>';	
					Grid += linkmsg;
					Grid +='<div class="autoHeight"></div></div>';
					document.getElementById(tempProductID).innerHTML=Grid;	
				}	
			
				
			}
			*/
		}else{
			if(curcurrency == 'JPY' || curcurrency == 'IDR' || curcurrency == 'RUB'){
				hdispriceshow_value = getCurShow(curcurrency,DollarName+Symbol,tempProductPrice);
				hdispriceshow_off = getCurShow(curcurrency,DollarName+Symbol,disCountProductPrice);
			}else{        
				hdispriceshow_value = getCurShow(curcurrency,DollarName+Symbol,parseFloat(tempProductPrice).toFixed(2));
				hdispriceshow_off = getCurShow(curcurrency,DollarName+Symbol,parseFloat(disCountProductPrice).toFixed(2));
			}
			if(showtype == 1){
				Grid = "";
				Grid += '<div class="bt_dp_price"><span class="gray">'+priceshow_value+'</span></div>';
				Grid += '<div><span class="tit16b red">'+ Discountpriceshow_value +'</span></div>';
				/*Grid += linkmsg;*/
				document.getElementById(tempProductID).innerHTML=Grid;
			}
			
		}
	}
}



function GetXmlHttpObject()
{
  var xmlHttp=null;
  try
    {
    // Firefox, Opera 8.0+, Safari
    xmlHttp=new XMLHttpRequest();
    }
  catch (e)
    {
    // Internet Explorer
    try
      {
      xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
      }
    catch (e)
      {
      xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    }
  return xmlHttp;
}

function toShowForm()
{
	var height = document.documentElement.scrollHeight;
	var width = document.body.scrollWidth;
	if(ReadCookie("ISF")!=1){
		if(document.getElementById("iframeTopHide")!=null)
		{
			SetCookie("ISF",1,12);
			document.body.style.overflow="hidden";
			if(document.getElementById("iframeTopHide").className == "iframeTopHide")
			{
				document.getElementById("iframeTopHide").height= "9999px";
				document.getElementById("iframeTopHide").width = "1440px";
			}
			else 
			{
				document.getElementById("iframeTopHide").style.height= "9999px";
				document.getElementById("iframeTopHide").style.width ="1440px";
			}
			document.getElementById("iframeTopHide").style.display="";
		}
		if(document.getElementById("divShow")!=null)
		{
			if(webType=="IE")
			{
				document.getElementById("divShow").style.top = GetScrollTop()+240;
			}
			else
			{
				document.getElementById("divShow").style.top =	(GetScrollTop()+240)+"px";
			}
			document.getElementById("divShow").style.left = "350px";
			document.getElementById("divShow").style.display="";	
		}
	}
}
function doClose()
{
	document.body.style.overflow="";
	if(document.getElementById("iframeTopHide")!=null)
	{
		document.getElementById("iframeTopHide").style.display="none";	
	}
	if(document.getElementById("divShow")!=null)
	{
		document.getElementById("divShow").style.display="none";	
	}
}

function facebooklanding(urlpath,banner,num){
	xmlHttp=GetXmlHttpObject();
	isopen=urlpath;
	if(xmlHttp==null){
		return;
	}
	affid = 0;
	if(ReadCookie("AFFILIATELINKID") != "" && ReadCookie("AFFILIATELINKID") != 0){
		urlpath=urlpath+'?FBffid='+ReadCookie("AFFILIATELINKID");
		affid = ReadCookie("AFFILIATELINKID");
	}
	if(urlpath == ""){
		urlpath=1	
	}
	var url="/facebooklanding";
	url=url+"?urlpath="+urlpath+"&banner="+banner+"&affid="+affid+"&num="+num;
	url=url+"&sid="+Math.random();
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
	if(num == 3){
	ComDlg.dlg.hide('facebookdlg');	
	}
	if(isopen != 1){
		window.open(urlpath);
	}
	if(num == 11 || num == 12 || num ==13 || num == 14){return true;}
	return false;
}
function toTrunc()
{
	window.location.href="http://www.dinodirect.com/html/idinor.cfm#idinor";
}
var isSubfb = 0;
function subfb(){
	if(isSubfb==0){
		isSubfb=1;
		var rdos = document.getElementById("RatingIds").value;
		var formparam = "RatingIds="+rdos;
		var rdosary = rdos.toString().split("@");
		var url=jsMainSiteUrl+"ActionCom/feedback.cfm";
		var errormsg = document.getElementById("error_msg");
		var email_pattern = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
		var order_pattern = /^[a-zA-Z0-9]{8}-DD$/;
		var order_pattern2 = /^[a-zA-Z0-9]{8}-dd$/;
		var fb_email = document.getElementById('FB_userEmail').value;
		var fb_order = document.getElementById('FB_order').value;
		var b=0;
		for(var i=0;i<rdosary.length;i++){
			if(document.getElementById('choiceStar_'+rdosary[i]).value != 0){
				formparam = formparam + '&radio' + rdosary[i] + '=' + document.getElementById('choiceStar_'+rdosary[i]).value;
				b=b+1;
			}
		}
		if(b==0){
				errormsg.innerHTML = 'Please rating and then submit!';
				isSubfb=0;
				return false;
		}
		
		var overAll = document.getElementById('choiceStar_999').value;
		if(overAll!=0)formparam = formparam + '&overall=' + document.getElementById("choiceStar_999").value;
		if(trim(fb_email)!="" && !email_pattern.test(fb_email))
		{
			errormsg.innerHTML = "Please enter the valid email address.";
			isSubfb=0;
			return false;
		}
		else if(trim(fb_email)!="")
		{
			formparam = formparam + '&email=' + fb_email;	
		}
		
		if(trim(fb_order)!="" && !order_pattern.test(fb_order) && !order_pattern2.test(fb_order))
		{ 
			errormsg.innerHTML = "Please enter the valid order NO.";
			isSubfb=0;
			return false;
		}
		else if(trim(fb_order)!="")
		{
			formparam = formparam + '&orderID=' + fb_order;	
		}
		errormsg.innerHTML = '';
		if(document.getElementById("ComSel").value!=''){
			formparam = formparam + '&ComSel=' + document.getElementById("ComSel").value;
			if(trim(document.getElementById("ComTxt").value)!=""){
				if(trim(document.getElementById("ComTxt").value)=="Please enter your comments based on the topic you selected above."){	
				}else{
					var comTextTemp = trim(document.getElementById("ComTxt").value);
					comTextTemp = comTextTemp.replace(/%/g,"%25");
					comTextTemp = comTextTemp.replace(/&/g,"%26");
					comTextTemp = comTextTemp.replace(/ /g,"%20");
					comTextTemp = comTextTemp.replace(/\//g,"%2F");
					comTextTemp = comTextTemp.replace(/\?/g,"%3F");
					comTextTemp = comTextTemp.replace(/#/g,"%23");
					formparam = formparam + '&ComTxt=' + comTextTemp;
				}
				
			}
		}
		
		formparam = formparam + '&link=' + window.location.href;
		url = url + "?" + formparam;
		
		var xmlHttp = null; 
		try 
		{ 
		  // Firefox, Opera 8.0+, Safari 
		  xmlHttp=new XMLHttpRequest(); 
		} 
		catch (e) 
		{ 
			try 
		   { 
			// Internet Explorer 
			xmlHttp=new ActiveXObject('Msxml2.XMLHTTP'); 
		   } 
		   catch (e) 
		   { 
				try 
				{ 
				 xmlHttp=new ActiveXObject('Microsoft.XMLHTTP'); 
				} 
				catch (e) 
				{ 
					isSubfb=0;
					return false; 
				} 
		   } 
		} 
	  xmlHttp.onreadystatechange=function() 
	  { 
	   if(xmlHttp.readyState == 4 && xmlHttp.status == 200) 
	   { 
	    isSubfb=0;
		iDinorComDlg.dlg.hide('DD_pfbox');
		iDinorComDlg.dlg.show('DD_pfbox2');
		for(var i=0;i<rdosary.length;i++){
			document.getElementById('choiceStar_'+rdosary[i]).value=0;
			document.getElementById(rdosary[i]+"_1").src = "http://www.dinodirect.com/templates/site61/dino/images/fd_bg3.gif";
			document.getElementById(rdosary[i]+"_2").src = "http://www.dinodirect.com/templates/site61/dino/images/fd_bg3.gif";
			document.getElementById(rdosary[i]+"_3").src = "http://www.dinodirect.com/templates/site61/dino/images/fd_bg3.gif";
			document.getElementById(rdosary[i]+"_4").src = "http://www.dinodirect.com/templates/site61/dino/images/fd_bg3.gif";
			document.getElementById(rdosary[i]+"_5").src = "http://www.dinodirect.com/templates/site61/dino/images/fd_bg3.gif";
			document.getElementById("999_1").src = "http://www.dinodirect.com/templates/site61/dino/images/fd_bg3.gif";
			document.getElementById("999_2").src = "http://www.dinodirect.com/templates/site61/dino/images/fd_bg3.gif";
			document.getElementById("999_3").src = "http://www.dinodirect.com/templates/site61/dino/images/fd_bg3.gif";
			document.getElementById("999_4").src = "http://www.dinodirect.com/templates/site61/dino/images/fd_bg3.gif";
			document.getElementById("999_5").src = "http://www.dinodirect.com/templates/site61/dino/images/fd_bg3.gif";
			document.getElementById("error_msg").innerHTML = '';
			document.getElementById('FB_userEmail').value = "";
			document.getElementById('FB_order').value = "";
			document.getElementById("ComTxt").value="Please enter your comments based on the topic you selected above.";
			document.getElementById("ComTxt").style.color="#CCCCCC";
		}
	   } 
	  } 
	  xmlHttp.open('POST',url,true); 
	  xmlHttp.send(''); 
	}
}

function textCounter(obj,cter,maxlimit){
	var charcnt = obj.value.length;
	if(charcnt > maxlimit){
		obj.value = obj.value.substring(0,maxlimit);
	}
	var counter = maxlimit - charcnt;
	if(counter < 0){
		counter = 0;
	}
	document.getElementById(cter).innerHTML = counter;
}

function ComTxtBlur(){
	if(trim(document.getElementById("ComTxt").value)==""){
		document.getElementById("ComTxt").value="Please enter your comments based on the topic you selected above.";
		document.getElementById("ComTxt").style.color="#CCCCCC";
	}
}

function ComTxtFocus(){
	if(trim(document.getElementById("ComTxt").value)=="Please enter your comments based on the topic you selected above."){
		document.getElementById("ComTxt").value="";
		document.getElementById("ComTxt").style.color="";
	}
}

function brandShowChg(nowPage,allPage){
	document.getElementById('brandFastGo').innerHTML = '';
	for(i=1;i<=allPage;i++){
		if(i==nowPage){
			document.getElementById('brandFastGo').innerHTML += '<img src="/templates/site61/dino/images/brand/dailydeal_imt1.gif" width="11" height="11" />';
		}else{
			document.getElementById('brandFastGo').innerHTML += '<a href="javascript:brandShowChg('+i+','+allPage+')"><img src="/templates/site61/dino/images/brand/dailydeal_imt2.gif" width="11" height="11" /></a>';
		}
		document.getElementById('brandIndexPage_'+i).style.display = 'none';	
	}
	document.getElementById('brandIndexPage_'+nowPage).style.display = '';
	if(nowPage>1){
		document.getElementById('brandLeftGo').innerHTML = '<a href="javascript:brandShowChg('+(parseInt(nowPage)-1)+','+allPage+')"><img src="/templates/site61/dino/images/brand/dailydeal_imL.gif" width="17" height="61" /></a>';	
	}else{
		document.getElementById('brandLeftGo').innerHTML = '<a href="javascript:brandShowChg('+allPage+','+allPage+')"><img src="/templates/site61/dino/images/brand/dailydeal_imL.gif" width="17" height="61" /></a>';
	}
	if(nowPage<allPage){
		document.getElementById('brandRightGo').innerHTML = '<a href="javascript:brandShowChg('+(parseInt(nowPage)+1)+','+allPage+')"><img src="/templates/site61/dino/images/brand/dailydeal_imR.gif" width="17" height="61" /></a>';	
	}else{
		document.getElementById('brandRightGo').innerHTML = '<a href="javascript:brandShowChg(1,'+allPage+')"><img src="/templates/site61/dino/images/brand/dailydeal_imR.gif" width="17" height="61" /></a>';	
	}
	var func2 = null;
	if(nowPage==allPage){
		func2 = 'brandShowChg(1,'+allPage+')';
	}else{
		func2 = 'brandShowChg('+(parseInt(nowPage)+1)+','+allPage+')';	
	}
	window.clearTimeout(timeOutId);
	timeOutId = window.setTimeout(func2,5000);
}

function getCurrentTimeForFree(){
	document.getElementById('saveFreetrial').src = jsMainSiteUrl+"actioncom/freetrialaction.cfm";
	var d = new Date(dailyDealCurrentTime);
	var tmpDate = d.getDate();
	d.setDate(parseInt(tmpDate)+30);
	var myYear = (d.getYear()<1900)?(1900+d.getYear()):d.getYear();
	var targetTime = myYear + '/' + (d.getMonth()+1) + '/' + d.getDate() + ' ' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
	var sDate = new Date(dailyDealCurrentTime).getTime();
	var eDate = new Date(targetTime).getTime();
	var timeobj = new Array(4);
	timeobj[0]=document.getElementById("Div_DailyDealTimer_D1");
	timeobj[1]=document.getElementById("Div_DailyDealTimer_H1");
	timeobj[2]=document.getElementById("Div_DailyDealTimer_M1");
	timeobj[3]=document.getElementById("Div_DailyDealTimer_S1");
	var dealdateobj1 = new DealDate(sDate,eDate,timeobj,3);
	dealdateobj1.show_timeDailyDeal();
}

function fixPng(){
	var arVersion = navigator.appVersion.split("MSIE") 
    var version = parseFloat(arVersion[1]) 
    if ((version >= 5.5) && (document.body.filters)) 
    { 
       for(var j=0; j<document.images.length; j++) 
       { 
          var img = document.images[j] 
          var imgName = img.src.toUpperCase() 
          if (imgName.substring(imgName.length-3, imgName.length) == "PNG") 
          { 
             var imgID = (img.id) ? "id='" + img.id + "' " : "" 
             var imgClass = (img.className) ? "class='" + img.className + "' " : "" 
             var imgTitle = (img.title) ? "title='" + img.title + "' " : "title='" + img.alt + "' " 
             var imgStyle = "display:inline-block;" + img.style.cssText 
             if (img.align == "left") imgStyle = "float:left;" + imgStyle 
             if (img.align == "right") imgStyle = "float:right;" + imgStyle 
             if (img.parentElement.href) imgStyle = "cursor:hand;" + imgStyle 
             var strNewHTML = "<span " + imgID + imgClass + imgTitle 
             + " style=\"" + "width:" + img.width + "px; height:" + img.height + "px;" + imgStyle + ";" 
             + "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader" 
             + "(src=\'" + img.src + "\', sizingMethod='scale');\"></span>" 
             img.outerHTML = strNewHTML 
             j = j-1 
          } 
       } 
    } 
} 

function imgCenter(tObj,cc,nc){
	try{
		tObj.style.marginTop = "0px";
		var pObj = tObj.parentNode; 
		if(cc>1){ 
			for(var i=1;i<cc;i++){ 
				pObj = pObj.parentNode;
				if(cc-nc-1==i){
					var pnObj = pObj;
				}
			} 
		} 
		if(!pnObj){
			pObj.style.textAlign="center";
		}
		pHeight = pObj.style.height;
		pWidth = pObj.style.width;
		if(pHeight.length <= 2){
			pHeight = getEyeJsStyle(pObj,"height");
		}
		if(pHeight.length > 2){
			pHeight = parseInt(pHeight.substring(0,pHeight.length-2)); 
		}
		if(pWidth.length <= 2){
			pWidth = getEyeJsStyle(pObj,"width");
		}
		if(pWidth.length > 2){
			pWidth = parseInt(pWidth.substring(0,pWidth.length-2)); 
		}
		tHeight = tObj.height; 
		tWidth = tObj.width; 
		if(pHeight>tHeight){
			var margtop = parseInt((pHeight-tHeight)/2); 
			if(margtop>0){
				if(pnObj){
					pnObj.style.paddingTop = margtop+"px"; 
					pnObj.style.height = (pHeight-margtop)+"px"; 
					if(pWidth>tWidth){
						var margleft = parseInt((pWidth-tWidth)/2);
						pnObj.style.paddingLeft = margleft+"px"; 
						pnObj.style.width = (tWidth+2)+"px";
					}
				}else{
					tObj.style.marginTop = margtop+"px"; 
				}
			}
		}
	}catch(e){}
} 

function getEyeJsStyle(obj,styleName){ 
	var $=function(id){return document.getElementById(id) }; 
	if(obj.currentStyle){//ie 
		return obj.currentStyle[styleName]; 
	}else{ //ff 
		var $arr=obj.ownerDocument.defaultView.getComputedStyle(obj, null); 
		return $arr[styleName]; 
	} 
} 

function getCurShow(cur,curSymbol,p,sType){
	var returnStr="";
	var rePrice=p;
	if(cur=="BRL" || cur=="brl"){
		var strp = p.toString();
		var pary = strp.split(".");
		var rePrice2 = pary[0];
		var rePrice3 = "";
		if(rePrice2.length>3){
			for(var i=1;i*3<rePrice2.length;i++){
				rePrice3 = "."+rePrice2.substring(rePrice2.length-i*3,rePrice2.length-(i-1)*3)+rePrice3;
			}
			rePrice3 = rePrice2.substring(0,rePrice2.length-(i-1)*3)+rePrice3;
		}else{
			rePrice3 = rePrice2;
		}
		if(pary[1]){
			var rePrice = pary[1];
		}else{
			var rePrice = '00';
		}
		rePrice = rePrice3 + "," + rePrice;
	}else if(cur=="ZAR" || cur=="zar"){
		var strp = p.toString();
		var pary = strp.split(".");
		var rePrice2 = pary[0];
		var rePrice3 = "";
		if(rePrice2.length>3){
			for(var i=1;i*3<rePrice2.length;i++){
				rePrice3 = ","+rePrice2.substring(rePrice2.length-i*3,rePrice2.length-(i-1)*3)+rePrice3;
			}
			rePrice3 = rePrice2.substring(0,rePrice2.length-(i-1)*3)+rePrice3;
		}else{
			rePrice3 = rePrice2;
		}
		if(pary[1]){
			var rePrice = pary[1];
		}else{
			var rePrice = '00';
		}
		rePrice = rePrice3 + "." + rePrice;
	}else if(cur=="RUB" || cur=="rub"){
		var strp = p.toString();
		var rePrice2 = "";
		if(strp.length>3){
			for(var i=1;i*3<strp.length;i++){
				rePrice2 = " "+strp.substring(strp.length-i*3,strp.length-(i-1)*3)+rePrice2;
			}
			rePrice = strp.substring(0,strp.length-(i-1)*3)+rePrice2;
		}
	}else if(cur=="JPY" || cur=="jpy"){
	}else{
		var strp = p.toString();
		var pary = strp.split(".");
		if(pary.length==1){
			strp = strp + ".00";
		}
		rePrice = strp;
	}
	if(sType==1){
		returnStr = rePrice;
	}else{
		if(cur=="RUB" || cur=="rub"){
			returnStr = rePrice+" "+curSymbol;
		}else if(cur=="ZAR" || cur=="zar"){
			returnStr = curSymbol + rePrice;
		}else{
			returnStr = curSymbol+" "+rePrice;
		}
	}
	return returnStr;
}

function idinorEnter(httpUrl,TypeCurrency){
var jsStrUserName = ReadCookie("USERNAME").split(" ")[0];
	if(jsStrUserName && jsStrUserName != ""){
		if(ReadCookie("IDINORSTATS")==1){
			enterText = "<a  target='_blank' href='"+httpUrl+"livehelp/qtype-8/"+TypeCurrency+"'>Start one-to-one Livechat</a>";
		}else{
			if(TypeCurrency == ""){TypeCurrency=".html";}
			else{TypeCurrency = "-"+TypeCurrency;}
			enterText = "<a href='"+httpUrl+"html/idinor"+TypeCurrency+"' target='_blank'>How to be iDinor member</a>";
		}
	}else{
			enterText = "<a  target='_blank' href='"+httpUrl+"livehelp/qtype-8/"+TypeCurrency+"'>Start one-to-one Livechat</a>";
	}
	var ime = document.getElementById("iDinorMemberEnter");
	ime.innerHTML = enterText;
}



function GradeVote(){
	this.voteMaxStar = 1;
	this.voteCounter = 1;
	this.voteContent = new Array();
	this.gradeVoteImage1 = "";
	this.gradeVoteImage2 = "";
	
	this.CreateVote = function(MaxStar,DefaultStar,id)
	{
		var i = 1,j = 1;
		var VoteImgHTML = "";
		this.voteMaxStar = MaxStar;
		for(i=1;i <= MaxStar;i++)
		{
			VoteImgHTML += "<img id=\""+id+"_"+i+"\" src=\""+this.gradeVoteImage1+"\" width=\"13\" height=\"13\" align=\"absmiddle\"  style=\"cursor:pointer\" onmouseover=\"WindowVote.HitVote('"+id+"','"+i+"');\" onmouseout=\"WindowVote.OutVote('"+id+"')\" onclick=\"WindowVote.VoteSubmit('"+id+"','"+i+"');\" >";
		}
		var starHTML = document.getElementById("startHtml_"+id);
		if(null!=starHTML) starHTML.innerHTML = VoteImgHTML;
	}
	
	this.OutVote = function (id)
	{
		num = 0;
		var temp = document.getElementById("choiceStar_"+id).value;
		if(temp != 0)
		{
			num = temp;
		}
		for (i = 1;i <= this.voteMaxStar;i++)
		{
			document.getElementById(id+"_"+i).src = this.gradeVoteImage2;	
		}
		for (i = parseInt(num) + 1;i <= this.voteMaxStar;i++)
		{
			document.getElementById(id+"_"+i).src = this.gradeVoteImage1;	
		}
	}
	
	this.HitVote = function (id,num) 
	{
		var i = 1;
		for (i = 1;i <= num;i++)
		{
			document.getElementById(id+"_"+i).src = this.gradeVoteImage2;	
		}
		num++;
		for (i = num;i <= this.voteMaxStar;i++)
		{
			document.getElementById(id+"_"+i).src = this.gradeVoteImage1;
		}
	}
	
	this.VoteSubmit = function(id,num)
	{
		document.getElementById("choiceStar_"+id).value = num;
	}
}


window.onbeforeunload = function()
{
	//SetCookie("DCARTCOUNT",-1,24*7);
};

function SpecOrderOnSubmit(id,pid) {
	if(id){
		var obj = document.getElementById('soemail'+id);
	}else{
		var obj = document.getElementById('soemail');
	}
	if(pid){}else{pid="";}
	if(trim(obj.value) == "" || trim(obj.value)=="E-mail address..."){
		alert("Please enter an email address before subscription.");
		AlertInfoAdd("Please enter an email address before subscription.",0,pid);
		obj.focus();
		obj.select();
		return false;
	}else if (!isEmail(obj.value)) {
		alert("Please enter a valid email address.");
		obj.focus();
		obj.select();
		return false;
	}
	return true;
}
function isEmail(s){
	s = trim(s); 
 	var p = /^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.){1,4}[a-z]{2,3}$/i; 
 	return p.test(s);
}

function addLoadEvent(func){
 var oldFun = window.onload;
 if( typeof(window.onload) != 'function'){
	 window.onload = func;
 }else{
  window.onload = function(){
  	oldFun();
	func();
  }
 }
}

function addOnresizeEvent(func){
 var oldFun = window.onresize;
 if( typeof(window.onresize) != 'function'){
	 window.onresize = func;
 }else{
  window.onresize = function(){
  	oldFun();
	func();
  }
 }
}

function addOnmousewheelEvent(func){
 var oldFun = document.onmousewheel;
 if( typeof(document.onmousewheel) != 'function'){
	 document.onmousewheel = func;
 }else{
  document.onmousewheel = function(e){
  	oldFun();
	func();
  }
 }
}

function addOnscrollEvent(func){
 var oldFun = document.onscroll;
 if( typeof(document.onscroll) != 'function'){
	 document.onscroll = func;
 }else{
  document.onscroll = function(e){
  	oldFun();
	func();
  }
 }
}
function autoBanner(){
	if(document.getElementById("head_banner")){
		var bannerobj = document.getElementById("head_banner");
		var bannermainobj = document.getElementById("head_banner_main");
		var tpwidth = bannermainobj.clientWidth;
		var mleft = parseInt((1680-tpwidth)/2);
		bannerobj.style.left = "-"+mleft+"px";
	}
}

function autoBestBanner(){
	if(document.getElementById("best_banner")){
		var bannerobj = document.getElementById("best_banner");
		var bannermainobj = document.getElementById("best_banner_main");
		var tpwidth = bannermainobj.clientWidth;
		var mleft = parseInt((1680-tpwidth)/2);
		bannerobj.style.left = "-"+mleft+"px";
	}
}
function autoiDinorBanner(){
	if(document.getElementById("idinor_banner")){
		var bannerobj = document.getElementById("idinor_banner");
		var bannermainobj = document.getElementById("idinor_banner_main");
		var tpwidth = bannermainobj.clientWidth;
		var mleft = parseInt((1274-tpwidth)/2);
		bannerobj.style.left = "-"+mleft+"px";
	}
}

function include_dom(script_filename) {
    var html_doc = document.getElementsByTagName('head').item(0);
    var js = document.createElement('script');
    js.setAttribute('language', 'javascript');
    js.setAttribute('type', 'text/javascript');
    js.setAttribute('src', script_filename);
    html_doc.appendChild(js);
    return false;
}
function GetFreeSample(pid,phobbycode){
	var jsStrUserName = ReadCookie("USERNAME").split(" ")[0].substring(0,6);
	windowwidth = window.screen.availWidth;
	windowwidth1 = document.body.clientWidth;
	if(windowwidth < windowwidth1){
		windowwidth = windowwidth1;
	}
	leftwidth = parseInt(windowwidth - 454)/2;
	var scrollTop = 0;
	if(document.documentElement && document.documentElement.scrollTop){
		scrollTop = document.documentElement.scrollTop+50;
	}else if(document.body){
		scrollTop = document.body.scrollTop+50;
	}
	if(jsStrUserName && jsStrUserName != ""){
		if(ReadCookie("IDINORSTATS")==1){	
		}else{
			document.getElementById("HasDinor_message").style.top = scrollTop+"px";
			document.getElementById("HasDinor_message").style.left = leftwidth+"px";
			document.getElementById("HasDinor_overlayer").style.display = "block";
			document.getElementById("HasDinor_message").style.display = "block";
			return false;
		}
	}else{
		document.getElementById("HasDinor_message").style.top = scrollTop+"px";
		document.getElementById("HasDinor_message").style.left = leftwidth+"px";
		document.getElementById("HasDinor_overlayer").style.display = "block";
		document.getElementById("HasDinor_message").style.display = "block";
		return false;
	}
	if(document.getElementById("gfs_productid")){
		document.getElementById("gfs_productid").value = pid;
		if(phobbycode){
			document.getElementById("gfs_phobbycode").value = phobbycode;
		}
		document.getElementById("gfs_form").submit();
	}
}

function addBookmark(title,url){
	if(window.sidebar){
		window.sidebar.addPanel(title,url,"");
	}else if(document.all){
		window.external.AddFavorite(url,title);	
	}else if(window.opera && window.print){
		return true;	
	}
}

function idinor_Personalmoveover(){
	document.getElementById("freesample").style.display = "block";
}
function idinor_Personalmoveout(){
	document.getElementById("freesample").style.display = "none";
}

function CheckLogin(){
	windowwidth = window.screen.availWidth;
	windowwidth1 = document.body.clientWidth;
	if(windowwidth < windowwidth1){
		windowwidth = windowwidth1;
	}
	leftwidth = parseInt(windowwidth - 454)/2;
	var scrollTop = 0;
	if(document.documentElement && document.documentElement.scrollTop){
		scrollTop = document.documentElement.scrollTop+50;
	}else if(document.body){
		scrollTop = document.body.scrollTop+50;
	}
	document.getElementById("login_message").style.top = scrollTop+"px";
	document.getElementById("login_message").style.left = leftwidth+"px";
	document.getElementById("login_overlayer").style.display = "block";
	document.getElementById("login_message").style.display = "block";
	return false;
}

function CloseTn(){
	if(document.getElementById("login_overlayer"))
	document.getElementById("login_overlayer").style.display = "none";
	if(document.getElementById("login_message"))
	document.getElementById("login_message").style.display = "none";
	
	if(document.getElementById("HasDinor_overlayer"))
	document.getElementById("HasDinor_overlayer").style.display = "none";
	if(document.getElementById("HasDinor_message"))
	document.getElementById("HasDinor_message").style.display = "none";
}

function AlertInfoAdd(info,type,pid,mem){
	if(pid){}else{pid = 0;}	
	if(ReadCookie("PCUID") == ""){	
		SetCookie("PCUID",uuid(),24*365);
	}
	if(ReadCookie("UUID") == ""){	
		SetCookie("UUID",uuid());
	}
	if(mem){}else{mem = "";};
	strData = "userAgent=" + navigator.userAgent 
					+ "&PCUID=" + ReadCookie("PCUID")
					+ "&UUID=" + ReadCookie("UUID") 
					+ "&productid=" + pid 
					+ "&alertType=" + type 
					+ "&content=" + info 
					+ "&mem=" + mem 
					+ "&currUrl=" + document.location;
	if(strData != ""){
		jQuery.ajax({url:jsMainSiteUrl+'ActionCom/AlertInfoAjax.cfm',
			type:'post',
			data:strData,
			error:function(XMLHttpRequest,text,dd){this;},
			success:function(data){}
			   });
		}
}

function uuid() {
	var ret = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'
	.replace(/[xy]/g, function (c) {
		var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
		return v.toString(16);
	}).toUpperCase();
	return ret;
}