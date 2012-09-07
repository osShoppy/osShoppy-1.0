<?php // $Id: /catalog/admin/includes/languages/dutch/manual/manual_shipping_tnt.php

define('TEXT_TITLE', 'TNT post Verzending!');

define('TEXT_MAIN_HEADER', 'Volg de instructies goed op om TNT verzending goed te laten integreren in je webwinkel<br>
	   Check voor de laatste post tarieven op <a href="http://www.tntpost.nl" target=_blank>tntpost.nl</a>!');

define('TEXT_MAIN_CONTENT', '
Complete description of the shipping module tntpostf:

<br><br>                 
It\'s first important to have the official document from TNT (download from www.tntpost.nl or
get it from your local post office) about the rates and possibilities for shipping, to follow
this description better. 

<br><br>                 
This module uses ONLY the next shipping options in ADMIN under configuration:
- maximum box weight (must be at least 10000 grams otherwise this module doesn\'t display;
                      otherwise some TNT rates are not used efficient for the customer)  
- average weight package materials (used only for packages, not for letters)  

<br><br>                 
When a COD option is chosen, only the payment module "cash" will be displayed. If you haven\'t
this module installed your old list of payment modules will be displayed. If you want another
payment module for COD, change in the source "payment.php", "cash.php" to your module name.

<br><br>                 
All the rates to fill in ADMIN for this module "tntpostf" must be the rates without VAT, because
VAT is calculated by law over the shipping costs (use 19% for EU). When you buy a box for instance
at the post office you get the VAT back as shop-owner, for this box VAT is calculated in the total
shipping costs (your box is part of that) for the customer.

<br><br>                 
When you use multiple boxes for shipping, you have to pay the full shipping amount for every box.
So sending two boxes of 10000 grams is more expensive then to send only one box of 20000 grams !

<br><br>                 
All the possible TNT rates are used in this software except for batches (e.g. discounts for at
least 10 boxes). Also no franking machine rates are used (but are always lower, so your advantage). 

<br><br>                 
IMPORTANT: all rates must be filled because of the software even when you don\'t use these rates.
           These rates are already filled in for 2007. Don\'t forget to change the rates for next
           years !

<br><br>                 
The meaning of new options in your product definitions:

<br><br>                 
TNT shipping 
- 0 = no TNT ; this product may not be shipped by TNT (e.g. too heavy or too big)  
- 1 = letter ; fits into a letter-box
- 2 = letter-box-book ; book fits into a letter-box 
- 3 = book ; can be send outside NL as a book package, lower rate !
- 4 = package ; only package rates applicable

<br><br>                 
TNT sealbag 
- 0 = no sealbag necessary for an insured shipment
- 1 = sealbag necessay for an insured shipment

<br><br>                 
TNT clearings-service
- 0 = no TNT clearings-service using/necessary when send outside NL
- 1 = use TNT clearings-service when send outside NL because clearing must be by law for this product

<br><br>                 
The meaning of options in ADMIN for module "tntpostf":
<br><br>                 
- all rates must be filled in even when you not enable them (for the good working of the software) 
- all options for shipping can be enabled or disabled (for instance you want only insured shipments)
- multiple boxes are only possible for the best rate or for insured shipments 
<br><br>                 
      Used logic:
<br><br>                 
- if at least one product on the shopping cart is "no TNT", the TNT module is not displayed<br>
- if the maximum box weight is lower 10000 grams in ADMIN, the TNT module is not displayed<br>
- if at least one product on the shopping cart is a "package", the whole shipment is a "package"<br>
- if at least one product is a "book" and other products are only "book" and/or "letter-box-book",<br>
  the whole shipment is a "book" package when send outside NL, otherwise a "package"<br>
- if at least 2 products are "letter-box-book" on the shopping cart, the whole shipment is a "package"<br>
- if all products on the shopping cart are "letter" and/or 1 "letter-box-book", the whole shipment<br>
  is a "letter" (in case of not all can be bundled in one envelop, using two envelopes is cheaper<br>
  than a "package" rate in most cases)      <br>
- if the whole shipment is a "letter" and the weight is greater than the maximum weight of a normal<br>
  letter, the whole shipment will be a "package"<br>
- if not one "letter" shipment is enabled, the whole shipment will be a "package" in case it is a<br>
  "letter" shipment  <br>
- if the whole shipment is a "book" package and the weight is greater than the maximum weight of a<br>
  "book" package, the whole shipment will be a "package" <br>
- if not one "book" shipment is enabled, the whole shipment will be a "package" in case it is a <br>
  "book" package <br>
- a rate class option will not be displayed if the weight is greater than the maximum weight for that<br>
  rate class option AND no multiple boxes are allowed/enabled for that option       <br>
<br><br>                 
');

define('TEXT_RIGHT_CONTENT', 'Plaats hier handige Tips!');

define('TEXT_INFO_CONTENT', 'Zet hier extra informatie neer!');

define('TEXT_NOTICE_CONTENT', 'Plaats hier de belangrijke opmerkingen neer!');

define('TEXT_RELATED_CONTENT', 'Zet hier de links naar verwante onderwerpen neer!');

?>
