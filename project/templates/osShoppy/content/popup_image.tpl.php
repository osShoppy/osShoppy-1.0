<?php
 if (($HTTP_GET_VARS['image'] ==0) && ($products['products_image_lrg'] != '')) {
  echo tep_image(DIR_WS_IMAGES . $products['products_image_lrg'], $products['products_name']);
 } elseif ($HTTP_GET_VARS['image'] ==1) {
  echo tep_image(DIR_WS_IMAGES . $products['products_image_xl_1'], $products['products_name']);
 } elseif ($HTTP_GET_VARS['image'] ==2) {
  echo tep_image(DIR_WS_IMAGES . $products['products_image_xl_2'], $products['products_name']);
 } elseif ($HTTP_GET_VARS['image'] ==3) {
  echo tep_image(DIR_WS_IMAGES . $products['products_image_xl_3'], $products['products_name']);
 } elseif ($HTTP_GET_VARS['image'] ==4) {
  echo tep_image(DIR_WS_IMAGES . $products['products_image_xl_4'], $products['products_name']);
 } elseif ($HTTP_GET_VARS['image'] ==5) {
  echo tep_image(DIR_WS_IMAGES . $products['products_image_xl_5'], $products['products_name']);
 } elseif ($HTTP_GET_VARS['image'] ==6) {
  echo tep_image(DIR_WS_IMAGES . $products['products_image_xl_6'], $products['products_name']);
 } else {
  echo tep_image(DIR_WS_IMAGES . $products['products_image'], $products['products_name']);
 }
?>
