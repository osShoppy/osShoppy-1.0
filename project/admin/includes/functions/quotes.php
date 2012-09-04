<?php
/*
  $Id: quotes, v 1.0 2009/04/04
  Created by Jack_mcs from http://www.oscommerce-solution.com
  
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright (c) 2009 oscommerce-solution.com

  Released under the GNU General Public License
*/

  function tep_get_category_id($category_name, $language_id) {
    $category_query = tep_db_query("select categories_id from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_name LIKE '" . QUOTES_CATEGORY_NAME . "' and language_id = '" . (int)$language_id . "'");
    $category = tep_db_fetch_array($category_query);

    return $category['categories_id'];
  }
  
?>  