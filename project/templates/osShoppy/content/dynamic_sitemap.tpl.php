    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
<?php if (USE_HEADING_TITLE_ON_ALL_PAGES == 'true') { ?>
            <td class="pageHeading"><h1><?php echo HEADING_TITLE; ?></h1></td>
<?php } ?>
<?php if (USE_HEADING_IMAGE_ON_ALL_PAGES == 'true') { ?>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'filepics/filepic_dynamic_sitemap.png', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
<?php } ?>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2">
          <tr>
            <td width="50%" class="main" valign="top"> 
<?php
              // categories map
              $cats = get_cat_paths();
              $prevlevel = 0;
              for ($cnt = 0; $cnt < sizeof($cats); $cnt++)
              {
                $level = substr_count($cats[$cnt]['id'], '_') + 1;
                if ($prevlevel < $level) echo '<ul class="sitemap">';
                if ($prevlevel > $level) echo str_repeat('</li></ul>', $prevlevel - $level);
                if ($prevlevel >= $level)
                  echo '</li>';
                echo '<li><a title="'.$cats[$cnt]['text'].'" href="'.tep_href_link(FILENAME_DEFAULT,'cPath='.$cats[$cnt]['id']).'">'.$cats[$cnt]['text'].'</a>';
                $prevlevel = $level;
              } 
              echo str_repeat('</li></ul>', $prevlevel);
?>
            </td>
            <td width="50%" class="main" valign="top">
              <ul class="sitemap">
<?php
                // main files map
                for ($b = 0; $b < count($files['name']); ++$b){
                  // check each page to see if it should be ssl
                  $securelink= 'NONSSL'; // assume a non ssl page
                  $SSLfp = file($files['path'][$b] ); // load the root file into a variable
                  for ($SSLidx = 0; $SSLidx < count($SSLfp); ++$SSLidx){ //go through root file line by line until the doctype tag is encountered
                    if ((!(strpos($SSLfp[$SSLidx], "breadcrumb->add") === FALSE)) && (!(strpos($SSLfp[$SSLidx], "'SSL") === FALSE))) { // determine if the bread crumb variable is in this line and it has the letter SSL in it
                      $securelink= 'SSL'; // set the ssl link to true
                      break;
                    } elseif (!(strpos(strtolower($SSLfp[$SSLidx]), "<!doctype") === FALSE)) { //doctype tag is found(too soon?), exit loop and do not use SSL
                      break; // exit the loop and do not set ssl link to true
                    }
                  }
                  echo '<li><a title="'. $files['name'][$b] .'" href="' . tep_href_link($files['path'][$b], '', $securelink) . '">' . $files['name'][$b] . '</a></li>';
                }

                // Box Files
				$boxHeading = array();
                for ($b = 0; $b < count($boxHeading); ++$b){
                    $nb_elements = count($boxHeading[$b]['filename']);
                    if($nb_elements > 0){
                    echo '<li>'.$boxHeading[$b]['heading'][$b];
                        if (tep_not_null($boxHeading[$b]['filename'][0]))
                        {
                        echo '<ul>';
                        for ($f = 0; $f < $nb_elements ; ++$f)
                            if (tep_not_null($boxHeading[$b]['filename'][$f]))
                                echo '<li><a title="'. $boxHeading[$b]['boxtext'][$f] .'" href="' . tep_href_link($boxHeading[$b]['filename'][$f]) . '">' . $boxHeading[$b]['boxtext'][$f] . '</a></li>';
                        echo '</ul>';
                        }
                    
                    echo '</li>';
                    }
                }
?>
              </ul>
            </td>
          </tr>
        </table></td>
      </tr>
    </table></td>
