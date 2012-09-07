/*
  $Id: new_products.php, v 1.00 2011/02/16 Harry Lee $

  HORIZONTAL PRODUCT SCROLLER

  Contribution based on:

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
jQuery.noConflict();
jQuery(document).ready(function($){
$(".gor").click(function(){
  var maxpn = parseInt($(this).parents('table.scroller').find('.txt_maxpn').text());
  if(maxpn<=1) return false;
  var $thiser = $(this).parent().prev().find(".scrollblock");
  $thiser.slice(0,1).animate({ "left": "-=760" }, {
    duration: 400,
    step: function(now, fx){
      $thiser.slice(1).css("left", now);
    }
  });
  var pn = parseInt($(this).parents('table.scroller').find('.txt_pn').text());
  pn++;
  if(pn>=maxpn) { pn=maxpn; $(this).css("visibility","hidden"); }
  $(this).parents('table.scroller').find('.gol').css("visibility","visible");
  $(this).parents('table.scroller').find('.txt_pn').text(pn);
  $(this).parents('table.scroller').find('.scrollrestart').show();
}).mousedown(function(){
  $(this).attr({'src':'images/icons/button_scroll_right_dn.gif'});
}).mouseup(function(){
  $(this).attr({'src':'images/icons/button_scroll_right_up.gif'});
});

$(".gol").click(function(){
  var $thiser = $(this).parent().next().find(".scrollblock");
  $thiser.slice(0,1).animate({ "left": "+=760" }, {
    duration: 400,
    step: function(now, fx){
      $thiser.slice(1).css("left", now);
    }
  });
  var pn = parseInt($(this).parents('table.scroller').find('.txt_pn').text());
  pn--;
  if(pn<=1) { pn=1; $(this).css("visibility","hidden"); $(this).parents('table.scroller').find('.scrollrestart').hide(); }
  $(this).parents('table.scroller').find('.gor').css("visibility","visible");
  $(this).parents('table.scroller').find('.txt_pn').text(pn);
}).mousedown(function(){
  $(this).attr({'src':'images/icons/button_scroll_left_dn.gif'});
}).mouseup(function(){
  $(this).attr({'src':'images/icons/button_scroll_left_up.gif'});
});

$(".scrollrestart").click(function(){
  var p = parseInt($(this).siblings('.txt_pn').text());
  var oset = '+='+(p * 760 - 760);
  var $thiser = $(this).parents("tr").next().find(".scrollblock");
  $thiser.slice(0,1).animate({ "left": oset }, {
    duration: 400,
    step: function(now, fx){
      $thiser.slice(1).css("left", now);
    }
  });
  $(this).siblings('.txt_pn').text('1');
  $(this).parentsUntil('table').find('.gol').css("visibility","hidden");
  $(this).parentsUntil('table').find('.gor').css("visibility","visible");
  $(this).hide();
});
})