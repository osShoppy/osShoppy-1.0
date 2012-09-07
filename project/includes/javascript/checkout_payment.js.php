<script language="javascript" type="text/javascript"><!--
var selected;

<?php // bof - credit class gift voucher 6 ?>
var submitter = null;
function submitFunction() {
   submitter = 1;
   }
<?php // eof - credit class gift voucher ?>

function selectRowEffect(object, buttonSelect) {
// bof - credit class gift voucher 7
  if (!document.checkout_payment.payment[0].disabled){
// eof - credit class gift voucher
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
  if (document.checkout_payment.payment[0]) {
    document.checkout_payment.payment[buttonSelect].checked=true;
  } else {
    document.checkout_payment.payment.checked=true;
  }
// bof - credit class gift voucher 8
  }
// eof - credit class gift voucher
}

function rowOverEffect(object) {
  if (object.className == 'moduleRow') object.className = 'moduleRowOver';
}

function rowOutEffect(object) {
  if (object.className == 'moduleRowOver') object.className = 'moduleRow';
}
<?php
// bof - credit class gift voucher 9
if (MODULE_ORDER_TOTAL_INSTALLED)
	$temp=$order_total_modules->process();
	$temp=$temp[count($temp)-1];
	$temp=$temp['value'];

	$gv_query = tep_db_query("select amount from " . TABLE_COUPON_GV_CUSTOMER . " where customer_id = '" . $customer_id . "'");
	$gv_result = tep_db_fetch_array($gv_query);

if ($gv_result['amount']>=$temp){ $coversAll=true;

?>
  function clearRadeos(){
    document.checkout_payment.cot_gv.checked=!document.checkout_payment.cot_gv.checked;
    for (counter = 0; counter < document.checkout_payment.payment.length; counter++) {
      // If a radio button has been selected it will return true
      // (If not it will return false)
      if (document.checkout_payment.cot_gv.checked){
        document.checkout_payment.payment[counter].checked = false;
        document.checkout_payment.payment[counter].disabled=true;
      } else {
        document.checkout_payment.payment[counter].disabled=false;
      }
    }
  }
<?php
} else { 
  $coversAll=false;?>

  function clearRadeos(){
    document.checkout_payment.cot_gv.checked=!document.checkout_payment.cot_gv.checked;
  }<?php } ?>
//--></script>
<?php echo $payment_modules->javascript_validation($coversAll); ?>
<?php 
// eof - credit class gift voucher ?>
