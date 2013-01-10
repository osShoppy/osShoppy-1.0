<?php //$Id: /catalog/admin/includes/index/index_default.php (osS) ?>

<!-- index_body //-->
<br>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <table style="border: solid 6px; border-color:#e3e3e3" width="98%" align="center" border="1" cellpadding="2" cellspacing="2" bgcolor="#666666">
<!-- inner_table //-->
      <tr>
<!-- first_line //-->
	  	<?php if(DISPLAY_OSSHOPPY_LOGO_INDEX_PAGE == 'true') { ?>
        <td align="center" valign="top" width="20%"><img src="templates/<?php echo ADMIN_TEMPLATE?>/images/adm_pic.png" alt="Admin" width="100" height="100" hspace="10"></td>
	    <?php } ?>
        <td align="center" valign="top" width="30%">
        <?php
		  $my_account_query = tep_db_query ("select a.admin_id, a.admin_firstname, a.admin_lastname, a.admin_email_address, a.admin_created, a.admin_modified, a.admin_logdate, a.admin_lognum, g.admin_groups_name from " . TABLE_ADMIN . " a, " . TABLE_ADMIN_GROUPS . " g where a.admin_id= " . $login_id . " and g.admin_groups_id= " . $login_groups_id . "");
  		  $myAccount = tep_db_fetch_array($my_account_query);
		?>
                <span class="headerInfo"><?php echo WELCOME_BACK; ?> <?php echo $myAccount['admin_firstname'] . ' ' . $myAccount['admin_lastname']; ?></span><br>
                <span class="login"><?php echo TEXT_INFO_LOGDATE; ?><?php echo $myAccount['admin_logdate']; ?></span><br>
                <span class="login"><?php echo TEXT_INFO_GROUP; ?><?php echo $myAccount['admin_groups_name']; ?></span>
                <div class="text2"  style="padding:15px;"></div>
        </td>
        <td align="center" valign="top" width="48%">
        	 <?php if(DISPLAY_BEST_VIEWED_PRODUCTS_INDEX_PAGE == 'true') { ?>
              <table width="428" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="headerViewed"><table width="400" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                      <td class="headerViewedText"><?php echo HEADING_TITLE2; ?></td>
                      <td width="100" align="center"class="headerViewedText"><?php echo TABLE_HEADING_VIEWED2; ?></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td class="contentViewed"><table width="90%" border="0" align="center" cellpadding="4" cellspacing="0" class="text">
                    <?php
  						if (isset($HTTP_GET_VARS['page']) && ($HTTP_GET_VARS['page'] > 1)) $rows = $HTTP_GET_VARS['page'] * MAX_DISPLAY_SEARCH_RESULTS - MAX_DISPLAY_SEARCH_RESULTS;
  						  $rows = 0;
  						  $products_query_raw = "select p.products_id, pd.products_name, pd.products_viewed, l.name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_LANGUAGES . " l where p.products_id = pd.products_id and l.languages_id = pd.language_id order by pd.products_viewed DESC";
  						  $products_split = new splitPageResults($HTTP_GET_VARS['page'], 10, $products_query_raw, $products_query_numrows);
  						  $products_query = tep_db_query($products_query_raw);
  						while ($products = tep_db_fetch_array($products_query)) {
    					  $rows++;
					     if (strlen($rows) < 2) {
					      $rows = '0' . $rows;
					     }
					?>
                    <tr onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" onClick="document.location.href='<?php echo tep_href_link(FILENAME_CATEGORIES, 'action=new_product_preview&read=only&pID=' . $products['products_id'] . '&origin=' . FILENAME_STATS_PRODUCTS_VIEWED . '?page=' . $HTTP_GET_VARS['page'], 'NONSSL'); ?>'">
                      <td style="border-bottom:solid 1px; border-color:#e3e3e3;"  class="dataTableContent"><?php echo $rows; ?>.</td>
                      <td style="border-bottom:solid 1px; border-color: #e3e3e3;"  class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action=new_product_preview&read=only&pID=' . $products['products_id'] . '&origin=' . FILENAME_STATS_PRODUCTS_VIEWED . '?page=' . $HTTP_GET_VARS['page'], 'NONSSL') . '">' . $products['products_name'] . '</a> (' . $products['name'] . ')'; ?></td>
                      <td style="border-bottom:solid 1px; border-color:#e3e3e3;" class="dataTableContent" align="center"><?php echo $products['products_viewed']; ?>&nbsp;</td>
                    </tr>
                    <?php
  					    }
					?>
              		<tr>
                	  <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
              		</tr>
                  </table></td>
                </tr>
              </table></td>
			 <?php } ?>
        </td>
<!-- first_line_eof //-->
      </tr>
      <tr>
<!-- second_line //-->
        <td colspan="2">1</td>
        <td align="center">
        <?php if(DISPLAY_QUICK_CATALOG_LINKS_INDEX_PAGE == 'true') { ?>
          <hr style="color:#E3E3E3" width="428" align="center" size="1">
            <table width="428" border="0">
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_CATEGORIES) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_PRODUCT_ATTRIBUTES) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_GET_1_FREE) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_GET_1_FREE) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_2GETHER) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_2GETHER) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_GIFT_ADD) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_GIFT_ADD) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_OPTIONAL_RELATED_PRODUCTS) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_OPTIONAL_RELATED_PRODUCTS) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_SPECIALS) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_SPECIALS) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_FEATURED) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_FEATURED) . '</a>'; ?></td> 
            </table>
		<?php }
		if(DISPLAY_QUICK_CUSTOMERS_LINKS_INDEX_PAGE == 'true') { ?>
		  <hr style="color:#E3E3E3" width="428" align="center" size="1">
            <table width="428" border="0">
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_CUSTOMERS) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_CUSTOMERS) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_CREATE_ACCOUNT) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_CREATE_ACCOUNT) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_ORDERS) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_ORDERS) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_CREATE_ORDER) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_CREATE_ORDER) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_QUOTES) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_QUOTES) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '&nbsp;'; ?></td> 
            </table>
		<?php }
		if(DISPLAY_QUICK_TEMPLATE_LINKS_INDEX_PAGE == 'true') { ?>
		  <hr style="color:#E3E3E3" width="428" align="center" size="1">
            <table width="428" border="0">
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=30', 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_HEADER_FOOTER) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=34', 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_INDEX_DEFAULT) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=33', 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_PRODUCT_INFO) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=37', 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_INFOBOX_GENERAL) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=1', 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_INFOBOX_ON_OFF) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=39', 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_EDIT_IMAGES) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_BANNER_MANAGER) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_BANNER_MANAGER) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?></td> 
            </table>
		<?php }
		if(DISPLAY_QUICK_MODULE_MANAGER_LINKS_INDEX_PAGE == 'true') { ?>
		  <hr style="color:#E3E3E3" width="428" align="center" size="1">
            <table width="428" border="0">
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_HEADER_TAGS_SEO) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_headertags.png', INDEX_ICON_HEAD_TAGS) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_ARTICLES) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_newsflash.png', INDEX_ICON_ARTICLES) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_POLLS) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_polls.png', INDEX_ICON_ENQUETES) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_TESTIMONIALS_MANAGER) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_testimonial.png', INDEX_ICON_TESTIMONIALS) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_GALLERY) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_gallery.png', INDEX_ICON_GALLERY) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_LINKS) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_links.png', INDEX_ICON_LINKS) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_DOCUMENTS) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_DOCUMENTS) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_FAQ_MANAGER) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_FAQ_MANAGER) . '</a>'; ?></td> 
            </table>
		<?php }
		if(DISPLAY_QUICK_STOCK_LINKS_INDEX_PAGE == 'true') { ?>
		  <hr style="color:#E3E3E3" width="428" align="center" size="1">
            <table width="428" border="0">
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_STATS_STOCK_ACTIVE) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_inventaireactif.png', INDEX_ICON_ACTIF) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_STATS_STOCK_INACTIVE) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_inventaireinactif.png', INDEX_ICON_INACTIF) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_STATS_LOW_STOCK) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_lowstockattrib.png', INDEX_ICON_LOWSTOCK) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_STATS_LOW_STOCK_ATTRIB) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_lowstockattrib.png', INDEX_ICON_LOWSTOCK_ATTRIB) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_QTPRODOCTOR) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_QTPRODOC) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_UPDATES) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_productupdates.png', INDEX_ICON_PRODUCT_UPD) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_MULTI) . '">' . tep_image(DIR_WS_IMAGES . 'icons/index_icons/index_icon_backup.png', INDEX_ICON_PRODUCT_MULTI) . '</a>'; ?></td> 
		<td width="75" align="center" valign="bottom"><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?></td> 
            </table>
		  <hr style="color:#E3E3E3" width="428" align="center" size="1">
		<?php } ?>
		</td>
<!-- second_line_eof //-->
      </tr>
      <tr>
<!-- third_line //-->
        <td>1</td>
        <td>2</td>
        <td>2</td>
<!-- third_line_eof //-->
      </tr>
      <tr>
<!-- fourth_line //-->
        <td>1</td>
        <td>2</td>
        <td>2</td>
<!-- fourth_line_eof //-->
      </tr>
<!-- inner_table_eof //-->
    </table>
  </tr>
</table>
<!-- index_body_eof //-->
