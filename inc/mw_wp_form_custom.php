<?php


// フック名のxxxの部分はフォーム作成画面を参照してください。
add_filter('mwform_choices_mw-wp-form-2991', function ($children, $atts) {
	if ($atts['name'] == 'party') {
		$partys = get_posts(array(
			'post_type'			=> 'party',
			'post_status'		=> 'publish',
			'posts_per_page'	=> -1,
		));
		$children[] = '';
		foreach ($partys as $party) {
			$children[$party->post_title] = $party->post_title;
		}
		$children[] = '無料婚活相談';
		$children[] = 'お問い合わせ';
		$children[] = 'その他';
	}
	return $children;
}, 10, 2);
