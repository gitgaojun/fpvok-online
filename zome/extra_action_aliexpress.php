<?php
require_once('zome_configure.php');
try
{

	if($can_continue)
	{
		
		//获取当前默认语言
		$sql_lang = "SELECT A.`configuration_value`,B.`languages_id`\n"
	    . "FROM `configuration` A \n"
	    . "LEFT JOIN `languages` B ON B.`code` = A.`configuration_value`\n"
	    . "WHERE A.`configuration_key` = \"DEFAULT_LANGUAGE\"";
	    $result_lang=mysql_query($sql_lang,$conntion) or die("0=mysql query fail! error is:".mysql_error()); 
		$lang_row=mysql_fetch_array($result_lang);
		//print_r($lang_row);
		
		//默认网店语言ID
		$_current_language_id = $lang_row['languages_id'];
	    
		//获取目录
		$category_status = 1;
		$sql_menu = "SELECT A.`categories_id`,A.`categories_image`,A.`parent_id`,A.`sort_order`,A.`date_added`,A.`last_modified`,A.`categories_status`,B.`language_id`,B.`categories_name`,B.`categories_description`\n"
		    . "FROM `categories` AS A \n"
		    . "LEFT JOIN `categories_description` AS B ON A.`categories_id` = B.`categories_id`\n"
		    . "WHERE 1=1 AND A.`categories_status` = ".$category_status." AND B.`language_id` = ".$_current_language_id;
		    
		$result_product_category=mysql_query($sql_menu,$conntion) or die("0=mysql query fail! error is:".mysql_error()); 
		
		$category_arr =  array();
		while($row=mysql_fetch_array($result_product_category)){
			$category_arr[] = $row;
		}
		
		//print_r($category_arr);
		
		
		if($requestKind == "0")
		{
			
			$ali_url = str_replace("https://", "http://", $_REQUEST['searchUrl']);
			//初始化
		    $curl = curl_init();
		    //设置抓取的url
		    curl_setopt($curl, CURLOPT_URL, $ali_url);
		     //模拟火狐浏览器头部
    		curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0');
		    //设置头文件的信息作为数据流输出
		    curl_setopt($curl, CURLOPT_HEADER, 1);
		    //设置获取的信息以文件流的形式返回，而不是直接输出。
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		    //执行命令
		    $pageCont = curl_exec($curl);
		    //关闭URL请求
		    curl_close($curl);
		    //显示获得的数据
		    //print_r($pageCont);
		    
		    $dataArr = array();;
		    
		    //产品名称匹配
			if(preg_match("/<h1[^>]+>(.+)<\/h1>/i", $pageCont, $matches)) {
			   //print_r($matches);
			   $dataArr["pdName"] = trim($matches[1]);
			}		    
		    
			//产品货币匹配
			if(preg_match("/window.runParams.currencyCode=\"(\\w+)\"/i", $pageCont, $matches)) {
			   //print_r($matches);
			   $dataArr["pdCurrency"] = trim($matches[1]);
			}		    
			
			//产品原始价格匹配
			if(preg_match("/<[^>]*id=\"j-sku-price\"[^>]*?>([^<]+)<\/[^>]*?>/i", $pageCont, $matches)) {
			   //print_r($matches);
			   $dataArr["pdPrice"] = str_replace(",", "", trim($matches[1]));
			}else if(preg_match("/<[^>]*id=\"j-sku-price\"[^>]*?><[^>]*?>([^<]+)<\/[^>]*?>/i", $pageCont, $matches)) {
				$dataArr["pdPrice"] = str_replace(",", "", trim($matches[1]));
			}		
			
			//产品折扣价格匹配
			if(preg_match("/<[^>]*?id=\"j-sku-discount-price\"[^>]*?>([\d\.]+)<\/span>/i", $pageCont, $matches)) {
			   print_r($matches);
			   $dataArr["pdDiscountPrice"] = str_replace(",", "", trim($matches[1]));
			}	
			
			
			//产品图片匹配
			if(preg_match("/window\\.runParams\\.imageBigViewURL=\\[([^\\[]*)\\]/i", $pageCont, $matches)) {
			   //print_r($matches);
			   $tempStr = str_replace('"', "", trim($matches[1]));
			   $dataArr["pdImages"] = explode(",", $tempStr);
			}	
			
			
			//================产品详情匹配
			//获取产品url id
			if(preg_match("/window.runParams.productId=\"(\d+)\"/i", $pageCont, $matches)) {
			   //print_r($matches);
			   $aliProductId = trim($matches[1]);
			   
			   $fetchDetailUrl = "http://www.aliexpress.com/getDescModuleAjax.htm?productId=".$aliProductId;
			   
			   $detialHtml = file_get_contents($fetchDetailUrl);
			   
			   if(preg_match("/window.productDescription='([^']+)'/i", $detialHtml, $mts)) {			   	
			   		$dataArr["pdDetail"] = $mts[1];
			   }
			}	
			
			
			
			/**
			//产品详情匹配
			if(preg_match("/<[^>]*?id=\"j-product-desc\"[^>]*?>([\s\S]*?)<[^>]*?id=\"j-product-description\"[^>]*?>/i", $pageCont, $matches)) {
			   //print_r($matches);
			   $tempStr = trim($matches[1]);
			   $dataArr["pdDetail"] = $tempStr;
			}	
			
			*/

			
		    
		}else if($requestKind == "1")
		{
			//产品数据上传
			//print_r($_POST);
			
			if(!isset($_POST['categoryId']) || !isset($_POST['pdName']) || !isset($_POST['pdPrice']) 
				|| !isset($_POST['pdDiscountPrice']) || !isset($_POST['pdImages']) || !isset($_POST['pdDetail'])
			) {
				echo "产品参数不齐全！";
			}
			
			//图片数组
			$pdImageArr = array();
			foreach($_POST['pdImages'] as $key=>$val) {
				if("on" == $val) {
					$pdImageArr[] = $key;
				}
			}
			
			//print_r($pdImageArr);
			
			
			//导出参数
			$pdModel 			= 'ALI-'.time();
			$pdMainImage_url	= isset($pdImageArr[0])?base64_decode($pdImageArr[0]):"";
			$aliImageDir		= "l/";
			$pdMainImage_src	= $aliImageDir.$pdModel.'.'.substr(strrchr($pdMainImage_url, '.'), 1);
			
			//==
			$categoryId			= is_numeric(trim($_POST['categoryId']))?trim($_POST['categoryId']):"0";
			$pdPrice 			= is_numeric(trim($_POST['pdPrice']))?trim($_POST['pdPrice']):"0.00";
			$pdDiscountPrice 	= is_numeric(trim($_POST['pdDiscountPrice']))?trim($_POST['pdDiscountPrice']):"";
			$pdDetail			= str_replace("'", "\'", str_replace('"', '\"', trim($_POST['pdDetail'])));
			$pdName				= str_replace("'", "\'", str_replace('"', '\"', trim($_POST['pdName'])));
			
			$sql_insertPd = "INSERT INTO `products` (`products_id`, `products_type`, `products_quantity`, `products_model`, `products_image`, `products_price`, `products_virtual`, `products_date_added`, `products_last_modified`, `products_date_available`, `products_weight`, `products_status`, `products_tax_class_id`, `manufacturers_id`, `products_ordered`, `products_quantity_order_min`, `products_quantity_order_units`, `products_priced_by_attribute`, `product_is_free`, `product_is_call`, `products_quantity_mixed`, `product_is_always_free_shipping`, `products_qty_box_status`, `products_quantity_order_max`, `products_sort_order`, `products_discount_type`, `products_discount_type_from`, `products_price_sorter`, `master_categories_id`, `products_mixed_discount_quantity`, `metatags_title_status`, `metatags_products_name_status`, `metatags_model_status`, `metatags_price_status`, `metatags_title_tagline_status`) VALUES ".
							"(NULL, 1, 9999, '".$pdModel."', '".$pdMainImage_src."', '".$pdPrice."', '0', current_timestamp(), '', NULL, '30', '1', '1', '1', '1', '1', '1', '0', '0', '0', '0', '0', '1', '0', '0', '0', '0', '".$pdPrice."', '".$categoryId."', '1', '0', '0', '0', '0', '0');";
			
			
			$result_insert_product = mysql_query($sql_insertPd,$conntion) or die("0=mysql query fail! error is:".mysql_error()); 
			
			//获取产品ID
			$last_insert_id = mysql_insert_id($conntion);
			
			if($last_insert_id) {			
				$sql_insertPdDescription = "INSERT INTO `products_description` (`products_id`, `language_id`, `products_name`, `products_description`, `products_url`, `products_viewed`) VALUES ".
								"(".$last_insert_id.", '".$_current_language_id."', '".$pdName."', '".$pdDetail."', NULL, '0');";
				mysql_query($sql_insertPdDescription,$conntion) or die("0=mysql query fail! error is:".mysql_error()); ;
				
				
				$sql_insertPdToCategory = "INSERT INTO `products_to_categories` (`products_id`, `categories_id`) VALUES ".
								"('".$last_insert_id."', '".$categoryId."');";
				mysql_query($sql_insertPdToCategory,$conntion) or die("0=mysql query fail! error is:".mysql_error()); ;
				
				//如果有折扣价
				if("" != $pdDiscountPrice) {
					$sql_insertSpecial = "INSERT INTO `specials` (`specials_id`, `products_id`, `specials_new_products_price`, `specials_date_added`, `specials_last_modified`, `expires_date`, `date_status_change`, `status`, `specials_date_available`) VALUES ".
									"(NULL, '".$last_insert_id."', '".$pdDiscountPrice."', NULL, NULL, '0001-01-01', NULL, '1', '0001-01-01');";
					mysql_query($sql_insertSpecial,$conntion) or die("0=mysql query fail! error is:".mysql_error()); ;
				}
				
				
				//上传图片
				
				for($i=0; $i<count($pdImageArr);$i++) {
					if(0 == $i) {
						//上传主图
						$imgPath = "../images/".$pdMainImage_src;
						file_put_contents($imgPath, file_get_contents(str_replace("https://", "http://", $pdMainImage_url)));
						continue;
					}
					
					$imgPath 		= "../images/".$aliImageDir.$pdModel.'_'.$i.'.'.substr(strrchr($pdMainImage_url, '.'), 1);
					$pdSubImage_url	= base64_decode($pdImageArr[$i]);
					file_put_contents($imgPath, file_get_contents(str_replace("https://", "http://", $pdSubImage_url)));
				}
				
				
				
				
				$upload_product_link = 'http://'.$_SERVER['HTTP_HOST'].'/index.php?main_page=product_info&products_id='.$last_insert_id;
				echo '<strong style="color:green;">upload success!!</strong>'.
					'<br /><br />Product link:  <a target="_blank" href="'.$upload_product_link.'">'.$upload_product_link.'</a>';
			}else {
				echo '<strong style="color:red;">upload fail!!</strong>';	
			}
			
			echo '<br /><br /><a href="'.'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'">&lt;&lt;Back</a>';
			
			exit;
			
			


		}

	}
}
catch(Exception $e)
{
	echo $e->getMessage();
}
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layui</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="./res/layui/build/css/layui.css"  media="all">
  <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>

<blockquote class="layui-elem-quote" style="border-left:none;">

</blockquote>
<form class="layui-form" action="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>">
	<!--  <input type="hidden" name="authKey" value="<?php echo md5($authKey);?>" /> -->
	<input type="hidden" name="requestKind" value="0" />
	  <div class="layui-form-item">
	  <label class="layui-form-label">速卖通网址</label>
      	
	    <div class="layui-input-inline" style="width:500px;">
	      <input value="<?php echo isset($_REQUEST["searchUrl"])?$_REQUEST["searchUrl"]:"";?>" type="text" name="searchUrl" lay-verify="required|url" autocomplete="off" placeholder="请输入速卖通产品页网址" class="layui-input">
	    </div>
	    <span><button class="layui-btn" lay-submit="" lay-filter="fetchSubmit">立即获取</button></span>
	  </div>	
</form>
          
<br />
     
     
     
<?php if(isset($dataArr) && count($dataArr)>0) {?>              
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend>产品信息确认框</legend>
</fieldset>
 
<form class="layui-form" method="post" action="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>">
	<input type="hidden" name="requestKind" value="1" />
	<div class="layui-form-item">
	  	<label class="layui-form-label">上传至目录</label>
		<div class="layui-input-inline">
	        <select name="categoryId" lay-verify="required" lay-search="">
	          <option value="">直接选择或搜索选择</option>
	          <?php 
	          	for($i=0;$i<count($category_arr);$i++) {
	          ?>
	          	<option value="<?php echo $category_arr[$i]['categories_id'];?>"><?php echo $category_arr[$i]['categories_name'];?></option>
			  <?php 
	          	}
			  ?>
	        </select>
      	</div>    
	</div>
	
  <div class="layui-form-item">
    <label class="layui-form-label">产品名称</label>
    <div class="layui-input-block">
      <input value="<?php echo $dataArr["pdName"]?>" type="text" name="pdName" lay-verify="required|pdName" autocomplete="off" placeholder="请输入产品名称" class="layui-input">
    </div>
  </div>

  
  
  <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">原价</label>
      <div class="layui-input-inline">
        <input value="<?php echo $dataArr["pdPrice"]?>" type="text" name="pdPrice" lay-verify="required|price" autocomplete="off" class="layui-input">
      </div>
    </div>

    <div class="layui-inline">
      <label class="layui-form-label">特价 </label>
      <div class="layui-input-inline">
        <input value="<?php echo isset($dataArr["pdDiscountPrice"])?$dataArr["pdDiscountPrice"]:""; ?>" type="text" name="pdDiscountPrice" lay-verify="discountPrice" autocomplete="off" class="layui-input">
      </div>
    </div>
 
 
	<div class="layui-form-item" pane="">
    	<label class="layui-form-label">产品图片</label>
	    <div class="layui-input-block">				  
			  <?php for($i=0;$i<count($dataArr["pdImages"]);$i++) {
			  		$img_base64 = base64_encode(trim($dataArr["pdImages"][$i]));
			  		$name = "pdImages[".$img_base64."]";
			  	?>
			  		<span>
				  		<img  style="width:80px;height:auto;" src="<?php echo trim($dataArr["pdImages"][$i]);?>" />
				  		<span>
				  			<input type="checkbox" name="<?php echo $name;?>" lay-skin="primary" checked="">
				  		</span>
				  	</span>
			  <?php }?>
	    </div>
  	</div>


  
<textarea id="L_content" name="content" required="" lay-verify="required" placeholder="我要留言" style="height: 150px;" class="layui-textarea fly-editor"></textarea>

  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">产品描述</label>
    <div class="layui-input-block">
      <textarea class="layui-textarea layui-hide" name="pdDetail" lay-verify="content" id="LAY_demo_editor">
      	<?php echo isset($dataArr["pdDetail"])?$dataArr["pdDetail"]:""; ?>
      </textarea>
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit="" lay-filter="">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
</form>

<?php 
}
?>

          
<script src="./res/layui/build/layui.js" charset="utf-8"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
layui.use(['form', 'layedit', 'laydate'], function(){
  var form = layui.form()
  ,layer = layui.layer
  ,layedit = layui.layedit
  ,laydate = layui.laydate;
  
  //创建一个编辑器
  var editIndex = layedit.build('LAY_demo_editor');
 
  //自定义验证规则
  form.verify({
    pdName: function(value){
      if(value.length < 5){
        return '产品名至少得5个字符啊';
      }
    }
    ,price: [/[\d]+?\.??[\d]*?$/, '价格的格式不正确']
    ,content: function(value){
      layedit.sync(editIndex);
    }
  });
  
  //监听指定开关
  form.on('switch(switchTest)', function(data){
    layer.msg('产品立即上架：'+ (this.checked ? 'true' : 'false'), {
      offset: '6px'
    });
    //layer.tips('温馨提示：请注意开关状态的文字可以随意定义，而不仅仅是ON|OFF', data.othis)
  });
  




  //监听提交
  form.on('submit(productSubmit)', function(data){
    layer.alert(JSON.stringify(data.field), {
      title: '最终的提交信息'
    })
    return false;
  });
  
  
});
</script>

</body>
</html>
































