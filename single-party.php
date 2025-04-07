<?php get_header(); ?>

<header class="h2_style bg02">
	<!--<h2 class="h2_font"><?php echo esc_html(get_post_type_object(get_post_type())->label); ?></h2>-->
</header>
<section class="container">
	<article class="breadcrumb_area">
		<section class="breadcrumb_style">
			<section class="breadcrumb_font">
				<?php if (function_exists('bcn_display')) {
					bcn_display();
				} ?>
			</section>
		</section>
	</article>
	<section class="contents">
		<?php if (have_posts()) : while (have_posts()) : the_post();

				$party_name = esc_attr(get_field('party_name'));
				$party_date = esc_attr(get_field('party_date'));
				$party_space = esc_attr(get_field('party_space'));
				$party_access = wp_kses_post(get_field('party_access'));
				$party_time = esc_attr(get_field('party_time'));
				$party_man = wp_kses_post(get_field('party_man'));
				$party_woman = wp_kses_post(get_field('party_woman'));
				$party_remarks = wp_kses_post(get_field('party_remarks'));

				$table_output = '';

				if (
					$party_name ||
					$party_date ||
					$party_space ||
					$party_access ||
					$party_time ||
					$party_man ||
					$party_woman ||
					$party_remarks
				) {
					$table_output .= '<table class="common_tbl2 tb_bg_gray sp-listlayout left chunk_40-20">';
					$table_output .= '<colgroup><col width="30%"><col width="70%"></colgroup>';
					$table_output .= '<tbody>';

					if ($party_name) {
						$table_output .= '<tr><th>パーティー名</th>';
						$table_output .= '<td>' . $party_name . '</td></tr>';
					}
					if ($party_date) {
						$week = array("日", "月", "火", "水", "木", "金", "土",);
						$week_no = date('w', strtotime($party_date));
						$party_date_format = date('n月j日 (' . $week[date($week_no)] . ')',  strtotime($party_date));
						$table_output .= '<tr><th>開催日</th>';
						$table_output .= '<td>' . $party_date_format . '</td></tr>';
					}
					if ($party_space) {
						$table_output .= '<tr><th>会場名</th>';
						$table_output .= '<td>' . $party_space . '</td></tr>';
					}
					if ($party_access) {
						$table_output .= '<tr><th>場所</th>';
						$table_output .= '<td>' . $party_access . '</td></tr>';
					}
					if ($party_time) {
						$table_output .= '<tr><th>パーティー時間</th>';
						$table_output .= '<td>' . $party_time . '</td></tr>';
					}
					if ($party_man) {
						$table_output .= '<tr><th>男性</th>';
						$table_output .= '<td>' . $party_man . '</td></tr>';
					}
					if ($party_woman) {
						$table_output .= '<tr><th>女性</th>';
						$table_output .= '<td>' . $party_woman . '</td></tr>';
					}
					if ($party_remarks) {
						$table_output .= '<tr><th>備考</th>';
						$table_output .= '<td>' . $party_remarks . '</td></tr>';
					}
					$table_output .= '</tbody></table>';
				}


		?>
				<article id="sing_blog_a">
					<section class="chunk_40-20 clearfix topics_sec">
						<header class="h3_style">
							<h3 class="h3_font">
								<?php the_title(); ?>
							</h3>
						</header>

						<section class="txt">
							<div class="postdata">
								<?php the_content(); ?>
							</div>
							<?php echo $table_output; ?>
							<div class="text-center">
								<a href="<?php echo home_url('/'); ?>contact/">
									<img src="<?php echo get_template_directory_uri(); ?>/images/011/page_11_01.png" alt="ご予約・仮申込はこちら" class="hv">
								</a>
							</div>
						</section>
					</section>
				</article>


			<?php endwhile; ?>
		<?php else : ?>
			<article class="chunk_40-20 clearfix">
				<p class="no_comment">投稿がありません</p>
			</article>
		<?php endif; ?>
		<article class="chunk_40-20 clearfix">
			<ul class="pager">
				<li class="previous">
					<?php next_post_link('%link', '&laquo; Previous') ?>
				</li>
				<li class="return"> <a href="<?php echo esc_url(get_post_type_archive_link('party')); ?>">一覧へ</a> </li>
				<li class="next">
					<?php previous_post_link('%link', 'Next &raquo;') ?>
				</li>
			</ul>
		</article>
	</section>
	<aside class="rNavi">
		<article id="side_post_ar">
			<h3 class="ttl">カテゴリー</h3>
			<ul>
				<?php wp_list_categories(array('title_li' => '', 'taxonomy' => 'news_category', 'show_count' => 0, 'depth' => 1)); ?>
			</ul>
		</article>
		<?php get_sidebar(); ?>
	</aside>
</section>
<?php get_footer(); ?>
