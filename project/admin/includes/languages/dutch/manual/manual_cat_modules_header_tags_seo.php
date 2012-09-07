<?php //$Id: /catalog/admin/includes/languages/dutch/manual/manual_cat_modules_header_tags_seo.php

define('TEXT_TITLE', 'Header Tags Seo v3.2.3');

define('TEXT_MAIN_HEADER', 'Hieronder volgen vijf onderwerpen');

define('TEXT_MAIN_CONTENT', '
<b>Operating Instructions:</b>
<br><br>
1) Once Header Tags SEO is installed, go to admin->Header Tags SEO->Fill Tags,
   select the Fill All option in all three columns on that page and click
   Update. This option will fill in all of the titles and meta tags for all 
   categories, manufacturers and products. If you already have tags set up that
   you don\'t want overwritten then you should select the Fill Empty option instead.
<br><br>   
2) Go to admin->Header Tags SEO->Page Control. You will see a Default section at
   the right of the page with osCommerce related text in the three string boxes.
   This section contains text that will be used on pages that do not have a 
   specific page added for it but does have Header Tags code installed in the file. 
   Change the strings to match your site. Here is a brief guide as to what should 
   be entered:
<br><br>   
   Title: List your main keywords as
    Keyword1 - Keyword2 - Keyword3
<br><br>
   Description: A human readable sentence using your main keywords like
    We sell keyword1, keyword2 and keyword3.
<br><br>
   Keywords: A list of your keywords as
    Keyword1, Keyword2, Keyword3  
<br><br>    
   Logo Text: The same as or similar to the above Description. This text will 
   appear in the rollover text of the logo, unless overridden by the individual
   page settings. 
<br><br>
   Extra Logo Text: At the end of the box for the logo in Page Control is a radio
   button. Clicking on that will open a dialog where extra text can be entered.
   That is meant to allow setting the alt text for other images in the logo. You 
   will need to edit the code for those extra images using the same instructions
   as given for the main logo text in includes/header.php. Just be sure to change
   the code to use the right field. So instead of using $header_tags_array[\'logo_text\'],
   you would use $header_tags_array[\'logo_text_1\'].
<br><br>
   Note that the order of the keywords should stay the same in all of the above.
<br><br>   
3) On the left side, there is a dropdown for all of the available pages. An available
   page is one that has Header Tags code in the <head> section, which happens
   during the installation. The entry in the list named index.php contains the 
   title and meta tags for the home page. Do the same for it, as above for the 
   default settings but make this information specific to your home page. This 
   should be setup for each page you want unique tags on. The options should also
   be set (see below). 
<br><br>   
4) Go to admin->catalog, click on a category and then on edit. At the bottom of 
   the edit section to the right, you will see a large box for Categories Description. 
   The text you enter here will appear under the title on the category page for 
   this category. This is useful for your customers but is also good for the search
   engines, as long as the text contains mention of the keyword for that page 
   (which is usually the category name).
<br><br>   
5) Go to admin->Catalog->Manufacturers and do the same as in step 4.    
<br><br>
6) Go to admin->Configuration->Header Tags SEO and setup the various options to
   your liking.
<br><br>   
7) Set the options. When you go to admin->Header Tags SEO->Page Control and select
   a page to edit, you will see a number of options. They are described here. It
   is important to note that it is possible to turn off all options for a page.
   That will probably break your shop and should not be done.
<br><br>   
   Default Title: If checked, the title entered in the default section on the 
   right will be added to the title of this page.  	 	
<br><br>	
   Default Description: If checked, the description entered in the default section 
   on the right will be added to the description of this page.
<br><br>    		
   Default Keywords: If checked, the keywords entered in the default section on 
   the right will be added to the keywords of this page.	
<br><br>	
   Default Logo: If checked, the logo text entered in the default section on the 
   right will be added to the logo text of this page (see above note in step 2). 		
<br><br>   
   Category: If checked, the applicable category title will be added to the title,
   description, keywords and logo text for this page. Not all pages will be able
   to display a category so if this option is set for such a page, it will just
   be ignored. 		
<br><br>	
   Manufacturer: If checked, the applicable manufacturer title will be added to 
   the title, description, keywords and logo text for this page. Not all pages 
   will be able to display a manufacturer so if this option is set for such a 
   page, it will just be ignored. 		
<br><br>			
   Product: If checked, the applicable product title will be added to the title,
   description, keywords and logo text for this page. Not all pages will be able
   to display a product so if this option is set for such a page, it will just
   be ignored. 		
<br><br>
   Root: If checked, the text in the title, description, meta tags and logo text
   boxes for this page will be added to those items for the page. The root is
   considered the basic text for the page. It is not required but should be 
   checked for the index.php page or the title may not appear there. 
<br><br>   
8) Set the Sort Order. For each of the above options, there is a box next to the 
   checkbox. This is for setting the sort order of the items. If both the category
   and manufacturer checkboxes are checked on the product_info.php page and their
   sort orders are 3 and 1, respectively, then the manufacturer title will
   be shown before the category title. if the Product checkbox is also set and 
   its sort order is 2, then the products title will appear between the manufacturer
   and category titles.         
<br><br>   
That\'s basically it. Go to your shop and click around. If you see something that 
is not to your liking, it can be edited in admin.  
<br><br><br>   
          
<b>Making the best of Header Tags SEO:<br><br></b>
Installing Header Tags SEO will help the ratings for your category and product pages
out of the box, just by installing it. This is because the installation pre-fills 
the tags for these items, if you ran fill_tags, with your products name, which in 
turn causes those pages to be setup correctly for the search engines. This, by itself, 
is enough to improve the position in the SERP\'s (search engine result pages) for 
those pages and is the reason that many shop owners find their product pages listed 
before their home page.
<br><br>
So how do you make Header Tags SEO work for the other pages of your site? Here is a
brief overview of what you need to do to properly set up a page of your site.
<br><br>
First, you need to know what your keyword or key phase is (referenced as KW hereafter).
The whole page should be built around your KW. The KW should be picked by researching 
how many searches have been done on it. 
<br><br>
Once you have selected two or three KWs, it is time to set up the title and meta tags.
A common mistake by many shop owners is that they make the title of the page the same 
as the domain name. Unless the domain name was chosen with the KW in mind, this is 
almost always a mistake. In admin->Header Tags->Page Control, find the section named 
index. Change the Title entry to start with your KW. 
<br><br>
The meta description tag should also start with your keyword when possible. I say when 
possible because this description may end up in a search engine listing so you want it 
to sound enticing to people viewing it. Don\'t just throw a few words together with the 
intent of improving your odds with the search engines. What people read will convince 
them much more than a few places different in the listings.
<br><br>
The meta keyword tag needs to include your two or three keywords, starting with your main
one. Here is another spot where beginners, and some old-timers, make a common mistake. The 
HTML coding standard allows you to place many keywords in this tag. However, that does not 
mean you should do it. In fact, for each page of your web site, you should not have more 
than two or three words in this tag. Of course, the words for the different pages should 
also be different. Also note that each keyword or phase is comma separated.
<br><br>
After you have finished with all of the above, your home page should have a title that begins
with your KW, your meta description tag should start with your KW or at least contain it in
the wording, your meta keywords should start with your KW and not contain more than three
comma separated words or phases. You will need to do this on each page you want to have listed
in the search engine result pages. The more you have listed, the better. But remember that 
each page has to be unique so that means that the above has to be done for each page, 
including picking out new KW\'s. Doing this is not quick work but it will pay off with a better 
position for your shop.
<br><br><br>

<b>The following describes the options that are in admin->Configuration->Header Tags SEO.</b>
<br><br>
Automatically Add New Pages - adds any news pages it finds to the list automatically
  when you go to Page Control. If not set, you have to manually add the pages by
  selecting Add New Pages from the dropdown.
<br><br>
Check for Missing Tags - checks to see if you have any products, categories or
  manufacuters that have empty titles or meta tags.
<br><br>
Clear Cache - will remove all cache entries for Header Tags.
<br><br>
Display Category Parents in Title and Tags - This setting has three options meant
  to control how the category names are displayed in the title and meta tags.
<br><br>
  - Full Category Path - shows the names of each category in the current path. For
    example, if product A is located in Hardware -> Mice, the displayed title will be
    Hardware - Mice - Product A.
<br><br>
  - Duplicate Categories - shows the immediate parent for all categories this product
    is in. For exampe, if product A is in the Hardware -> Mice category and also in
    Hardware -> Extras category, the displayed title will be
    Mice - Extras - Product A.
<br><br>
  - Standard - Only the immediate category for the current path is shown. For
    example, if product A is located in Hardware -> Mice, the displayed title will be
    Mice - Product A.
<br><br>
  Note that for any of the above to work, the category checkbox in Page Control for
  product_info.php must be checked.
<br><br>
Display Column Box - displays an infobox in the left column while on a product page.
  Provides the search engines with addtional text and a link.
<br><br>
Disable Permission Warning - Don\'t display the permissions warning. Can be safely enabled
 if on a Windows server.
<br><br>
Display Help Popups - Displays a popup with a quick explanation when in Page Control or
 Fill Tags.
<br><br>
Display Silo Links - Displays an infobox containing links related to a specific category.
 See the admin->Header Tags SEO->Silo Control for more information on this option.
<br><br>
Display Social Bookmark - Place social bookmark icons on the category and products pages.
<br><br>
Keyword Density Range - Used with the option to retrieve keywords from the text on the page.
<br><br>
Separator - Description - defines the separator used for the description meta tag.
<br><br>
Separator - Keywords - defines the separator used for the keywords meta tag.
<br><br>
Enable Cache - Turns on the caching option for Header Tags. The Normal option is a little faster 
than the gzip option but gzip provides smaller cache sizes.
<br><br>
Enable an HTML Editor - Allows the selection of one of three HTML editors. The editor must
 be installed separately.
<br><br>
Enable HTML Editor for Category Descriptions - If the selected editor is installed and
 this option is set, it will be used for the category descriptions.
<br><br>
Enable HTML Editor for Meta Descriptions - If the selected editor is installed and
 this option is set, it will be used for the meta description tag.
<br><br>
Enable HTML Editor for Products - If the selected editor is installed and
 this option is set, it will be used for the products descriptions.
<br><br> 
Enable Version Checker - Provides automatic version checking. This can slow the page loading
 down since it has to connect to the oscommerce contribution site so is usually
 best to leave it off. The version can be checked manually from the Page Control section.
<br><br><br>

<b>Met Tag Options</b>
This file explains the purpose of the various meta tags options
available with Header Tags SEO. These explanations may not be
complete. For more information, search them on the Internet. To alter
any of these that have various options, the includes/header_tags.php
file will need to be edited.
<br><br> 
google: Controls how google searches your site. The default setting
        is All, which means that google will index all pages of your
        site as they are found and follow all links on those pages.
        This is the desired setting. But some sites may want to 
        alter these. 
language: Tells the search engines which language the site is intended for.
<br><br> 
noodp: If your site is listed on DMoz, a major directory site, then they have
       created their own description of your site most likely. Sometimes, the
       description they use is not the best for your site. This options allows
       you to override that description so that your own is used. This tag
       works for all major search engines.       

noydir: Same as the above but only works for Yahoo.
<br><br> 
revisit: Tells the search engines when they can revisit the site. Rarely used
         anymore due to how frequently the search engines visit. They may not
         pay attention to it. But if your bandwidth is limited, changing the
         setting for this may help.
         
robots: Same as the google meta tag above but applies to all search engines.
<br><br> 
unspam: An attempt by unspam.com to prevent the search engines from harvesting 
        email addresses. May not be heeded by all search engines. 
<br><br> 
replyto: Lists your email address. This is not recommended for most sites but
         is useful for some.
<br><br> 
		 ');

define('TEXT_RIGHT_CONTENT', 'Nu is de website nog sneller te vinden!');

define('TEXT_INFO_CONTENT', '
<b>First Set Up Once Header Tags is installed, follow these steps for a basic setup:</b>
<br><br> 
1 - Go to admin->Header Tags SEO->Fill Tags, scroll to the
    bottom of the page, click on the Fill All Tags button
    for each section and click Update. Check the results
    on that page to make sure there are not any errors noted.
<br><br> 
2 - Go to admin->Header Tags SEO->Page Control and fill in the
    Title, Description, keywords and Logo Text boxes in the 
    default section (right side). The text should be something 
    relevant to your site. Uncheck all of the check boxes in the
    Include section. Click Update.
<br><br> 
3 - Go to admin->Header Tags SEO->Page Control and select index.php
    from the dropdown menu. Change the text in those boxes to something
    relevant to your shop, or clear them, and click Update and the bottom 
    of that section.
<br><br> 
4 - Go to admin->Header Tags SEO->Test and click on the Test button. Handle
    whatever errors are displayed.
<br><br> 
5 - Go to admin->Catalog, select a category and click edit. Enter in the 
    categories description for that category (large box at bottom). That 
    text will be displayed on your category pages and should be text related 
    to that category. Do the same for the other categories.
<br><br> 
6 - Go to admin-Configuration->Header Tags SEO and change the settings to
    your preferences. Enabling the Social Bookmarks and product box is
    recommended.
<br><br> 
I realize no one likes to read instruction files but the ones in the Docs
directory do contain some useful information so you should make a point of
reading those at some point.
<br><br>http://forums.oscommerce.com/topic/298099-header-tags-seo
<br><br><center>
************************** IMPORTANT *********************************<br>
<small>If you post a problem in the support thread, be sure to post the results
of the test function. <br>Otherwise, you post may not get answered or it will be 
delayed while you run the test.<br></small>
************************** IMPORTANT *********************************
</center><br><br> 
');

define('TEXT_NOTICE_CONTENT', 'Sleutelwoorden worden automatich ingevoerd!<br><br>');

define('TEXT_RELATED_CONTENT', 'Ultimate URL\'s<br><br>');

?>
