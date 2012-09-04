<?php //$Id: /catalog/admin/includes/classes/alterimage.php (1032) 

/**
*** alterimage class  ***
*** 
*** 
*** required: PHP >= 4.3.2
***           GD support >= 2.0   ( $this->gd_version() >= 2.0 )
*** 
*** 
*** How to use
*** *************************
*** Have an image resized and outputed all in one line:
*** 
*** ex 1:
*** $image = new alterimage('image.jpg','image2.jpg',200,180,'FFFFFF');  // image.jpg = original image, image2.jpg = destination image, 200 = maximum width, 180 = maximum height, 'FFFFFF' = background color, set to empty string for transparency retention.  Both maximum width and maximum height must be defined for the background to be applied.
*** unset($image);                                                       // cleanup menory
*** 
*** ex 2:
*** $image = new alterimage('image.jpg','direct',200,180);     // image.jpg = original image, direct = send image to browser (sends page header), 200 = maximum width, 180 = maximum height
*** unset($image);                                             // cleanup menory
*** 
*** ex 3: Step through the processes, or be selective of how the image is processed:
*** 
*** $image = new alterimage();
*** $image->create_srcImageResource('image.jpg'); // create source resource ID from: /your/oscommerce/images/path/image.jpg
*** $image->create_outImageResource(200,180);     // proportionally size (maxw,maxh) and create output resource ID to a (proportionally) max 200 width and max 180 height. If image dimensions are omitted, the image's original size is used. If the maxh dimension is omitted, maxw is used for both.
*** $image->addWatermark(100);                    // add watermark to image using 100 opacity (fully visible)
*** $image->imageOutput('image2.jpg','FFFFFF');   // output the file. if no filename specified, output direct to page stream. 'FFFFFF' represents the background color used to pad any space around a proportionally sized image and the max width and height used. Both maximum width and maximum height must be set when create_outImageResource() is called for the background to be applied.
*** $image->destroy();                            // clean up image space
*** unset($image);                                // cleanup menory
***
***
*** echo $image->errorMessage();                  // error description or false if no error.
*** echo $image->messagesOutput();                // if $debug config option is set on, contains debug messages.
***
*** echo $image->error;                           // error code: 
***                                               // 1. source file doesn't exist
***                                               // 2. source file not readable
***                                               // 3. target file is same as source file and source file is not writable
***                                               // 4. GD unsupported file type
***                                               // 5. alterimage unsupported file type
*** 
*/

  class alterimage {

    var $imagedir = NULL;

    var $srcImageResourceID = NULL;
    var $outImageResourceID = NULL;

    var $src_width = NULL;
    var $src_height = NULL;
    var $out_width = NULL;
    var $out_height = NULL;
    var $max_width = NULL;
    var $max_height = NULL;
    var $background_color = NULL;
    var $type = NULL;
    var $type_text = NULL;
    var $is_alpha = false;
    var $config_disable_imagecopyresampled = false;

    var $config_background_hexcolor = 'FFFFFF';

    var $jpgquality = 75;

    var $chmodvalue = 0777;

    var $error;
    var $debug = false;        // only fill messages array if debugging
    var $messages = array();


   /**
    ** constructor **/
    function alterimage ($src_filename = '', $dest_filename = '', $maxwidth = 0, $maxheight = 0, $background_color = '', $skip_watermark = false) {

      $this->imagedir = DIR_FS_CATALOG . DIR_WS_IMAGES;
      if (!empty($background_color)) { $this->background_color = $background_color; }
      if (!empty($maxwidth)) { $this->max_width = $maxwidth; }
      if (!empty($maxheight)) { $this->max_height = $maxheight; }
      $skip_watermark = (ADDIMAGES_ADD_WATERMARK == 'false' ? true : $skip_watermark);

      if (!file_exists($this->imagedir.$src_filename)) {
        // source file doesn't exist
        $this->error = 1;
        $this->messagesAdd($this->errorMessage(), __FILE__, __LINE__);
      } elseif (!is_readable($this->imagedir.$src_filename)) {
        // source file not readable
        $this->error = 2;
        $this->messagesAdd($this->errorMessage(), __FILE__, __LINE__);
      } elseif (($dest_filename == $src_filename) && !is_writable($this->imagedir.$src_filename)) {
        // target file is same as source file and source file is not writable
        $this->error = 3;
        $this->messagesAdd($this->errorMessage(), __FILE__, __LINE__);
      } elseif (!list($this->src_width, $this->src_height, $this->type) = @getimagesize($this->imagedir.$src_filename)) {
        // GD unsupported file type
        $this->error = 4;
        $this->messagesAdd($this->errorMessage(), __FILE__, __LINE__);
      } else {

        // if filename is set, create source resource
        if (!empty($src_filename)) {
          $this->create_srcImageResource($src_filename);
        }

        if (!$this->CheckResouce($this->srcImageResourceID,__LINE__)) { return false; }

        if (empty($maxheight)) { $maxheight = (!empty($maxwidth) ? $maxwidth : $this->src_height); }
        if (empty($maxwidth)) { $maxwidth = (!empty($maxheight) ? $maxheight : $this->src_width); }

        // if max width and height is set, perform create workspace resource and do the resize
        if ($maxwidth != 0 && $maxheight != 0) {
          $this->create_outImageResource($maxwidth, $maxheight);
        } else {
          $this->messagesAdd('Width and Height setting for your images are both empty. Resizing requires at least one dimension to be set in your shop Configuration -> Images settings group.', __FILE__, __LINE__);
        }

        if (!$this->CheckResouce($this->outImageResourceID,__LINE__)) { return false; }
		
        if (!$skip_watermark) { $this->addWatermark(ADDIMAGES_WATERMARK_TRANSPARENCY); }

        // if $dest_filename set, perform direct output or file write out, then destroy
        if (!empty($dest_filename)) {
          if ($dest_filename == 'direct') {
            $this->imageOutput();
          } else {
            $this->imageOutput($dest_filename);
          }
          $this->destroy();
        }
      }
    }

   /**
    ** destructor **/
    function destroy() {
      $this->ImageSafeDestroy($this->srcImageResourceID);
      $this->ImageSafeDestroy($this->outImageResourceID);
      return true;
    }

    function ImageSafeDestroy($imageResourceID) {
      if ( is_resource($imageResourceID) && get_resource_type($imageResourceID) == 'gd' ) {
        return imagedestroy($imageResourceID);
      }
      return false;
    }

    function errorMessage() {
      switch ($this->error) {
        case 1:
          return 'source file doesn\'t exist.';
          break;
        case 2;
          return 'source file not readable.';
          break; 
        case 3;
          return 'target file is same as source file and source file is not writable.';
          break; 
        case 4;
          return 'GD unsupported file type.';
          break; 
        case 5;
          return 'alterimage unsupported file type.';
          break; 
        default:
          return false;
          break;
      }
    }

    // support internal messages
    function messages() {
      return $this->messages;
    }

    // add new message to stack
    // used both internally and as ala carte image processing
    function messagesAdd($msg, $file = '', $line = '') {
      if ($this->debug == true) {
        $this->messages[] = array('message' => $msg, 'file' => $file, 'line' => $line);
        return true;
      }
      return false;
    }

    // output messages
    // used both internally and as ala carte image processing
    function messagesOutput($html = true) {
      if ($this->debug == true) {
        $msg = '';
        foreach ($this->messages as $key => $message) {
          $msg .= 'msg: ' . $message['message'] . ' file: ' . $message['file'] . ' line: ' . $message['line'] . ($html?'<br>':'') . "\n";
        }
        return $msg;
      }
      return 'The debug setting is false. Please set to true to use the messages.';
    }

    // create source resource
    // used both internally and as ala carte image processing
    function create_srcImageResource($src_filename) {
      $this->messagesAdd('starting create_srcImageResource()', __FILE__, __LINE__);
      
      switch ($this->type) {
          case IMAGETYPE_JPEG:
            $this->type_text = 'jpg';
            $this->srcImageResourceID = imagecreatefromjpeg($this->imagedir.$src_filename);
            break;

          case IMAGETYPE_PNG:
            $this->is_alpha = true;
            $this->type_text = 'png';
            $this->srcImageResourceID = imagecreatefrompng($this->imagedir.$src_filename);
            break;

          case IMAGETYPE_GIF:
            $this->is_alpha = true;
            $this->type_text = 'gif';
            $this->srcImageResourceID = imagecreatefromgif($this->imagedir.$src_filename);
            break;

          default:
            // alterimage unsupported file type
            $this->error = 5;
            $this->messagesAdd($this->errorMessage(), __FILE__, __LINE__);
      }
      return true;
    }

    // calculate new size, create destination resource, resample image to destination resource
    // used both internally and as ala carte image processing
    function create_outImageResource($maxwidth = 0, $maxheight = 0) {
      $this->messagesAdd('starting create_outImageResource()', __FILE__, __LINE__);

      // calculate size while maintaining proportions
      if ($this->src_width > $maxwidth || $this->src_height > $maxheight) {
        $x_deltperc = $maxwidth / $this->src_width;
        $y_deltperc = $maxheight / $this->src_height;

        if ($y_deltperc > $x_deltperc) {
          $use_width = $this->src_width * $x_deltperc;
          $use_height = $this->src_height * $x_deltperc;
        } else {
          $use_width = $this->src_width * $y_deltperc;
          $use_height = $this->src_height * $y_deltperc;
        }
      } else {
        $use_width = $this->src_width;
        $use_height = $this->src_height;
      }

      $this->out_width = ((int)$use_width <= 0 ? (int)$use_height : (int)$use_width);
      $this->out_height = ((int)$use_height <= 0 ? (int)$use_width : (int)$use_height);

      $this->messagesAdd('starting: $this->ImageCreateFunction($this->out_width, $this->out_height) w/ width:' . $this->out_width . ', height:' . $this->out_height, __FILE__, __LINE__);

      $this->outImageResourceID = $this->ImageCreateFunction($this->out_width, $this->out_height);
      
      if ( !is_resource($this->outImageResourceID) && get_resource_type($this->outImageResourceID) == 'gd' ) {
        $this->messagesAdd('$this->outImageResourceID is NOT A RESOURCE. $this->ImageCreateFunction failed. width:' . $this->out_width . ', height:' . $this->out_height, __FILE__, __LINE__);
      } else {
        $this->messagesAdd('$this->outImageResourceID is a GD resource. $this->ImageCreateFunction succeeded, resource '.$this->outImageResourceID.'. width:' . $this->out_width . ', height:' . $this->out_height, __FILE__, __LINE__);
      }

      $this->ImageResizeNCopy();

      if ( !$this->CheckResouce($this->outImageResourceID,__LINE__) ) { return false; }
      
      return true;
    }

    // process resize if necessary and copy to destination resource ID 
    // respecting both 8bit transparency and 24bit alpha if necessary
    function ImageResizeNCopy() {
      $this->messagesAdd('starting ImageResizeNCopy()', __FILE__, __LINE__);
      if ( !$this->CheckResouce($this->outImageResourceID,__LINE__) ) { return false; }

      switch ($this->type) {
        case IMAGETYPE_JPEG:
          imagecopyresampled($this->outImageResourceID, $this->srcImageResourceID, 0, 0, 0, 0, $this->out_width, $this->out_height, $this->src_width, $this->src_height);
          break;

        case IMAGETYPE_PNG:
          imagealphablending($this->outImageResourceID, false);
          imagecopyresampled($this->outImageResourceID, $this->srcImageResourceID, 0, 0, 0, 0, $this->out_width, $this->out_height, $this->src_width, $this->src_height);
          imagesavealpha($this->outImageResourceID, true);
          break;

        case IMAGETYPE_GIF:
          imagesavealpha($this->outImageResourceID, true);
          imagealphablending($this->outImageResourceID, false);
          $output_full_alpha = $this->ImageColorAllocateAlphaSafe($this->outImageResourceID, 255, 255, 255, 127);
          imagefilledrectangle($this->outImageResourceID, 0, 0, $this->out_width, $this->out_height, $output_full_alpha);
          $this->ImageResizeFunction($this->outImageResourceID, $this->srcImageResourceID, 0, 0, 0, 0, $this->out_width, $this->out_height, $this->src_width, $this->src_height);
          break;
      }
      
      return true;
    }

    // apply watermark to destination image
    // used both internally and as ala carte image processing
    function addWatermark($pct = ADDIMAGES_WATERMARK_TRANSPARENCY) {
        $this->messagesAdd('starting addWatermark()', __FILE__, __LINE__);
		
		if (!is_int($pct)) { $pct = intval($pct); }

		if (!file_exists(DIR_FS_ADMIN . DIR_WS_IMAGES . ADDIMAGES_WATERMARK_IMAGE)) return;

		$watermark_img = imagecreatefrompng(DIR_FS_ADMIN . DIR_WS_IMAGES . ADDIMAGES_WATERMARK_IMAGE);
		imagecolortransparent($watermark_img, 0);
		$wmrk_size = @getimagesize(DIR_FS_ADMIN . DIR_WS_IMAGES . ADDIMAGES_WATERMARK_IMAGE);

		$offset = intval(ADDIMAGES_WATERMARK_OFFSET) / 100;
		$avdist = ($this->out_width + $this->out_height) / 2;
		$pos_tmp = ceil($avdist * $offset);
		if (($wmrk_size[0]+($pos_tmp*2)) < $this->out_width) { 
			switch (ADDIMAGES_WATERMARK_HORIZONTAL_ALIGN) {
			  case 'left':
		        $pos_x = $pos_tmp;
				break;
			  case 'center':
				$pos_x = ceil(($this->out_width - $wmrk_size[0]) / 2);
				break;
			  case 'right':
		        $pos_x = $this->out_width - $wmrk_size[0] - $pos_tmp;
				break;
			}
		} else {
		  $pos_x = ceil(($this->out_width - $wmrk_size[0]) / 2);
		}
		if (($wmrk_size[1]+($pos_tmp*2)) < $this->out_height) { 
			switch (ADDIMAGES_WATERMARK_VERTICAL_ALIGN) {
			  case 'top':
				$pos_y = $pos_tmp;
				break;
			  case 'middle':
				$pos_y = ceil(($this->out_height - $wmrk_size[1]) / 2);
				break;
			  case 'bottom':
				$pos_y = $this->out_height - $wmrk_size[1] - $pos_tmp;
				break;
			}
		} else {
		  $pos_y = ceil(($this->out_height - $wmrk_size[1]) / 2);
		}
		
		//Merge the 2 buffers
		$this->ImageCopyMergeAlpha($this->outImageResourceID, $watermark_img, $pos_x, $pos_y, 0, 0, $wmrk_size[0], $wmrk_size[1], $pct);
		$this->ImageSafeDestroy($watermark_img);

		return true;
    }

	// apply background and output image to destination
    // used both internally and as ala carte image processing
    function imageOutput($dest_filename = '', $background_color = '') {
      $this->messagesAdd('starting imageOutput()', __FILE__, __LINE__);
      if ( !$this->CheckResouce($this->outImageResourceID,__LINE__) ) { return false; }
      
      if (!empty($background_color)) { $this->background_color = $background_color; }

      $this->ApplyBackground();
      
      $this->AlphaChannelFlatten();

      if (!empty($dest_filename)) { 
        switch ($this->type) {
          case IMAGETYPE_JPEG:
            imagejpeg($this->outImageResourceID, $this->imagedir.$dest_filename, $this->jpgquality);
            break;
          case IMAGETYPE_PNG:
            imagepng($this->outImageResourceID, $this->imagedir.$dest_filename);
            break;
          case IMAGETYPE_GIF:
            imagegif($this->outImageResourceID, $this->imagedir.$dest_filename);
            break;
        } // end switch
        chmod($this->imagedir.$dest_filename, intval($this->chmodvalue, 8));
      } else {
        switch ($this->type) {
          case IMAGETYPE_JPEG:
            header('Content-type: image/jpeg');
            imagejpeg($this->outImageResourceID, NULL, $this->jpgquality);
            break;
          case IMAGETYPE_PNG:
            header('Content-type: image/png');
            imagepng($this->outImageResourceID);
            break;
          case IMAGETYPE_GIF:
            header('Content-type: image/gif');
            imagegif($this->outImageResourceID);
            break;
        }
      }
      return true;
    }

    function ApplyBackground() {
      $this->messagesAdd('starting ApplyBackground()', __FILE__, __LINE__);
      if ( !$this->CheckResouce($this->outImageResourceID,__LINE__) ) { return false; }

      if (!empty($this->background_color) && !empty($this->max_width) && !empty($this->max_height)) {
        if ($this->out_width != $this->max_width || $this->out_height != $this->max_height ) {

          $t_outImageResourceID = $this->ImageCreateFunction($this->max_width, $this->max_height);
          imagesavealpha($t_outImageResourceID, true);
          imagealphablending($t_outImageResourceID, false);
          $output_full_alpha = $this->ImageHexColorAllocate($t_outImageResourceID, $this->background_color);
          imagefilledrectangle($t_outImageResourceID, 0, 0, $this->max_width, $this->max_height, $output_full_alpha);

          $hpos = (($this->max_width > $this->out_width) ? floor(($this->max_width-$this->out_width)/2) : 0);
          $vpos = (($this->max_height > $this->out_height) ? floor(($this->max_height-$this->out_height)/2) : 0);

          $this->ImageCopyRespectAlphaFlatten($t_outImageResourceID, $this->outImageResourceID, $hpos, $vpos, 0, 0, $this->out_width, $this->out_height);

          $this->ImageSafeDestroy($this->outImageResourceID);
          $this->outImageResourceID = $t_outImageResourceID;

        }
      }
      return true;
    }

// 
// 
// the following AlphaChannelFlatten based on functions found in phpThumb() by James Heinrich <info@silisoftware.com>
// released under GNU GENERAL PUBLIC LICENSE Version 2, June 1991
// 
    function AlphaChannelFlatten() {
        $this->messagesAdd('starting AlphaChannelFlatten()', __FILE__, __LINE__);

        if (!$this->is_alpha) {
            // image doesn't have alpha transparency, no need to flatten
            $this->messagesAdd('skipping AlphaChannelFlatten() because !$this->is_alpha', __FILE__, __LINE__);
            return false;
        }
        switch ($this->type) {
            case IMAGETYPE_PNG:
                $CurrentImageColorTransparent = imagecolortransparent($this->srcImageResourceID);
                if ($CurrentImageColorTransparent == -1) {
                  // image has alpha transparency, but output as PNG or ICO which can handle it
                  $this->messagesAdd('skipping AlphaChannelFlatten() because image type is PNG and is 24bit which handles alpha', __FILE__, __LINE__);
                  return false;
                }
                // image has alpha transparency, but output as GIF which can handle only single-color transparency. So drop through to GIF processing.
                $this->messagesAdd('continuing AlphaChannelFlatten() because image type is PNG and is 8bit', __FILE__, __LINE__);

            case IMAGETYPE_GIF:
                // image has alpha transparency, but output as GIF which can handle only single-color transparency
                $CurrentImageColorTransparent = imagecolortransparent($this->outImageResourceID);
                if ($CurrentImageColorTransparent == -1) {
                    // no transparent color defined

                    if ($this->gd_version() < 2.0) {
                        $this->messagesAdd('AlphaChannelFlatten() failed because GD version is "'.$this->gd_version().'"', __FILE__, __LINE__);
                        return false;
                    }

                    if ($img_alpha_mixdown_dither = @ImageCreateTrueColor(ImageSX($this->outImageResourceID), ImageSY($this->outImageResourceID))) {

                        for ($i = 0; $i <= 255; $i++) {
                            $dither_color[$i] = ImageColorAllocate($img_alpha_mixdown_dither, $i, $i, $i);
                        }

                        // scan through current truecolor image copy alpha channel to temp image as grayscale
                        for ($x = 0; $x < $this->out_width; $x++) {
                            for ($y = 0; $y < $this->out_height; $y++) {
                                $PixelColor = $this->GetPixelColor($this->outImageResourceID, $x, $y);
                                imagesetpixel($img_alpha_mixdown_dither, $x, $y, $dither_color[($PixelColor['alpha'] * 2)]);
                            }
                        }

                        // dither alpha channel grayscale version down to 2 colors
                        imagetruecolortopalette($img_alpha_mixdown_dither, true, 2);

                        // reduce color palette to 256-1 colors (leave one palette position for transparent color)
                        imagetruecolortopalette($this->outImageResourceID, true, 255);

                        // allocate a new color for transparent color index
                        $TransparentColor = imagecolorallocate($this->outImageResourceID, 1, 254, 253);
                        imagecolortransparent($this->outImageResourceID, $TransparentColor);

                        // scan through alpha channel image and note pixels with >50% transparency
                        $TransparentPixels = array();
                        for ($x = 0; $x < $this->out_width; $x++) {
                            for ($y = 0; $y < $this->out_height; $y++) {
                                $AlphaChannelPixel = $this->GetPixelColor($img_alpha_mixdown_dither, $x, $y);
                                if ($AlphaChannelPixel['red'] > 127) {
                                    imagesetpixel($this->outImageResourceID, $x, $y, $TransparentColor);
                                }
                            }
                        }
                        $this->ImageSafeDestroy($img_alpha_mixdown_dither);

                        $this->messagesAdd('AlphaChannelFlatten() set image to 255+1 colors with transparency for GIF output', __FILE__, __LINE__);
                        return true;

                    } else {
                        $this->messagesAdd('AlphaChannelFlatten() failed ImageCreate('.ImageSX($this->outImageResourceID).', '.ImageSY($this->outImageResourceID).')', __FILE__, __LINE__);
                        return false;
                    }

                } else {
                    // a single transparent color already defined, leave as-is
                    $this->messagesAdd('skipping AlphaChannelFlatten() because ($this->type_text == "'.$this->type_text.'") and ImageColorTransparent returned "'.$CurrentImageColorTransparent.'"', __FILE__, __LINE__);
                    return true;
                }
                break;
                
            default:
                // process any unsupported image types
                $this->messagesAdd('continuing AlphaChannelFlatten() for output format "'.$this->type_text.'"', __FILE__, __LINE__);
        
                // image has alpha transparency, and is being output in a format that doesn't support it -- flatten
                if ($gdimg_flatten_temp = $this->ImageCreateFunction($this->out_width, $this->out_height)) {
        
                    if (!$this->IsHexColor($this->config_background_hexcolor)) {
                        return $this->messagesAdd('Invalid hex color string "'.$this->config_background_hexcolor.'" for parameter "config_background_hexcolor"');
                    }
                    $background_color = $this->ImageHexColorAllocate($this->outImageResourceID, $this->config_background_hexcolor);
                    ImageFilledRectangle($gdimg_flatten_temp, 0, 0, $this->out_width, $this->out_height, $background_color);
                    ImageCopy($gdimg_flatten_temp, $this->outImageResourceID, 0, 0, 0, 0, $this->out_width, $this->out_height);
        
                    ImageAlphaBlending($this->outImageResourceID, true);
                    ImageSaveAlpha($this->outImageResourceID, false);
                    ImageColorTransparent($this->outImageResourceID, -1);
                    ImageCopy($this->outImageResourceID, $gdimg_flatten_temp, 0, 0, 0, 0, $this->out_width, $this->out_height);
        
                    $this->ImageSafeDestroy($gdimg_flatten_temp);
                    return true;
        
                } else {
                    $this->messagesAdd('ImageCreateFunction() failed', __FILE__, __LINE__);
                }
                return false;
                
                break;
        }
    }

    function IsHexColor($HexColorString) {
        return eregi('^[0-9A-F]{6}$', $HexColorString);
    }

    function GetPixelColor(&$img, $x, $y) {
        if (!is_resource($img)) {
            return false;
        }
        return @imagecolorsforindex($img, @imagecolorat($img, $x, $y));
    }

    function ImageHexColorAllocate(&$gdimg_hexcolorallocate, $HexColorString, $dieOnInvalid=false, $alpha=false) {
        if (!is_resource($gdimg_hexcolorallocate)) {
            die('$gdimg_hexcolorallocate is not a GD resource in ImageHexColorAllocate()');
        }
        if ($this->IsHexColor($HexColorString)) {
            $R = hexdec(substr($HexColorString, 0, 2));
            $G = hexdec(substr($HexColorString, 2, 2));
            $B = hexdec(substr($HexColorString, 4, 2));
            return $this->ImageColorAllocateAlphaSafe($gdimg_hexcolorallocate, $R, $G, $B, $alpha);
        }
        if ($dieOnInvalid) {
            die('Invalid hex color string: "'.$HexColorString.'"');
        }
        return imagecolorallocate($gdimg_hexcolorallocate, 0x00, 0x00, 0x00);
    }

    function ImageColorAllocateAlphaSafe(&$gdimg_hexcolorallocate, $R, $G, $B, $alpha=false) {
        if ($alpha !== false) {
            return imagecolorallocatealpha($gdimg_hexcolorallocate, $R, $G, $B, intval($alpha));
        } else {
            return imagecolorallocate($gdimg_hexcolorallocate, $R, $G, $B);
        }
    }

    function ImageCreateFunction($x_size, $y_size) {
        $ImageCreateFunction = 'ImageCreate';
        if ($this->gd_version() >= 2.0) {
            $ImageCreateFunction = 'ImageCreateTrueColor';
        }
        if (!function_exists($ImageCreateFunction)) {
            return false;
        }
        return $ImageCreateFunction($x_size, $y_size);
    }

    // used to apply background color and removes all Alpha in destination resource
    function ImageCopyRespectAlphaFlatten(&$dst_im, &$src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct=100) {
        for ($x = $src_x; $x < $src_w; $x++) {
            for ($y = $src_y; $y < $src_h; $y++) {
                $RealPixel    = $this->GetPixelColor($dst_im, $dst_x + $x, $dst_y + $y);
                $OverlayPixel = $this->GetPixelColor($src_im, $x, $y);
                $alphapct = $OverlayPixel['alpha'] / 127;
                $opacipct = $pct / 100;
                $overlaypct = (1 - $alphapct) * $opacipct;

                $newcolor = $this->ImageColorAllocateAlphaSafe(
                    $dst_im,
                    round($RealPixel['red']   * (1 - $overlaypct)) + ($OverlayPixel['red']   * $overlaypct),
                    round($RealPixel['green'] * (1 - $overlaypct)) + ($OverlayPixel['green'] * $overlaypct),
                    round($RealPixel['blue']  * (1 - $overlaypct)) + ($OverlayPixel['blue']  * $overlaypct),
                    //$RealPixel['alpha']);
                    0);

                imagesetpixel($dst_im, $dst_x + $x, $dst_y + $y, $newcolor);
            }
        }
        return true;
    }

    // used to apply watermark opacity adjustement
    function ImageCreateTrueColorTransparent($x,$y) {
      $i = imagecreatetruecolor($x,$y);
      $b = imagecreatefromstring(base64_decode($this->BlankPNG()));
      imagealphablending($i,false);
      imagesavealpha($i,true);
      imagecopyresized($i,$b,0,0,0,0,$x,$y,imagesx($b),imagesy($b));
      return $i;
    }

    // used to apply watermark opacity adjustement
    function BlankPNG() {

      $c  = "iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29m";
      $c .= "dHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAADqSURBVHjaYvz//z/DYAYAAcTEMMgBQAANegcCBNCg";
      $c .= "dyBAAA16BwIE0KB3IEAADXoHAgTQoHcgQAANegcCBNCgdyBAAA16BwIE0KB3IEAADXoHAgTQoHcgQAAN";
      $c .= "egcCBNCgdyBAAA16BwIE0KB3IEAADXoHAgTQoHcgQAANegcCBNCgdyBAAA16BwIE0KB3IEAADXoHAgTQ";
      $c .= "oHcgQAANegcCBNCgdyBAAA16BwIE0KB3IEAADXoHAgTQoHcgQAANegcCBNCgdyBAAA16BwIE0KB3IEAA";
      $c .= "DXoHAgTQoHcgQAANegcCBNCgdyBAgAEAMpcDTTQWJVEAAAAASUVORK5CYII=";

      return $c;
    }

    // used to apply watermark opacity adjustement
    function ImageCopyRespectSourceAlpha(&$dst_im, &$src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct=100) {
        for ($x = $src_x; $x < $src_w; $x++) {
            for ($y = $src_y; $y < $src_h; $y++) {
                $RealPixel    = $this->GetPixelColor($dst_im, $dst_x + $x, $dst_y + $y);
                $OverlayPixel = $this->GetPixelColor($src_im, $x, $y);
                $alphapct = $OverlayPixel['alpha'] / 127;
                $opacipct = $pct / 100;
                $overlaypct = (1 - $alphapct) * $opacipct;

				// Handle opacity as alpha adjustment.
				$use_alpha = 127;
				$t = 127 - $OverlayPixel['alpha'];
				if ($t > 0) {
				  $use_alpha = $OverlayPixel['alpha'] + ($t * (1 - $opacipct));
				} elseif ($t < 0)  {
				  $use_alpha = 127 + ($t * $opacipct);
				}

                $newcolor = $this->ImageColorAllocateAlphaSafe(
                    $dst_im,
                    round($RealPixel['red']   * (1 - $overlaypct)) + ($OverlayPixel['red']   * $overlaypct),
                    round($RealPixel['green'] * (1 - $overlaypct)) + ($OverlayPixel['green'] * $overlaypct),
                    round($RealPixel['blue']  * (1 - $overlaypct)) + ($OverlayPixel['blue']  * $overlaypct),
                    $use_alpha);

                imagesetpixel($dst_im, $dst_x + $x, $dst_y + $y, $newcolor);
            }
        }
        return true;
    }

    // used to apply watermark
	function ImageCopyMergeAlpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
        // create a working space segment
        $cut = imagecreatetruecolor($src_w, $src_h);
        // create the opacity adjusted watermark working space segment
        $adj_wm = $this->ImageCreateTrueColorTransparent($src_w, $src_h);

        // copying destination section of the background to the segment and preserve the transparency
        imagealphablending($cut, false);
        imagecopyresampled($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h, $src_w, $src_h); // yes I know imagecopyresampled doesn't need to used for this particular application, but it's the only one that works to preserve the transparency correctly.  Prove me wrong!
        imagesavealpha($cut, true);

        // create the opacity adjusted watermark
        $this->ImageCopyRespectSourceAlpha($adj_wm, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h, $pct);

        // place the watermark over the background segment and preserve transparency of both
        imagealphablending($cut, true);
        imagesavealpha($cut, false);
        imagecopy($cut, $adj_wm, 0, 0, $src_x, $src_y, $src_w, $src_h);

        // copy segment back to destination image
		imagecopyresampled($dst_im, $cut, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $src_w, $src_h); // yes I know imagecopyresampled doesn't need to used for this particular application, but it's the only one that works to preserve the transparency correctly.  Prove me wrong!

		// clean up
		$this->ImageSafeDestroy($adj_wm);
		$this->ImageSafeDestroy($cut);
    } 

    // used for GIF image types
    function ImageResizeFunction(&$dst_im, &$src_im, $dstX, $dstY, $srcX, $srcY, $dstW, $dstH, $srcW, $srcH) {
        if ($this->gd_version() >= 2.0) {
            if ($this->config_disable_imagecopyresampled) {
                return $this->ImageCopyResampleBicubic($dst_im, $src_im, $dstX, $dstY, $srcX, $srcY, $dstW, $dstH, $srcW, $srcH);
            }
            return imagecopyresampled($dst_im, $src_im, $dstX, $dstY, $srcX, $srcY, $dstW, $dstH, $srcW, $srcH);
        }
        return imagecopyresized($dst_im, $src_im, $dstX, $dstY, $srcX, $srcY, $dstW, $dstH, $srcW, $srcH);
    }

    // used for GIF image types
    function ImageCopyResampleBicubic(&$dst_img, $src_img, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h) {
        // ron at korving dot demon dot nl
        // http://www.php.net/imagecopyresampled

        $scaleX = ($src_w - 1) / $dst_w;
        $scaleY = ($src_h - 1) / $dst_h;

        $scaleX2 = $scaleX / 2.0;
        $scaleY2 = $scaleY / 2.0;

        $isTrueColor = ImageIsTrueColor($src_img);

        for ($y = $src_y; $y < $src_y + $dst_h; $y++) {
            $sY   = $y * $scaleY;
            $siY  = (int) $sY;
            $siY2 = (int) $sY + $scaleY2;

            for ($x = $src_x; $x < $src_x + $dst_w; $x++) {
                $sX   = $x * $scaleX;
                $siX  = (int) $sX;
                $siX2 = (int) $sX + $scaleX2;

                if ($isTrueColor) {

                    $c1 = ImageColorAt($src_img, $siX, $siY2);
                    $c2 = ImageColorAt($src_img, $siX, $siY);
                    $c3 = ImageColorAt($src_img, $siX2, $siY2);
                    $c4 = ImageColorAt($src_img, $siX2, $siY);

                    $r = (( $c1             +  $c2             +  $c3             +  $c4            ) >> 2) & 0xFF0000;
                    $g = ((($c1 & 0x00FF00) + ($c2 & 0x00FF00) + ($c3 & 0x00FF00) + ($c4 & 0x00FF00)) >> 2) & 0x00FF00;
                    $b = ((($c1 & 0x0000FF) + ($c2 & 0x0000FF) + ($c3 & 0x0000FF) + ($c4 & 0x0000FF)) >> 2);

                } else {

                    $c1 = ImageColorsForIndex($src_img, ImageColorAt($src_img, $siX, $siY2));
                    $c2 = ImageColorsForIndex($src_img, ImageColorAt($src_img, $siX, $siY));
                    $c3 = ImageColorsForIndex($src_img, ImageColorAt($src_img, $siX2, $siY2));
                    $c4 = ImageColorsForIndex($src_img, ImageColorAt($src_img, $siX2, $siY));

                    $r = ($c1['red']   + $c2['red']   + $c3['red']   + $c4['red'] )  << 14;
                    $g = ($c1['green'] + $c2['green'] + $c3['green'] + $c4['green']) <<  6;
                    $b = ($c1['blue']  + $c2['blue']  + $c3['blue']  + $c4['blue'] ) >>  2;

                }
                ImageSetPixel($dst_img, $dst_x + $x - $src_x, $dst_y + $y - $src_y, $r+$g+$b);
            }
        }
        return true;
    }

    function gd_version($fullstring=false) {
        static $cache_gd_version = array();
        if (empty($cache_gd_version)) {
            $gd_info = gd_info();
            if (eregi('bundled \((.+)\)$', $gd_info['GD Version'], $matches)) {
                $cache_gd_version[1] = $gd_info['GD Version'];  // e.g. "bundled (2.0.15 compatible)"
                $cache_gd_version[0] = (float) $matches[1];     // e.g. "2.0" (not "bundled (2.0.15 compatible)")
            } else {
                $cache_gd_version[1] = $gd_info['GD Version'];                       // e.g. "1.6.2 or higher"
                $cache_gd_version[0] = (float) substr($gd_info['GD Version'], 0, 3); // e.g. "1.6" (not "1.6.2 or higher")
            }
        }
        return $cache_gd_version[intval($fullstring)];
    }

    function CheckResouce($resource, $line_number) {
        if ( is_resource($resource) && get_resource_type($resource) == 'gd' ) {
          $this->messagesAdd($resource.' is a resource.', __FILE__, $line_number);
        } else {
          $this->messagesAdd('NOT A GD RESOURCE.', __FILE__, $line_number);
          return false;
        }// end if (GD)
        return true;
    }


/*
// unused functions.

    // PNG ALPHA CHANNEL SUPPORT for imagecopymerge();
    // This is a function like imagecopymerge but it handle alpha channel well!!!
    function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
        $opacity=$pct;
        // getting the watermark width
        $w = imagesx($src_im);
        // getting the watermark height
        $h = imagesy($src_im);
        
        // creating a cut resource
        $cut = imagecreatetruecolor($src_w, $src_h);
        // copying that section of the background to the cut
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
        // inverting the opacity
        $opacity = 100 - $opacity;
        
        // placing the watermark now
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $opacity);

		imagedestroy($cut);
    }

    function imagetruecolortopalette2(&$image, $dither, $ncolors) {
      $width = imagesx( $image );
      $height = imagesy( $image );
      $colors_handle = ImageCreateTrueColor( $width, $height );
      ImageCopyMerge( $colors_handle, $image, 0, 0, 0, 0, $width, $height, 100 );
      imagetruecolortopalette( $image, $dither, $ncolors );
      ImageColorMatch( $colors_handle, $image );
      ImageDestroy($colors_handle);
      return true;
    }
    
    function imagemergealpha(&$targetImg,$overlayImg,$px,$py) {

      $w = imagesx($overlayImg);
      $h = imagesy($overlayImg);
    
      imagealphablending($targetImg,true);
      imagecopymerge($targetImg,$overlayImg,$px,$py,0,0,$w,$h,100);

      //restore the transparency
      imagealphablending($targetImg,false);
      for($x=$px;$x<($w+$px);$x++) {
        for($y=$py;$y<($h+$py);$y++) {
          $c = imagecolorat($targetImg,$x,$y);
          $c = imagecolorsforindex($targetImg,$c);
          $ta = imagecolorat($overlayImg,($x-$px),($y-$py));
          $ta = imagecolorsforindex($overlayImg,$ta);
          $t = 127-$ta['alpha'];
          $t = ($t > 127) ? 127 : $t;
          $t = 127-$t;
          $c = imagecolorallocatealpha($targetImg,$c['red'],$c['green'],$c['blue'],$t);
          imagesetpixel($targetImg,$x,$y,$c);
        }
      }
      imagesavealpha($targetImg,true);
      return true;
    }
*/


  } // end: class alterimage {}

?>