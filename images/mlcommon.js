var sPop = null;
var postSubmited = false;
var userAgent = navigator.userAgent.toLowerCase();
var is_webtv = userAgent.indexOf('webtv') != -1;
var is_kon = userAgent.indexOf('konqueror') != -1;
var is_mac = userAgent.indexOf('mac') != -1;
var is_saf = userAgent.indexOf('applewebkit') != -1 || navigator.vendor == 'Apple Computer, Inc.';
var is_opera = userAgent.indexOf('opera') != -1 && opera.version();
var is_moz = (navigator.product == 'Gecko' && !is_saf) && userAgent.substr(userAgent.indexOf('firefox') + 8, 3);
var is_ns = userAgent.indexOf('compatible') == -1 && userAgent.indexOf('mozilla') != -1 && !is_opera && !is_webtv && !is_saf;
var is_ie = (userAgent.indexOf('msie') != -1 && !is_opera && !is_saf && !is_webtv) && userAgent.substr(userAgent.indexOf('msie') + 5, 3);
var Image_url
	var xml_http_building_link = '<img src="' + Image_url + 'check_loading.gif" width="15" height="15">';
	var xml_http_sending = '<img src="' + Image_url + 'check_loading.gif" width="15" height="15">';
	var xml_http_loading = '<img src="' + Image_url + 'check_loading.gif" width="15" height="15">';
	var xml_http_load_failed = '<img src="' + Image_url + 'check_error.gif" width="15" height="15">';
	var xml_http_data_in_processed = '<img src="' + Image_url + 'check_loading.gif" width="15" height="15">';

function $(id) {
	return document.getElementById(id);
}

function getEntryData(value,id) {
	$(id).innerHTML=value;
	showEntryIdDiv(id,true);
}
function showEntryIdDiv(id,flag) {
	if(flag == true) {
		$(id).style.display = "";
	}
	else {
		$(id).style.display = "none";
	}
}

function startmarquee(lh,speed,delay,index){ 
var t; 
var p=false; 
var o=document.getElementById("marqueebox"+index); 
o.innerHTML+=o.innerHTML; 
o.onmouseover=function(){p=true} 
o.onmouseout=function(){p=false} 
o.scrollTop = 0; 
function start(){ 
t=setInterval(scrolling,speed); 
if(!p) o.scrollTop += 2; 
} 
function scrolling(){ 
if(o.scrollTop%lh!=0){ 
o.scrollTop += 2; 
if(o.scrollTop>=o.scrollHeight/2) o.scrollTop = 0; 
}else{ 
clearInterval(t); 
setTimeout(start,delay); 
} 
} 
setTimeout(start,delay); 
}

//将带html特殊符号标记的转换为正常文本
String.prototype.htmlToStr=function(){
	var str=this.replace('&#039;',"'");
	return str;
};

String.prototype.Right=function(a){if(isNaN(a)||a==null){a=this.length}else{if(parseInt(a)<0||parseInt(a)>this.length){a=this.length}}return this.substring(this.length-a,this.length)}

if(typeof(jQuery)!='undefined'){
(function($){

$.fn.w_tab=function(m){if(typeof(m)=="number"){return this.each(function(){$(this).children($(this).data('wtab_child')).eq(m).triggerHandler("click")})}else{var m=$.extend({},$.fn.w_tab.defaults,m);this.data('wtab_child',m.child);return this.each(function(){if(m.acdiv){if(!m.divaim){return}}var k="",oldei=-1,sib=Array(),t_film,$this=$(this);var l=$this.children(m.child);l.each(function(){var a=$(this).attr('aim').split(' ');sib.push(a)});for(var i=0;i<sib.length;i++){for(var j=0;j<sib[i].length;j++){newzaim=$('#'+sib[i][j]).hover(function(){pausefilm()},function(){startfilm()})}}l.each(function(f){var g=$(this);var h={aM:sib[f][0],lK:g.attr('lnk'),cC:g.attr('class'),cH:g.attr('cssH')||m.cssH,cS:g.attr('cssS')||m.cssS,sC:g.attr('style'),sH:g.attr('styH'),sS:g.attr('styS')};h.cC=h.cC.replace(h.cS,'');g.mouseover(function(e){if(k[0]!=this){if(h.cH){this.className=h.cH}if(h.sH){$(this).attr('style',h.sH)}if(m.event=='hover'){$(this).triggerHandler('click')}}if(e.pageX>0){pausefilm()}}).mouseout(function(e){if(k[0]!=this){if(h.cC){this.className=h.cC}else{this.className=""}if(h.sC){$(this).attr('style',h.sC)}}if(e.pageX>0){startfilm()}}).click(function(){if(k[0]==this){return}var b=k;k=$(this);if(b!=""){b.triggerHandler("mouseout")}if(h.cS){this.className=h.cS}if(h.sS){$(this).attr('style',h.sS)}var c=h.aM.split('#');if(c.length>1){h.aM=c[1];h.dT=c[0]}else{h.dT='div'}var d=$('#'+h.aM);if(d.length<1){if(m.acdiv){d=$('<'+h.dT+' id="'+h.aM+'" class="'+m.divcss+'" style="'+m.divsty+'">').appendTo($('#'+m.divaim))}else{return}}var e,newzaim;if(oldei>-1){for(var j=0;j<sib[oldei].length;j++){if(j==0&&m.funeffect!=0){e=$('#'+sib[oldei][j])}else{$('#'+sib[oldei][j]).css('display','none')}}}for(var j=0;j<sib[f].length;j++){if(j==0&&m.funeffect!=0){newzaim=$('#'+sib[f][j])}else{$('#'+sib[f][j]).css('display','block')}}oldei=f;if(m.funeffect!=0){m.funeffect.call($(this),e,newzaim)}if(h.lK){if(d.attr('isContent')!="1"||!m.cache){d.html(m.load);$.ajax({url:h.lK,type:"GET",data:m.param,success:function(a){d.html(a);d.attr('isContent',"1")}})}}})});function startfilm(){if(m.filmtime){t_film=setInterval(filmplay,m.filmtime)}}function pausefilm(){if(m.filmtime){clearInterval(t_film)}}function filmplay(){var a=oldei+1==l.length?0:oldei+1;l.eq(a).triggerHandler("click")}startfilm()})}};$.fn.w_tab.defaults={param:{},acdiv:0,divcss:"",divsty:"",cssH:"",cssS:"",divaim:0,cache:1,event:'click',load:'',funeffect:0,filmtime:0,child:''}



$.fn.w_picSwap=function(d){var d=$.extend({},$.fn.w_picSwap.defaults,d);return this.each(function(){var a=$(this);if(a.length==0){return false}var b=0,$tmpel,old=0,now=0,sib=Array();var c=a.children(d.child);$div=$('<div>').css({'position':'relative','overflow':'hidden','height':a.css('height')});c.each(function(i){if(d.tnum>1){if(i==0||i%d.tnum==0){$tmpel=$('<div>');sib.push($tmpel)}$tmpel.append($(this))}else{sib.push($(this))}});for(var i=0;i<sib.length;i++){i>0&&sib[i].css({'display':'none'});sib[i].css({'position':'absolute'});$div.append(sib[i])};$div.appendTo(a);if(d.cbtn){$.each(d.cbtn,function(i,n){$('#'+n).click(function(){end();d.way=i;showImg();begin()})})}function showImg(){if(d.way){old=now;now=(now==(sib.length-1))?0:now+1}else{old=now;now=(now==0)?sib.length-1:now-1}d.funeffect.call($div,sib[old],sib[now],d.way)};function begin(){if(d.delay>0){b=setInterval(showImg,d.delay)}};function end(){if(b){clearInterval(b)}};$div.hover(function(){end()},function(){begin()});begin()})};$.fn.w_picSwap.defaults={delay:2000,way:1,cbtn:0,tnum:1,funeffect:0,child:''}


$.fn.hideTime=function(t,b){if(b==undefined){var b=['hide',[100]]}return this.each(function(){var a=$(this);if(t=='stop'){clearTimeout(a.data('hidetimenum'))}else{a.data('hidetimenum',setTimeout(hide,t))}function hide(){a[b[0]].apply(a,b[1])}})}



$.fn.w_nullInputState=function(s,c){if(c==undefined){var c=''}return this.each(function(){if(this.value==''){this.value=s;c!=''&&$(this).addClass(c)}$(this).focus(function(){if(this.value==s){this.value='';c!=''&&$(this).removeClass(c)}}).blur(function(){if(this.value==''){this.value=s;c!=''&&$(this).addClass(c)}})})}



$.fn.timedown=function(a){a=$.extend({},$.fn.timedown.defaults,a);a.sec=Number(a.sec);if(a.sec<=0){return}var b=this,tH=parseInt(a.sec/3600),tM=parseInt(a.sec/60%60),tS=parseInt(a.sec%60),strH=('00'+tH).Right(2),strM=('00'+tM).Right(2),strS=('00'+tS).Right(2),clockH=b.children('.clockH').val(strH),clockM=b.children('.clockM').val(strM),clockS=b.children('.clockS').val(strS),ctime;function reftime(){tS-=1;if(tS<0){if(tH==0&&tM==0){clockH.hide();clockM.hide();clockS.hide();clearInterval(ctime);return}tS=59;tM-=1;if(tM<0){tM=59;tH-=1;clockH.val(('00'+tH).Right(2))}clockM.val(('00'+tM).Right(2))}clockS.val(('00'+tS).Right(2))};ctime=setInterval(reftime,1000)};$.fn.timedown.defaults={sec:0};

})(jQuery);
}


