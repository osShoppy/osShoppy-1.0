<?php //$Id: catalog/install/includes/functions/database.php

  function osc_db_connect($server, $username, $password, $link = 'db_link') {
    global $$link, $db_error;

    $db_error = false;

    if (!$server) {
      $db_error = 'No Server selected.';
      return false;
    }

    $$link = @mysql_connect($server, $username, $password) or $db_error = mysql_error();

    return $$link;
  }

  function osc_db_select_db($database) {
    return mysql_select_db($database);
  }

  function osc_db_query($query, $link = 'db_link') {
    global $$link;

    return mysql_query($query, $$link);
  }

  function osc_db_num_rows($db_query) {
    return mysql_num_rows($db_query);
  }

  function osc_db_install($database, $sql_file) {
    global $db_error;

    $db_error = false;

    if (!@osc_db_select_db($database)) {
      if (@osc_db_query('create database ' . $database)) {
        osc_db_select_db($database);
      } else {
        $db_error = mysql_error();
      }
    }

    if (!$db_error) {
      if (file_exists($sql_file)) {
        $fd = fopen($sql_file, 'rb');
        $restore_query = fread($fd, filesize($sql_file));
        fclose($fd);
      } else {
        $db_error = 'SQL file does not exist: ' . $sql_file;
        return false;
      }

      $sql_array = array();
      $sql_length = strlen($restore_query);
      $pos = strpos($restore_query, ';');
      for ($i=$pos; $i<$sql_length; $i++) {
        if ($restore_query[0] == '#') {
          $restore_query = ltrim(substr($restore_query, strpos($restore_query, "\n")));
          $sql_length = strlen($restore_query);
          $i = strpos($restore_query, ';')-1;
          continue;
        }
        if ($restore_query[($i+1)] == "\n") {
          for ($j=($i+2); $j<$sql_length; $j++) {
            if (trim($restore_query[$j]) != '') {
              $next = substr($restore_query, $j, 6);
              if ($next[0] == '#') {
// find out where the break position is so we can remove this line (#comment line)
                for ($k=$j; $k<$sql_length; $k++) {
                  if ($restore_query[$k] == "\n") break;
                }
                $query = substr($restore_query, 0, $i+1);
                $restore_query = substr($restore_query, $k);
// join the query before the comment appeared, with the rest of the dump
                $restore_query = $query . $restore_query;
                $sql_length = strlen($restore_query);
                $i = strpos($restore_query, ';')-1;
                continue 2;
              }
              break;
            }
          }
          if ($next == '') { // get the last insert query
            $next = 'insert';
          }
          if ( (eregi('create', $next)) || (eregi('insert', $next)) || (eregi('drop t', $next)) ) {
            $next = '';
            $sql_array[] = substr($restore_query, 0, $i);
            $restore_query = ltrim(substr($restore_query, $i+1));
            $sql_length = strlen($restore_query);
            $i = strpos($restore_query, ';')-1;
          }
        }
      }

      osc_db_query("drop table if exists additional_images, address_book, address_format, admin, admin_files, admin_groups, admin_low_notes, admin_low_notes_type, admin_mid_notes, admin_mid_notes_type, admin_top_notes, admin_top_notes_type, affiliate_affiliate, affiliate_banners, affiliate_banners_history, affiliate_clickthroughs, affiliate_news, affiliate_news_contents, affiliate_newsletters, affiliate_payment, affiliate_payment_status, affiliate_payment_status_history, affiliate_sales, anti_robotreg, articles, articles_blog, articles_description, articles_to_topics, articles_xsell, article_reviews, article_reviews_description, authors, authors_info, banned_ip, banners, banners_history, banners_to_categories, bvars, categories, categories_description, configuration, configuration_changes, configuration_group, configuration_group_admin, configuration_group_infobox, configuration_group_modules, configuration_group_pages, configuration_group_template, counter, counter_history, countries, cs, currencies, customers, customers_basket, customers_basket_attributes, customers_groups, customers_info, customers_searches, customer_testimonials, customers_wishlist, customers_wishlist_attributes, discount_categories, documents, document_types, faq, faq_articles, faq_authors, faq_authors_info, faq_blog, faq_description, faq_reviews, faq_reviews_description, faq_topics, faq_topics_description, faq_to_topics, faq_xsell, featured, free_gifts, gallery, gallery_superuser, geo_zones, get_1_free, g_info, g_info_authors, g_info_authors_info, g_info_blog, g_info_description, g_info_reviews, g_info_reviews_description, g_info_topics, g_info_topics_description, g_info_to_topics, g_info_xsell, headertags, headertags_cache, headertags_default, headertags_silo, languages, links, links_check, links_description, links_exchange, links_featured, links_status, links_to_link_categories, link_categories, link_categories_description, manufacturers, manufacturers_info, most_online, msgdb, multi_product_update, newsletters, online, orders, orders_products, orders_products_attributes, orders_products_download, orders_status, orders_status_history, orders_total, pages, pages_description, phesis_comments, phesis_poll_check, phesis_poll_config, phesis_poll_data, phesis_poll_desc, products, products_2gether, products_attributes, products_attributes_download, products_attributes_download_groups, products_attributes_download_groups_files, products_attributes_download_groups_to_files, products_attributes_groups, products_description, products_groups, products_notifications, products_options, products_options_values, products_options_values_to_products_options, products_price_break, products_related_products, products_stock, products_to_categories, products_to_discount_categories, products_to_documents, quotes, refund_method, refund_payments, return_reasons, return_text, returned_products, returns_products_data, returns_status, returns_total, returns_status_history, reviews,
reviews_description, sessions, shop_references, sitemap_exclude, sources, sources_other, specials, specials_retail_prices, supertracker, tax_class, tax_rates, theme_configuration, topics, topics_description, uhtml_newsletters_sent, usu_cache, whos_online, zones, zones_to_geo_zones
");

      for ($i=0; $i<sizeof($sql_array); $i++) {
        osc_db_query($sql_array[$i]);
      }
    } else {
      return false;
    }
  }
?>
