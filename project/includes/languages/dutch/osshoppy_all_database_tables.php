<?php
//$Id: /catalog/includes/languages/dutch/osshoppy_all_database_tables.php
//editing this file can cause ERRORS
//only edit text between the 2nd 'quotes'

define('NAVBAR_TITLE', 'osShoppy Database Tabellen');
define('HEADING_TITLE', 'osShoppy Database Tabellen');

define('HEADING_TABLES_NEWS', 'Database Tabellen');
define('HEADING_TOTAL_TABLES', 'Totaal aantal Tabellen');
define('HEADING_TABLES', 'Tabellen Overzicht');

define('TEXT_TABLES_NEWS', 'Tabellen');
define('TEXT_TOTAL_TABLES', 'Het osShoppy Systeem heeft op het moment 168 tabellen.<br>');

// Definitions of the FAQ questions
define('TABLE_1', 'additional_images');
define('TABLE_2', 'address_book');
define('TABLE_3', 'address_format');
define('TABLE_4', 'admin');
define('TABLE_5', 'admin_files');
define('TABLE_6', 'admin_groups');
define('TABLE_7', 'admin_low_notes');
define('TABLE_8', 'admin_mid_notes');
define('TABLE_9', 'admin_top_notes');
define('TABLE_10', 'admin_low_notes_type');
define('TABLE_11', 'admin_mid_notes_type');
define('TABLE_12', 'admin_top_notes_type');
define('TABLE_13', '');
define('TABLE_14', '');
define('TABLE_15', '');
define('TABLE_16', '');
define('TABLE_17', '');
define('TABLE_18', '');
define('TABLE_19', '');
define('TABLE_20', '');
define('TABLE_21', '');
define('TABLE_22', '');
define('TABLE_23', '');
define('TABLE_24', '');
define('TABLE_25', '');
define('TABLE_26', '');
define('TABLE_27', '');
define('TABLE_28', '');
define('TABLE_29', '');
define('TABLE_30', '');
define('TABLE_31', '');
define('TABLE_32', '');
define('TABLE_33', '');
define('TABLE_34', '');
define('TABLE_35', '');
define('TABLE_36', '');
define('TABLE_37', '');
define('TABLE_38', '');
define('TABLE_39', '');
define('TABLE_40', '');
define('TABLE_41', '');
define('TABLE_42', '');
define('TABLE_43', '');
define('TABLE_44', '');
define('TABLE_45', '');
define('TABLE_46', '');
define('TABLE_47', '');
define('TABLE_48', '');
define('TABLE_49', '');
define('TABLE_50', '');
define('TABLE_51', '');
define('TABLE_52', '');
define('TABLE_53', '');
define('TABLE_54', '');
define('TABLE_55', '');
define('TABLE_56', '');
define('TABLE_57', '');
define('TABLE_58', '');
define('TABLE_59', '');
define('TABLE_60', '');
define('TABLE_61', '');
define('TABLE_62', '');
define('TABLE_63', '');
define('TABLE_64', '');
define('TABLE_65', '');
define('TABLE_66', '');
define('TABLE_67', '');
define('TABLE_68', '');
define('TABLE_69', '');
define('TABLE_70', '');
define('TABLE_71', '');
define('TABLE_72', '');
define('TABLE_73', '');
define('TABLE_74', '');
define('TABLE_75', '');
define('TABLE_76', '');
define('TABLE_77', '');
define('TABLE_78', '');
define('TABLE_79', '');
define('TABLE_80', '');
define('TABLE_81', '');
define('TABLE_82', '');
define('TABLE_83', '');
define('TABLE_84', '');
define('TABLE_85', '');
define('TABLE_86', '');
define('TABLE_87', '');
define('TABLE_88', '');
define('TABLE_89', '');
define('TABLE_90', '');
define('TABLE_91', '');
define('TABLE_92', '');
define('TABLE_93', '');
define('TABLE_94', '');
define('TABLE_95', '');
define('TABLE_96', '');
define('TABLE_97', '');
define('TABLE_98', '');
define('TABLE_99', '');
define('TABLE_100', '');
define('TABLE_101', '');
define('TABLE_102', '');
define('TABLE_103', '');
define('TABLE_104', '');
define('TABLE_105', '');
define('TABLE_106', '');
define('TABLE_107', '');
define('TABLE_108', '');
define('TABLE_109', '');
define('TABLE_110', '');
define('TABLE_111', '');
define('TABLE_112', '');
define('TABLE_113', '');
define('TABLE_114', '');
define('TABLE_115', '');
define('TABLE_116', '');
define('TABLE_117', '');
define('TABLE_118', '');
define('TABLE_119', '');
define('TABLE_120', '');
define('TABLE_121', '');
define('TABLE_122', '');
define('TABLE_123', '');
define('TABLE_124', '');
define('TABLE_125', '');
define('TABLE_126', '');
define('TABLE_127', '');
define('TABLE_128', '');
define('TABLE_129', '');
define('TABLE_130', '');
define('TABLE_131', '');
define('TABLE_132', '');
define('TABLE_133', '');
define('TABLE_134', '');
define('TABLE_135', '');
define('TABLE_136', '');
define('TABLE_137', '');
define('TABLE_138', '');
define('TABLE_139', '');
define('TABLE_140', '');
define('TABLE_141', '');
define('TABLE_142', '');
define('TABLE_143', '');
define('TABLE_144', '');
define('TABLE_145', '');
define('TABLE_146', '');
define('TABLE_147', '');
define('TABLE_148', '');
define('TABLE_149', '');
define('TABLE_150', '');
define('TABLE_151', '');
define('TABLE_152', '');
define('TABLE_153', '');
define('TABLE_154', '');
define('TABLE_155', '');
define('TABLE_156', '');
define('TABLE_157', '');
define('TABLE_158', '');
define('TABLE_159', '');
define('TABLE_160', '');
define('TABLE_161', '');
define('TABLE_162', '');
define('TABLE_163', '');
define('TABLE_164', '');
define('TABLE_165', '');
define('TABLE_166', '');
define('TABLE_167', '');
define('TABLE_168', '');

define('TEXT_TABLE_1', '<b>
	   DROP TABLE IF EXISTS additional_images;<br>
CREATE TABLE additional_images (<br>
  additional_images_id int(11) NOT NULL auto_increment,<br>
  products_id int(11) NOT NULL default 0,<br>
  images_description varchar(64) default NULL,<br>
  thumb_images varchar(255) default NULL,<br>
  medium_images varchar(255) default NULL,<br>
  popup_images varchar(255) default NULL,<br>
  PRIMARY KEY  (additional_images_id),<br>
  KEY products_id (products_id)<br>
  ) TYPE=MyISAM AUTO_INCREMENT=1;
<br><br></b>');
define('TEXT_TABLE_2', '<b>
	   DROP TABLE IF EXISTS address_book;<br>
CREATE TABLE address_book (<br>
   address_book_id int NOT NULL auto_increment,<br>
   customers_id int NOT NULL,<br>
   entry_gender char(1) NOT NULL,<br>
   entry_company varchar(32),<br>
   entry_firstname varchar(32) NOT NULL,<br>
   entry_insertion varchar(32) NOT NULL,<br>
   entry_lastname varchar(32) NOT NULL,<br>
   entry_street_address varchar(64) NOT NULL,<br>
   entry_street_no varchar(16) NOT NULL,<br>
   entry_street_no_add varchar(32) NOT NULL,<br>
   entry_suburb varchar(32),<br>
   entry_postcode varchar(10) NOT NULL,<br>
   entry_city varchar(32) NOT NULL,<br>
   entry_state varchar(32),<br>
   entry_country_id int default \'0\' NOT NULL,<br>
   entry_zone_id int default \'0\' NOT NULL,<br>
   PRIMARY KEY (address_book_id),<br>
   KEY idx_address_book_customers_id (customers_id)<br>
   );
<br><br></b>');
define('TEXT_TABLE_3', '<b>
	   DROP TABLE IF EXISTS address_format;<br>
CREATE TABLE address_format (<br>
  address_format_id int NOT NULL auto_increment,<br>
  address_format varchar(128) NOT NULL,<br>
  address_summary varchar(48) NOT NULL,<br>
  PRIMARY KEY (address_format_id)<br>
);
</b><br><br>');
define('TEXT_TABLE_4', '<b>
	   DROP TABLE IF EXISTS admin;<br>
CREATE TABLE admin (<br>
  admin_id int(11) NOT NULL auto_increment,<br>
  admin_groups_id int(11) default NULL,<br>
  admin_firstname varchar(32) NOT NULL default \'\',<br>
  admin_lastname varchar(32) default NULL,<br>
  admin_email_address varchar(96) NOT NULL default \'\',<br>
  admin_password varchar(40) NOT NULL default \'\',<br>
  admin_created datetime default NULL,<br>
  admin_modified datetime NOT NULL default \'0000-00-00 00:00:00\',<br>
  admin_logdate datetime default NULL,<br>
  admin_lognum int(11) NOT NULL default \'0\',<br>
  admin_cat_access TEXT NOT NULL,<br>
  admin_right_access TEXT NOT NULL,<br>
  PRIMARY KEY  (admin_id),<br>
  UNIQUE KEY admin_email_address (admin_email_address)  <br>
);
</b><br><br>');
define('TEXT_TABLE_5', '<b>
	   DROP TABLE IF EXISTS admin_files;<br>
CREATE TABLE admin_files (<br>
  admin_files_id int(11) NOT NULL auto_increment,<br>
  admin_files_name varchar(64) NOT NULL default \'\',<br>
  admin_files_is_boxes tinyint(5) NOT NULL default \'0\',<br>
  admin_files_to_boxes int(11) NOT NULL default \'0\',<br>
  admin_groups_id set(\'1\',\'2\',\'3\') NOT NULL default \'1\',<br>
  PRIMARY KEY  (admin_files_id)<br>
);
</b><br><br>');
define('TEXT_TABLE_6', '<b>
	   DROP TABLE IF EXISTS admin_groups;<br>
CREATE TABLE admin_groups (<br>
  admin_groups_id int(11) NOT NULL auto_increment,<br>
  admin_groups_name varchar(64) default NULL,<br>
  PRIMARY KEY  (admin_groups_id),<br>
  UNIQUE KEY admin_groups_name (admin_groups_name)<br>
);
</b><br><br>');
define('TEXT_TABLE_7', '<b>
DROP TABLE IF EXISTS admin_low_notes;<br>
CREATE TABLE admin_low_notes (<br>
  contr_id int(11) NOT NULL auto_increment,<br>
  admin_note varchar(255) NOT NULL default \'\',<br>
  config_comments longtext,<br>
  category varchar(40) NOT NULL default \'\',<br>
  status tinyint(1) NOT NULL default \'2\',<br>
  date_status_change datetime NOT NULL default \'0000-00-00 00:00:00\',<br>
  note_created datetime NOT NULL default \'0000-00-00 00:00:00\',<br>
  contr_last_modified datetime NOT NULL default \'0000-00-00 00:00:00\',<br>
  last_update varchar(10) default NULL,<br>
  KEY config_id (contr_id)<br>
) TYPE=MyISAM;
</b><br><br>');
define('TEXT_TABLE_8', '<b>
	   DROP TABLE IF EXISTS admin_mid_notes;<br>
CREATE TABLE admin_mid_notes (<br>
  contr_id int(11) NOT NULL auto_increment,<br>
  admin_note varchar(255) NOT NULL default \'\',<br>
  config_comments longtext,<br>
  category varchar(40) NOT NULL default \'\',<br>
  status tinyint(1) NOT NULL default \'2\',<br>
  date_status_change datetime NOT NULL default \'0000-00-00 00:00:00\',<br>
  note_created datetime NOT NULL default \'0000-00-00 00:00:00\',<br>
  contr_last_modified datetime NOT NULL default \'0000-00-00 00:00:00\',<br>
  last_update varchar(10) default NULL,<br>
  KEY config_id (contr_id)<br>
) TYPE=MyISAM;
</b><br><br>');
define('TEXT_TABLE_9', '<b>
	   DROP TABLE IF EXISTS admin_top_notes;<br>
CREATE TABLE admin_top_notes (<br>
  contr_id int(11) NOT NULL auto_increment,<br>
  admin_note varchar(255) NOT NULL default \'\',<br>
  config_comments longtext,<br>
  category varchar(40) NOT NULL default \'\',<br>
  status tinyint(1) NOT NULL default \'2\',<br>
  date_status_change datetime NOT NULL default \'0000-00-00 00:00:00\',<br>
  note_created datetime NOT NULL default \'0000-00-00 00:00:00\',<br>
  contr_last_modified datetime NOT NULL default \'0000-00-00 00:00:00\',<br>
  last_update varchar(10) default NULL,<br>
  KEY config_id (contr_id)<br>
) TYPE=MyISAM;
</b><br><br>');
define('TEXT_TABLE_10', '<b>
	   DROP TABLE IF EXISTS admin_low_notes_type;<br>
CREATE TABLE admin_low_notes_type (<br>
  type_id int(11) NOT NULL default \'0\',<br>
  type_name varchar(40) NOT NULL default \'\',<br>
  status tinyint(1) NOT NULL default \'0\'<br>
) TYPE=MyISAM;
</b><br><br>');
define('TEXT_TABLE_11', '<b>
	   DROP TABLE IF EXISTS admin_mid_notes_type;<br>
CREATE TABLE admin_mid_notes_type (<br>
  type_id int(11) NOT NULL default \'0\',<br>
  type_name varchar(40) NOT NULL default \'\',<br>
  status tinyint(1) NOT NULL default \'0\'<br>
) TYPE=MyISAM;
</b><br><br>');
define('TEXT_TABLE_12', '<b>
	   DROP TABLE IF EXISTS admin_top_notes_type;<br>
CREATE TABLE admin_top_notes_type (<br>
  type_id int(11) NOT NULL default \'0\',<br>
  type_name varchar(40) NOT NULL default \'\',<br>
  status tinyint(1) NOT NULL default \'0\'<br>
) TYPE=MyISAM;
</b><br><br>');
define('TEXT_TABLE_13', '<b>
</b><br><br>');
define('TEXT_TABLE_14', '<b></b><br><br>');
define('TEXT_TABLE_15', '<b></b><br><br>');
define('TEXT_TABLE_16', '<b></b><br><br>');
define('TEXT_TABLE_17', '<b></b><br><br>');
define('TEXT_TABLE_18', '<b></b><br><br>');
define('TEXT_TABLE_19', '<b></b><br><br>');
define('TEXT_TABLE_20', '<b></b><br><br>');
define('TEXT_TABLE_21', '<b></b><br><br>');
define('TEXT_TABLE_22', '<b></b><br><br>');
define('TEXT_TABLE_23', '<b></b><br><br>');
define('TEXT_TABLE_24', '<b></b><br><br>');
define('TEXT_TABLE_25', '<b></b><br><br>');
define('TEXT_TABLE_26', '<b></b><br><br>');
define('TEXT_TABLE_27', '<b></b><br><br>');
define('TEXT_TABLE_28', '<b></b><br><br>');
define('TEXT_TABLE_29', '<b></b><br><br>');
define('TEXT_TABLE_30', '<b></b><br><br>');
define('TEXT_TABLE_31', '<b></b><br><br>');
define('TEXT_TABLE_32', '<b></b><br><br>');
define('TEXT_TABLE_33', '<b></b><br><br>');
define('TEXT_TABLE_34', '<b></b><br><br>');
define('TEXT_TABLE_35', '<b></b><br><br>');
define('TEXT_TABLE_36', '<b></b><br><br>');
define('TEXT_TABLE_37', '<b></b><br><br>');
define('TEXT_TABLE_38', '<b></b><br><br>');
define('TEXT_TABLE_39', '<b></b><br><br>');
define('TEXT_TABLE_40', '<b></b><br><br>');
define('TEXT_TABLE_41', '<b></b><br><br>');
define('TEXT_TABLE_42', '<b></b><br><br>');
define('TEXT_TABLE_43', '<b></b><br><br>');
define('TEXT_TABLE_44', '<b></b><br><br>');
define('TEXT_TABLE_45', '<b></b><br><br>');
define('TEXT_TABLE_46', '<b></b><br><br>');
define('TEXT_TABLE_47', '<b></b><br><br>');
define('TEXT_TABLE_48', '<b></b><br><br>');
define('TEXT_TABLE_49', '<b></b><br><br>');
define('TEXT_TABLE_50', '<b></b><br><br>');
define('TEXT_TABLE_51', '<b></b><br><br>');
define('TEXT_TABLE_52', '<b></b><br><br>');
define('TEXT_TABLE_53', '<b></b><br><br>');
define('TEXT_TABLE_54', '<b></b><br><br>');
define('TEXT_TABLE_55', '<b></b><br><br>');
define('TEXT_TABLE_56', '<b></b><br><br>');
define('TEXT_TABLE_57', '<b></b><br><br>');
define('TEXT_TABLE_58', '<b></b><br><br>');
define('TEXT_TABLE_59', '<b></b><br><br>');
define('TEXT_TABLE_60', '<b></b><br><br>');
define('TEXT_TABLE_61', '<b></b><br><br>');
define('TEXT_TABLE_62', '<b></b><br><br>');
define('TEXT_TABLE_63', '<b></b><br><br>');
define('TEXT_TABLE_64', '<b></b><br><br>');
define('TEXT_TABLE_65', '<b></b><br><br>');
define('TEXT_TABLE_66', '<b></b><br><br>');
define('TEXT_TABLE_67', '<b></b><br><br>');
define('TEXT_TABLE_68', '<b></b><br><br>');
define('TEXT_TABLE_69', '<b></b><br><br>');
define('TEXT_TABLE_70', '<b></b><br><br>');
define('TEXT_TABLE_71', '<b></b><br><br>');
define('TEXT_TABLE_72', '<b></b><br><br>');
define('TEXT_TABLE_73', '<b></b><br><br>');
define('TEXT_TABLE_74', '<b></b><br><br>');
define('TEXT_TABLE_75', '<b></b><br><br>');
define('TEXT_TABLE_76', '<b></b><br><br>');
define('TEXT_TABLE_77', '<b></b><br><br>');
define('TEXT_TABLE_78', '<b></b><br><br>');
define('TEXT_TABLE_79', '<b></b><br><br>');
define('TEXT_TABLE_80', '<b></b><br><br>');
define('TEXT_TABLE_81', '<b></b><br><br>');
define('TEXT_TABLE_82', '<b></b><br><br>');
define('TEXT_TABLE_83', '<b></b><br><br>');
define('TEXT_TABLE_84', '<b></b><br><br>');
define('TEXT_TABLE_85', '<b></b><br><br>');
define('TEXT_TABLE_86', '<b></b><br><br>');
define('TEXT_TABLE_87', '<b></b><br><br>');
define('TEXT_TABLE_88', '<b></b><br><br>');
define('TEXT_TABLE_89', '<b></b><br><br>');
define('TEXT_TABLE_90', '<b></b><br><br>');
define('TEXT_TABLE_91', '<b></b><br><br>');
define('TEXT_TABLE_92', '<b></b><br><br>');
define('TEXT_TABLE_93', '<b></b><br><br>');
define('TEXT_TABLE_94', '<b></b><br><br>');
define('TEXT_TABLE_95', '<b></b><br><br>');
define('TEXT_TABLE_96', '<b></b><br><br>');
define('TEXT_TABLE_97', '<b></b><br><br>');
define('TEXT_TABLE_98', '<b></b><br><br>');
define('TEXT_TABLE_99', '<b></b><br><br>');
define('TEXT_TABLE_100', '<b></b><br><br>');
define('TEXT_TABLE_101', '<b></b><br><br>');
define('TEXT_TABLE_102', '<b></b><br><br>');
define('TEXT_TABLE_103', '<b></b><br><br>');
define('TEXT_TABLE_104', '<b></b><br><br>');
define('TEXT_TABLE_105', '<b></b><br><br>');
define('TEXT_TABLE_106', '<b></b><br><br>');
define('TEXT_TABLE_107', '<b></b><br><br>');
define('TEXT_TABLE_108', '<b></b><br><br>');
define('TEXT_TABLE_109', '<b></b><br><br>');
define('TEXT_TABLE_110', '<b></b><br><br>');
define('TEXT_TABLE_111', '<b></b><br><br>');
define('TEXT_TABLE_112', '<b></b><br><br>');
define('TEXT_TABLE_113', '<b></b><br><br>');
define('TEXT_TABLE_114', '<b></b><br><br>');
define('TEXT_TABLE_115', '<b></b><br><br>');
define('TEXT_TABLE_116', '<b></b><br><br>');
define('TEXT_TABLE_117', '<b></b><br><br>');
define('TEXT_TABLE_118', '<b></b><br><br>');
define('TEXT_TABLE_119', '<b></b><br><br>');
define('TEXT_TABLE_120', '<b></b><br><br>');
define('TEXT_TABLE_121', '<b></b><br><br>');
define('TEXT_TABLE_122', '<b></b><br><br>');
define('TEXT_TABLE_123', '<b></b><br><br>');
define('TEXT_TABLE_124', '<b></b><br><br>');
define('TEXT_TABLE_125', '<b></b><br><br>');
define('TEXT_TABLE_126', '<b></b><br><br>');
define('TEXT_TABLE_127', '<b></b><br><br>');
define('TEXT_TABLE_128', '<b></b><br><br>');
define('TEXT_TABLE_129', '<b></b><br><br>');
define('TEXT_TABLE_130', '<b></b><br><br>');
define('TEXT_TABLE_131', '<b></b><br><br>');
define('TEXT_TABLE_132', '<b></b><br><br>');
define('TEXT_TABLE_133', '<b></b><br><br>');
define('TEXT_TABLE_134', '<b></b><br><br>');
define('TEXT_TABLE_135', '<b></b><br><br>');
define('TEXT_TABLE_136', '<b></b><br><br>');
define('TEXT_TABLE_137', '<b></b><br><br>');
define('TEXT_TABLE_138', '<b></b><br><br>');
define('TEXT_TABLE_139', '<b></b><br><br>');
define('TEXT_TABLE_140', '<b></b><br><br>');
define('TEXT_TABLE_141', '<b></b><br><br>');
define('TEXT_TABLE_142', '<b></b><br><br>');
define('TEXT_TABLE_143', '<b></b><br><br>');
define('TEXT_TABLE_144', '<b></b><br><br>');
define('TEXT_TABLE_145', '<b></b><br><br>');
define('TEXT_TABLE_146', '<b></b><br><br>');
define('TEXT_TABLE_147', '<b></b><br><br>');
define('TEXT_TABLE_148', '<b></b><br><br>');
define('TEXT_TABLE_149', '<b></b><br><br>');
define('TEXT_TABLE_150', '<b></b><br><br>');
define('TEXT_TABLE_151', '<b></b><br><br>');
define('TEXT_TABLE_152', '<b></b><br><br>');
define('TEXT_TABLE_153', '<b></b><br><br>');
define('TEXT_TABLE_154', '<b></b><br><br>');
define('TEXT_TABLE_155', '<b></b><br><br>');
define('TEXT_TABLE_156', '<b></b><br><br>');
define('TEXT_TABLE_157', '<b></b><br><br>');
define('TEXT_TABLE_158', '<b></b><br><br>');
define('TEXT_TABLE_159', '<b></b><br><br>');
define('TEXT_TABLE_160', '<b></b><br><br>');
define('TEXT_TABLE_161', '<b></b><br><br>');
define('TEXT_TABLE_162', '<b></b><br><br>');
define('TEXT_TABLE_163', '<b></b><br><br>');
define('TEXT_TABLE_164', '<b></b><br><br>');
define('TEXT_TABLE_165', '<b></b><br><br>');
define('TEXT_TABLE_166', '<b></b><br><br>');
define('TEXT_TABLE_167', '<b></b><br><br>');
define('TEXT_TABLE_168', '<b></b><br><br>');

// Below is the section that will actually displax on the FAQ page
define('TEXT_TABLES', '<a name="Top"></a></span>
<ol>
  <li><a href="javascript:show(\'answer_q1\');">'. TABLE_1 .'</a><br /><div id="answer_q1">'. TEXT_TABLE_1 .'</div>
  <li><a href="javascript:show(\'answer_q2\');">'. TABLE_2 .'</a><br /><div id="answer_q2">'.	TEXT_TABLE_2 .'</div>
  <li><a href="javascript:show(\'answer_q3\');">'. TABLE_3 .'</a><br /><div id="answer_q3">'. TEXT_TABLE_3 .'</div>
  <li><a href="javascript:show(\'answer_q4\');">'. TABLE_4 .'</a><br /><div id="answer_q4">'. TEXT_TABLE_4 .'</div>
  <li><a href="javascript:show(\'answer_q5\');">'. TABLE_5 .'</a><br /><div id="answer_q5">'. TEXT_TABLE_5 .'</div>
  <li><a href="javascript:show(\'answer_q6\');">'. TABLE_6 .'</a><br /><div id="answer_q6">'. TEXT_TABLE_6 .'</div>
  <li><a href="javascript:show(\'answer_q7\');">'. TABLE_7 .'</a><br /><div id="answer_q7">'. TEXT_TABLE_7 .'</div>
  <li><a href="javascript:show(\'answer_q8\');">'. TABLE_8 .'</a><br /><div id="answer_q8">'. TEXT_TABLE_8 .'</div>
  <li><a href="javascript:show(\'answer_q9\');">'. TABLE_9 .'</a><br /><div id="answer_q9">'. TEXT_TABLE_9 .'</div>
  <li><a href="javascript:show(\'answer_q10\');">'. TABLE_10 .'</a><br /><div id="answer_q10">'. TEXT_TABLE_10 .'</div>
  <li><a href="javascript:show(\'answer_q11\');">'. TABLE_11 .'</a><br /><div id="answer_q11">'. TEXT_TABLE_11 .'</div>
  <li><a href="javascript:show(\'answer_q12\');">'. TABLE_12 .'</a><br /><div id="answer_q12">'. TEXT_TABLE_12 .'</div>
  <li><a href="javascript:show(\'answer_q13\');">'. TABLE_13 .'</a><br /><div id="answer_q13">'. TEXT_TABLE_13 .'</div>
  <li><a href="javascript:show(\'answer_q14\');">'. TABLE_14 .'</a><br /><div id="answer_q14">'. TEXT_TABLE_14 .'</div>
  <li><a href="javascript:show(\'answer_q15\');">'. TABLE_15 .'</a><br /><div id="answer_q15">'. TEXT_TABLE_15 .'</div>
  <li><a href="javascript:show(\'answer_q16\');">'. TABLE_16 .'</a><br /><div id="answer_q16">'. TEXT_TABLE_16 .'</div>
  <li><a href="javascript:show(\'answer_q17\');">'. TABLE_17 .'</a><br /><div id="answer_q17">'. TEXT_TABLE_17 .'</div>
  <li><a href="javascript:show(\'answer_q18\');">'. TABLE_18 .'</a><br /><div id="answer_q18">'. TEXT_TABLE_18 .'</div>
  <li><a href="javascript:show(\'answer_q19\');">'. TABLE_19 .'</a><br /><div id="answer_q19">'. TEXT_TABLE_19 .'</div>
  <li><a href="javascript:show(\'answer_q20\');">'. TABLE_20 .'</a><br /><div id="answer_q20">'. TEXT_TABLE_20 .'</div>
  <li><a href="javascript:show(\'answer_q21\');">'. TABLE_21 .'</a><br /><div id="answer_q21">'. TEXT_TABLE_21 .'</div>
  <li><a href="javascript:show(\'answer_q22\');">'. TABLE_22 .'</a><br /><div id="answer_q22">'. TEXT_TABLE_22 .'</div>
  <li><a href="javascript:show(\'answer_q23\');">'. TABLE_23 .'</a><br /><div id="answer_q23">'. TEXT_TABLE_23 .'</div>
  <li><a href="javascript:show(\'answer_q24\');">'. TABLE_24 .'</a><br /><div id="answer_q24">'. TEXT_TABLE_24 .'</div>
  <li><a href="javascript:show(\'answer_q25\');">'. TABLE_25 .'</a><br /><div id="answer_q25">'. TEXT_TABLE_25 .'</div>
  <li><a href="javascript:show(\'answer_q26\');">'. TABLE_26 .'</a><br /><div id="answer_q26">'. TEXT_TABLE_26 .'</div>
  <li><a href="javascript:show(\'answer_q27\');">'. TABLE_27 .'</a><br /><div id="answer_q27">'. TEXT_TABLE_27 .'</div>
  <li><a href="javascript:show(\'answer_q28\');">'. TABLE_28 .'</a><br /><div id="answer_q28">'. TEXT_TABLE_28 .'</div>
  <li><a href="javascript:show(\'answer_q29\');">'. TABLE_29 .'</a><br /><div id="answer_q29">'. TEXT_TABLE_29 .'</div>
  <li><a href="javascript:show(\'answer_q30\');">'. TABLE_30 .'</a><br /><div id="answer_q30">'. TEXT_TABLE_30 .'</div>
  <li><a href="javascript:show(\'answer_q31\');">'. TABLE_31 .'</a><br /><div id="answer_q31">'. TEXT_TABLE_31 .'</div>
  <li><a href="javascript:show(\'answer_q32\');">'. TABLE_32 .'</a><br /><div id="answer_q32">'. TEXT_TABLE_32 .'</div>
  <li><a href="javascript:show(\'answer_q33\');">'. TABLE_33 .'</a><br /><div id="answer_q33">'. TEXT_TABLE_33 .'</div>
  <li><a href="javascript:show(\'answer_q34\');">'. TABLE_34 .'</a><br /><div id="answer_q34">'. TEXT_TABLE_34 .'</div>
  <li><a href="javascript:show(\'answer_q35\');">'. TABLE_35 .'</a><br /><div id="answer_q35">'. TEXT_TABLE_35 .'</div>
  <li><a href="javascript:show(\'answer_q36\');">'. TABLE_36 .'</a><br /><div id="answer_q36">'. TEXT_TABLE_36 .'</div>
  <li><a href="javascript:show(\'answer_q37\');">'. TABLE_37 .'</a><br /><div id="answer_q37">'. TEXT_TABLE_37 .'</div>
  <li><a href="javascript:show(\'answer_q38\');">'. TABLE_38 .'</a><br /><div id="answer_q38">'. TEXT_TABLE_38 .'</div>
  <li><a href="javascript:show(\'answer_q39\');">'. TABLE_39 .'</a><br /><div id="answer_q39">'. TEXT_TABLE_39 .'</div>
  <li><a href="javascript:show(\'answer_q40\');">'. TABLE_40 .'</a><br /><div id="answer_q40">'. TEXT_TABLE_40 .'</div>
  <li><a href="javascript:show(\'answer_q41\');">'. TABLE_41 .'</a><br /><div id="answer_q41">'. TEXT_TABLE_41 .'</div>
  <li><a href="javascript:show(\'answer_q42\');">'. TABLE_42 .'</a><br /><div id="answer_q42">'. TEXT_TABLE_42 .'</div>
  <li><a href="javascript:show(\'answer_q43\');">'. TABLE_43 .'</a><br /><div id="answer_q43">'. TEXT_TABLE_43 .'</div>
  <li><a href="javascript:show(\'answer_q44\');">'. TABLE_44 .'</a><br /><div id="answer_q44">'. TEXT_TABLE_44 .'</div>
  <li><a href="javascript:show(\'answer_q45\');">'. TABLE_45 .'</a><br /><div id="answer_q45">'. TEXT_TABLE_45 .'</div>
  <li><a href="javascript:show(\'answer_q46\');">'. TABLE_46 .'</a><br /><div id="answer_q46">'. TEXT_TABLE_46 .'</div>
  <li><a href="javascript:show(\'answer_q47\');">'. TABLE_47 .'</a><br /><div id="answer_q47">'. TEXT_TABLE_47 .'</div>
  <li><a href="javascript:show(\'answer_q48\');">'. TABLE_48 .'</a><br /><div id="answer_q48">'. TEXT_TABLE_48 .'</div>
  <li><a href="javascript:show(\'answer_q49\');">'. TABLE_49 .'</a><br /><div id="answer_q49">'. TEXT_TABLE_49 .'</div>
  <li><a href="javascript:show(\'answer_q50\');">'. TABLE_50 .'</a><br /><div id="answer_q50">'. TEXT_TABLE_50 .'</div>
  <li><a href="javascript:show(\'answer_q51\');">'. TABLE_51 .'</a><br /><div id="answer_q51">'. TEXT_TABLE_51 .'</div>
  <li><a href="javascript:show(\'answer_q52\');">'. TABLE_52 .'</a><br /><div id="answer_q52">'. TEXT_TABLE_52 .'</div>
  <li><a href="javascript:show(\'answer_q53\');">'. TABLE_53 .'</a><br /><div id="answer_q53">'. TEXT_TABLE_53 .'</div>
  <li><a href="javascript:show(\'answer_q54\');">'. TABLE_54 .'</a><br /><div id="answer_q54">'. TEXT_TABLE_54 .'</div>
  <li><a href="javascript:show(\'answer_q55\');">'. TABLE_55 .'</a><br /><div id="answer_q55">'. TEXT_TABLE_55 .'</div>
  <li><a href="javascript:show(\'answer_q56\');">'. TABLE_56 .'</a><br /><div id="answer_q56">'. TEXT_TABLE_56 .'</div>
  <li><a href="javascript:show(\'answer_q57\');">'. TABLE_57 .'</a><br /><div id="answer_q57">'. TEXT_TABLE_57 .'</div>
  <li><a href="javascript:show(\'answer_q58\');">'. TABLE_58 .'</a><br /><div id="answer_q58">'. TEXT_TABLE_58 .'</div>
  <li><a href="javascript:show(\'answer_q59\');">'. TABLE_59 .'</a><br /><div id="answer_q59">'. TEXT_TABLE_59 .'</div>
  <li><a href="javascript:show(\'answer_q60\');">'. TABLE_60 .'</a><br /><div id="answer_q60">'. TEXT_TABLE_60 .'</div>
  <li><a href="javascript:show(\'answer_q61\');">'. TABLE_61 .'</a><br /><div id="answer_q61">'. TEXT_TABLE_61 .'</div>
  <li><a href="javascript:show(\'answer_q62\');">'. TABLE_62 .'</a><br /><div id="answer_q62">'. TEXT_TABLE_62 .'</div>
  <li><a href="javascript:show(\'answer_q63\');">'. TABLE_63 .'</a><br /><div id="answer_q63">'. TEXT_TABLE_63 .'</div>
  <li><a href="javascript:show(\'answer_q64\');">'. TABLE_64 .'</a><br /><div id="answer_q64">'. TEXT_TABLE_64 .'</div>
  <li><a href="javascript:show(\'answer_q65\');">'. TABLE_65 .'</a><br /><div id="answer_q65">'. TEXT_TABLE_65 .'</div>
  <li><a href="javascript:show(\'answer_q66\');">'. TABLE_66 .'</a><br /><div id="answer_q66">'. TEXT_TABLE_66 .'</div>
  <li><a href="javascript:show(\'answer_q67\');">'. TABLE_67 .'</a><br /><div id="answer_q67">'. TEXT_TABLE_67 .'</div>
  <li><a href="javascript:show(\'answer_q68\');">'. TABLE_68 .'</a><br /><div id="answer_q68">'. TEXT_TABLE_68 .'</div>
  <li><a href="javascript:show(\'answer_q69\');">'. TABLE_69 .'</a><br /><div id="answer_q69">'. TEXT_TABLE_69 .'</div>
  <li><a href="javascript:show(\'answer_q70\');">'. TABLE_70 .'</a><br /><div id="answer_q70">'. TEXT_TABLE_70 .'</div>
  <li><a href="javascript:show(\'answer_q71\');">'. TABLE_71 .'</a><br /><div id="answer_q71">'. TEXT_TABLE_71 .'</div>
  <li><a href="javascript:show(\'answer_q72\');">'. TABLE_72 .'</a><br /><div id="answer_q72">'. TEXT_TABLE_72 .'</div>
  <li><a href="javascript:show(\'answer_q73\');">'. TABLE_73 .'</a><br /><div id="answer_q73">'. TEXT_TABLE_73 .'</div>
  <li><a href="javascript:show(\'answer_q74\');">'. TABLE_74 .'</a><br /><div id="answer_q74">'. TEXT_TABLE_74 .'</div>
  <li><a href="javascript:show(\'answer_q75\');">'. TABLE_75 .'</a><br /><div id="answer_q75">'. TEXT_TABLE_75 .'</div>
  <li><a href="javascript:show(\'answer_q76\');">'. TABLE_76 .'</a><br /><div id="answer_q76">'. TEXT_TABLE_76 .'</div>
  <li><a href="javascript:show(\'answer_q77\');">'. TABLE_77 .'</a><br /><div id="answer_q77">'. TEXT_TABLE_77 .'</div>
  <li><a href="javascript:show(\'answer_q78\');">'. TABLE_78 .'</a><br /><div id="answer_q78">'. TEXT_TABLE_78 .'</div>
  <li><a href="javascript:show(\'answer_q79\');">'. TABLE_79 .'</a><br /><div id="answer_q79">'. TEXT_TABLE_79 .'</div>
  <li><a href="javascript:show(\'answer_q80\');">'. TABLE_80 .'</a><br /><div id="answer_q80">'. TEXT_TABLE_80 .'</div>
  <li><a href="javascript:show(\'answer_q81\');">'. TABLE_81 .'</a><br /><div id="answer_q81">'. TEXT_TABLE_81 .'</div>
  <li><a href="javascript:show(\'answer_q82\');">'. TABLE_82 .'</a><br /><div id="answer_q82">'. TEXT_TABLE_82 .'</div>
  <li><a href="javascript:show(\'answer_q83\');">'. TABLE_83 .'</a><br /><div id="answer_q83">'. TEXT_TABLE_83 .'</div>
  <li><a href="javascript:show(\'answer_q84\');">'. TABLE_84 .'</a><br /><div id="answer_q84">'. TEXT_TABLE_84 .'</div>
  <li><a href="javascript:show(\'answer_q85\');">'. TABLE_85 .'</a><br /><div id="answer_q85">'. TEXT_TABLE_85 .'</div>
  <li><a href="javascript:show(\'answer_q86\');">'. TABLE_86 .'</a><br /><div id="answer_q86">'. TEXT_TABLE_86 .'</div>
  <li><a href="javascript:show(\'answer_q87\');">'. TABLE_87 .'</a><br /><div id="answer_q87">'. TEXT_TABLE_87 .'</div>
  <li><a href="javascript:show(\'answer_q88\');">'. TABLE_88 .'</a><br /><div id="answer_q88">'. TEXT_TABLE_88 .'</div>
  <li><a href="javascript:show(\'answer_q89\');">'. TABLE_89 .'</a><br /><div id="answer_q89">'. TEXT_TABLE_89 .'</div>
  <li><a href="javascript:show(\'answer_q90\');">'. TABLE_90 .'</a><br /><div id="answer_q90">'. TEXT_TABLE_90 .'</div>
  <li><a href="javascript:show(\'answer_q91\');">'. TABLE_91 .'</a><br /><div id="answer_q91">'. TEXT_TABLE_91 .'</div>
  <li><a href="javascript:show(\'answer_q92\');">'. TABLE_92 .'</a><br /><div id="answer_q92">'. TEXT_TABLE_92 .'</div>
  <li><a href="javascript:show(\'answer_q93\');">'. TABLE_93 .'</a><br /><div id="answer_q93">'. TEXT_TABLE_93 .'</div>
  <li><a href="javascript:show(\'answer_q94\');">'. TABLE_94 .'</a><br /><div id="answer_q94">'. TEXT_TABLE_94 .'</div>
  <li><a href="javascript:show(\'answer_q95\');">'. TABLE_95 .'</a><br /><div id="answer_q95">'. TEXT_TABLE_95 .'</div>
  <li><a href="javascript:show(\'answer_q96\');">'. TABLE_96 .'</a><br /><div id="answer_q96">'. TEXT_TABLE_96 .'</div>
  <li><a href="javascript:show(\'answer_q97\');">'. TABLE_97 .'</a><br /><div id="answer_q97">'. TEXT_TABLE_97 .'</div>
  <li><a href="javascript:show(\'answer_q98\');">'. TABLE_98 .'</a><br /><div id="answer_q98">'. TEXT_TABLE_98 .'</div>
  <li><a href="javascript:show(\'answer_q99\');">'. TABLE_99 .'</a><br /><div id="answer_q99">'. TEXT_TABLE_99 .'</div>
  <li><a href="javascript:show(\'answer_q100\');">'. TABLE_100 .'</a><br /><div id="answer_q100">'. TEXT_TABLE_100 .'</div>
  <li><a href="javascript:show(\'answer_q101\');">'. TABLE_101 .'</a><br /><div id="answer_q101">'. TEXT_TABLE_101 .'</div>
  <li><a href="javascript:show(\'answer_q102\');">'. TABLE_102 .'</a><br /><div id="answer_q102">'. TEXT_TABLE_102 .'</div>
  <li><a href="javascript:show(\'answer_q103\');">'. TABLE_103 .'</a><br /><div id="answer_q103">'. TEXT_TABLE_103 .'</div>
  <li><a href="javascript:show(\'answer_q104\');">'. TABLE_104 .'</a><br /><div id="answer_q104">'. TEXT_TABLE_104 .'</div>
  <li><a href="javascript:show(\'answer_q105\');">'. TABLE_105 .'</a><br /><div id="answer_q105">'. TEXT_TABLE_105 .'</div>
  <li><a href="javascript:show(\'answer_q106\');">'. TABLE_106 .'</a><br /><div id="answer_q106">'. TEXT_TABLE_106 .'</div>
  <li><a href="javascript:show(\'answer_q107\');">'. TABLE_107 .'</a><br /><div id="answer_q107">'. TEXT_TABLE_107 .'</div>
  <li><a href="javascript:show(\'answer_q108\');">'. TABLE_108 .'</a><br /><div id="answer_q108">'. TEXT_TABLE_108 .'</div>
  <li><a href="javascript:show(\'answer_q109\');">'. TABLE_109 .'</a><br /><div id="answer_q109">'. TEXT_TABLE_109 .'</div>
  <li><a href="javascript:show(\'answer_q110\');">'. TABLE_110 .'</a><br /><div id="answer_q110">'. TEXT_TABLE_110 .'</div>
  <li><a href="javascript:show(\'answer_q111\');">'. TABLE_111 .'</a><br /><div id="answer_q111">'. TEXT_TABLE_111 .'</div>
  <li><a href="javascript:show(\'answer_q112\');">'. TABLE_112 .'</a><br /><div id="answer_q112">'. TEXT_TABLE_112 .'</div>
  <li><a href="javascript:show(\'answer_q113\');">'. TABLE_113 .'</a><br /><div id="answer_q113">'. TEXT_TABLE_113 .'</div>
  <li><a href="javascript:show(\'answer_q114\');">'. TABLE_114 .'</a><br /><div id="answer_q114">'. TEXT_TABLE_114 .'</div>
  <li><a href="javascript:show(\'answer_q115\');">'. TABLE_115 .'</a><br /><div id="answer_q115">'. TEXT_TABLE_115 .'</div>
  <li><a href="javascript:show(\'answer_q116\');">'. TABLE_116 .'</a><br /><div id="answer_q116">'. TEXT_TABLE_116 .'</div>
  <li><a href="javascript:show(\'answer_q117\');">'. TABLE_117 .'</a><br /><div id="answer_q117">'. TEXT_TABLE_117 .'</div>
  <li><a href="javascript:show(\'answer_q118\');">'. TABLE_118 .'</a><br /><div id="answer_q118">'. TEXT_TABLE_118 .'</div>
  <li><a href="javascript:show(\'answer_q119\');">'. TABLE_119 .'</a><br /><div id="answer_q119">'. TEXT_TABLE_119 .'</div>
  <li><a href="javascript:show(\'answer_q120\');">'. TABLE_120 .'</a><br /><div id="answer_q120">'. TEXT_TABLE_120 .'</div>
  <li><a href="javascript:show(\'answer_q121\');">'. TABLE_121 .'</a><br /><div id="answer_q121">'. TEXT_TABLE_121 .'</div>
  <li><a href="javascript:show(\'answer_q122\');">'. TABLE_122 .'</a><br /><div id="answer_q122">'. TEXT_TABLE_122 .'</div>
  <li><a href="javascript:show(\'answer_q123\');">'. TABLE_123 .'</a><br /><div id="answer_q123">'. TEXT_TABLE_123 .'</div>
  <li><a href="javascript:show(\'answer_q124\');">'. TABLE_124 .'</a><br /><div id="answer_q124">'. TEXT_TABLE_124 .'</div>
  <li><a href="javascript:show(\'answer_q125\');">'. TABLE_125 .'</a><br /><div id="answer_q125">'. TEXT_TABLE_125 .'</div>
  <li><a href="javascript:show(\'answer_q126\');">'. TABLE_126 .'</a><br /><div id="answer_q126">'. TEXT_TABLE_126 .'</div>
  <li><a href="javascript:show(\'answer_q127\');">'. TABLE_127 .'</a><br /><div id="answer_q127">'. TEXT_TABLE_127 .'</div>
  <li><a href="javascript:show(\'answer_q128\');">'. TABLE_128 .'</a><br /><div id="answer_q128">'. TEXT_TABLE_128 .'</div>
  <li><a href="javascript:show(\'answer_q129\');">'. TABLE_129 .'</a><br /><div id="answer_q129">'. TEXT_TABLE_129 .'</div>
  <li><a href="javascript:show(\'answer_q130\');">'. TABLE_130 .'</a><br /><div id="answer_q130">'. TEXT_TABLE_130 .'</div>
  <li><a href="javascript:show(\'answer_q131\');">'. TABLE_131 .'</a><br /><div id="answer_q131">'. TEXT_TABLE_131 .'</div>
  <li><a href="javascript:show(\'answer_q132\');">'. TABLE_132 .'</a><br /><div id="answer_q132">'. TEXT_TABLE_132 .'</div>
  <li><a href="javascript:show(\'answer_q133\');">'. TABLE_133 .'</a><br /><div id="answer_q133">'. TEXT_TABLE_133 .'</div>
  <li><a href="javascript:show(\'answer_q134\');">'. TABLE_134 .'</a><br /><div id="answer_q134">'. TEXT_TABLE_134 .'</div>
  <li><a href="javascript:show(\'answer_q135\');">'. TABLE_135 .'</a><br /><div id="answer_q135">'. TEXT_TABLE_135 .'</div>
  <li><a href="javascript:show(\'answer_q136\');">'. TABLE_136 .'</a><br /><div id="answer_q136">'. TEXT_TABLE_136 .'</div>
  <li><a href="javascript:show(\'answer_q137\');">'. TABLE_137 .'</a><br /><div id="answer_q137">'. TEXT_TABLE_137 .'</div>
  <li><a href="javascript:show(\'answer_q138\');">'. TABLE_138 .'</a><br /><div id="answer_q138">'. TEXT_TABLE_138 .'</div>
  <li><a href="javascript:show(\'answer_q139\');">'. TABLE_139 .'</a><br /><div id="answer_q139">'. TEXT_TABLE_139 .'</div>
  <li><a href="javascript:show(\'answer_q140\');">'. TABLE_140 .'</a><br /><div id="answer_q140">'. TEXT_TABLE_140 .'</div>
  <li><a href="javascript:show(\'answer_q141\');">'. TABLE_141 .'</a><br /><div id="answer_q141">'. TEXT_TABLE_141 .'</div>
  <li><a href="javascript:show(\'answer_q142\');">'. TABLE_142 .'</a><br /><div id="answer_q142">'. TEXT_TABLE_142 .'</div>
  <li><a href="javascript:show(\'answer_q143\');">'. TABLE_143 .'</a><br /><div id="answer_q143">'. TEXT_TABLE_143 .'</div>
  <li><a href="javascript:show(\'answer_q144\');">'. TABLE_144 .'</a><br /><div id="answer_q144">'. TEXT_TABLE_144 .'</div>
  <li><a href="javascript:show(\'answer_q145\');">'. TABLE_145 .'</a><br /><div id="answer_q145">'. TEXT_TABLE_145 .'</div>
  <li><a href="javascript:show(\'answer_q146\');">'. TABLE_146 .'</a><br /><div id="answer_q146">'. TEXT_TABLE_146 .'</div>
  <li><a href="javascript:show(\'answer_q147\');">'. TABLE_147 .'</a><br /><div id="answer_q147">'. TEXT_TABLE_147 .'</div>
  <li><a href="javascript:show(\'answer_q148\');">'. TABLE_148 .'</a><br /><div id="answer_q148">'. TEXT_TABLE_148 .'</div>
  <li><a href="javascript:show(\'answer_q149\');">'. TABLE_149 .'</a><br /><div id="answer_q149">'. TEXT_TABLE_149 .'</div>
  <li><a href="javascript:show(\'answer_q150\');">'. TABLE_150 .'</a><br /><div id="answer_q150">'. TEXT_TABLE_150 .'</div>
  <li><a href="javascript:show(\'answer_q151\');">'. TABLE_151 .'</a><br /><div id="answer_q151">'. TEXT_TABLE_151 .'</div>
  <li><a href="javascript:show(\'answer_q152\');">'. TABLE_152 .'</a><br /><div id="answer_q152">'. TEXT_TABLE_152 .'</div>
  <li><a href="javascript:show(\'answer_q153\');">'. TABLE_153 .'</a><br /><div id="answer_q153">'. TEXT_TABLE_153 .'</div>
  <li><a href="javascript:show(\'answer_q154\');">'. TABLE_154 .'</a><br /><div id="answer_q154">'. TEXT_TABLE_154 .'</div>
  <li><a href="javascript:show(\'answer_q155\');">'. TABLE_155 .'</a><br /><div id="answer_q155">'. TEXT_TABLE_155 .'</div>
  <li><a href="javascript:show(\'answer_q156\');">'. TABLE_156 .'</a><br /><div id="answer_q156">'. TEXT_TABLE_156 .'</div>
  <li><a href="javascript:show(\'answer_q157\');">'. TABLE_157 .'</a><br /><div id="answer_q157">'. TEXT_TABLE_157 .'</div>
  <li><a href="javascript:show(\'answer_q158\');">'. TABLE_158 .'</a><br /><div id="answer_q158">'. TEXT_TABLE_158 .'</div>
  <li><a href="javascript:show(\'answer_q159\');">'. TABLE_159 .'</a><br /><div id="answer_q159">'. TEXT_TABLE_159 .'</div>
  <li><a href="javascript:show(\'answer_q160\');">'. TABLE_160 .'</a><br /><div id="answer_q160">'. TEXT_TABLE_160 .'</div>
  <li><a href="javascript:show(\'answer_q161\');">'. TABLE_161 .'</a><br /><div id="answer_q161">'. TEXT_TABLE_161 .'</div>
  <li><a href="javascript:show(\'answer_q162\');">'. TABLE_162 .'</a><br /><div id="answer_q162">'. TEXT_TABLE_162 .'</div>
  <li><a href="javascript:show(\'answer_q163\');">'. TABLE_163 .'</a><br /><div id="answer_q163">'. TEXT_TABLE_163 .'</div>
  <li><a href="javascript:show(\'answer_q164\');">'. TABLE_164 .'</a><br /><div id="answer_q164">'. TEXT_TABLE_164 .'</div>
  <li><a href="javascript:show(\'answer_q165\');">'. TABLE_165 .'</a><br /><div id="answer_q165">'. TEXT_TABLE_165 .'</div>
  <li><a href="javascript:show(\'answer_q166\');">'. TABLE_166 .'</a><br /><div id="answer_q166">'. TEXT_TABLE_166 .'</div>
  <li><a href="javascript:show(\'answer_q167\');">'. TABLE_167 .'</a><br /><div id="answer_q167">'. TEXT_TABLE_167 .'</div>
  <li><a href="javascript:show(\'answer_q168\');">'. TABLE_168 .'</a><br /><div id="answer_q168">'. TEXT_TABLE_168 .'</div>
</ol>');
?>
