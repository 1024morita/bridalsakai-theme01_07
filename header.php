<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<?php if (preg_match("/Android/", $_SERVER["HTTP_USER_AGENT"]) || preg_match("/iPhone/", $_SERVER["HTTP_USER_AGENT"])) : ?>
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<?php else : ?>
		<meta name="viewport" content="width=1054, shrink-to-fit=no">
	<?php endif; ?>
	<meta name="format-detection" content="telephone=no">
	<?php
	$postid = -1;
	if (get_option('page_for_posts') != 0) {
		$nowurl = $_SERVER['REQUEST_URI'];
		$nowurl = str_replace("/web_index", "", $nowurl);
		$pagedata = get_page(get_option('page_for_posts'));
		if (strstr($nowurl, $pagedata->post_name)) {
			$postid = get_option('page_for_posts');
		} else {
			$postid = $post->ID;
		}
	} else {
		$postid = $post->ID;
	}
	?>
	<title><?php echo do_shortcode('[ISS-ttl data_id=' . $postid . ']'); ?></title>
	<meta name="keywords" content="<?php echo do_shortcode('[ISS-key data_id=' . $postid . ']'); ?>">
	<meta name="description" content="<?php echo do_shortcode('[ISS-desc data_id=' . $postid . ']'); ?>">
	<?php wp_head(); ?>
	<link href="//use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/lightbox.css" media="all">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/slick.css" media="all">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/slick-theme.css" media="all">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/style.css?180420" media="all">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/my.css" media="all">
	<!-- Google Tag Manager -->
	<script>
		(function(w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				'gtm.start': new Date().getTime(),
				event: 'gtm.js'
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != 'dataLayer' ? '&l=' + l : '';
			j.async = true;
			j.src =
				'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-WFKPFDG');
	</script>
	<!-- End Google Tag Manager -->

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11100582107"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'AW-11100582107');
	</script>

	<meta name="facebook-domain-verification" content="t3qc0jwafze3pi74i0ceph49qgc71c" />
	<!-- Meta Pixel Code -->
	<script>
		! function(f, b, e, v, n, t, s) {
			if (f.fbq) return;
			n = f.fbq = function() {
				n.callMethod ?
					n.callMethod.apply(n, arguments) : n.queue.push(arguments)
			};
			if (!f._fbq) f._fbq = n;
			n.push = n;
			n.loaded = !0;
			n.version = '2.0';
			n.queue = [];
			t = b.createElement(e);
			t.async = !0;
			t.src = v;
			s = b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t, s)
		}(window, document, 'script',
			'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '236479242354874');
		fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=236479242354874&ev=PageView&noscript=1" /></noscript>
	<!-- End Meta Pixel Code -->

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=AW-16611534129"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());
		gtag('config', 'AW-16611534129');
	</script>
	<?php if (is_page('complete')) : ?>
		<!-- Event snippet for ページビュー conversion page -->
		<script>
			gtag('event', 'conversion', {
				'send_to': 'AW-16611534129/4cwrCLyXmr8ZELHK__A9',
				'value': 1.0,
				'currency': 'JPY'
			});
		</script>
	<?php endif; ?>
</head>

<body id="pagetop">
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WFKPFDG" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

	<script async src="https://www.googletagmanager.com/gtag/js?id=AW-805633492"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}

		gtag('set', 'linker', {
			'domains': ['bridalsakai.com', 'itsuaki.com'],
			'url_position': 'fragment'
		});
		gtag('js', new Date());
		gtag('config', 'AW-805633492');
	</script>

	<script>
		window.addEventListener('load', function() {
			jQuery('[href="https://www.itsuaki.com/yoyaku/webreserve/staffsel?str_id=4737513062"]').click(function() {
				gtag('event', 'conversion', {
					'send_to': 'AW-805633492/cp7_CLKbo4wBENT7k4AD'
				});
			})
		})
	</script>

	<header id="head_ar">
		<section class="container">
			<section class="bg">
				<section class="bx_l">
					<h1 class="img_l01"><a href="<?php echo home_url('/'); ?>"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/shared/top_head_02.png?2311" alt="<?php echo do_shortcode('[ISS-h1 data_id=' . $postid . ']'); ?>" class="hv"></a></h1>
				</section>
				<section class="bx_r">
					<section class="img_r_ar">
						<section class="img_r01">
							<p class="header_tel">お電話はこちら<br><a href="tel:0722825501"><i class="fas fa-phone fa-flip-horizontal"></i>072-282-5501</a></p>
						</section>
						<section class="img_r02">
							<p class="back-white"><a href="https://www.itsuaki.com/yoyaku/webreserve/menusel?str_id=4737513062&stf_id=0" target="_blank"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/shared/top_head_08.png" alt="24時間WEB予約　無料相談受付中" class="hv"></a></p>
						</section>
						<section class="img_r03">
							<figure><a href="https://line.me/R/ti/p/@847jayzd" target="_blank" rel="noopener noreferrer" class="hv"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/shared/icon_line.png" alt=""></a></figure>
						</section>
					</section>
				</section>
			</section>
		</section>
	</header>
	<header id="nav">
		<section class="container">
			<nav class="gNavi">
				<ul>
					<li><a href="<?php echo home_url('/'); ?>">ホーム</a></li>
					<li><a href="<?php echo home_url('/'); ?>visit/">初めての方へ</a></li>
					<li><a href="<?php echo home_url('/'); ?>features/">当相談所の特長</a></li>
					<li><a href="<?php echo home_url('/'); ?>system/">婚活プラン</a></li>
					<li class="dd"><span>選べる婚活</span>
						<ul>
							<li><a href="<?php echo home_url('/'); ?>recommend-20/">20代の早期婚活の<br>ススメ</a></li>
							<li><a href="<?php echo home_url('/'); ?>recommend-30/">30歳からの婚活の<br>ススメ</a></li>
							<li><a href="<?php echo home_url('/'); ?>saikon/">シングルマザー応援プラン</a></li>
							<li><a href="<?php echo home_url('/'); ?>party/">婚活パーティのご案内</a></li>
							<li><a href="<?php echo home_url('/'); ?>marriages-voice/">成婚者様の声</a></li>
						</ul>
					</li>
					<li><a href="<?php echo home_url('/'); ?>faq/">よくある質問</a></li>
					<li class="dd"><a href="<?php echo home_url('/'); ?>company/">会社案内・アクセス</a>
						<ul>
							<li><a href="<?php echo home_url('/'); ?>staff/">スタッフ紹介</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</section>
	</header>
	<nav class="sp-navi hidden-l">
		<p class="overlay"></p>
		<p class="humberger"><span></span><span></span><span></span></p>
		<section class="sp-navi-inner">
			<p class="bottom-mg-20 text-center sp-nav-bnr">
				<!--<a href="<?php echo home_url('/'); ?>news/ibj-award2021%e5%8f%97%e8%b3%9e%e3%81%84%e3%81%9f%e3%81%97%e3%81%be%e3%81%97%e3%81%9f%e3%80%82/">
					<img src="<?php echo get_stylesheet_directory_uri() ?>/images/shared/page_side_19.jpg" alt="" class="hv" /></a>-->
				<img src="<?php echo get_stylesheet_directory_uri() ?>/images/shared/page_side_19.jpg" alt="" />
			</p>
			<section class="navi-main">
				<ul>
					<li><a href="<?php echo home_url('/'); ?>">ホーム</a></li>
					<li><a href="<?php echo home_url('/'); ?>visit/">初めての方へ</a></li>
					<li><a href="<?php echo home_url('/'); ?>features/">当相談所の特長</a></li>
					<li><a href="<?php echo home_url('/'); ?>system/">婚活プラン</a></li>
					<li class="dd"><span>選べる婚活</span>
						<ul>
							<li><a href="<?php echo home_url('/'); ?>recommend-20/">20代の早期婚活のススメ</a></li>
							<li><a href="<?php echo home_url('/'); ?>recommend-30/">30歳からの婚活のススメ</a></li>
							<li><a href="<?php echo home_url('/'); ?>saikon/">再婚しま専科</a></li>
							<li><a href="<?php echo home_url('/'); ?>marriages-voice/">成婚者様の声</a></li>
						</ul>
					</li>
					<li><a href="<?php echo home_url('/'); ?>party/">婚活パーティのご案内</a></li>
					<li><a href="<?php echo home_url('/'); ?>faq/">よくある質問</a></li>
					<li class="dd"><a href="<?php echo home_url('/'); ?>company/">会社案内・アクセス</a>
						<ul>
							<li><a href="<?php echo home_url('/'); ?>staff/">スタッフ紹介</a></li>
						</ul>
					</li>
				</ul>
			</section>
		</section>
	</nav>
