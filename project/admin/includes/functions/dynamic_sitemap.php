<?php //$Id: /catalog/admin/includes/functions/dynamic_sitemap.php (3306) 
 
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
   return false;
 }
 function getBoxText($file, $define)          //retrieve the defined box name
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
 
?>
