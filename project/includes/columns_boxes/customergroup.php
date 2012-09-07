<?php // customergroup_column infobox 

  $boxHeading = BOX_HEADING_CUSTOMERGROUP;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  //$boxLink = '<a href="' . tep_href_link(FILENAME_DEFAULT) . '"><img src="images/infobox/arrow_right_3.gif" border="0" alt="more" title="more" width="12" height="10"></a>';
  //$boxContent_attributes = ' align="center"';
  $box_base_name = 'customergroup_column';
 
  $info_box_contents = array();
 
  if (tep_session_is_registered('customer_first_name') && tep_session_is_registered('customer_id')) {
    if ($customer_group_id == '0' ) { //Retail //Standaard Klanten-Groep waar iedereen terecht komt!
  	  $groupcontent = TEXT_SPPC_RETAIL;
	}
    if ($customer_group_id == '1' ) { //Kortingsgroep: 1 // er even van uitgaande dat de groothandel die id heeft
  	  $groupcontent = TEXT_SPPC_COMPANY_1;
	}
    if ($customer_group_id == '2' ) { //Kortingsgroep: 2 // er even van uitgaande dat de groothandel die id heeft
  	  $groupcontent = TEXT_SPPC_COMPANY_2;
	}
    if ($customer_group_id == '3' ) { //Kortingsgroep: 3 // er even van uitgaande dat de groothandel die id heeft
  	  $groupcontent = TEXT_SPPC_COMPANY_3;
}
    if ($customer_group_id == '4' ) { //Kortingsgroep: 4 // er even van uitgaande dat de groothandel die id heeft
  	  $groupcontent = TEXT_SPPC_COMPANY_4;
}
    if ($customer_group_id == '5' ) { //Kortingsgroep: 5 // er even van uitgaande dat de groothandel die id heeft
  	  $groupcontent = TEXT_SPPC_COMPANY_5;
}
    if ($customer_group_id == '6' ) { //Consument // er even van uitgaande dat de groothandel die id heeft
  	  $groupcontent = TEXT_SPPC_COMPANY_6;
}
    if ($customer_group_id == '7' ) { //Bedrijven // er even van uitgaande dat de groothandel die id heeft
  	  $groupcontent = TEXT_SPPC_COMPANY_7;
}
    if ($customer_group_id == '8' ) { //'' // er even van uitgaande dat de groothandel die id heeft
  	  $groupcontent = TEXT_SPPC_COMPANY_8;
}
    if ($customer_group_id == '9' ) { //'' // er even van uitgaande dat de groothandel die id heeft
  	  $groupcontent = TEXT_SPPC_COMPANY_9;
}
    if ($customer_group_id == '10' ) { //'' // er even van uitgaande dat de groothandel die id heeft
  	  $groupcontent = TEXT_SPPC_COMPANY_10;
}
 
  } else {
  	  $groupcontent = TEXT_SPPC_LOGGED_OFF;
}

  $box_id = $box_base_name . 'Box';
  $boxContent = $groupcontent;
  include (bts_select('boxes', $box_base_name));
  //$boxContent_attributes = '';
  //$boxLink = '';
?>