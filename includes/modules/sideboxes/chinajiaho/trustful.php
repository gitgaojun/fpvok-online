<div class="allborder margin_t g_t_c">
<div id="trustful"></div>
<div class="pad_10px g_t_l">
<?php 
$mt_descLinks = '';
if (META_TAG_DESCRIPTION!= '') {
	$mt_desc = trim(META_TAG_DESCRIPTION);
	$descArr = explode ( ',', $mt_desc );
	if (is_array ( $descArr )) {
		foreach ( $descArr as $descVal ) {
			if ($descVal != '') {
				$mt_descLinks .= '<a href="Wholesale/' . $descVal . '">' . $descVal. '</a>,';
			}
		}
		$mt_descLinks = substr ( $mt_descLinks, 0, - 1 );
	} else {
		$mt_descLinks .= '<a href="Wholesale/' . $mt_desc . '">' . $mt_desc. '</a>';
	}
}
echo $mt_descLinks; 
?>
</div>
</div>