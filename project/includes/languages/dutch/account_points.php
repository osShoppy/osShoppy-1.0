<?php
//$Id: /catalog/includes/languages/dutch/my_points_help.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('NAVBAR_TITLE', 'Spaarpunten Informatie');

define('HEADING_TITLE', 'Mijn Spaarpunten Overzicht');

define('HEADING_ORDER_DATE', 'Datum');
define('HEADING_ORDERS_NUMBER', 'Bestel Nr. & Status');
define('HEADING_ORDERS_STATUS', 'Bestel Status');
define('HEADING_POINTS_COMMENT', 'Commentaar');
define('HEADING_POINTS_STATUS', 'Spaarpunten Status');
define('HEADING_POINTS_TOTAL', 'Spaarpunten');

define('TEXT_DEFAULT_COMMENT', 'Winkel Spaarpunten');
define('TEXT_DEFAULT_REDEEMED', 'Verzilverde Spaarpunten');

define('TEXT_DEFAULT_REFERRAL', 'Recensie Spaarpunten');
define('TEXT_DEFAULT_REVIEWS', 'Recensie Spaarpunten');

define('TEXT_ORDER_HISTORY', 'Bekijk details voor bestel nr.');
define('TEXT_REVIEW_HISTORY', 'Bekijk deze Recencie.');

define('TEXT_ORDER_ADMINISTATION', '---');
define('TEXT_STATUS_ADMINISTATION', '-----------');

define('TEXT_POINTS_PENDING', 'In Afwachting');
define('TEXT_POINTS_PROCESSING', 'In Behandeling');
define('TEXT_POINTS_CONFIRMED', 'Bevestigd');
define('TEXT_POINTS_CANCELLED', 'Geannuleerd');
define('TEXT_POINTS_REDEEMED', 'Verzilverd');

define('MY_POINTS_EXPIRE', 'Verloopt op: ');
define('MY_POINTS_CURRENT_BALANCE', '<b>Spaarpunten Totaal :</b> %s spaarpunten. <b>Met een waarde van :</b> %s .');

define('MY_POINTS_HELP_LINK', ' Please check the <a href="' . tep_href_link(FILENAME_MY_POINTS_HELP) . '" title="Reward Point Program FAQ"><u>Reward</u></a> Point Program FAQ for more information.');

define('TEXT_NO_PURCHASES', 'Er zijn nog geen aankopen gedaan.');
define('TEXT_NO_POINTS', 'U heeft nog geen Spaarpunten');
define('TEXT_DISPLAY_NUMBER_OF_RECORDS', 'Vertoont <b>%d</b> tot <b>%d</b> (van <b>%d</b> spaarpunten rijen)');

// Initialisation of some required parameters for the FAQ answers
 if (tep_not_null(POINTS_AUTO_EXPIRES)){
   $answer_expire = 'Reward answer will expire ' . POINTS_AUTO_EXPIRES . ' months from the date issuance.';
 } else {
   $answer_expire = 'Reward answer do not expire and can be accumulated until you decide to use them.';
 }

if (POINTS_PER_AMOUNT_PURCHASE > 1) {
  $point_or_answer = 'answer';
} else {
  $point_or_answer = 'point';
}

// Definition if the navigation bar and page title
define('NAVBAR_TITLE', 'Spaarpunten FAQ');
define('HEADING_TITLE', 'Spaarpunten FAQ');

// Definitions of the FAQ questions
define('POINTS_FAQ_1', 'Wat is ons Spaarpunten Systeem?');
define('POINTS_FAQ_2', 'Hoe werkt het systeem?');
define('POINTS_FAQ_3', 'Spaarpunten en waarde.');
define('POINTS_FAQ_4', 'Inwisselen Spaarpunten');
define('POINTS_FAQ_5', 'Minimum Spaarpunten vereist');
define('POINTS_FAQ_6', 'Minimum aankoopbedrag vereist');
define('POINTS_FAQ_7', 'Maximum aantal Spaarpunten per bestelling in te wisselen');
define('POINTS_FAQ_8', 'Ontvang ik Spaarpunten voor de verzendkosten?');
define('POINTS_FAQ_9', 'Ontvang ik Spaarpunten op de b.t.w.?');
define('POINTS_FAQ_10', 'Ontvang ik Spaarpunten op artikel aanbiedingen??');
define('POINTS_FAQ_11', 'Ontvang ik Spaarpunten wanneer ook met Spaarpunten betaald is?');
define('POINTS_FAQ_12', 'Spaarpunten verdienen met een verwijzing!');
define('POINTS_FAQ_13', 'Spaarpunten verdienen met het schrijven van een recensie!');
define('POINTS_FAQ_14', 'Artikel Beperkingen');
define('POINTS_FAQ_15', 'Artikel aanbieding Beperkingen');
define('POINTS_FAQ_16', 'Algemene Voorwaarden Spaarpunten');
define('POINTS_FAQ_17', 'Ik heb mijn antwoord niet gevonden!');

// Definition of the answer for each of the questions:

// FAQ1
define('TEXT_FAQ_1', 'Om alle vaste-klanten te bedanken voor het steunen en vertrouwen in '.STORE_NAME.' hebben wij een Spaarpunten Systeem ingebouwd.<br>
Met dit Spaarpunten Systeem laten we zien dat we zeer blij zijn zoals het nu met '.STORE_NAME.' gaat en dat we met stevige pas '.STORE_NAME.' voort gaan zetten.
<br /><br />Het Spaarpunten Systeem werkt net zo makkelijk als dat het klinkt. Wanneer u aankopen doet bij '.STORE_NAME.' spaart u automatisch Spaarpunten.
<br />Wanneer de Spaarpunten na bevestiging door '.STORE_NAME.' op uw Spaarpunten account staan kunt u ze gaan gebruiken voor de volgende bestelling die u plaatst.
<br /><br />Het Spaarpunten Systeem is gestart op ' . tep_get_last_date('USE_POINTS_SYSTEM') . '. Alle aankopen na deze datum gemaakt verdienen punten.');

// FAQ2
define('TEXT_FAQ_2', 'Bij het plaatsen van een bestelling word over het totale<small><font color="FF6633">*</font></small> bedrag het aantal Spaarpunten berekend.
<br>De Spaarpunten worden toegevoegd aan het Spaarpunten account.
<br />De Spaarpunten staan in je <a href="' . tep_href_link(FILENAME_MY_POINTS) . '"> <u>Spaarpunten account</u></a> in afwachting op bevestiging van '.STORE_NAME.'.
<br /><br />Wanneer de Spaarpunten bevestigd worden krijgt u daar een e-mail van en staan ze als bevestigd in uw Spaarpunten account. 
<br>Nu kunt u ze gaan gebruiken voor de volgende bestelling of ze gaan sparen.
<br />' . $points_expire . '
<br />U moet ingelogd zijn om de status van uw Spaarpunten te zien.
<br /><br />Tijdens het afrekenen kunt u bij de betaling aangeven of u de Spaarpunten wilt gaan gebruiken.
<p align="right"<small><font color="FF6633">*</font> in de meeste gevallen zijn verzendkosten en b.t.w niet meeberekend voor Spaarpunten.</small></p>');

// FAQ3
define('TEXT_FAQ_3', 'Op het moment krijgt u voor elke ' .  $currencies->format(1) . ' die u uitgeeft bij ons ' . number_format(POINTS_PER_AMOUNT_PURCHASE,POINTS_DECIMAL_PLACES)  . ' ' . $point_or_points . 'Picto-punt(en)
<br />Bijvoorbeeld:<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Artikel prijs:</b>&nbsp; ' .  $currencies->format(100) . '<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Waarde Spaarpunten:</b>&nbsp; ' .  $currencies->format(tep_calc_shopping_pvalue(100 * POINTS_PER_AMOUNT_PURCHASE)) . '<br /><br />
Houd u er rekening mee dat '.STORE_NAME.' op elk moment bovengenoemde waarden mag veranderen zonder enige kennisgeving aan haar of zijn klanten.
<br>Hier vind u de meest recente update mochten er aanpassingen plaatsvinden!
<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('REDEEM_POINT_VALUE') . '</small><p>');

// FAQ4
define('TEXT_FAQ_4', 'Wanneer u Spaarpunten op uw Spaarpunten account heeft staan, dan kunt u de Spaarpunten gaan gebruiken voor betalingen bij '.STORE_NAME.'.
<br />Tijdens het afrekenen kunt u bij het kiezen van de betaling aangeven of u uw Spaarpunten wil gaan gebruiken voor uw bestelling. 
Geef het aantal Spaarpunten op dat u wil gebruiken of vink de box aan om alle beschikbaar Spaarpunten te gebruiken.
Let er wel op dat u een andere betaalmethode moet kiezen wanneer u niet genoeg Spaarpunten heeft om de betaling te dekken.
<br />Ga verder met afrekenen en op de bevestiginspagina ziet u dat de waarde van Spaarpunten is toegevoegd aan uw bestelling en word afgeschreven.
Na bevestiging word uw Spaarpunten account aangepast en de gebruikte Spaarpunten afgeschreven.
<br />Let wel op dat bestellingen betaald met Spaarpunten alleen Spaarpunten ontvangen op het resterende bedrag die niet met Spaarpunten betaald zijn.');


// FAQ5 - conditionnal depending on the point limit value set in admin
if (POINTS_LIMIT_VALUE  > 0)  {
	define('TEXT_FAQ_5', 'Op het moment heeft u minimaal <b>' . number_format(POINTS_LIMIT_VALUE) . '</b> Spaarpunten nodig <b>(' . $currencies->format(tep_calc_shopping_pvalue(POINTS_LIMIT_VALUE)) . ')' . '</b> voordat u ze kunt gebruiken.
	<br />Hier vind u de meest recente update mochten er aanpassingen plaatsvinden!
	<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('POINTS_LIMIT_VALUE') . '</small></p>');
} else {
	define('TEXT_FAQ_5', 'Op het moment is er geen minimum gesteld aan het aantal Spaarpunten die u kunt gebruiken bij het betalen van een bestelling.<br>
     Let er wel op dat u een andere betaalmethode moet kiezen wanneer u niet genoeg Spaarpunten heeft om de betaling te dekken.
	<br />Hier vind u de meest recente update mochten er aanpassingen plaatsvinden!
	<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('POINTS_LIMIT_VALUE') . '</small></p>');
}

// FAQ6 - conditionnal depending on the point min amount value set in admin
if(tep_not_null(POINTS_MIN_AMOUNT))  {
	define('TEXT_FAQ_6', 'Op het moment moet het aankoopbedrag minimaal <b>' . $currencies->format(POINTS_MIN_AMOUNT) . '</b> zijn voordat u uw Spaarpunten kunt gebruiken.
	<br /><br />Hier vind u de meest recente update mochten er aanpassingen plaatsvinden!
	<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('POINTS_MIN_AMOUNT') . '</small></p>');
} else {
	define('TEXT_FAQ_6', 'Op het moment is er geen minimum aankoopbedrag vereist om Spaarpunten te gebruiken.
	<br /><br />Hier vind u de meest recente update mochten er aanpassingen plaatsvinden!
	<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('POINTS_MIN_AMOUNT') . '</small></p>');
}

// FAQ7
define('TEXT_FAQ_7', 'Er kunnen maximaal <b>' . number_format(POINTS_MAX_VALUE) . '</b> Spaarpunten <b>(' . $currencies->format(tep_calc_shopping_pvalue(POINTS_MAX_VALUE)) . ')' . '</b> gebruikt worden per bestelling.
<br /><br />Hier vind u de meest recente update mochten er aanpassingen plaatsvinden!
<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('POINTS_MAX_VALUE') . '</small></p>');

// FAQ8 - conditionnal depending on the use point for shipping value set in admin
if(USE_POINTS_FOR_SHIPPING == 'false')  {
	define('TEXT_FAQ_8', 'Nee. Bij het berekenen van het totaalbedrag van de bestelling worden er geen Spaarpunten toegekend aan verzendkosten.
	<br /><br />Hier vind u de meest recente update mochten er aanpassingen plaatsvinden!
	<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('USE_POINTS_FOR_SHIPPING') . '</small></p>');
} else {
#---------------------- DO NOT EDIT  EOF ----------------------------  
 	define('TEXT_FAQ_8', 'Ja. Op de verzendkosten worden ook Spaarpunten toegekend.
	<br /><br />Hier vind u de meest recente update mochten er aanpassingen plaatsvinden!
	<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('USE_POINTS_FOR_SHIPPING') . '</small></p>');
}

// FAQ9 - conditionnal depending on the value set in admin for ginving point for tax value
if(USE_POINTS_FOR_TAX == 'false')  {
	define('TEXT_FAQ_9', 'Nee. Bij het berekenen van het totaalbedrag van de bestelling worden er geen Spaarpunten toegekend aan b.t.w.
	<br /><br />Hier vind u de meest recente update mochten er aanpassingen plaatsvinden!
	<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('USE_POINTS_FOR_TAX') . '</small></p>');
} else {
	define('TEXT_FAQ_9', 'Ja. Op de b.t.w worden ook Spaarpunten toegekend.
	<br /><br />Hier vind u de meest recente update mochten er aanpassingen plaatsvinden!
	<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('USE_POINTS_FOR_TAX') . '</small></p>');
}	 

// FAQ10 - conditionnal depending on value set in admin for giving point on specials
if(USE_POINTS_FOR_SPECIALS == 'false')  {
	define('TEXT_FAQ_10', 'Nee. Op alle artikelen die in de aanbieding zijn worden geen Spaarpunten toegekend.
	<br /><br />Hier vind u de meest recente update mochten er aanpassingen plaatsvinden!
	<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('USE_POINTS_FOR_SPECIALS') . '</small></p>');
} else {
	define('TEXT_FAQ_10', 'Ja. Ook op alle artikelen die in de aanbieding zijn kunt u Spaarpunten verdienn.
	<br /><br />Hier vind u de meest recente update mochten er aanpassingen plaatsvinden!
	<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('USE_POINTS_FOR_SPECIALS') . '</small></p>');
}

// FAQ11
if(USE_POINTS_FOR_REDEEMED == 'false')  {
	define('TEXT_FAQ_11', 'Nee. Bij het berekenen van het aantal Spaarpunten worden er geen Spaarpunten 
	toegekend aan artikelen die betaald zijn met Spaarpunten.
	<br /><br />Hier vind u de meest recente update mochten er aanpassingen plaatsvinden!
	<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('USE_POINTS_FOR_REDEEMED') . '</small></p>');
} else {
	define('TEXT_FAQ_11', 'Ja. Houd er rekening mee dat er alleen Spaarpunten worden toegekend aan het bedrag dat niet met Spaarpunten betaald is
	<br /><br />Hier vind u de meest recente update mochten er aanpassingen plaatsvinden!
	<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('USE_POINTS_FOR_REDEEMED') . '</small></p>');
}

// FAQ12
if (tep_not_null(USE_REFERRAL_SYSTEM)){
	define('TEXT_FAQ_12', '<em>"Mond op Mond" reclame is de beste manier van adverteren.</em>
	<br />Referral Points is based on the idea that we should both benefit from your referrals.
	<br />When referred friend place an order, during the checkout procces on the same page that you select a payment method there will be a box to enter a Referral code .
	Your Referral code is your registered email address with us.
	<br />When we receive your referred friends completed and approved order, we will reward your Points account with <b>' .  USE_REFERRAL_SYSTEM . '</b> points .
	<br />The more first time orders we receive from your referrals, the more reward points you will receive.
	<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('USE_REFERRAL_SYSTEM') . '</small></p>');
} else {
	define('TEXT_FAQ_12', 'Currently this feature is disabled.
	<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('USE_REFERRAL_SYSTEM') . '</small></p>');
}

// FAQ13
if (tep_not_null(USE_POINTS_FOR_REVIEWS)){
	define('TEXT_FAQ_13', '<em>"Writing Review is ego boost knowing others read your opinions, and maybe even take your advice."</em>
	<br />Sharing Your Product Reviews will assist us to continually improve our offers and service to you as well as helps others to choose the right products.
	<br />We would like to thank you for helpful review that you gave us, therefore for every quality review, we will reward your Points account with <b>' .  $currencies->format(tep_calc_shopping_pvalue(USE_POINTS_FOR_REVIEWS)) . '</b> worth of points .
	<br />Your Review must meet all of the following conditions:
	<ul>
  	   <li>Your Reviews must be original.</li>
  	   <li>Reviews must be focused and concise on the product under review.</li>
  	   <li>Reviews should not duplicate content already published.</li>
  	   <li>Be truthful and objective.</li>
  	   <li>Reviews should not include posts that have spam, commercial or advertising content or links.</li>
  	   <li>Reviews should not abuse, harass, or threaten another\'s personal safety .</li>
	</ul>
	' . STORE_NAME .' reserves the right to refuse or remove any review that does not comply with above conditions.
	<br />' . STORE_NAME .' staff reserves the right to correct misspelled words, grammatical errors.
	<br />' . STORE_NAME .' is not responsible or liable in any way for ratings and reviews posted by its customers.
	<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('USE_POINTS_FOR_REVIEWS') . '</small></p>');
} else {
	define('TEXT_FAQ_13', 'Er kunnen op het moment <b>geen</b> picto punten verdiend worden met het schrijven van een recensie.
	<p align="right"><small>Laatste aanpassing: ' . tep_get_last_date('USE_POINTS_FOR_REVIEWS') . '</small></p>');
}

// FAQ14
if (tep_not_null(RESTRICTION_MODEL)) {
	define('TEXT_FAQ_14', 'Op het moment kunnen alleen artikelen met modelnummer <b>[' . RESTRICTION_MODEL . ']</b> aangeschaft worden met Spaarpunten.
	<br /><br />Hier vind u de meest recente update mochten er aanpassingen plaatsvinden!
	<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('RESTRICTION_MODEL') . '</small></p>');
}
if (tep_not_null(RESTRICTION_PID)) { 
	$p_ids = split("[,]", RESTRICTION_PID);
	for ($i = 0; $i < count($p_ids); $i++) {
		$prods_query = tep_db_query("SELECT * FROM products, products_description WHERE products.products_id = products_description.products_id and products_description.language_id = '" . $languages_id . "'and products.products_id = '" . $p_ids[$i] . "'");
		if ($list = tep_db_fetch_array($prods_query)) {
			$prods .= '<li>' . $list['products_name'] .'</li>';
		}
	}
	
	define('TEXT_FAQ_14', 'Op het moment kunnen alleen de volgende items met Spaarpunten worden aangeschaft.<ul>' . $prods . '</ul>
	<br />Hier vind u de meest recente update mochten er aanpassingen plaatsvinden!
	<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('RESTRICTION_PID') . '</small></p>');
}
if (tep_not_null(RESTRICTION_PATH)) {
	$cat_path = split("[,]", RESTRICTION_PATH);
        for ($i = 0; $i < count($cat_path); $i++) {
        	$cat_path_query = tep_db_query("select * from " . TABLE_CATEGORIES . ", " . TABLE_CATEGORIES_DESCRIPTION . " WHERE categories.categories_id = categories_description.categories_id and categories_description.language_id = '" . $languages_id . "' and categories.categories_id='" . $cat_path[$i] . "'");
        	if ($list = tep_db_fetch_array($cat_path_query)) {
        		$cats .= '<li>' . $list['categories_name'] .'</li>';
        	}
        }
	define('TEXT_FAQ_14', 'Currently, only items in the following categories and their corresponding sub-categories can be purchased using your points balance.<ul>' . $cats . '</ul>
	<br /><br />Hier vind u de meest recente update mochten er aanpassingen plaatsvinden!
	<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('RESTRICTION_PATH') . '</small></p>');
 } else {
	define('TEXT_FAQ_14', 'Op het moment zijn er geen beperkingen op artikelen die met Spaarpunten aangeschaft kunnen worden.
	<br /><br />Hier vind u de meest recente update mochten er aanpassingen plaatsvinden!
	<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('RESTRICTION_PATH') . '</small></p>');
}

// FAQ15
if (REDEMPTION_DISCOUNTED == 'true') {
	define('TEXT_FAQ_15', 'Op het moment zijn er geen beperkingen op artikelen in de aanbieding die met Spaarpunten aangeschaft kunnen worden.
	<br /><br />Hier vind u de meest recente update mochten er aanpassingen plaatsvinden!
	<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('REDEMPTION_DISCOUNTED') . '</small></p>');
} else {
	define('TEXT_FAQ_15', 'Op het moment zijn er geen beperkingen op artikelen die met Spaarpunten aangeschaft kunnen worden.
	<br /><br />Hier vind u de meest recente update mochten er aanpassingen plaatsvinden!
	<p align="right"><small>Laatste aanpassing was op: ' . tep_get_last_date('REDEMPTION_DISCOUNTED') . '</small></p>');
}

// FAQ16
define('TEXT_FAQ_16', '
<ul>
  <li>Spaarpunten zijn alleen te gebruiken door geregistreerde '.STORE_NAME.' klanten.</li>
  <li>Spaarpunten kunnen alleen verdiend worden met online aankopen en zijn ook alleen te gebruiken met online aankopen.</li>
  <li>Spaarpunten kunnen alleen gebruikt worden op '.STORE_NAME.'.</li>
  <li>Spaarpunten kunnen en mogen niet tussen geregistreerde klanten uigewisseld worden.</li>
  <li>Spaarpunten zijn niet in te wisselen voor geld of enig ander betaalmiddel onder welke omstandigheid dan ook.</li>
  <li>Spaarpunten worden niet toegekend aan geanulleerde bestellingen.</li>
  <li>Wanneer u Spaarpunten gebruikt om te betalen, dan zult u wanneer er niet genoeg Spaarpunten zijn om de betaling te dekken ook nog een andere betaalmethode moeten kiezen.</li>
  <li>Verzendkosten en b.t.w worden niet meegerekend voor het aantal Spaarpunten bij een bestelling. (zie punt 8 en 9)</li>
</ul>
Houd u er rekening mee dat '.STORE_NAME.' het recht heeft om aanpassingen in deze voorwaarden te maken op elk moment zonder enige kennisgeving naar haar of zijn klanten.');

// FAQ17
define('TEXT_FAQ_17', 'U kunt per telefoon of e-mail contact met ons op nemen. Lees <a href="' . tep_href_link(FILENAME_CONTACT_US) . '" title="Neem Contact Op"><u>contact formulier</u></a> voor verdere informatie.');

// Below is the section that will actually displax on the FAQ page
define('TEXT_INFORMATION', '<a name="Top"></a><span class="pointWarning"><b>Veel Gestelde Vragen over ons Spaarsysteem:</b></span>
<ol>
<li><a href="javascript:show(\'answer_q1\');">'. POINTS_FAQ_1 .'</a><br />
	<div id="answer_q1">'.
		TEXT_FAQ_1	
	.'</div>
<li><a href="javascript:show(\'answer_q2\');">'. POINTS_FAQ_2 .'</a><br />
	<div id="answer_q2">'.
		TEXT_FAQ_2
	.'</div>
<li><a href="javascript:show(\'answer_q3\');">'. POINTS_FAQ_3 .'</a><br />
	<div id="answer_q3">'.
		TEXT_FAQ_3	
	.'</div>
<li><a href="javascript:show(\'answer_q4\');">'. POINTS_FAQ_4 .'</a><br />
	<div id="answer_q4">'.
		TEXT_FAQ_4	
	.'</div>
<li><a href="javascript:show(\'answer_q5\');">'. POINTS_FAQ_5 .'</a><br />
	<div id="answer_q5">'.
		TEXT_FAQ_5	
	.'</div>
<li><a href="javascript:show(\'answer_q6\');">'. POINTS_FAQ_6 .'</a><br />
	<div id="answer_q6">'.
		TEXT_FAQ_6	
	.'</div>
<li><a href="javascript:show(\'answer_q7\');">'. POINTS_FAQ_7 .'</a><br />
	<div id="answer_q7">'.
		TEXT_FAQ_7	
	.'</div>
<li><a href="javascript:show(\'answer_q8\');">'. POINTS_FAQ_8 .'</a><br />
	<div id="answer_q8">'.
		TEXT_FAQ_8	
	.'</div>
<li><a href="javascript:show(\'answer_q9\');">'. POINTS_FAQ_9 .'</a><br />
	<div id="answer_q9">'.
		TEXT_FAQ_9	
	.'</div>
<li><a href="javascript:show(\'answer_q10\');">'. POINTS_FAQ_10 .'</a><br />
	<div id="answer_q10">'.
		TEXT_FAQ_10	
	.'</div>
<li><a href="javascript:show(\'answer_q11\');">'. POINTS_FAQ_11 .'</a><br />
	<div id="answer_q11">'.
		TEXT_FAQ_11	
	.'</div>
<li><a href="javascript:show(\'answer_q12\');">'. POINTS_FAQ_12 .'</a><br />
	<div id="answer_q12">'.
		TEXT_FAQ_12	
	.'</div>
<li><a href="javascript:show(\'answer_q13\');">'. POINTS_FAQ_13 .'</a><br />
	<div id="answer_q13">'.
		TEXT_FAQ_13	
	.'</div>
<li><a href="javascript:show(\'answer_q14\');">'. POINTS_FAQ_14 .'</a><br />
	<div id="answer_q14">'.
		TEXT_FAQ_14	
	.'</div>
<li><a href="javascript:show(\'answer_q15\');">'. POINTS_FAQ_15 .'</a><br />
	<div id="answer_q15">'.
		TEXT_FAQ_15	
	.'</div>
<li><a href="javascript:show(\'answer_q16\');">'. POINTS_FAQ_16 .'</a><br />
	<div id="answer_q16">'.
		TEXT_FAQ_16	
	.'</div>
<li><a href="javascript:show(\'answer_q17\');">'. POINTS_FAQ_17 .'</a><br />
	<div id="answer_q17">'.
		TEXT_FAQ_17	
	.'</div></ol>');
?>