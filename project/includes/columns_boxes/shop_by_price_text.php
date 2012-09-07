<?php // shop_by_price_text_column infobox 
if ((!strstr($_SERVER['PHP_SELF'],EX_SHT_1))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_2))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_3))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_4))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_5))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_6))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_7))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_8))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_9))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_10))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_11))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_12))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_13))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_14))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_15))
and(!strstr($_SERVER['PHP_SELF'],EX_SHT_16))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_17))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_18))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_19))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_20))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_21))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_22))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_23))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_24))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_25))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_26))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_27))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_28))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_29))and(!strstr($_SERVER['PHP_SELF'],EX_SHT_30))
){ ?>
<!-- shop by price //-->
<tr>
  <td>
<?php
require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_SHOP_BY_PRICE);

 $info_box_contents = array();
 $info_box_contents[] = array('text' => BOX_HEADING_SHOP_BY_PRICE);
 new infoBoxHeading($info_box_contents, false, false);

$info_box_contents = array();
	
	for ($range=0; $range<sizeof($price_ranges); $range++) {
		$info_box_contents[] = array('align' => 'left',
									 'text'  => '<a href="' . tep_href_link(FILENAME_SHOP_BY_PRICE, 'range=' . $range , 'NONSSL') . '">' . $price_ranges[$range] . '</a><br>');
	}				


 		new infoBox($info_box_contents);
  
?>
	</td>
</tr>
<!-- shop_by_price //-->
<?php } ?>