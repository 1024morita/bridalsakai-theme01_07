<?php
// ファイルディレクトリ
$theme_inc_dir = dirname(__FILE__).'/inc/';

// カスタム投稿の追加
$create_post_type_file_name = $theme_inc_dir.'create_post_type.php';
if ( is_file( $create_post_type_file_name ) ) {
  require_once($create_post_type_file_name);
}

// mw wp formのカスタム
$mw_wp_form_custom_file_name = $theme_inc_dir.'mw_wp_form_custom.php';
if ( is_file( $mw_wp_form_custom_file_name ) ) {
  require_once($mw_wp_form_custom_file_name );
}


//----------------------------------------------
// プラグインの自動更新を有効化
// メジャーアップグレードの自動更新を有効化
//----------------------------------------------
add_filter( 'auto_update_plugin', '__return_true' );
add_filter( 'allow_major_auto_core_updates', '__return_true' );
//----------------------------------------------
// WordPressの出力内容を制限
//----------------------------------------------
remove_action('wp_head','wp_generator');//wordpressのヴァージョンを表示する
remove_action('wp_head', 'rsd_link');//ブログ投稿ツールを使う場合は必要
remove_action('wp_head', 'wlwmanifest_link');//Windows Live Writer投稿用
remove_action('wp_head', 'feed_links_extra', 3);//その他のフィード（カテゴリー等）へのリンクを表示
remove_action('wp_head', 'index_rel_link' );//現在の文書に対する索引（インデックス）
remove_action('wp_head', 'parent_post_rel_link', 10, 0 );//link rel="parent"
remove_action('wp_head', 'start_post_rel_link', 10, 0 );//link rel="next"
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );//?p=投稿ID


//----------------------------------------------
// フォントサイズボタン追加
//----------------------------------------------
function ilc_mce_buttons( $buttons ) {
  array_push( $buttons, "fontsizeselect" );
  return $buttons;
}
add_filter( "mce_buttons", "ilc_mce_buttons" );

//----------------------------------------------
// 不要ボタン非表示（ビジュアルエディタ１行目）
//----------------------------------------------
function tinymce_delete_buttons( $array ) {
  $array = array_diff( $array, array( 'strikethrough', 'blockquote', 'hr', 'wp_more' ) );
  return $array;
}
add_filter( 'mce_buttons', 'tinymce_delete_buttons' );

//----------------------------------------------
// 不要ボタン非表示（ビジュアルエディタ２行目）
//----------------------------------------------
function tinymce_delete_buttons2( $array ) {
  $array = array_diff( $array, array( 'formatselect', 'pastetext', 'removeformat', 'charmap' ) );
  return $array;
}
add_filter( 'mce_buttons_2', 'tinymce_delete_buttons2' );

//----------------------------------------------
// 不要ボタン非表示（テキストエディタ）
//----------------------------------------------
function et_print_styles() {
  echo '<style TYPE="text/css">
    #qt_content_block,
    #qt_content_del,
    #qt_content_link,
    #qt_content_ins,
    #qt_content_img,
    #qt_content_code,
    #qt_content_more,
    #qt_content_close {
      display:none !important;
    }
  </style>';
}
add_action( 'admin_print_styles', 'et_print_styles', 21 );

//----------------------------------------------
// アイキャッチ画像サイズ指定
//----------------------------------------------
add_image_size( 'casesize', 250, 250, true );
add_image_size( 'topsize', 351, 210, true );
//----------------------------------------------
// ページング
//----------------------------------------------
function cms_pagination( $pages = '', $range = 5 ) {
  global $paged;
  if ( empty( $paged ) ) {
    $paged = 1;
  }
global $showitems;
  if ( $showitems === NULL ) {
    $showitems = 0;
  }
  if ( $pages == '' ) {
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if ( !$pages ) {
      $pages = 1;
    }
  }
  $content = '';
  if( 1 != $pages ) {
    ob_start();
    echo '<div class="number">';
    if ( $paged > 1 && $showitems < $pages ) {
      echo "<a href='" . get_pagenum_link($paged - 1) . "'>&lsaquo; 前ページ</a>";
    }
    echo "<a href='".get_pagenum_link( 1 )."'>最新</a>";
    if ( $paged > 2 && $paged > $range+1 && $showitems < $pages ) {
      echo "<a href='".get_pagenum_link( 1 )."'>&laquo;</a>";
    }
    for ( $i = 1; $i <= $pages; $i++ ) {
      if ( 1 != $pages && ( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems ) ) {
        echo ( $paged == $i ) ? "<span class='current'>" . $i . "</span>" : "<a href='" . get_pagenum_link( $i ) . "' class='inactive' >" . $i . "</a>";
      }
    }
    echo "<a href='".get_pagenum_link( $pages )."'>最初</a>";
    if ( $paged < $pages && $showitems < $pages ) {
      echo "<a href='" . get_pagenum_link( $paged + 1 )."'>次ページ &rsaquo;</a>";
    }
    echo "</div>";
    $content = ob_get_clean();
  }
  return $content;
}

//----------------------------------------------
// 管理画面メニュー「投稿」テキスト変更
//----------------------------------------------
function edit_admin_menus() {
  global $menu;
  global $submenu;
  $menu[5][0] = '最新お得情報';
}
add_action( 'admin_menu', 'edit_admin_menus' );

//----------------------------------------------
// 投稿表示文字数制限
//----------------------------------------------
function trim_str_by_chars( $str, $len, $echo = true, $suffix = '...', $encoding = 'UTF-8' ) {
  if ( ! function_exists( 'mb_substr' ) || ! function_exists( 'mb_strlen' ) ) {
    return $str;
  }
  $len = ( int )$len;
  if ( mb_strlen( $str = wp_specialchars_decode( strip_tags( $str ), ENT_QUOTES, $encoding ), $encoding ) > $len ) {
    $str = wp_specialchars( mb_substr( $str, 0, $len, $encoding ) . $suffix );
  }
  if ( $echo ) {
    echo $str;
  } else {
    return $str;
  }
}

//----------------------------------------------
// 固定ページ画像のパスをフルパスから相対へ置換
//----------------------------------------------
function replaceImagePath( $arg ) {
  $content = str_replace( '"images/', '"' . get_bloginfo( 'template_directory' ) . '/images/', $arg );
  return $content;
}
add_action( 'the_content', 'replaceImagePath' );

//----------------------------------------------
// アーカイブのリンク修正
//----------------------------------------------
global $my_archives_post_type;
add_filter( 'getarchives_where', 'my_getarchives_where', 10, 2 );
function my_getarchives_where( $where, $r ) {
  global $my_archives_post_type;
  if ( isset( $r[ 'post_type' ] ) ) {
    $my_archives_post_type = $r[ 'post_type' ];
    $where = str_replace( '\'post\'', '\'' . $r[ 'post_type' ] . '\'', $where );
  } else {
    $my_archives_post_type = '';
  }
  return $where;
}
add_filter( 'get_archives_link', 'my_get_archives_link' );
function my_get_archives_link( $link_html ) {
  global $my_archives_post_type;
  if ( $my_archives_post_type != '' ) {
    $add_link = '?post_type=' . $my_archives_post_type;
    $link_html = preg_replace( "/href=\'(.+)\'/", "href='$1" . $add_link ."'", $link_html );
  }
  return $link_html;
}



//----------------------------------------------
// 固定ページのビジュアルモード非表示
//----------------------------------------------
function disable_visual_editor_in_page() {
  global $typenow;
  if( $typenow == 'page' ) {
    add_filter( 'user_can_richedit', 'disable_visual_editor_filter' );
  }
}
function disable_visual_editor_filter() {
  return false;
}
add_action( 'load-post.php', 'disable_visual_editor_in_page' );
add_action( 'load-post-new.php', 'disable_visual_editor_in_page' );


//----------------------------------------------
// ページネーション
//----------------------------------------------
function my_pagination($pages = '', $range = 2) {
    $showitems = ($range * 2) + 1;

    global $paged;
    if (empty($paged)) $paged = 1;

    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        echo "<div class='cols-12 text-center'><ul class='pagination pagination-centered'>";
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1).
        "'>&laquo;</a></li>";
        if ($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1).
        "'>&lsaquo;</a></li>";

        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                echo($paged == $i) ? "<li class='active'><span class='current'>".$i.
                "</span></li>": "<li><a href='".get_pagenum_link($i).
                "' class='inactive' >".$i.
                "</a></li>";
            }
        }

        if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1).
        "'>&rsaquo;</a></li>";
        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages).
        "'>&raquo;</a></li>";
        echo "</ul></div>\n";
    }
}
//----------------------------------------------
// サムネイルサイズ
//----------------------------------------------
/*<?php the_post_thumbnail(); ?>z*/
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 340, 200, true );

//----------------------------------------------
// タイトル文字数制限
//----------------------------------------------
/*<?php the_title_limit(20,"続きを見る"); ?>*/

function the_title_limit($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
	global $post;
	$content = get_the_title($post->post_parent);
	$content = apply_filters('the_title', $content);
	//htmlタグを削除
	$content = strip_tags($content);

	if (isset($_GET['p']) && mb_strlen($_GET['p']) > 0) {
		echo $content;
	} elseif ((mb_strlen($content)>$max_char)) {
		$content = mb_substr($content, 0, $max_char);
		echo $content;
		echo "...";
	} else {
		echo $content;
	}
}

//----------------------------------------------
// コンテンツ内容文字数制限
//----------------------------------------------
/*<?php the_content_limit(20,"続きを見る"); ?>*/

function the_content_limit($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
	$content = get_the_content($more_link_text, $stripteaser, $more_file);
	$content = apply_filters('the_content', $content);
	//htmlタグを削除
	$content = strip_tags($content);

	if (isset($_GET['p']) && mb_strlen($_GET['p']) > 0) {
		echo $content;
	} elseif ((mb_strlen($content)>$max_char)) {
		$content = mb_substr($content, 0, $max_char);
		echo $content;
		echo "...";
	} else {
		echo $content;
	}
}

//----------------------------------------------
// パンくずリスト
//----------------------------------------------
function breadcrumbs( $args = array() ){
    global $post;
    $str ='';
    $defaults = array(
        'id' => "breadcrumbs",
        'class' => "clearfix",
        'home' => "HOME",
        'search' => "で検索した結果",
        'tag' => "タグ",
        'author' => "投稿者",
        'notfound' => "404 Not found",
        'separator' => '&nbsp; &gt; &nbsp;'
    );

    $args = wp_parse_args( $args, $defaults );
    extract( $args, EXTR_SKIP );
        if( is_home() ) {
        echo  '<div id="'. $id .'" class="' . $class.'" >'.'<ul><li>'. $home .'</li></ul></div>';
        }

        if( !is_home() && !is_admin() ){
            $str.= '<div id="'. $id .'" class="' . $class.'" >';
            $str.= '<ul>';
            $str.= '<li class="breadcrumb_top" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. home_url() .'/" itemprop="url"><span itemprop="title">'. $home .'</span></a></li>';
            $str.= '<li>'.$separator.'</li>';
            $my_taxonomy = get_query_var( 'taxonomy' );
            $cpt = get_query_var( 'post_type' );

        if( $my_taxonomy && is_tax( $my_taxonomy ) ) {
            $my_tax = get_queried_object();
            $post_types = get_taxonomy( $my_taxonomy )->object_type;
            $cpt = $post_types[0];
            $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' .get_post_type_archive_link( $cpt ).'" itemprop="url"><span itemprop="title">'. get_post_type_object( $cpt )->label.'</span></a></li>';
            $str.='<li>'.$separator.'</li>';

        if( $my_tax -> parent != 0 ) {
            $ancestors = array_reverse( get_ancestors( $my_tax -> term_id, $my_tax->taxonomy ) );

            foreach( $ancestors as $ancestor ){
                $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_term_link( $ancestor, $my_tax->taxonomy ) .'" itemprop="url"><span itemprop="title">'. get_term( $ancestor, $my_tax->taxonomy )->name .'</span></a></li>';
                $str.='<li>'.$separator.'</li>';
            }
        }
            $str.='<li>'. $my_tax -> name . '</li>';
        }

        elseif( is_category() ) {
            $cat = get_queried_object();
            if( $cat -> parent != 0 ){
                $ancestors = array_reverse( get_ancestors( $cat -> cat_ID, 'category' ));
                foreach( $ancestors as $ancestor ){
                    $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link( $ancestor ) .'" itemprop="url"><span itemprop="title">'. get_cat_name( $ancestor ) .'</span></a></li>';
                    $str.='<li>'.$separator.'</li>';
                }
            }
            $str.='<li>'. $cat -> name . '</li>';
        }

        elseif( is_post_type_archive() ) {
            $cpt = get_query_var( 'post_type' );
            $str.='<li>'. get_post_type_object( $cpt )->label . '</li>';
        }

        elseif( $cpt && is_singular( $cpt ) ){
            $taxes = get_object_taxonomies( $cpt );
            $mytax = $taxes[0];
            $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' .get_post_type_archive_link( $cpt ).'" itemprop="url"><span itemprop="title">'. get_post_type_object( $cpt )->label.'</span></a></li>';
            $str.='<li>'.$separator.'</li>';
            $taxes = get_the_terms( $post->ID, $mytax );
            $tax = get_youngest_tax( $taxes, $mytax );

        if( $tax -> parent != 0 ){
            $ancestors = array_reverse( get_ancestors( $tax -> term_id, $mytax ) );
            foreach( $ancestors as $ancestor ){
                $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_term_link( $ancestor, $mytax ).'" itemprop="url"><span itemprop="title">'. get_term( $ancestor, $mytax )->name . '</span></a></li>';
                $str.='<li>'.$separator.'</li>';
            }
        }
            $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_term_link( $tax, $mytax ).'" itemprop="url"><span itemprop="title">'. $tax -> name . '</span></a></li>';
            $str.='<li>'.$separator.'</li>';
            $str.= '<li>'. $post -> post_title .'</li>';
        }

        elseif( is_single() ){
            $categories = get_the_category( $post->ID );
            $cat = get_youngest_cat( $categories );
            if( $cat -> parent != 0 ){
                $ancestors = array_reverse( get_ancestors( $cat -> cat_ID, 'category' ) );
            foreach( $ancestors as $ancestor ){
                $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link( $ancestor ).'" itemprop="url"><span itemprop="title">'. get_cat_name( $ancestor ). '</span></a></li>';
                $str.='<li>'.$separator.'</li>';
            }
        }
            $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link( $cat -> term_id ). '" itemprop="url"><span itemprop="title">'. $cat-> cat_name . '</span></a></li>';
            $str.='<li>'.$separator.'</li>';
            $str.= '<li>'. $post -> post_title .'</li>';
        }

        elseif( is_page() ){
            if( $post -> post_parent != 0 ){
                $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
                foreach( $ancestors as $ancestor ){
                    $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_permalink( $ancestor ).'" itemprop="url"><span itemprop="title">'. get_the_title( $ancestor ) .'</span></a></li>';
                    $str.='<li>'.$separator.'</li>';
                }
            }
            $str.= '<li>'. $post -> post_title .'</li>';
        }

        elseif( is_date() ){
            if( get_query_var( 'day' ) != 0){
                $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_year_link(get_query_var('year')). '" itemprop="url"><span itemprop="title">' . get_query_var( 'year' ). '年</span></a></li>';
                $str.='<li>'.$separator.'</li>';
                $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_month_link(get_query_var( 'year' ), get_query_var( 'monthnum' ) ). '" itemprop="url"><span itemprop="title">'. get_query_var( 'monthnum' ) .'月</span></a></li>';
                $str.='<li>'.$separator.'</li>';
                $str.='<li>'. get_query_var('day'). '日</li>';
        }

        elseif( get_query_var('monthnum' ) != 0){
            $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_year_link( get_query_var('year') ) .'" itemprop="url"><span itemprop="title">'. get_query_var( 'year' ) .'年</span></a></li>';
            $str.='<li>'.$separator.'</li>';
            $str.='<li>'. get_query_var( 'monthnum' ). '月</li>';
        }

        else {
            $str.='<li>'. get_query_var( 'year' ) .'年</li>';
        }
        }

        elseif( is_search() ) {
            $str.='<li>「'. get_search_query() .'」'. $search .'</li>';
        }

        elseif( is_author() ){
            $str .='<li>'. $author .' : '. get_the_author_meta('display_name', get_query_var( 'author' )).'</li>';
        }

        elseif( is_tag() ){
            $str.='<li>'. $tag .' : '. single_tag_title( '' , false ). '</li>';
        }

        elseif( is_attachment() ){
            $str.= '<li>'. $post -> post_title .'</li>';
        }

        elseif( is_404() ){
            $str.='<li>'.$notfound.'</li>';
        }

        else{
            $str.='<li>'. wp_title( '', true ) .'</li>';
        }

            $str.='</ul>';
            $str.='</div>';
        }
    echo $str;
}

function get_youngest_cat( $categories ){
    global $post;
    if(count( $categories ) == 1 ){
        $youngest = $categories[0];
    }
    else{
        $count = 0;
        foreach( $categories as $category ){
            $children = get_term_children( $category -> term_id, 'category' );
            if($children){
                if ( $count < count( $children ) ){
                    $count = count( $children );
                    $lot_children = $children;
                    foreach( $lot_children as $child ){
                        if( in_category( $child, $post -> ID ) ){
                            $youngest = get_category( $child );
                        }
                    }
                }
            }
            else{
                $youngest = $category;
            }
        }
    }
    return $youngest;
}

function get_youngest_tax( $taxes, $mytaxonomy ){
    global $post;
    if( count( $taxes ) == 1 ){
        $youngest = $taxes[ key( $taxes )];
    }
    else{
        $count = 0;
        foreach( $taxes as $tax ){
            $children = get_term_children( $tax -> term_id, $mytaxonomy );
            if($children){
                if ( $count < count($children) ){
                    $count = count($children);
                    $lot_children = $children;
                    foreach($lot_children as $child){
                        if( is_object_in_term( $post -> ID, $mytaxonomy ) ){
                            $youngest = get_term($child, $mytaxonomy);
                        }
                    }
                }
            }
            else{
                $youngest = $tax;
            }
        }
    }
    return $youngest;
}

//----------------------------------------------
// 画像/アイキャッチ/本文で投稿/画像リンク切れ回避
//----------------------------------------------
add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );


//----------------------------------------------
// 記事内でphpを使う
//----------------------------------------------
function Include_my_php($params = array()) {
    extract(shortcode_atts(array(
        'file' => 'default'
    ), $params));
    ob_start();
    include(get_theme_root() . '/' . get_template() . "/$file.php");
    return ob_get_clean();
}

add_shortcode('myphp', 'Include_my_php');



//----------------------------------------------
// 管理画面の固定ページ一覧にスラッグを表示
//----------------------------------------------
function add_page_columns_name($columns) {
    $columns['slug'] = "スラッグ";
    return $columns;
}
function add_page_column($column_name, $post_id) {
    if( $column_name == 'slug' ) {
        $post = get_post($post_id);
        $slug = $post->post_name;
        echo attribute_escape($slug);
    }
}
add_filter( 'manage_pages_columns', 'add_page_columns_name');
add_action( 'manage_pages_custom_column', 'add_page_column', 10, 2);

//----------------------------------------------
//　編集画面のタブ幅を変更
//----------------------------------------------
// 管理画面のタブ幅を変更
function add_admin_custom_style() {
	echo '<style>
	.wp-editor-container textarea {
		-o-tab-size: 2;
		-moz-tab-size: 2;
		tab-size: 2;
	}
</style>';
}
add_action( 'admin_head', 'add_admin_custom_style' );

// 管理画面フッターの表示を「moritashigekazu」に変更（JSで強制）
add_action('admin_footer', function () {
  echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
      const footerLeft = document.getElementById("footer-left");
      if (footerLeft) {
        footerLeft.innerHTML = "moritashigekazu";
      }
    });
  </script>';
});

add_action('admin_footer', 'force_replace_admin_footer_text');
function force_replace_admin_footer_text() {
  ?>
  <script>
    window.addEventListener('load', function () {
      const footer = document.getElementById("footer-left");
      if (footer) {
        footer.innerHTML = "moritashigekazu";
      }
    });
  </script>
  <?php
}
