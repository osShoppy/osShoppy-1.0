<?php //$Id: /catalog/includes/classes/pad_single_radioset.php (0888)

  require_once(DIR_WS_CLASSES . 'pad_single_dropdown.php');

  class pad_single_radioset extends pad_single_dropdown {


/*
    Method: _draw_stocked_attributes
  
    draw dropdown lists for attributes that stock is tracked for

  
    Parameters:
  
      none
  
    Returns:
  
      string:         HTML to display dropdown lists for attributes that stock is tracked for
  
*/
    function _draw_stocked_attributes() {
      global $languages_id;
      
      $out='';
      
      $attributes = $this->_build_attributes_array(true, false);
      if (sizeof($attributes)>0) {
        $combinations = array();
        $selected_combination = 0;
        $this->_build_attributes_combinations($attributes, $this->show_out_of_stock == 'True', $this->mark_out_of_stock, $combinations, $selected_combination);
    
        $combname='';
        foreach ($attributes as $attrib) {
          $combname.=', '.$attrib['oname'];
        }
        $combname=substr($combname,2).':';
        
        foreach ($combinations as $combindex => $comb) {
          $out.="<tr>\n";
          $out.='  <td align="right" class=main><b>'.$combname."</b></td>\n  <td class=main>";
          $out.=tep_draw_radio_field('attrcomb', $combinations[$combindex]['id'], ($combindex==$selected_combination)) . $comb['text'];
          $out.="</td>\n";
          $out.="</tr>\n";
          $combname='';
        }
      }
      
      $out.=$this->_draw_out_of_stock_message_js($attributes);
      
      return $out;
    }

  }
?>
