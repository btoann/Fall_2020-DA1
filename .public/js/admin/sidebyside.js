$(function () {
  'use strict'

  // This template is mobile first so active menu in navbar
  // has submenu displayed by default but not in desktop
  // so the code below will hide the active menu if it's in desktop
  if (window.matchMedia('(min-width: 992px)').matches) {
    $('.sbs-navbar .active').removeClass('show');
    $('.sbs-header-menu .active').removeClass('show');
  }

  // Shows header dropdown while hiding others
  $('.sbs-header .dropdown > a').on('click', function (e) {
    e.preventDefault();
    $(this).parent().toggleClass('show');
    $(this).parent().siblings().removeClass('show');
  });

  // Showing submenu in navbar while hiding previous open submenu
  $('.sbs-navbar .with-sub').on('click', function (e) {
    e.preventDefault();
    $(this).parent().toggleClass('show');
    $(this).parent().siblings().removeClass('show');
  });

  // this will hide dropdown menu from open in mobile
  $('.dropdown-menu .sbs-header-arrow').on('click', function (e) {
    e.preventDefault();
    $(this).closest('.dropdown').removeClass('show');
  });

  // this will show navbar in left for mobile only
  $('#azNavShow, #azNavbarShow').on('click', function (e) {
    e.preventDefault();
    $('body').addClass('sbs-navbar-show');
  });

  // this will hide currently open content of page
  // only works for mobile
  $('#azContentLeftShow').on('click touch', function (e) {
    e.preventDefault();
    $('body').addClass('sbs-content-left-show');
  });

  // This will hide left content from showing up in mobile only
  $('#azContentLeftHide').on('click touch', function (e) {
    e.preventDefault();
    $('body').removeClass('sbs-content-left-show');
  });

  // this will hide content body from showing up in mobile only
  $('#azContentBodyHide').on('click touch', function (e) {
    e.preventDefault();
    $('body').removeClass('sbs-content-body-show');
  })

  // navbar backdrop for mobile only
  $('body').append('<div class="sbs-navbar-backdrop"></div>');
  $('.sbs-navbar-backdrop').on('click touchstart', function () {
    $('body').removeClass('sbs-navbar-show');
  });

  // Close dropdown menu of header menu
  $(document).on('click touchstart', function (e) {
    e.stopPropagation();

    // closing of dropdown menu in header when clicking outside of it
    var dropTarg = $(e.target).closest('.sbs-header .dropdown').length;
    if (!dropTarg) {
      $('.sbs-header .dropdown').removeClass('show');
    }

    // closing nav sub menu of header when clicking outside of it
    if (window.matchMedia('(min-width: 992px)').matches) {

      // Navbar
      var navTarg = $(e.target).closest('.sbs-navbar .nav-item').length;
      if (!navTarg) {
        $('.sbs-navbar .show').removeClass('show');
      }

      // Header Menu
      var menuTarg = $(e.target).closest('.sbs-header-menu .nav-item').length;
      if (!menuTarg) {
        $('.sbs-header-menu .show').removeClass('show');
      }

      if ($(e.target).hasClass('sbs-menu-sub-mega')) {
        $('.sbs-header-menu .show').removeClass('show');
      }

    } else {

      //
      if (!$(e.target).closest('#azMenuShow').length) {
        var hm = $(e.target).closest('.sbs-header-menu').length;
        if (!hm) {
          $('body').removeClass('sbs-header-menu-show');
        }
      }
    }

  });

  $('#azMenuShow').on('click', function (e) {
    e.preventDefault();
    $('body').toggleClass('sbs-header-menu-show');
  })

  $('.sbs-header-menu .with-sub').on('click', function (e) {
    e.preventDefault();
    $(this).parent().toggleClass('show');
    $(this).parent().siblings().removeClass('show');
  })

  $('.sbs-header-menu-header .close').on('click', function (e) {
    e.preventDefault();
    $('body').removeClass('sbs-header-menu-show');
  })

});
