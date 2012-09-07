<?php
$phpOnline_base_url = "http://".STORE_URL."/live_support";

// Type of Status Indicator: 
//    1 -> Dynamic (Flash Based)     
//    2 -> Statis (image based)
// Note that image based indicator has added on phpOnline 1.5.1
$phponline_status_indicator_type = 2;
?>

<script language="javascript"><!--
function phpOnlinePopupWindow() {
var url = "<?php echo $phpOnline_base_url.'/client.php';?>";
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,width=550,height=400,screenX=150,screenY=150,top=150,left=150')
}
//--></script>
</head>

<?php 

  $boxHeading = BOX_HEADING_LIVE_SUPPORT;
  $corner_top_left = 'rounded_1';
  $corner_top_right = 'rounded_1';
  $corner_bot_left = 'rounded_1';
  $corner_bot_right = 'rounded_1';
  $box_base_name = 'live_support_column'; // for easy unique box template setup (added BTSv1.2)

$phponline_info_box = array(); 
if($phponline_status_indicator_type==1)
{

	$phpOnlineFlashIndicator  = '<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" HEIGHT="60" WIDTH="120" id="status" ALIGN="" border="0">';
	$phpOnlineFlashIndicator .= '<param name="base" value="'.$phpOnline_base_url.'/"><PARAM NAME=movie VALUE="'.$phpOnline_base_url.'/status.swf"><PARAM NAME=menu VALUE=false><PARAM NAME=quality VALUE=High> <PARAM NAME=bgcolor VALUE=#ffffff><param name="salign" value="TL"><param name="scale" value="NoBorder">';
	$phpOnlineFlashIndicator .= '<EMBED base="'.$phpOnline_base_url.'/" src="'.$phpOnline_base_url.'/status.swf" menu=false quality=High bgcolor=#ffffff  NAME="status" ALIGN="" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer" salign="TL" width="120" height="60" scale="NoBorder"></EMBED></OBJECT>';

		    $live_support = '<center>';
        	$live_support .= $phpOnlineFlashIndicator;
		    $live_support .= '</center>';

}
if($phponline_status_indicator_type==2)
{
		    $live_support = '<center>';
			$live_support .= '<a href="javascript:phpOnlinePopupWindow()">' . tep_image($phpOnline_base_url.'/statusimage.php' , BOX_INFORMATION_PHPONLINE ).  '</a><br>';
		    $live_support .= '</center>';
}

  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

  $boxContent = $live_support;

include (bts_select('boxes', $box_base_name)); // BTS 1.5

?>
