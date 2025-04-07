<?php
function the_post_meta($key, $default = '')
{
	echo get_the_post_meta($key, $default);
}

function get_the_post_meta($key, $default = '', $single = true)
{
	global $post;

	if ($meta = get_post_meta($post->ID, $key, $single)) {
		return $meta;
	}

	return $default;
}

function get_excerpt($text, $length = 200)
{
	$text = str_replace(array("\r\n", "\r", "\n", "  "), "", $text);
	$text = str_replace(array("\""), "", $text);
	$text = trim(strip_tags($text));
	$ellipsis = '';

	if(mb_strlen($text) > $length) {
		$ellipsis = '...';
	}

	return mb_substr($text, 0, $length) . $ellipsis;
}

function ms_calc_media_url($blog_id, $media_url)
{
	global $wpdb;

	$url = preg_replace('|^' . get_blog_option($blog_id, 'siteurl') . '/(files/[\d]{4}/[\d]{2}/.+)$|', get_blog_option($wpdb->siteid, 'siteurl') . '/wp-content/blogs.dir/' . $blog_id . '/$1', $media_url);

	return $url;
}

function get_post_thumbnail_src($post_id = null)
{
	global $post;

	if (!$post_id && $post) {
		$post_id = $post->ID;
	}

	if (
		has_post_thumbnail($post_id)
		&& ($post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), ''))
	) {
		return $post_thumbnail_src[0];
	}

	return '';
}

function get_post_thumbnail_alt($post_id = null)
{
	global $post;

	if (!$post_id && $post) {
		$post_id = $post->ID;
	}

	if (
		has_post_thumbnail($post_id)
		&& ($attachment_id = get_post_thumbnail_id($post_id))
		&& ($attachment =& get_post($attachment_id))
	) {
		$alt = trim(strip_tags(get_post_meta($attachment_id, '_wp_attachment_image_alt', true)));

		if (empty($alt)) {
			$alt = trim(strip_tags($attachment->post_excerpt));
		}

		if (empty($alt)) {
			$alt = trim(strip_tags($attachment->post_title));
		}

		return $alt;
	}

	return '';
}

function get_weekday_jp($time)
{
	$num = date('w', strtotime($time));
	$weekday = array("日", "月", "火", "水", "木", "金", "土");

	return isset($weekday[$num]) ? $weekday[$num] : null;
}

function get_weekday_en($time, $short = false)
{
	$num = date('w', strtotime($time));
	$weekday = $short
			 ? array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat")
			 : array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");

	return isset($weekday[$num]) ? $weekday[$num] : null;
}

function get_gengou($time, $format = '%s%s')
{
	list($y, $m, $d) = explode(' ', date('Y m d', strtotime($time)));
	$ret = '';

	//明治以前であれば何もしない
	if ($y < 1868) {
		return($ret);
	}

	if ($y >= 1868 && $y < 1912) {
		$ret = "明治";

	} else if ($y >= 1913 && $y < 1926) {
		$ret = "大正";

	} else if ($y >= 1927 && $y < 1989) {
		$ret = "昭和";

	} else if ($y >= 1990) {
		$ret = "平成";

	} else if ($y == 1912) {
		if ($m < 7){
			$ret = "明治";

		} else if ($m > 7){
			$ret = "大正";

		} else {
			if( $d <= 29 ){
				$ret = "明治";

			} else{
				$ret = "大正";
			}
		}

	} else if ($y == 1926) {
		if ($m < 12){
			$ret = "大正";

		} else {
			if ($d <= 24){
				$ret = "大正";

			} else {
				$ret = "昭和";
			}
		}

	} else if ($y == 1989) {
		if ($m > 1){
			$ret = "平成";

		} else {
			if ($d <= 7){
				$ret = "昭和";

			} else{
				$ret = "平成";
			}
		}
	}

	if ($ret == "明治") {
		$year = $y - 1867;

	} else if ($ret == "大正") {
		$year = $y - 1911;

	} else if ($ret == "昭和") {
		$year = $y - 1925;

	} else if ($ret == "平成") {
		$year = $y - 1988;
	}

	return sprintf($format, $ret, $year);
}

function pagination($pages = '', $range = 5)
{
	global $paged;

	if (empty($paged)) {
		$paged = 1;
	}

	if ($pages == '') {
		global $wp_query;
		$pages = $wp_query->max_num_pages;

		if (!$pages) {
			$pages = 1;
		}
	}

	$content = '';

	if(1 != $pages) {
		ob_start();

		echo "<div class='pagination'>";

		for ($i = 1; $i <= $pages; $i++) {
			if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
				echo ($paged == $i) ? "<span class='current'>" . $i . "</span>" : "<a href='" . get_pagenum_link($i) . "' class='inactive' >" . $i . "</a>";
			}
		}

		echo "</div>\n";

		$content = ob_get_clean();
	}

	return $content;
}

function the_pagination($pages = '', $range = 5)
{
	echo pagination($pages, $range);
}

function create_url($url, $query = array())
{
	$query_string = is_array($query) ? http_build_query($query) : $query;

	if ($query_string) {
		$url .= (strrpos($url, '?') !== false) ? '&amp;' . $query_string : '?' . $query_string;
	}

	return $url;
}

function get_url_ife($key, $query = array())
{
	$if = 'url_' . $key . '_is_outer';
	$permalink = 'url_' . $key;
	$outerlink = 'url_' . $key . '_outer';

	$url = null;

	if (!get_option($if) && ($page_id = get_option($permalink))) {
		$url = get_permalink($page_id);

	} else if ($outerlink_url = get_option($outerlink)) {
		$url = $outerlink_url;
	}

	return create_url($url, $query);
}

function is_url_window($key)
{
	if (get_option('url_' . $key . '_window')) {
		return true;
	}

	return false;
}

function get_link_ife($key, $title, $attr = array())
{
	$query = icf_extract($attr, 'query');

	$url = get_url_ife($key, $query);
	$attr = array_merge($attr, array('href' => $url));

	if (is_url_window($key)) {
		$attr['target'] = '_blank';
	}

	if (!$title) {
		$title = $url;
	}

	$_root_relative_current = untrailingslashit( $_SERVER['REQUEST_URI'] );
	$current_url = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_root_relative_current;
	$_indexless_current = untrailingslashit(preg_replace('/index.php$/', '', $current_url));
	$raw_url = strpos($url, '#') ? substr($url, 0, strpos($url, '#' )) : $url;
	$url = untrailingslashit($raw_url);

	if (in_array($url, array($current_url, $_indexless_current, $_root_relative_current))) {
		ICF_Tag_Element_Node::add_class($attr, 'current');
	}

	return ICF_Tag::create('a', $attr, $title);
}

function get_term_permalink($term, $taxonomy = '')
{
	$url = get_term_link($term, $taxonomy);

	if (is_wp_error($url)) {
		return '';
	}

	return $url;
}

function auto_link($text, $window = false) {
	$placeholders = array();
	$patterns = array(
		'#(?<!href="|src="|">)((?:https?|ftp|nntp)://[^\s<>()]+)#i',
		'#(?<!href="|">)(?<!\b[[:punct:]])(?<!http://|https://|ftp://|nntp://)www.[^\n\%\ <]+[^<\n\%\,\.\ <](?<!\))#i'
	);

	foreach ($patterns as $pattern) {
		if (preg_match_all($pattern, $text, $matches)) {
			foreach ($matches[0] as $match) {
				$key = md5($match);
				$placeholders[$key] = $match;
				$text = str_replace($match, $key, $text);
			}
		}
	}

	$replace = array();

	foreach ($placeholders as $md5 => $url) {
		$link = $url;

		if (!preg_match('#^[a-z]+\://#', $url)) {
			$url = 'http://' . $url;
		}

		$replace[$md5] = "<a href=\"{$url}\"";

		if ($window) {
			$replace[$md5] .= " target=\"_blank\"";
		}

		$replace[$md5] .= ">{$url}</a>";
	}

	return strtr($text, $replace);
}
