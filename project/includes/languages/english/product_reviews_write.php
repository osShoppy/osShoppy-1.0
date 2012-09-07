<?php
//$Id: /catalog/includes/languages/english/products_reviews_write.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('NAVBAR_TITLE', 'Reviews');
define('SUB_TITLE_FROM', 'From:');
define('SUB_TITLE_REVIEW', 'Your Review:');
 
define('ADMIN_EMAIL_SUBJECT', 'Product Review - Approval Required');
define('ADMIN_EMAIL_MESSAGE', 'There is a new product review awaiting approval from your online store, please click this link to view this review: <a href="' . tep_href_link(FILENAME_PRODUCT_REVIEW_EMAIL) . '">' . tep_href_link(FILENAME_PRODUCT_REVIEW_EMAIL) . '</a>');
define('ADMIN_EMAIL_FROM_NAME', 'Product Reviews');
define('SUB_TITLE_EXPLAIN', '
<h3>We want your comments!</h3>
<p>We’re interested in your opinion of this product. Let us and other customers know how you feel by filling in the comment field below. We reserve the right to accept, reject, or edit product reviews; therefore, your review may not appear immediately.</p>
<h2>Review Guidelines</h2>
<ul>
<li>Please <strong>do:</strong>
<ul>
<li>write 50-300 words for the product</li>
<li>comment on the product’s value and effectiveness</li>
<li>tell us if you like the product, but most importantly explain <strong>why</strong> you like or dislike it</li>
<li>mention related products and how this one rates by comparison</li>
</ul>
</li>
<li>Please <strong>do not:</strong>
<ul>
<li>use profanity, obscenities, or make spiteful remarks</li>
<li>type phone numbers, mail addresses, or URLs</li>
<li>make note of availability, price, or alternative ordering/shipping information</li>
</ul>
</li>
</ul>
');

define('SUB_TITLE_RATING', 'Rating:');
define('TEXT_NO_HTML', '<small><font color="#ff0000"><b>NOTE:</b></font></small>&nbsp;HTML is not translated!');
define('TEXT_BAD', '<small><font color="#ff0000"><b>BAD</b></font></small>');
define('TEXT_GOOD', '<small><font color="#ff0000"><b>GOOD</b></font></small>');
define('TEXT_CLICK_TO_ENLARGE', 'Click to enlarge');
?>