<?php //$Id: /catalog/includes/classes/displayimages.php (osC)


  class displayimages {

    var $restrictsmimage = ADDIMAGES_RESTRICT_IMAGE_SIZE;  // true, false
    var $tablealignment = ADDIMAGES_TABLE_ALIGNMENT;   // right, center, left
    var $numberofcolumns = ADDIMAGES_NUMBER_OF_COLS;
    var $numberofrows = ADDIMAGES_NUMBER_OF_ROWS;
    var $groupwithparent = ADDIMAGES_GROUP_WITH_PARENT;  // true, false
    var $imagedefault = 'medium'; // original it's medium
    var $buildmenu = false;
    var $onpagemenu = false;
    var $linkurl = FILENAME_POPUP_ADD_IMAGE;

    var $addimages_count = 0;
    var $groupout = '';

    var $maximagewidth = 0;
    var $maximageheight = 0;


   /**
    ** constructor **/
    function displayimages ( $products_id ) {

      $this->imagedir = DIR_FS_CATALOG . DIR_WS_IMAGES;
      $product_query = tep_db_query("SELECT products_id, products_image, products_image_med, products_image_pop, products_image_description FROM " . TABLE_PRODUCTS . " WHERE products_id = '".(int)$products_id."'");
      $product = tep_db_fetch_array($product_query);
      tep_db_free_result($product_query);

      $images = array();
      $images_query = tep_db_query("select additional_images_id, images_description, thumb_images, medium_images, popup_images from " . TABLE_ADDITIONAL_IMAGES . " where products_id = '" . (int)$products_id . "'");
      while ($tmp_images = tep_db_fetch_array($images_query)) {
        $images[] = $tmp_images;
      }
      tep_db_free_result($images_query);
      
      // find the largest image width and height
      if (ADDIMAGES_MENU_LOCATION == 'product_info' && ENABLE_LIGHTBOX == 'true') { // doing on page rollovers and the lightbox.
        if (!empty($product['products_image_med']) || !empty($product['products_image'])) { list($this->maximagewidth, $this->maximageheight, $type) = @getimagesize($this->imagedir.(!empty($product['products_image_med'])?$product['products_image_med']:$product['products_image'])); }
        foreach ($images as $key => $image) {
          if (!empty($image['medium_images']) || !empty($image['thumb_images'])) { list($t_maximagewidth, $t_maximageheight, $type) = @getimagesize($this->imagedir.(!empty($image['medium_images'])?$image['medium_images']:$image['thumb_images'])); }
          if ($t_maximagewidth > $this->maximagewidth) { $this->maximagewidth = $t_maximagewidth; }
          if ($t_maximageheight > $this->maximageheight) { $this->maximageheight = $t_maximageheight; }
        }
      } else { // normal
        if (!empty($product['products_image_pop']) || !empty($product['products_image'])) { list($this->maximagewidth, $this->maximageheight, $type) = @getimagesize($this->imagedir.(!empty($product['products_image_pop'])?$product['products_image_pop']:$product['products_image'])); }
        foreach ($images as $key => $image) {
          if (!empty($image['popup_images']) || !empty($image['thumb_images'])) { list($t_maximagewidth, $t_maximageheight, $type) = @getimagesize($this->imagedir.(!empty($image['popup_images'])?$image['popup_images']:$image['thumb_images'])); }
          if ($t_maximagewidth > $this->maximagewidth) { $this->maximagewidth = $t_maximagewidth; }
          if ($t_maximageheight > $this->maximageheight) { $this->maximageheight = $t_maximageheight; }
        }
      }
      
      // determine image width to use
      $addimages_image_width = ($this->restrictsmimage=='true'?(($this->imagedefault=='medium')?DISPLAY_IMAGE_WIDTH:SMALL_IMAGE_WIDTH):'');
      $addimages_image_height = ($this->restrictsmimage=='true'?(($this->imagedefault=='medium')?DISPLAY_IMAGE_HEIGHT:SMALL_IMAGE_HEIGHT):'');

      $row = 1;
      $col = 1;

      // build composite array of products.
      $addimages_images = array();
      if (tep_not_null($product['products_image']) && $this->groupwithparent == 'true') { 
        if (tep_not_null($product['products_image_med']) && ($this->imagedefault == 'medium')) { $use_image = $product['products_image_med']; }
        elseif (tep_not_null($product['products_image']) && ($this->imagedefault == 'medium' || $this->imagedefault == 'small')) { $use_image = $product['products_image']; }
        $t_imagewidth = 0;
        $t_imageheight = 0;
        if (!empty($use_image)) { list($t_imagewidth, $t_imageheight, $type) = @getimagesize($this->imagedir.$use_image); }
        $t_medimagewidth = 0;
        $t_medimageheight = 0;
        if (!empty($product['products_image_med'])) { list($t_medimagewidth, $t_medimageheight, $type) = @getimagesize($this->imagedir.$product['products_image_med']); }
        $t_popimagewidth = 0;
        $t_popimageheight = 0;
        if (!empty($product['products_image_pop'])) { list($t_popimagewidth, $t_popimageheight, $type) = @getimagesize($this->imagedir.$product['products_image_pop']); }
        $addimages_images[] = array('id' => '', 'image' => $use_image, 'image_width' => $t_imagewidth, 'image_height' => $t_imageheight, 'medimage' => $product['products_image_med'], 'medimage_width' => $t_medimagewidth, 'medimage_height' => $t_medimageheight, 'popimage' => $product['products_image_pop'], 'popimage_width' => $t_popimagewidth, 'popimage_height' => $t_popimageheight, 'desc' => $product['products_image_description']); 
      }
      foreach ( $images as $key => $image ) {
        if (tep_not_null($image['medium_images']) && ($this->imagedefault == 'medium')) { $use_image = $image['medium_images']; }
        elseif (tep_not_null($image['thumb_images']) && ($this->imagedefault == 'medium' || $this->imagedefault == 'small')) { $use_image = $image['thumb_images']; }
        $t_imagewidth = 0;
        $t_imageheight = 0;
        if (!empty($use_image)) { list($t_imagewidth, $t_imageheight, $type) = @getimagesize($this->imagedir.$use_image); }
        $t_medimagewidth = 0;
        $t_medimageheight = 0;
        if (!empty($image['medium_images'])) { list($t_medimagewidth, $t_medimageheight, $type) = @getimagesize($this->imagedir.$image['medium_images']); }
        $t_popimagewidth = 0;
        $t_popimageheight = 0;
        if (!empty($image['popup_images'])) { list($t_popimagewidth, $t_popimageheight, $type) = @getimagesize($this->imagedir.$image['popup_images']); }
        $addimages_images[] = array('id' => $image['additional_images_id'], 'image' => $use_image, 'image_width' => $t_imagewidth, 'image_height' => $t_imageheight, 'medimage' => $image['medium_images'], 'medimage_width' => $t_medimagewidth, 'medimage_height' => $t_medimageheight, 'popimage' => $image['popup_images'], 'popimage_width' => $t_popimagewidth, 'popimage_height' => $t_popimageheight, 'desc' => $image['images_description']);
      }
      $this->addimages_count = sizeof($addimages_images);

      // start building output
      if (tep_not_null($product['products_image'])) { $this->groupout .= '<table border="0" cellspacing="0" cellpadding="4" align="'.$this->tablealignment.'" style="position: relative;">'."\n"; }

      for ( $item=0; $item<$this->addimages_count; $item++ ) {

        if ($row<($this->numberofrows+1)) {
          if ($col==1) {$this->groupout.='<tr>';}
          if (ADDIMAGES_MENU_LOCATION == 'product_info' && ENABLE_LIGHTBOX == 'true') { // doing on page rollovers and the lightbox.
            $t_menu_mouseover = (($this->buildmenu==true) ? ' onmouseover="showImage('.(!empty($addimages_images[$item]['medimage']) ? '\\\''.DIR_WS_IMAGES.$addimages_images[$item]['medimage'].'\\\', '.$addimages_images[$item]['medimage_width'].', '.$addimages_images[$item]['medimage_height'] : '\\\''.DIR_WS_IMAGES.$addimages_images[$item]['image'].'\\\', '.$addimages_images[$item]['image_width'].', '.$addimages_images[$item]['image_height']) . ', \\\''.addslashes(str_replace("'","\'",htmlspecialchars($addimages_images[$item]['desc']))).'\\\')"' : '' );
          } else { // normal
            $t_menu_mouseover = (($this->buildmenu==true) ? ' onmouseover="showImage('.(!empty($addimages_images[$item]['popimage']) ? '\\\''.DIR_WS_IMAGES.$addimages_images[$item]['popimage'].'\\\', '.$addimages_images[$item]['popimage_width'].', '.$addimages_images[$item]['popimage_height'] : '\\\''.DIR_WS_IMAGES.$addimages_images[$item]['image'].'\\\', '.$addimages_images[$item]['image_width'].', '.$addimages_images[$item]['image_height']) . ', \\\''.addslashes(str_replace("'","\'",htmlspecialchars($addimages_images[$item]['desc']))).'\\\')"' : '' );
          }

          // BOF lightbox addon
          if (ENABLE_LIGHTBOX == 'true') {
            $this->groupout .= ' 
              <td align="center" class="smallText"><script language="javascript"><!-- 
                document.write(\'<a href="images/' . $addimages_images[$item]['popimage'] . '"target="_blank" rel="lightbox[group]" title="' . addslashes(htmlspecialchars($addimages_images[$item]['desc'])) .'"' . $t_menu_mouseover . '>' . tep_image(DIR_WS_IMAGES . $addimages_images[$item]['image'], addslashes(htmlspecialchars($addimages_images[$item]['desc'])), (ADDIMAGES_RESTRICT_PARENT=='false'&&$item==0&&$this->groupwithparent=='true'?'':$addimages_image_width), (ADDIMAGES_RESTRICT_PARENT=='false'&&$item==0&&$this->groupwithparent=='true'?'':$addimages_image_height), 'hspace="5" vspace="5"') . '<br>' . (!empty($addimages_images[$item]['desc'])?addslashes($addimages_images[$item]['desc']):TEXT_CLICK_TO_ENLARGE). '</a>\');
                //--></script><noscript>
                  <a href="' . tep_href_link(DIR_WS_IMAGES . $addimages_images[$item]['popimage']) . '" target="_blank">' . tep_image(DIR_WS_IMAGES . $addimages_images[$item]['image'], $addimages_images[$item]['desc'], $addimages_image_width, $addimages_image_height, 'hspace="5" vspace="5"') . '<br>' . (!empty($addimages_images[$item]['desc'])?$addimages_images[$item]['desc']:TEXT_CLICK_TO_ENLARGE) . '</a>
                  </noscript></td>'."\n";
          } else { 
          // EOF lightbox addon
            $this->groupout .= '
              <td align="center" class="smallText"><script language="javascript"><!--
                document.write(\'<a href="' . (!$this->onpagemenu ? 'javascript:popupWindow(\\\'' : '') . tep_href_link( $this->linkurl, ($item==0&&$this->groupwithparent=='true'?'pID='.$products_id:'imagesID='.$addimages_images[$item]['id'])) . (!empty($_GET['products_id']) ? '&products_id='.$_GET['products_id'] : '') . (!empty($_GET['cPath']) ? '&cPath='.$_GET['cPath'] : '') . (!$this->onpagemenu ? '\\\')' : '') . '"' . $t_menu_mouseover . '>' . tep_image(DIR_WS_IMAGES . $addimages_images[$item]['image'], addslashes($addimages_images[$item]['desc']), (ADDIMAGES_RESTRICT_PARENT=='false'&&$item==0&&$this->groupwithparent=='true'?'':$addimages_image_width), (ADDIMAGES_RESTRICT_PARENT=='false'&&$item==0&&$this->groupwithparent=='true'?'':$addimages_image_height), 'hspace="5" vspace="5"') . '<br>' . (!empty($addimages_images[$item]['desc'])?addslashes($addimages_images[$item]['desc']):TEXT_CLICK_TO_ENLARGE) . '</a>\');
                //--></script><noscript>
                  <a href="' . tep_href_link(DIR_WS_IMAGES . $addimages_images[$item]['popimage']) . '" target="_blank">' . tep_image(DIR_WS_IMAGES . $addimages_images[$item]['image'], $addimages_images[$item]['desc'], $addimages_image_width, $addimages_image_height, 'hspace="5" vspace="5"') . '<br>' . (!empty($addimages_images[$item]['desc'])?$addimages_images[$item]['desc']:TEXT_CLICK_TO_ENLARGE) . '</a>
                  </noscript></td>'."\n";
          // BOF lightbox addon      
          }
          // EOF lightbox addon

          if ($col==$this->numberofcolumns) { $col=1; $row++; $this->groupout.='</tr>'."\n"; } else { $col++; }
        }
    
      }
  
      if ($col!=1 && $this->addimages_count > $this->numberofcolumns){ while (($col++)<($this->numberofcolumns+1)) { $this->groupout.='<td>&nbsp;</td>'."\n"; } }

      if (tep_not_null($product['products_image'])) { $this->groupout .= '</table>'."\n"; }
      
    }
  
   /**
    ** member functions
    **/
    function groupoutput () {
      return $this->groupout;
    }
    
    function altgroupoutput () {
      $returnvar = '
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center" class="smallText">'.$this->groupout.'</td>
            </tr>
          </table>'."\n";
      return $returnvar;
    }
    
    function boxsize () {
      // calculate box size
      $menuimagewidth = (($this->imagedefault=='medium')?DISPLAY_IMAGE_WIDTH:SMALL_IMAGE_WIDTH);
      $menuimageheight = (($this->imagedefault=='medium')?DISPLAY_IMAGE_HEIGHT:SMALL_IMAGE_HEIGHT);
      if (empty($menuimageheight)) { $menuimageheight = $menuimagewidth; } // if width was set to zero for proper proportion display.
      if (empty($menuimagewidth)) { $menuimagewidth = $menuimageheight; } // if height was set to zero for proper proportion display.

      $real_columns = (($this->addimages_count < $this->numberofcolumns) ? $this->addimages_count : $this->numberofcolumns);
      $real_rows = ceil($this->addimages_count / $this->numberofcolumns);

      $menu_width = ($real_columns * ($menuimagewidth + 10));
      $menu_height = ($real_rows * ($menuimageheight + 10));
    
      return array($menu_width, $menu_height);
    }
  
  } // end: class displayimages {}


/**
*** displaypopupimagemenu class ***
*** 
*** 
*** 
*** 
*** 
*** 
*/
  class displaypopupimagemenu extends displayimages {

   /**
    ** constructor **/
    function displaypopupimagemenu ( $products_id ) {

      $this->imagedir = DIR_FS_CATALOG . DIR_WS_IMAGES;
      $this->restrictsmimage = ADDIMAGES_POPUP_RESTRICT_IMAGE_SIZE;
      $this->tablealignment = ADDIMAGES_POPUP_TABLE_ALIGNMENT;
      $this->numberofcolumns = ADDIMAGES_POPUP_NUMBER_OF_COLS;
      $this->numberofrows = ADDIMAGES_POPUP_NUMBER_OF_ROWS;
      $this->groupwithparent = ADDIMAGES_POPUP_GROUP_WITH_PARENT;
      $this->imagedefault = 'small';
      $this->buildmenu = true;
      $this->onpagemenu = false;
      $this->linkurl = FILENAME_POPUP_ADD_IMAGE;

      $this->displayimages ( $products_id );

    }

  } // end: class displaypopupimagemenu {}


/**
*** displayonpageimagemenu class ***
*** 
*** 
*** 
*** 
*** 
*** 
*/
  class displayonpageimagemenu extends displayimages {

   /**
    ** constructor **/
    function displayonpageimagemenu ( $products_id ) {

      $this->imagedir = DIR_FS_CATALOG . DIR_WS_IMAGES;
      $this->restrictsmimage = ADDIMAGES_POPUP_RESTRICT_IMAGE_SIZE;
      $this->tablealignment = ADDIMAGES_POPUP_TABLE_ALIGNMENT;
      $this->numberofcolumns = ADDIMAGES_POPUP_NUMBER_OF_COLS;
      $this->numberofrows = ADDIMAGES_POPUP_NUMBER_OF_ROWS;
      $this->groupwithparent = ADDIMAGES_POPUP_GROUP_WITH_PARENT;
      $this->imagedefault = 'small';
      $this->buildmenu = true;
      $this->onpagemenu = true;
      $this->linkurl = FILENAME_PRODUCT_INFO;

      $this->displayimages ( $products_id );

    }

  } // end: class displayonpageimagemenu {}




?>