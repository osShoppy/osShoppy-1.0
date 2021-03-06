<?php // catalog/includes/modules/matc.php (5750)

//We shall now create the disabled looking button... If it doesn't exits allready and is needed
	if(MATC_BUTTONSTYLE == 'gray' && version_compare(PHP_VERSION, "5") == -1){
		die('Your php version is to low to use gray buttons in the MATC extension for oscommerce. Please change "Disabled buttonstyle" in your oscommerce admin panel.');
	}
	if(!file_exists(DIR_WS_LANGUAGES . $language . '/images/buttons/button_continue_disabled.png') && MATC_BUTTONSTYLE == 'gray'){
		$TempImage = imagecreatefromgif(DIR_WS_LANGUAGES . $language . '/images/buttons/button_continue.gif');
		imagefilter($TempImage, IMG_FILTER_GRAYSCALE); //Make the button gray...
		imagefilter($TempImage, IMG_FILTER_BRIGHTNESS, 35); //And a little bit brighter
		imagegif($TempImage, DIR_WS_LANGUAGES . $language . '/images/buttons/button_continue_disabled.gif');
		imagedestroy($TempImage);
	}
?>

<script type="text/javascript" src="includes/jquery.js"></script>
<script type="text/javascript" src="includes/jquery.color.js"></script>
<script type="text/javascript"><!--
function disablebutton(){
	$("#TheSubmitButton").attr("disabled","disabled").hide();  //This disables and hides TheSubmitButton
	$("#TheDisabledButton").fadeIn(300);
}

function enablebutton(){
	$("#TheSubmitButton").removeAttr("disabled").fadeIn(300);//This enables and shows the TheSubmitButton.  
	$("#TheDisabledButton").hide();
}

function updatebutton(){
	if($("#TermsAgree").attr("checked")){
		enablebutton();
	}else{
		disablebutton();
	}
}
	
function warningon(){
	if(!$("#TermsAgree").attr("checked")){
		$("#CAparagraph").animate({backgroundColor: "#CCCCCC"}, 500);
	}
}
	
function warningoff(){
	$("#CAparagraph").animate({backgroundColor: "#FFFFFF"}, 500);
}

//Initiate everything
$(document).ready(function(){
  	$("#TheSubmitButton").after('<?php 
	if(MATC_BUTTONSTYLE == 'gray'){
		echo tep_image(DIR_WS_LANGUAGES . $language . '/images/buttons/button_continue_disabled.png', '', '', '', ' id="TheDisabledButton" style="display:none;cursor:not-allowed;" onMouseOut="warningoff()" onMouseOver="warningon()"'); 
	}else{
		echo tep_image(DIR_WS_LANGUAGES . $language . '/images/buttons/button_continue_disabled.png', '', '', '', ' id="TheDisabledButton" style="display:none;cursor:not-allowed;filter:alpha(opacity=33);-moz-opacity:.33;opacity:.33;" onMouseOut="warningoff()" onMouseOver="warningon()"'); 
	} ?>');
	
	if(!$("#TermsAgree").attr("checked")){ //if it isnt checked the button should be disabled
		disablebutton();
	}
});

//--></script>

<?php 
if(MATC_SHOW_TEXTAREA != 'false'){ //START "show the textarea if"
	if(MATC_TEXTAREA_FILENAME != ''){//There is a file we should require
		require(DIR_WS_LANGUAGES . $language . '/' . MATC_TEXTAREA_FILENAME);
	}
	
	if(MATC_TEXTAREA_MODE == 'Returning code'){
		eval('$textarea_contents_material ='.MATC_TEXTAREA_RETURNING_CODE.';');
	}elseif(MATC_TEXTAREA_MODE == 'SQL'){
		eval('$contents_query = tep_db_query('.MATC_TEXTAREA_SQL.');');
   		$contents_query_array = tep_db_fetch_array($contents_query);
		$textarea_contents_material = $contents_query_array['thetext'];
	}else{
		die('No mode was catched! Search for "qwetyqouty34657+234" in matc.php fo find the place where the error occured.'); //Just for error checking.
	};
	
	if(MATC_TEXTAREA_HTML_2_PLAIN_TEXT_CONVERT  != 'false'){ //Use the conversion tool
		require_once(DIR_WS_CLASSES.'html2text.php');// Include the class definition file.
		$h2t =& new html2text(html_entity_decode($textarea_contents_material,ENT_QUOTES,'ISO8859-1'));// Instantiate a new instance of the class. Passing the string variable automatically loads the HTML for you.
		$h2t->width=0; //Do not use word wrap
		$textarea_contents = $h2t->get_text();// Simply call the get_text() method for the class to convert the HTML to the plain text. Store it into the variable.
	}else{//Use the "raw material", that is we do not convert it to plain text
		$textarea_contents = $textarea_contents_material;
	};
?>
<tr>
	<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
</tr>
<tr>
	<td class="main"><b><?php echo MATC_HEADING_CONDITIONS; ?></b></td>
</tr>
<tr>
	<td>
		<textarea name="conditions" class="small" rows="14" readonly ><?php echo $textarea_contents; ?></textarea>
	</td>
</tr>
<?php 
}//End "show the textarea if"
?>

<tr>
	<td align="center" id="CAparagraph" class="main" width="80%">
		<?php 
			if(MATC_SHOW_LINK != 'false'){
				echo sprintf(MATC_CONDITION_AGREEMENT, tep_href_link(MATC_FILENAME, MATC_PARAMETERS));
			}else{
				echo strip_tags(MATC_CONDITION_AGREEMENT);
			}
			
			echo tep_draw_checkbox_field('TermsAgree','true', false, 'id="TermsAgree" onMouseOut="updatebutton()" onMouseOver="updatebutton()"'); 
		?>
	</td>
</tr>
<tr>
	<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
</tr>
