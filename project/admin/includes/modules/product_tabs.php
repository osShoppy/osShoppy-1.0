<?php //catalog/admin/includes/modules/product_tabs.php (2610) ?>

<html>
<head>
	<style type="text/css">
		@import "scr.css";
	</style>

	<script type="text/javascript" src="domtab.js">
	</script>
	<script type="text/javascript">
		document.write('<style type="text/css">');    
		document.write('div.domtab div{display: ;}<');
		document.write('/s'+'tyle>');    
    </script>
</head>	
<table cellpadding="0" cellspacing="0" width="100%" style="BORDER:none;background:none;">
      <tr>
        <td>
<div <?php echo"id=\"mainnavtabbed".$i."\"";?> class="domtab">
  <ul class="domtabs">
     <li><a href="#t1<?=$i?>"><?PHP ECHO TEXT_TAB_DESCRIPTION;?></a></li>
    <li><a href="#t2<?=$i?>"><?PHP ECHO TEXT_TAB_SPEC;?></a></li>
    <li><a href="#t3<?=$i?>"><?PHP ECHO TEXT_TAB_MUSTHAVE;?></a></li>
    <li><a href="#t4<?=$i?>"><?PHP ECHO TEXT_TAB_EXTRAIMAGE;?></a></li>
    <li><a href="#t5<?=$i?>"><?PHP ECHO TEXT_TAB_MANUAL;?></a></li>
	<li><a href="#t6<?=$i?>"><?PHP ECHO TEXT_TAB_EXTRA1;?></a></li>
	<li><a href="#t7<?=$i?>"><?PHP ECHO TEXT_TAB_MOREINFO;?></a></li>
    <li><a href="#t8<?=$i?>"><?PHP ECHO TEXT_TAB_PAGE_TITLE;?></a></li>
	<li><a href="#t9<?=$i?>"><?PHP ECHO TEXT_TAB_HEADER_DESCRIPTION;?></a></li>
	<li><a href="#t10<?=$i?>"><?PHP ECHO TEXT_TAB_PRODUCTS_KEYWORDS;?></a></li>
  </ul>

   <div class="tabcontent">
    <a name="t1<?=$i?>" id="t1<?=$i?>"></a>
		 <table>
          <td class="main"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;&nbsp;
		  <?php  echo TEXT_PRODUCTS_DESCRIPTION; ?>
		 </td>
		</table>
		<table border="0" cellspacing="0" cellpadding="1" width="100%">
              <tr align="center">
                <td class="main"><?php if(HTML_AREA_WYSIWYG_PRODUCTS_DESCRIPTION_DISABLE == 'Enable') {
      echo tep_draw_fckeditor ('products_description[' . $languages[$i]['id'] . ']', HTML_PRODUCTS_DESCRIPTION_AREA_WYSIWYG_WIDTH, HTML_PRODUCTS_DESCRIPTION_AREA_WYSIWYG_HEIGHT, (isset($products_description[$languages[$i]['id']]) ? stripslashes($products_description[$languages[$i]['id']]) : tep_get_products_description($pInfo->products_id, $languages[$i]['id']))) . '</td>';
    } else {
//    echo tep_draw_textarea_field('products_description[' . $languages[$i]['id'].']','soft','70','15',(isset($products_description[$languages[$i]['id']]) ? stripslashes($products_description[$languages[$i]['id']]) : tep_get_products_description($pInfo->products_id, $languages[$i]['id']))) . '</td>';
	  echo tep_draw_textarea_field('products_description[' . $languages[$i]['id'] . ']', 'soft', '145', '15', (isset($products_description[$languages[$i]['id']]) ? $products_description[$languages[$i]['id']] : tep_get_products_description($pInfo->products_id, $languages[$i]['id'])));
    }
?>
               </td>
              </tr>
     		 </table>
   <a href="#top"></a>
  </div>
 
  <div class="tabcontent">
    <a name="t2<?=$i?>" id="t2<?=$i?>"></a>
		 <table>
          <td class="main"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;&nbsp;
		  <?php  echo TEXT_PRODUCTS_SPEC; ?>
		 </td>
		</table>
		<table border="0" cellspacing="0" cellpadding="1" width="100%">
              <tr align="left">
                <td class="main"><?php if(HTML_AREA_WYSIWYG_PRODUCTS_DESCRIPTION_SPEC == 'Enable') {
      echo tep_draw_fckeditor ('products_spec[' . $languages[$i]['id'] . ']', HTML_PRODUCTS_DESCRIPTION_SPEC_AREA_WYSIWYG_WIDTH, HTML_PRODUCTS_DESCRIPTION_SPEC_AREA_WYSIWYG_HEIGHT, (isset($products_spec[$languages[$i]['id']]) ? stripslashes($products_spec[$languages[$i]['id']]) : tep_get_products_spec($pInfo->products_id, $languages[$i]['id']))) . '</td>';
    } else {
      echo tep_draw_textarea_field('products_spec[' . $languages[$i]['id'] . ']', 'soft', '145', '15', (isset($products_spec[$languages[$i]['id']]) ? $products_spec[$languages[$i]['id']] : tep_get_products_spec($pInfo->products_id, $languages[$i]['id']))); 
	}
?>
               </td>
              </tr>
    		 </table>
   <a href="#top"></a>
</div>
  
  <div class="tabcontent">
   <a name="t3<?=$i?>" id="t3<?=$i?>"></a>
		 <table>
          <td class="main"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;&nbsp;
		  <?php  echo TEXT_PRODUCTS_MUSTHAVE; ?>
		 </td>
		</table>
		<table border="0" cellspacing="0" cellpadding="1" width="100%">
              <tr align="center">
                <td class="main"><?php if(HTML_AREA_WYSIWYG_PRODUCTS_DESCRIPTION_MUSTHAVE == 'Enable') {
      echo tep_draw_fckeditor ('products_musthave[' . $languages[$i]['id'] . ']', HTML_PRODUCTS_DESCRIPTION_MUSTHAVE_AREA_WYSIWYG_WIDTH, HTML_PRODUCTS_DESCRIPTION_MUSTHAVE_AREA_WYSIWYG_HEIGHT, (isset($products_musthave[$languages[$i]['id']]) ? stripslashes($products_musthave[$languages[$i]['id']]) : tep_get_products_musthave($pInfo->products_id, $languages[$i]['id']))) . '</td>';
    } else {
      echo tep_draw_textarea_field('products_musthave[' . $languages[$i]['id'] . ']', 'soft', '145', '15', (isset($products_musthave[$languages[$i]['id']]) ? $products_musthave[$languages[$i]['id']] : tep_get_products_musthave($pInfo->products_id, $languages[$i]['id'])));
	}
?>
               </td>
              </tr>
    		 </table>
	<a href="#top"></a>
  </div>
  
    <div class="tabcontent">
   <a name="t4<?=$i?>" id="t4<?=$i?>"></a>
		 <table>
          <td class="main"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;&nbsp;
		  <?php  echo TEXT_PRODUCTS_EXTRAIMAGE; ?>
		 </td>
		</table>
		<table border="0" cellspacing="0" cellpadding="1" width="100%">
              <tr align="center">
                <td class="main"><?php if(HTML_AREA_WYSIWYG_PRODUCTS_DESCRIPTION_EXTRAIMAGE == 'Enable') {
      echo tep_draw_fckeditor ('products_extraimage[' . $languages[$i]['id'] . ']', HTML_PRODUCTS_DESCRIPTION_EXTRAIMAGE_AREA_WYSIWYG_WIDTH, HTML_PRODUCTS_DESCRIPTION_EXTRAIMAGE_AREA_WYSIWYG_HEIGHT, (isset($products_extraimage[$languages[$i]['id']]) ? stripslashes($products_extraimage[$languages[$i]['id']]) : tep_get_products_extraimage($pInfo->products_id, $languages[$i]['id']))) . '</td>';
    } else {
      echo tep_draw_textarea_field('products_extraimage[' . $languages[$i]['id'] . ']', 'soft', '145', '15', (isset($products_extraimage[$languages[$i]['id']]) ? $products_extraimage[$languages[$i]['id']] : tep_get_products_extraimage($pInfo->products_id, $languages[$i]['id'])));
	  	}
?>
               </td>
              </tr>
    		 </table>
	<a href="#top"></a>
  </div>
  
  <div class="tabcontent">
   <a name="t5<?=$i?>" id="t5<?=$i?>"></a>
		 <table>
          <td class="main"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;&nbsp;
		  <?php  echo TEXT_PRODUCTS_MANUAL; ?>
		 </td>
		</table>
		<table border="0" cellspacing="0" cellpadding="1" width="100%">
              <tr align="center">
                <td class="main" ><?php if(HTML_AREA_WYSIWYG_PRODUCTS_DESCRIPTION_MANUAL == 'Enable') {
      echo tep_draw_fckeditor ('products_manual[' . $languages[$i]['id'] . ']', HTML_PRODUCTS_DESCRIPTION_MANUAL_AREA_WYSIWYG_WIDTH, HTML_PRODUCTS_DESCRIPTION_MANUAL_AREA_WYSIWYG_HEIGHT, (isset($products_manual[$languages[$i]['id']]) ? stripslashes($products_manual[$languages[$i]['id']]) : tep_get_products_manual($pInfo->products_id, $languages[$i]['id']))) . '</td>';
    } else {
      echo tep_draw_textarea_field('products_manual[' . $languages[$i]['id'] . ']', 'soft', '145', '15', (isset($products_manual[$languages[$i]['id']]) ? $products_manual[$languages[$i]['id']] : tep_get_products_manual($pInfo->products_id, $languages[$i]['id'])));
    }
?>
               </td>
              </tr>
    		 </table>
	<a href="#top"></a>
  </div>
  
     <div class="tabcontent">
    <a name="t6<?=$i?>" id="t6<?=$i?>"></a>
		 <table>
          <td class="main"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;&nbsp;
		  <?php  echo TEXT_PRODUCTS_EXTRA1; ?>
		 </td>
		</table>
		<table border="0" cellspacing="0" cellpadding="1" width="100%">
              <tr align="center">
                <td class="main"><?php if(HTML_AREA_WYSIWYG_PRODUCTS_DESCRIPTION_EXTRA == 'Enable') {
      echo tep_draw_fckeditor ('products_extra1[' . $languages[$i]['id'] . ']', HTML_PRODUCTS_DESCRIPTION_EXTRA_AREA_WYSIWYG_WIDTH, HTML_PRODUCTS_DESCRIPTION_EXTRA_AREA_WYSIWYG_HEIGHT, (isset($products_extra1[$languages[$i]['id']]) ? stripslashes($products_extra1[$languages[$i]['id']]) : tep_get_products_extra1($pInfo->products_id, $languages[$i]['id']))) . '</td>';
    } else {
      echo tep_draw_textarea_field('products_extra1[' . $languages[$i]['id'] . ']', 'soft', '145', '15', (isset($products_extra1[$languages[$i]['id']]) ? $products_extra1[$languages[$i]['id']] : tep_get_products_extra1($pInfo->products_id, $languages[$i]['id'])));
	  	}
?>
               </td>
              </tr>
             </table>
	<a href="#top"></a>
  </div>
   <div class="tabcontent">
    <a name="t7<?=$i?>" id="t7<?=$i?>"></a>
		 <table>
          <td class="main"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;&nbsp;
		  <?php  echo TEXT_PRODUCTS_MOREINFO; ?>
		 </td>
		</table>
			<table border="0" cellspacing="0" cellpadding="1" width="100%">
              <tr align="center">
                <td class="main"><?php if(HTML_AREA_WYSIWYG_PRODUCTS_DESCRIPTION_MOREINFO == 'Enable') {
      echo tep_draw_fckeditor ('products_moreinfo[' . $languages[$i]['id'] . ']', HTML_PRODUCTS_DESCRIPTION_MOREINFO_AREA_WYSIWYG_WIDTH, HTML_PRODUCTS_DESCRIPTION_MOREINFO_AREA_WYSIWYG_HEIGHT, (isset($products_moreinfo[$languages[$i]['id']]) ? stripslashes($products_moreinfo[$languages[$i]['id']]) : tep_get_products_moreinfo($pInfo->products_id, $languages[$i]['id']))) . '</td>';
    } else {
      echo tep_draw_textarea_field('products_moreinfo[' . $languages[$i]['id'] . ']', 'soft', '145', '15', (isset($products_moreinfo[$languages[$i]['id']]) ? $products_moreinfo[$languages[$i]['id']] : tep_get_products_moreinfo($pInfo->products_id, $languages[$i]['id'])));
	  	}
?>
               </td>
              </tr>
             </table>
	<a href="#top"></a>
  </div>
  <div class="tabcontent">
    <a name="t8<?=$i?>" id="t8<?=$i?>"></a>
		 <table>
          <td class="main"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;&nbsp;
		  <?php echo TEXT_PRODUCTS_PAGE_TITLE; ?><br>
		 </td>
		</table>
			<table border="0" cellspacing="0" cellpadding="1" width="100%">
              <tr align="center">
                <td valign="top" class="main"><?php echo tep_draw_textarea_field('products_head_title_tag[' . $languages[$i]['id'] . ']', 'soft', '145', '15', (isset($products_head_title_tag[$languages[$i]['id']]) ? stripslashes($products_head_title_tag[$languages[$i]['id']]) : tep_get_products_head_title_tag($pInfo->products_id, $languages[$i]['id']))); ?></td>
               </td>
              </tr>
             </table>
   <a href="#top"></a>
  </div>
  <div class="tabcontent">
    <a name="t9<?=$i?>" id="t9<?=$i?>"></a>
		<table>
          <td class="main"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;&nbsp;
		  <?php echo TEXT_PRODUCTS_HEADER_DESCRIPTION; ?><br>
		 </td>
		</table>
			<table border="0" cellspacing="0" cellpadding="1" width="100%">
              <tr align="center">
                <td valign="top" class="main"><?php echo tep_draw_textarea_field('products_head_desc_tag[' . $languages[$i]['id'] . ']', 'soft', '145', '15', (isset($products_head_desc_tag[$languages[$i]['id']]) ? stripslashes($products_head_desc_tag[$languages[$i]['id']]) : tep_get_products_head_desc_tag($pInfo->products_id, $languages[$i]['id']))); ?></td>
               </td>
              </tr>
             </table>
   <a href="#top"></a>
  </div>
  <div class="tabcontent">
    <a name="t10<?=$i?>" id="t10<?=$i?>"></a>
		<table>
          <td class="main"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;&nbsp;
		  <?php echo TEXT_PRODUCTS_KEYWORDS; ?><br>
		 </td>
		</table>
			<table border="0" cellspacing="0" cellpadding="1" width="100%">
              <tr align="center">
                <td valign="top" class="main"><?php echo tep_draw_textarea_field('products_head_keywords_tag[' . $languages[$i]['id'] . ']', 'soft', '145', '15', (isset($products_head_keywords_tag[$languages[$i]['id']]) ? stripslashes($products_head_keywords_tag[$languages[$i]['id']]) : tep_get_products_head_keywords_tag($pInfo->products_id, $languages[$i]['id']))); ?></td>
               </td>
              </tr>
             </table>
   <a href="#top"></a>
  </div>
</td></tr></table>
