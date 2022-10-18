$(document).ready(function() {
  //Onclick Add, Remove Class Script
  $('.extract').click(function() {
    $(this).parents('.col').find('.category-minimize').css("z-index", "-1");
    $(this).parents('.col').find('.category-maximize').css("z-index", "1111111");
    $(this).parents('.col').find('.category-maximize').addClass('show');
    $(this).parents('.col').find('.category-minimize').removeClass('show');
    $('html').addClass('overflow');
  });
  $('.list .col .image').click(function() {
    $(this).parent().siblings().find('.category-minimize, .category-maximize').removeClass('show');
    $(this).parent().find('.category-minimize').addClass('show');
    $(this).parent().find('.category-minimize').css("z-index", "1111111");
    $(this).parent().find('.category-maximize').css("z-index", "-1");
  });
  $('header ul li').click(function() {
    $(this).siblings().find('.dropdown').slideUp();
    $(this).find('.dropdown').slideToggle();
  });
  $(document).on('click', function(e) {
    if ($(e.target).is('header ul li, header ul li *') === false) {
      $('.dropdown').slideUp();
    }
  });
  $('.close-item').click(function() {console.log("asdf");
    $('.category-maximize, .category-minimize').removeClass('show');
    $('.category-minimize').css("z-index", "-1");
    $('.category-maximize').css("z-index", "-1");
    $('html').removeClass('overflow');
  }); 
  $('.user-login-btn').click(function(e) {
    e.stopPropagation();
    $('.login-pop').addClass('show');
    $('.signup-pop').removeClass('show');
    $('.forgotten-password-pop').removeClass('show');
    $('header').removeClass('open-navigation');
  });
  $('.inscription-btn').click(function(e) {
    e.stopPropagation();
    $('.signup-pop').addClass('show');
  });
  $('.forgotten-password-btn').click(function(e) {
    e.stopPropagation();
    $('.forgotten-password-pop').addClass('show');
  });
  $('.search-btn').click(function(e) {
    e.stopPropagation();
    $('.search-pop').addClass('show');
    $('header').removeClass('open-navigation');
    $('html').removeClass('overflow');
  });
  $('.signup-pop, .login-pop, .payment-pop, .search-pop, .forgotten-password-pop, .alert-pop').click(function(e) {
    e.stopPropagation();
  });
  $(document).click(function() {
    $('.signup-pop, .login-pop, .payment-pop, .search-pop, .forgotten-password-pop, .alert-pop').removeClass('show');
  });
  $('.inscription-btn').click(function() {
    $('.login-pop').removeClass('show');
  });
  $('.forgotten-password-btn').click(function() {
    $('.login-pop').removeClass('show');
  });
  $('.delete').click(function(e) {
    e.stopPropagation();
    $('.payment-pop').addClass('show');
  });
  $('.navbar-toggler').click(function() {
    $('header').addClass('open-navigation');
    $('html').addClass('overflow');
  });
  $('.close-nav').click(function() {
    $('header').removeClass('open-navigation');
    $('html').removeClass('overflow');
  });
  $(".mobile-menu").click(function() {
    $(".option").slideToggle("slow");
  });
  $(".option a").click(function() {
    // $(".option").slideUp("slow");
    $(".mobile-menu a").text($(this).text());
  });
  $(".my-account .radio-lebel input").change(function() {
    $(this).parent().siblings().removeClass('checked').find('.action').text('Choisir cette formule');
    $(this).parent().addClass('checked').find('.action').text('Abonnement actuel');
  });
  $('.block-subtitle .languages li').click(function(){
    $('.block-subtitle .languages li').removeClass("choosed");
    $(this).addClass("choosed");
  });
  $('.block-title .languages li').click(function(){
    $('.block-title .languages li').removeClass("choosed");
    $(this).addClass("choosed");
  });
  $('.jp-volume-controls .jp-mute').click(function() {
    $('body').toggleClass('volume');
  });
});


