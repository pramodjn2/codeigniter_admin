    // Change all .Selec2 to Select2 script
// if ($.fn.select2) {
//     $('.select2').each(function() {
//         var $this = $(this),
//             width = $this.attr('data-select-width') || '100%';
//         //, _showSearchInput = $this.attr('data-select-search') === 'true';
//         $this.select2({
//             //showSearchInput : _showSearchInput,
//             allowClear : true,
//             width : width,
//             theme: "bootstrap"
//         });

//         //clear memory reference
//         $this = null;
//     });
// }

/*
 * JQUERY UI DATE
 * Usage: <input class="datepicker" />
 */
if ($.fn.datepicker) {
    $('.datepicker').each(function() {

        var $this = $(this),
            dataDateFormat = $this.attr('data-dateformat') || 'dd.mm.yy';

        $this.datepicker({
            dateFormat : dataDateFormat,
            prevText : '<i class="fa fa-plus"></i>',
            nextText : '<i class="fa fa-chevron-right"></i>',
        });
        
        //clear memory reference
        $this = null;
    });
}

 /*
 * MailBOX
 */

