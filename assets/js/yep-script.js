/*
 * Golabi Admin - Responsive Bootstrap Template
 *
 * Copyright 2015 yeptemplate.com
 * Template Script
 *
 * Index of Script
 * ---------------------------------------------
 * YEP-NOTIFY BTN-GROUP SCRIPT 
 * PREVENT CLOSE DROPDOWN MENU 
 * SEARCH IN SIDEBAR MENU 
 * SIDEBAR MENU SWITCH SMALL & BIG 
 * SIDEBAR MENU ACCORDIAN - OPEN/CLOSE SUBMENU SCRIPT 
 * SEARCH CONTACT IN SIDEBAR TAB 
 * SEARCH TASK IN SIDEBAR 
 * SORTABLE TASK IN SIDEBAR 
 * TASK INPUT CHECKED ACTION 
 * FULL SCREEN DOCUMENT SWITCH 
 * PANEL ACTIONS 
 * SHOW & HIDE SIDEBAR MENU (MIN-WIDTH:979PX)
 * SHOW & HIDE FORM SEARCH MOBILE SCREEN 
 * POPOVER AND TOOLTIP ACTIVATION 
 * ACCORIDAN ICON TOGGLE 
 * ACTIVITY PROFILE PANEL FLAT
 * ACTIVATION TAB WITH LINK
 * YEP IMAGE GALLERY
 * TABLE SEARCH TOGGLE BTN
 * POPOVER OPEN WHEN HOVER
 */

/* yep-notify btn-group script */
$('.yep-btn-group-notify .btn').on('click', function(e) {
    e.preventDefault();
    $(this)
        .addClass('active')
        .tab('show')
        .siblings('.btn')
        .removeClass('active');
});

/***********************************************************************/
/* Prevent close dropdown menu */
$('li.dropdown.yep-dropdown-notify a').on('click', function(event) {
    $(this).parent().toggleClass("open");
});
$('body').on('click', function(e) {
    if (!$('li.dropdown.yep-dropdown-notify').is(e.target) && $('li.dropdown.yep-dropdown-notify').has(e.target).length === 0 && $('.open').has(e.target).length === 0) {
        $('li.dropdown.yep-dropdown-notify').removeClass('open');
        $('li.dropdown.yep-dropdown-notify').removeClass('active');
    }
});

/**********************************************************************/
/* Search in sidebar menu */
$('#menu-list').searchable({
    searchField: '#menu-list-search',
    selector: 'li',
    childSelector: '.menu-text',
    show: function(elem) {
        if(!$('#container').hasClass('top-menu')){
            if ($('#menu-list-search').val().length === 1 ) {
                $('#MainMenu >.nav-list > li').removeClass('open');                        
            } else{
                $('#MainMenu >.nav-list > li').addClass('open');            
            }
        }
        elem.slideDown(100);
    },
    hide: function(elem) {        
        elem.slideUp(100);
    } 
})

/***********************************************************************/
/*Sidebar menu switch small & big */
function showMenuSidebar() {
    $('#sidebar').removeClass('menu-hide');
    $('#MainMenu').removeClass('menu-small');
    $('#side-hide').parent().removeClass('open');
    $('#contact-tab').show();
    $('#report-tab').show();
    $('#icon-sw-s-b').removeClass('fa-angle-double-right');
    $('#icon-sw-s-b').addClass('fa-angle-double-left');
    $('#search-menu-form > div > button ').show();

}

function hideMenuSidebar() {
    $('#sidebar').addClass('menu-hide');
    $('#MainMenu').addClass('menu-small');
    $('#side-hide').parent().addClass('open');
    $('#contact-tab').hide();
    $('#report-tab').hide();
    $('#icon-sw-s-b').removeClass('fa-angle-double-left');
    $('#icon-sw-s-b').addClass('fa-angle-double-right');
    $('#search-menu-form > div > button ').hide();
    $('a[href=#tab_menu_1]').tab('show');
}
$('#sidebar-collapse ,#side-hide').on('click', function(event) {
    if ($('#sidebar').hasClass('menu-hide')) {
        showMenuSidebar();
    } else {
        hideMenuSidebar();
    }
});

/*****************************************************************/
/* Sidebar Menu Accordian - open/close submenu Script */
if(!$('#container').hasClass('hover-active')){
    $('#MainMenu .dropdown-toggle').on('click', function(event) {
        event.preventDefault();
        if ($(this).parent().hasClass('open')) {

            $(this).nextAll('ul:first').hide(500,"swing");
            $(this).parent().removeClass('open');   

        } else if($(this).closest('ul').hasClass('nav-list')){  

            $('#MainMenu > #menu-list li').removeClass('open');
            $('#MainMenu > #menu-list li .submenu').hide(500,"swing");
            $(this).nextAll('ul:first').show(500,"swing");
            $(this).parent().addClass('open');

        } else {      

            $(this).nextAll('ul:first').show(500,"swing");
            $(this).parent().addClass('open');

        }
    });
}

/******************************************************************/
/* Search contact in sidebar tab */
$('[data-toggle="tooltip"]').tooltip();

$('#contact-list').searchable({
    searchField: '#contact-list-search',
    selector: 'li',
    childSelector: '.col-xs-12',
    show: function(elem) {
        elem.slideDown(100);
    },
    hide: function(elem) {
        elem.slideUp(100);
    }
})

/****************************************************************************/
/* Search task in sidebar */
$('.task-list').searchable({
    searchField: '#task-list-search',
    selector: 'li',
    childSelector: '.task-title-sp',
    show: function(elem) {
        elem.slideDown(100);
    },
    hide: function(elem) {
        elem.slideUp(100);
    }
})

/*****************************************************************************/
/* Sortable task in sidebar */
$('#sortable').sortable({
    tolerance: 'pointer',
    revert: 'invalid',
    placeholder: "li",
    forceHelperSize: true,
    start: function(event, ui) {
        ui.placeholder.height(ui.item.height())
        ui.placeholder.width(ui.item.width())
    }
});

/****************************************************************************/
/* Task Input Checked action */
$('input.list-child').change(function() {
    if ($(this).is(':checked')) {
        $(this).parents('li').addClass("task-done");
    } else {
        $(this).parents('li').removeClass("task-done");
    }
});

/***************************************************************************/
/* full Screen document switch */
$('#fullscreen').on('click', function(event) {
    $(document).toggleFullScreen();
    $(this).parent().toggleClass("open");
});

/*************************************************************************/
/* panel actions */
$('.minimize').on("click", function(e) {
    e.preventDefault();
    if ($(this).hasClass('panel-collapsed')) {
        /* expand the panel */
        $(this).parents('.panel').find('.panel-body').slideDown();
        $(this).removeClass('panel-collapsed');
        $(this).removeClass('fa-chevron-up').addClass('fa-chevron-down');

    } else {
        /* collapse the panel */
        $(this).parents('.panel').find('.panel-body').slideUp();
        $(this).addClass('panel-collapsed');
        $(this).removeClass('fa-chevron-down').addClass('fa-chevron-up');
    }
});
/* full Screen panel switch */
$('.maximum').on('click', function(event) {
    $(this).parents('.panel').toggleClass("maximize-mode");
});
/* dragable & sortable panel */
$('#sortable-panel').sortable({
    tolerance: 'pointer',
    revert: 'invalid',
    handle: '.panel-heading',
    placeholder: "col-md-6",
    forceHelperSize: true,
    start: function(event, ui) {
        ui.placeholder.height(ui.item.height())
        ui.placeholder.width(ui.item.width())
    }
});
/* close panel */
$('.close-panel').on('click', function(event) {
    $(this).parents('.panel').remove();
});

/*********************************************************/
/* show & hide sidebar menu (min-width:979px) */
$('#menu-open').on('click', function(event) {
    $('#sidebar').toggleClass('sidebar-show');
});

/*********************************************************/
/* show & hide form search mobile screen */
$('#cancel-search-mobile').on('click', function(event) {
    $('.form-search-mobile').hide();
});
$('#search-mobile-show').on('click', function(event) {
    $('.form-search-mobile').toggle();
});

/*********************************************************/
/* popover and Tooltip activation */
/* Popovers initiate */
$(function () {
    $('[data-toggle="popover"]').popover()
})

/* tooltip initiate */
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});

/*********************************************************/
/* Accoridan icon toggle */
function toggleChevron(e) {
    $(e.target)
        .prev('.panel-heading')
        .find("i")
        .toggleClass('fa-angle-down fa-angle-up');
}
$('.yep-accordion').on('hidden.bs.collapse', toggleChevron);
$('.yep-accordion').on('shown.bs.collapse', toggleChevron);

/************************************************************/
/* activity profile panel flat */
$(function () {
   $('.panel-flat > .panel-footer > .input-placeholder, .panel-flat > .panel-flat-comment > .panel-flat-textarea > button[type="reset"]').on('click', function(event) {
        var $panel = $(this).closest('.panel-flat');
            $comment = $panel.find('.panel-flat-comment');
            
        $comment.find('.btn:first-child').addClass('disabled');
        $comment.find('textarea').val('');
        
        $panel.toggleClass('panel-flat-show-comment');
        
        if ($panel.hasClass('panel-flat-show-comment')) {
            $comment.find('textarea').focus();
        }
   });
   $('.panel-flat-comment > .panel-flat-textarea > textarea').on('keyup', function(event) {
        var $comment = $(this).closest('.panel-flat-comment');
        
        $comment.find('button[type="submit"]').addClass('disabled');
        if ($(this).val().length >= 1) {
            $comment.find('button[type="submit"]').removeClass('disabled');
        }
   });
});

/************************************************************/
/* Activation tab with link */
 $(document).on("click", "a[data-tab-destination]", function() {
	var tab = $(this).attr('data-tab-destination');
	$("#"+tab).click();	
	$("#"+tab).parent().css("display","block");
});


/************************************************************/
/* Yep Image Gallery */
//bind click events
var $cell = $('.image__cell');

$cell.find('.image--basic').click(function() {
  var $thisCell = $(this).closest('.image__cell');

  if ($thisCell.hasClass('is-collapsed')) {
    $cell.not($thisCell).removeClass('is-expanded').addClass('is-collapsed');
    $thisCell.removeClass('is-collapsed').addClass('is-expanded');
  } else {
    $thisCell.removeClass('is-expanded').addClass('is-collapsed');
  }
});

$cell.find('.expand__close').click(function() {
  var $thisCell = $(this).closest('.image__cell');
  $thisCell.removeClass('is-expanded').addClass('is-collapsed');
});

/******************************************************************/
/*! Ripple.js v1.2.1
 * The MIT License (MIT)
 * Copyright (c) 2014 Jacob Kelley */
!function(a,b,c){a.ripple=function(d,e){var f=this,g=f.log=function(){f.defaults.debug&&console&&console.log&&console.log.apply(console,arguments)};f.selector=d,f.defaults={debug:!1,on:"mousedown",opacity:.4,color:"auto",multi:!1,duration:.7,rate:function(a){return a},easing:"linear"},f.defaults=a.extend({},f.defaults,e);var h=function(b){var d,e,h=a(this);if(h.addClass("has-ripple"),e=a.extend({},f.defaults,h.data()),e.multi||!e.multi&&0===h.find(".ripple").length){if(d=a("<span></span>").addClass("ripple"),d.appendTo(h),g("Create: Ripple"),!d.height()&&!d.width()){var i=c.max(h.outerWidth(),h.outerHeight());d.css({height:i,width:i}),g("Set: Ripple size")}if(e.rate&&"function"==typeof e.rate){var j=c.round(d.width()/e.duration),k=e.rate(j),l=d.width()/k;e.duration.toFixed(2)!==l.toFixed(2)&&(g("Update: Ripple Duration",{from:e.duration,to:l}),e.duration=l)}var m="auto"==e.color?h.css("color"):e.color,n={animationDuration:e.duration.toString()+"s",animationTimingFunction:e.easing,background:m,opacity:e.opacity};g("Set: Ripple CSS",n),d.css(n)}e.multi||(g("Set: Ripple Element"),d=h.find(".ripple")),g("Destroy: Ripple Animation"),d.removeClass("ripple-animate");var o=b.pageX-h.offset().left-d.width()/2,p=b.pageY-h.offset().top-d.height()/2;e.multi&&(g("Set: Ripple animationend event"),d.one("animationend webkitAnimationEnd oanimationend MSAnimationEnd",function(){g("Note: Ripple animation ended"),g("Destroy: Ripple"),a(this).remove()})),g("Set: Ripple location"),g("Set: Ripple animation"),d.css({top:p+"px",left:o+"px"}).addClass("ripple-animate")};a(b).on(f.defaults.on,f.selector,h)}}(jQuery,document,Math);$.ripple.version = "1.2.1";

$.ripple(".btn", {
    debug: false, // Turn Ripple.js logging on/off
    on: 'mousedown', // The event to trigger a ripple effect

    opacity: 0.2, // The opacity of the ripple
    color: "auto", // Set the background color. If set to "auto", it will use the text color
    multi: false, // Allow multiple ripples per element

    duration: 0.4, // The duration of the ripple

    // Filter function for modifying the speed of the ripple
    rate: function(pxPerSecond) {
        return pxPerSecond;
    },

    easing: 'linear' // The CSS3 easing function of the ripple
});


/*******************************************************************/
/* Table search toggle btn */
$(document).on('click','.search-toggle-btn', function (e) {
    e.preventDefault();
    $('.hiddensearch').toggle();
});


/*********************************************************************/
/* Popover open when hover */
var originalLeave = $.fn.popover.Constructor.prototype.leave;
$.fn.popover.Constructor.prototype.leave = function(obj){
  var self = obj instanceof this.constructor ?
    obj : $(obj.currentTarget)[this.type](this.getDelegateOptions()).data('bs.' + this.type)
  var container, timeout;

  originalLeave.call(this, obj);

  if(obj.currentTarget) {
    container = $(obj.currentTarget).siblings('.popover')
    timeout = self.timeout;
    container.one('mouseenter', function(){
      //We entered the actual popover – call off the dogs
      clearTimeout(timeout);
      //Let's monitor popover content instead
      container.one('mouseleave', function(){
        $.fn.popover.Constructor.prototype.leave.call(self, self);
      });
    })
  }
};

$('body').popover({ selector: '[data-popover]', trigger: 'click hover', placement: 'auto', delay: {show: 50, hide: 400}});

/***********************************************************************/
/* per page toggle btn */
$(document).on('click','.perpage-toggle-btn', function (e) {
    e.preventDefault();
    $('.hiddenperpage').slideToggle();
});

