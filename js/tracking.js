// 各パーツのクラス名を変更

$( function() {
  var tr = [
    [ '.header_tel a[href^="tel"]', '問い合わせ電話数', 'ページ上部' ]
    ,[ '.contents_tel a[href^="tel"]', '問い合わせ電話数', 'ページ中部' ]
    ,[ '.side_tel a[href^="tel"]', '問い合わせ電話数', 'ページサイド部']
    ,[ '.footer_tel a[href^="tel"]', '問い合わせ電話数', 'ページ下部' ]
    ,[ '.contact_tel input[type=submit]', 'フォームからの問い合わせ数', 'お問い合わせページ' ]
  ];
  var ce = function( i ) {
    $( tr[ i ][ 0 ] ).click( function() {
      _gaq.push( [ "_trackEvent", tr[ i ][ 1 ], "click", tr[ i ][ 2 ] ] );
    });
  }	
  for ( i = 0; i < tr.length; i++ ) {
    ce( i );
  }
});
