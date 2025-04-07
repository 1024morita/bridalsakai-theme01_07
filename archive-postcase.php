<?php get_header(); ?>

<header class="h2_style">
  <h2 class="h2_font"><?php echo esc_html(get_post_type_object(get_post_type())->label ); ?></h2>
</header>
<section class="container">
  <article class="breadcrumb_area">
    <section class="breadcrumb_style">
      <section class="breadcrumb_font">
        <?php if(function_exists('bcn_display')) { bcn_display(); }?>
      </section>
    </section>
  </article>
  <section class="contents">
    <?php if(have_posts()) : while (have_posts()) : the_post(); ?>
    <?php if(has_post_thumbnail()): ?>
    <article class="arc_blog_a">
      <section class="chunk_40-20 clearfix">
        <header class="h3_style">
          <h3 class="h3_font"><a href="<?php the_permalink(); ?>">
            <?php the_title_limit(25,"続きを見る"); ?>
            </a></h3>
        </header>
        <section class="rob">
          <section class="coll-4">
            <p class="thumb_img"><a href="<?php the_permalink(); ?>" class="hv">
              <?php the_post_thumbnail(); ?>
              </a></p>
          </section>
          <section class="coll-8">
            <section class="cate_ar">
              <p class="date">
                <?php the_time('Y.m.d'); ?>
              </p>
            </section>
            <p class="txt">
              <?php the_content_limit(80,"続きを見る"); ?>
            </p>
            <p class="bt"><a href="<?php the_permalink(); ?>">続きはこちら</a></p>
          </section>
        </section>
      </section>
    </article>
    <?php else: ?>
    <article class="arc_blog_a">
      <section class="chunk_40-20 clearfix">
        <header class="h3_style">
          <h3 class="h3_font"><a href="<?php the_permalink(); ?>">
            <?php the_title_limit(25,"続きを見る"); ?>
            </a> </h3>
        </header>
        <section>
          <section class="cate_ar">
            <p class="date">
              <?php the_time('Y.m.d'); ?>
            </p>
          </section>
          <p class="txt">
            <?php the_content_limit(80,"続きを見る"); ?>
          </p>
          <p class="bt"><a href="<?php the_permalink(); ?>">続きはこちら</a></p>
        </section>
      </section>
    </article>
    <?php endif; ?>
    <?php endwhile; ?>
    <?php else: ?>
    <article class="chunk_40-20 clearfix">
      <p class="no_comment">投稿がありません</p>
    </article>
    <?php endif; ?>
    <article class="chunk_40-20 clearfix">
      <section class="text-center"><?php echo my_pagination(); ?></section>
    </article>
  </section>
  <aside class="rNavi">
    <?php get_sidebar();?>
  </aside>
</section>
<?php get_footer();?>
