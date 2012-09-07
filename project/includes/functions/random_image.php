<?php // catalog/includes/functions/random_image.php (1934)

/**#@+
 * Extra GLOB constant for safe_glob()
 */
define('GLOB_NODIR',256);
define('GLOB_PATH',512);
define('GLOB_NODOTS',1024);
define('GLOB_RECURSE',2048);
/**#@-*/

/**
 * A safe empowered glob().
 *
 * Link to code: http://php.net/manual/en/function.glob.php
 *
 * Function glob() is prohibited on some server (probably in safe mode)
 * (Message "Warning: glob() has been disabled for security reasons in
 * (script) on line (line)") for security reasons as stated on:
 * http://seclists.org/fulldisclosure/2005/Sep/0001.html
 *
 * safe_glob() intends to replace glob() using readdir() & fnmatch() instead.
 * Supported flags: GLOB_MARK, GLOB_NOSORT, GLOB_ONLYDIR
 * Additional flags: GLOB_NODIR, GLOB_PATH, GLOB_NODOTS, GLOB_RECURSE
 * (not original glob() flags)
 * @author BigueNique AT yahoo DOT ca
 * @updates
 * - 080324 Added support for additional flags: GLOB_NODIR, GLOB_PATH,
 *   GLOB_NODOTS, GLOB_RECURSE
 */
function safe_glob($pattern, $flags=0) {
    $split=explode('/',str_replace('\\','/',$pattern));
    $mask=array_pop($split);
    $path=implode('/',$split);
    if (($dir=opendir($path))!==false) {
        $glob=array();
        while(($file=readdir($dir))!==false) {
            // Recurse subdirectories (GLOB_RECURSE)
            if( ($flags&GLOB_RECURSE) && is_dir($file) && (!in_array($file,array('.','..'))) )
                $glob = array_merge($glob, array_prepend(safe_glob($path.'/'.$file.'/'.$mask, $flags),
                    ($flags&GLOB_PATH?'':$file.'/')));
            // Match file mask
            if (fnmatch($mask,$file)) {
                if ( ( (!($flags&GLOB_ONLYDIR)) || is_dir("$path/$file") )
                  && ( (!($flags&GLOB_NODIR)) || (!is_dir($path.'/'.$file)) )
                  && ( (!($flags&GLOB_NODOTS)) || (!in_array($file,array('.','..'))) ) )
                    $glob[] = ($flags&GLOB_PATH?$path.'/':'') . $file . ($flags&GLOB_MARK?'/':'');
            }
        }
        closedir($dir);
        if (!($flags&GLOB_NOSORT)) sort($glob);
        return $glob;
    } else {
        return false;
    }    
}

//
// edit the line below to point to the folder of images you want to use as random banners
//
define ( IMAGE_DIR , 'images/store_logo_random/'.RANDOM_HEADER_FOLDER.'/');

define ( IMAGE_PATTERN, '*.*');

function random_image() {

  $img_array = safe_glob(IMAGE_DIR . IMAGE_PATTERN , GLOB_NODIR | GLOB_NODOTS | GLOB_NOSORT);

  return IMAGE_DIR . '/' . $img_array [ array_rand ( $img_array ) ];
}

?>