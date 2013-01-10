<?php //$Id: /catalog/install/sample_data_radio_control.php 
	  // 30 producten
	  // product 31 tot en met 60

function install() {
      tep_db_query("insert into " . TABLE_CATEGORIES . " values('1', 'categories/radiocontrol/category_trainer.gif', '0', '1', now(), null, '1')");
    }
?>

