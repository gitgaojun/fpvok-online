/**
 * @package pearltea
 * @copyright Copyright 2007 slucky Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: frmCheck.js - create by tankai 2007-10-19
 */

function field_check(name, rule, field) {
	if (rule.indexOf("cpwd") > -1) {
		strTmp = rule.split("#");
		if (strTmp[0].inc("cpwd", "/") == true
				&& field.value != $get(strTmp[1]).value) {
			return "The " + name + " must match your "
					+ name.split(" Confirmation")[0];
		}
	}
	if (rule.inc("eml", "/") == true
			&& !/(\,|^)([\w+._]+@\w+\.(\w+\.){0,3}\w{2,4})/.test(field.value
					.replace(/-|\//g, "")) && !isNone(field.value)) {
		return "Is your "
				+ name
				+ " correct? Sorry, my system does not understand your email address.";
	}
	if (rule.inc("tel", "/") == true && !/(^[0-9+-]{3,30}$)/.test(field.value)
			&& !isNone(field.value)) {
		return "Is your "
				+ name
				+ " correct? Sorry, my system does not understand your telephone format.";
	}
	size = rule.sub("min", "/");
	if (size > 0) {
		if (field.value.trim().length < size && field.value.trim().length > 0) {
			return "Is your " + name
					+ " correct? Our system requires a minimum of " + size
					+ " characters.";
		}
	}
	size = rule.sub("max", "/");
	if (size > 0) {
		if (field.value.trim().length > size) {
			return "Is your " + name
					+ " correct? Our system requires a maximum of " + size
					+ " characters.";
		}
	}
	if (rule.inc("nnull", "/") == true && isNone(field.value)) {
		return "Sorry, " + name + " information is required.";
	}
	if (rule.inc("ischeck", "/") == true && !field.checked) {
		return name;
	}
	if (rule.inc("isselect", "/") == true && field.value == '-1') {
		return 'Please Choose "' + name + '"';
	}
	return "";
};

/* #ajax# */
var XMLHttp;
function createXMLHttpRequest() {
	if (window.XMLHttpRequest) {
		XMLHttp = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		try {
			XMLHttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e) {
		}
	}
}
var email_exist;
email_exist = false;
function sendRequest(url, div, param, select) {

	createXMLHttpRequest();
	if (param != '' && select != '') {
		url = url + '&' + param + '=' + document.getElementById(select).value;
	}
	if (typeof (extra) != 'undefined') {
		if (extra != '') {
			url = url + extra;
		}
	}
	XMLHttp.open('GET', url, true);
	XMLHttp.onreadystatechange = function processResponse() {
		var out_img = $get(div).parentNode.getElementsByTagName("img")[0];
		var out_text = $get(div);
		var out_input = $get(div).parentNode.getElementsByTagName("input")[0];
		var msg = chkInput(out_input);
		var img_path = baseURL + "includes/templates/slucky/images/checkout";
		var error_bg = "#FEDFDF", blur_bg = "";
		if (XMLHttp.readyState == 4 && XMLHttp.status == 200) {
			if (XMLHttp.responseText.indexOf('__none__')==-1) {
				email_exist = true;
				msg = XMLHttp.responseText;
			} else {
				email_exist = false;
			}
			if (msg === "success" && !email_exist) {
				out_img.src = img_path + "/ico_T.gif";
				out_img.style.display = "inline";
				out_text.style.display = "none";
				out_input.style.backgroundColor = blur_bg;
				$get(div).innerHTML = "";
			} else {
				msg = msg === "success" ? '' : msg;
				out_img.src = img_path + "/ico_F.gif";
				out_img.style.display = "inline";
				$get('login-email-address').value = email_exist ? out_input.value
						: "";
				out_text.innerHTML = msg;
				out_text.style.display = "block";
				if ((out_input.tagName === "INPUT" && (out_input.type === "text" || out_input.type === "password"))
						|| out_input.tagName === "TEXTAREA") {
					out_input.style.backgroundColor = error_bg;
				}
			}
		} else {
			out_img.src = img_path + "/loading.gif";
		}

	};
	XMLHttp.send(null);
}
/* #表单验证# */
function fmChk(fm) {
	var name, rule, tmp, msgStr, size;
	if (fm == null || fm.tagName != "FORM") {
		alert("", null, "error");
		return;
	}
	for (i = 0; i < fm.length; i++) {
		var msgStr = chkInput(fm[i]);
		if (fm.name == 'create_account' && fm[i].name == 'email_address') {
			if ($get('errorDiv').innerHTML !== '') {
				alert($get('errorDiv').innerHTML);
				fm[i].focus();
				return false;
			}
		}
		if (msgStr != "success") {
			efocu(fm[i]);
			msg(msgStr);
			return false;
		}
	}
	return true;
};

function chkInput(obj) {
	var name, rule, msgStr;
	name = obj.getAttribute("chkName");
	rule = obj.getAttribute("chkRule");
	if (isNone(rule) || isNone(name))
		return "success";
	msgStr = field_check(name, rule, obj);
	if (msgStr != "") {
		return msgStr;
	} else {
		return "success";
	}
};

function msg(key) {
	alert(key);
};
var currentForm;
function initForm(el, func) {
	var img_path = baseURL + "includes/templates/slucky/images/checkout";
	(new Image(10, 10)).src = img_path + "/ico_F.gif";
	var error_bg = "#FEDFDF", blur_bg = "", focus_bg = "#FFFEE1";
	var formId = $get(el);
	if (formId == null || formId.tagName != "FORM") {
		alert("", null, "error");
		return;
	}
	var addImage = '<img src="' + img_path + "/ico_T.gif"
			+ '" width="10" height="10" style="display:none;" class="pad_l"/>';
	if (formId.name == 'create_account') {
		var addDiv = '<div id="errorDiv" style="display:none;" class="red line_120"></div>';
	} else {
		var addDiv = '<div style="display:none;" class="red line_120"></div>';
	}
	var elArr = formId.elements;
	var elLen = elArr.length;
	for (i = 0; i < elLen; i++) {
		// insert the img and div
		var addHtml = elArr[i].getAttribute("chkRule");
		if (addHtml) {
			insHtm(elArr[i], addImage);
			insHtm(elArr[i], addDiv);

			// add the mouse style have check;
			elArr[i].onfocus = function() {
				if ((this.tagName === "INPUT" && (this.type === "text" || this.type === "password"))
						|| this.tagName === "TEXTAREA") {
					this.style.backgroundColor = focus_bg;
				}
			}
			elArr[i].onblur = function() {
				this.style.backgroundColor = blur_bg;
				var out_img = this.parentNode.getElementsByTagName("img")[0];
				var out_text = this.parentNode.getElementsByTagName("div")[0];
				var msg = chkInput(this);
				formId = this.parentNode.parentNode.parentNode.parentNode.parentNode;
				if (formId.name == 'create_account'
						&& this.name == 'email_address') {
					var url = formId.attributes['action'].value
							+ "&ajax=true&email_address=" + this.value;
					sendRequest(url, 'errorDiv', '', '');
				} else {
					if (msg === "success") {
						out_img.src = img_path + "/ico_T.gif";
						out_img.style.display = "inline";
						out_text.style.display = "none";
					} else {
						out_img.src = img_path + "/ico_F.gif";
						out_img.style.display = "inline";
						out_text.innerHTML = msg;
						out_text.style.display = "block";
						if ((this.tagName === "INPUT" && (this.type === "text" || this.type === "password"))
								|| this.tagName === "TEXTAREA") {
							this.style.backgroundColor = error_bg;
						}
					}
				}

				if (func != null) {
					try {
						eval(func);
					} catch (e) {
					}
				}
			}
		} else {
			// add the mouse style not check;
			if ((elArr[i].tagName === "INPUT" && (elArr[i].type === "text" || elArr[i].type === "password"))
					|| elArr[i].tagName === "TEXTAREA") {
				elArr[i].onfocus = function() {
					this.style.backgroundColor = focus_bg;
				}
				elArr[i].onblur = function() {
					this.style.backgroundColor = blur_bg;
					if (func != null) {
						try {
							eval(func);
						} catch (e) {
						}
					}
				}
			}
		}
	}
}