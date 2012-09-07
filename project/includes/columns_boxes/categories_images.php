<?php // categories_images infobox 

//------------------------------------------------------------------------------------------------------
// PARAMETERS
//------------------------------------------------------------------------------------------------------

$item_column_number = MAX_DISPLAY_CATEGORIES_BOX_PER_ROW;		// range of 1 to 9
$item_title_on_newline = true;	// true or false
$valign = top;	                  // middle, top, or bottom (determines the vertical placement of the images)

$hover = off;                        // turns hover effect on or off

// The Following Parameters are for customizing the hover effect
// leave the # in the color values or the border may not show

$hovercolor = "#F8F8F9";            // color for category when the mouse hovers over it
$hoverborder = "#c0c0c0";           // color for category border when hovered (ignore if $borderwidth is set to 0)
$regcolor = "#ffffff";              // color for category when not hovered
$regborder = "#F8F8F9";             // color for category border when not hovered (ignore if $borderwidth is set to 0) 
$borderwidth = 1;                   // width of border around categories (in pixels, 0 for none)


// for item and subcategory options, suugest that you just put in CSS code
// you can also just define a class and then change it in a template addon like BTS

$item_div_options = 'style="text-align:center;font-weight:bold;font-size:larger;margin-top:0px;margin-bottom:0px;"';
$item_subcategories_options = '';

//------------------------------------------------------------------------------------------------------
// CODE - do not change below here
//------------------------------------------------------------------------------------------------------

// error checking on parameters
if($item_column_number < 1)
{
	$item_column_number = 1;
}
if($item_column_number > 9)
{
	$item_column_number = 9;
}
if($item_title_on_newline)
{
	$item_separator = '<br>';
} else {
	$item_separator = '&nbsp;';
}

// Preorder tree traversal
  function preorder($cid, $level, $foo, $cpath)
  {
    global $categories_string, $HTTP_GET_VARS;

// Display link
    if ($cid != 0) {
      for ($i=0; $i<$level; $i++)
        $categories_string .=  '&nbsp;&nbsp;';
      $categories_string .= '<a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath
=' . $cid) . '">';
// 1.6 Are we on the "path" to selected category?
      $bold = strstr($HTTP_GET_VARS['cPath'], $cpath . $cid . '_') || $HTTP_GET_VARS['cPath'] == $cpath . $cid;
// 1.6 If yes, use <b>
      if ($bold)
        $categories_string .=  '<b>';
      $categories_string .=  $foo[$cid]['name'];
      if ($bold)
        $categories_string .=  '</b>';
      $categories_string .=  '</a>';
// 1.4 SHOW_COUNTS is 'true' or 'false', not true or false
      if (SHOW_COUNTS == 'false') {
        $products_in_category = tep_count_products_in_category($cid);
        if ($products_in_category > 0) {
          $categories_string .= '&nbsp;(' . $products_in_category . ')';
        }
      }
      $categories_string .= '<br>';
    }

// Traverse category tree
    if (is_array($foo)) {
      foreach ($foo as $key => $value) {
        if ($foo[$key]['parent'] == $cid) {
          preorder($key, $level+1, $foo, ($level != 0 ? $cpath . $cid . '_' : ''));
        }
      }
    }
  }

?>
<!-- main_categories //-->

 

   <!---<?php
//////////
// Display box heading
//////////
  $info_box_contents = array();
  $info_box_contents[] = array('align' => 'left', 'text'  => BOX_HEADING_CATEGORIES);
  new infoBoxHeading($info_box_contents, false, false);
?>--->  


		  <TR>
            <td>
<?php
    $info_box_contents = array();
    $info_box_contents[] = array('text' => BOX_HEADING_CATEGORIES);

    new infoBoxHeading($info_box_contents, false, false);
 ?>
 
 
<?php
//////////
// Display box heading
//////////
  $info_box_contents = array();
  $info_box_contents[] = array('align' => 'left', 'text'  => BOX_HEADING_CATEGORIES);


  

//////////
// Get categories list
//////////
// 1.2 Test for presence of status field for compatibility with older versions
  $status = tep_db_num_rows(tep_db_query('describe categories status'));

  $query = "select c.categories_id, cd.categories_name, c.parent_id, c.categories_image from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = cd.categories_id and c.status_categ = '1'";
// 1.3 Can't have 'where' in an if statement!
  if ($status >0)
    $query.= " and c.status = '1'";
  $query.= " and cd.language_id='" . $languages_id ."'
            order by sort_order, cd.categories_name";

  $categories_query = tep_db_query($query);


// Initiate tree traverse
$categories_string = '';
preorder(0, 0, $foo, '');

//////////
// Display box contents
//////////

$info_box_contents = array();

$row = 0;
$col = 0;
while ($categories = tep_db_fetch_array($categories_query))
{
	if ($categories['parent_id'] == 0)
   	{
   		$cPath_new = tep_get_path($categories['categories_id']);
    /*"OMITED SO IT DOESNT DISPLAY SUBCATEGORIES"	$text_subcategories = '';
    	$subcategories_query = tep_db_query($query);
    	while ($subcategories = tep_db_fetch_array($subcategories_query))*/
    	{
     		if ($subcategories['parent_id'] == $categories['categories_id'])
 			{
                $cPath_new_sub = "cPath="  . $categories['categories_id']/*"OMITED SO IT DOESNT DISPLAY SUBCATEGORIES" . "_" . $subcategories['categories_id']*/;
                $text_subcategories .= '• <a href="' . tep_href_link(FILENAME_DEFAULT, $cPath_new_sub, 'NONSSL') . '">';
                $text_subcategories .= $subcategories['categories_name'] . '</a>' . " ";
                
        	} // if ($subcategories['parent_id'] == $categories['categories_id'])

    	} // while ($subcategories = tep_db_fetch_array($subcategories_query))
		
if ($hover == 'on')
{

		$info_box_contents[$row][$col] = array('align' => 'left',
                                           'params' => 'class="smallText" style="border:' . $borderwidth . 'px solid ' . $regborder . '" onMouseOver="window.status=\'' . tep_href_link(FILENAME_DEFAULT, $cPath_new, 'NONSSL') . '\'; this.style.backgroundColor=\'' . $hovercolor . '\'; this.style.cursor=\'hand\'; this.style.border=\'' . $borderwidth . 'px solid ' . $hoverborder . '\';" onMouseOut="window.status=\'\'; this.style.backgroundColor=\'' . $regcolor . '\'; this.style.border=\'' . $borderwidth . 'px solid ' . $regborder . '\';" onclick="location.href=\'' . tep_href_link(FILENAME_DEFAULT, $cPath_new, 'NONSSL') . '\'" width="'.intval(100/$item_column_number).'%" valign="' . $valign . '"',
                                           'text' => '<div '. $item_div_options . '><a href="' . tep_href_link(FILENAME_DEFAULT, $cPath_new, 'NONSSL') . '">' .  tep_image(DIR_WS_IMAGES . $categories['categories_image'], $categories['categories_name'], CATEGORY_BOX_IMAGE_WIDTH, CATEGORY_BOX_IMAGE_HEIGHT) . '</a>' . $item_separator . '<DIV ' . $item_subcategories_options . '>' . $text_subcategories . $spacing . '</DIV></DIV>');

}

else

{

		$info_box_contents[$row][$col] = array('align' => 'left',
                                           'params' => 'class="smallText" width="'.intval(100/$item_column_number).'%" valign="' . $valign . '"',
                                           'text' => '<div '. $item_div_options . '><a href="' . tep_href_link(FILENAME_DEFAULT, $cPath_new, 'NONSSL') . '">' .  tep_image(DIR_WS_IMAGES . $categories['categories_image'], $categories['categories_name'], CATEGORY_BOX_IMAGE_WIDTH, CATEGORY_BOX_IMAGE_HEIGHT) . '</a>' . $item_separator . '<a href="' . tep_href_link(FILENAME_DEFAULT, $cPath_new, 'NONSSL') . '">' . $categories['categories_name'] . '</a><DIV ' . $item_subcategories_options . '>' . $text_subcategories . '</DIV></DIV>');

}
    
    	// determine the column position to see if we need to go to a new row
    	$col ++;
    	if ($col > ($item_column_number - 1))
    	{
      		$col = 0;
      		$row ++;
      		
    	} //if ($col > ($number_of_columns - 1))
    	
    } //if ($categories['parent_id'] == 0)

} // while ($categories = tep_db_fetch_array($categories_query))

//output the contents
new contentBox($info_box_contents);




?></div>
                   </TD>
  </TR> 


<!-- main_categories_eof //-->
