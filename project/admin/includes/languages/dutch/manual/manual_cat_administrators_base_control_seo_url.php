<?php // $Id: /catalog/admin/includes/languages/dutch/manual/manual_cat_administrators_base_control_seo_url.php

define('TEXT_TITLE', 'Zoek Machine Optimalisatie!');

define('TEXT_MAIN_HEADER', 'Voor een beter zoek resultaat in de verschillende zoek machines!');

define('TEXT_MAIN_CONTENT', '
	<b>Settings and what they do</b><br><br>

    <b>Enable SEO URLs</b><br>
          &nbsp;&nbsp;&nbsp;Effectively an on/off switch .. true being on .. false off<br><br>
    <b>Enable the cache</b><br>
          &nbsp;&nbsp;&nbsp;Effectively an on/off switch for the caching system .. true being on .. false off
    <b>Enable multi language support</b><br>
          &nbsp;&nbsp;&nbsp;Turn on/off the multi language functionality .. true being on .. false off<br><br>
    <b>Output W3C valid URIs</b><br>
          &nbsp;&nbsp;&nbsp;Output W3C valid links that won\'t break your validation<br><br>
    <b>Select your chosen cache system</b><br>
          &nbsp;&nbsp;&nbsp;File:<br>
          &nbsp;&nbsp;&nbsp;Stores the cache as a text file. No queries are used after the cache is fully loaded.<br>
          &nbsp;&nbsp;&nbsp;SQLite:<br>
          &nbsp;&nbsp;&nbsp;Stores the cache in an SQLite database. No MySQL queries are used after the cache is fully loaded.<br>
          &nbsp;&nbsp;&nbsp;MySQL:<br>
          &nbsp;&nbsp;&nbsp;Stores the cache in the database.<br>
          &nbsp;&nbsp;&nbsp;Memcache:<br>
          &nbsp;&nbsp;&nbsp;Super fast Memcached option. Requires Memcache compiled in apache.<br>
          &nbsp;&nbsp;&nbsp;This is really only a solution for shops running on dedicated/VPS servers as it is unlikely to be available in shared hosting<br>
          &nbsp;&nbsp;&nbsp;Read the benefits here.<br><br>
    <b>Set the number of days to store the cache</b><br>
          &nbsp;&nbsp;&nbsp;How many days a cache will be kept before auto deleting itself.<br><br>
    <b>Choose the URI format</b><br>
          &nbsp;&nbsp;&nbsp;There are 4 options<br><br>

          &nbsp;&nbsp;&nbsp;The difference between the four is shown below: -<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+ Standard Seo Urls ( does not require mod_rewrite )<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;# www.mysite.com/product_info.php/the-brand-etc-great-product-p-3<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+ Path Standard Seo Urls ( does not require mod_rewrite )<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;# www.mysite.com/product_info.php/the-brand-etc/great-product-p-3<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+ Traditional Rewrite Seo Urls ( Requires mod_rewrite and RewriteRules added to .htaccess )<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;# www.mysite.com/the-brand-etc-great-product-p-3.html<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+ Path Rewrite Seo Urls ( Requires mod_rewrite and RewriteRules added to .htaccess )<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;# www.mysite.com/the-brand-etc/great-product-p-3.html<br><br>
    <b>Choose how your product link text is made up</b><br>
          &nbsp;&nbsp;&nbsp;There are 49 different ways to write your products link text. Any combination of the below ( e.g. bp produces brand-product name or brand/product name if the uri type is path based )<br><br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+ p = products name<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+ c = category name<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+ b = manufacturer name ( b for brand )<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+ m = model<br>
          &nbsp;&nbsp;&nbsp;cbmp produces category-brand-model-product-name or category/brand/model/product-name if the uri type is path based<br><br>
    <b>Filter Short Words</b><br>
          &nbsp;&nbsp;&nbsp;When creating a link from a product name you may want to remove the shorter words .. like a | or | at | the .. etc.<br>
          &nbsp;&nbsp;&nbsp;Default value is 1 but you can choose to filter short words of 1 2 or 3 letters.<br>
          &nbsp;&nbsp;&nbsp;A setting of 3 would filter out all words of three letters or less.<br><br>
    <b>Add category parent to the beginning of the url</b><br>
          &nbsp;&nbsp;&nbsp;Enables/disables the option of adding the category parent to the beginning of category URLs.<br><br>
    <b>Remove all non-alphanumeric characters</b><br>
          &nbsp;&nbsp;&nbsp;Removes all non alphanumeric characters .. this is best left as true.<br>
          &nbsp;&nbsp;&nbsp;If your language uses special characters you will need to use the conversion system see extras/character_conversion_pack/instructions.txt<br><br>
    <b>Add cPath to product URLs</b><br>
          &nbsp;&nbsp;&nbsp;Adds ?cPath=x to the end of product urls .. not sure why ( perhaps menu highlighting ) but retained for backwards compatibility.<br><br>
    <b>Enter special character conversions</b><br>
          &nbsp;&nbsp;&nbsp;Convert/replace special language characters. As a comma seperated string .. like ..<br>
          &nbsp;&nbsp;&nbsp;character=>convert,char2=>convert<br><br>

          &nbsp;&nbsp;&nbsp;While this can still be used it has been replaced by the files in<br>
          &nbsp;&nbsp;&nbsp;catalog/includes/modules/ultimate_seo_urls5/includes/character_conversion/<br>
          &nbsp;&nbsp;&nbsp;To revert to using this method just delete all the files within the character_conversion folder .. but not the folder itself.<br><br>

          &nbsp;&nbsp;&nbsp;See extras/character_conversion_pack/instructions.txt<br><br>
    <b>Turn performance reporting on/off .. true being on .. false off</b><br>
          &nbsp;&nbsp;&nbsp;Shows USU5 performance at the bottom of your web shop.<br><br>
    <b>Turn variable reporting on/off .. true being on .. false off</b><br>
          &nbsp;&nbsp;&nbsp;Shows USU5 class properties at the bottom of your web shop. Great for debugging.<br><br>
    <b>Force www.mysite.com/ when www.mysite.com/index.php</b><br>
          &nbsp;&nbsp;&nbsp;Redirects index.php to your base domain. Beware! on some servers this creates a redirect loop so turn it on .. try it .. if it creates a loop turn it OFF.<br><br>
    <b>Reset SEO URLs Cache</b><br>
          &nbsp;&nbsp;&nbsp;Clicking on "reset" will empty the cache.<br><br><br><br>

    <b>.htacces bestand aanpassen</b><br>
          &nbsp;&nbsp;&nbsp;Plaats de script hieronder in je .htacces bestand.<br><br>
# If you are getting errors you may need to comment this out like ..<br>
#Options +FollowSymLinks<br>
Options +SymLinksIfOwnerMatch<br>
<IfModule mod_rewrite.c><br>
  RewriteEngine On<br><br>

  # RewriteBase instructions<br>
  # Change RewriteBase dependent on how your shop is accessed as below.<br>
  # http://www.mysite.com = RewriteBase /<br>
  # http://www.mysite.com/shop/ = RewriteBase /shop/ <br>
  # http://www.mysite.com/catalog/shop/ = RewriteBase /catalog/shop/<br><br>

  # Change RewriteBase using the instructions above  <br>
  RewriteBase /demo/<br>
  RewriteRule ^([a-z0-9/-]+)-p-([0-9]+).html$ product_info.php [NC,L,QSA]<br>
  RewriteRule ^([a-z0-9/-]+)-c-([0-9_]+).html$ index.php [NC,L,QSA]<br>
  RewriteRule ^([a-z0-9/-]+)-m-([0-9]+).html$ index.php [NC,L,QSA]<br>
  RewriteRule ^([a-z0-9/-]+)-pi-([0-9]+).html$ popup_image.php [NC,L,QSA]<br>
  RewriteRule ^([a-z0-9/-]+)-pr-([0-9]+).html$ product_reviews.php [NC,L,QSA]<br>
  RewriteRule ^([a-z0-9/-]+)-pri-([0-9]+).html$ product_reviews_info.php [NC,L,QSA]<br>
  # Articles contribution<br>
  RewriteRule ^([a-z0-9/-]+)-t-([0-9_]+).html$ articles.php [NC,L,QSA]<br>
  RewriteRule ^([a-z0-9/-]+)-au-([0-9]+).html$ articles.php [NC,L,QSA]<br>
  RewriteRule ^([a-z0-9/-]+)-a-([0-9]+).html$ article_info.php [NC,L,QSA]<br>
  # Information pages<br>
  RewriteRule ^([a-z0-9/-]+)-i-([0-9]+).html$ information.php [NC,L,QSA]<br>
  # Links contribution<br>
  RewriteRule ^([a-z0-9/-]+)-links-([0-9_]+).html$ links.php [NC,L,QSA]<br>
  # Newsdesk contribution<br>
  RewriteRule ^([a-z0-9/-]+)-n-([0-9]+).html$ newsdesk_info.php [NC,L,QSA]<br>
  RewriteRule ^([a-z0-9/-]+)-nc-([0-9]+).html$ newsdesk_index.php [NC,L,QSA]<br>
  RewriteRule ^([a-z0-9/-]+)-nri-([0-9]+).html$ newsdesk_reviews_info.php [NC,L,QSA]<br>
  RewriteRule ^([a-z0-9/-]+)-nra-([0-9]+).html$ newsdesk_reviews_article.php [NC,L,QSA]<br>
</IfModule><br><br>

');

define('TEXT_RIGHT_CONTENT', 'Cachen op vier verschillende manieren!<br><br>Te gebruiken met meerdere talen!');

define('TEXT_INFO_CONTENT', 'Lees de rubriek over <a href="' . tep_href_link(FILENAME_MANUAL_CAT_MODULES_HEADER_TAGS_SEO) . '">Header Tags</a> om je website nog zoek machine vriendelijker te maken!<br>');

define('TEXT_NOTICE_CONTENT', 'Vergeet niet je .htacces bestand aan te passen!<br><br>');

define('TEXT_RELATED_CONTENT', 'Header Tags!<br><br>');

?>
