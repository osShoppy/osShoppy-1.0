<?php //$Id: /catalog/admin/includes/languages/english/categories.php

define('HEADING_TITLE', 'Categories / Products');
define('HEADING_TITLE_SEARCH', 'Search:');
define('HEADING_TITLE_GOTO', 'Go To:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_PRODUCT_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Categories/Products');
define('TABLE_HEADING_PRODUCT_MODEL', 'Sort/Model');
define('TABLE_HEADING_PRODUCT_VIEWED', 'Viewed(x)');
define('TABLE_HEADING_PRODUCT_ORDERED', 'Bought');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Actie');

define('TEXT_PRODUCTS_QUOTES_EMAIL_ADDRESS', 'Quotes Email Address');
define('TEXT_PRODUCTS_QUOTES_EXPIRE', 'Quotes Expires On');
define('TEXT_PRODUCTS_QUOTES_ID', 'Quote ID');
define('TEXT_PRODUCTS_QUOTES_STATUS', 'Quotes Status');
define('TEXT_QUOTE_STATUS_ACTIVE', 'Active');
define('TEXT_QUOTE_STATUS_INACTIVE', 'In Active');

define('TEXT_NEW_PRODUCT', 'New Product in &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Categories:');
define('TEXT_SUBCATEGORIES', 'Subcategories:');
define('TEXT_PRODUCTS', 'Products:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Price:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Tax Class:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Average Rating:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Quantity:');
define('TEXT_DATE_ADDED', 'Date Added:');
define('TEXT_DATE_AVAILABLE', 'Date Available:');
define('TEXT_LAST_MODIFIED', 'Last Modified:');
define('TEXT_IMAGE_NONEXISTENT', 'IMAGE DOES NOT EXIST');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Please insert a new category or product in this level.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'For more information, please visit this products <a href="http://%s" target="blank"><u>webpage</u></a>.');
define('TEXT_PRODUCT_DATE_ADDED', 'This product was added to our catalog on %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'This product will be in stock on %s.');

define('TEXT_EDIT_INTRO', 'Please make any necessary changes');
define('TEXT_EDIT_CATEGORIES_ID', 'Category ID:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Category Name:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Category Image:');
define('TEXT_EDIT_SORT_ORDER', 'Sort Order:');

define('TEXT_INFO_COPY_TO_INTRO', 'Please choose a new category you wish to copy this product to');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Current Categories:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'New Category');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Edit Category');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Delete Category');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Move Category');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Delete Product');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Move Product');
define('TEXT_INFO_HEADING_COPY_TO', 'Copy To');

define('TEXT_DELETE_CATEGORY_INTRO', 'Are you sure you want to delete this category?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Are you sure you want to permanently delete this product?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>WARNING:</b> There are %s (child-)categories still linked to this category!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>WARNING:</b> There are %s products still linked to this category!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Please select which category you wish <b>%s</b> to reside in');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Please select which category you wish <b>%s</b> to reside in');
define('TEXT_MOVE', 'Move <b>%s</b> to:');

define('TEXT_NEW_CATEGORY_INTRO', 'Please fill out the following information for the new category');
define('TEXT_CATEGORIES_NAME', 'Category Name:');
define('TEXT_CATEGORIES_IMAGE', 'Category Image:');
define('TEXT_SORT_ORDER', 'Sort Order:');

define('TEXT_PRODUCTS_STATUS', 'Products Status:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Date Available:');
define('TEXT_PRODUCT_AVAILABLE', 'In Stock');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Out of Stock');
define('TEXT_PRODUCTS_MANUFACTURER', 'Products Manufacturer:');
define('TEXT_PRODUCTS_NAME', 'Products Name:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Products Description:');
define('TEXT_PRODUCTS_QUANTITY', 'Products Quantity:');
define('TEXT_PRODUCTS_QUANTITY_ATTRIB', ' (product has attributes)');
define('TEXT_PRODUCTS_MODEL', 'Products Model:');
define('TEXT_PRODUCTS_IMAGE', 'Products Image:');
define('TEXT_PRODUCTS_URL', 'Products URL:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(without http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Products Price (Net):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Products Price (Gross):');
define('TEXT_PRODUCTS_WEIGHT', 'Products Weight:');
define('TEXT_PRODUCTS_CARROT', 'Product is Carrot:');
define('TEXT_CARROT_ISSET', 'This product is a Carrot.');

define('TEXT_CUSTOMERS_GROUPS_NOTE', 'Note that if a field is left empty, no price for that customer group will be inserted in the database.<br />
If a field is filled, but the checkbox is unchecked no price will be inserted either.<br />
If a price is already inserted in the database, but the checkbox unchecked it will be removed from the database.');

define('EMPTY_CATEGORY', 'Empty Category');

define('TEXT_HOW_TO_COPY', 'Copy Method:');
define('TEXT_COPY_AS_LINK', 'Link product');
define('TEXT_COPY_AS_DUPLICATE', 'Duplicate product');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Error: Can not link products in the same category.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Error: Catalog images directory is not writeable: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Error: Catalog images directory does not exist: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Error: Category cannot be moved into child category.');

define('TEXT_PRODUCTS_QTY_BLOCKS', 'Quantity Blocks:');
define('TEXT_PRODUCTS_QTY_BLOCKS_HELP', '(can only order in blocks of X quantity, defaults to 1)');
define('TEXT_PRODUCTS_PRICE', 'Price level');
define('TEXT_PRODUCTS_QTY', 'From');
define('TEXT_PRODUCTS_DELETE', 'Delete');
define('TEXT_ENTER_QUANTITY', 'Quantity');
define('TEXT_PRICE_PER_PIECE', 'Price&nbsp;for&nbsp;each');
define('TEXT_SAVINGS', 'Your savings');
define('TEXT_DISCOUNT_CATEGORY', 'Discount category:');
define('ERROR_UPDATE_INSERT_DISCOUNT_CATEGORY', 'Something went wrong when updating or inserting into the table discount_categories');
define('ERROR_ALL_CUSTOMER_GROUPS_DELETED', 'All customer groups have been deleted, please re-enter at least retail in table customers_groups (see sppc_v421_install.sql)');
define('TEXT_PRODUCTS_MIN_ORDER_QTY', 'Minimum order quantity:');
define('TEXT_PRODUCTS_MIN_ORDER_QTY_HELP', '(defaults to 1,  no need to set a value)');
define('TEXT_PRICE_BREAK_INFO', '<acronym title="as Price(Qty)">Price breaks</acronym>: ');
define('PB_DROPDOWN_BEFORE', '');
define('PB_DROPDOWN_BETWEEN', ' at ');
define('PB_DROPDOWN_AFTER', ' each');
define('PB_FROM', 'from');

define('TEXT_PRODUCTS_SPEC', 'Products Specifications:');
define('TEXT_PRODUCTS_MUSTHAVE', 'Requirement');
define('TEXT_PRODUCTS_EXTRAIMAGE', 'Images');
define('TEXT_PRODUCTS_MANUAL', 'Manual');
define('TEXT_PRODUCTS_EXTRA1', 'Extra');
define('TEXT_PRODUCTS_MOREINFO', 'More info');
define('TEXT_TAB_DESCRIPTION', 'Description');
define('TEXT_TAB_SPEC', 'Spec');
define('TEXT_TAB_MUSTHAVE', 'Requirements');
define('TEXT_TAB_EXTRAIMAGE', 'Images');
define('TEXT_TAB_MANUAL', 'Manual');
define('TEXT_TAB_EXTRA1', 'Extra');
define('TEXT_TAB_MOREINFO', 'More Info');
define('TEXT_TAB_PAGE_TITLE', 'Title Tag');
define('TEXT_TAB_HEADER_DESCRIPTION', 'Descr. Tag');
define('TEXT_TAB_PRODUCTS_KEYWORDS', 'Keywords');

define('TEXT_PRODUCTS_IMAGE_NOTE','<b>Products Image:</b><small><br>Main Image used in<br><u>catalog & description</u> page.<small>');
define('TEXT_PRODUCTS_IMAGE_MEDIUM', '<b>Bigger Image:</b><br><small>REPLACES Small Image on<br><u>products description</u> page.</small>');
define('TEXT_PRODUCTS_IMAGE_LARGE', '<b>Pop-up Image:</b><br><small>REPLACES Small Image on<br><u>pop-up window</u> page.</small>');
define('TEXT_PRODUCTS_IMAGE_LINKED', '<u>Store Product/s Sharring this Image =</u>');
define('TEXT_PRODUCTS_IMAGE_REMOVE', '<b>Remove</b> this Image from this Product?');
define('TEXT_PRODUCTS_IMAGE_DELETE', '<b>Delete</b> this Image from the Server (Permanent!)?');
define('TEXT_PRODUCTS_IMAGE_REMOVE_SHORT', 'Remove');
define('TEXT_PRODUCTS_IMAGE_DELETE_SHORT', 'Delete');
define('TEXT_PRODUCTS_IMAGE_TH_NOTICE', '<b>SM = Small Images,</b> if a "SM" image is used<br>(Alone) NO Pop-up window link is created, the "SM"<br>(small image) will be placed directly under the products<br>description. if used inconjunction with a<br>"XL" image on the right, A Pop-up Window Link<br> is created and the "XL" image will be<br>shown in a Pop-up window.<br><br><b>When you add picture to SM Image 1: -> all pictures will show in Product Tabs!</b><br><br>');
define('TEXT_PRODUCTS_IMAGE_XL_NOTICE', '<b>XL = Large Images,</b> Used for the Pop-up image<br><br><br>');
define('TEXT_PRODUCTS_IMAGE_ADDITIONAL', 'More Addition Images - These will appear below product description if used.');
define('TEXT_PRODUCTS_IMAGE_SM_1', 'SM Image 1:');
define('TEXT_PRODUCTS_IMAGE_XL_1', 'XL Image 1:');
define('TEXT_PRODUCTS_IMAGE_SM_2', 'SM Image 2:');
define('TEXT_PRODUCTS_IMAGE_XL_2', 'XL Image 2:');
define('TEXT_PRODUCTS_IMAGE_SM_3', 'SM Image 3:');
define('TEXT_PRODUCTS_IMAGE_XL_3', 'XL Image 3:');
define('TEXT_PRODUCTS_IMAGE_SM_4', 'SM Image 4:');
define('TEXT_PRODUCTS_IMAGE_XL_4', 'XL Image 4:');
define('TEXT_PRODUCTS_IMAGE_SM_5', 'SM Image 5:');
define('TEXT_PRODUCTS_IMAGE_XL_5', 'XL Image 5:');
define('TEXT_PRODUCTS_IMAGE_SM_6', 'SM Image 6:');
define('TEXT_PRODUCTS_IMAGE_XL_6', 'XL Image 6:');

define('TEXT_YES', 'Yes');
define('TEXT_NO', 'No');
define('TEXT_PARENT_HIDDEN', 'No, Parent Hidden');
define('TEXT_DISPLAY', 'Display In Catalog:');

define('TEXT_PRODUCT_METTA_INFO', '<b>Meta Tag Information</b>');
define('TEXT_PRODUCTS_PAGE_TITLE', 'Product Title Tag:');
define('TEXT_PRODUCTS_HEADER_DESCRIPTION', 'Product Description Tag:');
define('TEXT_PRODUCTS_KEYWORDS', 'Product Keywords Tag:');

define('TEXT_PRODUCTS_TNT_F_TR', '0=Not TNT, 1=Letter, 2=Letterbox-book, 3=Book, 4=Package');
define('TEXT_PRODUCTS_TNT_F_SB', 'TNT sealbag (valuable)');
define('TEXT_PRODUCTS_TNT_F_CS', 'TNT clearingsservice (exportdocument mandatory)');
define('TEXT_TNT_F_YES', 'Yes');
define('TEXT_TNT_F_NO', 'No');

define('TEXT_PRODUCTS_RSS', 'Add this product to the RSS feed');

define('TEXT_INFO_HEADING_NEW_IMAGES', 'Additional Images');
define('TEXT_NEW_IMAGES_INTRO', 'Additional images for this product.<br>');    
define('TEXT_NEW_IMAGES_FOOTER', '<hr><br><u>Upload Help</u><br><br><font color="red">If you only have one image size</font>, upload it as the Thumbnail image only. Leave Product Info and Popup image blank!<br><br>Leave Image Description blank to display default "Click to enlarge" text.<br><br>If you wish to manage all the images on your own, make sure Auto-generate is off and never select the Generate Now checkbox.<br><br>');    
define('TEXT_NEW_IMAGES_AUTO_ON_STATEMENT', '<font color="green">Auto-generate images is on.</font><br> Upload your original image in the Thumb Image field. Leave Product Info and Popup image blank!');
define('TEXT_NEW_IMAGES_AUTO_OFF_STATEMENT', '<font color="red">Auto-generate images is off.</font><br> This option will generate and cache the three image set for all your products on each uploaded image. You may change this option in your configuration section. Look for Additional Images.');
define('TEXT_NEW_IMAGES_MANUALLY_GENERATE', '<font color="red">Generate 3 image set now.</font> Select this checkbox to allow this script to generate the image set from your single large product image.');
define('TEXT_PRODUCTS_IMAGE_UPLOAD_LOCATION', 'Upload Location:');
define('TEXT_PRODUCTS_IMAGE_UPLOAD_LOCATION_NOTE', 'Uploading to:');
define('TEXT_IMAGE_DESCRIPTION_NOTE', '* Leave blank to display default "Click to enlarge" text.');

define('TEXT_IMAGES_CREATE_LARGE_SUCCESS', 'Large file: %s successfully created.');
define('TEXT_IMAGES_CREATE_LARGE_FAIL', 'Large file: %s could not be created.');
define('TEXT_IMAGES_CREATE_THUMB_SUCCESS', 'Thumb file: %s successfully created.');
define('TEXT_IMAGES_CREATE_THUMB_FAIL', 'Thumb file: %s could not be created.');
define('TEXT_IMAGES_CREATE_PRODI_SUCCESS', 'Products Info file: %s successfully created.');
define('TEXT_IMAGES_CREATE_PRODI_FAIL', 'Products Info file: %s could not be created.');
define('TEXT_IMAGES_CREATE_FAIL', 'Your PHP version must be greater then or equal to 4.3.2 to use the thumbnailing feature of this contirbution.');

define('TEXT_DEL_IMAGES_INTRO', 'Delete additional image for this product');
define('TEXT_DELETE_IMAGE', 'Delete this image.');
define('TEXT_PRODUCTS_IMAGES_NEW', 'Thumb or Single Large Image:');
define('TEXT_PRODUCTS_IMAGES_NEWMED', 'Products Info Image (Optional):');
define('TEXT_PRODUCTS_IMAGES_NEWPOP', 'Popup Image (Optional):');
define('TEXT_PRODUCTS_IMAGES_DESC', 'Image Description');
define('ERROR_ADDITIONAL_IMAGE_IS_EMPTY', 'Error: Additional images field is empty');
define('ERROR_NO_ADDITIONAL_IMAGES', 'No Additional Images!');
define('ERROR_DEL_IMG_XTRA','ERROR: Can not delete image ');
define('SUCCESS_DEL_IMG_XTRA','The image was deleted correctly: ');
define('TEXT_PRODUCTS_IMAGE_MED', 'Products Info Image (Optional):');
define('TEXT_PRODUCTS_IMAGE_POP', 'Popup Image (Optional):');
define('ERROR_DEL_IMG_XTRA','ERROR: Can not delete image ');
define('SUCCESS_DEL_IMG_XTRA','The image was deleted correctly: ');
define('ERROR_CATALOG_IMAGE_DIRECTORY_IS_NOT_WRITABLE','This: %s directory is not writable. Attempting to correct...');
define('ERROR_CATALOG_IMAGE_DIRECTORY_CREATE_FAILED','Failed to create directory %s.');
define('SUCCESS_CATALOG_IMAGE_DIRECTORY_CREATED','Directory %s successfully created.');
define('ERROR_SETTING_PERMISSIONS','Directory permissions could not be set on %s.');
define('SUCCESS_SETTING_PERMISSIONS','Directory permissions on %s was set successfully.');
define('ERROR_IMAGE_UPLOAD_FAILED','Image %s was not uploaded. Please check your folder permissions.');
define('SUCCESS_IMAGE_UPLOADED','Image %s was uploaded successfully.');

define('TEXT_BANNERS_TO_CATEGORIES', 'Add Banner to Category');
define('TEXT_BANNERS_CATEGORIES', 'Banners in Category: ');
define('TEXT_DELETE_BANNER_CONFIRM_HEADING', 'Remove Banner from Category');
define('TEXT_DELETE_BANNER_CONFIRM', 'Are you sure you want to delete this banner?');
?>