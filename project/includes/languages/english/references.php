<?php
//$Id: /catalog/includes/languages/english/references.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('NAVBAR_TITLE', 'Company References');
define('NAVBAR_TITLE2', 'Write Company Reference');
define('HEADING_TITLE', 'Company References');
define('HEADING_TITLE2', 'Write a Company Reference');
define('TEXT_REFERENCES_WRITE', 'Submit Your Company Reference');
define('FORM_REQUIRED_INFORMATION', '*Required information');
define('TEXT_NO_REFERENCES', 'There are no Company References.');
define('TEXT_LINK_REFERENCES', 'Click to view all Company References');
define('TEXT_REFERENCES_SUCCESSFUL','<b>Your Reference is succesfully send.</b><br>Thanks for your Reference. <br>');
define('TEXT_REFERENCES_POINTS', 'Wij van ' . STORE_NAME . ' stellen dit zeer op prijs en belonen dit met een kortingscoupon. <br>
Na volledige goedkeuring van uw Reference krijgt u uw kortingscoupon per e-mail opgestuurd.<br>
De kortingscoupon kunt u dan bij uw eerst volgende aankoop op ' . STORE_NAME . ' gebruiken.');

define('TEXT_REFERENCES_SIGNATURE', 'Your Reference needs to be approved before it\'s able for public view on ' . STORE_NAME . '.<br><br>With kind regards,<br><b>' . STORE_NAME . '</b><br><br>');
define('TEXT_REFERENCES_INTRO', 'We’re interested in your opinion. Let us and others know about your experience with our products by filling in the Reference submission form below. We reserve the right to accept or reject References; therefore, your Reference may not appear immediately.</p>');
define('TEXT_REFERENCES_ALLOWED', '
<ul>
<li>Please <strong>do:</strong>
<ul>
<li>Write 50-300 words for the Reference</li>
<li>Comment on the site’s value and effectiveness</li>
<li>Explain <strong>why</strong> you like or dislike us</li>
<li>Upload an <strong>image</strong> of you using our products</li>
</ul>
</li>
<li>Please <strong>do not:</strong>
<ul>
<li>Use profane, obscene, or spiteful language</li>
<li>Enter phone numbers, mailing addresses, or internet addresses</li>
<li>Upload an image that you do not have the right to share</li>
</ul>
</li>
</ul>');
define('TEXT_REFERENCES_TITLE', 'Title:');
define('TEXT_REFERENCES_NAME', 'Your Name:');
define('TEXT_REFERENCES_EMAIL', 'E-Mail Address:');
define('TEXT_REFERENCES_LOCATION', 'Location:');
define('TEXT_BANNERS_HTML_TEXT', 'Describe Your Experience(s):');
define('TEXT_UPLOAD_REFERENCES_IMAGE', 'Upload an Image');
define('ERROR_REFERENCES_TITLE_REQUIRED', 'A title is required in order to submit your Reference');
define('ERROR_REFERENCES_NAME_REQUIRED', 'A name is required in order to submit your Reference');
define('ERROR_REFERENCES_EMAIL_REQUIRED', 'A valid email address is required in order to submit your Reference');
define('ERROR_REFERENCES_DESCRIPTION_REQUIRED', 'A description is required in order to submit your Reference');
define('REFERENCES_NOTIFICATION_SUBJECT', 'Customer Reference Submission');
define('REFERENCES_NOTIFICATION_TEXT', 'A Customer Reference has been submitted by ');
define('REFERENCES_CONJ', ' of ');
define('REFERENCES_NOTIFICATION_TITLE', 'Reference Title: ');
define('REFERENCES_NOTIFICATION_HTML_TEXT', 'Reference Text: ');
define('REFERENCES_NOTIFICATION_APPROVE', 'Please take a few moments to login to your <a href="' . DIR_WS_REFERENCES_ADMIN . '">store admin</a> and approve or delete this Reference.');
?>