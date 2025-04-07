<?php get_header(); the_post();?>

<header class="h2_style">
  <h2 class="h2_font">
    <?php the_title(); ?>
  </h2>
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
    <?php the_content(); ?>
  </section>
  <aside class="rNavi">
    <?php get_sidebar();?>
  </aside>
</section>
<?php get_footer();?>
