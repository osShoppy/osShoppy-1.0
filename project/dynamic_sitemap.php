<?php //$Id: /catalog/dynamic_sitemap.php (3306)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_DYNAMIC_SITEMAP);

 function getFileName($file, $define)        //retrieve the defined filename
 { 
   $fp = file($file);
   for ($idx = 0; $idx < count($fp); ++$idx)
   {
      if (!(strpos($fp[$idx], $define) === FALSE))
      {
          $parts = explode("'", $fp[$idx]);   
          return $parts[3];     
      }
   }    
   return NULL;
 }
 function getBoxText($file, $define)          //retrieve the defined box name
 { 
   $fp = file($file);
   for ($idx = 0; $idx < count($fp); ++$idx)
   {
      if (!(strpos($fp[$idx], $define) === FALSE))
      {
        $fp[$idx] = stripslashes($fp[$idx]);
        $p_start = strpos($fp[$idx], ",");
        $p_start = strpos($fp[$idx], "'", $p_start);
        $p_stop = strrpos($fp[$idx], '\'');
        return str_replace('%s', '', ucfirst(substr($fp[$idx], $p_start + 1, $p_stop - $p_start - 1)));
      }
   }
   return NULL;
 }
 function IsViewable($file)
 {
   $fp = file($file);
   for ($idx = 0; $idx < count($fp); ++$idx)
   {
      if (!(strpos($fp[$idx], "<head>") === FALSE))
        return true;
   }  
   return false;
 }

  function get_cat_paths($categories_array = '', $parent_id = '0', $path='') {
    global $languages_id;

    if (!is_array($categories_array)) $categories_array = array();

    $categories_query = tep_db_query("select c.categories_id, cd.categories_name from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where parent_id = '" . (int)$parent_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by sort_order, cd.categories_name");
    while ($categories = tep_db_fetch_array($categories_query)) {
	// hide empty categories hack
	  if (tep_count_products_in_category($categories['categories_id']) > 0) {
	  // hide empty categories hack
        if ($parent_id=='0'){
	        $categories_array[] = array('id' => $categories['categories_id'],
                                      'text' => $categories['categories_name']);
        }else{
         	$categories_array[] = array('id' => $path . $parent_id . '_' .$categories['categories_id'],
                                        'text' => $categories['categories_name']);
        }
        if ($categories['categories_id'] != $parent_id) {
         	$this_path=$path;
        	if ($parent_id != '0')
      	      $this_path = $path . $parent_id . '_';
              $categories_array = get_cat_paths($categories_array, $categories['categories_id'], $this_path);
        }
	  // hide empty categories hack
	  }
	  // hide empty categories hack
    }

    return $categories_array;
  }
 
 $path = DIR_WS_BOXES;
 $pathFileName = DIR_WS_INCLUDES . 'filenames.php';
 $pathLanguage = DIR_WS_LANGUAGES . $language . '.php';
 $boxText = array();
 
 /********************* Find the infoboxes to add ***********************/
 if ($handle = opendir($path))
 {
	 if (!tep_session_is_registered('customer_id'))
	 		$excluded_query = tep_db_query('select exclude_file from '.TABLE_SITEMAP_EXCLUDE.' where exclude_type != "0" and is_box="1"');
	 else
	 		$excluded_query = tep_db_query('select exclude_file from '.TABLE_SITEMAP_EXCLUDE.' where exclude_type = "1" and is_box="1"');
	 $excluded_array = array();
	 if (tep_db_num_rows($excluded_query))
	  while($ex = tep_db_fetch_array($excluded_query))
   			$excluded_array[] = $ex['exclude_file'];

 
    $found = false;
    $ctr = 0;
    while ($file = readdir($handle))
    {     
       if (strtolower(substr($file, -4, 4)) != ".php")
          continue;
       elseif (in_array($file, $excluded_array))
          continue;

       $file = $path . '/' . $file; 
       $fp = file($file);

       for ($idx = 0; $idx < count($fp); ++$idx)
       {
         if (!(strpos($fp[$idx], "BOX_HEADING") === FALSE))
         {                 
             $parts = explode(" ", $fp[$idx]);
             for ($i = 0; $i < count($parts); ++$i)
             {
                if (strpos($parts[$i], "BOX_HEADING") === FALSE)
                  continue;
                $parts = explode(")", $parts[$i]);  //$parts has full box heading text
                $boxHeading[$ctr]['heading'][$ctr] = getBoxText($pathLanguage, $parts[0]);
             }
         }  
         else if (!(strpos($fp[$idx], "FILENAME") === FALSE))
         {
           $str = str_replace("'<a href=\"' . tep_href_link(", "", $fp[$idx]);
           $str = str_replace("\$info_box_contents[] = array('text' => ", "", $str);
           
           $parts = explode(")", $str);
           $parts[0] = trim($parts[0]);
           
           $boxParts = explode(".", $parts[1]);
           $boxParts[2] = trim($boxParts[2]);      
           
           if (tep_not_null($boxParts[2]))
           {     
              $boxHeading[$ctr]['filename'][] = getFileName($pathFileName, $parts[0]);
              $boxHeading[$ctr]['boxtext'][] = getBoxText($pathLanguage, $boxParts[2]);
           }
           else
           { 
              if (tep_not_null($box_heading))
              {
                echo 'Invalid code for this module found in the following infobox: '.$boxHeading[$ctr]['heading'][$ctr].'<br>';
                array_pop($boxHeading);
                $ctr--;
              }
           }
         }               
       } 
       $ctr++;
    }
    closedir($handle); 
 } 
 
 /********************* Find the pages to add ***********************/
 $ctr = 0;
	($dir = opendir('.')) || die("Failed to open dir");
 $files = array();

 	 if (!tep_session_is_registered('customer_id'))
	 		$excluded_query = tep_db_query('select exclude_file from '.TABLE_SITEMAP_EXCLUDE.' where exclude_type != "0" and is_box="0"');
	 else
	 		$excluded_query = tep_db_query('select exclude_file from '.TABLE_SITEMAP_EXCLUDE.' where exclude_type = "1" and is_box="0"');
	 $excluded_array = array();
	 if (tep_db_num_rows($excluded_query))
	  while($ex = tep_db_fetch_array($excluded_query))
   			$excluded_array[] = $ex['exclude_file'];

 while($file = readdir($dir)) 
 {
    if((!is_dir($file) && strtolower(substr($file, -4, 4)) === ".php") && !in_array($file ,$excluded_array))//only look at php files and skip that are excluded
    {
        $engFile = DIR_WS_LANGUAGES . $language . '/' . $file;
        if (file_exists($engFile) && IsViewable($file)) 
        {

           $fp = file($engFile);
  
           for ($idx = 0; $idx < count($fp); ++$idx)
           {
             if (!(strpos($fp[$idx], "define('HEADING_TITLE") === FALSE))
             {
                $fp[$idx] = stripslashes($fp[$idx]);
                $p_start = strpos($fp[$idx], ",");
                $p_start = strpos($fp[$idx], "'", $p_start);
                $p_stop = strrpos($fp[$idx], '\'');
                $files['name'][] = str_replace('%s', '', ucfirst(substr($fp[$idx], $p_start + 1, $p_stop - $p_start - 1)));
                $files['path'][] = $file;
                break;
             }
           }  
        }  
    } 
 }
  
  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_DYNAMIC_SITEMAP));
  $content = CONTENT_DYNAMIC_SITEMAP;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
