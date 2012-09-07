<?php // gallery_slideshow info infobox 

// for PHP 4 versions
if (PHP_VERSION < 5) {
  function scandir($dir) {
    $dh = opendir($dir);
    while (false !== ($filename = readdir($dh))) {
      $files[] = $filename;
    }
  sort($files);
  return $files;
  }
}
$dir = './gallery/thumbnails/';
if (is_dir($dir)) {
  $pictures = array_diff(scandir($dir), array('.', '..', '.DS_Store','thumbnails'));
  //set up the max thumbs number here
  $max_thumbs=BOX_SLIDESHOW_MAX_THUMBS;
  //if there aren't enough thumbs use less
  if (count($pictures)< BOX_SLIDESHOW_MAX_THUMBS){
    $max_thumbs=count($pictures);
  }
  
  if (count($pictures)==1){
    $rand_keys[]=array_rand($pictures,1);
  }else{
    $rand_keys=array_rand($pictures,$max_thumbs);
  }
}

if (count($rand_keys) > 0) {

  $boxHeading = BOX_HEADING_GALLERY;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'gallery_slideshow';
  $boxContent_attributes = ' align="center"';
  $boxLink = '<a href="' . tep_href_link(FILENAME_GALLERY) . '"><img src="images/infobox/arrow_right.gif" border="0" alt="more" title="more" width="12" height="10"></a>';

	$box_text = '';
    $rown = count($rand_keys);
    $row = 0;
      foreach ($rand_keys as $pict_key) {
        if(!empty($pictures[$pict_key])){
					$row++;
					$box_text .= '<table border=0 cellpadding=0 cellspacing=0 width="100%" id="special'.$row.'">
													<tr>
														<td align="center" class="boxText"><a href="' . tep_href_link(FILENAME_GALLERY,'','NONSSL') . '">' . TEXT_GALLERY . '</a>
														</td>
													</tr>

													<tr>
														<td align="center"><a href="' . tep_href_link(FILENAME_GALLERY,'','NONSSL') . '">' . tep_image($dir.$pictures[$pict_key],BOX_GALLERY_TOOLTIP,PHOTO_GALLERY_SLIDESHOW_INFOBOX_IMAGE_WIDTH, PHOTO_GALLERY_SLIDESHOW_INFOBOX_IMAGE_HEIGHT) . '</a>
														 </td>
													</tr>
													<tr>
													  <td align="center" class="boxText"><p>'.BOX_TEXT_GALLERY_LINK.'</p></td>
													</tr>
												</table>';
												
					if ($rown == $row) {
						$box_text .= "\n";
					}else{
						$box_text .= '' . "\n";
					}
				}
      }

  $box_id = $box_base_name . 'Box';
  $boxContent = $box_text;
  include (bts_select('boxes', $box_base_name));
  $boxLink = '';
?>

<script language="javascript">
  // all category box slideshow    michael hazzard  http://www.miramardesign.com
  // you could move this to an external js file but u would have to call start() on every page

  var row =  <?php echo $row; ?>;
  var numpics =  <?php echo count($pictures); ?>;

  function start(){
		var k = Math.floor(Math.random()* row +1)  //make random starting special //http://www.shawnolson.net/a/789/make-javascript-mathrandom-useful.html
		var i ;
		
		for(i= 1; i < (row + 1); i++){    //echo total # of special's
		if(i == k) {
		  document.getElementById('special'+i).style.display="";
		}else{
		  document.getElementById('special'+i).style.display="none";  //hide all
		}
	}
	
	// need to randomize beginnning value
	setTimeout("slideshow("+ k +")",3000);  //change 3000 to custom time if desired
	  //setTimeout("slideshow(1)",3000);  //static if starting at 1
	}
	
	function slideshow(i){
	  document.getElementById('special'+i).style.display="";
	  if (i > 1) {
	    var j = i - 1;
	    document.getElementById('special'+j).style.display="none";
	  }else {
	    document.getElementById('special'+ row).style.display="none";
	  }
	  ++i;
	
	  if (i > row ){
	    i = 1;
	  }
	  setTimeout("slideshow("+i+")",3000);
	}
	
	if (numpics>1){
	  start();
	}
</script>

<!-- gallery_slideshow_eof //-->
<?php
}
?>