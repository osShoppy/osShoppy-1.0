<?php // searchtagcloud infobox 

  $products_query_raw = "select search, freq from customers_searches where language_id = " .$languages_id." order by search DESC";
  $products_query1 = tep_db_query($products_query_raw);

	class tagcloud {
		// tag-styles: from very tiny to very big
		// var $a_tag_styles = array('font-size:xx-small', 'font-size:x-small', 'font-size:small', 'font-size:medium', 'font-size:large', 'font-size:x-large', 'font-size:xx-large');
		// var $a_tag_styles = array('font-size:9px', 'font-size:6px', 'font-size:7px', 'font-size:8px', 'font-size:9px', 'font-size:10px', 'font-size:11px', 'font-size:12px', 'font-size:13px', 'font-size:17px', 'font-size:20px');
		var $a_tag_styles = array('font-size:9px; color:yellow', 'font-size:6px; color:orange', 'font-size:7px; color:red', 'font-size:8px; color:cyan', 'font-size:9px; color:dark yellow', 'font-size:10px; color:silver','font-size:11px; color:teal', 'font-size:12px; color:violet','font-size:13px; color:turquoise','font-size:17px; color:green', 'font-size:20px; color:#33cc66');  	// how many tags do we want to display?
  	// how many tags do we want to display?
		var $max_shown_tags;
		// the tags
		var $a_tc_data;

		/* Construct */
		function tagcloud($max_shown_tags = SEARCH_TAG_CLOUD_MAX_SHOWN_TAGS) {
			$this->max_shown_tags = $max_shown_tags;
		}

		/**
		 * Saves the date for the tagcloud
		 *
		 * @param	array	$a_tc_data	An array with data. The keys are the actual tags, the values are how often they occure.
		 *								eg.: array('tag1' => 3, 'tag2' => 1, 'tag3' => 7);
		 * @return	bool				Always returns true
		 */
		function set_tagcloud_data($a_tc_data) {
			$this->a_tc_data = $a_tc_data;
			arsort($this->a_tc_data);
			// since we only want a specified number of tags, we strip all the tags, that do not often occure.
			$a_tags = array();
			reset($this->a_tc_data);
			$tag_count = count($this->a_tc_data);
			$i = 1;
			while ($i <= $tag_count && $i <= $this->max_shown_tags) {
				$a_tags[key($this->a_tc_data)] = current($this->a_tc_data);
				next($this->a_tc_data);
				$i++;
			}
			$this->a_tc_data = $a_tags;

			return true;
		}

		/* Create the Tagcloud
		 * @return	string				Returns the HTML code for the tagcloud */
		function get_tagcloud() {
			if (count($this->a_tc_data) <= 0) {
				// no tags
				return '';
			}
			// calculate the range that lies between the the different tag sizes
			reset($this->a_tc_data);
			$count_high = current($this->a_tc_data);
			$count_low = end($this->a_tc_data);

			$range = ($count_high - $count_low) / (count($this->a_tag_styles) - 1);

			// sort the tags alphabetically
			//sort the array by keyword (not casesensitive)
			uksort($this->a_tc_data, "strnatcasecmp");

			// generate the html for the cloud
			if ($range > 0) {
				$b_first = true;
				$prev_search = '';


				foreach ($this->a_tc_data as $tag => $tagcount) {
				$tag1 = str_replace(" ","%20",$tag);
					if ($b_first) {
						$html_cloud = '<div style="width:'. SEARCH_TAG_CLOUD_BOX_WIDTH .'; overflow:hidden"> <a href="' . tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, 'keywords=' . $tag1 . '&search_in_description=1') .'"><span style="' . $this->a_tag_styles[round(($tagcount - $count_low) / $range, 0)] . '">' . $tag . ' </span></a>';
						$b_first = false;
					} else {
						$html_cloud .= '<a href="' . tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, 'keywords=' . $tag1 . '&search_in_description=1') .'"><span style="' . $this->a_tag_styles[round(($tagcount - $count_low) / $range, 0)] . '">' . $tag . ' </span></a>';
					}
				}
				$html_cloud .= '</div>';
			} else {
				// all tags are the same size
				$b_first = true;
				foreach ($this->a_tc_data as $tag => $tagcount) {
					if ($b_first) {
						$html_cloud = '<span class="tag' . $this->a_tag_styles[round((count($this->a_tag_styles)-1) / 2, 0)] . '"><a href="' . tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, 'keywords=' . $tag1 . '&search_in_description=1') .'">' . $tag . '</a></span>';
						$b_first = false;
					} else {
						$html_cloud .= ' <span class="tag' . $this->a_tag_styles[round((count($this->a_tag_styles)-1) / 2, 0)] . '"><a href="' . tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, 'keywords=' . $tag1 . '&search_in_description=1') .'">' . $tag . '</a></span>';
					}
				}
			}

			return $html_cloud;
		}
	}

	 $tc_a_tags = array();

   while ($tcproducts = tep_db_fetch_array($products_query1)) {
	$tc_word = preg_replace('/(<(?:[^"\']|"(?:[^"]|\\\")*?"|\'(?:[^\']|\\\')*?\')*?' . '>)/si', ' ',$tcproducts['search']);
	$tc_freq =  $tcproducts['freq'];

	$tc_a_tags[$tc_word] = $tc_freq;

  }

	$tc_tch = new tagcloud();
	// hand over the tags to the class
	$tc_tch->set_tagcloud_data($tc_a_tags);
	// request the tagcloud
	$tc_tagcloud = $tc_tch->get_tagcloud();

  $boxHeading = BOX_HEADING_TAGCLOUD;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'searchtagcloud';

  $box_id = $box_base_name . 'Box';
  $boxContent = $tc_tagcloud;
  include (bts_select('boxes', $box_base_name));
?>