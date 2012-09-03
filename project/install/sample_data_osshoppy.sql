###########################################################################################################
######################################## START OSSHOPPY SAMPLE DATA #######################################
###########################################################################################################


###########################################################################################################
######################################### END OSSHOPPY SAMPLE DATA ########################################
###########################################################################################################

INSERT INTO categories VALUES ('1', 'osshoppy/demo_download.png', '0', '1', now(), null, '1');
INSERT INTO categories VALUES ('2', 'osshoppy/templates.png', '0', '2', now(), null, '1');
INSERT INTO categories VALUES ('3', 'osshoppy/manual.png', '0', '3', now(), null, '1');

INSERT INTO categories_description VALUES ( '1', '1', 'Downloads','','','','');
INSERT INTO categories_description VALUES ( '1', '2', 'Downloads','','','','');
INSERT INTO categories_description VALUES ( '2', '1', 'Templates','','','','');
INSERT INTO categories_description VALUES ( '2', '2', 'Templates','','','','');
INSERT INTO categories_description VALUES ( '3', '1', 'Handleiding','','','','');
INSERT INTO categories_description VALUES ( '3', '2', 'Manual','','','','');

INSERT INTO manufacturers VALUES (1,'osShoppy Webwinkels','osshoppy/osshoppy.png', now(), null);
INSERT INTO manufacturers VALUES (2,'Hilvy Webhosting','osshoppy/hilvy.png', now(), null);

INSERT INTO manufacturers_info VALUES (1, 1, 'http://www.osshoppy.com', 0, null,'','','','','');
INSERT INTO manufacturers_info VALUES (1, 2, 'http://www.osshoppy.com', 0, null,'','','','','');
INSERT INTO manufacturers_info VALUES (2, 1, 'http://http://www.hilvy.nl', 0, null,'','','','','');
INSERT INTO manufacturers_info VALUES (2, 2, 'http://http://www.hilvy.nl', 0, null,'','','','','');

INSERT INTO products VALUES (1,99,'v2.0 Beta','demo_download.png','','','','','','','','','','','','','','','','',12.56, now(),null,null,0,1,1,2,1,4,0,0,1,0,'','','','');

INSERT INTO products_description VALUES (1,1,'Demo Download','osShoppy Demo Download','','','','','','','',0,'','','');
INSERT INTO products_description VALUES (1,2,'Demo Download','osShoppy Demo Download','','','','','','','',0,'','','');

INSERT INTO products_to_categories VALUES (1,1);

INSERT INTO products_options VALUES (1,1,'Versie',1);
INSERT INTO products_options VALUES (1,2,'Versie',1);

INSERT INTO products_options_values VALUES (1,1,'-> download');
INSERT INTO products_options_values VALUES (1,2,'-> download');
INSERT INTO products_options_values VALUES (2,1,'-> cd rom');
INSERT INTO products_options_values VALUES (2,2,'-> cd rom');

INSERT INTO products_attributes VALUES (1,30,1,1,'12.56','-',0);
INSERT INTO products_attributes VALUES (2,30,1,2,'0.0000','+',1);

INSERT INTO products_attributes_download VALUES (1,'demo.zip','','365','12');
