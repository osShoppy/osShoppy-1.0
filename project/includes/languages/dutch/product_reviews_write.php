<?php
//$Id: /catalog/includes/languages/dutch/product_reviews_write.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('NAVBAR_TITLE', 'Recensies');
define('SUB_TITLE_FROM', 'Van:');
define('SUB_TITLE_REVIEW', 'Uw Recensie:');

define('ADMIN_EMAIL_SUBJECT', 'Product Recensie - Keuring Vereist');
define('ADMIN_EMAIL_MESSAGE', 'Er is een nieuwe recensie geschreven en wacht op keuring!<br> Klik op de link om de recensie te bekijken: <a href="' . tep_href_link(FILENAME_PRODUCT_REVIEW_EMAIL) . '">' . tep_href_link(FILENAME_PRODUCT_REVIEW_EMAIL) . '</a>');
define('ADMIN_EMAIL_FROM_NAME', 'Product Recensies');
define('SUB_TITLE_EXPLAIN', '
<h3>We willen graag weten wat u er van vind!</h3>
<p><b><center>We zijn geïnteresseerd in uw opinie en ervaringen met onze produkten.</b></center>
<br>Laat ons en andere bezoekers van de website zien wat u van onze produkten vind en hoe u er mee werkt.<br>
Vul hieronder het formulier in en stuur uw ervaring naar ons op.<br>
Uw recensie zal niet meteen op de website te zien zijn omdat deze op een goedkeuring van de sitebeheerder wacht.
<br></p>
<h2>Recensie Richtlijnen</h2>
<ul>
<li>Wat <strong>wel</strong> doen
<ul>
<li>Gebruik tussen de 50 en 300 woorden.</li>
<li>Wat vind u van het produkt?</li>
<li>Is het produkt makkelijk in gebruik?</li>
<li>Benoem gerelateerde producten en hoe deze combinatie samen werkt.</li>
</ul>
</li>
<li>Wat <strong>niet</strong> doen:
<ul>
<li>Gebruik geen onnodige taal.</li>
<li>Vul geen telefoonnummers of andere persoonlijke gegevens in.</li>
<li>Een foto laden waarop u geen rechten heeft voor publicatie.</li>
</ul>
</li>
</ul>
');

define('SUB_TITLE_RATING', 'Waardering:');
define('TEXT_NO_HTML', '<small><font color="#ff0000"><b>NB:</b></font></small> HTML wordt niet vertaald!');
define('TEXT_BAD', '<small><font color="#ff0000"><b>SLECHT</b></font></small>');
define('TEXT_GOOD', '<small><font color="#ff0000"><b>GOED</b></font></small>');
define('TEXT_CLICK_TO_ENLARGE', 'klik voor vergroting');
?>