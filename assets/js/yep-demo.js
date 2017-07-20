// Demo Setting Template
var htmlDemo = "<!-- demo settings panel-->\
        <div class='demo'>\
            <span id='demo-setting'><i class='fa fa-cog'></i></span>\
            <form >\
                <legend class='no-padding'><h4 class='bold'>Theme Options</h4></legend>\
                <div class='row'>\
                    <div class='col-md-6'>\
                        <div class='m-checkbox '>\
                            <input id='check-fix-header' type='checkbox'>\
                            <label for='check-fix-header' data-toggle='tooltip' title='asadasi dkakd'>\
                               <strong>Fixed Header</strong> \
                            </label>\
                        </div>\
                        <div class='m-checkbox '>\
                            <input id='check-fix-sidebar' type='checkbox'>\
                            <label for='check-fix-sidebar'>\
                               <strong>Fixed Sidebar</strong> \
                            </label>\
                        </div>\
                        <div class='m-checkbox '>\
                            <input id='check-fix-ribbon' type='checkbox' >\
                            <label for='check-fix-ribbon'>\
                               <strong>Fixed Ribbon</strong> \
                            </label>\
                        </div>\
                        <div class='m-checkbox '>\
                            <input id='check-fix-footer' type='checkbox' >\
                            <label for='check-fix-footer'>\
                               <strong>Fixed Footer</strong> \
                            </label>\
                        </div>\
                    </div>\
                    <div class='col-md-6'>\
                        <div class='m-checkbox '>\
                            <input id='check-boxed'  type='checkbox' >\
                            <label for='check-boxed' >\
                               <strong>Boxed Layout</strong> \
                            </label>\
                            <div class='note'>(non-responsive)</div>\
                        </div>\
                        <div class='m-checkbox '>\
                            <input id='check-rtl'  type='checkbox' >\
                            <label for='check-rtl' >\
                               <strong>RTL version</strong> \
                            </label>\
                        </div>\
                        <div class='m-checkbox '>\
                            <input id='check-top-menu'  type='checkbox' >\
                            <label for='check-top-menu' >\
                               <strong>Top Menu</strong> \
                            </label>\
                            <div class='note'>(with hover active)</div>\
                        </div>\
                    </div>\
                </div>  \
                <legend class='no-padding'>Backgrounds for Boxed Layout</legend>\
                <div class='images boxed-patterns'>\
                    <a id='bg_p1' href='#'><img alt='' src='../assets/img/bg/bg_p1.jpg' height='25' width='25'></a>\
                    <a id='bg_p2' href='#'><img alt='' src='../assets/img/bg/bg_p2.jpg' height='25' width='25'></a>\
                    <a id='bg_p3' href='#'><img alt='' src='../assets/img/bg/bg_p3.jpg' height='25' width='25'></a>\
                    <a id='bg_p4' href='#'><img alt='' src='../assets/img/bg/bg_p4.jpg' height='25' width='25'></a>\
                    <a id='bg_p5' href='#'><img alt='' src='../assets/img/bg/bg_p5.jpg' height='25' width='25'></a>\
                    <a id='bg_p6' href='#'><img alt='' src='../assets/img/bg/bg_p6.jpg' height='25' width='25'></a>\
                    <a id='bg_p7' href='#'><img alt='' src='../assets/img/bg/bg_p7.jpg' height='25' width='25'></a>\
                </div>   \
                <legend class='no-padding'>Skins</legend>\
                <div class='images boxed-skins'>\
                    <a id='bg_style_1' href='#'><img alt='' src='../assets/img/skin/skin-1.png' height='24' width='25'></a>\
                    <a id='bg_style_2' href='#'><img alt='' src='../assets/img/skin/skin-2.png' height='24' width='25'></a>\
                    <a id='bg_style_3' href='#'><img alt='' src='../assets/img/skin/skin-3.png' height='24' width='25'></a>\
                </div>\
            </form>\
        </div>";
$(function(){
    $('#container').after(htmlDemo);
    //demo settings show
    $('#demo-setting').on('click', function() {
        $(this).parent().toggleClass("activate");
    });
      

    /* SWITCH BETWEEN FULLWIDTH & BOXED */
    $("#check-boxed").change(function() {
        if(this.checked) {
            // Enable Boxed and Disable fix_ribbon , fix_sidebar
           $('#container').switchClass('container-fluid', 'container', 250, 'easeInOutQuad')
           $("#check-fix-ribbon")
                .prop('checked', false);
            $('#container').removeClass('fixed-ribbon');
            $("#check-fix-sidebar")
                .prop('checked', false);
            $('#container').removeClass('fixed-sidebar');        
        } else{
            $('#container').switchClass('container','container-fluid', 250, 'easeInOutQuad')
        }
    });

    /* FIX HEADER */
    $("#check-fix-header").change(function() {
        if(this.checked) {
           $('#container').addClass('fixed-header');
        } else{
            // Disable Sidebar & fix_ribbon & fix_header
            $("#check-fix-sidebar")
                .prop('checked', false);
            $("#check-fix-ribbon")
                .prop('checked', false);
            $('#container').removeClass('fixed-header');
            $('#container').removeClass('fixed-sidebar');
            $('#container').removeClass('fixed-ribbon');
        }
    });

    /* FIX SIDEBAR */
    $("#check-fix-sidebar").change(function() {
        if(this.checked) {
            // Enable fix_header, fix_sidebar and Disable Boxed
            $("#check-fix-header")
                .prop('checked', true);
            $("#check-boxed")
                .prop('checked', false);    
           $('#container').addClass('fixed-header');
           $('#container').addClass('fixed-sidebar');
           $('#container').switchClass('container','container-fluid', 250, 'easeInOutQuad');
        } else{
            // Disable fix_ribbon, fix_sidebar
            $("#check-fix-ribbon")
                .prop('checked', false);
            $('#container').removeClass('fixed-sidebar');
            $('#container').removeClass('fixed-ribbon');
        }
    });

    /* FIX RIBBON*/
    $("#check-fix-ribbon").change(function() {
        if(this.checked) {
            // Enable fix_sidebar, fix_header, fix_ribbon and Disable Boxed
            $("#check-fix-header")
                .prop('checked', true);
            $("#check-fix-sidebar")
                .prop('checked', true);
            $("#check-fix-ribbon")
                .prop('checked', true);        
            $('#container').addClass('fixed-header');
            $('#container').addClass('fixed-sidebar');
            $('#container').addClass('fixed-ribbon');        
            $("#check-boxed")
                .prop('checked', false);
            $('#container').switchClass('container','container-fluid', 250, 'easeInOutQuad');
        } else{
            // Disable fix_ribbon
            $('#container').removeClass('fixed-ribbon');
        }
    });

    /* FIX FOOTER*/
    $("#check-fix-footer").change(function() {
        if(this.checked) {
           $('#container').addClass('fixed-footer');
        } else{
            $('#container').removeClass('fixed-footer');
        }
    });

    /* CHANGE BACKGROUND BOXED MODE*/ 
    $('.boxed-patterns > a > img').bind('click',function(){
        var $this = $(this);
        var $html = $('html')
        bgurl = ($this.attr("src"));
        $html.css("background-image", "url(" + bgurl + ")");
    })

    /* CHANGE SKINS */
    $('#bg_style_1').on('click',function(){
        $('#container').removeClass('skin-1');
        $('#container').removeClass('skin-2');
        $('#container').addClass('skin-3');          
    })

    $('#bg_style_2').on('click',function(){
        $('#container').removeClass('skin-2');
        $('#container').removeClass('skin-3');
        $('#container').addClass('skin-1');                
    })

    $('#bg_style_3').on('click',function(){
        $('#container').removeClass('skin-3');
        $('#container').removeClass('skin-1');
        $('#container').addClass('skin-2');        
    })

    /* ACTIVE RTL VERSION */
    $("#check-rtl").change(function() {
        if(this.checked) {            
            $("head link[href='../assets/vendors/bootstrap/css/bootstrap.min.css'] ").last().after("<link rel='stylesheet' href='../assets/css/yep-rtl.css' type='text/css' media='screen'>");            
            $('body').addClass('rtl');
        } else {
            $("head link[href='../assets/css/yep-rtl.css'] ").remove();        
            $('body').removeClass('rtl');  
        }
    })

    /* ACTIVE TOP MENU LAYOUT */
    $("#check-top-menu").change(function() {
        if(this.checked) {            
           $('#container').addClass('top-menu');
           $('#container').addClass('hover-active');
        } else {
           $('#container').removeClass('top-menu');  
           $('#container').removeClass('hover-active');  
        }
    })
}) 