<script language="javascript" type="text/javascript"><!--
var selected;

function selectRowEffect(object, buttonSelect) {
  if (!selected) {
    if (document.getElementById) {
      selected = document.getElementById('defaultSelected');
    } else {
      selected = document.all['defaultSelected'];
    }
  }

  if (selected) selected.className = 'moduleRow';
  object.className = 'moduleRowSelected';
  selected = object;

// one button is not an array
  if (document.checkout_address.shipping[0]) {
    document.checkout_address.shipping[buttonSelect].checked=true;
  } else {
    document.checkout_address.shipping.checked=true;
  }
}

function rowOverEffect(object) {
  if (object.className == 'moduleRow') object.className = 'moduleRowOver';
}

function rowOutEffect(object) {
  if (object.className == 'moduleRowOver') object.className = 'moduleRow';
}

//BOF osc_Giftwrap
function selectRowEffectGift(object, buttonSelect) {
 if (!selectedgift) {
   if (document.getElementById) {
     selectedgift = document.getElementById('defaultSelectedGift');
   } else {
     selectedgift = document.all['defaultSelectedGift'];
   }
 }

 if (selectedgift) selectedgift.className = 'moduleRow';
 object.className = 'moduleRowSelected';
 selectedgift = object;

// one button is not an array
 if (document.checkout_address.giftwrap[0]) {
   document.checkout_address.giftwrap[buttonSelect].checked=true;
 } else {
   document.checkout_address.giftwrap.checked=true;
 }
}

function rowOverEffectGift(object) {
 if (object.className == 'moduleRow') object.className = 'moduleRowOver';
}

function rowOutEffectGift(object) {
 if (object.className == 'moduleRowOver') object.className = 'moduleRow';
}

$(document).ready(function(){
	$('#giftwrapcard_heading').css('display','none');
	$('#giftwrapcard_box').css('display','none');
	$('#giftwrap_message_title').css('display','none');
	$('#giftwrap_message_field').css('display','none');
	
	if($('input[name=giftwrap]').is(':checked')){
		//show card message
		$("#giftwrapcard_heading").show("fast");
		$("#giftwrapcard_box").show("fast");
	}
	
	if($('input[name=giftwrap_card]').is(':checked')){
		$("#giftwrap_message_title").hide("fast");
		$("#giftwrap_message_field").hide("fast");
	}
	
	
	// Add onclick handler to checkbox w/id checkme
	$("#giftwrap_checkbox").click(function(){
		// If checked
		if ($("#giftwrap_checkbox").is(":checked")){
			//show the hidden div
			$("#giftwrapcard_heading").show("fast");
			$("#giftwrapcard_box").show("fast");
		}else{     
			//otherwise, hide it
			$("#giftwrapcard_heading").hide("fast");
			$("#giftwrapcard_box").hide("fast");
			$("#giftwrap_message_title").hide("fast");
			$("#giftwrap_message_field").hide("fast");
			
			//uncheck giftwrapcard_box
			if($('input[name=giftwrap_card]').is(':checked')){
				$('input[name=giftwrap_card]').attr('checked', false);
			}
		}
	});
	
	$("#giftwrap_card_checkbox").click(function(){
		// If checked
		if ($("#giftwrap_card_checkbox").is(":checked")){
			//show the hidden div
			$("#giftwrap_message_title").show("fast");
			$("#giftwrap_message_field").show("fast");
		}else{     
			//otherwise, hide it
			$("#giftwrap_message_title").hide("fast");
			$("#giftwrap_message_field").hide("fast");
		}
	});

});
//EOF osc_Giftwrap
//--></script>
