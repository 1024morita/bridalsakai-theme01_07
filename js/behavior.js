$(function(){
  // Swap image Module
  var imgcache=new Object();
  $(".btn,.allbtn img").not("[src*='_o.']").each(function(i){
    var imgsrc=this.src;
    var dot=this.src.lastIndexOf('.');
    var imgovr=this.src.substr(0,dot)+'_o'+this.src.substr(dot,4);
    imgcache[this.src]=new Image();
    imgcache[this.src].src=imgovr;
    $(this).hover(function(){
      this.src=imgovr;
    },function(){
      this.src=imgsrc;
    });
  });

  // Fade Module
  $(".fade").each(function(i){
    $(this).hover(function(){
      $(this).stop().fadeTo(200,0.5);
    },function(){
      $(this).stop().fadeTo(200,1);
    });
  });

  // Scroll
  $("a[href^=#]").click(function(){
    var speed = 500;
    var href= $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'html' : href);
    var position = target.offset().top;
    $("html, body").animate({scrollTop:position}, speed, "swing");
    return false;
  });

  // pagetop btn
  $(".pagetop_btn").hide();
  $(window).on("scroll", function() {

    if ($(this).scrollTop() > 100) {
      $('.pagetop_btn').slideDown("fast");
    } else {
      $('.pagetop_btn').slideUp("fast");
    }

    // フッター固定する
    scrollHeight = $(document).height(); 
    scrollPosition = $(window).height() + $(window).scrollTop(); 
    footHeight = $("#foot_ar").innerHeight()-180;//止めたい高さ

    if ( scrollHeight - scrollPosition  <= footHeight ) {
      $(".pagetop_btn").css({
        "position":"absolute",
        "margin": "0px 0 0px",
        "bottom": footHeight
      });
    } else {
      $(".pagetop_btn").css({
        "position":"fixed",
        "bottom": "0px"
      });
    }
  });
  // pagetop btn sp
  $(".pagetop_btn_sp").hide();
  $(window).on("scroll", function() {

    if ($(this).scrollTop() > 100) {
      $('.pagetop_btn_sp').slideDown("fast");
    } else {
      $('.pagetop_btn_sp').slideUp("fast");
    }
  });

});

/*--------Equal height--------*/
if(!navigator.userAgent.match(/(iPhone|iPad|Android)/)){
  $(window).load(function(){
    $('.eqh_pc').equalHeight();
  });
}
/*スマホのときもEqual height*/
$(window).load(function(){
  $('.eqh_sp').equalHeight();
});

/*==============================================
    zeromenu
==============================================*/

//ボタンの生成
$(".sp-navi-inner").before('<p class="overlay"></p><p class="humberger"><span></span><span></span><span></span></p>');
$(".humberger,.overlay").click(function () {
  $(".sp-navi").toggleClass("is-open");
});

//アンカーリンクを押したとき(aタグのhref属性の値に「#」が含まれている場合)
$(".sp-navi a[href *= '#']").click(function() {
  $(".sp-navi").toggleClass('is-open');
});

/*==============================================
  GlobalNavi Dropdown Menu
==============================================*/
jQuery(document).ready(function($){
  $(document).ready(function(){
    $(window).on("load resize",function(){
      var i=$(window).width();
      var j=800;  //Width(Responsive)
      if(i<=j){
        $('.gNavi li.dd ul').css("display","none");
        $(".gNavi li.dd").unbind("mouseenter mouseleave");
      }else{
        $("li.dd").hover(function(){
          $(this).children('ul').show(100).css("display","block");
        },function(){
          $(this).children('ul').stop().hide(250);
        });
      }
    });
  });
});
/*==============================================
  Accordion box
==============================================*/
jQuery(document).ready(function($){
  $('.accordion-btn').click(function () {
    $(this).next().slideToggle();
    $(this).toggleClass('is-open');
  });
});
//------------------------------------------------------
// ページトップ
//------------------------------------------------------  
jQuery(document).ready(function($){
  var topBtn = $('#nav-dock');
  topBtn.hide();
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      topBtn.fadeIn();
    } else {
      topBtn.fadeOut();
    }
  });
  topBtn.click(function () {
    $('body, html').animate({ scrollTop: 0 }, 500);
    return false;
  });

});
/*==============================================
  タブ
==============================================*/
jQuery(document).ready(function($){
  $('#tabs li a').click(function(e){

    $('#tabs li, #content .current').removeClass('current').removeClass('fadeInLeft');
    $(this).parent().addClass('current');
    var currentTab = $(this).attr('href');
    $(currentTab).addClass('current fadeInLeft');
    e.preventDefault();

  });
});
/*==============================================
  slider
==============================================*/

$(function() {
  $('.slider_index').slick({
    infinite: true,
    autoplay:true,
    autoplaySpeed:6000,
    dots: false,
    arrows:false,
    speed: 1000,
    fade:true,
    pauseOnHover:false
  });
});