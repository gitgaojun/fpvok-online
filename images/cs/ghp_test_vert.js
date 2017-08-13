// GHP Primary Message Test Script
// Tracking Code
var debug_level = 0;
var track_string = "";
var tcampaign = "";
var link_header = "";
var link_clicked = "";
// Primary Message - Vertical Buttons
var vb_initpanel = 0;
var vb_button_number = 0;
var vb_onpanel = 1; // Initial panel displayed
// Track Type
var ttype = "GHP";
// Slideshow Initialization
var timeout_val_ss = 0; // Initialize timeout variable for the slideshow.
$(document).ready(function() {
	// Initialize PM Vertical Button
	if($('#pm_vb').length > 0)
	{
	    vb_Init();
	}
	// Initialize Tracking
	elementBind('#ghp_wrapper','.content-box a',track_content);
	elementBind('#primary','.content-box a',track_content);
	elementBind('#pm_vb','.vb_content_area a',track_vblink);
	elementBind('#ghp_wrapper','.stealth_bomber a',track_bomber);
	elementBind('#b52','a',track_b52);
});
function vb_Init()
{
		// Preload Images
		var preloadImg;
		var imgurl;
		$('.vb_content').each(function(i){
		  imgurl = $(this).css('background-image');
		  imgurl = imgurl.replace('url("','').replace('")',''); // For Firefox and iE
		  imgurl = imgurl.replace('url(','').replace(')',''); // For Chrome and Safari
		  if(imgurl != "none")
		  {
			preloadImg = new Image();
			preloadImg.src = imgurl;
			}
		});
		$(".vert_button").bind("click.ghp",vb_gotoPanel);
		vb_button_number = $('.vert_button').length;
		vb_onpanel = vb_onpanel-1;
		if(vb_onpanel < 0 || vb_onpanel > vb_button_number)
		{
		vb_onpanel = 0;
		}
		vb_gotoPanel();
		$(".vert_button").show();
}
// Vertical Button Script
function vb_gotoPanel()
{
	var vb_button = $('.vert_button');
    var vb_index = 0;
    if(vb_initpanel == 0)
	{
	    vb_index = vb_onpanel;
		$(".vb_content:eq("+vb_index+")").show();
		$(".vert_button:eq("+vb_index+")").removeClass('vb_off').addClass('vb_on');
	}
	else
	{
		vb_index = $(vb_button).index(this);
		// Create Fade Effect
		$('.vb_content').fadeOut(500);
		$(".vb_content:eq("+vb_index+")").fadeIn(500);
		$('.vert_button').addClass('vb_off').removeClass('vb_on');
		$(".vert_button:eq("+vb_index+")").removeClass('vb_off').addClass('vb_on');
		track_string = "Tab_" + (vb_index+1) + ":" + $.trim($(".vb_text:eq("+vb_index+")").children('h4').text());
		sendTrackingData();
		vb_onpanel = vb_index;
	}
	vb_initpanel = 1;
}
// Tracking Functions
function elementBind(eid,element,target_function)
{
	if($(element).length != 0)
	{
		$(eid).find(element).bind("click.ctg",target_function);	
	}
}
function appendSegment(str, seg, del) {
	return (str == null || str.length == 0 || str == "") ? seg : str + del + seg;
}
function image_link(a)
{
    
	if($(a).children('img').length > 0)
	{
	link_clicked = $(a).children('img').attr('alt');
	}
	else
	{
	link_clicked = $(a).text();
	}
}
function track_content()
{
	var c_class = "";
    $(this).parents('div').each(function(i){
	    c_class = $(this).attr('class');
		c_id = $(this).attr('id');
		//alert(c_class + " : " + c_id) ;
		if(/content-box/.test(c_class))
		{
			link_header = link_header + $(this).children('.content-heading').children('h4').text();
		}
	});
	if($(this).parents('div').children('h4').length != 0)
	{
		var add_header = $.trim($(this).parents('div').children('h4').text());
		link_header = appendSegment(link_header, add_header, '-');
	}
	if($(this).parents('li').children('h4').length != 0)
	{
		var add_header = $.trim($(this).parents('li').children('h4').text());
		link_header = appendSegment(link_header, add_header, '-');
	}
	image_link($(this));
	if(!link_clicked)
	{
	link_clicked = $(this).text();
	}
	var c_ele = $(this).parents('li').attr('class');
	if(/featured/.test(c_ele))
	{
		tcampaign = "FO_" + ($("."+c_ele).index($(this).parents('li')) + 1);
	}
    track_string = tcampaign + ":" + $.trim(link_header) + ":" + $.trim(link_clicked);
	sendTrackingData();
}
function track_vblink()
{
	link_header = $("#pm_vb").find(".vb_text:eq("+vb_onpanel+")").children('h4').text();
	image_link($(this));
	if(link_clicked == "")
	{
		link_clicked = "ClickPanel";
	}
	tcampaign = "Panel_" + (vb_onpanel + 1);
	track_string = tcampaign + ":" + $.trim(link_header) + ":" + $.trim(link_clicked); 
	sendTrackingData();
}
function track_bomber()
{
	image_link($(this));
	tcampaign = "F22_" + ($('.stealth_bomber').index($(this).parents('.stealth_bomber')) + 1);
	track_string = tcampaign + ":" + $.trim(link_clicked); 
	sendTrackingData();
}
function track_b52()
{
	image_link($(this));
	track_string = "B52:" + $.trim(link_clicked); 
	sendTrackingData();
}
function sendTrackingData()
{
	//var pagename = track.catName;
	// Remove any whitespace and line breaks
	function replaceBreaks(tstring)
	{
		tstring.replace(/[\r\n]+/g, "");
		return tstring;
	}
	// Replace any undesirable characters
	function replaceChar(tstring)
	{
	   tstring = tstring.replace('&amp;','&').replace('<b>','').replace('</b>','').replace('<br>','').replace('&gt;','>').replace('&nbsp;','').replace('</p>','').replace('<span>','').replace('</span>','');
	   tstring = tstring.replace('<nobr>','').replace('</nobr>','').replace('<strong>','').replace('</strong>','').replace('<p>','').replace('&#153;','');
	   return tstring;		
	}
	track_string = replaceChar(track_string);
	track_string = replaceBreaks(track_string);
	if (debug_level > 0) {
		alert(pagename+":"+ttype+":"+track_string+" Campaign: " +tcampaign);
	}
	//if(tcampaign != "")
	//{
	// Send data to Ominiture Previous Page Link Report and Custom Link Report using event.link
	//trackEvent.event('event.link',{lid:pagename+":"+ttype+":"+track_string,lastLink:ttype+":"+track_string,page:pagename});
	//}
	//else
	//{
	//tcampaign = pagename + ":" + tcampaign;
	// Send data to Ominiture Previous Page Link Report and Custom Link Report using event.link + campaign
	//trackEvent.event('event.link',{lid:pagename+":"+ttype+":"+track_string,lastLink:ttype+":"+track_string,pageCampaign:tcampaign});
	//}
	link_header = "";
	link_clicked = "";
	track_string = "";
	tcampaign = "";
}


