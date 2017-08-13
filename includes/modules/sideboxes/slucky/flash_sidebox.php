<LINK rel=stylesheet type=text/css href="/css/header.css">
<div class="rightside1">

<ul id="ul-auto_scroll">

<?php 

    $query = "SELECT banners_title,banners_url,banners_html_text,banners_image FROM banners WHERE banners_group ='Home_top_ads' and status =1 order by banners_sort_order asc limit 5";
   	$layout_boxes = $db->Execute($query);
	if($layout_boxes->RecordCount()>0){
	while (!$layout_boxes->EOF) {
		
	?>


    <li style="display: list-item;">

        <div class="bbaner">

            <a href="/<?php echo $layout_boxes->fields['banners_url']; ?>">

                <img border="0" src="/images/<?php echo $layout_boxes->fields['banners_image']; ?>" alt="<?php echo $layout_boxes->fields['banners_title']; ?>">

            </a>

        </div>

        <div class="bbaner1">
         <?php $aa = explode("#",$layout_boxes->fields['banners_html_text']);
		 
		    if(count($aa)>1){
		       
		 ?>
        <ul>
           <?php foreach($aa as $pro_id){ 
		   
		       $aa_products = "SELECT p.products_image,pd.products_name FROM products p,products_description pd WHERE p.products_id = pd.products_id and p.products_status =1 and p.products_id = ".(int)$pro_id;
   	           $pro_box = $db->Execute($aa_products);
		       if($pro_box->RecordCount()>0){
		        $url = zen_href_link(zen_get_info_page($pro_id), 'cPath=' . $productsInCategory[$pro_id] . '&products_id=' . (int)$pro_id);
				$speice_price = zen_get_products_special_price($pro_id);
				$base_price = zen_get_products_base_price($pro_id);
				$retail_price = zen_get_products_retail_price($pro_id);
				 $del_price = $speice_price>0?$base_price:$retail_price;
				 $fina_price = $speice_price>0?$speice_price:$base_price;
		   ?>
                <li>

                    <div class="b2tu">

                        <a href="<?php echo $url ?>">

                         <?php echo str_replace("/s/","/l/",zen_image(DIR_WS_IMAGES . $pro_box->fields['products_image'], SEO_COMMON_KEYWORDS . ' ' .$pro_box->fields['products_name'], 70, 70,'align="absmiddle"')) ?>
                        </a>

                    </div>

                    <div class="b2wen">

                        <p class="b2bt">

                            <a href="<?php echo $url; ?>"><?php echo $pro_box->fields['products_name']; ?></a>

                        </p>

                        <p class="bwas"> <span class="bizhong"><?php echo $currencies->display_price($del_price,0); ?></span></p>

						<p class="bpri"> <span class="bizhong"><?php echo $currencies->display_price($fina_price,0); ?></span></p>

                    </div>

                </li>

            <?php 
			   }}?>

            </ul>

          <?php }?>
        </div>

    </li>

<?php 
  $layout_boxes->MoveNext();
  }
	}?>
</ul>

<ul id="ul-auto_scroll_item">

   <?php 
   $i=1;
    $query1 = "SELECT banners_title FROM banners WHERE banners_group ='Home_top_ads' and status =1 order by banners_sort_order asc limit 5";
    $layout_boxes_1 = $db->Execute($query1);
	if($layout_boxes_1->RecordCount()>0){
	    while (!$layout_boxes_1->EOF) {
		$str_css =($i==1?'overpic':'');
		?>

    <li class="<?php echo $str_css; ?>"><?php echo $layout_boxes_1->fields['banners_title']; ?></li>

   <?php 
   $layout_boxes_1->MoveNext();
  }
	}?>
   
</ul>

</div>

<SCRIPT type=text/javascript src="http://cloud4.faout.com/imagecache/EV02/sysjs/index.js"></SCRIPT>