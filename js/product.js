$(function(){
	CountPrice();
	$(".add").click(function(){
		Add();
		CountPrice();
	});
	$(".reduce").click(function(){
		Reduce();
		CountPrice();
	});
	$(".num_txt").change(function(){
		if($(this).val() == 0){$(this).val(1);}
		CountPrice();						  
	});
	
})
function CountPrice(){
	var product_Id = $(".sku_number").text();
	product_Id = String(product_Id.replace(/^\D+/,""));
	var quantity = Number($("#product_quantity").val());
	$.get("/price/query", 'productId=' + product_Id + '&quantity=' + quantity, function (data) {
	    $("#product_quantity").html(data.quantity);
	    $("#allPrice").html(data.price);
	});	
}
function Add(){
    var quantity = Number($("#product_quantity").val());
	quantity = quantity + 1;
	if(quantity>1){$(".reduce").removeClass("un");}
	$("#product_quantity").val(quantity);
}
function Reduce(){
	var quantity = Number($("#product_quantity").val());
	quantity = quantity - 1;
	if(quantity > 1){
		$("#product_quantity").val(quantity);
	}else if(quantity = 1){
		$(".reduce").addClass("un");
		$("#product_quantity").val(quantity);
	}			
}
$(function () {
    $(".jqzoom").jqueryzoom({
        xzoom: 450, /*定义放大的窗口*/
        yzoom: 318,
        offset: 10,
        position: "right",
        preload: 1,
        lens: 1
    });
    $("#spec_list").jdMarquee({
        deriction: "left",
        width: 470,
        height: 70,
        step: 1,
        speed: 4,
        delay: 10,
        control: true,
        _front: "#spec_right",
        _back: "#spec_left"
    });
	
    $("#hpdeal_b1_c1 #spec_list img").bind("mouseover", function () {
        var src = $(this).attr("src");
        var jqimg = $(this).attr("jqimg");
        var jqimg2 = $(this).attr("jqimg2");
		
        $("#spec_n1 img").eq(0).attr({
            src: jqimg.replace("\/n5\/", "\/n1\/"),
            jqimg: jqimg2.replace("\/n5\/", "\/n0\/")
        });
        $(this).css({
            "border": "1px solid #ff6600",
            "padding": "0px"
        });
    }).bind("mouseout", function () {
        $(this).css({
            "border": "1px solid #d5d6db",
            "padding": "0px"
        });
    });
	
  $("#hpdeal_b1_c2 #spec_list img").bind("mouseover", function () {
        var src = $(this).attr("src");
        var jqimg = $(this).attr("jqimg");
        var jqimg2 = $(this).attr("jqimg2");
		
        $("#spec_n2 img").eq(0).attr({
            src: jqimg.replace("\/n5\/", "\/n1\/"),
            jqimg: jqimg2.replace("\/n5\/", "\/n0\/")
        });
        $(this).css({
            "border": "1px solid #ff6600",
            "padding": "0px"
        });
    }).bind("mouseout", function () {
        $(this).css({
            "border": "1px solid #d5d6db",
            "padding": "0px"
        });
    });
	
	    $("#hpdeal_b1_c3 #spec_list img").bind("mouseover", function () {
        var src = $(this).attr("src");
        var jqimg = $(this).attr("jqimg");
        var jqimg2 = $(this).attr("jqimg2");
		
        $("#spec_n3 img").eq(0).attr({
            src: jqimg.replace("\/n5\/", "\/n1\/"),
            jqimg: jqimg2.replace("\/n5\/", "\/n0\/")
        });
        $(this).css({
            "border": "1px solid #ff6600",
            "padding": "0px"
        });
    }).bind("mouseout", function () {
        $(this).css({
            "border": "1px solid #d5d6db",
            "padding": "0px"
        });
    });
	
	    $("#hpdeal_b1_c4 #spec_list img").bind("mouseover", function () {
        var src = $(this).attr("src");
        var jqimg = $(this).attr("jqimg");
        var jqimg2 = $(this).attr("jqimg2");
		
        $("#spec_n4 img").eq(0).attr({
            src: jqimg.replace("\/n5\/", "\/n1\/"),
            jqimg: jqimg2.replace("\/n5\/", "\/n0\/")
        });
        $(this).css({
            "border": "1px solid #ff6600",
            "padding": "0px"
        });
    }).bind("mouseout", function () {
        $(this).css({
            "border": "1px solid #d5d6db",
            "padding": "0px"
        });
    });
	
})

var BvGlobalCounter = function() {};
BvGlobalCounter.value = 0;

function bvGetMouseX(e) {
	var tempX;
	if (document.all) {
	tempX = e.clientX + document.body.scrollLeft;
	} else {
	tempX = e.pageX;
	}
	
	if (tempX < 0){
	tempX = 0;
	}
	return tempX;
}

function BvRatingBar(ratedItem){
	
	var _prepend = ratedItem;	
	var _BGWidth = 15;	
	var _BGHeight = 14;	
	var _specificity = 1;	
	var _maxRating = 5;	
	var _minRating = 1;	
	
	var _ratingType = "Stars";
	var _ratingTypeSingular = "Star";
	
	var _sparkleImage = baseURL+"includes/templates/slucky/images/icon/sparkle.gif";
	var _rating;
	
	var _displayItemOverride = "score_title";
	var _inputItemOverride = "product_score";
	
	
	var _isMouseDown = false;
	
	var _hasValueSet = false;
	
	
	this.initializeValue = function (givenValue) {
		_hasValueSet = true;
		var ratingValue = (Math.ceil(givenValue/_specificity)* 100 *_specificity)/100;
		if(ratingValue > _maxRating){
		ratingValue = _maxRating;
		} else if(ratingValue < _minRating){
		ratingValue = _minRating;
		}
		_rating = ratingValue;
		var tableWidth = ratingValue * _BGWidth;
		window.$get(ratedItem + "Filled").style.width = tableWidth + "px";
		//change the input value
		if(_inputItemOverride){
			var inputItemOverrideElement = $get(_inputItemOverride);
			if( inputItemOverrideElement) {
			inputItemOverrideElement.value = _rating;
			}
		}
		//display the value of show text
		if(_displayItemOverride){
		if($get(_displayItemOverride)){
			if (_rating == 1){
			$get(_displayItemOverride).innerHTML = _rating + " " + _ratingTypeSingular;
			} else {
			$get(_displayItemOverride).innerHTML = _rating + " " + _ratingType;
			}
		}
		}
	};
	

	this.resizeTable = function (event, table) {
		var ratingBarElement = $get(_prepend + 'RatingBar');
		var tableWidth = ratingBarElement.style.width;
		
		var scaleAmt = bvGetMouseX(event) - bvFindPosX(ratingBarElement);		
		var ratingValue = (Math.ceil(scaleAmt/_BGWidth/_specificity) * 100 * _specificity)/100;
		
		if(ratingValue > _maxRating){
		ratingValue = _maxRating;
		} else if(ratingValue < _minRating){
		ratingValue = _minRating;
		}
		
		tableWidth = ratingValue * _BGWidth;
		
		if(tableWidth < 1){
		tableWidth = 1;
		}
		
		$get(table).style.width = tableWidth + "px";
	
		
		_rating = ratingValue;
	};
	
	
	this.setRating = function (event) {
		this.updateRating(event, _prepend + 'Filled');
		_hasValueSet = true;
	};
	
	this.updateRating = function (event, table, ignoreInput) {
		this.resizeTable(event, table);
		if(!ignoreInput){
		if(_inputItemOverride){
			var inputItemOverrideElement = $get(_inputItemOverride);
			if(inputItemOverrideElement){
			inputItemOverrideElement.value = _rating;
			}
		}
		}
	
		if(_displayItemOverride){
		var displayItemOverrideElement = $get(_displayItemOverride);
		if( displayItemOverrideElement){
		if (_rating == 1){
		displayItemOverrideElement.innerHTML = _rating + " " + _ratingTypeSingular;
		} else {
		displayItemOverrideElement.innerHTML = _rating + " " + _ratingType;
		}
		}
		}
	};
	
	
	this.startSlide = function () {
		_isMouseDown = true;
	};
	
	
	this.stopSlide = function () {
		if(_isMouseDown){
			var backgroundPath = _sparkleImage + '?i=' + BvGlobalCounter.value++;
			$get(_prepend + 'Filled').style.background = "url(" + backgroundPath +")";
			_isMouseDown = false;
		}
	};
	
	
	this.doSlide = function (event) {
		if(_isMouseDown){
		this.updateRating(event, _prepend + "Filled");
		
		_hasValueSet = true;
		
		} else if(!_hasValueSet){
		this.updateRating(event, _prepend + "Hover", true);
		}
	};
	
	
	this.resetHover = function () {
		
		$get(_prepend + "Hover").style.width = '1px';
	
		if(!_hasValueSet){
		if(_displayItemOverride){
		var displayItemOverrideElement = $get(_displayItemOverride);
		if(displayItemOverrideElement){
		displayItemOverrideElement.innerHTML = "";
		}
		} 
		}
	}
}
function bvFindPosX(obj){
var curleft = 0;
if (obj.offsetParent){
while (obj){
curleft += obj.offsetLeft;
obj = obj.offsetParent;
}
} else if (obj.x) {
curleft += obj.x;
}
return curleft;
}
