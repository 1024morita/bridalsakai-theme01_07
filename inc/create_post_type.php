<?php
// カスタム投稿タイプの追加
function news_custom_post_type()
{
    $labels = array(
        'name'          => 'ブログ',
        'singular_name' => 'ブログ',
        'menu_name'     => 'ブログ',
        'edit_item'     => '投稿を編集',
        'view_item'     => '投稿を表示',
    );
    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'menu_position' => 5,
        'rewrite'       => true,
        'supports'      => array('title', 'editor', 'thumbnail', 'revisions', 'author'),
        'taxonomies'    => array('news_category')
    );
    register_post_type('news', $args);
    // カスタムタクソノミーを作成
    $args = array(
        'label' => 'カテゴリー',
        'public' => true,
        'show_ui' => true,
        'hierarchical' => true
    );
    register_taxonomy('news_category', 'news', $args);
}
add_action('init', 'news_custom_post_type');

/*管理画面のカスタム投稿一覧にタクソノミーを表示*/
function add_news_custom_column_id($column_name, $id)
{
    if ($column_name == 'news_category') {
        echo get_the_term_list($id, 'news_category', '', ', ');
    }
}
add_action('manage_news_posts_custom_column', 'add_news_custom_column_id', 10, 2);
//manage_[カスタム投稿名]_posts_custom_column

/*管理画面のカスタム投稿一覧並び順を変更*/
function news_sort_column($columns)
{
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'タイトル',
        'author' => '作成者',
        'news_category' => 'カテゴリー',
        'date' => '日時',
    );
    return $columns;
}
add_filter('manage_news_posts_columns', 'news_sort_column');
//manage_[カスタム投稿名]_posts_custom_column

// カスタム投稿タイプの追加
function party_custom_post_type()
{
    $labels = array(
        'name'          => 'PARTY INFORMATION',
        'singular_name' => 'PARTY INFORMATION',
        'menu_name'     => 'PARTY INFORMATION',
        'edit_item'     => '投稿を編集',
        'view_item'     => '投稿を表示',
    );
    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'menu_position' => 5,
        'rewrite'       => true,
        'supports'      => array('title', 'editor', 'thumbnail', 'revisions', 'author'),
    );
    register_post_type('party', $args);

}
add_action('init', 'party_custom_post_type');
