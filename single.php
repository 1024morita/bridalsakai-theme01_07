<?php get_header(); ?>
 <?php 
  $category = get_the_category();
  $cat_name = $category[0]->cat_name;
?>
<header class="h2_style">
  <h2 class="h2_font"><?php echo $cat_name; ?></h2>
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
    <article id="sing_blog_a">
      <section class="chunk_40-20 clearfix topics_sec">
        <header class="h3_style">
          <h3 class="h3_font">
            <?php the_title(); ?>
          </h3>
        </header>
        <section class="cate_ar">
          <p class="cate">
            <?php $category = get_the_category(); $cat_name = $category[0]->cat_name; ?>
            <?php echo $cat_name; ?></p>
        </section>
        <section class="txt">
          <div class="postdata">
            <?php the_content(); ?>
          </div>
        </section>
      </section>
    </article>
    <!-- 投稿見出しここから -->
    <!-- h3+contents start -->
    <?php if( get_field( 'headline_01', $post->ID ) ) { ?>
    <section class="clearfix postdata top-mg-40  bottom-mg-40">
      <header>
        <h3 class="h301  bottom-mg-20 bottom-pad-10"><?php echo get_field( 'headline_01', $post->ID ); ?></h3>
      </header>
      <p><?php echo get_field( 'sentence_01', $post->ID ); ?></p>
    </section>
    <?php } ?>
    <!-- h3+contents end -->
    <!-- h4+contents start -->
    <?php if( get_field( 'headline_02', $post->ID ) ) { ?>
    <section class="clearfix postdata bottom-mg-40">
      <header>
        <h4 class="h401 bottom-mg-20 bottom-pad-10"><?php echo get_field( 'headline_02', $post->ID ); ?></h4>
      </header>
      <p><?php echo get_field( 'sentence_02', $post->ID ); ?></p>
    </section>
    <?php } ?>
    <!-- h4+contents end -->
    <!-- digest start -->
    <?php if( get_field( 'digest', $post->ID ) ) { ?>
    <section class="clearfix postdata bottom-mg-40">
      <header>
        <h3 class="h401 bottom-mg-20 bottom-pad-10">まとめ</h3>
      </header>
      <p><?php echo get_field( 'digest', $post->ID ) ; ?></p>
    </section>
    <?php } ?>
    <!-- digest end -->
    <!-- 投稿見出しここまで -->
    <?php endwhile; ?>
    <?php else: ?>
    <article class="chunk_40-20 clearfix">
      <p class="no_comment">投稿がありません</p>
    </article>
    <?php endif; ?>
    <article class="chunk_40-20 clearfix">
      <ul class="pager">
        <li class="previous">
          <?php next_post_link('%link','&laquo; Previous',true) ?>
        </li>
        <li class="return"> <a href="<?php bloginfo('url'); ?>/category/<?php $cat = get_the_category(); $cat = $cat[0];{echo $cat->category_nicename;} ?>">一覧へ</a> </li>
        <li class="next">
          <?php previous_post_link('%link','Next &raquo;',true) ?>
        </li>
      </ul>
    </article>
  </section>
  <aside class="rNavi">
    <?php get_sidebar();?>
  </aside>
</section>
<?php get_footer();?>
