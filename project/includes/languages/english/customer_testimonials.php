<?php
//$Id: /catalog/includes/languages/english/customer_testimonials.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('NAVBAR_TITLE', 'Customer Testimonials');
define('NAVBAR_TITLE2', 'Write Testimonial');
define('HEADING_TITLE', 'Customer Testimonials');
define('HEADING_TITLE2', 'Write a Testimonial');
define('TEXT_TESTIMONIALS_WRITE', 'Submit Your Testimonial');
define('FORM_REQUIRED_INFORMATION', '*Required information');
define('TEXT_NO_TESTIMONIALS', 'There are no testimonials.');
define('TEXT_LINK_TESTIMONIALS', 'Click to view all testimonials');
define('TEXT_TESTIMONIALS_SUCCESSFUL','<b>Your Testimonial is succesfully send.</b><br>Thanks for your Testimonial. <br>');
define('TEXT_TESTIMONIALS_POINTS', 'Wij van ' . STORE_NAME . ' stellen dit zeer op prijs en belonen dit met een kortingscoupon. <br>
Na volledige goedkeuring van uw testimonial krijgt u uw kortingscoupon per e-mail opgestuurd.<br>
De kortingscoupon kunt u dan bij uw eerst volgende aankoop op ' . STORE_NAME . ' gebruiken.');

define('TEXT_TESTIMONIALS_SIGNATURE', 'Your Testimonial needs to be approved before it\'s able for public view on ' . STORE_NAME . '.<br><br>With kind regards,<br><b>' . STORE_NAME . '</b><br><br>');
define('TEXT_TESTIMONIALS_INTRO', 'We’re interested in your opinion. Let us and others know about your experience with our products by filling in the testimonial submission form below. We reserve the right to accept or reject testimonials; therefore, your testimonial may not appear immediately.</p>');
define('TEXT_TESTIMONIALS_ALLOWED', '
<ul>
<li>Please <strong>do:</strong>
<ul>
<li>Write 50-300 words for the testimonial</li>
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
define('TEXT_TESTIMONIALS_TITLE', 'Title:');
define('TEXT_TESTIMONIALS_NAME', 'Your Name:');
define('TEXT_TESTIMONIALS_EMAIL', 'E-Mail Address:');
define('TEXT_TESTIMONIALS_LOCATION', 'Location:');
define('TEXT_BANNERS_HTML_TEXT', 'Describe Your Experience(s):');
define('TEXT_UPLOAD_TESTIMONIAL_IMAGE', 'Upload an Image');
define('ERROR_TESTIMONIALS_TITLE_REQUIRED', 'A title is required in order to submit your testimonial');
define('ERROR_TESTIMONIALS_NAME_REQUIRED', 'A name is required in order to submit your testimonial');
define('ERROR_TESTIMONIALS_EMAIL_REQUIRED', 'A valid email address is required in order to submit your testimonial');
define('ERROR_TESTIMONIALS_DESCRIPTION_REQUIRED', 'A description is required in order to submit your testimonial');

define('TESTIMONIAL_NOTIFICATION_SUBJECT', 'Customer Testimonial Submission');
define('TESTIMONIAL_NOTIFICATION_TEXT', 'A Customer Testimonial has been submitted by ');
define('TESTIMONIAL_CONJ', ' of ');
define('TESTIMONIAL_NOTIFICATION_TITLE', 'Testimonial Title: ');
define('TESTIMONIAL_NOTIFICATION_HTML_TEXT', 'Testimonial Text: ');
define('TESTIMONIAL_NOTIFICATION_APPROVE', 'Please take a few moments to login to your <a href="' . DIR_WS_TESTIMONIAL_ADMIN . '">store admin</a> and approve or delete this testimonial.');
?>