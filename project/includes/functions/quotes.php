<?php // catalog/includes/functions/quotes.php (6675)

// Converts attribute id into text
 function GetAttributeText($attribute, $languages_id) 
 {
     $attrStr = '';
     if (tep_not_null($attribute))
     {
         list($option, $value) = each($attribute);
         $options_query = tep_db_query("select products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" .  (int)$option . "' and language_id = '" . (int)$languages_id . "' limit 1");
         $options = tep_db_fetch_array($options_query);
         $attrStr = ' - ' . $options['products_options_name']; 
         $options_query = tep_db_query("select products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" .  (int)$value . "' and language_id = '" . (int)$languages_id . "' limit 1");
         $options = tep_db_fetch_array($options_query);
         $attrStr .= ' ' .$options['products_options_values_name']; 
     }
     return $attrStr;
 }
?>