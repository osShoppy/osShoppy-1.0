<?php // scrolling_best_sellers infobox

  if (isset($current_category_id) && (current_category_id >0)){
    $rp_query = tep_db_query("select distinct p.products_id, p.products_price, p.products_image, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where p.products_status = '1' and p.products_ordered > 0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and '" . (int)$current_category_id . "' in (c.categories_id, c.parent_id) order by p.products_ordered desc, pd.products_name limit " . MAX_DISPLAY_BESTSELLERS);

// activate inactivate category /Step-1(1)\
  } elseif (!empty($hiddencats)) {
    $rp_query = tep_db_query("select distinct p.products_id, p.products_price, p.products_image, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and p.products_ordered > 0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id and (not (p2c.categories_id in (" . implode(',', $hiddencats) . "))) order by p.products_ordered desc, pd.products_name limit " . MAX_DISPLAY_BESTSELLERS);
  } else {
    $rp_query = tep_db_query("select distinct p.products_id, p.products_price, p.products_image, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_ordered > 0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_ordered desc, pd.products_name limit " . MAX_DISPLAY_BESTSELLERS);
  }


  if (tep_db_num_rows($rp_query)) {

	$i = 0;
    while ($random_product = tep_db_fetch_array($rp_query)) {
	$pausecontent_bs[$i] = "<center><br><a href=\'" . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product["products_id"]) . "\'>" . tep_image(DIR_WS_IMAGES . $random_product['products_image'], tep_output_string($random_product['products_name'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;', '&' => '&amp;')), BESTSELLERS_SCROLLING_INFOBOX_IMAGE_WIDTH, BESTSELLERS_SCROLLING_INFOBOX_IMAGE_HEIGHT) . "</a><br/><a href=\'" . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . "\'>" . tep_output_string($random_product['products_name'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;', '&' => '&amp;')) . "</a><br/>";
//	if (intval($random_product['specials_new_products_price']) > 0) {
//		$pausecontent_bs[$i] .= "<s>" . $currencies->display_price($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . "</s><br/><span class=\'productSpecialPrice\'>" . $currencies->display_price($random_product['specials_new_products_price'], tep_get_tax_rate($random_product['products_tax_class_id']))."</span></centre><br/><br/>";
//    } else {
//		$pausecontent_bs[$i] .= "<span class=\'productSpecialPrice\'>" . $currencies->display_price($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . "</s><br/></centre><br/><br/>";
//    }
		$i++;
    }

?>
<?php
  }
?>
<script type="text/javascript">
//<![CDATA[
/* merge server php and client javascript arrays */
var pausecontent_bs=new Array();
<?php
$i = 0;
while ($pausecontent_bs[$i]) {
	echo "pausecontent_bs[".$i."] = '".$pausecontent_bs[$i]."';
	
";
	$i++;
}
?>
//]]>
</script>
<script type="text/javascript">
//<![CDATA[
function pausescroller(content, divId, divClass, delay){
this.content=content //message array content
this.tickerid=divId //ID of ticker div to display information
this.delay=delay //Delay between msg change, in miliseconds.
this.mouseoverBol=0 //Boolean to indicate whether mouse is currently over scroller (and pause it if it is)
this.hiddendivpointer=1 //index of message array for hidden div
document.write('<div id="'+divId+'" class="'+divClass+'" style="position: relative; display:block; overflow: hidden;"><div class="innerDiv" style="position: absolute; width: 100%;" id="'+divId+'1">'+content[0]+'</div><div class="innerDiv" style="position: relative; width: 100%; visibility: hidden" id="'+divId+'2">'+content[1]+'</div></div>')
var scrollerinstance=this
if (window.addEventListener) //run onload in DOM2 browsers
window.addEventListener("load", function(){scrollerinstance.initialize()}, false)
else if (window.attachEvent) //run onload in IE5.5+
window.attachEvent("onload", function(){scrollerinstance.initialize()})
else if (document.getElementById) //if legacy DOM browsers, just start scroller after 0.5 sec
setTimeout(function(){scrollerinstance.initialize()}, 500)
}

// -------------------------------------------------------------------
// initialize()- Initialize scroller method.
// -Get div objects, set initial positions, start up down animation
// -------------------------------------------------------------------

pausescroller.prototype.initialize=function(){
this.tickerdiv=document.getElementById(this.tickerid)
this.visiblediv=document.getElementById(this.tickerid+"1")
this.hiddendiv=document.getElementById(this.tickerid+"2")
this.visibledivtop=parseInt(pausescroller.getCSSpadding(this.tickerdiv))
//set width of inner DIVs to outer DIV's width minus padding (padding assumed to be top padding x 2)
this.visiblediv.style.width=this.hiddendiv.style.width=this.tickerdiv.offsetWidth-(this.visibledivtop*2)+"px"
this.getinline(this.visiblediv, this.hiddendiv)
this.hiddendiv.style.visibility="visible"
var scrollerinstance=this
document.getElementById(this.tickerid).onmouseover=function(){scrollerinstance.mouseoverBol=1}
document.getElementById(this.tickerid).onmouseout=function(){scrollerinstance.mouseoverBol=0}
if (window.attachEvent) //Clean up loose references in IE
window.attachEvent("onunload", function(){scrollerinstance.tickerdiv.onmouseover=scrollerinstance.tickerdiv.onmouseout=null})
setTimeout(function(){scrollerinstance.animateup()}, this.delay)
}


// -------------------------------------------------------------------
// animateup()- Move the two inner divs of the scroller up and in sync
// -------------------------------------------------------------------

pausescroller.prototype.animateup=function(){
var scrollerinstance=this
if (parseInt(this.hiddendiv.style.top)>(this.visibledivtop+5)){
this.visiblediv.style.top=parseInt(this.visiblediv.style.top)-5+"px"
this.hiddendiv.style.top=parseInt(this.hiddendiv.style.top)-5+"px"
setTimeout(function(){scrollerinstance.animateup()}, 50)
}
else{
this.getinline(this.hiddendiv, this.visiblediv)
this.swapdivs()
setTimeout(function(){scrollerinstance.setmessage()}, this.delay)
}
}

// -------------------------------------------------------------------
// swapdivs()- Swap between which is the visible and which is the hidden div
// -------------------------------------------------------------------

pausescroller.prototype.swapdivs=function(){
var tempcontainer=this.visiblediv
this.visiblediv=this.hiddendiv
this.hiddendiv=tempcontainer
}

pausescroller.prototype.getinline=function(div1, div2){
div1.style.top=this.visibledivtop+"px"
div2.style.top=Math.max(div1.parentNode.offsetHeight, div1.offsetHeight)+"px"
}

// -------------------------------------------------------------------
// setmessage()- Populate the hidden div with the next message before it's visible
// -------------------------------------------------------------------

pausescroller.prototype.setmessage=function(){
var scrollerinstance=this
if (this.mouseoverBol==1) //if mouse is currently over scoller, do nothing (pause it)
setTimeout(function(){scrollerinstance.setmessage()}, 100)
else{
var i=this.hiddendivpointer
var ceiling=this.content.length
this.hiddendivpointer=(i+1>ceiling-1)? 0 : i+1
this.hiddendiv.innerHTML=this.content[this.hiddendivpointer]
this.animateup()
}
}

pausescroller.getCSSpadding=function(tickerobj){ //get CSS padding value, if any
if (tickerobj.currentStyle)
return tickerobj.currentStyle["paddingTop"]
else if (window.getComputedStyle) //if DOM2
return window.getComputedStyle(tickerobj, "").getPropertyValue("padding-top")
else
return 0
}

//new pausescroller(pausecontent, "pscroller1", "someclass", 2000);
//]]>
</script>
<?php
$scroller = "<script type='text/javascript'>new pausescroller(pausecontent_bs, 'pscroller_bs', 'pscroller_c_bs', 2000);</script>";

  $boxHeading = BOX_HEADING_BESTSELLERS;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $boxLink = '<a href="' . tep_href_link(FILENAME_BEST_SELLERS) . '"><img src="images/infobox/arrow_right.gif" border="0" alt="more" title=" more " width="12" height="10"></a>';
  $box_base_name = 'scrolling_best_sellers';
  $box_id = $box_base_name . 'Box';

  $boxContent = $scroller;

  include (bts_select('boxes', $box_base_name));
  $boxLink = '';
?>
</div>